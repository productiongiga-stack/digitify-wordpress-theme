(function () {
	'use strict';

	const siteHeader = document.querySelector('.digitify-site-header');
	const header = document.querySelector('.digitify-header');
	const menuToggle = document.querySelector('.digitify-menu-toggle');
	const mobileNav = document.querySelector('.digitify-mobile-nav');
	const mobileClose = document.querySelector('.digitify-mobile-nav__close');
	const mobileOverlay = document.querySelector('.digitify-mobile-nav__overlay');
	const scrollProgress = document.querySelector('.digitify-header__progress span');

	function setMenuOpen(open) {
		if (!mobileNav) return;
		mobileNav.classList.toggle('is-open', open);
		mobileNav.setAttribute('aria-hidden', open ? 'false' : 'true');
		document.body.classList.toggle('digitify-menu-open', open);
		if (menuToggle) {
			menuToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
		}
	}

	function updateHeaderScroll() {
		const scrolled = window.scrollY > 20;
		if (siteHeader) {
			siteHeader.classList.toggle('is-scrolled', scrolled);
		}
		if (header) {
			header.classList.toggle('is-scrolled', scrolled);
		}
		document.body.classList.toggle('digitify-scrolled', scrolled);

		if (scrollProgress) {
			const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
			const progress = maxScroll > 0 ? Math.min(100, (window.scrollY / maxScroll) * 100) : 0;
			scrollProgress.style.width = progress + '%';
		}
	}

	if (siteHeader || header) {
		updateHeaderScroll();
		window.addEventListener('scroll', updateHeaderScroll, { passive: true });
		window.addEventListener('resize', updateHeaderScroll, { passive: true });
	}

	if (menuToggle && mobileNav) {
		menuToggle.addEventListener('click', function () {
			setMenuOpen(!mobileNav.classList.contains('is-open'));
		});
	}

	if (mobileClose) {
		mobileClose.addEventListener('click', function () {
			setMenuOpen(false);
		});
	}

	if (mobileOverlay) {
		mobileOverlay.addEventListener('click', function () {
			setMenuOpen(false);
		});
	}

	document.querySelectorAll('.digitify-mobile-nav__panel a').forEach(function (link) {
		link.addEventListener('click', function () {
			setMenuOpen(false);
		});
	});

	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape') {
			setMenuOpen(false);
		}
	});

	const fleetScroller = document.querySelector('.digitify-home-fleet-scroller');
	const fleetTrack = fleetScroller ? fleetScroller.querySelector('.digitify-home-fleet') : null;
	const fleetNavPrev = fleetScroller ? fleetScroller.querySelector('.digitify-home-fleet-scroller__nav--prev') : null;
	const fleetNavNext = fleetScroller ? fleetScroller.querySelector('.digitify-home-fleet-scroller__nav--next') : null;

	function getFleetItems() {
		return fleetTrack ? Array.from(fleetTrack.querySelectorAll('.digitify-home-fleet__item')) : [];
	}

	function getFleetScrollPadding() {
		if (!fleetTrack) return 0;
		const styles = window.getComputedStyle(fleetTrack);
		const inline = parseFloat(styles.scrollPaddingInline) || 0;
		const left = parseFloat(styles.scrollPaddingLeft) || 0;
		return inline || left || 0;
	}

	function getFleetActiveIndex(items) {
		if (!fleetTrack || !items.length) return 0;
		const scrollLeft = fleetTrack.scrollLeft;
		const padding = getFleetScrollPadding();
		let activeIndex = 0;
		let minDistance = Infinity;

		items.forEach(function (item, index) {
			const distance = Math.abs(item.offsetLeft - scrollLeft - padding);
			if (distance < minDistance) {
				minDistance = distance;
				activeIndex = index;
			}
		});

		return activeIndex;
	}

	function scrollFleetToIndex(index) {
		const items = getFleetItems();
		if (!fleetTrack || !items.length) return;

		const targetIndex = Math.max(0, Math.min(index, items.length - 1));
		fleetTrack.scrollTo({
			left: items[targetIndex].offsetLeft - getFleetScrollPadding(),
			behavior: 'smooth',
		});
	}

	function scrollFleetNext() {
		const items = getFleetItems();
		if (!items.length) return;
		scrollFleetToIndex(getFleetActiveIndex(items) + 1);
	}

	function scrollFleetPrev() {
		const items = getFleetItems();
		if (!items.length) return;
		scrollFleetToIndex(getFleetActiveIndex(items) - 1);
	}

	function updateFleetScrollerState() {
		if (!fleetScroller || !fleetTrack) return;

		const scrollable = fleetTrack.scrollWidth > fleetTrack.clientWidth + 2;
		const atStart = fleetTrack.scrollLeft <= 2;
		const atEnd = fleetTrack.scrollLeft + fleetTrack.clientWidth >= fleetTrack.scrollWidth - 2;

		fleetScroller.classList.toggle('is-scrollable', scrollable);
		fleetScroller.classList.toggle('is-at-start', atStart);
		fleetScroller.classList.toggle('is-at-end', atEnd);

		if (fleetNavPrev) {
			fleetNavPrev.disabled = !scrollable || atStart;
		}
		if (fleetNavNext) {
			fleetNavNext.disabled = !scrollable || atEnd;
		}
	}

	if (fleetTrack) {
		updateFleetScrollerState();
		fleetTrack.addEventListener('scroll', updateFleetScrollerState, { passive: true });
		window.addEventListener('resize', updateFleetScrollerState, { passive: true });
	}

	if (fleetNavPrev) {
		fleetNavPrev.addEventListener('click', function () {
			scrollFleetPrev();
		});
	}

	if (fleetNavNext) {
		fleetNavNext.addEventListener('click', function () {
			scrollFleetNext();
		});
	}

	if (fleetTrack) {
		fleetTrack.addEventListener('click', function (e) {
			if (!window.matchMedia('(max-width: 768px)').matches) return;
			const ton = e.target.closest('.digitify-home-fleet__ton');
			if (!ton) return;
			e.preventDefault();
			scrollFleetNext();
		});
	}

	/* Scroll reveal */
	if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
		const revealEls = document.querySelectorAll('.digitify-reveal');
		if (revealEls.length && 'IntersectionObserver' in window) {
			const observer = new IntersectionObserver(function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						entry.target.classList.add('is-visible');
						observer.unobserve(entry.target);
					}
				});
			}, { threshold: 0.08, rootMargin: '0px 0px -8% 0px' });

			revealEls.forEach(function (el) {
				observer.observe(el);
			});
		} else {
			revealEls.forEach(function (el) {
				el.classList.add('is-visible');
			});
		}
	} else {
		document.querySelectorAll('.digitify-reveal').forEach(function (el) {
			el.classList.add('is-visible');
		});
	}

	/* Browser preview — lazy iframe + fallback */
	function loadBrowserPreview(root) {
		if (!root) {
			return;
		}

		const iframe = root.querySelector('.digitify-browser-preview__frame');
		if (!iframe) {
			return;
		}

		if (iframe.dataset.src && !iframe.src) {
			iframe.src = iframe.dataset.src;
		}

		if (root.dataset.previewBound === 'true') {
			return;
		}

		root.dataset.previewBound = 'true';

		let fallbackTimer = window.setTimeout(function () {
			if (!root.classList.contains('is-loaded')) {
				root.classList.add('is-fallback');
			}
		}, 4500);

		iframe.addEventListener('load', function () {
			window.clearTimeout(fallbackTimer);
			window.setTimeout(function () {
				root.classList.remove('is-fallback');
				root.classList.add('is-loaded');
			}, 350);
		});

		iframe.addEventListener('error', function () {
			window.clearTimeout(fallbackTimer);
			root.classList.add('is-fallback');
		});
	}

	function initBrowserPreviews(scope) {
		const context = scope || document;
		const previews = context.querySelectorAll('[data-browser-preview]');

		previews.forEach(function (preview) {
			const iframe = preview.querySelector('.digitify-browser-preview__frame');
			if (!iframe) {
				return;
			}

			if (iframe.src) {
				loadBrowserPreview(preview);
				return;
			}

			if ('IntersectionObserver' in window) {
				const observer = new IntersectionObserver(
					function (entries) {
						entries.forEach(function (entry) {
							if (entry.isIntersecting) {
								loadBrowserPreview(preview);
								observer.unobserve(preview);
							}
						});
					},
					{ rootMargin: '140px 0px', threshold: 0.08 }
				);
				observer.observe(preview);
			} else {
				loadBrowserPreview(preview);
			}
		});
	}

	initBrowserPreviews();

	/* Cases filter + spotlight */
	const caseFilterBtns = document.querySelectorAll('.digitify-cases-filter__btn, .digitify-cases-tabs__btn');
	const caseCards = document.querySelectorAll('.digitify-case-card[data-category]');
	const clientCards = document.querySelectorAll('.digitify-client-card[data-categories]');
	const indexRows = document.querySelectorAll('.digitify-cases-index__row[data-category]');
	const casesCatalogGrid = document.querySelector('.digitify-cases-catalog__grid');

	function shuffleCatalogCards() {
		if (!casesCatalogGrid) {
			return;
		}

		const cards = Array.prototype.slice.call(
			casesCatalogGrid.querySelectorAll('.digitify-case-card[data-category]:not(.is-hidden)')
		);

		for (let i = cards.length - 1; i > 0; i -= 1) {
			const j = Math.floor(Math.random() * (i + 1));
			const temp = cards[i];
			cards[i] = cards[j];
			cards[j] = temp;
		}

		cards.forEach(function (card) {
			casesCatalogGrid.appendChild(card);
		});
	}

	function applyCaseFilter(filter) {
		caseFilterBtns.forEach(function (b) {
			const isActive = b.getAttribute('data-filter') === filter;
			b.classList.toggle('is-active', isActive);
			b.setAttribute('aria-selected', isActive ? 'true' : 'false');
		});

		caseCards.forEach(function (card) {
			const category = card.getAttribute('data-category');
			const show = filter === 'all' || category === filter;
			card.classList.toggle('is-hidden', !show);
		});

		clientCards.forEach(function (card) {
			const categories = (card.getAttribute('data-categories') || '').split(/\s+/);
			const show = filter === 'all' || categories.indexOf(filter) !== -1;
			card.classList.toggle('is-hidden', !show);
		});

		indexRows.forEach(function (row) {
			const category = row.getAttribute('data-category');
			const show = filter === 'all' || category === filter;
			row.classList.toggle('is-hidden', !show);
		});

		if (filter === 'all') {
			shuffleCatalogCards();
		}
	}

	if (caseFilterBtns.length && (caseCards.length || clientCards.length)) {
		caseFilterBtns.forEach(function (btn) {
			btn.addEventListener('click', function () {
				applyCaseFilter(btn.getAttribute('data-filter'));
			});
		});

		function getCaseFilterFromHash() {
			const hash = window.location.hash.replace(/^#/, '');
			if (!hash) {
				return '';
			}

			const match = document.querySelector(
				'.digitify-cases-tabs__btn[data-filter="' + hash + '"], .digitify-cases-filter__btn[data-filter="' + hash + '"]'
			);

			return match ? hash : '';
		}

		const initialFilter = getCaseFilterFromHash();
		if (initialFilter) {
			applyCaseFilter(initialFilter);
		}

		window.addEventListener('hashchange', function () {
			const filter = getCaseFilterFromHash();
			applyCaseFilter(filter || 'all');
		});
	}

	/* Legal TOC */
	const legalContent = document.querySelector('.digitify-legal-content');
	const tocList = document.querySelector('.digitify-legal-toc__list');
	if (legalContent && tocList) {
		const headings = legalContent.querySelectorAll('h2[id]');
		headings.forEach(function (heading) {
			const li = document.createElement('li');
			const a = document.createElement('a');
			a.href = '#' + heading.id;
			a.textContent = heading.textContent;
			li.appendChild(a);
			tocList.appendChild(li);
		});
	}

	/* Contact form fallback */
	const contactForm = document.querySelector('.digitify-form');
	if (contactForm) {
		contactForm.addEventListener('submit', function (e) {
			if (contactForm.getAttribute('action') === '#') {
				e.preventDefault();
				const btn = contactForm.querySelector('[type="submit"]');
				const original = btn.textContent;
				btn.textContent = 'Verzonden!';
				btn.disabled = true;
				setTimeout(function () {
					btn.textContent = original;
					btn.disabled = false;
					contactForm.reset();
				}, 3000);
			}
		});
	}

	/* Contact wizard */
	const contactWizard = document.querySelector('[data-contact-wizard]');
	if (contactWizard) {
		const panels = contactWizard.querySelectorAll('[data-wizard-panel]');
		const indicators = document.querySelectorAll('[data-wizard-indicator]');
		const prevBtn = contactWizard.querySelector('[data-wizard-prev]');
		const nextBtn = contactWizard.querySelector('[data-wizard-next]');
		const submitBtn = contactWizard.querySelector('[data-wizard-submit]');
		const titleEl = document.querySelector('[data-wizard-title]');
		const leadEl = document.querySelector('[data-wizard-lead]');
		const badgeEl = document.querySelector('[data-wizard-badge]');
		const summaryFields = contactWizard.querySelectorAll('[data-wizard-summary]');
		let currentStep = 1;
		const totalSteps = panels.length;

		const stepCopy = [
			{
				title: 'Uw project',
				lead: 'Vertel ons welke dienst u zoekt en wat u wilt bereiken.',
				badge: 'Stap 1 · Project',
			},
			{
				title: 'Uw gegevens',
				lead: 'Laat ons weten hoe we u kunnen bereiken.',
				badge: 'Stap 2 · Contact',
			},
			{
				title: 'Controleer en verzend',
				lead: 'Klopt alles? Verstuur uw aanvraag en wij nemen snel contact op.',
				badge: 'Stap 3 · Controle',
			},
		];

		function getFieldValue(name) {
			const field = contactWizard.querySelector('[name="' + name + '"]');
			if (!field) {
				return '';
			}
			if (field.tagName === 'SELECT') {
				const option = field.options[field.selectedIndex];
				return option && option.value ? option.textContent.trim() : '';
			}
			return field.value.trim();
		}

		function updateSummary() {
			const values = {
				name: getFieldValue('name') || '—',
				company: getFieldValue('company') || '—',
				email: getFieldValue('email') || '—',
				phone: getFieldValue('phone') || '—',
				service: getFieldValue('service') || '—',
				message: getFieldValue('message') || '—',
			};

			summaryFields.forEach(function (node) {
				const key = node.getAttribute('data-wizard-summary');
				if (key && values[key]) {
					node.textContent = values[key];
				}
			});
		}

		function validateStep(step) {
			const panel = contactWizard.querySelector('[data-wizard-panel="' + step + '"]');
			if (!panel) {
				return true;
			}

			const requiredFields = panel.querySelectorAll('[required]');
			for (let i = 0; i < requiredFields.length; i++) {
				if (!requiredFields[i].checkValidity()) {
					requiredFields[i].reportValidity();
					return false;
				}
			}

			return true;
		}

		function setStep(step) {
			currentStep = step;

			panels.forEach(function (panel) {
				const panelStep = Number(panel.getAttribute('data-wizard-panel'));
				const isActive = panelStep === step;
				panel.classList.toggle('is-active', isActive);
				panel.hidden = !isActive;
			});

			indicators.forEach(function (indicator) {
				const indicatorStep = Number(indicator.getAttribute('data-wizard-indicator'));
				indicator.classList.toggle('is-active', indicatorStep === step);
				indicator.classList.toggle('is-complete', indicatorStep < step);
			});

			if (titleEl && leadEl && badgeEl && stepCopy[step - 1]) {
				titleEl.textContent = stepCopy[step - 1].title;
				leadEl.textContent = stepCopy[step - 1].lead;
				badgeEl.textContent = stepCopy[step - 1].badge;
			}

			if (prevBtn) {
				prevBtn.hidden = step === 1;
			}
			if (nextBtn) {
				nextBtn.hidden = step === totalSteps;
			}
			if (submitBtn) {
				submitBtn.hidden = step !== totalSteps;
			}

			if (step === totalSteps) {
				updateSummary();
			}
		}

		if (nextBtn) {
			nextBtn.addEventListener('click', function () {
				if (!validateStep(currentStep)) {
					return;
				}
				if (currentStep < totalSteps) {
					setStep(currentStep + 1);
				}
			});
		}

		if (prevBtn) {
			prevBtn.addEventListener('click', function () {
				if (currentStep > 1) {
					setStep(currentStep - 1);
				}
			});
		}

		setStep(1);
	}
})();
