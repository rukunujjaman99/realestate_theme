(function () {

  gsap.registerPlugin(ScrollTrigger);

  const AUTO_MS = 5000;

  const sec = document.getElementById("heroSection");

  const slides = document.querySelectorAll("#heroSection .hs");
  const dots = document.querySelectorAll("#heroSection .hs-dot");

  const nextBtn = document.getElementById("hsNext");
  const prevBtn = document.getElementById("hsPrev");

  const bar = document.getElementById("hsBar");
  const counter = document.getElementById("hsCtr");
  const label = document.getElementById("hsLabel");

  const LABELS = [
    "Real Estate",
    "Infrastructure",
    "Technology",
    "Energy"
  ];

  let current = 0;
  let autoSlide;

  /* ===================================
      INIT
  =================================== */

  slides.forEach((slide, index) => {

    if (index === 0) {

      slide.classList.add("active");

      gsap.set(slide, {
        autoAlpha: 1,
        zIndex: 5
      });

    } else {

      slide.classList.remove("active");

      gsap.set(slide, {
        autoAlpha: 0,
        zIndex: 1
      });

    }

  });

  updateUI();
  animateSlide(slides[0]);
  startAuto();

  /* ===================================
      GO TO SLIDE
  =================================== */

  function goToSlide(index) {

    clearTimeout(autoSlide);

    if (index >= slides.length) {
      index = 0;
    }

    if (index < 0) {
      index = slides.length - 1;
    }

    const currentSlide = slides[current];
    const nextSlide = slides[index];

    if (current === index) return;

    /* hide current */

    gsap.to(currentSlide, {
      autoAlpha: 0,
      duration: 0.7,
      ease: "power2.out",
      zIndex: 1
    });

    currentSlide.classList.remove("active");

    /* show next */

    nextSlide.classList.add("active");

    gsap.set(nextSlide, {
      autoAlpha: 1,
      zIndex: 5
    });

    animateSlide(nextSlide);

    current = index;

    updateUI();

    startAuto();

  }

  /* ===================================
      ANIMATION
  =================================== */

  function animateSlide(slide) {

    const img = slide.querySelector(".hs-bg img");

    const eye = slide.querySelector(".hs-eye");
    const title = slide.querySelector(".hs-title");
    const desc = slide.querySelector(".hs-desc");
    const btns = slide.querySelector(".hs-btns");

    gsap.killTweensOf([
      img,
      eye,
      title,
      desc,
      btns
    ]);

    gsap.set(img, {
      scale: 1.15
    });

    gsap.set(
      [eye, title, desc, btns],
      {
        opacity: 0,
        y: 40
      }
    );

    gsap.to(img, {
      scale: 1,
      duration: 2,
      ease: "power2.out"
    });

    gsap.to(eye, {
      opacity: 1,
      y: 0,
      duration: 0.5,
      delay: 0.2
    });

    gsap.to(title, {
      opacity: 1,
      y: 0,
      duration: 0.7,
      delay: 0.35
    });

    gsap.to(desc, {
      opacity: 1,
      y: 0,
      duration: 0.6,
      delay: 0.5
    });

    gsap.to(btns, {
      opacity: 1,
      y: 0,
      duration: 0.5,
      delay: 0.65
    });

  }

  /* ===================================
      AUTO PLAY
  =================================== */

  function startAuto() {

    if (bar) {

      bar.style.transition = "none";
      bar.style.width = "0%";

      requestAnimationFrame(() => {

        bar.style.transition =
          `width ${AUTO_MS}ms linear`;

        bar.style.width = "100%";

      });

    }

    autoSlide = setTimeout(() => {

      goToSlide(current + 1);

    }, AUTO_MS);

  }

  /* ===================================
      UI UPDATE
  =================================== */

  function updateUI() {

    dots.forEach((dot, i) => {

      dot.classList.toggle(
        "active",
        i === current
      );

    });

    if (counter) {

      counter.innerHTML =
        `<span>${String(current + 1).padStart(2, "0")}</span> / ${slides.length}`;

    }

    if (label) {

      label.textContent =
        LABELS[current];

    }

  }

  /* ===================================
      BUTTONS
  =================================== */

  if (nextBtn) {

    nextBtn.addEventListener(
      "click",
      () => {

        goToSlide(current + 1);

      }
    );

  }

  if (prevBtn) {

    prevBtn.addEventListener(
      "click",
      () => {

        goToSlide(current - 1);

      }
    );

  }

  /* ===================================
      DOTS
  =================================== */

  dots.forEach((dot, i) => {

    dot.addEventListener(
      "click",
      () => {

        goToSlide(i);

      }
    );

  });

  /* ===================================
      KEYBOARD
  =================================== */

  document.addEventListener(
    "keydown",
    (e) => {

      if (e.key === "ArrowRight") {

        goToSlide(current + 1);

      }

      if (e.key === "ArrowLeft") {

        goToSlide(current - 1);

      }

    }
  );

  /* ===================================
      TOUCH SWIPE
  =================================== */

  let touchStartX = 0;

  sec.addEventListener(
    "touchstart",
    (e) => {

      touchStartX =
        e.changedTouches[0].clientX;

    },
    { passive: true }
  );

  sec.addEventListener(
    "touchend",
    (e) => {

      const touchEndX =
        e.changedTouches[0].clientX;

      const diff =
        touchEndX - touchStartX;

      if (Math.abs(diff) > 50) {

        if (diff < 0) {

          goToSlide(current + 1);

        } else {

          goToSlide(current - 1);

        }

      }

    },
    { passive: true }
  );

})();