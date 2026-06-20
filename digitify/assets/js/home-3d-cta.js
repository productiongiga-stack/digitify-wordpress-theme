(function () {
  const cfg = window.digitifyHome3d || {};
  const models = Array.isArray(cfg.models) ? cfg.models : [];
  const shopUrl = String(cfg.shopUrl || 'https://shop.digitify.be').replace(/\/+$/, '');
  const viewer = document.getElementById('digitifyHome3dViewer');
  const label = document.getElementById('digitifyHome3dLabel');
  if (!viewer || !models.length) return;

  let index = 0;
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function showModel(i) {
    const model = models[i];
    if (!model) return;
    viewer.src = model.glb;
    viewer.poster = model.poster;
    viewer.alt = model.name || 'Product';
    if (label) label.textContent = model.name || '';
    const cta = document.querySelector('.digitify-home-shop-cta__actions .digitify-btn--primary');
    if (cta && model.id) {
      cta.href = shopUrl + '/?product=' + encodeURIComponent(model.id);
    }
  }

  if (reduceMotion || models.length < 2) {
    showModel(0);
    return;
  }

  showModel(0);
  window.setInterval(function () {
    index = (index + 1) % models.length;
    showModel(index);
  }, 6000);
})();
