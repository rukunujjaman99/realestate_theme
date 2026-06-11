<?php 
// Template Name: Services Page
get_header();
?>


<!-- PAGE HERO -->
<section class="page-hero">


<div class="page-hero-bg"></div>

<div class="grid-pattern"></div>

<div class="geo-blob blob-gold"
     style="width:500px;height:500px;top:-150px;left:-100px;position:absolute;z-index:1;">
</div>

<div class="container position-relative" style="z-index:2;">

    <div class="section-label" style="justify-content:center;">

        <?php echo esc_html(
            get_theme_mod(
                'services_hero_label',
                'What We Offer'
            )
        ); ?>

    </div>

    <h1 class="page-hero-title">

        <?php echo esc_html(
            get_theme_mod(
                'services_hero_title',
                'Our'
            )
        ); ?>

        <span style="color:var(--gold);">

            <?php echo esc_html(
                get_theme_mod(
                    'services_hero_highlight_title',
                    'Services'
                )
            ); ?>

        </span>

    </h1>

    <p style="color:var(--grey);
              margin-top:12px;
              font-size:0.9rem;
              max-width:520px;
              margin-left:auto;
              margin-right:auto;">

        <?php echo esc_html(
            get_theme_mod(
                'services_hero_description',
                'Six integrated business verticals engineered for compounding value across industries and geographies.'
            )
        ); ?>

    </p>

    <div class="page-breadcrumb">

        <a href="<?php echo esc_url(
            get_theme_mod(
                'services_hero_home_url',
                home_url('/')
            )
        ); ?>">

            <?php echo esc_html(
                get_theme_mod(
                    'services_hero_home_text',
                    'Home'
                )
            ); ?>

        </a>

        <i class="fas fa-chevron-right"></i>

        <span style="color:var(--gold);">

            <?php echo esc_html(
                get_theme_mod(
                    'services_hero_current_page',
                    'Services'
                )
            ); ?>

        </span>

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
<?php get_footer(); ?>

<?php wp_footer(); ?>
</body>
</html>
