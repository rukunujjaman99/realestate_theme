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