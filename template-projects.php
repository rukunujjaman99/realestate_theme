<?php 
/**
 * Template Name: Projects Page
 * Description: A custom page template for displaying a portfolio of projects with dynamic content.
 * Place this file in your active theme root folder and assign it to a page in the WordPress admin.
 */

get_header();
?>


<!-- PAGE HERO -->
<section class="page-hero">
  <div class="page-hero-bg"></div>
  <div class="grid-pattern"></div>
  <div class="geo-blob blob-gold" style="width:500px;height:500px;top:-150px;right:-100px;position:absolute;z-index:1;"></div>
  <div class="geo-blob blob-navy" style="width:300px;height:300px;bottom:-50px;left:-60px;position:absolute;z-index:1;"></div>
  <div class="container position-relative" style="z-index:2;">
    <div class="section-label" style="justify-content:center;">Portfolio</div>
    <h1 class="page-hero-title">Our <span style="color:var(--gold);">Projects</span></h1>
    <div class="page-breadcrumb">
      <a href="index.html">Home</a>
      <i class="fas fa-chevron-right"></i>
      <span style="color:var(--gold);">Projects</span>
    </div>
  </div>
</section>

<!-- PROJECTS SECTION -->

<section class="section-pad" style="background:var(--bg-dark);">
  <div class="container">

    <!-- Filter & Search Bar -->
    <div class="reveal">
      <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:24px;">
      <div class="filter-bar" style="margin-bottom:0;flex:1;">

    <button class="filter-btn active" data-filter="all">
        All
    </button>

    <?php
    $terms = get_terms(array(
        'taxonomy'   => 'project_category',
        'hide_empty' => true
    ));

    if(!empty($terms)) :
        foreach($terms as $term) :
    ?>

        <button class="filter-btn"
                data-filter="<?php echo esc_attr(strtolower($term->name)); ?>">
            <?php echo esc_html($term->name); ?>
        </button>

    <?php
        endforeach;
    endif;
    ?>

    <button class="filter-btn" data-filter="ongoing">Ongoing</button>
    <button class="filter-btn" data-filter="completed">Completed</button>
    <button class="filter-btn" data-filter="upcoming">Upcoming</button>

</div>


        <div style="display:flex;align-items:center;gap:10px;">
          <div class="search-input-wrap">
            <i class="fas fa-search"></i>
            <input type="text" id="projectSearch" placeholder="Search projects…" />
          </div>
          <div class="view-toggle">
            <button class="view-toggle-btn active" id="viewGrid" title="Grid View"><i class="fas fa-th-large"></i></button>
            <button class="view-toggle-btn" id="viewList" title="List View"><i class="fas fa-list"></i></button>
          </div>
        </div>
      </div>
    </div>

    <!-- GRID VIEW -->
  

    <div id="projectsGridView">

    <div class="row g-4">

        <?php

        $args = array(
            'post_type'      => 'doma_project',
            'post_status'    => 'publish',
            'posts_per_page' => -1
        );

        $projects = new WP_Query($args);

        if($projects->have_posts()) :

            while($projects->have_posts()) :
            $projects->the_post();

            $status      = get_post_meta(get_the_ID(), '_doma_status', true);
            $completion  = get_post_meta(get_the_ID(), '_doma_completion', true);
            $location    = get_post_meta(get_the_ID(), '_doma_location', true);
            $short_desc  = get_post_meta(get_the_ID(), '_doma_short_desc', true);

            $terms = get_the_terms(get_the_ID(),'project_category');

            $category = (!empty($terms) && !is_wp_error($terms))
                ? $terms[0]->name
                : 'Project';

            $image = get_the_post_thumbnail_url(get_the_ID(),'large');

            if(!$image){
                $image = get_template_directory_uri().'/assets/images/default-project.jpg';
            }

            switch($status){

                case 'completed':
                    $status_class='badge-completed';
                    $status_label='Completed';
                break;

                case 'upcoming':
                    $status_class='badge-upcoming';
                    $status_label='Upcoming';
                break;

                default:
                    $status_class='badge-ongoing';
                    $status_label='Ongoing';
                break;
            }
        ?>

        <div class="col-lg-4 col-md-6 anim-fade-up"
             data-project-item
             data-industry="<?php echo esc_attr(strtolower($category)); ?>"
             data-status="<?php echo esc_attr(strtolower($status)); ?>"
             data-name="<?php echo esc_attr(strtolower(get_the_title())); ?>">

            <div class="project-card card-3d">

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

                        <a href="<?php the_permalink(); ?>">

                            <?php the_title(); ?>

                        </a>

                    </h3>

                    <p class="project-card-desc">

                        <?php echo esc_html(wp_trim_words($short_desc,20)); ?>

                    </p>

                    <div class="project-progress-row">

                        <span class="progress-label">
                            Completion
                        </span>

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
    
    <!-- /grid view -->

    <!-- LIST VIEW -->
    <div id="projectsListView" style="display:none;">

    

    </div>
    <!-- /list view -->

  </div>
</section>



<!-- CTA -->
<section class="cta-section">
  <div class="cta-bg"></div>
  <div class="particles-bg"></div>
  <div class="cta-glow"></div>
  <div class="container position-relative" style="z-index:2;">
    <div class="cta-content anim-fade-up">
      <div class="section-label" style="justify-content:center;">Invest With Us</div>
      <h2 class="cta-title">Interested in Our <span style="color:var(--gold);">Projects?</span></h2>
      <p class="cta-desc">Explore investment opportunities or partner with Doma on upcoming ventures. Our team is ready to discuss how we can create value together.</p>
      <div class="cta-actions">
        <a href="contact.html" class="btn-gold"><i class="fas fa-paper-plane"></i> Contact Us</a>
        <a href="status.html"  class="btn-outline"><i class="fas fa-chart-line"></i> View Live Status</a>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<?php get_footer(); ?>


<?php wp_footer(); ?>

</body>
</html> 