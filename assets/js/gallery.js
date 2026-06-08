
(function () {
  gsap.registerPlugin(ScrollTrigger);

  /* ── SCROLL REVEAL ── */
  gsap.utils.toArray('.reveal').forEach((el, i) => {
    gsap.fromTo(el,
      { opacity: 0, y: 44 },
      {
        opacity: 1, y: 0,
        duration: 0.72,
        ease: 'power3.out',
        delay: parseFloat(el.style.animationDelay) || 0,
        scrollTrigger: {
          trigger: el,
          start: 'top 88%',
          toggleActions: 'play none none none'
        }
      }
    );
  });

  /* ══════════════════════════════
     GALLERY
  ══════════════════════════════ */
  const grid       = document.getElementById('galleryGrid');
  const allItems   = Array.from(grid.querySelectorAll('.gallery-item'));
  const extraItems = Array.from(grid.querySelectorAll('.gallery-item.extra'));
  const loadBtn    = document.getElementById('loadMoreBtn');
  const filterBtns = document.querySelectorAll('.gf-btn');
  const visSpan    = document.getElementById('visibleCount');
  const totalSpan  = document.getElementById('totalCount');

  totalSpan.textContent = allItems.length;

  let currentFilter = 'all';
  let extrasVisible = false;

  function updateCounts() {
    const vis = allItems.filter(i => !i.classList.contains('hidden')).length;
    visSpan.textContent = vis;
  }

  /* filter */
  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      currentFilter = btn.dataset.filter;

      allItems.forEach(item => {
        const match = currentFilter === 'all' || item.dataset.cat === currentFilter;
        const isExtra = item.classList.contains('extra');

        if (!match) {
          item.classList.add('hidden');
        } else if (isExtra && !extrasVisible) {
          item.classList.add('hidden');
        } else {
          item.classList.remove('hidden');
          gsap.fromTo(item, { opacity: 0, scale: 0.92 }, { opacity: 1, scale: 1, duration: 0.4, ease: 'power2.out' });
        }
      });

      updateCounts();
    });
  });

  /* load more */
  loadBtn.addEventListener('click', () => {
    extrasVisible = true;
    extraItems.forEach((item, i) => {
      const match = currentFilter === 'all' || item.dataset.cat === currentFilter;
      if (match) {
        item.classList.remove('hidden');
        gsap.fromTo(item, { opacity: 0, y: 30 }, { opacity: 1, y: 0, duration: 0.5, delay: i * 0.08, ease: 'power3.out' });
      }
    });
    loadBtn.style.display = 'none';
    updateCounts();
  });

  /* ── LIGHTBOX ── */
  const lb       = document.getElementById('lightbox');
  const lbImg    = document.getElementById('lbImg');
  const lbCat    = document.getElementById('lbCat');
  const lbTtl    = document.getElementById('lbTtl');
  const lbClose  = document.getElementById('lbClose');
  const lbPrev   = document.getElementById('lbPrev');
  const lbNext   = document.getElementById('lbNext');
  const lbCurr   = document.getElementById('lbCurr');
  const lbTotal  = document.getElementById('lbTotal');

  let lbItems = [];
  let lbIdx   = 0;

  function getVisible() {
    return allItems.filter(i => !i.classList.contains('hidden'));
  }

  function openLb(item) {
    lbItems = getVisible();
    lbIdx   = lbItems.indexOf(item);
    showLb();
    lb.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function showLb() {
    const item = lbItems[lbIdx];
    gsap.fromTo(lbImg, { opacity: 0, scale: 0.94 }, { opacity: 1, scale: 1, duration: 0.35, ease: 'power2.out' });
    lbImg.src    = item.dataset.src;
    lbImg.alt    = item.dataset.title;
    lbCat.textContent  = item.dataset.cat.toUpperCase();
    lbTtl.textContent  = item.dataset.title;
    lbCurr.textContent = lbIdx + 1;
    lbTotal.textContent = lbItems.length;
  }

  function closeLb() {
    lb.classList.remove('open');
    document.body.style.overflow = '';
  }

  allItems.forEach(item => {
    item.addEventListener('click', () => openLb(item));
  });

  lbClose.addEventListener('click', closeLb);
  lb.addEventListener('click', e => { if (e.target === lb) closeLb(); });

  lbPrev.addEventListener('click', () => {
    lbIdx = (lbIdx - 1 + lbItems.length) % lbItems.length;
    showLb();
  });
  lbNext.addEventListener('click', () => {
    lbIdx = (lbIdx + 1) % lbItems.length;
    showLb();
  });

  document.addEventListener('keydown', e => {
    if (!lb.classList.contains('open')) return;
    if (e.key === 'Escape')      closeLb();
    if (e.key === 'ArrowLeft')   { lbIdx = (lbIdx - 1 + lbItems.length) % lbItems.length; showLb(); }
    if (e.key === 'ArrowRight')  { lbIdx = (lbIdx + 1) % lbItems.length; showLb(); }
  });

  /* touch swipe on lightbox */
  let lbTx = 0;
  lb.addEventListener('touchstart', e => { lbTx = e.changedTouches[0].clientX; }, { passive: true });
  lb.addEventListener('touchend',   e => {
    const dx = e.changedTouches[0].clientX - lbTx;
    if (Math.abs(dx) > 48) {
      dx < 0
        ? (lbIdx = (lbIdx + 1) % lbItems.length)
        : (lbIdx = (lbIdx - 1 + lbItems.length) % lbItems.length);
      showLb();
    }
  }, { passive: true });

  /* ══════════════════════════════
     VIDEO SECTION
  ══════════════════════════════ */
  const vidModal    = document.getElementById('vidModal');
  const vmPlayer    = document.getElementById('vmPlayer');
  const vmClose     = document.getElementById('vmClose');
  const featuredVid = document.getElementById('featuredVid');
  const playlistItems = document.querySelectorAll('.vp-item');

  const featThumb = featuredVid.querySelector('img');
  const featTag   = featuredVid.querySelector('.vf-tag');
  const featTitle = featuredVid.querySelector('.vf-title');
  const featDur   = featuredVid.querySelector('.vf-dur');

  function openVideo(ytId) {
    vmPlayer.innerHTML = `<iframe src="https://www.youtube.com/embed/${ytId}?autoplay=1&rel=0" allow="autoplay; encrypted-media" allowfullscreen></iframe>`;
    vidModal.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeVideo() {
    vidModal.classList.remove('open');
    vmPlayer.innerHTML = '';
    document.body.style.overflow = '';
  }

  featuredVid.addEventListener('click', () => {
    openVideo(featuredVid.dataset.yt);
  });

  vmClose.addEventListener('click', closeVideo);
  vidModal.addEventListener('click', e => { if (e.target === vidModal) closeVideo(); });
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeVideo(); });

  /* playlist switching */
  playlistItems.forEach(item => {
    item.addEventListener('click', () => {
      /* update active state */
      playlistItems.forEach(p => p.classList.remove('active'));
      item.classList.add('active');

      /* update featured panel */
      const yt    = item.dataset.yt;
      const thumb = item.dataset.thumb;
      const title = item.dataset.title;
      const tag   = item.dataset.tag;
      const dur   = item.dataset.dur;

      featuredVid.dataset.yt = yt;

      gsap.to(featThumb, {
        opacity: 0, scale: 1.04, duration: 0.25, ease: 'power2.in',
        onComplete: () => {
          featThumb.src = thumb;
          featTag.textContent  = tag;
          featTitle.textContent = title;
          featDur.innerHTML = `<i class="fas fa-clock"></i> ${dur}`;
          gsap.to(featThumb, { opacity: 1, scale: 1, duration: 0.4, ease: 'power2.out' });
        }
      });
    });
  });

  /* ── COUNT-UP (stats) ── */
  const counters = document.querySelectorAll('.vs-cnt');
  counters.forEach(el => {
    const target = parseFloat(el.dataset.target);
    const isFloat = !!el.dataset.float;
    ScrollTrigger.create({
      trigger: el,
      start: 'top 90%',
      once: true,
      onEnter: () => {
        let v = 0;
        const step = target / 80;
        const iv = setInterval(() => {
          v += step;
          if (v >= target) { v = target; clearInterval(iv); }
          el.textContent = isFloat ? v.toFixed(1) : Math.floor(v);
        }, 18);
      }
    });
  });

  updateCounts();

})();
