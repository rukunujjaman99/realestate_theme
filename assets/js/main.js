"use strict";
/* ============================================================
   DOMA HOLDING — MAIN JS  (full rewrite with video hero)
============================================================ */

document.addEventListener("DOMContentLoaded", function () {
  initScrollProgressBar();
  initNav();
  initVideoHeroSlider();
  initScrollReveal();
  initCounters();
  initProgressBars();
  initParticles();
  initBackToTop();
  initMobileNav();
  initProjectFilters();
  initViewToggle();
  initStatusRows();
  initContactForm();
  initBlogSearch();
  initNewsletterForms();
  initTypingEffect();
  initCardTilt();
  initPageTransitions();
  initSmoothAnchors();
  initTabSystem();
  initDocDownload();
  initParallaxElements();
  highlightActiveNav();
});

/* ─── SCROLL PROGRESS BAR ──────────────────────────────── */
function initScrollProgressBar() {
  var bar = document.createElement("div");
  bar.className = "scroll-progress-bar";
  document.body.prepend(bar);
  window.addEventListener("scroll", function () {
    var pct = window.scrollY / (document.documentElement.scrollHeight - window.innerHeight) * 100;
    bar.style.width = Math.min(pct, 100) + "%";
  });
}

/* ─── NAV ────────────────────────────────────────────────── */
function initNav() {
  var nav = document.getElementById("domaNav");
  if (!nav) return;
  var onScroll = function () {
    nav.classList.toggle("nav-scrolled", window.scrollY > 50);
  };
  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();
}

function highlightActiveNav() {
  var page = window.location.pathname.split("/").pop() || "index.html";
  document.querySelectorAll(".nav-link, .mobile-nav-link").forEach(function (a) {
    if (a.getAttribute("href") === page) a.classList.add("active");
  });
}

/* ─── MOBILE NAV ─────────────────────────────────────────── */
function initMobileNav() {
  var toggle  = document.getElementById("navToggle");
  var panel   = document.getElementById("mobileNavPanel");
  var overlay = document.getElementById("mobileNavOverlay");
  var closeBtn= document.getElementById("mobileNavClose");
  if (!toggle || !panel) return;

  function open()  { panel.classList.add("open"); if(overlay) overlay.classList.add("show"); document.body.style.overflow="hidden"; }
  function close() { panel.classList.remove("open"); if(overlay) overlay.classList.remove("show"); document.body.style.overflow=""; }

  toggle.addEventListener("click", open);
  if (closeBtn) closeBtn.addEventListener("click", close);
  if (overlay)  overlay.addEventListener("click", close);
  document.addEventListener("keydown", function(e){ if(e.key==="Escape") close(); });
}

/* ─── VIDEO HERO SLIDER ──────────────────────────────────── */
function initVideoHeroSlider() {
  var slides = document.querySelectorAll(".video-slide");
  var dots   = document.querySelectorAll(".slider-dot");
  if (!slides.length) return;

  var current = 0;
  var total   = slides.length;
  var dur     = 7000;
  var timer;

  function goTo(idx) {
    slides[current].classList.remove("active");
    if (dots[current]) dots[current].classList.remove("active");

    // pause old video
    var oldVid = slides[current].querySelector("video");
    if (oldVid) { oldVid.pause(); oldVid.currentTime = 0; }

    current = (idx + total) % total;
    slides[current].classList.add("active");
    if (dots[current]) dots[current].classList.add("active");

    // play new video
    var newVid = slides[current].querySelector("video");
    if (newVid) { newVid.currentTime = 0; newVid.play().catch(function(){}); }

    updateCounter();
  }

  function updateCounter() {
    var el = document.getElementById("slideCounter");
    if (el) el.textContent = (current + 1) + " / " + total;
  }

  function start() { timer = setInterval(function(){ goTo(current + 1); }, dur); }
  function stop()  { clearInterval(timer); }

  dots.forEach(function (dot, i) {
    dot.addEventListener("click", function () { stop(); goTo(i); start(); });
  });

  var prevBtn = document.getElementById("sliderPrev");
  var nextBtn = document.getElementById("sliderNext");
  if (prevBtn) prevBtn.addEventListener("click", function(){ stop(); goTo(current-1); start(); });
  if (nextBtn) nextBtn.addEventListener("click", function(){ stop(); goTo(current+1); start(); });

  // Keyboard arrows
  document.addEventListener("keydown", function(e) {
    if (e.key==="ArrowLeft")  { stop(); goTo(current-1); start(); }
    if (e.key==="ArrowRight") { stop(); goTo(current+1); start(); }
  });

  // Touch swipe
  var heroSection = document.querySelector(".hero-section");
  if (heroSection) {
    var startX = 0;
    heroSection.addEventListener("touchstart", function(e){ startX = e.touches[0].clientX; }, { passive:true });
    heroSection.addEventListener("touchend",   function(e){
      var dx = e.changedTouches[0].clientX - startX;
      if (Math.abs(dx) > 50) { stop(); goTo(current + (dx < 0 ? 1 : -1)); start(); }
    }, { passive:true });
  }

  // Init first slide
  slides[0].classList.add("active");
  if (dots[0]) dots[0].classList.add("active");
  var firstVid = slides[0].querySelector("video");
  if (firstVid) firstVid.play().catch(function(){});
  updateCounter();
  start();
}

/* ─── SCROLL REVEAL ──────────────────────────────────────── */
function initScrollReveal() {
  var selectors = [".reveal",".reveal-left",".reveal-right",".reveal-scale",".reveal-blur",".reveal-flip",".anim-fade-up"];
  var all = document.querySelectorAll(selectors.join(","));
  if (!all.length) return;

  var io = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add("revealed", "visible");
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12, rootMargin: "0px 0px -50px 0px" });

  all.forEach(function(el) { io.observe(el); });
}

/* ─── COUNTERS ───────────────────────────────────────────── */
function initCounters() {
  var els = document.querySelectorAll("[data-count]");
  if (!els.length) return;

  var io = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) { animateCounter(entry.target); io.unobserve(entry.target); }
    });
  }, { threshold: 0.5 });

  els.forEach(function(el) { io.observe(el); });
}

function animateCounter(el) {
  var target   = parseFloat(el.getAttribute("data-count"));
  var suffix   = el.getAttribute("data-suffix") || "";
  var prefix   = el.getAttribute("data-prefix") || "";
  var duration = parseInt(el.getAttribute("data-duration") || "2200");
  var decimals = (target % 1 !== 0) ? 1 : 0;
  var start    = null;

  function step(ts) {
    if (!start) start = ts;
    var p  = Math.min((ts - start) / duration, 1);
    var e  = 1 - Math.pow(1 - p, 4);
    el.textContent = prefix + (target * e).toFixed(decimals) + suffix;
    if (p < 1) requestAnimationFrame(step);
    else el.textContent = prefix + target.toFixed(decimals) + suffix;
  }
  requestAnimationFrame(step);
}

/* ─── PROGRESS BARS ──────────────────────────────────────── */
function initProgressBars() {
  var bars = document.querySelectorAll(".progress-fill[data-width]");
  if (!bars.length) return;

  var io = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        var el = entry.target;
        setTimeout(function(){ el.style.width = el.getAttribute("data-width") + "%"; }, 250);
        io.unobserve(el);
      }
    });
  }, { threshold: 0.3 });

  bars.forEach(function(b) { io.observe(b); });
}

/* ─── PARTICLES ──────────────────────────────────────────── */
function initParticles() {
  document.querySelectorAll(".particles-bg").forEach(function(container) {
    for (var i = 0; i < 20; i++) {
      var p = document.createElement("div");
      p.className = "particle";
      var s = (Math.random() * 3 + 1) + "px";
      p.style.cssText = [
        "left:" + Math.random()*100 + "%",
        "top:"  + Math.random()*100 + "%",
        "width:" + s, "height:" + s,
        "animation-duration:"  + (5 + Math.random()*8) + "s",
        "animation-delay:"     + (Math.random()*8) + "s"
      ].join(";");
      container.appendChild(p);
    }
  });
}

/* ─── BACK TO TOP ────────────────────────────────────────── */
function initBackToTop() {
  var btn = document.getElementById("backToTop");
  if (!btn) return;
  window.addEventListener("scroll", function() {
    btn.classList.toggle("show", window.scrollY > 400);
  }, { passive:true });
  btn.addEventListener("click", function() { window.scrollTo({ top:0, behavior:"smooth" }); });
}

/* ─── PROJECT FILTERS ────────────────────────────────────── */
function initProjectFilters() {
  var btns = document.querySelectorAll(".filter-btn[data-filter]");
  if (!btns.length) return;

  btns.forEach(function(btn) {
    btn.addEventListener("click", function() {
      btns.forEach(function(b){ b.classList.remove("active"); });
      btn.classList.add("active");
      filterProjects(btn.getAttribute("data-filter"), getSearchQuery());
    });
  });

  var search = document.getElementById("projectSearch");
  if (search) {
    search.addEventListener("input", function() {
      var active = document.querySelector(".filter-btn[data-filter].active");
      filterProjects(active ? active.getAttribute("data-filter") : "all", search.value.toLowerCase().trim());
    });
  }
}

function getSearchQuery() {
  var s = document.getElementById("projectSearch");
  return s ? s.value.toLowerCase().trim() : "";
}

function filterProjects(filter, query) {
  var items = document.querySelectorAll("[data-project-item],[data-project-list-item]");
  items.forEach(function(item) {
    var industry = (item.getAttribute("data-industry") || "").toLowerCase();
    var status   = (item.getAttribute("data-status")   || "").toLowerCase();
    var name     = (item.getAttribute("data-name")     || "").toLowerCase();
    var match = (filter === "all" || industry === filter || status === filter);
    var qmatch= (!query || name.includes(query) || industry.includes(query));

    if (match && qmatch) {
      item.style.display = "";
      requestAnimationFrame(function() {
        item.style.opacity = "0"; item.style.transform = "translateY(20px)";
        item.style.transition = "opacity .4s ease, transform .4s ease";
        requestAnimationFrame(function() { item.style.opacity="1"; item.style.transform="translateY(0)"; });
      });
    } else {
      item.style.display = "none";
    }
  });
}

/* ─── VIEW TOGGLE ────────────────────────────────────────── */
function initViewToggle() {
  var gridBtn  = document.getElementById("viewGrid");
  var listBtn  = document.getElementById("viewList");
  var gridView = document.getElementById("projectsGridView");
  var listView = document.getElementById("projectsListView");
  if (!gridBtn || !listBtn) return;

  gridBtn.addEventListener("click", function() {
    gridBtn.classList.add("active"); listBtn.classList.remove("active");
    if (gridView) gridView.style.display = ""; if (listView) listView.style.display = "none";
  });
  listBtn.addEventListener("click", function() {
    listBtn.classList.add("active"); gridBtn.classList.remove("active");
    if (listView) listView.style.display = ""; if (gridView) gridView.style.display = "none";
  });
}

/* ─── STATUS ROWS TOGGLE ─────────────────────────────────── */
function initStatusRows() {
  document.querySelectorAll(".status-row-toggle").forEach(function(btn) {
    var row    = btn.closest(".status-project-row");
    var detail = row ? row.querySelector(".status-row-detail") : null;
    if (!detail) return;
    detail.style.maxHeight = "0px";
    detail.style.overflow  = "hidden";
    detail.style.transition= "max-height .45s cubic-bezier(.4,0,.2,1)";
    var icon = btn.querySelector("i");

    btn.addEventListener("click", function() {
      var open = detail.style.maxHeight !== "0px";
      detail.style.maxHeight = open ? "0px" : detail.scrollHeight + "px";
      if (icon) icon.style.transform = open ? "" : "rotate(180deg)";
      if (!open) {
        // trigger inner progress bars
        setTimeout(function() { initProgressBars(); }, 300);
      }
    });
  });
}

/* ─── CONTACT FORM ───────────────────────────────────────── */
function initContactForm() {
  var form = document.getElementById("contactForm");
  if (!form) return;
  var success = document.getElementById("formSuccess");

  form.addEventListener("submit", function(e) {
    e.preventDefault();
    var btn = form.querySelector("[type='submit']");
    var orig = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending…';
    btn.disabled = true;

    setTimeout(function() {
      btn.innerHTML = orig; btn.disabled = false; form.reset();
      if (success) { success.style.display = "flex"; setTimeout(function(){ success.style.display="none"; }, 5000); }
    }, 2000);
  });
}

/* ─── BLOG SEARCH & FILTER ───────────────────────────────── */
function initBlogSearch() {
  var search = document.getElementById("blogSearch");
  if (search) {
    search.addEventListener("input", function() {
      var q = search.value.toLowerCase().trim();
      document.querySelectorAll("[data-blog-card]").forEach(function(card) {
        var t = (card.getAttribute("data-title") || "").toLowerCase();
        var g = (card.getAttribute("data-tags")  || "").toLowerCase();
        card.style.display = (!q || t.includes(q) || g.includes(q)) ? "" : "none";
      });
    });
  }

  document.querySelectorAll(".blog-cat-btn[data-cat]").forEach(function(btn) {
    btn.addEventListener("click", function() {
      document.querySelectorAll(".blog-cat-btn").forEach(function(b){ b.classList.remove("active"); });
      btn.classList.add("active");
      var cat = btn.getAttribute("data-cat");
      document.querySelectorAll("[data-blog-card]").forEach(function(card) {
        var c = (card.getAttribute("data-category") || "").toLowerCase();
        card.style.display = (cat === "all" || c === cat) ? "" : "none";
      });
    });
  });
}

/* ─── NEWSLETTER ─────────────────────────────────────────── */
function initNewsletterForms() {
  document.querySelectorAll(".newsletter-form").forEach(function(form) {
    form.addEventListener("submit", function(e) {
      e.preventDefault();
      var input = form.querySelector("input[type='email']");
      var btn   = form.querySelector("button");
      if (!input || !input.value) return;
      var orig = btn.innerHTML;
      btn.innerHTML = "✓ Done!"; btn.style.background = "#22c55e"; input.value = "";
      setTimeout(function(){ btn.innerHTML = orig; btn.style.background = ""; }, 3500);
    });
  });
}

/* ─── TYPING EFFECT ──────────────────────────────────────── */
function initTypingEffect() {
  var el = document.getElementById("typingText");
  if (!el) return;
  var words = (el.getAttribute("data-texts") || "").split(",").map(function(w){ return w.trim(); }).filter(Boolean);
  if (!words.length) return;

  var wi = 0, ci = 0, del = false;

  function type() {
    var word = words[wi];
    var show = del ? word.slice(0, ci - 1) : word.slice(0, ci + 1);
    el.textContent = show;
    ci = del ? ci - 1 : ci + 1;

    var delay = del ? 45 : 90;
    if (!del && show === word)  { del = true; delay = 2200; }
    else if (del && show === "") { del = false; wi = (wi + 1) % words.length; delay = 400; }
    setTimeout(type, delay);
  }
  type();
}

/* ─── CARD TILT (desktop) ────────────────────────────────── */
function initCardTilt() {
  if (window.innerWidth < 992) return;
  document.querySelectorAll(".card-3d").forEach(function(card) {
    card.addEventListener("mousemove", function(e) {
      var r  = card.getBoundingClientRect();
      var x  = (e.clientX - r.left) / r.width  - 0.5;
      var y  = (e.clientY - r.top)  / r.height - 0.5;
      card.style.transform = "translateY(-10px) rotateY(" + (x * 10) + "deg) rotateX(" + (-y * 8) + "deg)";
    });
    card.addEventListener("mouseleave", function() { card.style.transform = ""; });
  });
}

/* ─── PAGE TRANSITIONS ───────────────────────────────────── */
function initPageTransitions() {
  var overlay = document.createElement("div");
  overlay.className = "page-transition-overlay";
  document.body.appendChild(overlay);

  document.querySelectorAll("a[href]").forEach(function(link) {
    var href = link.getAttribute("href");
    if (!href || href.startsWith("#") || href.startsWith("mailto") || href.startsWith("tel") || href.includes("://")) return;
    link.addEventListener("click", function(e) {
      e.preventDefault();
      overlay.classList.add("active");
      setTimeout(function() { window.location.href = href; }, 350);
    });
  });

  // Fade in on load
  window.addEventListener("pageshow", function() {
    overlay.classList.remove("active");
  });
}

/* ─── SMOOTH ANCHORS ─────────────────────────────────────── */
function initSmoothAnchors() {
  document.querySelectorAll('a[href^="#"]').forEach(function(a) {
    a.addEventListener("click", function(e) {
      var target = document.querySelector(a.getAttribute("href"));
      if (target) {
        e.preventDefault();
        var top = target.getBoundingClientRect().top + window.scrollY - 90;
        window.scrollTo({ top: top, behavior: "smooth" });
      }
    });
  });
}

/* ─── TAB SYSTEM ─────────────────────────────────────────── */
function initTabSystem() {
  document.addEventListener("click", function(e) {
    var btn = e.target.closest(".doma-tab-btn[data-tab]");
    if (!btn) return;
    var group = btn.closest("[data-tab-group]");
    if (!group) return;
    var id = btn.getAttribute("data-tab");

    group.querySelectorAll(".doma-tab-btn").forEach(function(b){ b.classList.remove("active"); });
    btn.classList.add("active");

    group.querySelectorAll("[data-tab-panel]").forEach(function(panel) {
      panel.style.display   = "none";
      panel.style.opacity   = "0";
    });

    var target = group.querySelector('[data-tab-panel="' + id + '"]');
    if (target) {
      target.style.display = "";
      requestAnimationFrame(function() {
        target.style.transition = "opacity .4s ease";
        target.style.opacity    = "1";
      });
    }
  });
}

/* ─── DOC DOWNLOAD SIM ───────────────────────────────────── */
function initDocDownload() {
  document.addEventListener("click", function(e) {
    var item = e.target.closest(".doc-download-item");
    if (!item) return;
    var icon = item.querySelector(".doc-dl-btn i");
    if (!icon) return;
    icon.className = "fas fa-spinner fa-spin";
    setTimeout(function() {
      icon.className = "fas fa-check"; icon.style.color = "#22c55e";
      setTimeout(function() { icon.className = "fas fa-download"; icon.style.color = ""; }, 2500);
    }, 1400);
  });
}

/* ─── PARALLAX ───────────────────────────────────────────── */
function initParallaxElements() {
  if (window.innerWidth < 768) return;
  var blobs = document.querySelectorAll(".geo-blob");
  window.addEventListener("scroll", function() {
    var sy = window.scrollY;
    blobs.forEach(function(b, i) {
      var speed = (i % 2 === 0) ? 0.08 : 0.05;
      b.style.transform = "translateY(" + (sy * speed) + "px)";
    });
  }, { passive: true });
}

/* ─── CURSOR TRAIL (desktop) ─────────────────────────────── */
(function() {
  if (window.innerWidth < 992) return;
  var dots = [], max = 7, mx = 0, my = 0;
  for (var i = 0; i < max; i++) {
    var d = document.createElement("div");
    var size = (6 - i * 0.6) + "px";
    d.style.cssText = "position:fixed;pointer-events:none;z-index:9997;border-radius:50%;opacity:0;transition:opacity .3s;background:rgba(188,132,43," + (0.55 - i*0.07) + ");width:" + size + ";height:" + size;
    document.body.appendChild(d);
    dots.push({ el:d, x:0, y:0 });
  }
  document.addEventListener("mousemove", function(e){ mx = e.clientX; my = e.clientY; dots[0].x = mx; dots[0].y = my; });

  (function animate() {
    for (var i = max - 1; i > 0; i--) {
      dots[i].x += (dots[i-1].x - dots[i].x) * 0.35;
      dots[i].y += (dots[i-1].y - dots[i].y) * 0.35;
    }
    dots.forEach(function(d) {
      d.el.style.left = (d.x - 3) + "px";
      d.el.style.top  = (d.y - 3) + "px";
      d.el.style.opacity = "1";
    });
    requestAnimationFrame(animate);
  })();
})();




let slides = document.querySelectorAll(".hs");
let index = 0;

function showSlide(i) {

  let current = slides[index];
  let next = slides[i];

  // Animate OUT current
  gsap.to(current.querySelector(".hs-bg"), {
    scale: 1.2,
    duration: 1.2
  });

  gsap.to(current, {
    opacity: 0,
    duration: 0.8
  });

  // Remove active
  current.classList.remove("active");

  // Activate next
  next.classList.add("active");

  // Animate IN
  gsap.fromTo(next.querySelector(".hs-bg"),
    { scale: 1.3 },
    { scale: 1.1, duration: 1.5 }
  );

  gsap.from(next.querySelectorAll(".hs-inner > *"), {
    y: 60,
    opacity: 0,
    stagger: 0.15,
    duration: 1,
    ease: "power3.out"
  });

  index = i;
}

// Auto Slide
setInterval(() => {
  let nextIndex = (index + 1) % slides.length;
  showSlide(nextIndex);
}, 5000);