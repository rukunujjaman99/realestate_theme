<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Services — Doma Holding Company</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
  <link href="assets/css/animations.css" rel="stylesheet"/>
</head>
<body>
<div class="noise-overlay"></div>
<button class="back-to-top" id="backToTop"><i class="fas fa-chevron-up"></i></button>
<div class="mobile-nav-overlay" id="mobileNavOverlay"></div>

<!-- MOBILE NAV -->
<aside class="mobile-nav-panel" id="mobileNavPanel">
  <button class="mobile-nav-close" id="mobileNavClose"><i class="fas fa-times"></i></button>
  <nav class="mobile-nav-links">
    <a href="index.html"    class="mobile-nav-link active">Home <i class="fas fa-chevron-right"></i></a>
    <a href="about.html"    class="mobile-nav-link">About <i class="fas fa-chevron-right"></i></a>
    <a href="projects.html" class="mobile-nav-link">Projects <i class="fas fa-chevron-right"></i></a>
    <a href="status.html"   class="mobile-nav-link">Status <i class="fas fa-chevron-right"></i></a>
    <a href="services.html" class="mobile-nav-link">Services <i class="fas fa-chevron-right"></i></a>
    <a href="blog.html"     class="mobile-nav-link">Blog <i class="fas fa-chevron-right"></i></a>
    <a href="contact.html"  class="mobile-nav-link">Contact <i class="fas fa-chevron-right"></i></a>
  </nav>
  <div style="margin-top:32px;"><a href="contact.html" class="btn-gold" style="display:flex;justify-content:center;"><i class="fas fa-paper-plane"></i>&nbsp;Get In Touch</a></div>
</aside>

<!-- ═══ NAVBAR ═══ -->
<header class="doma-nav" id="domaNav">
  <div class="container"><div class="nav-inner">
    <a href="index.html" class="nav-logo">
      <div class="" style="width: 100px; height: 40px;">
        <img src="assets/images/doma.png" alt="" class="img-fluid" width="100%" >
      </div>
    
    </a>
    <nav class="nav-links">
      <a href="index.html"    class="nav-link active">Home</a>
      <a href="about.html"    class="nav-link">About</a>

        <a href="projects.html" class="nav-link">Projects </a>
        

      <a href="services.html" class="nav-link">Services</a>
      <a href="blog.html"     class="nav-link">Blog</a>
      <a href="contact.html"  class="nav-link">Contact</a>
    </nav>
    <a href="contact.html" class="btn-gold nav-cta"><i class="fas fa-paper-plane"></i> Get In Touch</a>
    <button class="nav-toggle" id="navToggle"><span></span><span></span><span></span></button>
  </div></div>
</header>


<!-- PAGE HERO -->
<section class="page-hero">
  <div class="page-hero-bg"></div>
  <div class="grid-pattern"></div>
  <div class="geo-blob blob-gold" style="width:500px;height:500px;top:-150px;left:-100px;position:absolute;z-index:1;"></div>
  <div class="container position-relative" style="z-index:2;">
    <div class="section-label" style="justify-content:center;">What We Offer</div>
    <h1 class="page-hero-title">Our <span style="color:var(--gold);">Services</span></h1>
    <p style="color:var(--grey);margin-top:12px;font-size:0.9rem;max-width:520px;margin-left:auto;margin-right:auto;">Six integrated business verticals engineered for compounding value across industries and geographies.</p>
    <div class="page-breadcrumb">
      <a href="index.html">Home</a><i class="fas fa-chevron-right"></i>
      <span style="color:var(--gold);">Services</span>
    </div>
  </div>
</section>

<!-- SERVICES DETAIL -->
<section class="section-pad">
  <div class="container">

    <!-- Service 1: Real Estate -->
   <?php
$args = array(
    'post_type'      => 'service',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC'
);

$services = new WP_Query($args);

if($services->have_posts()) :

while($services->have_posts()) :
$services->the_post();

$icon          = get_post_meta(get_the_ID(), '_service_icon', true);
$label         = get_post_meta(get_the_ID(), '_section_label', true);
$number        = get_post_meta(get_the_ID(), '_section_number', true);
$description   = get_post_meta(get_the_ID(), '_service_short_desc', true);

$btn1_text     = get_post_meta(get_the_ID(), '_btn1_text', true);
$btn1_url      = get_post_meta(get_the_ID(), '_btn1_url', true);

$btn2_text     = get_post_meta(get_the_ID(), '_btn2_text', true);
$btn2_url      = get_post_meta(get_the_ID(), '_btn2_url', true);

$features      = get_post_meta(get_the_ID(), '_service_features', true);

if(!is_array($features)){
    $features = array();
}
?>

<div class="row g-5 align-items-center mb-5 anim-fade-up" id="<?php echo sanitize_title(get_the_title()); ?>">

    <!-- Left Image Section -->
    <div class="col-lg-6">

        <div style="
            background:linear-gradient(135deg,var(--navy-dark),var(--bg-card));
            border:1px solid rgba(188,132,43,0.2);
            border-radius:var(--radius-lg);
            padding:30px;
            text-align:center;
            position:relative;
            overflow:hidden;
            min-height:300px;
            display:flex;
            align-items:center;
            justify-content:center;">

            <div class="particles-bg"></div>

            <?php if(has_post_thumbnail()) : ?>

                <?php the_post_thumbnail(
                    'large',
                    array(
                        'style' => '
                            width:100%;
                            height:350px;
                            object-fit:cover;
                            border-radius:15px;
                            position:relative;
                            z-index:2;
                        '
                    )
                ); ?>

            <?php else : ?>

                <div style="position:relative;z-index:2;">
                    <i class="<?php echo esc_attr($icon); ?>"
                       style="
                       font-size:7rem;
                       color:rgba(188,132,43,0.2);
                    "></i>
                </div>

            <?php endif; ?>

            <div class="geo-blob blob-gold"
                 style="
                 width:200px;
                 height:200px;
                 top:-30px;
                 right:-30px;
                 position:absolute;
                 z-index:1;">
            </div>

        </div>

    </div>

    <!-- Right Content Section -->
    <div class="col-lg-6">

        <div class="section-label">
            <?php echo esc_html($number); ?> /
            <?php echo esc_html($label); ?>
        </div>

        <h2 class="section-title">
            <?php the_title(); ?>
        </h2>

        <div class="gold-line"></div>

        <p style="
            color:var(--grey);
            line-height:1.85;
            margin-bottom:20px;
        ">
            <?php echo esc_html($description); ?>
        </p>

        <?php if(!empty($features)) : ?>

        <div style="
            display:flex;
            flex-direction:column;
            gap:12px;
            margin-bottom:28px;
        ">

            <?php foreach($features as $feature) : ?>

                <div style="
                    display:flex;
                    align-items:center;
                    gap:10px;
                    font-size:0.88rem;
                ">
                    <i class="fas fa-check"
                       style="
                       color:var(--gold);
                       flex-shrink:0;
                    "></i>

                    <?php echo esc_html($feature); ?>

                </div>

            <?php endforeach; ?>

        </div>

        <?php endif; ?>

        <div style="
            display:flex;
            gap:14px;
            flex-wrap:wrap;
        ">

            <?php if($btn1_text && $btn1_url) : ?>

                <a href="<?php echo esc_url($btn1_url); ?>"
                   class="btn-gold">

                    <i class="fas fa-paper-plane"></i>
                    <?php echo esc_html($btn1_text); ?>

                </a>

            <?php endif; ?>

            <?php if($btn2_text && $btn2_url) : ?>

                <a href="<?php echo esc_url($btn2_url); ?>"
                   class="btn-outline">

                    <i class="fas fa-th-large"></i>
                    <?php echo esc_html($btn2_text); ?>

                </a>

            <?php endif; ?>

        </div>

    </div>

</div>

<?php
endwhile;
wp_reset_postdata();
endif;
?>

    <div class="divider-gold"></div>

    <!-- Service 2: Infrastructure -->
    <div class="row g-5 align-items-center mb-5 anim-fade-up" id="infrastructure">
      <div class="col-lg-6 order-lg-2">
        <div style="background:linear-gradient(135deg,#0a1a0a,var(--bg-card));border:1px solid rgba(188,132,43,0.2);border-radius:var(--radius-lg);padding:50px;text-align:center;position:relative;overflow:hidden;min-height:300px;display:flex;align-items:center;justify-content:center;">
          <div style="position:relative;z-index:2;">
            <i class="fas fa-hard-hat" style="font-size:7rem;color:rgba(188,132,43,0.2);"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-6 order-lg-1">
        <div class="section-label">02 / Infrastructure</div>
        <h2 class="section-title">Infrastructure <span>& Engineering</span></h2>
        <div class="gold-line"></div>
        <p style="color:var(--grey);line-height:1.85;margin-bottom:20px;">Doma's infrastructure division executes large-scale civil and engineering projects with precision, delivering highways, bridges, utilities, and smart city solutions across the region.</p>
        <div style="display:flex;flex-direction:column;gap:12px;margin-bottom:28px;">
          <div style="display:flex;align-items:center;gap:10px;font-size:0.88rem;"><i class="fas fa-check" style="color:var(--gold);flex-shrink:0;"></i>Highways, expressways & bridge construction</div>
          <div style="display:flex;align-items:center;gap:10px;font-size:0.88rem;"><i class="fas fa-check" style="color:var(--gold);flex-shrink:0;"></i>Airport & port infrastructure</div>
          <div style="display:flex;align-items:center;gap:10px;font-size:0.88rem;"><i class="fas fa-check" style="color:var(--gold);flex-shrink:0;"></i>Smart city utilities & digital infrastructure</div>
          <div style="display:flex;align-items:center;gap:10px;font-size:0.88rem;"><i class="fas fa-check" style="color:var(--gold);flex-shrink:0;"></i>Water treatment & industrial facilities</div>
        </div>
        <a href="contact.html" class="btn-gold"><i class="fas fa-paper-plane"></i> Enquire Now</a>
      </div>
    </div>

    <div class="divider-gold"></div>

    <!-- Service 3: Investment -->
    <div class="row g-5 align-items-center mb-5 anim-fade-up" id="investment">
      <div class="col-lg-6">
        <div style="background:linear-gradient(135deg,#0a0a20,var(--bg-card));border:1px solid rgba(188,132,43,0.2);border-radius:var(--radius-lg);padding:50px;text-align:center;position:relative;overflow:hidden;min-height:300px;display:flex;align-items:center;justify-content:center;">
          <div style="position:relative;z-index:2;">
            <i class="fas fa-chart-line" style="font-size:7rem;color:rgba(188,132,43,0.2);"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="section-label">03 / Investment</div>
        <h2 class="section-title">Investment <span>Management</span></h2>
        <div class="gold-line"></div>
        <p style="color:var(--grey);line-height:1.85;margin-bottom:20px;">Disciplined capital allocation across private equity, real assets, and venture capital — optimized for risk-adjusted returns and long-term wealth creation for our investors.</p>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:28px;">
          <div style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);border-radius:var(--radius);padding:16px;text-align:center;">
            <div style="font-family:var(--font-display);font-size:1.6rem;font-weight:800;color:var(--gold);">14.2%</div>
            <div style="font-size:0.72rem;color:var(--grey);">Avg. Portfolio IRR</div>
          </div>
          <div style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);border-radius:var(--radius);padding:16px;text-align:center;">
            <div style="font-family:var(--font-display);font-size:1.6rem;font-weight:800;color:var(--gold);">$1.2B</div>
            <div style="font-size:0.72rem;color:var(--grey);">Assets Under Mgmt</div>
          </div>
          <div style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);border-radius:var(--radius);padding:16px;text-align:center;">
            <div style="font-family:var(--font-display);font-size:1.6rem;font-weight:800;color:var(--gold);">47</div>
            <div style="font-size:0.72rem;color:var(--grey);">Active Investors</div>
          </div>
          <div style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);border-radius:var(--radius);padding:16px;text-align:center;">
            <div style="font-family:var(--font-display);font-size:1.6rem;font-weight:800;color:var(--gold);">$250K</div>
            <div style="font-size:0.72rem;color:var(--grey);">Min. Investment</div>
          </div>
        </div>
        <a href="contact.html" class="btn-gold"><i class="fas fa-paper-plane"></i> Become an Investor</a>
      </div>
    </div>

    <div class="divider-gold"></div>

    <!-- Services Grid: Tech, Energy, Healthcare -->
    <div class="row g-4 anim-fade-up">
      <div class="col-12 mb-4">
        <div class="section-label">04–06 / More Verticals</div>
        <h2 class="section-title">Additional <span>Business Lines</span></h2>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="service-card card-3d" style="height:100%;">
          <div class="service-icon-wrap"><i class="fas fa-microchip"></i></div>
          <h3 class="service-card-title">Technology Ventures</h3>
          <p class="service-card-desc">Incubating and scaling technology companies across AI, fintech, proptech, and digital infrastructure. DomaTech portfolio companies serve 1M+ users.</p>
          <ul style="list-style:none;padding:0;margin-bottom:20px;">
            <li style="font-size:0.8rem;color:rgba(255,255,255,0.65);padding:6px 0;border-bottom:1px solid rgba(255,255,255,0.05);display:flex;align-items:center;gap:8px;"><i class="fas fa-arrow-right" style="color:var(--gold);font-size:0.65rem;"></i>AI & Machine Learning Applications</li>
            <li style="font-size:0.8rem;color:rgba(255,255,255,0.65);padding:6px 0;border-bottom:1px solid rgba(255,255,255,0.05);display:flex;align-items:center;gap:8px;"><i class="fas fa-arrow-right" style="color:var(--gold);font-size:0.65rem;"></i>PropTech & Smart Building Platforms</li>
            <li style="font-size:0.8rem;color:rgba(255,255,255,0.65);padding:6px 0;display:flex;align-items:center;gap:8px;"><i class="fas fa-arrow-right" style="color:var(--gold);font-size:0.65rem;"></i>B2B Fintech & Investment Tools</li>
          </ul>
          <a href="contact.html" class="btn-gold" style="display:inline-flex;width:100%;justify-content:center;font-size:0.82rem;padding:11px 20px;"><i class="fas fa-paper-plane"></i> Learn More</a>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="service-card card-3d" style="height:100%;">
          <div class="service-icon-wrap"><i class="fas fa-solar-panel"></i></div>
          <h3 class="service-card-title">Energy & Sustainability</h3>
          <p class="service-card-desc">Renewable energy projects, utility grid solutions, and sustainable energy management platforms targeting net-zero by 2035 across all Doma assets.</p>
          <ul style="list-style:none;padding:0;margin-bottom:20px;">
            <li style="font-size:0.8rem;color:rgba(255,255,255,0.65);padding:6px 0;border-bottom:1px solid rgba(255,255,255,0.05);display:flex;align-items:center;gap:8px;"><i class="fas fa-arrow-right" style="color:var(--gold);font-size:0.65rem;"></i>Utility-Scale Solar & Wind Farms</li>
            <li style="font-size:0.8rem;color:rgba(255,255,255,0.65);padding:6px 0;border-bottom:1px solid rgba(255,255,255,0.05);display:flex;align-items:center;gap:8px;"><i class="fas fa-arrow-right" style="color:var(--gold);font-size:0.65rem;"></i>Green Hydrogen Production</li>
            <li style="font-size:0.8rem;color:rgba(255,255,255,0.65);padding:6px 0;display:flex;align-items:center;gap:8px;"><i class="fas fa-arrow-right" style="color:var(--gold);font-size:0.65rem;"></i>Energy Storage & Grid Solutions</li>
          </ul>
          <a href="contact.html" class="btn-gold" style="display:inline-flex;width:100%;justify-content:center;font-size:0.82rem;padding:11px 20px;"><i class="fas fa-paper-plane"></i> Learn More</a>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="service-card card-3d" style="height:100%;">
          <div class="service-icon-wrap"><i class="fas fa-hospital"></i></div>
          <h3 class="service-card-title">Healthcare & Wellness</h3>
          <p class="service-card-desc">World-class hospital networks, wellness centers, and digital health platforms transforming patient care across the MENA region and beyond.</p>
          <ul style="list-style:none;padding:0;margin-bottom:20px;">
            <li style="font-size:0.8rem;color:rgba(255,255,255,0.65);padding:6px 0;border-bottom:1px solid rgba(255,255,255,0.05);display:flex;align-items:center;gap:8px;"><i class="fas fa-arrow-right" style="color:var(--gold);font-size:0.65rem;"></i>Multi-Specialty Hospital Networks</li>
            <li style="font-size:0.8rem;color:rgba(255,255,255,0.65);padding:6px 0;border-bottom:1px solid rgba(255,255,255,0.05);display:flex;align-items:center;gap:8px;"><i class="fas fa-arrow-right" style="color:var(--gold);font-size:0.65rem;"></i>Digital Health & Telemedicine</li>
            <li style="font-size:0.8rem;color:rgba(255,255,255,0.65);padding:6px 0;display:flex;align-items:center;gap:8px;"><i class="fas fa-arrow-right" style="color:var(--gold);font-size:0.65rem;"></i>Wellness & Medical Tourism Facilities</li>
          </ul>
          <a href="contact.html" class="btn-gold" style="display:inline-flex;width:100%;justify-content:center;font-size:0.82rem;padding:11px 20px;"><i class="fas fa-paper-plane"></i> Learn More</a>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- CTA SECTION -->
<section class="cta-section">
  <div class="cta-bg"></div>
  <div class="particles-bg"></div>
  <div class="cta-glow"></div>
  <div class="container position-relative" style="z-index:2;">
    <div class="cta-content anim-fade-up">
      <div class="section-label" style="justify-content:center;">Work With Us</div>
      <h2 class="cta-title">Ready to Partner with <span style="color:var(--gold);">Doma?</span></h2>
      <p class="cta-desc">Whether you need a development partner, investment opportunity, or infrastructure expert — our team is ready to deliver exceptional results.</p>
      <div class="cta-actions">
        <a href="contact.html" class="btn-gold"><i class="fas fa-paper-plane"></i> Start a Conversation</a>
        <a href="about.html"   class="btn-outline"><i class="fas fa-users"></i> Meet Our Team</a>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="doma-footer">
  <div class="footer-main"><div class="container"><div class="row g-5">
    <div class="col-lg-4 col-md-6">
      <div class="footer-brand">
       <div class="" style="width: 100px; height: 40px;">
        <img src="assets/images/doma.png" alt="" class="img-fluid" width="100%" >
      </div>
        <p>A diversified holding group delivering excellence across real estate, infrastructure, technology, and investment since 2008.</p>
        <div class="footer-social">
          <a href="#" class="social-link-btn"><i class="fab fa-linkedin-in"></i></a>
          <a href="#" class="social-link-btn"><i class="fab fa-twitter"></i></a>
          <a href="#" class="social-link-btn"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social-link-btn"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
    <div class="col-lg-2 col-md-6 col-6">
      <div class="footer-heading">Company</div>
      <ul class="footer-links">
        <li><a href="about.html"    class="footer-link"><i class="fas fa-chevron-right"></i> About Us</a></li>
        <li><a href="projects.html" class="footer-link"><i class="fas fa-chevron-right"></i> Projects</a></li>
        <li><a href="services.html" class="footer-link"><i class="fas fa-chevron-right"></i> Services</a></li>
        <li><a href="blog.html"     class="footer-link"><i class="fas fa-chevron-right"></i> Blog</a></li>
        <li><a href="contact.html"  class="footer-link"><i class="fas fa-chevron-right"></i> Contact</a></li>
      </ul>
    </div>
    <div class="col-lg-2 col-md-6 col-6">
      <div class="footer-heading">Services</div>
      <ul class="footer-links">
        <li><a href="services.html" class="footer-link"><i class="fas fa-chevron-right"></i> Real Estate</a></li>
        <li><a href="services.html" class="footer-link"><i class="fas fa-chevron-right"></i> Infrastructure</a></li>
        <li><a href="services.html" class="footer-link"><i class="fas fa-chevron-right"></i> Investment</a></li>
        <li><a href="services.html" class="footer-link"><i class="fas fa-chevron-right"></i> Technology</a></li>
        <li><a href="services.html" class="footer-link"><i class="fas fa-chevron-right"></i> Energy</a></li>
      </ul>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="footer-heading">Newsletter</div>
      <p style="font-size:.82rem;color:var(--grey);margin-bottom:6px;">Stay updated with latest projects and investment opportunities.</p>
      <form class="newsletter-form" novalidate>
        <div class="newsletter-input-wrap">
          <input type="email" class="newsletter-input" placeholder="Your email address" required/>
          <button type="submit" class="newsletter-btn">Subscribe</button>
        </div>
      </form>
    </div>
  </div></div></div>
  <div class="container">
    <div class="footer-bottom">
      <div class="footer-bottom-text">© 2025 <span>Doma Holding Company</span>. All rights reserved. Crafted with precision.</div>
      <div style="display:flex;gap:20px;flex-wrap:wrap;">
        <a href="#" style="font-size:.75rem;color:rgba(155,155,155,.5);">Privacy Policy</a>
        <a href="#" style="font-size:.75rem;color:rgba(155,155,155,.5);">Terms of Service</a>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
