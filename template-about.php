<?php get_header();
// Template Name: About Template
?>


<!-- PAGE HERO -->
<section class="page-hero">
  <div class="page-hero-bg"></div>
  <div class="grid-pattern"></div>
  <div class="geo-blob blob-gold" style="width:400px;height:400px;top:-100px;right:-80px;position:absolute;z-index:1;"></div>
  <div class="container position-relative" style="z-index:2;">
    <div class="section-label" style="justify-content:center;">Our Story</div>
    <h1 class="page-hero-title">About <span style="color:var(--gold);">Doma</span> Holding</h1>
    <div class="page-breadcrumb">
      <a href="index.html">Home</a>
      <i class="fas fa-chevron-right"></i>
      <span style="color:var(--gold);">About Us</span>
    </div>
  </div>
</section>





<?php
$post_id = doma_get_about_post_id();

if ( ! $post_id ) {
    return;
}
?>
<!-- MISSION & VISION -->
<section class="section-pad">
    <div class="container">
        <div class="row g-4 mb-5" data-tab-group>

            <div class="col-12 anim-fade-up">
                <div class="doma-tabs">
                    <button class="doma-tab-btn active" data-tab="mission">Mission</button>
                    <button class="doma-tab-btn" data-tab="vision">Vision</button>
                    <button class="doma-tab-btn" data-tab="values">Values</button>
                </div>
            </div>

            <div class="col-12 anim-fade-up anim-delay-1">

                <!-- =========================
                     MISSION
                ========================== -->
                <div data-tab-panel="mission" style="opacity:1;">

                    <div class="row align-items-center g-5">

                        <div class="col-lg-6">

                            <div class="section-label">
                                <?php echo esc_html(get_post_meta($post_id,'_mission_label',true)); ?>
                            </div>

                            <h2 class="section-title">
                                <?php echo doma_parse_span(
                                    get_post_meta($post_id,'_mission_title',true)
                                ); ?>
                            </h2>

                            <div class="gold-line"></div>

                            <p style="color:var(--grey);line-height:1.85;margin-bottom:20px;">
                                <?php echo nl2br(esc_html(
                                    get_post_meta($post_id,'_mission_para1',true)
                                )); ?>
                            </p>

                            <p style="color:var(--grey);line-height:1.85;">
                                <?php echo nl2br(esc_html(
                                    get_post_meta($post_id,'_mission_para2',true)
                                )); ?>
                            </p>

                        </div>

                        <div class="col-lg-6">

                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">

                                <?php for($i=1;$i<=4;$i++): ?>

                                    <div class="doma-card" style="padding:24px;text-align:center;">

                                        <i class="fas <?php echo esc_attr(
                                            get_post_meta($post_id,"_mission_card{$i}_icon",true)
                                        ); ?>"
                                           style="font-size:2rem;color:var(--gold);margin-bottom:12px;display:block;">
                                        </i>

                                        <div style="font-weight:700;margin-bottom:6px;">
                                            <?php echo esc_html(
                                                get_post_meta($post_id,"_mission_card{$i}_title",true)
                                            ); ?>
                                        </div>

                                        <div style="font-size:0.78rem;color:var(--grey);">
                                            <?php echo esc_html(
                                                get_post_meta($post_id,"_mission_card{$i}_desc",true)
                                            ); ?>
                                        </div>

                                    </div>

                                <?php endfor; ?>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- =========================
                     VISION
                ========================== -->
                <div data-tab-panel="vision" style="display:none;">

                    <div class="row align-items-center g-5">

                        <div class="col-lg-7">

                            <div class="section-label">
                                <?php echo esc_html(get_post_meta($post_id,'_vision_label',true)); ?>
                            </div>

                            <h2 class="section-title">
                                <?php echo doma_parse_span(
                                    get_post_meta($post_id,'_vision_title',true)
                                ); ?>
                            </h2>

                            <div class="gold-line"></div>

                            <p style="color:var(--grey);line-height:1.85;margin-bottom:20px;">
                                <?php echo nl2br(esc_html(
                                    get_post_meta($post_id,'_vision_para',true)
                                )); ?>
                            </p>

                            <ul style="list-style:none;padding:0;">

                                <?php for($i=1;$i<=4;$i++): 

                                    $check = get_post_meta(
                                        $post_id,
                                        "_vision_check{$i}",
                                        true
                                    );

                                    if(empty($check)) continue;
                                ?>

                                <li style="display:flex;align-items:flex-start;gap:12px;margin-bottom:14px;font-size:0.9rem;color:rgba(255,255,255,0.8);">
                                    <i class="fas fa-check-circle"
                                       style="color:var(--gold);margin-top:3px;flex-shrink:0;"></i>
                                    <?php echo esc_html($check); ?>
                                </li>

                                <?php endfor; ?>

                            </ul>

                        </div>

                        <div class="col-lg-5">

                            <div style="background:linear-gradient(135deg,var(--navy-dark),var(--bg-card));border:1px solid rgba(188,132,43,0.2);border-radius:20px;padding:36px;text-align:center;">

                                <i class="fas fa-eye"
                                   style="font-size:4rem;color:var(--gold);opacity:0.5;"></i>

                                <div style="font-family:var(--font-display);font-size:1.8rem;font-weight:800;color:var(--gold);margin:16px 0 8px;">
                                    <?php echo esc_html(
                                        get_post_meta($post_id,'_vision_year',true)
                                    ); ?>
                                </div>

                                <div style="font-size:0.9rem;color:var(--grey);">
                                    <?php echo esc_html(
                                        get_post_meta($post_id,'_vision_year_label',true)
                                    ); ?>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- =========================
                     VALUES
                ========================== -->
                <div data-tab-panel="values" style="display:none;">

                    <div class="section-label">
                        <?php echo esc_html(get_post_meta($post_id,'_values_label',true)); ?>
                    </div>

                    <h2 class="section-title">
                        <?php echo doma_parse_span(
                            get_post_meta($post_id,'_values_title',true)
                        ); ?>
                    </h2>

                    <div class="row g-4 mt-2">

                        <?php for($i=1;$i<=4;$i++): ?>

                        <div class="col-lg-3 col-md-6">

                            <div class="service-card" style="text-align:center;">

                                <div class="service-icon-wrap" style="margin:0 auto 18px;">
                                    <i class="fas <?php echo esc_attr(
                                        get_post_meta($post_id,"_values_card{$i}_icon",true)
                                    ); ?>"></i>
                                </div>

                                <h3 class="service-card-title">
                                    <?php echo esc_html(
                                        get_post_meta($post_id,"_values_card{$i}_title",true)
                                    ); ?>
                                </h3>

                                <p class="service-card-desc">
                                    <?php echo esc_html(
                                        get_post_meta($post_id,"_values_card{$i}_desc",true)
                                    ); ?>
                                </p>

                            </div>

                        </div>

                        <?php endfor; ?>

                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<!-- MISSION & VISION -->



<!-- ACHIEVEMENTS -->



<!-- LEADERSHIP TEAM -->
<section class="section-pad">
  <div class="container">
    <div class="text-center mb-5 anim-fade-up">
      <div class="section-label" style="justify-content:center;">Leadership</div>
      <h2 class="section-title">Meet the <span>Visionaries</span></h2>
      <p class="section-subtitle" style="margin:0 auto;text-align:center;">
        Our executive team brings together decades of expertise across finance, engineering, and technology.
      </p>
    </div>
    


   <?php
$team_query = new WP_Query(array(
    'post_type'      => 'team_member',
    'posts_per_page' => -1,
    'post_status'    => 'publish'
));

if($team_query->have_posts()) :

while($team_query->have_posts()) :
$team_query->the_post();

$name        = get_post_meta(get_the_ID(), '_team_name', true);
$role        = get_post_meta(get_the_ID(), '_team_role', true);
$bio         = get_post_meta(get_the_ID(), '_team_bio', true);
$description = get_post_meta(get_the_ID(), '_team_description', true);
$socials     = get_post_meta(get_the_ID(), '_team_socials', true);

$image = get_the_post_thumbnail_url(
    get_the_ID(),
    'full'
);
?>

<div class="row g-4 py-3 align-items-center">

    <!-- Team Image -->
    <div class="col-lg-4 col-md-4 anim-fade-up anim-delay-1">

        <div class="team-card card-3d">

            <div class="team-img-wrap">

                <div class="team-avatar-placeholder">

                    <?php if($image) : ?>

                        <img src="<?php echo esc_url($image); ?>"
                             alt="<?php echo esc_attr($name); ?>"
                             style="width:100%;height:400px;object-fit:cover;">

                    <?php endif; ?>

                </div>

            </div>

            <div class="team-card-body">

                <?php if(!empty($socials)) : ?>

                    <div class="team-socials">

                        <?php foreach($socials as $social) : ?>

                            <a href="<?php echo esc_url($social['url']); ?>"
                               target="_blank"
                               class="team-social-btn">

                                <i class="<?php echo esc_attr($social['icon']); ?>"></i>

                            </a>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

    <!-- Team Content -->
    <div class="col-lg-8 col-md-8 anim-fade-up anim-delay-2">

        <?php if($name) : ?>
            <div class="team-name">
                <?php echo esc_html($name); ?>
            </div>
        <?php endif; ?>

        <?php if($role) : ?>
            <div class="team-role">
                <?php echo esc_html($role); ?>
            </div>
        <?php endif; ?>

        <?php if($bio) : ?>
            <p class="team-bio">
                <?php echo esc_html($bio); ?>
            </p>
        <?php endif; ?>

        <?php if($description) : ?>
            <div class="content">
                <p>
                    <?php echo wp_kses_post(nl2br($description)); ?>
                </p>
            </div>
        <?php endif; ?>

    </div>

</div>

<?php
endwhile;
wp_reset_postdata();
endif;
?>
  
  </div>
</section>


<!-- GROWTH TIMELINE -->
<section class="section-pad" style="background:var(--bg-section);position:relative;overflow:hidden;">
  <div class="grid-pattern"></div>
  <div class="container position-relative">
    <div class="row g-5 align-items-start">
      <div class="col-lg-4 anim-fade-up">
        <div class="section-label">Growth Journey</div>
        <h2 class="section-title">15 Years of <span>Building Legacy</span></h2>
        <div class="gold-line"></div>
        <p style="color:var(--grey);line-height:1.8;">
          From a two-person office in Dubai to a multinational holding company with operations across three continents — our growth story is one of relentless vision and disciplined execution.
        </p>
        <a href="projects.html" class="btn-gold" style="margin-top:24px;">
          <i class="fas fa-th-large"> </i> View Our Projects
        </a>
      </div>
      <div class="col-lg-8 anim-fade-up anim-delay-2">
        <div class="timeline-wrap">
          <div class="timeline-item">
            <div class="timeline-dot"></div>
            <div class="timeline-year">2008 — Founded</div>
            <div class="timeline-title">The Beginning — Dubai, UAE</div>
            <p class="timeline-text">Doma Holding established with $12M seed capital and two founding partners. First project: a boutique residential complex in Business Bay.</p>
          </div>
          <div class="timeline-item">
            <div class="timeline-dot"></div>
            <div class="timeline-year">2011 — Regional Expansion</div>
            <div class="timeline-title">First Cross-Border Project</div>
            <p class="timeline-text">Expansion into Saudi Arabia with the North Ring Expressway contract — a landmark infrastructure win valued at $280M.</p>
          </div>
          <div class="timeline-item">
            <div class="timeline-dot"></div>
            <div class="timeline-year">2015 — Diversification</div>
            <div class="timeline-title">Entering Technology & Energy</div>
            <p class="timeline-text">Launched DomaTech Ventures and acquired GreenCore Energy — expanding beyond real estate into high-growth sectors.</p>
          </div>
          <div class="timeline-item">
            <div class="timeline-dot"></div>
            <div class="timeline-year">2019 — $500M Milestone</div>
            <div class="timeline-title">Half-Billion in Assets Under Management</div>
            <p class="timeline-text">AUM crossed the $500M mark. Portfolio includes 60+ completed projects across real estate, infrastructure, and technology.</p>
          </div>
          <div class="timeline-item">
            <div class="timeline-dot"></div>
            <div class="timeline-year">2024 — $1.2B AUM</div>
            <div class="timeline-title">Record Growth — MENA Award Winners</div>
            <p class="timeline-text">Assets under management reach $1.2B. Named Best Diversified Holding Company at MENA Business Awards 2024.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER (shared partial) -->
<?php get_footer(); ?>

<?php wp_footer();?>
</body>
</html>
