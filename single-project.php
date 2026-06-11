<?php
// Template Name: Single Project

get_header();

?>


<?php
while ( have_posts() ) :
the_post();

$pid        = get_the_ID();

// ── Meta fields ────────────────────────────────────────
$short_desc  = get_post_meta( $pid, '_doma_short_desc',     true );
$location    = get_post_meta( $pid, '_doma_location',       true );
$map_embed   = get_post_meta( $pid, '_doma_map_embed',      true );
$status      = get_post_meta( $pid, '_doma_status',         true );
$completion  = get_post_meta( $pid, '_doma_completion',     true );
$est_date    = get_post_meta( $pid, '_doma_est_date',       true );
$overview    = get_post_meta( $pid, '_doma_overview',       true );
$info        = get_post_meta( $pid, '_doma_project_info',   true );
$gallery     = get_post_meta( $pid, '_doma_gallery',        true );
$videos      = get_post_meta( $pid, '_doma_videos',         true );
$documents   = get_post_meta( $pid, '_doma_documents',      true );
$related_ids = get_post_meta( $pid, '_doma_related_projects', true );

if ( ! is_array( $info ) )        $info        = [];
if ( ! is_array( $gallery ) )     $gallery     = [];
if ( ! is_array( $videos ) )      $videos      = [];
if ( ! is_array( $documents ) )   $documents   = [];
if ( ! is_array( $related_ids ) ) $related_ids = [];

// ── Taxonomy ───────────────────────────────────────────
$categories = get_the_terms( $pid, 'project_category' );
$cat_name   = ( $categories && ! is_wp_error( $categories ) ) ? $categories[0]->name : '';

// ── Status badge ───────────────────────────────────────
$badge_map = [
    'ongoing'   => 'badge-ongoing',
    'completed' => 'badge-completed',
    'upcoming'  => 'badge-upcoming',
    'on-hold'   => 'badge-ongoing',
];
$badge_class  = $badge_map[ $status ] ?? 'badge-ongoing';
$status_label = $status ? ucfirst( $status ) : '';

// ── Info spec fields ───────────────────────────────────
$info_fields = [
    'num_apartments'  => [ 'label' => 'Number of Apartments',            'icon' => 'fa-home' ],
    'building_height' => [ 'label' => 'Building Height',                 'icon' => 'fa-ruler-vertical' ],
    'num_units'       => [ 'label' => 'Number of Units',                 'icon' => 'fa-building' ],
    'num_parking'     => [ 'label' => 'Number of Parking Spaces',        'icon' => 'fa-car' ],
    'land_size'       => [ 'label' => 'Land Size',                       'icon' => 'fa-ruler-combined' ],
    'road_size'       => [ 'label' => 'Road Size',                       'icon' => 'fa-ruler-horizontal' ],
    'orientation'     => [ 'label' => 'Land Orientation / Facing',       'icon' => 'fa-compass' ],
    'usp'             => [ 'label' => 'USP (Unique Selling Proposition)', 'icon' => 'fa-star' ],
];

// ── YouTube ID helper ──────────────────────────────────
function doma_yt_id( $url ) {
    if ( ! $url ) return '';
    preg_match( '/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $m );
    return $m[1] ?? '';
}
?>

<!-- ═══════════════════════════════════════════════════
     PAGE HERO
═══════════════════════════════════════════════════ -->
<section class="page-hero" style="padding-top:calc(var(--nav-height) + 50px);padding-bottom:50px;">
    <div class="page-hero-bg"></div>
    <div class="grid-pattern"></div>
    <div class="container position-relative" style="z-index:2;">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb" style="justify-content:flex-start;margin-bottom:16px;">
            <a href="<?php echo esc_url( home_url() ); ?>">Home</a>
            <i class="fas fa-chevron-right"></i>
            <a href="<?php echo esc_url( get_post_type_archive_link( 'doma_project' ) ); ?>">Projects</a>
            <i class="fas fa-chevron-right"></i>
            <span style="color:var(--gold);"><?php the_title(); ?></span>
        </div>

        <!-- Title + Badge -->
        <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
            <h1 style="font-family:var(--font-display);font-size:clamp(1.8rem,4vw,3rem);font-weight:800;margin:0;">
                <?php the_title(); ?>
            </h1>
            <?php if ( $status_label ) : ?>
                <span class="badge-status <?php echo esc_attr( $badge_class ); ?>"><?php echo esc_html( $status_label ); ?></span>
            <?php endif; ?>
        </div>

        <!-- Meta row -->
        <div style="display:flex;align-items:center;gap:20px;margin-top:14px;flex-wrap:wrap;">
            <?php if ( $location ) : ?>
            <span style="font-size:0.82rem;color:var(--grey);display:flex;align-items:center;gap:6px;">
                <i class="fas fa-map-marker-alt" style="color:var(--gold);"></i> <?php echo esc_html( $location ); ?>
            </span>
            <?php endif; ?>
            <?php if ( $cat_name ) : ?>
            <span style="font-size:0.82rem;color:var(--grey);display:flex;align-items:center;gap:6px;">
                <i class="fas fa-tag" style="color:var(--gold);"></i> <?php echo esc_html( $cat_name ); ?>
            </span>
            <?php endif; ?>
            <?php if ( $est_date ) : ?>
            <span style="font-size:0.82rem;color:var(--grey);display:flex;align-items:center;gap:6px;">
                <i class="fas fa-calendar" style="color:var(--gold);"></i> Est. Completion: <?php echo esc_html( $est_date ); ?>
            </span>
            <?php endif; ?>
        </div>

    </div>
</section>

<!-- ═══════════════════════════════════════════════════
     DETAIL CONTENT
═══════════════════════════════════════════════════ -->
<section class="section-pad-sm">
<div class="container">
<div class="row g-5">

    <!-- ── LEFT MAIN CONTENT ─────────────────────────── -->
    <div class="col-lg-8">

        <!-- Feature Image -->
        <?php if ( has_post_thumbnail() ) : ?>
        <div class="project-detail-gallery anim-fade-up">
            <div class="gallery-main">
                <?php the_post_thumbnail( 'full', [
                    'style' => 'width:100%;height:100%;object-fit:cover;display:block;',
                    'alt'   => get_the_title(),
                ] ); ?>
                <div style="font-family:var(--font-display);font-size:0.75rem;letter-spacing:0.2em;color:rgba(255,255,255,0.3);text-transform:uppercase;padding:10px 16px;">
                    Main View — <?php the_title(); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Completion Progress Bar -->
        <?php if ( $completion !== '' && $completion !== false ) :
            $pct = intval( $completion ); ?>
        <div class="doma-card anim-fade-up" style="padding:24px;margin-bottom:24px;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                <span style="font-size:0.8rem;font-weight:700;letter-spacing:0.05em;color:var(--gold);text-transform:uppercase;">Construction Progress</span>
                <span style="font-size:0.9rem;font-weight:700;color:var(--gold);"><?php echo $pct; ?>%</span>
            </div>
            <div style="height:8px;background:rgba(255,255,255,0.08);border-radius:100px;overflow:hidden;">
                <div style="width:<?php echo $pct; ?>%;height:100%;background:linear-gradient(90deg,var(--gold),#d4a03a);border-radius:100px;transition:width 1s ease;"></div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Project Overview -->
        <?php if ( $overview || $short_desc ) : ?>
        <div class="doma-card anim-fade-up anim-delay-2" style="padding:32px;margin-bottom:24px;">
            <h3 style="font-family:var(--font-heading);font-size:1.1rem;font-weight:700;margin-bottom:16px;color:var(--gold);">Project Overview</h3>
            <?php if ( $overview ) : ?>
                <div style="color:rgba(255,255,255,0.75);line-height:1.85;">
                    <?php
                    // Split by newline and wrap each paragraph
                    $paragraphs = array_filter( explode( "\n", trim( $overview ) ) );
                    foreach ( $paragraphs as $para ) :
                        $para = trim( $para );
                        if ( $para ) :
                    ?>
                    <p style="margin-bottom:16px;"><?php echo esc_html( $para ); ?></p>
                    <?php endif; endforeach; ?>
                </div>
            <?php elseif ( $short_desc ) : ?>
                <p style="color:rgba(255,255,255,0.75);line-height:1.85;margin:0;"><?php echo esc_html( $short_desc ); ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Project Info Grid -->
        <?php $has_info = array_filter( $info ); if ( $has_info ) : ?>
        <div class="detail-info-grid anim-fade-up anim-delay-1">
            <?php foreach ( $info_fields as $key => $cfg ) :
                $val = trim( $info[ $key ] ?? '' );
                if ( ! $val ) continue; ?>
            <div class="detail-info-item">
                <div class="detail-info-label"><?php echo esc_html( $cfg['label'] ); ?></div>
                <div class="detail-info-value">
                    <i class="fas <?php echo esc_attr( $cfg['icon'] ); ?>"></i>
                    <?php echo esc_html( $val ); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div><!-- /col-lg-8 -->

    <!-- ── RIGHT SIDEBAR ─────────────────────────────── -->
    <div class="col-lg-4">

        <!-- Document Downloads -->
        <?php if ( ! empty( $documents ) ) : ?>
        <div class="doma-card anim-fade-up anim-delay-2" style="padding:24px;margin-bottom:20px;">
            <h4 style="font-family:var(--font-heading);font-size:0.9rem;font-weight:700;margin-bottom:18px;color:var(--gold);">
                <i class="fas fa-file-alt" style="margin-right:6px;"></i> Project Documents
            </h4>
            <?php foreach ( $documents as $doc ) :
                $file_id  = $doc['file_id'] ?? 0;
                $file_url = $file_id ? wp_get_attachment_url( $file_id ) : '';
                if ( ! $file_url ) continue;
                $file_size = '';
                $path = get_attached_file( $file_id );
                if ( $path && file_exists( $path ) ) {
                    $bytes     = filesize( $path );
                    $file_size = $bytes >= 1048576
                        ? round( $bytes / 1048576, 1 ) . ' MB'
                        : round( $bytes / 1024 ) . ' KB';
                }
            ?>
            <div class="doc-download-item">
                <i class="fas fa-file-pdf doc-icon" style="color:#ef4444;"></i>
                <div class="doc-name"><?php echo esc_html( $doc['title'] ); ?></div>
                <?php if ( $file_size ) : ?><div class="doc-size"><?php echo esc_html( $file_size ); ?></div><?php endif; ?>
                <a href="<?php echo esc_url( $file_url ); ?>" class="doc-dl-btn" download target="_blank">
                    <i class="fas fa-download"></i>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Location Card -->
        <?php if ( $location || $map_embed ) : ?>
        <div class="doma-card anim-fade-up anim-delay-3" style="padding:24px;">
            <h4 style="font-family:var(--font-heading);font-size:0.9rem;font-weight:700;margin-bottom:14px;color:var(--gold);">
                <i class="fas fa-map-marker-alt" style="margin-right:6px;"></i> Location
            </h4>
            <?php if ( $map_embed ) : ?>
                <div style="border-radius:8px;overflow:hidden;">
                    <iframe
                        src="<?php echo esc_url( $map_embed ); ?>"
                        width="100%" height="200" style="border:0;display:block;"
                        allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            <?php else : ?>
                <div class="map-placeholder">
                    <i class="fas fa-map"></i>
                    <span><?php echo esc_html( $location ); ?></span>
                </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

    </div><!-- /col-lg-4 -->

</div><!-- /row -->

<!-- ═══════════════════════════════════════════════════
     ① IMAGE GALLERY SECTION
═══════════════════════════════════════════════════ -->
<?php if ( ! empty( $gallery ) ) : ?>
<section style="margin-top:60px;">
    <div class="container position-relative">

        <!-- Header -->
        <div class="row align-items-end mb-2 reveal">
            <div class="col-lg-7">
                <div class="section-tag"><i class="fas fa-images"></i> Project Gallery</div>
                <div class="gold-rule"></div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex justify-content-end align-items-center gap-2 pb-2">
                <span style="font-family:var(--font-body);font-size:13px;color:var(--grey);">
                    <span id="visibleCount"><?php echo count( $gallery ); ?></span> /
                    <span id="totalCount"><?php echo count( $gallery ); ?></span>
                </span>
            </div>
        </div>

        <!-- Masonry Grid -->
        <div class="gallery-grid" id="galleryGrid">
            <?php foreach ( $gallery as $item ) :
                $img_id   = $item['img_id']  ?? 0;
                $caption  = $item['caption'] ?? '';
                $img_full = wp_get_attachment_image_url( $img_id, 'full' );
                $img_med  = wp_get_attachment_image_url( $img_id, 'large' );
                if ( ! $img_full ) continue;
            ?>
            <div class="gallery-item reveal"
                 data-cat="project"
                 data-title="<?php echo esc_attr( $caption ?: get_the_title() ); ?>"
                 data-src="<?php echo esc_url( $img_full ); ?>">
                <img src="<?php echo esc_url( $img_med ); ?>" alt="<?php echo esc_attr( $caption ); ?>" />
                <div class="gi-zoom"><i class="fas fa-expand-alt"></i></div>
                <div class="gi-ov">
                    <?php if ( $caption ) : ?>
                    <div class="gi-cat">Project</div>
                    <div class="gi-title"><?php echo esc_html( $caption ); ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- LIGHTBOX -->
<div class="lightbox" id="lightbox">
    <button class="lb-close" id="lbClose"><i class="fas fa-times"></i></button>
    <button class="lb-arrow lb-prev" id="lbPrev"><i class="fas fa-chevron-left"></i></button>
    <button class="lb-arrow lb-next" id="lbNext"><i class="fas fa-chevron-right"></i></button>
    <div class="lb-inner">
        <img id="lbImg" src="" alt="" />
        <div class="lb-caption">
            <div class="lb-cat" id="lbCat"></div>
            <div class="lb-ttl" id="lbTtl"></div>
        </div>
    </div>
    <div class="lb-counter"><span id="lbCurr">1</span> / <span id="lbTotal">1</span></div>
</div>
<?php endif; ?>

<!-- ═══════════════════════════════════════════════════
     ② VIDEO SECTION
═══════════════════════════════════════════════════ -->
<?php if ( ! empty( $videos ) ) :
    $featured   = $videos[0];
    $feat_yt_id = doma_yt_id( $featured['url'] );
    $feat_thumb = '';
    if ( ! empty( $featured['thumb_id'] ) ) {
        $feat_thumb = wp_get_attachment_image_url( $featured['thumb_id'], 'large' );
    }
    if ( ! $feat_thumb && $feat_yt_id ) {
        $feat_thumb = 'https://img.youtube.com/vi/' . $feat_yt_id . '/maxresdefault.jpg';
    }
?>
<section id="videoSection" style="margin-top:60px;">
    <div class="container">

        <!-- Header -->
        <div class="row align-items-end mb-3 reveal">
            <div class="col-lg-7">
                <div class="section-tag"><i class="fas fa-play-circle"></i> Media &amp; Stories</div>
                <div class="gold-rule"></div>
            </div>
        </div>

        <!-- Main video row -->
        <div class="row g-4 align-items-stretch">

            <!-- Featured Video -->
            <div class="col-lg-7 reveal">
                <div class="vid-featured" id="featuredVid" data-yt="<?php echo esc_attr( $feat_yt_id ); ?>">
                    <?php if ( $feat_thumb ) : ?>
                        <img src="<?php echo esc_url( $feat_thumb ); ?>" alt="<?php echo esc_attr( $featured['title'] ?? '' ); ?>" />
                    <?php endif; ?>
                    <div class="vf-ov"></div>
                    <div class="vf-play"><i class="fas fa-play"></i></div>
                    <div class="vf-meta">
                        <?php if ( ! empty( $featured['tag'] ) ) : ?>
                            <div class="vf-tag"><?php echo esc_html( $featured['tag'] ); ?></div>
                        <?php endif; ?>
                        <div class="vf-title"><?php echo esc_html( $featured['title'] ?? '' ); ?></div>
                        <?php if ( ! empty( $featured['duration'] ) ) : ?>
                            <div class="vf-dur"><i class="fas fa-clock"></i> <?php echo esc_html( $featured['duration'] ); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Playlist -->
            <div class="col-lg-5 reveal" style="animation-delay:.15s">
                <div class="vid-playlist" id="vidPlaylist">
                    <?php foreach ( $videos as $i => $vid ) :
                        $yt_id     = doma_yt_id( $vid['url'] );
                        $thumb_url = '';
                        if ( ! empty( $vid['thumb_id'] ) ) {
                            $thumb_url = wp_get_attachment_image_url( $vid['thumb_id'], 'thumbnail' );
                        }
                        if ( ! $thumb_url && $yt_id ) {
                            $thumb_url = 'https://img.youtube.com/vi/' . $yt_id . '/mqdefault.jpg';
                        }
                    ?>
                    <div class="vp-item <?php echo $i === 0 ? 'active' : ''; ?>"
                         data-yt="<?php echo esc_attr( $yt_id ); ?>"
                         data-thumb="<?php echo esc_attr( $thumb_url ); ?>"
                         data-title="<?php echo esc_attr( $vid['title'] ?? '' ); ?>"
                         data-tag="<?php echo esc_attr( $vid['tag'] ?? '' ); ?>"
                         data-dur="<?php echo esc_attr( $vid['duration'] ?? '' ); ?>">
                        <div class="vp-thumb">
                            <?php if ( $thumb_url ) : ?>
                                <img src="<?php echo esc_url( $thumb_url ); ?>" alt="" />
                            <?php endif; ?>
                            <div class="vp-play-ico"><i class="fas fa-play"></i></div>
                        </div>
                        <div class="vp-info">
                            <?php if ( ! empty( $vid['tag'] ) ) : ?>
                                <div class="vp-cat"><?php echo esc_html( $vid['tag'] ); ?></div>
                            <?php endif; ?>
                            <div class="vp-name"><?php echo esc_html( $vid['title'] ?? '' ); ?></div>
                            <?php if ( ! empty( $vid['duration'] ) ) : ?>
                                <div class="vp-dur"><i class="fas fa-clock"></i> <?php echo esc_html( $vid['duration'] ); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div><!-- /row -->
    </div><!-- /container -->
</section>

<!-- VIDEO MODAL -->
<div class="vid-modal" id="vidModal">
    <div class="vm-inner">
        <button class="vm-close" id="vmClose"><i class="fas fa-times"></i></button>
        <div class="vm-player" id="vmPlayer"></div>
    </div>
</div>
<?php endif; ?>

<!-- ═══════════════════════════════════════════════════
     RELATED PROJECTS
═══════════════════════════════════════════════════ -->
<?php
$related_posts = [];
if ( ! empty( $related_ids ) ) {
    $related_posts = get_posts( [
        'post_type'      => 'doma_project',
        'post__in'       => $related_ids,
        'posts_per_page' => count( $related_ids ),
        'orderby'        => 'post__in',
        'post_status'    => 'publish',
    ] );
}
if ( ! empty( $related_posts ) ) :
    $r_badge_map = [
        'ongoing'   => 'badge-ongoing',
        'completed' => 'badge-completed',
        'upcoming'  => 'badge-upcoming',
        'on-hold'   => 'badge-ongoing',
    ];
?>
<div class="divider-gold" style="margin:60px 0 40px;"></div>
<div class="mb-4 anim-fade-up">
    <div class="section-label">Related</div>
    <h2 class="section-title">More <span>Projects</span></h2>
</div>
<div class="row g-4">
    <?php foreach ( $related_posts as $delay => $rp ) :
        $r_status    = get_post_meta( $rp->ID, '_doma_status',   true );
        $r_location  = get_post_meta( $rp->ID, '_doma_location', true );
        $r_short     = get_post_meta( $rp->ID, '_doma_short_desc', true );
        $r_cats      = get_the_terms( $rp->ID, 'project_category' );
        $r_cat       = ( $r_cats && ! is_wp_error( $r_cats ) ) ? $r_cats[0]->name : '';
        $r_badge     = $r_badge_map[ $r_status ] ?? 'badge-ongoing';
        $r_label     = $r_status ? ucfirst( $r_status ) : '';
        $r_thumb     = get_the_post_thumbnail_url( $rp->ID, 'medium' );
        $r_excerpt   = $r_short ?: wp_trim_words( get_the_excerpt( $rp ), 14 );
        $delay_class = 'anim-delay-' . ( $delay + 1 );
    ?>
    <div class="col-lg-4 col-md-6 anim-fade-up <?php echo esc_attr( $delay_class ); ?>">
        <div class="project-card hover-lift">
            <div class="project-card-img">
                <?php if ( $r_thumb ) : ?>
                    <img src="<?php echo esc_url( $r_thumb ); ?>"
                         alt="<?php echo esc_attr( $rp->post_title ); ?>"
                         style="width:100%;height:180px;object-fit:cover;display:block;" />
                <?php else : ?>
                    <div style="width:100%;height:180px;background:linear-gradient(135deg,#0a2540,#1a4060);display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-building" style="font-size:3rem;color:rgba(188,132,43,0.3);"></i>
                    </div>
                <?php endif; ?>
                <div class="project-card-img-overlay"></div>
                <?php if ( $r_label ) : ?>
                <div class="project-card-status">
                    <span class="badge-status <?php echo esc_attr( $r_badge ); ?>"><?php echo esc_html( $r_label ); ?></span>
                </div>
                <?php endif; ?>
            </div>
            <div class="project-card-body">
                <?php if ( $r_cat ) : ?><div class="project-industry"><?php echo esc_html( $r_cat ); ?></div><?php endif; ?>
                <h3 class="project-card-title"><?php echo esc_html( $rp->post_title ); ?></h3>
                <?php if ( $r_excerpt ) : ?>
                    <p class="project-card-desc"><?php echo esc_html( wp_trim_words( $r_excerpt, 14 ) ); ?></p>
                <?php endif; ?>
                <div class="project-meta-row">
                    <?php if ( $r_location ) : ?>
                        <div class="project-location"><i class="fas fa-map-marker-alt"></i> <?php echo esc_html( $r_location ); ?></div>
                    <?php endif; ?>
                    <a href="<?php echo esc_url( get_permalink( $rp->ID ) ); ?>" class="project-arrow-btn">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

</div>
</section>

<?php endwhile; get_footer(); ?>

<?php wp_footer(); ?>
