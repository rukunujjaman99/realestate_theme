<?php
// Template Name: Contact Page

get_header(); 

?>

<!-- PAGE HERO -->
<section class="page-hero" style="position:relative;overflow:hidden;">
  <div class="page-hero-bg"></div>
  <div class="grid-pattern"></div>
  <div class="particles-bg"></div>
  <div class="geo-blob blob-gold" style="width:500px;height:500px;top:-150px;right:-120px;position:absolute;z-index:1;"></div>
  <div class="geo-blob blob-navy" style="width:350px;height:350px;bottom:-80px;left:-60px;position:absolute;z-index:1;"></div>
  <div class="container position-relative" style="z-index:2;">
    <div class="section-label" style="justify-content:center;"><i class="fas fa-paper-plane"></i>&nbsp; Let's Talk</div>
    <h1 class="page-hero-title">Contact <span style="color:var(--gold);">Us</span></h1>
    <p style="color:var(--grey);font-size:.92rem;margin-top:12px;max-width:500px;margin-left:auto;margin-right:auto;">Whether you're an investor, developer, or prospective partner — our team is ready to respond within 24 hours.</p>
    <div class="page-breadcrumb">
      <a href="index.html">Home</a><i class="fas fa-chevron-right"></i>
      <span style="color:var(--gold);">Contact</span>
    </div>
  </div>
</section>


<?php
$settings_id = doma_get_contact_settings_id();

if ( ! $settings_id ) {
    return;
}
?>

<!-- ═══ CONTACT QUICK INFO STRIP ═══ -->
<?php
$phone = get_post_meta($settings_id, '_strip_phone', true);
$email = get_post_meta($settings_id, '_strip_email', true);
$hq    = get_post_meta($settings_id, '_strip_hq', true);
$hours = get_post_meta($settings_id, '_strip_hours', true);
?>

<div style="background:linear-gradient(90deg,var(--navy-dark),var(--bg-card),var(--navy-dark));border-top:1px solid rgba(188,132,43,.15);border-bottom:1px solid rgba(188,132,43,.15);">
    <div class="container">
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:0;">

            <div class="reveal delay-100" style="display:flex;align-items:center;gap:14px;padding:22px 20px;border-right:1px solid rgba(255,255,255,.06);">
                <div style="width:44px;height:44px;border-radius:var(--radius-sm);background:var(--gold-pale);border:1px solid rgba(188,132,43,.25);display:flex;align-items:center;justify-content:center;color:var(--gold);">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div>
                    <div style="font-size:.7rem;color:var(--grey);text-transform:uppercase;">Call Us</div>
                    <div style="font-size:.88rem;font-weight:600;">
                        <?php echo esc_html($phone); ?>
                    </div>
                </div>
            </div>

            <div class="reveal delay-200" style="display:flex;align-items:center;gap:14px;padding:22px 20px;border-right:1px solid rgba(255,255,255,.06);">
                <div style="width:44px;height:44px;border-radius:var(--radius-sm);background:var(--gold-pale);border:1px solid rgba(188,132,43,.25);display:flex;align-items:center;justify-content:center;color:var(--gold);">
                    <i class="fas fa-envelope"></i>
                </div>
                <div>
                    <div style="font-size:.7rem;color:var(--grey);text-transform:uppercase;">Email Us</div>
                    <div style="font-size:.88rem;font-weight:600;">
                        <?php echo esc_html($email); ?>
                    </div>
                </div>
            </div>

            <div class="reveal delay-300" style="display:flex;align-items:center;gap:14px;padding:22px 20px;border-right:1px solid rgba(255,255,255,.06);">
                <div style="width:44px;height:44px;border-radius:var(--radius-sm);background:var(--gold-pale);border:1px solid rgba(188,132,43,.25);display:flex;align-items:center;justify-content:center;color:var(--gold);">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div>
                    <div style="font-size:.7rem;color:var(--grey);text-transform:uppercase;">Headquarters</div>
                    <div style="font-size:.88rem;font-weight:600;">
                        <?php echo esc_html($hq); ?>
                    </div>
                </div>
            </div>

            <div class="reveal delay-400" style="display:flex;align-items:center;gap:14px;padding:22px 20px;">
                <div style="width:44px;height:44px;border-radius:var(--radius-sm);background:var(--gold-pale);border:1px solid rgba(188,132,43,.25);display:flex;align-items:center;justify-content:center;color:var(--gold);">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div style="font-size:.7rem;color:var(--grey);text-transform:uppercase;">Office Hours</div>
                    <div style="font-size:.88rem;font-weight:600;">
                        <?php echo esc_html($hours); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- ═══ MAIN CONTACT CONTENT ═══ -->
<section class="section-pad">
  <div class="container">
    <div class="row g-5">

      <!-- CONTACT FORM -->
<?php
$settings_id = doma_get_contact_settings_id();

$form_label = get_post_meta($settings_id, '_form_section_label', true);
$form_title = get_post_meta($settings_id, '_form_title', true);

$enquiry_types_string = get_post_meta(
    $settings_id,
    '_form_enquiry_types',
    true
);

$enquiry_types = !empty($enquiry_types_string)
    ? array_map('trim', explode(',', $enquiry_types_string))
    : [
        'Investment Opportunity',
        'Development Partnership',
        'Project Enquiry',
        'Media & Press',
        'Career Opportunity',
        'General Enquiry'
    ];
?>

<div class="col-lg-6">

    <div class="reveal-left">
        <div class="section-label">
            <?php echo esc_html($form_label ?: 'Send a Message'); ?>
        </div>

        <h2 class="section-title" style="font-size:clamp(1.6rem,3vw,2.4rem);">
            <?php echo doma_parse_gold_span($form_title ?: 'Tell Us About Your {{Project}}'); ?>
        </h2>

        <div class="gold-line"></div>
    </div>

    <div class="contact-form-wrap reveal-left delay-200">

        <div id="formSuccess"
             style="display:none;background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.3);border-radius:var(--radius);padding:18px 22px;margin-bottom:22px;">

            <div style="display:flex;align-items:center;gap:12px;">
                <i class="fas fa-check-circle"
                   style="color:#22c55e;font-size:1.4rem;"></i>

                <div>
                    <div style="font-weight:700;">
                        Message sent successfully!
                    </div>

                    <div style="font-size:.82rem;color:var(--grey);">
                        Our team will respond within 24 hours.
                    </div>
                </div>
            </div>

        </div>

        <form id="contactForm">

            <input type="hidden"
                   name="action"
                   value="doma_submit_inquiry">

            <input type="hidden"
                   name="nonce"
                   value="<?php echo wp_create_nonce('doma_contact_nonce'); ?>">

            <div class="row g-3">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Full Name *</label>

                        <input type="text"
                               name="full_name"
                               class="form-control-custom"
                               placeholder="Your full name"
                               required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Email Address *</label>

                        <input type="email"
                               name="email"
                               class="form-control-custom"
                               placeholder="your@email.com"
                               required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>

                        <input type="tel"
                               name="phone"
                               class="form-control-custom"
                               placeholder="+971 XX XXX XXXX">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">
                            Company / Organisation
                        </label>

                        <input type="text"
                               name="company"
                               class="form-control-custom"
                               placeholder="Your company name">
                    </div>
                </div>

                <!-- Dynamic Enquiry Type -->

                <div class="col-12">
                    <div class="form-group">

                        <label class="form-label">
                            Enquiry Type *
                        </label>

                        <select name="enquiry_type"
                                class="form-control-custom"
                                required>

                            <option value=""
                                    disabled
                                    selected>
                                Select an enquiry type...
                            </option>

                            <?php foreach($enquiry_types as $type): ?>

                                <?php if(empty($type)) continue; ?>

                                <option value="<?php echo esc_attr($type); ?>">
                                    <?php echo esc_html($type); ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">

                        <label class="form-label">
                            Subject
                        </label>

                        <input type="text"
                               name="subject"
                               class="form-control-custom"
                               placeholder="Brief subject of your message">

                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">

                        <label class="form-label">
                            Message *
                        </label>

                        <textarea name="message"
                                  rows="5"
                                  class="form-control-custom"
                                  placeholder="Tell us about your project, investment interest, or enquiry in detail..."
                                  required></textarea>

                    </div>
                </div>

                <div class="col-12">

                    <div style="display:flex;align-items:flex-start;gap:10px;margin-bottom:20px;">

                        <input type="checkbox"
                               id="privacyCheck"
                               required
                               style="margin-top:3px;accent-color:var(--gold);">

                        <label for="privacyCheck"
                               style="font-size:.8rem;color:var(--grey);line-height:1.6;cursor:pointer;">

                            I agree to Doma Holding's
                            <a href="#" style="color:var(--gold);">
                                Privacy Policy
                            </a>
                            and consent to being contacted regarding my enquiry.

                        </label>

                    </div>

                    <button type="submit"
                            id="submitInquiry"
                            class="btn-gold btn-ripple"
                            style="width:100%;justify-content:center;display:flex;padding:16px;">

                        <i class="fas fa-paper-plane"></i>
                        &nbsp; Send Message

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<script>
jQuery(function($){

    $('#contactForm').on('submit', function(e){

        e.preventDefault();

        let form = $(this);

        $('#submitInquiry')
            .prop('disabled', true)
            .html('<i class="fas fa-spinner fa-spin"></i> Sending...');

        $.ajax({

            url: '<?php echo admin_url('admin-ajax.php'); ?>',

            type: 'POST',

            data: form.serialize(),

            success: function(response){

                console.log(response);

                if(response.success){

                    $('#formSuccess').fadeIn();

                    form.trigger('reset');

                }else{

                    alert(response.data.message);
                }
            },

            error:function(xhr){

                console.log(xhr.responseText);

                alert('Submission failed.');
            },

            complete:function(){

                $('#submitInquiry')
                    .prop('disabled', false)
                    .html('<i class="fas fa-paper-plane"></i>&nbsp; Send Message');
            }

        });

    });

});
</script>

      <!-- CONTACT INFO SIDEBAR -->
    <?php

$settings_id = doma_get_contact_settings_id();

$offices = [
    'dubai'  => '100',
    'riyadh' => '200',
    'cairo'  => '300',
];

?>

<div class="col-lg-6">

    <!-- Heading -->
    <div class="reveal-right">
        <div class="section-label">Our Offices</div>

        <h3 style="font-family:var(--font-heading);
                   font-size:1.2rem;
                   font-weight:700;
                   margin-bottom:24px;">
            Global <span style="color:var(--gold);">Presence</span>
        </h3>
    </div>

    <?php foreach ($offices as $office_key => $delay) :

        $name = get_post_meta(
            $settings_id,
            '_office_' . $office_key . '_name',
            true
        );

        $badge = get_post_meta(
            $settings_id,
            '_office_' . $office_key . '_badge',
            true
        );

        $address = get_post_meta(
            $settings_id,
            '_office_' . $office_key . '_address',
            true
        );

        $phone = get_post_meta(
            $settings_id,
            '_office_' . $office_key . '_phone',
            true
        );

        $email = get_post_meta(
            $settings_id,
            '_office_' . $office_key . '_email',
            true
        );

        if (empty($name)) {
            continue;
        }
    ?>

        <div class="doma-card reveal-right delay-<?php echo esc_attr($delay); ?>"
             style="padding:24px;margin-bottom:16px;">

            <div style="display:flex;
                        align-items:center;
                        gap:10px;
                        margin-bottom:16px;">

                <div style="width:36px;
                            height:36px;
                            border-radius:var(--radius-sm);
                            background:var(--gold-pale);
                            border:1px solid rgba(188,132,43,.25);
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            color:var(--gold);
                            font-size:.9rem;
                            flex-shrink:0;">

                    <i class="fas fa-building"></i>

                </div>

                <div>

                    <div style="font-weight:700;
                                font-size:.9rem;">

                        <?php echo esc_html($name); ?>

                    </div>

                    <div style="font-size:.7rem;
                                color:var(--gold);
                                font-weight:600;
                                text-transform:uppercase;
                                letter-spacing:.08em;">

                        <?php echo esc_html($badge); ?>

                    </div>

                </div>

            </div>

            <div style="display:flex;
                        flex-direction:column;
                        gap:10px;">

                <?php if($address): ?>
                <div style="display:flex;
                            align-items:flex-start;
                            gap:10px;
                            font-size:.82rem;
                            color:rgba(255,255,255,.7);">

                    <i class="fas fa-map-marker-alt"
                       style="color:var(--gold);
                       margin-top:2px;
                       flex-shrink:0;"></i>

                    <?php echo nl2br(esc_html($address)); ?>

                </div>
                <?php endif; ?>

                <?php if($phone): ?>
                <div style="display:flex;
                            align-items:center;
                            gap:10px;
                            font-size:.82rem;
                            color:rgba(255,255,255,.7);">

                    <i class="fas fa-phone-alt"
                       style="color:var(--gold);
                       flex-shrink:0;"></i>

                    <?php echo esc_html($phone); ?>

                </div>
                <?php endif; ?>

                <?php if($email): ?>
                <div style="display:flex;
                            align-items:center;
                            gap:10px;
                            font-size:.82rem;
                            color:rgba(255,255,255,.7);">

                    <i class="fas fa-envelope"
                       style="color:var(--gold);
                       flex-shrink:0;"></i>

                    <?php echo esc_html($email); ?>

                </div>
                <?php endif; ?>

            </div>

        </div>

    <?php endforeach; ?>

    <!-- Social Links -->
    <div class="reveal-right delay-400">

        <div style="font-size:.8rem;
                    font-weight:700;
                    color:var(--grey);
                    text-transform:uppercase;
                    letter-spacing:.12em;
                    margin-bottom:14px;">

            Follow Us

        </div>

        <div style="display:flex;gap:10px;flex-wrap:wrap;">

            <?php if(get_post_meta($settings_id,'_social_linkedin',true)): ?>
                <a href="<?php echo esc_url(get_post_meta($settings_id,'_social_linkedin',true)); ?>"
                   target="_blank"
                   class="social-link-btn"
                   style="width:44px;height:44px;"
                   title="LinkedIn">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            <?php endif; ?>

            <?php if(get_post_meta($settings_id,'_social_twitter',true)): ?>
                <a href="<?php echo esc_url(get_post_meta($settings_id,'_social_twitter',true)); ?>"
                   target="_blank"
                   class="social-link-btn"
                   style="width:44px;height:44px;"
                   title="Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
            <?php endif; ?>

            <?php if(get_post_meta($settings_id,'_social_instagram',true)): ?>
                <a href="<?php echo esc_url(get_post_meta($settings_id,'_social_instagram',true)); ?>"
                   target="_blank"
                   class="social-link-btn"
                   style="width:44px;height:44px;"
                   title="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
            <?php endif; ?>

            <?php if(get_post_meta($settings_id,'_social_youtube',true)): ?>
                <a href="<?php echo esc_url(get_post_meta($settings_id,'_social_youtube',true)); ?>"
                   target="_blank"
                   class="social-link-btn"
                   style="width:44px;height:44px;"
                   title="YouTube">
                    <i class="fab fa-youtube"></i>
                </a>
            <?php endif; ?>

            <?php if(get_post_meta($settings_id,'_social_whatsapp',true)): ?>
                <a href="<?php echo esc_url(get_post_meta($settings_id,'_social_whatsapp',true)); ?>"
                   target="_blank"
                   class="social-link-btn"
                   style="width:44px;height:44px;"
                   title="WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                </a>
            <?php endif; ?>

        </div>

    </div>

</div>

    </div><!-- /row -->
  </div>
</section>


<!-- landowner form -->

<?php
$settings_id = doma_get_contact_settings_id();

$land_title = get_post_meta($settings_id, '_landform_title', true);

$categories = explode(
    ',',
    get_post_meta($settings_id, '_landform_categories', true)
);

$features = explode(
    ',',
    get_post_meta($settings_id, '_landform_features', true)
);
?>

<section class="mtp-form-section">

    <h2 class="mtp-title">
        <?php echo esc_html($land_title ?: 'MEET THE PROFESSIONALS'); ?>
    </h2>

    <div id="landownerSuccess"
         style="display:none;background:#d1fae5;color:#065f46;padding:15px;border-radius:8px;margin-bottom:20px;">
        Submission received successfully!
    </div>

    <form id="landownerForm">

        <input type="hidden" name="action" value="doma_submit_landowner">
        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('doma_landowner_nonce'); ?>">

        <!-- Land Information -->

        <h4 class="mtp-section-heading">Land Information</h4>

        <div class="row g-3">

            <div class="col-md-6">
                <input type="text"
                       name="locality"
                       class="form-control"
                       placeholder="Locality">
            </div>

            <div class="col-md-6">
                <input type="text"
                       name="address"
                       class="form-control"
                       placeholder="Address*"
                       required>
            </div>

            <div class="col-md-6">
                <input type="text"
                       name="land_size"
                       class="form-control"
                       placeholder="Size Of The Land In Kathas*"
                       required>
            </div>

            <div class="col-md-6">
                <input type="text"
                       name="road_width"
                       class="form-control"
                       placeholder="Width Of The Road In Front (In Feet)*"
                       required>
            </div>

            <!-- Category Dropdown -->

            <div class="col-md-6">

                <select name="category"
                        class="form-select"
                        required>
           <option value="">Select Category</option>
        <option value="Residential">Residential</option>
        <option value="Commercial">Commercial</option>
        <option value="Industrial">Industrial</option>

                    <?php foreach($categories as $category): ?>
                        <?php $category = trim($category); ?>
                        <?php if(empty($category)) continue; ?>

                        <option value="<?php echo esc_attr($category); ?>">
                            <?php echo esc_html($category); ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="col-md-6">
                <input type="text"
                       name="facing"
                       class="form-control"
                       placeholder="Facing*"
                       required>
            </div>

            <!-- Features Dropdown -->

            <div class="col-md-6">

                <select name="features"
                        class="form-select">

                  <option value="">Attractive Features (If Any)</option>
        <option value="Corner Plot">Corner Plot</option>
        <option value="Lake View">Lake View</option>
        <option value="Main Road">Main Road</option>

                    <?php foreach($features as $feature): ?>
                        <?php $feature = trim($feature); ?>
                        <?php if(empty($feature)) continue; ?>

                        <option value="<?php echo esc_attr($feature); ?>">
                            <?php echo esc_html($feature); ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

        </div>

        <!-- Landowners Information -->

        <h4 class="mtp-section-heading mt-4">
            Landowners Information
        </h4>

        <div class="row g-3">

            <div class="col-md-6">
                <input type="text"
                       name="owner_name"
                       class="form-control"
                       placeholder="Name Of The Landowner*"
                       required>
            </div>

            <div class="col-md-6">
                <input type="email"
                       name="owner_email"
                       class="form-control"
                       placeholder="Email ID*"
                       required>
            </div>

            <div class="col-md-6">
                <input type="text"
                       name="owner_phone"
                       class="form-control"
                       placeholder="Contact Number*"
                       required>
            </div>

        </div>

        <div class="form-check mt-3">

            <input class="form-check-input"
                   type="checkbox"
                   id="consentCheck"
                   required>

            <label class="form-check-label" for="consentCheck">
                I agree to
                <a href="#">Privacy Policy</a>
                and consent to being contacted regarding my enquiry.
            </label>

        </div>

        <div class="mtp-btn-wrap">

            <button type="submit"
                    id="landownerSubmitBtn"
                    class="mtp-submit-btn">
                Send Message
            </button>

        </div>

    </form>

</section>

<script>
jQuery(function($){

    $('#landownerForm').on('submit', function(e){

        e.preventDefault();

        let form = $(this);

        $('#landownerSubmitBtn')
            .prop('disabled', true)
            .text('Sending...');

        $.ajax({

            url: '<?php echo admin_url('admin-ajax.php'); ?>',

            type: 'POST',

            data: form.serialize(),

            success: function(response){

                if(response.success){

                    $('#landownerSuccess').fadeIn();

                    form.trigger('reset');

                }else{

                    alert(response.data.message);

                }

            },

            error: function(){

                alert('Submission failed.');

            },

            complete: function(){

                $('#landownerSubmitBtn')
                    .prop('disabled', false)
                    .text('Send Message');

            }

        });

    });

});
</script>

<!-- ═══ MAP SECTION ═══ -->
<?php

$settings_id = doma_get_contact_settings_id();

$map_title = get_post_meta(
    $settings_id,
    '_map_title',
    true
);

$map_subtitle = get_post_meta(
    $settings_id,
    '_map_subtitle',
    true
);

$map_google_url = get_post_meta(
    $settings_id,
    '_map_google_url',
    true
);

$map_section_title = get_post_meta(
    $settings_id,
    '_map_section_title',
    true
);

?>

<section style="padding:0 0 var(--section-gap);position:relative;">

    <div class="container">

        <div class="reveal">

            <div class="divider-animated"></div>

            <div class="section-label" style="margin-bottom:8px;">
                Find Us
            </div>

            <h2 class="section-title" style="margin-bottom:24px;">

                <?php
                echo doma_parse_gold_span(
                    $map_section_title ?: 'Our {{Headquarters}}'
                );
                ?>

            </h2>

        </div>

        <!-- MAP SECTION -->

        <div class="reveal delay-200"
             style="border-radius:var(--radius-lg);overflow:hidden;border:1px solid rgba(188,132,43,.2);position:relative;">

            <div style="width:100%;height:420px;background:linear-gradient(135deg,var(--navy-dark) 0%,#162330 50%,var(--bg-card) 100%);position:relative;display:flex;align-items:center;justify-content:center;overflow:hidden;">

                <!-- Animated Grid -->

                <div class="grid-pattern" style="opacity:.6;"></div>

                <!-- Center Marker -->

                <div style="position:relative;z-index:2;text-align:center;">

                    <div style="position:relative;display:inline-block;">

                        <div style="width:70px;height:70px;border-radius:50%;background:linear-gradient(135deg,var(--gold),var(--gold-light));display:flex;align-items:center;justify-content:center;margin:0 auto 14px;box-shadow:0 0 40px rgba(188,132,43,.5),0 0 80px rgba(188,132,43,.2);"
                             class="float-anim glow-anim">

                            <i class="fas fa-map-marker-alt"
                               style="font-size:2rem;color:var(--black);"></i>

                        </div>

                        <!-- Ripple -->

                        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-60%);width:100px;height:100px;border-radius:50%;border:2px solid rgba(188,132,43,.4);animation:ping 2s cubic-bezier(0,0,.2,1) infinite;"></div>

                        <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-60%);width:100px;height:100px;border-radius:50%;border:2px solid rgba(188,132,43,.25);animation:ping 2s cubic-bezier(0,0,.2,1) .7s infinite;"></div>

                    </div>

                    <!-- Dynamic Title -->

                    <div style="font-family:var(--font-display);font-size:1.1rem;font-weight:800;margin-bottom:6px;">

                        <?php echo esc_html($map_title ?: 'Doma Tower, Business Bay'); ?>

                    </div>

                    <!-- Dynamic Subtitle -->

                    <div style="font-size:.82rem;color:var(--grey);">

                        <?php echo esc_html($map_subtitle ?: 'Dubai, United Arab Emirates'); ?>

                    </div>

                    <!-- Dynamic Google Map Link -->

                    <?php if(!empty($map_google_url)) : ?>

                        <a href="<?php echo esc_url($map_google_url); ?>"
                           target="_blank"
                           rel="noopener"
                           class="btn-gold btn-ripple"
                           style="display:inline-flex;margin-top:18px;font-size:.82rem;padding:10px 22px;">

                            <i class="fas fa-external-link-alt"></i>
                            &nbsp; Open in Google Maps

                        </a>

                    <?php endif; ?>

                </div>

                <!-- Decorative Corners -->

                <div style="position:absolute;top:20px;left:20px;width:50px;height:50px;border-top:2px solid rgba(188,132,43,.4);border-left:2px solid rgba(188,132,43,.4);border-radius:4px 0 0 0;"></div>

                <div style="position:absolute;top:20px;right:20px;width:50px;height:50px;border-top:2px solid rgba(188,132,43,.4);border-right:2px solid rgba(188,132,43,.4);border-radius:0 4px 0 0;"></div>

                <div style="position:absolute;bottom:20px;left:20px;width:50px;height:50px;border-bottom:2px solid rgba(188,132,43,.4);border-left:2px solid rgba(188,132,43,.4);border-radius:0 0 0 4px;"></div>

                <div style="position:absolute;bottom:20px;right:20px;width:50px;height:50px;border-bottom:2px solid rgba(188,132,43,.4);border-right:2px solid rgba(188,132,43,.4);border-radius:0 0 4px 0;"></div>

            </div>

        </div>

    </div>

</section>

<!-- ═══ FAQ SECTION ═══ -->
<section class="section-pad-sm" style="background:var(--bg-section);position:relative;overflow:hidden;">
  <div class="grid-pattern"></div>
  <div class="container position-relative">
    <div class="text-center mb-5 reveal">
      <div class="section-label" style="justify-content:center;">FAQ</div>
      <h2 class="section-title">Frequently Asked <span>Questions</span></h2>
    </div>
    <?php

$faqs = get_posts([
    'post_type'      => 'doma_faq',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

if ( ! empty( $faqs ) ) :
?>

<div class="row g-4 justify-content-center">
    <div class="col-lg-8">

        <div style="display:flex;flex-direction:column;gap:12px;">

            <?php
            $delay = 100;

            foreach ( $faqs as $faq ) :

                $answer = get_post_meta(
                    $faq->ID,
                    '_faq_description',
                    true
                );
            ?>

                <div class="doma-card reveal delay-<?php echo esc_attr( $delay ); ?>"
                     style="padding:22px 24px;cursor:pointer;"
                     onclick="
                        this.querySelector('.faq-body').style.display =
                        this.querySelector('.faq-body').style.display==='none'
                        ? 'block'
                        : 'none';

                        this.querySelector('.faq-icon').style.transform =
                        this.querySelector('.faq-body').style.display==='none'
                        ? 'rotate(0deg)'
                        : 'rotate(45deg)';
                     ">

                    <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;">

                        <div style="font-weight:700;font-size:.92rem;">
                            <?php echo esc_html( get_the_title( $faq->ID ) ); ?>
                        </div>

                        <i class="fas fa-plus faq-icon"
                           style="color:var(--gold);flex-shrink:0;transition:transform .3s;">
                        </i>

                    </div>

                    <div class="faq-body"
                         style="display:none;margin-top:14px;font-size:.84rem;color:var(--grey);line-height:1.8;">

                        <?php echo nl2br( esc_html( $answer ) ); ?>

                    </div>

                </div>

            <?php
                $delay += 100;
            endforeach;
            ?>

        </div>

    </div>
</div>

<?php endif; ?>


  </div>
</section>

<!-- ═══ CTA ═══ -->
<section class="cta-section">
  <div class="cta-bg"></div>
  <div class="particles-bg"></div>
  <div class="cta-glow"></div>
  <div class="container position-relative" style="z-index:2;">
    <div class="cta-content reveal">
      <div class="section-label" style="justify-content:center;">Next Step</div>
      <h2 class="cta-title">Ready to Build Something <span style="color:var(--gold);">Great?</span></h2>
      <p class="cta-desc">Join 240+ clients and investors who trust Doma to deliver exceptional results. Our team responds within 24 hours.</p>
      <div class="cta-actions">
        <a href="projects.html" class="btn-gold btn-ripple"><i class="fas fa-th-large"></i> View Our Projects</a>
        <a href="status.html"   class="btn-outline"><i class="fas fa-chart-line"></i> Live Project Status</a>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<?php get_footer(); ?>


<?php wp_footer(); ?>

</body>
</html>
