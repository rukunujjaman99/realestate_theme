  <?php
/**
 * Enqueue Theme Styles & Scripts
 */

function doma_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
   add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
   add_theme_support('customize-selective-refresh-widgets');
 

}


add_action('after_setup_theme', 'doma_theme_setup');

function doma_register_menus(){

    register_nav_menus(array(
          'primary_menu' => __('Primary Menu', 'doma'),
          'mobile_menu'  => __('Mobile Menu', 'doma'),
        'footer_company_menu'  => __('Footer Company Menu', 'doma'),
        'footer_services_menu' => __('Footer Services Menu', 'doma')

    ));

}
add_action('after_setup_theme','doma_register_menus');

/* Desktop Menu Class */
function doma_menu_link_class($atts, $item, $args) {

    if ($args->theme_location == 'primary_menu') {
        $atts['class'] = 'nav-link';
    }

    if ($args->theme_location == 'mobile_menu') {
        $atts['class'] = 'mobile-nav-link';
    }

    return $atts;
}
add_filter('nav_menu_link_attributes', 'doma_menu_link_class', 10, 3);

function doma_active_menu_class($classes, $item) {

    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active';
    }

    return $classes;
}
add_filter('nav_menu_css_class', 'doma_active_menu_class', 10, 2);



function doma_theme_assets() {

    // CSS
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap', array(), null);
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), '5.3.2');
    wp_enqueue_style('fontawesome-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', array(), '6.5.0');
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/assets/css/style.css', array(), filemtime(get_template_directory() . '/assets/css/style.css'));
    wp_enqueue_style('theme-animations', get_template_directory_uri() . '/assets/css/animations.css', array(), filemtime(get_template_directory() . '/assets/css/animations.css'));

    // JS
    wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), '3.12.5', true);
    wp_enqueue_script('gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js', array('gsap'), '3.12.5', true);
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array(), '5.3.2', true);

    wp_enqueue_script('theme-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), filemtime(get_template_directory() . '/assets/js/main.js'), true);
    wp_enqueue_script('theme-hero', get_template_directory_uri() . '/assets/js/hero.js', array('gsap'), filemtime(get_template_directory() . '/assets/js/hero.js'), true);
    wp_enqueue_script('theme-gallery', get_template_directory_uri() . '/assets/js/gallery.js', array('jquery'), filemtime(get_template_directory() . '/assets/js/gallery.js'), true);

}
add_action('wp_enqueue_scripts', 'doma_theme_assets');


// slider scripts

/*
=========================================
 HERO SLIDER CPT
=========================================
*/

/*---------------------------------------
 Register CPT
---------------------------------------*/
function doma_register_hero_slider_cpt() {

    register_post_type('hero_slider', array(
        'labels' => array(
            'name'               => 'Hero Sliders',
            'singular_name'      => 'Hero Slide',
            'add_new_item'       => 'Add New Slide',
            'edit_item'          => 'Edit Hero Slide',
            'new_item'           => 'New Hero Slide',
            'view_item'          => 'View Hero Slide'
        ),
        'public'       => true,
        'show_ui'      => true,
        'menu_icon'    => 'dashicons-images-alt2',
        'supports'     => array('title'),
        'show_in_rest' => true
    ));

}
add_action('init', 'doma_register_hero_slider_cpt');


/*---------------------------------------
 Meta Box
---------------------------------------*/
function doma_slider_add_meta_box() {

    add_meta_box(
        'doma_slider_meta',
        'Hero Slide Details',
        'doma_slider_meta_callback',
        'hero_slider',
        'normal',
        'high'
    );

}
add_action('add_meta_boxes', 'doma_slider_add_meta_box');


/*---------------------------------------
 Meta Box Fields
---------------------------------------*/
function doma_slider_meta_callback($post) {

    wp_nonce_field('doma_slider_nonce', 'doma_slider_nonce_field');

    wp_enqueue_media();

    $subtitle   = get_post_meta($post->ID, '_subtitle', true);
    $title1     = get_post_meta($post->ID, '_title1', true);
    $highlight  = get_post_meta($post->ID, '_highlight', true);
    $desc       = get_post_meta($post->ID, '_desc', true);

    $btn1_text  = get_post_meta($post->ID, '_btn1_text', true);
    $btn1_url   = get_post_meta($post->ID, '_btn1_url', true);

    $btn2_text  = get_post_meta($post->ID, '_btn2_text', true);
    $btn2_url   = get_post_meta($post->ID, '_btn2_url', true);

    $image_id   = get_post_meta($post->ID, '_bg_image', true);
    $image_url  = $image_id ? wp_get_attachment_image_url($image_id, 'large') : '';
?>

<style>
.doma-field{
    margin-bottom:15px;
}
.doma-field label{
    display:block;
    font-weight:600;
    margin-bottom:5px;
}
.doma-field input,
.doma-field textarea{
    width:100%;
}
#bg_image_preview img{
    max-width:300px;
    border-radius:10px;
    margin-top:10px;
}
</style>

<div class="doma-field">
    <label>Subtitle</label>
    <input type="text" name="subtitle" value="<?php echo esc_attr($subtitle); ?>">
</div>

<div class="doma-field">
    <label>Main Title</label>
    <input type="text" name="title1" value="<?php echo esc_attr($title1); ?>">
</div>

<div class="doma-field">
    <label>Highlight Text</label>
    <input type="text" name="highlight" value="<?php echo esc_attr($highlight); ?>">
</div>

<div class="doma-field">
    <label>Description</label>
    <textarea rows="4" name="desc"><?php echo esc_textarea($desc); ?></textarea>
</div>

<hr>

<h3>Background Image</h3>

<input type="hidden"
       id="bg_image"
       name="bg_image"
       value="<?php echo esc_attr($image_id); ?>">

<div id="bg_image_preview">

    <?php if($image_url): ?>
        <img src="<?php echo esc_url($image_url); ?>">
    <?php endif; ?>

</div>

<p>
    <button type="button"
            class="button button-primary"
            id="upload_bg_image">
        Upload Image
    </button>

    <button type="button"
            class="button"
            id="remove_bg_image">
        Remove Image
    </button>
</p>

<hr>

<h3>Button 1</h3>

<div class="doma-field">
    <label>Button Text</label>
    <input type="text" name="btn1_text" value="<?php echo esc_attr($btn1_text); ?>">
</div>

<div class="doma-field">
    <label>Button URL</label>
    <input type="url" name="btn1_url" value="<?php echo esc_attr($btn1_url); ?>">
</div>

<hr>

<h3>Button 2</h3>

<div class="doma-field">
    <label>Button Text</label>
    <input type="text" name="btn2_text" value="<?php echo esc_attr($btn2_text); ?>">
</div>

<div class="doma-field">
    <label>Button URL</label>
    <input type="url" name="btn2_url" value="<?php echo esc_attr($btn2_url); ?>">
</div>

<script>
jQuery(document).ready(function($){

    let mediaUploader;

    $('#upload_bg_image').click(function(e){

        e.preventDefault();

        mediaUploader = wp.media({
            title: 'Select Background Image',
            button: {
                text: 'Use Image'
            },
            multiple: false
        });

        mediaUploader.on('select', function(){

            let attachment = mediaUploader
                .state()
                .get('selection')
                .first()
                .toJSON();

            $('#bg_image').val(attachment.id);

            $('#bg_image_preview').html(
                '<img src="'+attachment.url+'">'
            );

        });

        mediaUploader.open();

    });

    $('#remove_bg_image').click(function(){

        $('#bg_image').val('');
        $('#bg_image_preview').html('');

    });

});
</script>

<?php
}


/*---------------------------------------
 Save Meta
---------------------------------------*/
function doma_save_slider_meta($post_id) {

    if (!isset($_POST['doma_slider_nonce_field'])) {
        return;
    }

    if (!wp_verify_nonce(
        $_POST['doma_slider_nonce_field'],
        'doma_slider_nonce'
    )) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    update_post_meta(
        $post_id,
        '_subtitle',
        sanitize_text_field($_POST['subtitle'] ?? '')
    );

    update_post_meta(
        $post_id,
        '_title1',
        sanitize_text_field($_POST['title1'] ?? '')
    );

    update_post_meta(
        $post_id,
        '_highlight',
        sanitize_text_field($_POST['highlight'] ?? '')
    );

    update_post_meta(
        $post_id,
        '_desc',
        sanitize_textarea_field($_POST['desc'] ?? '')
    );

    update_post_meta(
        $post_id,
        '_bg_image',
        intval($_POST['bg_image'] ?? 0)
    );

    update_post_meta(
        $post_id,
        '_btn1_text',
        sanitize_text_field($_POST['btn1_text'] ?? '')
    );

    update_post_meta(
        $post_id,
        '_btn1_url',
        esc_url_raw($_POST['btn1_url'] ?? '')
    );

    update_post_meta(
        $post_id,
        '_btn2_text',
        sanitize_text_field($_POST['btn2_text'] ?? '')
    );

    update_post_meta(
        $post_id,
        '_btn2_url',
        esc_url_raw($_POST['btn2_url'] ?? '')
    );

}
add_action('save_post_hero_slider', 'doma_save_slider_meta');



function doma_customize_about_section($wp_customize){

    $wp_customize->add_section('doma_about_section', array(
        'title'    => 'About Section',
        'priority' => 30,
    ));

    // Section Label
    $wp_customize->add_setting('about_label');
    $wp_customize->add_control('about_label', array(
        'label'   => 'Section Label',
        'section' => 'doma_about_section',
        'type'    => 'text',
    ));

    // Title
    $wp_customize->add_setting('about_title');
    $wp_customize->add_control('about_title', array(
        'label'   => 'Title',
        'section' => 'doma_about_section',
        'type'    => 'text',
    ));

    // Highlight Text
    $wp_customize->add_setting('about_highlight');
    $wp_customize->add_control('about_highlight', array(
        'label'   => 'Highlight Text',
        'section' => 'doma_about_section',
        'type'    => 'text',
    ));

    // Subtitle
    $wp_customize->add_setting('about_subtitle');
    $wp_customize->add_control('about_subtitle', array(
        'label'   => 'Subtitle',
        'section' => 'doma_about_section',
        'type'    => 'textarea',
    ));

    // Description
    $wp_customize->add_setting('about_description');
    $wp_customize->add_control('about_description', array(
        'label'   => 'Description',
        'section' => 'doma_about_section',
        'type'    => 'textarea',
    ));

    // Main Image
    $wp_customize->add_setting('about_main_image');

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'about_main_image',
            array(
                'label'   => 'Main Image',
                'section' => 'doma_about_section',
            )
        )
    );

    // Overlay Image
    $wp_customize->add_setting('about_overlay_image');

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'about_overlay_image',
            array(
                'label'   => 'Overlay Image',
                'section' => 'doma_about_section',
            )
        )
    );

    // Years Badge Number
    $wp_customize->add_setting('about_years_number');
    $wp_customize->add_control('about_years_number', array(
        'label'   => 'Years Number',
        'section' => 'doma_about_section',
        'type'    => 'text',
    ));

    // Years Badge Text
    $wp_customize->add_setting('about_years_text');
    $wp_customize->add_control('about_years_text', array(
        'label'   => 'Years Text',
        'section' => 'doma_about_section',
        'type'    => 'text',
    ));

    // Award Title
    $wp_customize->add_setting('about_award_title');
    $wp_customize->add_control('about_award_title', array(
        'label'   => 'Award Title',
        'section' => 'doma_about_section',
        'type'    => 'text',
    ));

    // Award Subtitle
    $wp_customize->add_setting('about_award_subtitle');
    $wp_customize->add_control('about_award_subtitle', array(
        'label'   => 'Award Subtitle',
        'section' => 'doma_about_section',
        'type'    => 'text',
    ));

    // Button 1 Text
    $wp_customize->add_setting('about_btn1_text');
    $wp_customize->add_control('about_btn1_text', array(
        'label'   => 'Button 1 Text',
        'section' => 'doma_about_section',
        'type'    => 'text',
    ));

    // Button 1 URL
    $wp_customize->add_setting('about_btn1_url');
    $wp_customize->add_control('about_btn1_url', array(
        'label'   => 'Button 1 URL',
        'section' => 'doma_about_section',
        'type'    => 'url',
    ));

    // Button 2 Text
    $wp_customize->add_setting('about_btn2_text');
    $wp_customize->add_control('about_btn2_text', array(
        'label'   => 'Button 2 Text',
        'section' => 'doma_about_section',
        'type'    => 'text',
    ));

    // Button 2 URL
    $wp_customize->add_setting('about_btn2_url');
    $wp_customize->add_control('about_btn2_url', array(
        'label'   => 'Button 2 URL',
        'section' => 'doma_about_section',
        'type'    => 'url',
    ));

}
add_action('customize_register', 'doma_customize_about_section');



// service section customize
function doma_service_customize($wp_customize){

    $wp_customize->add_section('doma_service_section', array(
        'title'    => 'Service Section',
        'priority' => 35,
    ));

    // Section Label
    $wp_customize->add_setting('service_label');
    $wp_customize->add_control('service_label', array(
        'label'   => 'Section Label',
        'section' => 'doma_service_section',
        'type'    => 'text',
    ));

    // Main Title
    $wp_customize->add_setting('service_title');
    $wp_customize->add_control('service_title', array(
        'label'   => 'Main Title',
        'section' => 'doma_service_section',
        'type'    => 'text',
    ));

    // Highlight Title
    $wp_customize->add_setting('service_highlight');
    $wp_customize->add_control('service_highlight', array(
        'label'   => 'Highlight Text',
        'section' => 'doma_service_section',
        'type'    => 'text',
    ));

    // Button Text
    $wp_customize->add_setting('service_btn_text');
    $wp_customize->add_control('service_btn_text', array(
        'label'   => 'Button Text',
        'section' => 'doma_service_section',
        'type'    => 'text',
    ));

    // Button URL
    $wp_customize->add_setting('service_btn_url');
    $wp_customize->add_control('service_btn_url', array(
        'label'   => 'Button URL',
        'section' => 'doma_service_section',
        'type'    => 'url',
    ));

}
add_action('customize_register', 'doma_service_customize');


/* CPT */

/**
 * SERVICES CPT
 */

/*--------------------------------------------------------------
# Register Service CPT
--------------------------------------------------------------*/


/* CPT */
add_action('init', function () {
    register_post_type('service', [
        'labels' => [
            'name' => 'Services',
            'singular_name' => 'Service',
            'add_new_item' => 'Add New Service',
            'edit_item' => 'Edit Service',
        ],
        'public' => true,
        'menu_icon' => 'dashicons-admin-tools',
        'supports' => ['title','thumbnail','page-attributes'],
        'show_in_rest' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'services']
    ]);
});

/* Admin scripts */
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_script('jquery-ui-sortable');
});

/* Meta box */
add_action('add_meta_boxes', function () {
    add_meta_box(
        'doma_service_details',
        'Service Details',
        'doma_service_meta_callback',
        'service',
        'normal',
        'high'
    );
});

function doma_service_meta_callback($post){

    wp_nonce_field('doma_service_nonce_action','doma_service_nonce');

    $icon = get_post_meta($post->ID,'_service_icon',true);
    $label = get_post_meta($post->ID,'_section_label',true);
    $number = get_post_meta($post->ID,'_section_number',true);
    $desc = get_post_meta($post->ID,'_service_short_desc',true);
    $btn1_text = get_post_meta($post->ID,'_btn1_text',true);
    $btn1_url = get_post_meta($post->ID,'_btn1_url',true);
    $btn2_text = get_post_meta($post->ID,'_btn2_text',true);
    $btn2_url = get_post_meta($post->ID,'_btn2_url',true);
    $features = get_post_meta($post->ID,'_service_features',true);

    if(!is_array($features)) $features = [''];
?>
<style>
.doma-card{background:#fff;border:1px solid #ddd;padding:20px;border-radius:12px;margin-bottom:20px}
.feature-item{display:flex;gap:10px;align-items:center;margin-bottom:10px;padding:10px;border:1px solid #e5e5e5;border-radius:8px}
.feature-item input{flex:1}
.feature-sort{cursor:move}
.remove-feature{background:#d63638!important;border-color:#d63638!important;color:#fff!important}
</style>

<div class="doma-card">
<p><strong>Service Icon</strong></p>
<input type="text" class="widefat" name="service_icon" value="<?php echo esc_attr($icon); ?>" placeholder="fas fa-city">

<p><strong>Section Label</strong></p>
<input type="text" class="widefat" name="section_label" value="<?php echo esc_attr($label); ?>">

<p><strong>Section Number</strong></p>
<input type="text" class="widefat" name="section_number" value="<?php echo esc_attr($number); ?>">

<p><strong>Short Description</strong></p>
<textarea class="widefat" rows="5" name="service_short_desc"><?php echo esc_textarea($desc); ?></textarea>

<hr>

<h3>Button 1</h3>
<input type="text" class="widefat" name="btn1_text" value="<?php echo esc_attr($btn1_text); ?>" placeholder="Button Text">
<br><br>
<input type="url" class="widefat" name="btn1_url" value="<?php echo esc_attr($btn1_url); ?>" placeholder="Button URL">

<h3>Button 2</h3>
<input type="text" class="widefat" name="btn2_text" value="<?php echo esc_attr($btn2_text); ?>" placeholder="Button Text">
<br><br>
<input type="url" class="widefat" name="btn2_url" value="<?php echo esc_attr($btn2_url); ?>" placeholder="Button URL">

<hr>

<h3>Service Features</h3>

<div id="service-features-wrapper">
<?php foreach($features as $feature): ?>
<div class="feature-item">
<span class="feature-sort dashicons dashicons-menu"></span>
<input type="text" name="service_features[]" value="<?php echo esc_attr($feature); ?>">
<button type="button" class="button remove-feature">Remove</button>
</div>
<?php endforeach; ?>
</div>

<button type="button" class="button button-primary" id="add-feature">+ Add Feature</button>
</div>

<script>
jQuery(function($){
    $('#add-feature').on('click', function(){
        $('#service-features-wrapper').append(
            '<div class="feature-item"><span class="feature-sort dashicons dashicons-menu"></span><input type="text" name="service_features[]" value=""><button type="button" class="button remove-feature">Remove</button></div>'
        );
    });

    $(document).on('click','.remove-feature',function(){
        $(this).closest('.feature-item').remove();
    });

    $('#service-features-wrapper').sortable({
        handle: '.feature-sort'
    });
});
</script>
<?php
}

/* Save */
add_action('save_post_service', function($post_id){

    if(!isset($_POST['doma_service_nonce'])) return;
    if(!wp_verify_nonce($_POST['doma_service_nonce'],'doma_service_nonce_action')) return;
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if(!current_user_can('edit_post',$post_id)) return;

    update_post_meta($post_id,'_service_icon',sanitize_text_field($_POST['service_icon'] ?? ''));
    update_post_meta($post_id,'_section_label',sanitize_text_field($_POST['section_label'] ?? ''));
    update_post_meta($post_id,'_section_number',sanitize_text_field($_POST['section_number'] ?? ''));
    update_post_meta($post_id,'_service_short_desc',sanitize_textarea_field($_POST['service_short_desc'] ?? ''));
    update_post_meta($post_id,'_btn1_text',sanitize_text_field($_POST['btn1_text'] ?? ''));
    update_post_meta($post_id,'_btn1_url',esc_url_raw($_POST['btn1_url'] ?? ''));
    update_post_meta($post_id,'_btn2_text',sanitize_text_field($_POST['btn2_text'] ?? ''));
    update_post_meta($post_id,'_btn2_url',esc_url_raw($_POST['btn2_url'] ?? ''));

    $features = [];
    if(!empty($_POST['service_features'])){
        foreach($_POST['service_features'] as $f){
            $f = sanitize_text_field($f);
            if($f !== '') $features[] = $f;
        }
    }
    update_post_meta($post_id,'_service_features',$features);

});




// gallery section customize

function doma_gallery_customizer($wp_customize){

    $wp_customize->add_section('doma_gallery_section', array(
        'title'    => 'Gallery Section',
        'priority' => 30,
    ));

    // Tag
    $wp_customize->add_setting('gallery_tag', array(
        'default' => 'Our Portfolio Gallery',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('gallery_tag', array(
        'label'   => 'Section Tag',
        'section' => 'doma_gallery_section',
        'type'    => 'text',
    ));

    // Title
    $wp_customize->add_setting('gallery_title', array(
        'default' => 'Capturing',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('gallery_title', array(
        'label'   => 'Title',
        'section' => 'doma_gallery_section',
        'type'    => 'text',
    ));

    // Highlight Text
    $wp_customize->add_setting('gallery_highlight', array(
        'default' => 'Excellence',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('gallery_highlight', array(
        'label'   => 'Highlighted Text',
        'section' => 'doma_gallery_section',
        'type'    => 'text',
    ));

    // Description
    $wp_customize->add_setting('gallery_description', array(
        'default' => 'From landmark towers to smart infrastructure — a visual journey through Doma Holdings world-class projects and milestones.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('gallery_description', array(
        'label'   => 'Description',
        'section' => 'doma_gallery_section',
        'type'    => 'textarea',
    ));

}
add_action('customize_register', 'doma_gallery_customizer');




// gallery section post type

// Project Gallery CPT
function doma_project_gallery_cpt() {

    register_post_type('project_gallery', array(
        'labels' => array(
            'name' => 'Project Gallery',
            'singular_name' => 'Project',
            'add_new_item' => 'Add New Project',
            'edit_item' => 'Edit Project',
        ),
        'public' => true,
        'menu_icon' => 'dashicons-format-gallery',
        'supports' => array(
            'title',
            'thumbnail',
            'page-attributes'
        ),
        'show_in_rest' => true,
        'has_archive' => false,
    ));

}
add_action('init', 'doma_project_gallery_cpt');

function doma_project_gallery_meta_box() {

    add_meta_box(
        'doma_project_gallery',
        'Project Details',
        'doma_project_gallery_callback',
        'project_gallery',
        'normal',
        'high'
    );

}
add_action('add_meta_boxes', 'doma_project_gallery_meta_box');

function doma_project_gallery_callback($post){

    wp_nonce_field(
        'project_gallery_nonce',
        'project_gallery_nonce_field'
    );

    $category = get_post_meta(
        $post->ID,
        '_project_category',
        true
    );

    $cat_slug = get_post_meta(
        $post->ID,
        '_project_cat_slug',
        true
    );
?>

<p>
    <label><strong>Project Category</strong></label>
    <input type="text"
           name="project_category"
           class="widefat"
           value="<?php echo esc_attr($category); ?>"
           placeholder="Real Estate">
</p>

<p>
    <label><strong>Category Slug</strong></label>
    <input type="text"
           name="project_cat_slug"
           class="widefat"
           value="<?php echo esc_attr($cat_slug); ?>"
           placeholder="realestate">
</p>

<p>
    <strong>Project Name</strong><br>
    Use WordPress Title Field
</p>

<p>
    <strong>Project Image</strong><br>
    Use Featured Image
</p>

<?php
}

add_action(
    'save_post_project_gallery',
    'doma_save_project_gallery'
);

function doma_save_project_gallery($post_id){

    if(
        !isset($_POST['project_gallery_nonce_field'])
    ){
        return;
    }

    if(
        !wp_verify_nonce(
            $_POST['project_gallery_nonce_field'],
            'project_gallery_nonce'
        )
    ){
        return;
    }

    update_post_meta(
        $post_id,
        '_project_category',
        sanitize_text_field(
            $_POST['project_category'] ?? ''
        )
    );

    update_post_meta(
        $post_id,
        '_project_cat_slug',
        sanitize_title(
            $_POST['project_cat_slug'] ?? ''
        )
    );

}

// cta section customize


function doma_cta_customizer($wp_customize) {

    // CTA Section
    $wp_customize->add_section('doma_cta_section', array(
        'title'    => __('CTA Section', 'doma'),
        'priority' => 120,
    ));

    // Section Label
    $wp_customize->add_setting('cta_label', array(
        'default' => 'Ready to Start?',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('cta_label', array(
        'label'   => __('Section Label', 'doma'),
        'section' => 'doma_cta_section',
        'type'    => 'text',
    ));

    // Title
    $wp_customize->add_setting('cta_title', array(
        'default' => 'Partner with Doma and Build Your Future',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('cta_title', array(
        'label'   => __('CTA Title', 'doma'),
        'section' => 'doma_cta_section',
        'type'    => 'textarea',
    ));

    // Description
    $wp_customize->add_setting('cta_desc', array(
        'default' => 'Whether you\'re an investor seeking returns...',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('cta_desc', array(
        'label'   => __('Description', 'doma'),
        'section' => 'doma_cta_section',
        'type'    => 'textarea',
    ));

    // Button 1 Text
    $wp_customize->add_setting('cta_btn1_text', array(
        'default' => 'Start a Conversation',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('cta_btn1_text', array(
        'label'   => __('Button 1 Text', 'doma'),
        'section' => 'doma_cta_section',
        'type'    => 'text',
    ));

    // Button 1 Link
    $wp_customize->add_setting('cta_btn1_link', array(
        'default' => home_url('/contact'),
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('cta_btn1_link', array(
        'label'   => __('Button 1 Link', 'doma'),
        'section' => 'doma_cta_section',
        'type'    => 'url',
    ));

    // Button 2 Text
    $wp_customize->add_setting('cta_btn2_text', array(
        'default' => 'View Portfolio',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('cta_btn2_text', array(
        'label'   => __('Button 2 Text', 'doma'),
        'section' => 'doma_cta_section',
        'type'    => 'text',
    ));

    // Button 2 Link
    $wp_customize->add_setting('cta_btn2_link', array(
        'default' => home_url('/projects'),
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('cta_btn2_link', array(
        'label'   => __('Button 2 Link', 'doma'),
        'section' => 'doma_cta_section',
        'type'    => 'url',
    ));

}
add_action('customize_register', 'doma_cta_customizer');


// client testimonial customizer

function realestate_testimonial_customizer($wp_customize) {

    $wp_customize->add_section('testimonial_section', array(
        'title'    => __('Client Review Section', 'theme'),
        'priority' => 30,
    ));

    // Section Label
    $wp_customize->add_setting('testimonial_label', array(
        'default' => 'Client Reviews',
    ));

    $wp_customize->add_control('testimonial_label', array(
        'label'   => 'Section Label',
        'section' => 'testimonial_section',
        'type'    => 'text',
    ));

    // Title
    $wp_customize->add_setting('testimonial_title', array(
        'default' => 'What Our',
    ));

    $wp_customize->add_control('testimonial_title', array(
        'label'   => 'Title',
        'section' => 'testimonial_section',
        'type'    => 'text',
    ));

    // Highlight Title
    $wp_customize->add_setting('testimonial_title_highlight', array(
        'default' => 'Partners Say',
    ));

    $wp_customize->add_control('testimonial_title_highlight', array(
        'label'   => 'Highlight Text',
        'section' => 'testimonial_section',
        'type'    => 'text',
    ));

    // Subtitle
    $wp_customize->add_setting('testimonial_subtitle', array(
        'default' => 'Real feedback from investors, developers and business partners across 18+ countries.',
    ));

    $wp_customize->add_control('testimonial_subtitle', array(
        'label'   => 'Subtitle',
        'section' => 'testimonial_section',
        'type'    => 'textarea',
    ));

    // Rating
    $wp_customize->add_setting('testimonial_rating', array(
        'default' => '4.9',
    ));

    $wp_customize->add_control('testimonial_rating', array(
        'label'   => 'Rating',
        'section' => 'testimonial_section',
        'type'    => 'text',
    ));

    // Review Count
    $wp_customize->add_setting('testimonial_review_count', array(
        'default' => 'Based on 240+ reviews',
    ));

    $wp_customize->add_control('testimonial_review_count', array(
        'label'   => 'Review Count Text',
        'section' => 'testimonial_section',
        'type'    => 'text',
    ));

}
add_action('customize_register', 'realestate_testimonial_customizer');


function doma_client_testimonial_cpt() {

    register_post_type('client_testimonial', array(

        'labels' => array(
            'name'          => 'Client Testimonials',
            'singular_name' => 'Client Testimonial',
            'add_new_item'  => 'Add New Testimonial',
            'edit_item'     => 'Edit Testimonial',
            'all_items'     => 'All Testimonials',
        ),

        'public'       => true,
        'menu_icon'    => 'dashicons-format-quote',
        'supports'     => array('title'),


    ));
}
add_action('init', 'doma_client_testimonial_cpt');


function doma_testimonial_metabox() {

    add_meta_box(
        'doma_testimonial_details',
        'Testimonial Details',
        'doma_testimonial_callback',
        'client_testimonial',
        'normal',
        'high'
    );

}
add_action('add_meta_boxes', 'doma_testimonial_metabox');

function doma_testimonial_callback($post) {

    $client_name = get_post_meta($post->ID, '_client_name', true);
    $client_role = get_post_meta($post->ID, '_client_role', true);
    $review_text = get_post_meta($post->ID, '_review_text', true);
    $review_star = get_post_meta($post->ID, '_review_star', true);

    wp_nonce_field('testimonial_nonce', 'testimonial_nonce_field');
?>

<p>
    <label><strong>Client Name</strong></label>
    <input type="text"
           name="client_name"
           value="<?php echo esc_attr($client_name); ?>"
           style="width:100%;">
</p>

<p>
    <label><strong>Client Role & Company</strong></label>
    <input type="text"
           name="client_role"
           value="<?php echo esc_attr($client_role); ?>"
           style="width:100%;">
</p>

<p>
    <label><strong>Review Content</strong></label>
    <textarea name="review_text"
              rows="5"
              style="width:100%;"><?php echo esc_textarea($review_text); ?></textarea>
</p>

<p>
    <label><strong>Review Stars</strong></label>

    <select name="review_star">
        <?php for($i=1;$i<=5;$i++) : ?>
            <option value="<?php echo $i; ?>"
                <?php selected($review_star, $i); ?>>
                <?php echo $i; ?> Star
            </option>
        <?php endfor; ?>
    </select>
</p>

<?php
}

function doma_save_testimonial_meta($post_id) {

    if (
        !isset($_POST['testimonial_nonce_field']) ||
        !wp_verify_nonce($_POST['testimonial_nonce_field'], 'testimonial_nonce')
    ) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if(isset($_POST['client_name'])){
        update_post_meta(
            $post_id,
            '_client_name',
            sanitize_text_field($_POST['client_name'])
        );
    }

    if(isset($_POST['client_role'])){
        update_post_meta(
            $post_id,
            '_client_role',
            sanitize_text_field($_POST['client_role'])
        );
    }

    if(isset($_POST['review_text'])){
        update_post_meta(
            $post_id,
            '_review_text',
            sanitize_textarea_field($_POST['review_text'])
        );
    }

    if(isset($_POST['review_star'])){
        update_post_meta(
            $post_id,
            '_review_star',
            intval($_POST['review_star'])
        );
    }
}
add_action('save_post_client_testimonial', 'doma_save_testimonial_meta');


// footer customize
function doma_footer_customizer($wp_customize){

    $wp_customize->add_section('doma_footer_section', array(
        'title'    => __('Footer Settings','doma'),
        'priority' => 200,
    ));

    /*
    =====================
    Footer Logo
    =====================
    */

    $wp_customize->add_setting('footer_logo');

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'footer_logo',
            array(
                'label'   => 'Footer Logo',
                'section' => 'doma_footer_section',
            )
        )
    );

    /*
    =====================
    Description
    =====================
    */

    $wp_customize->add_setting('footer_description');

    $wp_customize->add_control(
        'footer_description',
        array(
            'label'   => 'Footer Description',
            'section' => 'doma_footer_section',
            'type'    => 'textarea'
        )
    );

    /*
    =====================
    Social Links
    =====================
    */

    $socials = array(
        'linkedin',
        'twitter',
        'instagram',
        'youtube'
    );

    foreach($socials as $social){

        $wp_customize->add_setting('footer_'.$social);

        $wp_customize->add_control(
            'footer_'.$social,
            array(
                'label'   => ucfirst($social).' URL',
                'section' => 'doma_footer_section',
                'type'    => 'url'
            )
        );
    }

    /*
    =====================
    Newsletter
    =====================
    */

    $wp_customize->add_setting('newsletter_title');

    $wp_customize->add_control(
        'newsletter_title',
        array(
            'label'   => 'Newsletter Title',
            'section' => 'doma_footer_section',
            'type'    => 'text'
        )
    );

    $wp_customize->add_setting('newsletter_desc');

    $wp_customize->add_control(
        'newsletter_desc',
        array(
            'label'   => 'Newsletter Description',
            'section' => 'doma_footer_section',
            'type'    => 'textarea'
        )
    );

    /*
    =====================
    Copyright
    =====================
    */

    $wp_customize->add_setting('footer_copyright');

    $wp_customize->add_control(
        'footer_copyright',
        array(
            'label'   => 'Copyright Text',
            'section' => 'doma_footer_section',
            'type'    => 'text'
        )
    );

    /*
    =====================
    Bottom Links
    =====================
    */

    $wp_customize->add_setting('privacy_policy_url');

    $wp_customize->add_control(
        'privacy_policy_url',
        array(
            'label'   => 'Privacy Policy URL',
            'section' => 'doma_footer_section',
            'type'    => 'url'
        )
    );

    $wp_customize->add_setting('terms_url');

    $wp_customize->add_control(
        'terms_url',
        array(
            'label'   => 'Terms Of Service URL',
            'section' => 'doma_footer_section',
            'type'    => 'url'
        )
    );

}
add_action('customize_register','doma_footer_customizer');

// Services Page Hero Customizer

function doma_services_page_hero_customizer($wp_customize) {

    $wp_customize->add_section('doma_services_page_hero', array(
        'title'       => __('Services Page Hero Section', 'doma'),
        'priority'    => 35,
        'description' => __('Manage Services Page Hero Content', 'doma'),
    ));

    // Section Label
    $wp_customize->add_setting('services_hero_label', array(
        'default'           => 'What We Offer',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('services_hero_label', array(
        'label'   => __('Section Label', 'doma'),
        'section' => 'doma_services_page_hero',
        'type'    => 'text',
    ));

    // Hero Title
    $wp_customize->add_setting('services_hero_title', array(
        'default'           => 'Our',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('services_hero_title', array(
        'label'   => __('Hero Title', 'doma'),
        'section' => 'doma_services_page_hero',
        'type'    => 'text',
    ));

    // Highlight Title
    $wp_customize->add_setting('services_hero_highlight_title', array(
        'default'           => 'Services',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('services_hero_highlight_title', array(
        'label'   => __('Highlight Title', 'doma'),
        'section' => 'doma_services_page_hero',
        'type'    => 'text',
    ));

    // Description
    $wp_customize->add_setting('services_hero_description', array(
        'default'           => 'Six integrated business verticals engineered for compounding value across industries and geographies.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('services_hero_description', array(
        'label'   => __('Description', 'doma'),
        'section' => 'doma_services_page_hero',
        'type'    => 'textarea',
    ));

    // Home Text
    $wp_customize->add_setting('services_hero_home_text', array(
        'default'           => 'Home',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('services_hero_home_text', array(
        'label'   => __('Home Text', 'doma'),
        'section' => 'doma_services_page_hero',
        'type'    => 'text',
    ));

    // Home URL
    $wp_customize->add_setting('services_hero_home_url', array(
        'default'           => home_url('/'),
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('services_hero_home_url', array(
        'label'   => __('Home URL', 'doma'),
        'section' => 'doma_services_page_hero',
        'type'    => 'url',
    ));

    // Current Page Name
    $wp_customize->add_setting('services_hero_current_page', array(
        'default'           => 'Services',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('services_hero_current_page', array(
        'label'   => __('Current Page Name', 'doma'),
        'section' => 'doma_services_page_hero',
        'type'    => 'text',
    ));

}
add_action('customize_register', 'doma_services_page_hero_customizer');


// projects page hero customizer

/* ==========================================================
   DOMA PROJECTS — Custom Post Type, Metaboxes & Save
   Paste this entire block into your theme's functions.php
   ========================================================== */

// ──────────────────────────────────────────────────────────
// 1. CUSTOM POST TYPE
// ──────────────────────────────────────────────────────────
add_action( 'init', 'doma_register_project_cpt' );
function doma_register_project_cpt() {
    $labels = [
        'name'                  => 'Projects',
        'singular_name'         => 'Project',
        'add_new'               => 'Add New Project',
        'add_new_item'          => 'Add New Project',
        'edit_item'             => 'Edit Project',
        'new_item'              => 'New Project',
        'view_item'             => 'View Project',
        'search_items'          => 'Search Projects',
        'not_found'             => 'No projects found.',
        'not_found_in_trash'    => 'No projects found in Trash.',
        'all_items'             => 'All Projects',
        'menu_name'             => 'Projects',
        'featured_image'        => 'Project Feature Image',
        'set_featured_image'    => 'Set Feature Image',
        'remove_featured_image' => 'Remove Feature Image',
    ];
    register_post_type( 'doma_project', [
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => [ 'slug' => 'projects', 'with_front' => false ],
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-building',
        'supports'           => [ 'title', 'thumbnail', 'excerpt' ],
        'show_in_rest'       => true,
    ] );
}

// ──────────────────────────────────────────────────────────
// 2. TAXONOMIES
// ──────────────────────────────────────────────────────────
add_action( 'init', 'doma_register_project_taxonomies' );
function doma_register_project_taxonomies() {
    // Project Category
    register_taxonomy( 'project_category', 'doma_project', [
        'labels'            => [
            'name'          => 'Project Categories',
            'singular_name' => 'Project Category',
            'menu_name'     => 'Categories',
            'add_new_item'  => 'Add New Category',
        ],
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'rewrite'           => [ 'slug' => 'project-category' ],
        'show_in_rest'      => true,
    ] );
}

// ──────────────────────────────────────────────────────────
// 3. FLUSH REWRITE ON THEME SWITCH / SAVE
// ──────────────────────────────────────────────────────────
add_action( 'after_switch_theme', function () {
    doma_register_project_cpt();
    doma_register_project_taxonomies();
    flush_rewrite_rules();
} );

// ──────────────────────────────────────────────────────────
// 4. REGISTER ALL METABOXES
// ──────────────────────────────────────────────────────────
add_action( 'add_meta_boxes', 'doma_register_metaboxes' );
function doma_register_metaboxes() {
    $pt = 'doma_project';
    add_meta_box( 'doma_basics',    '<span class="dashicons dashicons-info"></span> Project Basics',            'doma_render_basics_metabox',    $pt, 'normal', 'high' );
    add_meta_box( 'doma_overview',  '<span class="dashicons dashicons-text-page"></span> Project Overview',     'doma_render_overview_metabox',  $pt, 'normal', 'high' );
    add_meta_box( 'doma_info',      '<span class="dashicons dashicons-list-view"></span> Project Specifications','doma_render_info_metabox',      $pt, 'normal', 'default' );
    add_meta_box( 'doma_gallery',   '<span class="dashicons dashicons-format-gallery"></span> Project Gallery', 'doma_render_gallery_metabox',   $pt, 'normal', 'default' );
    add_meta_box( 'doma_videos',    '<span class="dashicons dashicons-video-alt3"></span> Project Videos',      'doma_render_videos_metabox',    $pt, 'normal', 'default' );
    add_meta_box( 'doma_documents', '<span class="dashicons dashicons-media-document"></span> Document Downloads','doma_render_documents_metabox',$pt, 'normal', 'default' );
    add_meta_box( 'doma_related',   '<span class="dashicons dashicons-randomize"></span> Related Projects',     'doma_render_related_metabox',   $pt, 'side',   'default' );
}

// ──────────────────────────────────────────────────────────
// 5. METABOX: BASICS
// ──────────────────────────────────────────────────────────
function doma_render_basics_metabox( $post ) {
    wp_nonce_field( 'doma_save_meta', 'doma_meta_nonce' );
    $d = [
        'short_desc' => get_post_meta( $post->ID, '_doma_short_desc', true ),
        'location'   => get_post_meta( $post->ID, '_doma_location',   true ),
        'map_embed'  => get_post_meta( $post->ID, '_doma_map_embed',  true ),
        'status'     => get_post_meta( $post->ID, '_doma_status',     true ),
        'completion' => get_post_meta( $post->ID, '_doma_completion', true ),
        'est_date'   => get_post_meta( $post->ID, '_doma_est_date',   true ),
    ];
    $statuses = [ 'ongoing' => 'Ongoing', 'completed' => 'Completed', 'upcoming' => 'Upcoming', 'on-hold' => 'On Hold' ];
    $pct = intval( $d['completion'] );
    ?>
    <div class="doma-meta-grid doma-grid-2">

        <div class="doma-field doma-col-2">
            <label>Short Description</label>
            <textarea name="doma_short_desc" rows="3" placeholder="One paragraph that describes this project at a glance…"><?php echo esc_textarea( $d['short_desc'] ); ?></textarea>
        </div>

        <div class="doma-field">
            <label>Project Status</label>
            <select name="doma_status">
                <option value="">— Select Status —</option>
                <?php foreach ( $statuses as $val => $label ) : ?>
                    <option value="<?php echo $val; ?>" <?php selected( $d['status'], $val ); ?>><?php echo $label; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="doma-field">
            <label>Estimated Completion Date</label>
            <input type="text" name="doma_est_date" value="<?php echo esc_attr( $d['est_date'] ); ?>" placeholder="e.g. Q4 2025" />
        </div>

        <div class="doma-field">
            <label>Completion (%)</label>
            <div class="doma-progress-field">
                <input type="number" name="doma_completion" min="0" max="100" value="<?php echo $pct; ?>" placeholder="0–100" />
                <span class="doma-progress-bar-wrap">
                    <span class="doma-progress-bar" style="width:<?php echo $pct; ?>%"></span>
                </span>
                <span class="doma-progress-label"><?php echo $pct; ?>%</span>
            </div>
        </div>

        <div class="doma-field">
            <label>Location</label>
            <input type="text" name="doma_location" value="<?php echo esc_attr( $d['location'] ); ?>" placeholder="e.g. Business Bay, Dubai, UAE" />
        </div>

        <div class="doma-field doma-col-2">
            <label>Map Embed Link <span style="font-weight:400;text-transform:none;font-size:11px;">(paste the <code>src</code> URL from Google Maps → Share → Embed)</span></label>
            <input type="url" name="doma_map_embed" value="<?php echo esc_attr( $d['map_embed'] ); ?>" placeholder="https://www.google.com/maps/embed?pb=…" />
        </div>

    </div>
    <?php
}

// ──────────────────────────────────────────────────────────
// 6. METABOX: PROJECT OVERVIEW
// ──────────────────────────────────────────────────────────
function doma_render_overview_metabox( $post ) {
    $overview = get_post_meta( $post->ID, '_doma_overview', true );
    ?>
    <div class="doma-meta-grid">
        <div class="doma-field">
            <label>Project Overview</label>
            <textarea name="doma_overview" rows="12" placeholder="Write a detailed project overview…"><?php echo esc_textarea( $overview ); ?></textarea>
        </div>
    </div>
    <?php
}

// ──────────────────────────────────────────────────────────
// 7. METABOX: PROJECT SPECIFICATIONS
// ──────────────────────────────────────────────────────────
function doma_render_info_metabox( $post ) {
    $info = get_post_meta( $post->ID, '_doma_project_info', true );
    if ( ! is_array( $info ) ) $info = [];
    $fields = [
        'num_apartments'  => 'Number of Apartments',
        'building_height' => 'Building Height',
        'num_units'       => 'Number of Units',
        'num_parking'     => 'Number of Parking Spaces',
        'land_size'       => 'Land Size',
        'road_size'       => 'Road Size',
        'orientation'     => 'Land Orientation / Facing',
        'usp'             => 'USP (Unique Selling Proposition)',
    ];
    echo '<div class="doma-meta-grid doma-grid-2">';
    foreach ( $fields as $key => $label ) {
        $val = esc_attr( $info[ $key ] ?? '' );
        echo "<div class='doma-field'>
            <label>{$label}</label>
            <input type='text' name='doma_project_info[{$key}]' value='{$val}' placeholder='{$label}' />
        </div>";
    }
    echo '</div>';
}

// ──────────────────────────────────────────────────────────
// 8. METABOX: GALLERY (Repeater)
// ──────────────────────────────────────────────────────────
function doma_render_gallery_metabox( $post ) {
    $gallery = get_post_meta( $post->ID, '_doma_gallery', true );
    if ( ! is_array( $gallery ) ) $gallery = [];
    ?>
    <div class="doma-repeater-wrap">
        <div class="doma-repeater-list" id="doma-gallery-list">
            <?php foreach ( $gallery as $i => $item ) doma_gallery_row( $i, $item ); ?>
        </div>
        <button type="button" class="doma-add-btn" data-list="doma-gallery-list" data-tmpl="doma-gallery-tmpl" data-prefix="doma_gallery">
            <span class="dashicons dashicons-plus-alt"></span> Add Image
        </button>
    </div>
    <script type="text/html" id="doma-gallery-tmpl"><?php doma_gallery_row( '__i__', [] ); ?></script>
    <?php
}
function doma_gallery_row( $i, $item ) {
    $img_id  = $item['img_id']  ?? '';
    $caption = $item['caption'] ?? '';
    $img_url = $img_id ? wp_get_attachment_image_url( $img_id, 'thumbnail' ) : '';
    ?>
    <div class="doma-repeater-row doma-gallery-row" data-index="<?php echo $i; ?>">
        <span class="doma-row-handle dashicons dashicons-move"></span>
        <div class="doma-gallery-thumb">
            <?php if ( $img_url ) : ?><img src="<?php echo esc_url($img_url); ?>" alt="" />
            <?php else : ?><div class="doma-thumb-placeholder"><span class="dashicons dashicons-format-image"></span></div><?php endif; ?>
        </div>
        <div class="doma-gallery-fields">
            <input type="hidden" name="doma_gallery[<?php echo $i; ?>][img_id]" class="doma-img-id" value="<?php echo esc_attr($img_id); ?>" />
            <button type="button" class="doma-upload-img-btn button"><?php echo $img_id ? 'Change Image' : 'Upload / Select Image'; ?></button>
            <input type="text" name="doma_gallery[<?php echo $i; ?>][caption]" value="<?php echo esc_attr($caption); ?>" placeholder="Caption (optional)" />
        </div>
        <button type="button" class="doma-remove-btn"><span class="dashicons dashicons-trash"></span></button>
    </div>
    <?php
}

// ──────────────────────────────────────────────────────────
// 9. METABOX: VIDEOS (Repeater)
// ──────────────────────────────────────────────────────────
function doma_render_videos_metabox( $post ) {
    $videos = get_post_meta( $post->ID, '_doma_videos', true );
    if ( ! is_array( $videos ) ) $videos = [];
    ?>
    <div class="doma-repeater-wrap">
        <div class="doma-repeater-list" id="doma-videos-list">
            <?php foreach ( $videos as $i => $item ) doma_video_row( $i, $item ); ?>
        </div>
        <button type="button" class="doma-add-btn" data-list="doma-videos-list" data-tmpl="doma-videos-tmpl" data-prefix="doma_videos">
            <span class="dashicons dashicons-plus-alt"></span> Add Video
        </button>
    </div>
    <script type="text/html" id="doma-videos-tmpl"><?php doma_video_row( '__i__', [] ); ?></script>
    <?php
}
function doma_video_row( $i, $item ) {
    $title    = $item['title']    ?? '';
    $url      = $item['url']      ?? '';
    $tag      = $item['tag']      ?? '';
    $duration = $item['duration'] ?? '';
    $thumb_id = $item['thumb_id'] ?? '';
    $thumb_url= $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'thumbnail' ) : '';
    ?>
    <div class="doma-repeater-row doma-video-row" data-index="<?php echo $i; ?>">
        <span class="doma-row-handle dashicons dashicons-move"></span>
        <div class="doma-video-fields">
            <div class="doma-meta-grid doma-grid-2" style="margin:0">
                <div class="doma-field">
                    <label>Video Title</label>
                    <input type="text" name="doma_videos[<?php echo $i; ?>][title]" value="<?php echo esc_attr($title); ?>" placeholder="e.g. Corporate Showreel 2024" />
                </div>
                <div class="doma-field">
                    <label>Tag / Category</label>
                    <input type="text" name="doma_videos[<?php echo $i; ?>][tag]" value="<?php echo esc_attr($tag); ?>" placeholder="e.g. Featured Film" />
                </div>
                <div class="doma-field">
                    <label>YouTube / Vimeo URL</label>
                    <input type="url" name="doma_videos[<?php echo $i; ?>][url]" value="<?php echo esc_attr($url); ?>" placeholder="https://www.youtube.com/watch?v=…" />
                </div>
                <div class="doma-field">
                    <label>Duration</label>
                    <input type="text" name="doma_videos[<?php echo $i; ?>][duration]" value="<?php echo esc_attr($duration); ?>" placeholder="e.g. 4:32" />
                </div>
                <div class="doma-field doma-col-2">
                    <label>Thumbnail</label>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div class="doma-gallery-thumb small">
                            <?php if($thumb_url): ?><img src="<?php echo esc_url($thumb_url); ?>" alt="" />
                            <?php else: ?><div class="doma-thumb-placeholder"><span class="dashicons dashicons-format-image"></span></div><?php endif; ?>
                        </div>
                        <input type="hidden" name="doma_videos[<?php echo $i; ?>][thumb_id]" class="doma-img-id" value="<?php echo esc_attr($thumb_id); ?>" />
                        <button type="button" class="doma-upload-img-btn button"><?php echo $thumb_id ? 'Change Thumbnail' : 'Upload Thumbnail'; ?></button>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="doma-remove-btn"><span class="dashicons dashicons-trash"></span></button>
    </div>
    <?php
}

// ──────────────────────────────────────────────────────────
// 10. METABOX: DOCUMENT DOWNLOADS (Repeater)
// ──────────────────────────────────────────────────────────
function doma_render_documents_metabox( $post ) {
    $docs = get_post_meta( $post->ID, '_doma_documents', true );
    if ( ! is_array( $docs ) ) $docs = [];
    ?>
    <div class="doma-repeater-wrap">
        <div class="doma-repeater-list" id="doma-docs-list">
            <?php foreach ( $docs as $i => $item ) doma_document_row( $i, $item ); ?>
        </div>
        <button type="button" class="doma-add-btn" data-list="doma-docs-list" data-tmpl="doma-docs-tmpl" data-prefix="doma_documents">
            <span class="dashicons dashicons-plus-alt"></span> Add Document
        </button>
    </div>
    <script type="text/html" id="doma-docs-tmpl"><?php doma_document_row( '__i__', [] ); ?></script>
    <?php
}
function doma_document_row( $i, $item ) {
    $title   = $item['title']   ?? '';
    $file_id = $item['file_id'] ?? '';
    $file_url= $file_id ? wp_get_attachment_url( $file_id ) : '';
    $file_name = $file_url ? basename( $file_url ) : '';
    ?>
    <div class="doma-repeater-row doma-doc-row" data-index="<?php echo $i; ?>">
        <span class="doma-row-handle dashicons dashicons-move"></span>
        <span class="dashicons dashicons-media-document" style="font-size:26px;color:var(--doma-gold);flex-shrink:0;padding-top:4px;"></span>
        <div class="doma-doc-fields">
            <input type="text" name="doma_documents[<?php echo $i; ?>][title]" value="<?php echo esc_attr($title); ?>" placeholder="Document title, e.g. Project Brochure" />
            <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                <input type="hidden" name="doma_documents[<?php echo $i; ?>][file_id]" class="doma-file-id" value="<?php echo esc_attr($file_id); ?>" />
                <button type="button" class="doma-upload-pdf-btn button">
                    <span class="dashicons dashicons-upload"></span> <?php echo $file_id ? 'Change PDF' : 'Upload PDF'; ?>
                </button>
                <span class="doma-file-label <?php echo $file_name ? '' : 'doma-no-file'; ?>">
                    <?php if ( $file_name ) : ?><span class="dashicons dashicons-yes-alt" style="color:#3ecf8e;"></span> <?php echo esc_html($file_name); ?>
                    <?php else : ?>No file selected<?php endif; ?>
                </span>
            </div>
        </div>
        <button type="button" class="doma-remove-btn"><span class="dashicons dashicons-trash"></span></button>
    </div>
    <?php
}

// ──────────────────────────────────────────────────────────
// 11. METABOX: RELATED PROJECTS
// ──────────────────────────────────────────────────────────
function doma_render_related_metabox( $post ) {
    $selected = get_post_meta( $post->ID, '_doma_related_projects', true );
    if ( ! is_array( $selected ) ) $selected = [];
    $projects = get_posts( [
        'post_type'      => 'doma_project',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'post__not_in'   => [ $post->ID ],
        'orderby'        => 'title',
        'order'          => 'ASC',
    ] );
    echo '<div class="doma-meta-grid"><div class="doma-field">';
    if ( empty( $projects ) ) {
        echo '<p style="color:var(--doma-muted);font-size:12px;">No other published projects yet.</p>';
    } else {
        echo '<div class="doma-related-list">';
        foreach ( $projects as $p ) {
            $chk = in_array( $p->ID, array_map('intval', $selected) ) ? 'checked' : '';
            echo "<label class='doma-checkbox-label'>
                <input type='checkbox' name='doma_related_projects[]' value='{$p->ID}' {$chk} />
                " . esc_html( $p->post_title ) . "
            </label>";
        }
        echo '</div>';
    }
    echo '</div></div>';
}

// ──────────────────────────────────────────────────────────
// 12. SAVE ALL META
// ──────────────────────────────────────────────────────────
add_action( 'save_post_doma_project', 'doma_save_project_meta', 10, 2 );
function doma_save_project_meta( $post_id ) {
    if ( ! isset( $_POST['doma_meta_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['doma_meta_nonce'], 'doma_save_meta' ) ) return;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // Simple text fields
    $text_map = [
        'doma_short_desc' => '_doma_short_desc',
        'doma_location'   => '_doma_location',
        'doma_map_embed'  => '_doma_map_embed',
        'doma_status'     => '_doma_status',
        'doma_est_date'   => '_doma_est_date',
    ];
    foreach ( $text_map as $post_key => $meta_key ) {
        if ( isset( $_POST[$post_key] ) )
            update_post_meta( $post_id, $meta_key, sanitize_text_field( $_POST[$post_key] ) );
    }

    // Completion
    if ( isset( $_POST['doma_completion'] ) )
        update_post_meta( $post_id, '_doma_completion', max(0, min(100, intval($_POST['doma_completion']))) );

    // Overview
    if ( isset( $_POST['doma_overview'] ) )
        update_post_meta( $post_id, '_doma_overview', wp_kses_post( $_POST['doma_overview'] ) );

    // Project Info
    if ( isset($_POST['doma_project_info']) && is_array($_POST['doma_project_info']) ) {
        $allowed = ['num_apartments','building_height','num_units','num_parking','land_size','road_size','orientation','usp'];
        $clean = [];
        foreach ( $allowed as $k )
            $clean[$k] = sanitize_text_field( $_POST['doma_project_info'][$k] ?? '' );
        update_post_meta( $post_id, '_doma_project_info', $clean );
    }

    // Gallery
    if ( isset($_POST['doma_gallery']) && is_array($_POST['doma_gallery']) ) {
        $gallery = [];
        foreach ( $_POST['doma_gallery'] as $item ) {
            $id = intval( $item['img_id'] ?? 0 );
            if ( $id > 0 ) $gallery[] = [ 'img_id' => $id, 'caption' => sanitize_text_field($item['caption'] ?? '') ];
        }
        update_post_meta( $post_id, '_doma_gallery', $gallery );
    } else { delete_post_meta( $post_id, '_doma_gallery' ); }

    // Videos
    if ( isset($_POST['doma_videos']) && is_array($_POST['doma_videos']) ) {
        $videos = [];
        foreach ( $_POST['doma_videos'] as $item ) {
            $url = esc_url_raw( $item['url'] ?? '' );
            if ( $url ) $videos[] = [
                'title'    => sanitize_text_field($item['title']    ?? ''),
                'tag'      => sanitize_text_field($item['tag']      ?? ''),
                'url'      => $url,
                'duration' => sanitize_text_field($item['duration'] ?? ''),
                'thumb_id' => intval($item['thumb_id'] ?? 0),
            ];
        }
        update_post_meta( $post_id, '_doma_videos', $videos );
    } else { delete_post_meta( $post_id, '_doma_videos' ); }

    // Documents
    if ( isset($_POST['doma_documents']) && is_array($_POST['doma_documents']) ) {
        $docs = [];
        foreach ( $_POST['doma_documents'] as $item ) {
            $fid = intval($item['file_id'] ?? 0);
            if ( $fid > 0 ) $docs[] = [ 'title' => sanitize_text_field($item['title'] ?? ''), 'file_id' => $fid ];
        }
        update_post_meta( $post_id, '_doma_documents', $docs );
    } else { delete_post_meta( $post_id, '_doma_documents' ); }

    // Related Projects
    if ( isset($_POST['doma_related_projects']) && is_array($_POST['doma_related_projects']) )
        update_post_meta( $post_id, '_doma_related_projects', array_filter(array_map('intval', $_POST['doma_related_projects'])) );
    else
        delete_post_meta( $post_id, '_doma_related_projects' );
}

// ──────────────────────────────────────────────────────────
// 13. ENQUEUE ADMIN CSS + JS (only on project edit screen)
// ──────────────────────────────────────────────────────────
add_action( 'admin_enqueue_scripts', 'doma_admin_assets' );
function doma_admin_assets( $hook ) {
    global $post;
    if ( ! in_array( $hook, ['post.php','post-new.php'] ) ) return;
    if ( ! $post || $post->post_type !== 'doma_project' ) return;

    wp_enqueue_media();
    wp_enqueue_script( 'jquery-ui-sortable' );

    // Inline CSS
    wp_add_inline_style( 'wp-admin', doma_admin_css() );

    // Inline JS
    wp_add_inline_script( 'jquery-ui-sortable', doma_admin_js() );
}

// ──────────────────────────────────────────────────────────
// 14. ADMIN CSS (inline)
// ──────────────────────────────────────────────────────────
function doma_admin_css() { return '
/* ── Doma Projects Admin UI ── */
:root{
  --doma-navy:#0d1a24;--doma-card:#111f2c;--doma-border:#1e3347;
  --doma-gold:#bc841b;--doma-gold-lt:#d4a03a;--doma-gold-pale:rgba(188,132,43,.08);
  --doma-text:#e2e8f0;--doma-muted:#8a9ab0;--doma-danger:#e05c5c;--doma-radius:8px;
  --doma-input:#0a1520;
}
#doma_basics .inside,#doma_overview .inside,#doma_info .inside,
#doma_gallery .inside,#doma_videos .inside,#doma_documents .inside,#doma_related .inside{
  background:var(--doma-navy);color:var(--doma-text);padding:20px 24px 24px;
  border-top:3px solid var(--doma-gold);margin:0;
}
#doma_basics,#doma_overview,#doma_info,#doma_gallery,
#doma_videos,#doma_documents,#doma_related{
  border:1px solid var(--doma-border);border-radius:var(--doma-radius);
  overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.35);margin-bottom:20px;
}
#doma_basics h2.hndle,#doma_overview h2.hndle,#doma_info h2.hndle,
#doma_gallery h2.hndle,#doma_videos h2.hndle,#doma_documents h2.hndle,#doma_related h2.hndle{
  background:var(--doma-card);color:var(--doma-gold);
  border-bottom:1px solid var(--doma-border);font-size:13px;font-weight:700;
  letter-spacing:.04em;padding:10px 16px;
}

.doma-meta-grid{display:flex;flex-direction:column;gap:16px;}
.doma-meta-grid.doma-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:16px 20px;}
.doma-col-2{grid-column:span 2;}
.doma-field{display:flex;flex-direction:column;gap:6px;}
.doma-field label{font-size:11.5px;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--doma-gold-lt);}
.doma-field input[type=text],.doma-field input[type=url],.doma-field input[type=number],
.doma-field select,.doma-field textarea{
  background:var(--doma-input)!important;border:1px solid var(--doma-border)!important;
  border-radius:6px!important;color:var(--doma-text)!important;font-size:13px!important;
  padding:9px 12px!important;width:100%!important;box-sizing:border-box;
  transition:border-color .2s,box-shadow .2s;outline:none!important;box-shadow:none!important;
}
.doma-field input:focus,.doma-field select:focus,.doma-field textarea:focus{
  border-color:var(--doma-gold)!important;box-shadow:0 0 0 2px rgba(188,132,43,.18)!important;
}
.doma-field select option{background:var(--doma-card);color:var(--doma-text);}
.doma-field code{background:rgba(255,255,255,.07);padding:1px 5px;border-radius:3px;font-size:10.5px;}
/* Progress */
.doma-progress-field{display:flex;align-items:center;gap:10px;}
.doma-progress-field input{width:80px!important;flex-shrink:0;}
.doma-progress-bar-wrap{flex:1;height:8px;background:var(--doma-border);border-radius:100px;overflow:hidden;}
.doma-progress-bar{display:block;height:100%;background:linear-gradient(90deg,var(--doma-gold),var(--doma-gold-lt));border-radius:100px;transition:width .4s;}
.doma-progress-label{font-size:12px;font-weight:700;color:var(--doma-gold);width:34px;text-align:right;flex-shrink:0;}
/* Repeater */
.doma-repeater-list{display:flex;flex-direction:column;gap:10px;margin-bottom:14px;}
.doma-repeater-row{display:flex;align-items:flex-start;gap:10px;background:var(--doma-card);
  border:1px solid var(--doma-border);border-radius:var(--doma-radius);padding:14px;
  position:relative;transition:border-color .2s;}
.doma-repeater-row:hover{border-color:rgba(188,132,43,.35);}
.doma-row-handle{cursor:grab;color:var(--doma-muted);flex-shrink:0;font-size:18px;padding-top:2px;transition:color .2s;}
.doma-row-handle:hover{color:var(--doma-gold);}
.doma-repeater-row.ui-sortable-placeholder{border:2px dashed var(--doma-gold)!important;background:var(--doma-gold-pale)!important;visibility:visible!important;min-height:60px;}
.doma-repeater-row.ui-sortable-helper{box-shadow:0 8px 32px rgba(0,0,0,.5);border-color:var(--doma-gold)!important;opacity:.9;}
.doma-remove-btn{background:transparent!important;border:1px solid rgba(224,92,92,.3)!important;
  border-radius:6px!important;color:var(--doma-danger)!important;cursor:pointer;padding:5px 7px!important;
  flex-shrink:0;transition:background .2s,border-color .2s;margin-left:auto;align-self:center;line-height:1;}
.doma-remove-btn:hover{background:rgba(224,92,92,.12)!important;border-color:var(--doma-danger)!important;}
.doma-remove-btn .dashicons{font-size:14px;width:14px;height:14px;line-height:1;}
.doma-add-btn{display:flex;align-items:center;justify-content:center;gap:6px;width:100%;
  background:var(--doma-gold-pale)!important;border:1px dashed var(--doma-gold)!important;
  border-radius:6px!important;color:var(--doma-gold)!important;cursor:pointer;
  font-size:12.5px!important;font-weight:700!important;letter-spacing:.04em;
  padding:10px 16px!important;text-transform:uppercase;transition:background .2s;}
.doma-add-btn:hover{background:rgba(188,132,43,.15)!important;border-style:solid!important;}
/* Gallery thumb */
.doma-gallery-thumb{width:72px;height:72px;border-radius:6px;overflow:hidden;
  flex-shrink:0;border:1px solid var(--doma-border);background:var(--doma-input);}
.doma-gallery-thumb.small{width:52px;height:52px;}
.doma-gallery-thumb img{width:100%;height:100%;object-fit:cover;display:block;}
.doma-thumb-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:var(--doma-border);font-size:22px;}
.doma-gallery-fields{flex:1;display:flex;flex-direction:column;gap:8px;}
.doma-gallery-fields input[type=text]{background:var(--doma-input)!important;border:1px solid var(--doma-border)!important;border-radius:6px!important;color:var(--doma-text)!important;font-size:12px!important;padding:7px 10px!important;width:100%!important;box-sizing:border-box;}
.doma-video-fields{flex:1;}
.doma-doc-fields{flex:1;display:flex;flex-direction:column;gap:8px;}
.doma-doc-fields input{background:var(--doma-input)!important;border:1px solid var(--doma-border)!important;border-radius:6px!important;color:var(--doma-text)!important;font-size:13px!important;padding:8px 12px!important;width:100%!important;box-sizing:border-box;}
.doma-file-label{font-size:11.5px;color:var(--doma-text);display:flex;align-items:center;gap:4px;}
.doma-no-file{color:var(--doma-muted)!important;}
/* Upload buttons */
button.doma-upload-img-btn.button,button.doma-upload-pdf-btn.button{
  background:var(--doma-input)!important;border-color:var(--doma-border)!important;
  color:var(--doma-text)!important;font-size:12px!important;padding:5px 12px!important;
  height:auto!important;border-radius:5px!important;display:inline-flex;align-items:center;gap:5px;}
button.doma-upload-img-btn:hover,button.doma-upload-pdf-btn:hover{border-color:var(--doma-gold)!important;color:var(--doma-gold)!important;}
/* Related */
.doma-related-list{display:flex;flex-direction:column;gap:8px;max-height:280px;overflow-y:auto;
  padding:12px;background:var(--doma-input);border:1px solid var(--doma-border);border-radius:6px;}
.doma-checkbox-label{display:flex;align-items:center;gap:8px;font-size:13px;color:var(--doma-text);
  cursor:pointer;padding:4px 0;border-bottom:1px solid rgba(255,255,255,.04);}
.doma-checkbox-label:last-child{border-bottom:none;}
.doma-checkbox-label input{accent-color:var(--doma-gold);width:15px;height:15px;flex-shrink:0;}
.doma-checkbox-label:hover{color:var(--doma-gold-lt);}
.doma-related-list::-webkit-scrollbar{width:5px;}
.doma-related-list::-webkit-scrollbar-track{background:var(--doma-border);border-radius:10px;}
.doma-related-list::-webkit-scrollbar-thumb{background:var(--doma-gold);border-radius:10px;}
@media(max-width:900px){.doma-meta-grid.doma-grid-2{grid-template-columns:1fr;}.doma-col-2{grid-column:span 1;}}
'; }

// ──────────────────────────────────────────────────────────
// 15. ADMIN JS (inline)
// ──────────────────────────────────────────────────────────
function doma_admin_js() { return '
(function($){
  // ── Re-index rows after add/remove/sort ──
  function reIndex($list){
    $list.find(".doma-repeater-row").each(function(newIdx){
      $(this).attr("data-index", newIdx);
      $(this).find("[name]").each(function(){
        var n = $(this).attr("name");
        $(this).attr("name", n.replace(/\[(__i__|\d+)\]/, "["+newIdx+"]"));
      });
    });
  }

  // ── ADD ROW ──
  $(document).on("click", ".doma-add-btn", function(){
    var listId = $(this).data("list");
    var tmplId = $(this).data("tmpl");
    var $list  = $("#"+listId);
    var count  = $list.find(".doma-repeater-row").length;
    var html   = $("#"+tmplId).html().replace(/__i__/g, count);
    var $row   = $(html);
    $list.append($row);
    $row.hide().slideDown(180);
    reIndex($list);
  });

  // ── REMOVE ROW ──
  $(document).on("click", ".doma-remove-btn", function(){
    if(!confirm("Remove this item?")) return;
    var $row  = $(this).closest(".doma-repeater-row");
    var $list = $row.closest(".doma-repeater-list");
    $row.slideUp(180, function(){ $(this).remove(); reIndex($list); });
  });

  // ── SORTABLE ──
  function initSort($list){
    if($list.hasClass("ui-sortable")) return;
    $list.sortable({ handle:".doma-row-handle", axis:"y", placeholder:"doma-repeater-row ui-sortable-placeholder",
      stop: function(){ reIndex($list); }
    });
  }
  $(".doma-repeater-list").each(function(){ initSort($(this)); });

  // ── MEDIA: IMAGE ──
  var imgFrame;
  $(document).on("click", ".doma-upload-img-btn", function(e){
    e.preventDefault();
    var $btn  = $(this);
    var $row  = $btn.closest(".doma-repeater-row");
    var $idIn = $row.find(".doma-img-id").first();
    var $thumb= $row.find(".doma-gallery-thumb").first();
    imgFrame = wp.media({ title:"Select Image", button:{text:"Use this image"}, library:{type:"image"}, multiple:false });
    imgFrame.on("select", function(){
      var a = imgFrame.state().get("selection").first().toJSON();
      $idIn.val(a.id);
      var url = (a.sizes && a.sizes.thumbnail) ? a.sizes.thumbnail.url : a.url;
      $thumb.html("<img src=\\""+url+"\\" alt=\\"\\" />");
      $btn.text("Change Image");
    });
    imgFrame.open();
  });

  // ── MEDIA: PDF ──
  var pdfFrame;
  $(document).on("click", ".doma-upload-pdf-btn", function(e){
    e.preventDefault();
    var $btn   = $(this);
    var $row   = $btn.closest(".doma-repeater-row");
    var $fileId= $row.find(".doma-file-id");
    var $label = $row.find(".doma-file-label");
    pdfFrame = wp.media({ title:"Select PDF", button:{text:"Use this file"}, library:{type:"application/pdf"}, multiple:false });
    pdfFrame.on("select", function(){
      var a = pdfFrame.state().get("selection").first().toJSON();
      $fileId.val(a.id);
      var name = a.filename || a.url.split("/").pop();
      $label.removeClass("doma-no-file").html("<span class=\\"dashicons dashicons-yes-alt\\" style=\\"color:#3ecf8e\\"></span> "+name);
      $btn.html("<span class=\\"dashicons dashicons-upload\\"></span> Change PDF");
    });
    pdfFrame.open();
  });

  // ── PROGRESS BAR ──
  $(document).on("input change","input[name=doma_completion]",function(){
    var v = Math.min(100, Math.max(0, parseInt($(this).val())||0));
    $(this).closest(".doma-progress-field")
      .find(".doma-progress-bar").css("width",v+"%").end()
      .find(".doma-progress-label").text(v+"%");
  });

}(jQuery));
'; }

/* ==========================================================
   END DOMA PROJECTS
   ========================================================== */


   /* ==========================================
   Projects Section Customizer
========================================== */

add_action('customize_register', 'doma_projects_customizer');

function doma_projects_customizer($wp_customize){

    $wp_customize->add_section('doma_projects_section', array(
        'title'    => __('Projects Section', 'doma'),
        'priority' => 30,
    ));

    // Section Label
    $wp_customize->add_setting('doma_projects_label', array(
        'default' => 'Featured Projects',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('doma_projects_label', array(
        'label'   => 'Section Label',
        'section' => 'doma_projects_section',
        'type'    => 'text',
    ));

    // Section Title
    $wp_customize->add_setting('doma_projects_title', array(
        'default' => 'Our',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('doma_projects_title', array(
        'label'   => 'Section Title',
        'section' => 'doma_projects_section',
        'type'    => 'text',
    ));

    // Highlight Text
    $wp_customize->add_setting('doma_projects_highlight', array(
        'default' => 'Landmark',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('doma_projects_highlight', array(
        'label'   => 'Highlight Text',
        'section' => 'doma_projects_section',
        'type'    => 'text',
    ));

    // Last Title
    $wp_customize->add_setting('doma_projects_title_last', array(
        'default' => 'Ventures',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('doma_projects_title_last', array(
        'label'   => 'Last Title Text',
        'section' => 'doma_projects_section',
        'type'    => 'text',
    ));

    // Button Text
    $wp_customize->add_setting('doma_projects_btn_text', array(
        'default' => 'View All',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('doma_projects_btn_text', array(
        'label'   => 'Button Text',
        'section' => 'doma_projects_section',
        'type'    => 'text',
    ));

    // Button URL
    $wp_customize->add_setting('doma_projects_btn_url', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('doma_projects_btn_url', array(
        'label'   => 'Button URL',
        'section' => 'doma_projects_section',
        'type'    => 'url',
    ));
}










// ================================================================
// DOMA HOLDING — Mission / Vision / Values
// CPT + Metaboxes + Dynamic Frontend (2 separate pages)
// All in functions.php — NO shortcode
// ================================================================


// ────────────────────────────────────────────────────────────────
// 1. REGISTER CPT: doma_about
// ────────────────────────────────────────────────────────────────
function doma_register_about_cpt() {
    register_post_type( 'doma_about', [
        'label'               => 'About page Section',
        'labels'              => [
            'name'          => 'About page Sections',
            'singular_name' => 'About page Section',
            'add_new_item'  => 'Add About page Section',
            'edit_item'     => 'Edit About page Section',
        ],
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_icon'           => 'dashicons-id-alt',
        'menu_position'       => 5,
        'supports'            => [ 'title' ],
        'show_in_rest'        => false,
    ]);
}
add_action( 'init', 'doma_register_about_cpt' );


// ────────────────────────────────────────────────────────────────
// 2. REGISTER ALL METABOXES
// ────────────────────────────────────────────────────────────────
function doma_about_add_metaboxes() {

    add_meta_box(
        'doma_mission_box',
        '📌 Tab 1 — Mission',
        'doma_mission_metabox_cb',
        'doma_about', 'normal', 'high'
    );

    add_meta_box(
        'doma_vision_box',
        '👁 Tab 2 — Vision',
        'doma_vision_metabox_cb',
        'doma_about', 'normal', 'high'
    );

    add_meta_box(
        'doma_values_box',
        '⭐ Tab 3 — Values',
        'doma_values_metabox_cb',
        'doma_about', 'normal', 'high'
    );
}
add_action( 'add_meta_boxes', 'doma_about_add_metaboxes' );


// ────────────────────────────────────────────────────────────────
// 3. METABOX FIELD HELPERS
// ────────────────────────────────────────────────────────────────
function doma_field_text( $post_id, $key, $label, $placeholder = '' ) {
    $val = esc_attr( get_post_meta( $post_id, $key, true ) );
    echo "
    <p>
        <label style='font-weight:600;font-size:12px;color:#555;display:block;margin-bottom:4px;'>
            {$label}
        </label>
        <input
            type='text'
            name='{$key}'
            value='{$val}'
            placeholder='{$placeholder}'
            style='width:100%;padding:7px 10px;border:1px solid #ddd;border-radius:4px;font-size:13px;'
        >
    </p>";
}

function doma_field_textarea( $post_id, $key, $label, $rows = 3 ) {
    $val = esc_textarea( get_post_meta( $post_id, $key, true ) );
    echo "
    <p>
        <label style='font-weight:600;font-size:12px;color:#555;display:block;margin-bottom:4px;'>
            {$label}
        </label>
        <textarea
            name='{$key}'
            rows='{$rows}'
            style='width:100%;padding:7px 10px;border:1px solid #ddd;border-radius:4px;font-size:13px;resize:vertical;'
        >{$val}</textarea>
    </p>";
}

function doma_group_label( $text ) {
    echo "
    <div style='
        background:#f0f4f8;
        border-left:4px solid #BC842B;
        padding:7px 12px;
        margin:18px 0 4px;
        font-size:12px;
        font-weight:700;
        color:#304A61;
        letter-spacing:.4px;
    '>{$text}</div>";
}


// ────────────────────────────────────────────────────────────────
// 4. METABOX CALLBACKS
// ────────────────────────────────────────────────────────────────

/* ══ MISSION ══ */
function doma_mission_metabox_cb( $post ) {
    wp_nonce_field( 'doma_about_save', 'doma_about_nonce' );
    $id = $post->ID;

    echo "<div style='font-family:sans-serif;padding:4px 0;'>";
    echo "<p style='color:#888;font-size:12px;margin:0 0 12px;'>
            Wrap gold text in titles with <code>{{double braces}}</code>
          </p>";

    doma_field_text    ( $id, '_mission_label', 'Section Label',                    'e.g. Our Mission' );
    doma_field_text    ( $id, '_mission_title', 'Section Title  ({{gold}} text)',    'e.g. Creating {{Compounding Value}} Across Generations' );
    doma_field_textarea( $id, '_mission_para1', 'Paragraph 1', 3 );
    doma_field_textarea( $id, '_mission_para2', 'Paragraph 2', 3 );

    for ( $i = 1; $i <= 4; $i++ ) {
        doma_group_label( "Icon Card #{$i}" );
        doma_field_text( $id, "_mission_card{$i}_icon",  'Font Awesome Class', 'e.g. fa-bullseye' );
        doma_field_text( $id, "_mission_card{$i}_title", 'Card Title' );
        doma_field_text( $id, "_mission_card{$i}_desc",  'Card Description' );
    }

    echo "</div>";
}

/* ══ VISION ══ */
function doma_vision_metabox_cb( $post ) {
    $id = $post->ID;

    echo "<div style='font-family:sans-serif;padding:4px 0;'>";
    echo "<p style='color:#888;font-size:12px;margin:0 0 12px;'>
            Wrap gold text in titles with <code>{{double braces}}</code>
          </p>";

    doma_field_text    ( $id, '_vision_label',      'Section Label',                 'e.g. Our Vision' );
    doma_field_text    ( $id, '_vision_title',      'Section Title ({{gold}} text)',  'e.g. To Be the {{Most Trusted}} Holding Group in MENA by 2035' );
    doma_field_textarea( $id, '_vision_para',       'Paragraph', 3 );
    doma_field_text    ( $id, '_vision_year',       'Year Highlight Box — Year',      'e.g. 2035' );
    doma_field_text    ( $id, '_vision_year_label', 'Year Highlight Box — Sub Label', 'e.g. Our strategic vision horizon' );

    for ( $i = 1; $i <= 4; $i++ ) {
        doma_group_label( "Checklist Item #{$i}" );
        doma_field_text( $id, "_vision_check{$i}", 'Checklist Text' );
    }

    echo "</div>";
}

/* ══ VALUES ══ */
function doma_values_metabox_cb( $post ) {
    $id = $post->ID;

    echo "<div style='font-family:sans-serif;padding:4px 0;'>";
    echo "<p style='color:#888;font-size:12px;margin:0 0 12px;'>
            Wrap gold text in titles with <code>{{double braces}}</code>
          </p>";

    doma_field_text( $id, '_values_label', 'Section Label',                 'e.g. Core Values' );
    doma_field_text( $id, '_values_title', 'Section Title ({{gold}} text)', 'e.g. The {{Principles}} That Guide Us' );

    for ( $i = 1; $i <= 4; $i++ ) {
        doma_group_label( "Value Card #{$i}" );
        doma_field_text( $id, "_values_card{$i}_icon",  'Font Awesome Class', 'e.g. fa-balance-scale' );
        doma_field_text( $id, "_values_card{$i}_title", 'Card Title' );
        doma_field_text( $id, "_values_card{$i}_desc",  'Card Description' );
    }

    echo "</div>";
}


// ────────────────────────────────────────────────────────────────
// 5. SAVE META
// ────────────────────────────────────────────────────────────────
function doma_about_save_meta( $post_id ) {
    if (
        ! isset( $_POST['doma_about_nonce'] )                        ||
        ! wp_verify_nonce( $_POST['doma_about_nonce'], 'doma_about_save' ) ||
        ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )              ||
        ! current_user_can( 'edit_post', $post_id )
    ) return;

    // Text fields — sanitize_text_field
    $text_fields = [
        '_mission_label', '_mission_title',
        '_mission_card1_icon', '_mission_card1_title', '_mission_card1_desc',
        '_mission_card2_icon', '_mission_card2_title', '_mission_card2_desc',
        '_mission_card3_icon', '_mission_card3_title', '_mission_card3_desc',
        '_mission_card4_icon', '_mission_card4_title', '_mission_card4_desc',

        '_vision_label', '_vision_title',
        '_vision_year', '_vision_year_label',
        '_vision_check1', '_vision_check2', '_vision_check3', '_vision_check4',

        '_values_label', '_values_title',
        '_values_card1_icon', '_values_card1_title', '_values_card1_desc',
        '_values_card2_icon', '_values_card2_title', '_values_card2_desc',
        '_values_card3_icon', '_values_card3_title', '_values_card3_desc',
        '_values_card4_icon', '_values_card4_title', '_values_card4_desc',
    ];

    foreach ( $text_fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }

    // Textarea fields — preserve line breaks
    $textarea_fields = [ '_mission_para1', '_mission_para2', '_vision_para' ];

    foreach ( $textarea_fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, $field, sanitize_textarea_field( $_POST[ $field ] ) );
        }
    }
}
add_action( 'save_post_doma_about', 'doma_about_save_meta' );


// ────────────────────────────────────────────────────────────────
// 6. HELPER: {{text}} → <span>text</span>
// ────────────────────────────────────────────────────────────────
function doma_parse_span( $str ) {
    return preg_replace( '/\{\{(.+?)\}\}/', '<span>$1</span>', esc_html( $str ) );
}

// ────────────────────────────────────────────────────────────────
// HELPER: get the first published doma_about post ID
// ────────────────────────────────────────────────────────────────
function doma_get_about_post_id() {
    $posts = get_posts([
        'post_type'      => 'doma_about',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'fields'         => 'ids',
    ]);
    return ! empty( $posts ) ? $posts[0] : 0;
}


// ────────────────────────────────────────────────────────────────
// 7. TEMPLATE LOADER
//    Page slug "about-mission"  → Mission+Values section
//    Page slug "about-vision"   → Vision section
// ────────────────────────────────────────────────────────────────
function doma_about_template_loader( $template ) {
    if ( is_page( 'about-mission' ) || is_page( 'about-vision' ) ) {
        return; // handled below via template_redirect
    }
    return $template;
}

add_action( 'template_redirect', function() {

    if ( is_page( 'about-mission' ) ) {
        $post_id = doma_get_about_post_id();
        doma_render_mission_page( $post_id );
        exit;
    }

    if ( is_page( 'about-vision' ) ) {
        $post_id = doma_get_about_post_id();
        doma_render_vision_page( $post_id );
        exit;
    }
});




// contact page template loader


// ================================================================
// DOMA HOLDING — Contact Page Full System
// CPTs + Metaboxes + Form Submissions + Admin Tables + Frontend
// ================================================================


// ────────────────────────────────────────────────────────────────
// 1. REGISTER CPTs
// ────────────────────────────────────────────────────────────────
function doma_contact_register_cpts() {

    // ── CPT 1: Contact Settings (offices, strip, social, map) ──
    register_post_type( 'doma_contact_info', [
        'label'         => 'Contact Settings',
        'labels'        => [
            'name'          => 'Contact Settings',
            'singular_name' => 'Contact Setting',
            'add_new_item'  => 'Add Contact Setting',
            'edit_item'     => 'Edit Contact Setting',
        ],
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-phone',
        'menu_position' => 6,
        'supports'      => [ 'title' ],
    ]);

    // ── CPT 2: Inquiry Submissions ──
    register_post_type( 'doma_inquiry', [
        'label'         => 'Inquiries',
        'labels'        => [
            'name'          => 'Inquiries',
            'singular_name' => 'Inquiry',
        ],
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => 'doma_contact_hub',
        'supports'      => [ 'title' ],
        'capabilities'  => [
            'create_posts' => 'do_not_allow',
        ],
        'map_meta_cap'  => true,
    ]);

    // ── CPT 3: Landowner Submissions ──
    register_post_type( 'doma_landowner', [
        'label'         => 'Landowner Submissions',
        'labels'        => [
            'name'          => 'Landowner Submissions',
            'singular_name' => 'Landowner Submission',
        ],
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => 'doma_contact_hub',
        'supports'      => [ 'title' ],
        'capabilities'  => [
            'create_posts' => 'do_not_allow',
        ],
        'map_meta_cap'  => true,
    ]);
}
add_action( 'init', 'doma_contact_register_cpts' );


// ────────────────────────────────────────────────────────────────
// 2. CUSTOM ADMIN MENU HUB  (groups all 3 under one parent)
// ────────────────────────────────────────────────────────────────
function doma_contact_hub_menu() {
    add_menu_page(
        'Doma Contact Hub',
        'Contact Hub',
        'manage_options',
        'doma_contact_hub',
        'doma_contact_hub_page',
        'dashicons-building',
        6
    );

    add_submenu_page(
        'doma_contact_hub',
        'Contact Settings',
        '⚙ Contact Settings',
        'manage_options',
        'edit.php?post_type=doma_contact_info'
    );

    add_submenu_page(
        'doma_contact_hub',
        'Inquiries',
        '📩 Inquiries',
        'manage_options',
        'edit.php?post_type=doma_inquiry'
    );

    add_submenu_page(
        'doma_contact_hub',
        'Landowner Submissions',
        '🏗 Landowner Submissions',
        'manage_options',
        'edit.php?post_type=doma_landowner'
    );
}
add_action( 'admin_menu', 'doma_contact_hub_menu' );

function doma_contact_hub_page() {
    echo '<div class="wrap"><h1>Doma Contact Hub</h1>
    <p>Use the submenu to manage Contact Settings, view Inquiries, and Landowner Submissions.</p></div>';
}


// ────────────────────────────────────────────────────────────────
// 3. METABOX FIELD HELPERS
// ────────────────────────────────────────────────────────────────
function doma_cf_text( $post_id, $key, $label, $placeholder = '' ) {
    $val = esc_attr( get_post_meta( $post_id, $key, true ) );
    echo "<p>
        <label style='font-weight:600;font-size:12px;color:#555;display:block;margin-bottom:4px;'>{$label}</label>
        <input type='text' name='{$key}' value='{$val}' placeholder='{$placeholder}'
            style='width:100%;padding:7px 10px;border:1px solid #ddd;border-radius:4px;font-size:13px;'>
    </p>";
}

function doma_cf_url( $post_id, $key, $label, $placeholder = '' ) {
    $val = esc_attr( get_post_meta( $post_id, $key, true ) );
    echo "<p>
        <label style='font-weight:600;font-size:12px;color:#555;display:block;margin-bottom:4px;'>{$label}</label>
        <input type='url' name='{$key}' value='{$val}' placeholder='{$placeholder}'
            style='width:100%;padding:7px 10px;border:1px solid #ddd;border-radius:4px;font-size:13px;'>
    </p>";
}

function doma_cf_group( $label ) {
    echo "<div style='background:#f0f4f8;border-left:4px solid #BC842B;padding:7px 12px;
        margin:18px 0 4px;font-size:12px;font-weight:700;color:#304A61;letter-spacing:.4px;'>
        {$label}</div>";
}

function doma_cf_readonly( $label, $value ) {
    echo "<p>
        <label style='font-weight:600;font-size:12px;color:#555;display:block;margin-bottom:4px;'>{$label}</label>
        <input type='text' value='" . esc_attr($value) . "' readonly
            style='width:100%;padding:7px 10px;border:1px solid #eee;border-radius:4px;
            font-size:13px;background:#f9f9f9;color:#888;'>
    </p>";
}


// ────────────────────────────────────────────────────────────────
// 4. CONTACT SETTINGS METABOXES
// ────────────────────────────────────────────────────────────────
function doma_contact_info_metaboxes() {

    add_meta_box( 'doma_strip_box',   '📞 Contact Strip',       'doma_strip_metabox_cb',   'doma_contact_info', 'normal', 'high' );
    add_meta_box( 'doma_offices_box', '🏢 Office Cards',         'doma_offices_metabox_cb', 'doma_contact_info', 'normal', 'high' );
    add_meta_box( 'doma_social_box',  '🔗 Social Media Links',   'doma_social_metabox_cb',  'doma_contact_info', 'normal', 'high' );
    add_meta_box( 'doma_map_box',     '🗺 Map Section',           'doma_map_metabox_cb',     'doma_contact_info', 'normal', 'high' );
    add_meta_box( 'doma_form_box',    '📋 Contact Form Labels',  'doma_form_metabox_cb',    'doma_contact_info', 'normal', 'high' );
    add_meta_box( 'doma_landform_box','🏗 Landowner Form Labels', 'doma_landform_metabox_cb','doma_contact_info', 'normal', 'high' );
}
add_action( 'add_meta_boxes_doma_contact_info', 'doma_contact_info_metaboxes' );


// ── Strip ──
function doma_strip_metabox_cb( $post ) {
    wp_nonce_field( 'doma_contact_save', 'doma_contact_nonce' );
    $id = $post->ID;
    doma_cf_text( $id, '_strip_phone',  'Phone Number',  '+971 4 123 4567' );
    doma_cf_text( $id, '_strip_email',  'Email Address', 'hello@domaholding.com' );
    doma_cf_text( $id, '_strip_hq',     'Headquarters',  'Business Bay, Dubai' );
    doma_cf_text( $id, '_strip_hours',  'Office Hours',  'Mon–Fri, 9AM–6PM GST' );
}

// ── Offices ──
function doma_offices_metabox_cb( $post ) {
    $id = $post->ID;
    $offices = [ 'dubai' => 'Dubai HQ', 'riyadh' => 'Riyadh Office', 'cairo' => 'Cairo Office' ];
    foreach ( $offices as $key => $label ) {
        doma_cf_group( $label );
        doma_cf_text( $id, "_office_{$key}_name",    'Office Name',   "e.g. Headquarters — Dubai" );
        doma_cf_text( $id, "_office_{$key}_badge",   'Badge Label',   "e.g. Main Office" );
        doma_cf_text( $id, "_office_{$key}_address", 'Address' );
        doma_cf_text( $id, "_office_{$key}_phone",   'Phone' );
        doma_cf_text( $id, "_office_{$key}_email",   'Email' );
    }
}

// ── Social ──
function doma_social_metabox_cb( $post ) {
    $id = $post->ID;
    $socials = [
        'linkedin'  => 'LinkedIn URL',
        'twitter'   => 'Twitter / X URL',
        'instagram' => 'Instagram URL',
        'youtube'   => 'YouTube URL',
        'whatsapp'  => 'WhatsApp Link',
    ];
    foreach ( $socials as $key => $label ) {
        doma_cf_url( $id, "_social_{$key}", $label, 'https://' );
    }
}

// ── Map ──
function doma_map_metabox_cb( $post ) {
    $id = $post->ID;
    doma_cf_text( $id, '_map_title',       'Map Title',          'Doma Tower, Business Bay' );
    doma_cf_text( $id, '_map_subtitle',    'Map Subtitle',       'Dubai, United Arab Emirates · 25.1857°N 55.2614°E' );
    doma_cf_url ( $id, '_map_google_url',  'Google Maps URL',    'https://maps.google.com/?q=...' );
    doma_cf_text( $id, '_map_section_title','Section Title ({{gold}} for span)', 'Our {{Headquarters}}' );
}

// ── Contact Form labels/enquiry types ──
function doma_form_metabox_cb( $post ) {
    $id = $post->ID;
    doma_cf_text( $id, '_form_section_label', 'Section Label', 'Send a Message' );
    doma_cf_text( $id, '_form_title',         'Form Title ({{gold}} span)', 'Tell Us About Your {{Project}}' );
    doma_cf_text( $id, '_form_enquiry_types', 'Enquiry Types (comma-separated)',
        'Investment Opportunity, Development Partnership, Project Enquiry, Media & Press, Career Opportunity, General Enquiry' );
}

// ── Landowner Form labels ──
function doma_landform_metabox_cb( $post ) {
    $id = $post->ID;
    doma_cf_text( $id, '_landform_title',      'Form Title',        'MEET THE PROFESSIONALS' );
    doma_cf_text( $id, '_landform_categories', 'Land Categories (comma-separated)', 'Residential, Commercial, Industrial' );
    doma_cf_text( $id, '_landform_features',   'Attractive Features (comma-separated)', 'Corner Plot, Lake View, Main Road' );
}


// ────────────────────────────────────────────────────────────────
// 5. INQUIRY SUBMISSION METABOXES (read-only view)
// ────────────────────────────────────────────────────────────────
function doma_inquiry_metaboxes() {
    add_meta_box( 'doma_inquiry_data', '📩 Inquiry Details', 'doma_inquiry_data_cb', 'doma_inquiry', 'normal', 'high' );
}
add_action( 'add_meta_boxes_doma_inquiry', 'doma_inquiry_metaboxes' );

function doma_inquiry_data_cb( $post ) {
    $id = $post->ID;
    $fields = [
        '_inq_full_name'    => 'Full Name',
        '_inq_email'        => 'Email Address',
        '_inq_phone'        => 'Phone Number',
        '_inq_company'      => 'Company / Organisation',
        '_inq_enquiry_type' => 'Enquiry Type',
        '_inq_subject'      => 'Subject',
        '_inq_message'      => 'Message',
        '_inq_submitted_at' => 'Submitted At',
        '_inq_status'       => 'Status',
    ];
    echo "<div style='font-family:sans-serif;'>";
    foreach ( $fields as $key => $label ) {
        doma_cf_readonly( $label, get_post_meta( $id, $key, true ) );
    }
    echo "</div>";
}


// ────────────────────────────────────────────────────────────────
// 6. LANDOWNER SUBMISSION METABOXES (read-only view)
// ────────────────────────────────────────────────────────────────
function doma_landowner_metaboxes() {
    add_meta_box( 'doma_landowner_data', '🏗 Landowner Submission Details', 'doma_landowner_data_cb', 'doma_landowner', 'normal', 'high' );
}
add_action( 'add_meta_boxes_doma_landowner', 'doma_landowner_metaboxes' );

function doma_landowner_data_cb( $post ) {
    $id = $post->ID;
    $fields = [
        '_lo_locality'      => 'Locality',
        '_lo_address'       => 'Address',
        '_lo_land_size'     => 'Size of Land (Kathas)',
        '_lo_road_width'    => 'Road Width (Feet)',
        '_lo_category'      => 'Land Category',
        '_lo_facing'        => 'Facing',
        '_lo_features'      => 'Attractive Features',
        '_lo_owner_name'    => 'Landowner Name',
        '_lo_owner_email'   => 'Landowner Email',
        '_lo_owner_phone'   => 'Contact Number',
        '_lo_submitted_at'  => 'Submitted At',
        '_lo_status'        => 'Status',
    ];
    echo "<div style='font-family:sans-serif;'>";
    foreach ( $fields as $key => $label ) {
        doma_cf_readonly( $label, get_post_meta( $id, $key, true ) );
    }
    echo "</div>";
}


// ────────────────────────────────────────────────────────────────
// 7. SAVE CONTACT SETTINGS META
// ────────────────────────────────────────────────────────────────
function doma_contact_save_meta( $post_id ) {
    if (
        ! isset( $_POST['doma_contact_nonce'] ) ||
        ! wp_verify_nonce( $_POST['doma_contact_nonce'], 'doma_contact_save' ) ||
        ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) ||
        ! current_user_can( 'edit_post', $post_id )
    ) return;

    $fields = [
        '_strip_phone', '_strip_email', '_strip_hq', '_strip_hours',
        '_office_dubai_name',   '_office_dubai_badge',   '_office_dubai_address',   '_office_dubai_phone',   '_office_dubai_email',
        '_office_riyadh_name',  '_office_riyadh_badge',  '_office_riyadh_address',  '_office_riyadh_phone',  '_office_riyadh_email',
        '_office_cairo_name',   '_office_cairo_badge',   '_office_cairo_address',   '_office_cairo_phone',   '_office_cairo_email',
        '_social_linkedin', '_social_twitter', '_social_instagram', '_social_youtube', '_social_whatsapp',
        '_map_title', '_map_subtitle', '_map_google_url', '_map_section_title',
        '_form_section_label', '_form_title', '_form_enquiry_types',
        '_landform_title', '_landform_categories', '_landform_features',
    ];

    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }
}
add_action( 'save_post_doma_contact_info', 'doma_contact_save_meta' );


// ────────────────────────────────────────────────────────────────
// 8. CUSTOM ADMIN COLUMNS — Inquiries
// ────────────────────────────────────────────────────────────────
function doma_inquiry_columns( $cols ) {
    return [
        'cb'                => $cols['cb'],
        'title'             => 'Ref #',
        'inq_name'          => 'Name',
        'inq_email'         => 'Email',
        'inq_type'          => 'Enquiry Type',
        'inq_subject'       => 'Subject',
        'inq_status'        => 'Status',
        'inq_date'          => 'Submitted',
    ];
}
add_filter( 'manage_doma_inquiry_posts_columns', 'doma_inquiry_columns' );

function doma_inquiry_column_data( $col, $post_id ) {
    $map = [
        'inq_name'    => '_inq_full_name',
        'inq_email'   => '_inq_email',
        'inq_type'    => '_inq_enquiry_type',
        'inq_subject' => '_inq_subject',
        'inq_date'    => '_inq_submitted_at',
    ];
    if ( isset( $map[ $col ] ) ) {
        echo esc_html( get_post_meta( $post_id, $map[ $col ], true ) );
    }
    if ( $col === 'inq_status' ) {
        $status = get_post_meta( $post_id, '_inq_status', true ) ?: 'New';
        $color  = $status === 'New' ? '#22c55e' : ( $status === 'Read' ? '#f59e0b' : '#8fa0b0' );
        echo "<span style='background:rgba(" . ($status==='New'?'34,197,94':'245,158,11') . ",.12);
            color:{$color};padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;
            border:1px solid {$color};'>{$status}</span>";
    }
}
add_action( 'manage_doma_inquiry_posts_custom_column', 'doma_inquiry_column_data', 10, 2 );


// ────────────────────────────────────────────────────────────────
// 9. CUSTOM ADMIN COLUMNS — Landowner Submissions
// ────────────────────────────────────────────────────────────────
function doma_landowner_columns( $cols ) {
    return [
        'cb'           => $cols['cb'],
        'title'        => 'Ref #',
        'lo_owner'     => 'Owner Name',
        'lo_email'     => 'Email',
        'lo_phone'     => 'Phone',
        'lo_address'   => 'Address',
        'lo_size'      => 'Land Size',
        'lo_category'  => 'Category',
        'lo_status'    => 'Status',
        'lo_date'      => 'Submitted',
    ];
}
add_filter( 'manage_doma_landowner_posts_columns', 'doma_landowner_columns' );

function doma_landowner_column_data( $col, $post_id ) {
    $map = [
        'lo_owner'    => '_lo_owner_name',
        'lo_email'    => '_lo_owner_email',
        'lo_phone'    => '_lo_owner_phone',
        'lo_address'  => '_lo_address',
        'lo_size'     => '_lo_land_size',
        'lo_category' => '_lo_category',
        'lo_date'     => '_lo_submitted_at',
    ];
    if ( isset( $map[ $col ] ) ) {
        echo esc_html( get_post_meta( $post_id, $map[ $col ], true ) );
    }
    if ( $col === 'lo_status' ) {
        $status = get_post_meta( $post_id, '_lo_status', true ) ?: 'New';
        $color  = $status === 'New' ? '#22c55e' : '#f59e0b';
        echo "<span style='background:rgba(34,197,94,.12);color:{$color};
            padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;
            border:1px solid {$color};'>{$status}</span>";
    }
}
add_action( 'manage_doma_landowner_posts_custom_column', 'doma_landowner_column_data', 10, 2 );


// ────────────────────────────────────────────────────────────────
// 10. AJAX — CONTACT FORM SUBMIT
// ────────────────────────────────────────────────────────────────
add_action( 'wp_ajax_doma_submit_inquiry',        'doma_handle_inquiry_submission' );
add_action( 'wp_ajax_nopriv_doma_submit_inquiry', 'doma_handle_inquiry_submission' );

function doma_handle_inquiry_submission() {
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'doma_contact_nonce' ) ) {
        wp_send_json_error( [ 'message' => 'Security check failed.' ] );
    }

    $name    = sanitize_text_field( $_POST['full_name']    ?? '' );
    $email   = sanitize_email      ( $_POST['email']       ?? '' );
    $phone   = sanitize_text_field( $_POST['phone']        ?? '' );
    $company = sanitize_text_field( $_POST['company']      ?? '' );
    $type    = sanitize_text_field( $_POST['enquiry_type'] ?? '' );
    $subject = sanitize_text_field( $_POST['subject']      ?? '' );
    $message = sanitize_textarea_field( $_POST['message']  ?? '' );

    if ( ! $name || ! $email || ! $type || ! $message ) {
        wp_send_json_error( [ 'message' => 'Please fill all required fields.' ] );
    }
    if ( ! is_email( $email ) ) {
        wp_send_json_error( [ 'message' => 'Invalid email address.' ] );
    }

    $post_id = wp_insert_post([
        'post_type'   => 'doma_inquiry',
        'post_title'  => 'INQ-' . strtoupper( substr( md5( time() ), 0, 6 ) ) . ' — ' . $name,
        'post_status' => 'publish',
    ]);

    if ( is_wp_error( $post_id ) ) {
        wp_send_json_error( [ 'message' => 'Could not save submission.' ] );
    }

    $fields = [
        '_inq_full_name'    => $name,
        '_inq_email'        => $email,
        '_inq_phone'        => $phone,
        '_inq_company'      => $company,
        '_inq_enquiry_type' => $type,
        '_inq_subject'      => $subject,
        '_inq_message'      => $message,
        '_inq_submitted_at' => current_time( 'Y-m-d H:i:s' ),
        '_inq_status'       => 'New',
    ];
    foreach ( $fields as $key => $val ) {
        update_post_meta( $post_id, $key, $val );
    }

    wp_send_json_success( [ 'message' => 'Message sent successfully!' ] );
}


// ────────────────────────────────────────────────────────────────
// 11. AJAX — LANDOWNER FORM SUBMIT
// ────────────────────────────────────────────────────────────────
add_action( 'wp_ajax_doma_submit_landowner',        'doma_handle_landowner_submission' );
add_action( 'wp_ajax_nopriv_doma_submit_landowner', 'doma_handle_landowner_submission' );

function doma_handle_landowner_submission() {
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'doma_landowner_nonce' ) ) {
        wp_send_json_error( [ 'message' => 'Security check failed.' ] );
    }

    $owner_name  = sanitize_text_field( $_POST['owner_name']  ?? '' );
    $owner_email = sanitize_email     ( $_POST['owner_email'] ?? '' );
    $owner_phone = sanitize_text_field( $_POST['owner_phone'] ?? '' );
    $address     = sanitize_text_field( $_POST['address']     ?? '' );

    if ( ! $owner_name || ! $owner_email || ! $owner_phone || ! $address ) {
        wp_send_json_error( [ 'message' => 'Please fill all required fields.' ] );
    }

    $post_id = wp_insert_post([
        'post_type'   => 'doma_landowner',
        'post_title'  => 'LO-' . strtoupper( substr( md5( time() ), 0, 6 ) ) . ' — ' . $owner_name,
        'post_status' => 'publish',
    ]);

    if ( is_wp_error( $post_id ) ) {
        wp_send_json_error( [ 'message' => 'Could not save submission.' ] );
    }

    $fields = [
        '_lo_locality'     => sanitize_text_field( $_POST['locality']   ?? '' ),
        '_lo_address'      => $address,
        '_lo_land_size'    => sanitize_text_field( $_POST['land_size']  ?? '' ),
        '_lo_road_width'   => sanitize_text_field( $_POST['road_width'] ?? '' ),
        '_lo_category'     => sanitize_text_field( $_POST['category']   ?? '' ),
        '_lo_facing'       => sanitize_text_field( $_POST['facing']     ?? '' ),
        '_lo_features'     => sanitize_text_field( $_POST['features']   ?? '' ),
        '_lo_owner_name'   => $owner_name,
        '_lo_owner_email'  => $owner_email,
        '_lo_owner_phone'  => $owner_phone,
        '_lo_submitted_at' => current_time( 'Y-m-d H:i:s' ),
        '_lo_status'       => 'New',
    ];
    foreach ( $fields as $key => $val ) {
        update_post_meta( $post_id, $key, $val );
    }

    wp_send_json_success( [ 'message' => 'Submission received!' ] );
}


// ────────────────────────────────────────────────────────────────
// 12. HELPER — get first published doma_contact_info post
// ────────────────────────────────────────────────────────────────
function doma_get_contact_settings_id() {
    $posts = get_posts([
        'post_type'      => 'doma_contact_info',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'fields'         => 'ids',
    ]);
    return ! empty( $posts ) ? $posts[0] : 0;
}

function doma_parse_gold_span( $str ) {
    return preg_replace( '/\{\{(.+?)\}\}/', '<span style="color:var(--gold,#BC842B);">$1</span>', esc_html( $str ) );
}





// faq custom post type and metaboxes


/*====================================================
=            FAQ CUSTOM POST TYPE
====================================================*/

function doma_register_faq_cpt() {

    register_post_type('doma_faq', array(

        'labels' => array(
            'name'               => 'FAQs',
            'singular_name'      => 'FAQ',
            'add_new'            => 'Add FAQ',
            'add_new_item'       => 'Add New FAQ',
            'edit_item'          => 'Edit FAQ',
            'new_item'           => 'New FAQ',
            'view_item'          => 'View FAQ',
            'search_items'       => 'Search FAQs',
            'not_found'          => 'No FAQs Found',
        ),

        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 25,
        'menu_icon'          => 'dashicons-editor-help',

        'supports' => array(
            'title'
        ),

        'has_archive'        => false,
        'publicly_queryable' => false,
        'show_in_rest'       => true,

    ));
}
add_action('init', 'doma_register_faq_cpt');


/*====================================================
=            FAQ METABOX
====================================================*/

function doma_faq_metabox() {

    add_meta_box(
        'doma_faq_details',
        'FAQ Description',
        'doma_faq_metabox_callback',
        'doma_faq',
        'normal',
        'high'
    );

}
add_action('add_meta_boxes', 'doma_faq_metabox');


function doma_faq_metabox_callback($post) {

    wp_nonce_field(
        'doma_faq_nonce_action',
        'doma_faq_nonce'
    );

    $description = get_post_meta(
        $post->ID,
        '_faq_description',
        true
    );
    ?>

    <div style="padding:10px 0;">

        <label style="
            display:block;
            font-weight:600;
            margin-bottom:10px;
            color:#333;
        ">
            FAQ Answer / Description
        </label>

        <textarea
            name="faq_description"
            rows="8"
            style="
                width:100%;
                padding:12px;
                border:1px solid #ddd;
                border-radius:6px;
            "
        ><?php echo esc_textarea($description); ?></textarea>

    </div>

    <?php
}


/*====================================================
=            SAVE FAQ METABOX
====================================================*/

function doma_save_faq_meta($post_id) {

    if (
        !isset($_POST['doma_faq_nonce']) ||
        !wp_verify_nonce(
            $_POST['doma_faq_nonce'],
            'doma_faq_nonce_action'
        )
    ) {
        return;
    }

    if (
        defined('DOING_AUTOSAVE')
        && DOING_AUTOSAVE
    ) {
        return;
    }

    if (
        !current_user_can(
            'edit_post',
            $post_id
        )
    ) {
        return;
    }

    if (
        isset($_POST['faq_description'])
    ) {

        update_post_meta(
            $post_id,
            '_faq_description',
            sanitize_textarea_field(
                $_POST['faq_description']
            )
        );

    }

}
add_action(
    'save_post_doma_faq',
    'doma_save_faq_meta'
);


/*====================================================
=            ADMIN COLUMN
====================================================*/

function doma_faq_columns($columns) {

    return array(
        'cb'          => $columns['cb'],
        'title'       => 'FAQ Question',
        'description' => 'FAQ Answer',
        'date'        => 'Date',
    );

}
add_filter(
    'manage_doma_faq_posts_columns',
    'doma_faq_columns'
);


function doma_faq_column_content(
    $column,
    $post_id
) {

    if ($column == 'description') {

        echo wp_trim_words(
            get_post_meta(
                $post_id,
                '_faq_description',
                true
            ),
            15
        );

    }

}
add_action(
    'manage_doma_faq_posts_custom_column',
    'doma_faq_column_content',
    10,
    2
);






// team member custom post type and metaboxes



/*=========================================
=            TEAM MEMBER CPT             =
=========================================*/

function register_team_member_cpt() {

    $args = array(
        'label' => 'Team Members',
         'labels' => array(
            'name' => 'Team Members',
            'singular_name' => 'Team Member',
            'add_new' => 'Add Team Member',
            'add_new_item' => 'Add New Team Member',
            'edit_item' => 'Edit Team Member',
            'new_item' => 'New Team Member',
            'view_item' => 'View Team Member',
            'search_items' => 'Search Team Members',
            'not_found' => 'No Team Members Found',
        ),
        'public' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => array(
            'title',
            'thumbnail'
        ),
        'show_in_rest' => true,
    );

    register_post_type('team_member', $args);

}
add_action('init', 'register_team_member_cpt');


/*=========================================
=            TEAM MEMBER METABOX         =
=========================================*/

function team_member_metabox() {

    add_meta_box(
        'team_member_details',
        'Team Member Details',
        'team_member_metabox_callback',
        'team_member',
        'normal',
        'high'
    );

}
add_action('add_meta_boxes', 'team_member_metabox');


function team_member_metabox_callback($post) {

    wp_nonce_field('team_member_nonce', 'team_member_nonce_field');

    $name        = get_post_meta($post->ID, '_team_name', true);
    $role        = get_post_meta($post->ID, '_team_role', true);
    $bio         = get_post_meta($post->ID, '_team_bio', true);
    $description = get_post_meta($post->ID, '_team_description', true);

    $socials = get_post_meta($post->ID, '_team_socials', true);

?>

<table class="form-table">

<tr>
    <th>Name</th>
    <td>
        <input type="text"
               name="team_name"
               value="<?php echo esc_attr($name); ?>"
               class="widefat">
    </td>
</tr>

<tr>
    <th>Role</th>
    <td>
        <input type="text"
               name="team_role"
               value="<?php echo esc_attr($role); ?>"
               class="widefat">
    </td>
</tr>

<tr>
    <th>Team Bio</th>
    <td>
        <textarea name="team_bio"
                  rows="4"
                  class="widefat"><?php echo esc_textarea($bio); ?></textarea>
    </td>
</tr>

<tr>
    <th>Short Description</th>
    <td>
        <textarea name="team_description"
                  rows="6"
                  class="widefat"><?php echo esc_textarea($description); ?></textarea>
    </td>
</tr>

<tr>
    <th>Social Media Links</th>
    <td>

        <div id="team-social-repeater">

            <?php if(!empty($socials)) : ?>

                <?php foreach($socials as $social) : ?>

                    <div class="team-social-row" style="margin-bottom:10px;padding:10px;border:1px solid #ddd;">

                        <input type="text"
                               name="team_social_icon[]"
                               value="<?php echo esc_attr($social['icon']); ?>"
                               placeholder="fab fa-linkedin-in"
                               style="width:30%;margin-right:10px;">

                        <input type="url"
                               name="team_social_url[]"
                               value="<?php echo esc_url($social['url']); ?>"
                               placeholder="https://example.com"
                               style="width:50%;margin-right:10px;">

                        <button type="button" class="button remove-social">
                            Remove
                        </button>

                    </div>

                <?php endforeach; ?>

            <?php else : ?>

                <div class="team-social-row" style="margin-bottom:10px;padding:10px;border:1px solid #ddd;">

                    <input type="text"
                           name="team_social_icon[]"
                           placeholder="fab fa-linkedin-in"
                           style="width:30%;margin-right:10px;">

                    <input type="url"
                           name="team_social_url[]"
                           placeholder="https://example.com"
                           style="width:50%;margin-right:10px;">

                    <button type="button" class="button remove-social">
                        Remove
                    </button>

                </div>

            <?php endif; ?>

        </div>

        <button type="button"
                class="button button-primary"
                id="add-social-row">
            Add Social Media
        </button>

        <p style="margin-top:10px;">
            Example Icons:
            <br>
            fab fa-linkedin-in
            <br>
            fab fa-twitter
            <br>
            fab fa-facebook-f
            <br>
            fab fa-instagram
            <br>
            fab fa-youtube
        </p>

    </td>
</tr>

</table>

<script>
jQuery(document).ready(function($){

    $('#add-social-row').on('click', function(){

        $('#team-social-repeater').append(`
            <div class="team-social-row" style="margin-bottom:10px;padding:10px;border:1px solid #ddd;">

                <input type="text"
                       name="team_social_icon[]"
                       placeholder="fab fa-linkedin-in"
                       style="width:30%;margin-right:10px;">

                <input type="url"
                       name="team_social_url[]"
                       placeholder="https://example.com"
                       style="width:50%;margin-right:10px;">

                <button type="button" class="button remove-social">
                    Remove
                </button>

            </div>
        `);

    });

    $(document).on('click', '.remove-social', function(){

        $(this).closest('.team-social-row').remove();

    });

});
</script>

<?php
}


/*=========================================
=            SAVE METABOX DATA           =
=========================================*/

function save_team_member_data($post_id) {

    if (
        !isset($_POST['team_member_nonce_field']) ||
        !wp_verify_nonce(
            $_POST['team_member_nonce_field'],
            'team_member_nonce'
        )
    ) {
        return;
    }

    update_post_meta(
        $post_id,
        '_team_name',
        sanitize_text_field($_POST['team_name'])
    );

    update_post_meta(
        $post_id,
        '_team_role',
        sanitize_text_field($_POST['team_role'])
    );

    update_post_meta(
        $post_id,
        '_team_bio',
        sanitize_textarea_field($_POST['team_bio'])
    );

    update_post_meta(
        $post_id,
        '_team_description',
        sanitize_textarea_field($_POST['team_description'])
    );

    if(isset($_POST['team_social_icon'])) {

        $socials = array();

        foreach($_POST['team_social_icon'] as $key => $icon) {

            if(
                !empty($icon) ||
                !empty($_POST['team_social_url'][$key])
            ) {

                $socials[] = array(
                    'icon' => sanitize_text_field($icon),
                    'url'  => esc_url_raw($_POST['team_social_url'][$key])
                );
            }
        }

        update_post_meta(
            $post_id,
            '_team_socials',
            $socials
        );
    }

}
add_action('save_post_team_member', 'save_team_member_data');