<?php get_header(); 
// Template Name: Home Template
?>




<!-- ═══════════════════════════════════════════════════════
     HERO VIDEO SLIDER
═════════════════════════════════════════════════════════════════ -->
<section id="heroSection">

  <!-- particles -->
  <div class="hs-pts" id="hsPts"></div>

  <!-- transition overlay -->
  <div class="hs-t-ov" id="hsTOv"></div>

  <!-- corner deco -->
  <div class="hs-c-tl"></div>
  <div class="hs-c-br"></div>

  <!-- slide category label -->
  <div class="hs-label" id="hsLabel">Real Estate</div>

  <!-- ══ SLIDE 1 — Real Estate ══ -->
 <?php
$slides = new WP_Query(array(
    'post_type'      => 'hero_slider',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC'
));

$count = 0;

if($slides->have_posts()) :

while($slides->have_posts()) :
$slides->the_post();

$image_id  = get_post_meta(get_the_ID(), '_bg_image', true);
$image_url = wp_get_attachment_image_url($image_id, 'full');

$subtitle  = get_post_meta(get_the_ID(), '_subtitle', true);
$title1    = get_post_meta(get_the_ID(), '_title1', true);
$highlight = get_post_meta(get_the_ID(), '_highlight', true);
$desc      = get_post_meta(get_the_ID(), '_desc', true);

$btn1_text = get_post_meta(get_the_ID(), '_btn1_text', true);
$btn1_url  = get_post_meta(get_the_ID(), '_btn1_url', true);

$btn2_text = get_post_meta(get_the_ID(), '_btn2_text', true);
$btn2_url  = get_post_meta(get_the_ID(), '_btn2_url', true);
?>

<div class="hs <?php echo ($count === 0) ? 'active' : ''; ?>" id="hs<?php echo $count; ?>">

    <div class="hs-bg">
        <?php if($image_url) : ?>
            <img
                src="<?php echo esc_url($image_url); ?>"
                alt="<?php the_title_attribute(); ?>"
                loading="<?php echo ($count === 0) ? 'eager' : 'lazy'; ?>"
            >
        <?php endif; ?>
    </div>

    <div class="hs-ov"></div>

    <div class="hs-deco"></div>

    <div class="hs-body">

        <div class="container">

            <div class="hs-inner">

                <?php if($subtitle) : ?>
                <div class="hs-eye">
                    <i class="fas fa-star"></i>
                    <?php echo esc_html($subtitle); ?>
                </div>
                <?php endif; ?>

                <h1 class="hs-title">
                    <?php echo esc_html($title1); ?>

                    <?php if($highlight) : ?>
                        <span class="gw"><?php echo esc_html($highlight); ?></span>
                    <?php endif; ?>
                </h1>

                <?php if($desc) : ?>
                <p class="hs-desc">
                    <?php echo esc_html($desc); ?>
                </p>
                <?php endif; ?>

                <div class="hs-btns">

                    <?php if($btn1_text && $btn1_url) : ?>
                        <a href="<?php echo esc_url($btn1_url); ?>" class="btn-gold">
                            <i class="fas fa-th-large"></i>
                            <?php echo esc_html($btn1_text); ?>
                        </a>
                    <?php endif; ?>

                    <?php if($btn2_text && $btn2_url) : ?>
                        <a href="<?php echo esc_url($btn2_url); ?>" class="btn-ohl">
                            <i class="fas fa-play-circle"></i>
                            <?php echo esc_html($btn2_text); ?>
                        </a>
                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</div>

<?php
$count++;
endwhile;

wp_reset_postdata();

endif;
?>

  <!-- ══ SLIDE 2 — Infrastructure ══ -->
  <div class="hs" id="hs1">
    <div class="hs-bg">
      <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1800&q=80"
           alt="Infrastructure" loading="lazy"/>
    </div>
    <div class="hs-ov"></div>
    <div class="hs-deco"></div>
    <div class="hs-body">
      <div class="container">
        <div class="hs-inner">
          <div class="hs-eye"><i class="fas fa-hard-hat"></i> Infrastructure Excellence</div>
          <h1 class="hs-title">
            Engineering the <span class="gw">Future's</span><br>
            <span class="ow">Foundation</span>
          </h1>
          <p class="hs-desc">68km expressways, smart bridges, and urban utilities — built with engineering precision and delivered ahead of schedule across the MENA region.</p>
          <div class="hs-btns">
            <a href="projects.html" class="btn-gold"><i class="fas fa-road"></i> View Infrastructure</a>
            <a href="contact.html"  class="btn-ohl"><i class="fas fa-handshake"></i> Partner With Us</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ══ SLIDE 3 — Technology ══ -->
  <div class="hs" id="hs2">
    <div class="hs-bg">
      <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=1800&q=80"
           alt="Technology" loading="lazy"/>
    </div>
    <div class="hs-ov"></div>
    <div class="hs-deco"></div>
    <div class="hs-body">
      <div class="container">
        <div class="hs-inner">
          <div class="hs-eye"><i class="fas fa-microchip"></i> Technology Ventures</div>
          <h1 class="hs-title">
            Innovating at the <span class="gw">Speed</span><br>
            of <span class="ow">Tomorrow</span>
          </h1>
          <p class="hs-desc">DomaTech incubates AI, PropTech, and FinTech ventures transforming how the region builds, transacts, and connects at scale.</p>
          <div class="hs-btns">
            <a href="services.html" class="btn-gold"><i class="fas fa-rocket"></i> Tech Ventures</a>
            <a href="projects.html" class="btn-ohl"><i class="fas fa-th-large"></i> Our Portfolio</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ══ SLIDE 4 — Energy ══ -->
  <div class="hs" id="hs3">
    <div class="hs-bg">
      <img src="https://images.unsplash.com/photo-1509391366360-2e959784a276?w=1800&q=80"
           alt="Energy & Sustainability" loading="lazy"/>
    </div>
    <div class="hs-ov"></div>
    <div class="hs-deco"></div>
    <div class="hs-body">
      <div class="container">
        <div class="hs-inner">
          <div class="hs-eye"><i class="fas fa-solar-panel"></i> Energy &amp; Sustainability</div>
          <h1 class="hs-title">
            Powering a <span class="gw">Cleaner</span><br>
            <span class="ow">Tomorrow</span>
          </h1>
          <p class="hs-desc">500MW solar farms, green hydrogen plants, and net-zero commitments driving Doma's sustainable future across MENA.</p>
          <div class="hs-btns">
            <a href="services.html" class="btn-gold"><i class="fas fa-leaf"></i> ESG Strategy</a>
            <a href="contact.html"  class="btn-ohl"><i class="fas fa-dollar-sign"></i> Invest With Us</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- arrows -->
  <button class="hs-arr" id="hsPrev" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>
  <button class="hs-arr" id="hsNext" aria-label="Next"><i class="fas fa-chevron-right"></i></button>

  <!-- dots -->
  <div class="hs-dots" id="hsDots">
    <div class="hs-dot active" data-i="0"></div>
    <div class="hs-dot"        data-i="1"></div>
    <div class="hs-dot"        data-i="2"></div>
    <div class="hs-dot"        data-i="3"></div>
  </div>

  <!-- counter -->
  <div class="hs-ctr" id="hsCtr"><span>01</span> / 04</div>

  <!-- progress -->
  <div class="hs-prog"><div class="hs-prog-bar" id="hsBar"></div></div>

  <!-- scroll indicator -->




</section>


<!-- ═══════════════════════════════════════════════════════
     PARTNERS MARQUEE
═══════════════════════════════════════════════════════ -->

<!-- ═══════════════════════════════════════════════════════
     COMPANY INTRO
═══════════════════════════════════════════════════════ -->
<?php
$label          = get_theme_mod('about_label');
$title          = get_theme_mod('about_title');
$highlight      = get_theme_mod('about_highlight');
$subtitle       = get_theme_mod('about_subtitle');
$description    = get_theme_mod('about_description');

$main_image     = get_theme_mod('about_main_image');
$overlay_image  = get_theme_mod('about_overlay_image');

$badge_number   = get_theme_mod('about_years_number');
$badge_text     = get_theme_mod('about_years_text');

$award_title    = get_theme_mod('about_award_title');
$award_subtitle = get_theme_mod('about_award_subtitle');

$btn1_text      = get_theme_mod('about_btn1_text');
$btn1_url       = get_theme_mod('about_btn1_url');

$btn2_text      = get_theme_mod('about_btn2_text');
$btn2_url       = get_theme_mod('about_btn2_url');
?>

<section class="intro-section section-pad" style="position:relative;overflow:hidden;">

    <div class="geo-blob blob-navy"
         style="width:500px;height:500px;top:-100px;left:-150px;opacity:.3;position:absolute;z-index:0;">
    </div>

    <div class="container position-relative">

        <div class="intro-grid">

            <!-- LEFT SIDE -->
            <div class="reveal-left float-anim-slow">

                <div class="intro-img-wrap">

                    <div style="width:100%;height:460px;background:linear-gradient(135deg,#1e2f3d,#304A61,rgba(188,132,43,.12));border-radius:20px;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;">

                        <div class="particles-bg"></div>
                        <div class="grid-pattern" style="opacity:.4;"></div>

                        <?php if($main_image): ?>
                            <img src="<?php echo esc_url($main_image); ?>"
                                 class="img-fluid w-100 h-100"
                                 style="object-fit:cover;">
                        <?php endif; ?>

                    </div>

                    <?php if($overlay_image): ?>
                    <div class="intro-img-overlay">
                        <img src="<?php echo esc_url($overlay_image); ?>"
                             alt=""
                             class="img-fluid">
                    </div>
                    <?php endif; ?>

                    <div class="intro-badge-float glow-anim">

                        <span class="badge-num">
                            <?php echo esc_html($badge_number); ?>
                        </span>

                        <span class="badge-txt">
                            <?php echo esc_html($badge_text); ?>
                        </span>

                    </div>

                    <div class="intro-card-float float-anim">

                        <i class="fas fa-trophy"></i>

                        <div>

                            <div style="font-size:.8rem;font-weight:700;">
                                <?php echo esc_html($award_title); ?>
                            </div>

                            <div style="font-size:.7rem;color:var(--grey);">
                                <?php echo esc_html($award_subtitle); ?>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="reveal-right">

                <div class="section-label">
                    <?php echo esc_html($label); ?>
                </div>

                <h2 class="section-title">

                    <?php echo nl2br(esc_html($title)); ?>

                    <span>
                        <?php echo esc_html($highlight); ?>
                    </span>

                </h2>

                <div class="gold-line"></div>

                <p class="section-subtitle">
                    <?php echo esc_html($subtitle); ?>
                </p>

                <p style="font-size:.88rem;color:var(--grey);line-height:1.85;margin:18px 0 32px;">
                    <?php echo esc_html($description); ?>
                </p>

                <!-- FEATURES -->
                <div class="intro-features">

                    <?php

                    $features = new WP_Query(array(
                        'post_type'      => 'about_feature',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',
                        'orderby'        => 'menu_order',
                        'order'          => 'ASC'
                    ));

                    while($features->have_posts()) :
                    $features->the_post();

                    $icon = get_post_meta(get_the_ID(),'_feature_icon',true);
                    ?>

                    <div class="feature-item hover-lift">

                        <div class="feature-icon">
                            <i class="<?php echo esc_attr($icon); ?>"></i>
                        </div>

                        <div>

                            <div class="feature-title">
                                <?php the_title(); ?>
                            </div>

                            <div class="feature-text">
                                <?php echo esc_html(get_the_content()); ?>
                            </div>

                        </div>

                    </div>

                    <?php endwhile; wp_reset_postdata(); ?>

                </div>

                <!-- BUTTONS -->
                <div style="margin-top:32px;display:flex;gap:14px;flex-wrap:wrap;">

                    <?php if($btn1_text && $btn1_url): ?>
                    <a href="<?php echo esc_url($btn1_url); ?>"
                       class="btn-gold btn-ripple">
                        <i class="fas fa-arrow-right"></i>
                        <?php echo esc_html($btn1_text); ?>
                    </a>
                    <?php endif; ?>

                    <?php if($btn2_text && $btn2_url): ?>
                    <a href="<?php echo esc_url($btn2_url); ?>"
                       class="btn-outline">
                        <i class="fas fa-phone-alt"></i>
                        <?php echo esc_html($btn2_text); ?>
                    </a>
                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- ═══════════════════════════════════════════════════════
     FEATURED PROJECTS
═══════════════════════════════════════════════════════ -->
<section class="projects-section section-pad" style="background:var(--bg-section);position:relative;overflow:hidden;">
  <div class="grid-pattern"></div>
  <div class="geo-blob blob-gold" style="width:400px;height:400px;top:50px;right:-80px;position:absolute;z-index:0;"></div>
  <div class="container position-relative">
   <div class="projects-header">

    <div>

        <div class="section-label reveal">
            <?php echo esc_html(get_theme_mod('doma_projects_label', 'Featured Projects')); ?>
        </div>

        <h2 class="section-title reveal delay-200">
            <?php echo esc_html(get_theme_mod('doma_projects_title', 'Our')); ?>

            <span>
                <?php echo esc_html(get_theme_mod('doma_projects_highlight', 'Landmark')); ?>
            </span>

            <?php echo esc_html(get_theme_mod('doma_projects_title_last', 'Ventures')); ?>
        </h2>

    </div>

    <a href="<?php echo esc_url(get_theme_mod('doma_projects_btn_url', '#')); ?>"
       class="btn-outline reveal delay-400">

        <?php echo esc_html(get_theme_mod('doma_projects_btn_text', 'View All')); ?>

        <i class="fas fa-arrow-right"></i>

    </a>

</div>

    
   <div class="row">

            <?php
            $args = array(
                'post_type'      => 'doma_project',
                'post_status'    => 'publish',
                'posts_per_page' => 6,
                'orderby'        => 'date',
                'order'          => 'DESC'
            );

            $projects = new WP_Query($args);

            if ($projects->have_posts()) :

                while ($projects->have_posts()) :
                    $projects->the_post();

                    $status      = get_post_meta(get_the_ID(), '_doma_status', true);
                    $completion  = get_post_meta(get_the_ID(), '_doma_completion', true);
                    $location    = get_post_meta(get_the_ID(), '_doma_location', true);
                    $short_desc  = get_post_meta(get_the_ID(), '_doma_short_desc', true);

                    $terms = get_the_terms(get_the_ID(), 'project_category');
                    $category = (!empty($terms) && !is_wp_error($terms))
                        ? $terms[0]->name
                        : 'Project';

                    $image = get_the_post_thumbnail_url(get_the_ID(), 'large');

                    if (!$image) {
                        $image = get_template_directory_uri() . '/assets/images/default-project.jpg';
                    }

                    switch ($status) {

                        case 'completed':
                            $status_class = 'badge-completed';
                            $status_label = 'Completed';
                            break;

                        case 'upcoming':
                            $status_class = 'badge-upcoming';
                            $status_label = 'Upcoming';
                            break;

                        case 'on-hold':
                            $status_class = 'badge-hold';
                            $status_label = 'On Hold';
                            break;

                        default:
                            $status_class = 'badge-ongoing';
                            $status_label = 'Ongoing';
                            break;
                    }
            ?>

            <div class="col-lg-4 col-md-6">
                <div class="project-card card-3d reveal delay-200">

                    <div class="project-card-img">

                            <a href="<?php the_permalink(); ?>">

        <img src="<?php echo esc_url($image); ?>"
             alt="<?php the_title_attribute(); ?>"
             class="img-fluid w-100">

    </a>

                        <div class="project-card-status">
                            <span class="badge-status <?php echo esc_attr($status_class); ?>">
                                <?php echo esc_html($status_label); ?>
                            </span>
                        </div>

                    </div>

                    <div class="project-card-body">

                        <div class="project-industry">
                            <?php echo esc_html($category); ?>
                        </div>

                        <h3 class="project-card-title">
                            <?php the_title(); ?>
                        </h3>

                        <p class="project-card-desc">
                            <?php echo esc_html(wp_trim_words($short_desc, 20)); ?>
                        </p>

                        <div class="project-progress-row">
                            <span class="progress-label">Completion</span>
                            <span class="progress-pct">
                                <?php echo intval($completion); ?>%
                            </span>
                        </div>

                        <div class="progress-wrap">
                            <div class="progress-fill"
                                 style="width:<?php echo intval($completion); ?>%;">
                            </div>
                        </div>

                        <div class="project-meta-row">

                            <div class="project-location">
                                <i class="fas fa-map-marker-alt"></i>
                                <?php echo esc_html($location); ?>
                            </div>

                            <a href="<?php the_permalink(); ?>"
                               class="project-arrow-btn">
                                <i class="fas fa-arrow-right"></i>
                            </a>

                        </div>

                    </div>

                </div>
            </div>

            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>

        </div>

  </div>
</section>





<!-- ═══════════════════════════════════════════════════════
     SERVICES
═══════════════════════════════════════════════════════ -->
<section class="services-section section-pad">
  <div class="container">
    <div class="row align-items-end mb-5">
     <div class="col-lg-6 reveal">

    <div class="section-label">
        <?php echo esc_html(get_theme_mod('service_label', 'What We Do')); ?>
    </div>

    <h2 class="section-title">

        <?php echo esc_html(get_theme_mod('service_title', 'Our Core Services')); ?>

        <span>
            <?php echo esc_html(get_theme_mod('service_highlight', 'Business Verticals')); ?>
        </span>

    </h2>

</div>

<div class="col-lg-6 text-lg-end reveal delay-300">

    <a href="<?php echo esc_url(get_theme_mod('service_btn_url', '#')); ?>"
       class="btn-outline">

        <?php echo esc_html(get_theme_mod('service_btn_text', 'All Services')); ?>

        <i class="fas fa-arrow-right"></i>

    </a>

</div>
    </div>
    <div class="row g-4">
   <?php

$args = array(
    'post_type'      => 'service',
    'posts_per_page' => 6,
    'orderby'        => 'menu_order',
    'order'          => 'ASC'
);

$services = new WP_Query($args);

if($services->have_posts()) :

while($services->have_posts()) :
$services->the_post();

$icon = get_post_meta(get_the_ID(), '_service_icon', true);

$short_desc = get_post_meta(
    get_the_ID(),
    '_service_short_desc',
    true
);

?>

<div class="col-lg-4 col-md-6">

    <div class="service-card card-3d reveal delay-100">

        <div class="service-icon-wrap">

            <?php if($icon) : ?>

                <i class="<?php echo esc_attr($icon); ?>"></i>

            <?php else : ?>

                <i class="fas fa-briefcase"></i>

            <?php endif; ?>

        </div>

        <h3 class="service-card-title">
            <?php the_title(); ?>
        </h3>

        <p class="service-card-desc">

            <?php
            echo wp_trim_words(
                $short_desc,
                18,
                '...'
            );
            ?>

        </p>

        <a href="<?php the_permalink(); ?>"
           class="service-learn-more">

            Learn More

            <i class="fas fa-arrow-right"></i>

        </a>

    </div>

</div>

<?php

endwhile;
wp_reset_postdata();

endif;

?>

    <div class="col-lg-4 col-md-6">
      <div class="service-card card-3d reveal delay-200">
        <div class="service-icon-wrap">
          <i class="fas fa-hard-hat"></i>
        </div>
        <h3 class="service-card-title">Infrastructure & Engineering</h3>
        <p class="service-card-desc">Large-scale civil projects, bridges, highways, and smart city utilities with engineering precision.</p>
        <a href="services.html" class="service-learn-more">Learn More <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="service-card card-3d reveal delay-300">
        <div class="service-icon-wrap">
          <i class="fas fa-chart-line"></i>
        </div>
        <h3 class="service-card-title">Investment Management</h3>
        <p class="service-card-desc">Strategic capital allocation, private equity, venture building, and portfolio optimization.</p>
        <a href="services.html" class="service-learn-more">Learn More <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="service-card card-3d reveal delay-100">
        <div class="service-icon-wrap">
          <i class="fas fa-microchip"></i>
        </div>
        <h3 class="service-card-title">Technology Ventures</h3>
        <p class="service-card-desc">Incubating AI, fintech, proptech, and digital infrastructure companies at scale.</p>
        <a href="services.html" class="service-learn-more">Learn More <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="service-card card-3d reveal delay-200">
        <div class="service-icon-wrap">
          <i class="fas fa-solar-panel"></i>
        </div>
        <h3 class="service-card-title">Energy & Utilities</h3>
        <p class="service-card-desc">Renewable energy projects, utility grid solutions, and sustainable energy management.</p>
        <a href="services.html" class="service-learn-more">Learn More <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="service-card card-3d reveal delay-300">
        <div class="service-icon-wrap">
          <i class="fas fa-hospital"></i>
        </div>
        <h3 class="service-card-title">Healthcare & Wellness</h3>
        <p class="service-card-desc">Hospital networks, wellness centers, and digital health platforms transforming patient care.</p>
        <a href="services.html" class="service-learn-more">Learn More <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>


  </div>
</section>

<!-- land mark section -->


<!-- ═══════════════════════════════════════════════════
     ① IMAGE GALLERY SECTION
═══════════════════════════════════════════════════ -->
<!-- ═══════════════════════════════════════════════════
     ① IMAGE GALLERY SECTION
═══════════════════════════════════════════════════ -->
<section id="gallerySection">
  <div class="container position-relative">

    <!-- header -->
    <div class="row align-items-end mb-2 reveal">
  <div class="col-lg-7">

    <div class="section-tag">
        <i class="fas fa-images"></i>

        <?php echo esc_html(
            get_theme_mod(
                'gallery_tag',
                'Our Portfolio Gallery'
            )
        ); ?>

    </div>

    <div class="gold-rule"></div>

    <h2 class="section-title">

        <?php echo esc_html(
            get_theme_mod(
                'gallery_title',
                'Capturing'
            )
        ); ?>

        <span>

            <?php echo esc_html(
                get_theme_mod(
                    'gallery_highlight',
                    'Excellence'
                )
            ); ?>

        </span>

        <br>

        Across Every Venture

    </h2>

    <p class="section-sub">

        <?php echo esc_html(
            get_theme_mod(
                'gallery_description',
                'From landmark towers to smart infrastructure — a visual journey through Doma Holdings world-class projects and milestones.'
            )
        ); ?>

    </p>

</div>
      <div class="col-lg-5 d-none d-lg-flex justify-content-end align-items-center gap-3 pb-2">
        <span style="font-family:var(--font-body);font-size:13px;color:var(--grey);">
          <span id="visibleCount"></span>  <span id="totalCount">

          </span> 
        </span>
      </div>
    </div>

    <!-- filter tabs -->
    <div class="gallery-filters reveal" style="animation-delay:.1s">
  
    </div>

    <!-- masonry grid -->
    <div class="gallery-grid" id="galleryGrid">
      <!-- Real Estate -->
     <?php

$args = array(
    'post_type'      => 'project_gallery',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC'
);

$gallery = new WP_Query($args);

if($gallery->have_posts()) :

while($gallery->have_posts()) :
$gallery->the_post();

$category = get_post_meta(
    get_the_ID(),
    '_project_category',
    true
);

$cat_slug = get_post_meta(
    get_the_ID(),
    '_project_cat_slug',
    true
);

$thumb_id = get_post_thumbnail_id();

$thumb = wp_get_attachment_image_url(
    $thumb_id,
    'large'
);

?>

<div class="gallery-item reveal"
     data-cat="<?php echo esc_attr($cat_slug); ?>"
     data-title="<?php the_title(); ?>"
     data-src="<?php echo esc_url($thumb); ?>">

    <img src="<?php echo esc_url($thumb); ?>"
         alt="<?php the_title_attribute(); ?>" />

    <div class="gi-zoom">
        <i class="fas fa-expand-alt"></i>
    </div>

    <div class="gi-ov">

        <div class="gi-cat">
            <?php echo esc_html($category); ?>
        </div>

        <div class="gi-title">
            <?php the_title(); ?>
        </div>

    </div>

</div>

<?php
endwhile;
wp_reset_postdata();
endif;
?>



    
    
    <!-- /gallery-grid -->

    <!-- load more -->
    <div class="load-more-wrap reveal "  id="loadMoreBtn">
   
    </div>

  </div><!-- /container -->
</section>

<!-- LIGHTBOX -->
<div class="lightbox" id="lightbox">
  <button class="lb-close" id="lbClose"><i class="fas fa-times"></i></button>
  <button class="lb-arrow lb-prev" id="lbPrev"><i class="fas fa-chevron-left"></i></button>
  <button class="lb-arrow lb-next" id="lbNext"><i class="fas fa-chevron-right"></i></button>
  <div class="lb-inner">
    <img id="lbImg" src="" alt=""/>
    <div class="lb-caption">
      <div class="lb-cat" id="lbCat"></div>
      <div class="lb-ttl" id="lbTtl"></div>
    </div>
  </div>
  <div class="lb-counter"><span id="lbCurr">1</span> / <span id="lbTotal">1</span></div>
</div>


    <!-- ══ GALLERY end ══ -->

<!-- ═══════════════════════════════════════════════════════
     CLIENT REVIEWS SLIDER
═══════════════════════════════════════════════════════ -->

<section class="section-pad" style="background:var(--bg-section);position:relative;overflow:hidden;">
  <div class="geo-blob blob-navy" style="width:450px;height:450px;top:0;right:-60px;position:absolute;opacity:.35;z-index:0;"></div>
  <div class="geo-blob blob-gold" style="width:280px;height:280px;bottom:-40px;left:-50px;position:absolute;opacity:.18;z-index:0;"></div>
  <div class="grid-pattern"></div>
  <div class="container position-relative">
    <!-- Header row -->
<div class="row align-items-center mb-5">

    <div class="col-lg-7 reveal">

        <div class="section-label">
            <?php echo esc_html(get_theme_mod('testimonial_label', 'Client Reviews')); ?>
        </div>

        <h2 class="section-title">
            <?php echo esc_html(get_theme_mod('testimonial_title', 'What Our')); ?>
            <span>
                <?php echo esc_html(get_theme_mod('testimonial_title_highlight', 'Partners Say')); ?>
            </span>
        </h2>

        <p class="section-subtitle" style="max-width:480px;">
            <?php echo esc_html(get_theme_mod(
                'testimonial_subtitle',
                'Real feedback from investors, developers and business partners across 18+ countries.'
            )); ?>
        </p>

    </div>

    <div class="col-lg-5 reveal delay-200">

        <div style="display:flex;align-items:center;justify-content:flex-end;gap:16px;flex-wrap:wrap;">

            <!-- Rating Summary -->
            <div style="text-align:center;padding:16px 22px;background:rgba(255,255,255,.04);border:1px solid rgba(188,132,43,.2);border-radius:var(--radius);">

                <div style="font-family:var(--font-display);font-size:2.4rem;font-weight:800;color:var(--gold);line-height:1;">
                    <?php echo esc_html(get_theme_mod('testimonial_rating', '4.9')); ?>
                </div>

                <div style="display:flex;gap:3px;justify-content:center;margin:5px 0;color:var(--gold);font-size:.8rem;">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>

                <div style="font-size:.7rem;color:var(--grey);">
                    <?php echo esc_html(get_theme_mod('testimonial_review_count', 'Based on 240+ reviews')); ?>
                </div>

            </div>

            <!-- Arrow Buttons -->
            <div class="t-arrs">
                <button class="t-arr" id="tPrev" aria-label="Previous">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <button class="t-arr" id="tNext" aria-label="Next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

        </div>

    </div>

</div>
    <!-- Slider -->
    <div class="tslider-outer reveal delay-100">
      <div class="tslider-track" id="tTrack">
        <!-- Review 1 -->
       <?php

$args = array(
    'post_type'      => 'client_testimonial',
    'posts_per_page' => -1,
    'post_status'    => 'publish'
);

$query = new WP_Query($args);

if($query->have_posts()) :

while($query->have_posts()) :
$query->the_post();

$client_name = get_post_meta(get_the_ID(), '_client_name', true);
$client_role = get_post_meta(get_the_ID(), '_client_role', true);
$review_text = get_post_meta(get_the_ID(), '_review_text', true);
$review_star = get_post_meta(get_the_ID(), '_review_star', true);

/* Generate Initials */

$initials = '';

if (!empty($client_name)) {

    $words = explode(' ', trim($client_name));

    if(count($words) >= 2){

        $initials =
            strtoupper(substr($words[0],0,1)) .
            strtoupper(substr(end($words),0,1));

    }else{

        $initials = strtoupper(substr($client_name,0,2));

    }
}
?>

<div class="tslide">

    <div class="testimonial-card">

        <div class="testimonial-stars">

            <?php for($i=1; $i <= $review_star; $i++) : ?>
                <i class="fas fa-star"></i>
            <?php endfor; ?>

        </div>

        <span class="quote-mark">"</span>

        <p class="testimonial-text">
            <?php echo esc_html($review_text); ?>
        </p>

        <div class="testimonial-author">

            <div class="testimonial-avatar">
                <?php echo esc_html($initials); ?>
            </div>

            <div>

                <div class="testimonial-name">
                    <?php echo esc_html($client_name); ?>
                </div>

                <div class="testimonial-role">
                    <?php echo esc_html($client_role); ?>
                </div>

            </div>

        </div>

    </div>

</div>

<?php
endwhile;
wp_reset_postdata();

endif;
?>
      
      </div>
      <!-- /tTrack -->
    </div>
    <!-- Dots -->
    <div class="t-dots" id="tDots">
      <div class="t-dot active"></div>
      <div class="t-dot"></div>
      <div class="t-dot"></div>
      <div class="t-dot"></div>
      <div class="t-dot"></div>
      <div class="t-dot"></div>
    </div>
  </div>
</section>





<!-- ═══════════════════════════════════════════════════════
     CTA
═══════════════════════════════════════════════════════ -->
<section class="cta-section">
  <div class="cta-bg"></div>
  <div class="particles-bg"></div>
  <div class="cta-glow"></div>
  <div class="grid-pattern"></div>
  <div class="container position-relative" style="z-index:2;">

 <div class="cta-content reveal">

  <div class="section-label" style="justify-content:center;">
    <?php echo esc_html(get_theme_mod('cta_label', 'Ready to Start?')); ?>
  </div>

  <h2 class="cta-title">
    <?php echo wp_kses_post(get_theme_mod('cta_title', 'Partner with Doma and Build Your Future')); ?>
  </h2>

  <p class="cta-desc">
    <?php echo esc_html(get_theme_mod('cta_desc', 'Whether you\'re an investor seeking returns, a developer looking for a trusted partner, or a business needing strategic infrastructure — Doma has the expertise and network to deliver.')); ?>
  </p>

  <div class="cta-actions">

    <a href="<?php echo esc_url(get_theme_mod('cta_btn1_link', home_url('/contact'))); ?>" class="btn-gold btn-ripple">
      <i class="fas fa-paper-plane"></i>
      <?php echo esc_html(get_theme_mod('cta_btn1_text', 'Start a Conversation')); ?>
    </a>

    <a href="<?php echo esc_url(get_theme_mod('cta_btn2_link', home_url('/projects'))); ?>" class="btn-outline">
      <i class="fas fa-th-large"></i>
      <?php echo esc_html(get_theme_mod('cta_btn2_text', 'View Portfolio')); ?>
    </a>

  </div>

</div>


  </div>
</section>




<?php get_footer(); ?>

<?php wp_footer(); ?>


<!-- ═══ HERO SLIDER + TESTIMONIAL SLIDER (inline, no dependency) ═══ -->
<script>
(function(){"use strict";

/* ══════════════════════════════════════════
   HERO VIDEO SLIDER
══════════════════════════════════════════ */


/* ══════════════════════════════════════════
   TESTIMONIAL SLIDER
══════════════════════════════════════════ */
var track   = document.getElementById("tTrack");
var tDotsEl = document.querySelectorAll(".t-dot");
var tPrevEl = document.getElementById("tPrev");
var tNextEl = document.getElementById("tNext");
if(!track) return;

var tCards  = track.children.length;   /* total cards */
var tCur    = 0;
var tTimer  = null;
var tDUR    = 4500;

function tVisible(){
  var w = window.innerWidth;
  if(w <= 600)  return 1;
  if(w <= 991)  return 2;
  return 3;
}

function tMax(){ return Math.max(0, tCards - tVisible()); }

function tMove(idx){
  tCur = Math.max(0, Math.min(idx, tMax()));
  var shift = -(100 / tCards) * tCur;
  track.style.transform = "translateX("+shift+"%)";

  /* dots: map position to dot */
  var pages = tDots().length;
  tDotsEl.forEach(function(d,i){
    var step = tMax() / Math.max(pages-1, 1);
    var lo   = Math.round(i * step);
    var hi   = i === pages-1 ? tMax() : Math.round((i+1)*step)-1;
    d.classList.toggle("active", tCur>=lo && tCur<=hi);
  });
}

function tDots(){ return [].slice.call(tDotsEl); }

function tStart(){ tTimer = setInterval(function(){ tMove(tCur < tMax() ? tCur+1 : 0); }, tDUR); }
function tStop() { clearInterval(tTimer); }

tStart();
if(tPrevEl) tPrevEl.addEventListener("click", function(){ tStop(); tMove(tCur-1); tStart(); });
if(tNextEl) tNextEl.addEventListener("click", function(){ tStop(); tMove(tCur+1); tStart(); });

tDotsEl.forEach(function(d,i){
  d.addEventListener("click", function(){
    tStop();
    var step = tMax() / Math.max(tDotsEl.length-1, 1);
    tMove(Math.round(i*step));
    tStart();
  });
});

/* touch swipe */
var tSX = 0;
track.parentElement.addEventListener("touchstart", function(e){ tSX=e.touches[0].clientX; },{passive:true});
track.parentElement.addEventListener("touchend",   function(e){
  var dx=e.changedTouches[0].clientX-tSX;
  if(Math.abs(dx)>40){ tStop(); tMove(dx<0?tCur+1:tCur-1); tStart(); }
},{passive:true});

/* Re-calc on resize */
window.addEventListener("resize", function(){ if(tCur>tMax()) tCur=tMax(); tMove(tCur); });

})();
</script>



</body>
</html>
