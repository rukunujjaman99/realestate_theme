<!-- FOOTER -->

<footer class="doma-footer">

<div class="footer-main">
<div class="container">
<div class="row g-5">

<div class="col-lg-4 col-md-6">

<div class="footer-brand">

<div style="width:100px;height:40px;">

<?php if(get_theme_mod('footer_logo')) : ?>

<img
src="<?php echo esc_url(get_theme_mod('footer_logo')); ?>"
class="img-fluid"
alt="<?php bloginfo('name'); ?>">

<?php endif; ?>

</div>

<p>
<?php echo esc_html(
get_theme_mod(
'footer_description',
'A diversified holding group delivering excellence across real estate, infrastructure, technology, and investment since 2008.'
)
); ?>
</p>

<div class="footer-social">

<?php if(get_theme_mod('footer_linkedin')) : ?>
<a href="<?php echo esc_url(get_theme_mod('footer_linkedin')); ?>" class="social-link-btn" target="_blank">
<i class="fab fa-linkedin-in"></i>
</a>
<?php endif; ?>

<?php if(get_theme_mod('footer_twitter')) : ?>
<a href="<?php echo esc_url(get_theme_mod('footer_twitter')); ?>" class="social-link-btn" target="_blank">
<i class="fab fa-twitter"></i>
</a>
<?php endif; ?>

<?php if(get_theme_mod('footer_instagram')) : ?>
<a href="<?php echo esc_url(get_theme_mod('footer_instagram')); ?>" class="social-link-btn" target="_blank">
<i class="fab fa-instagram"></i>
</a>
<?php endif; ?>

<?php if(get_theme_mod('footer_youtube')) : ?>
<a href="<?php echo esc_url(get_theme_mod('footer_youtube')); ?>" class="social-link-btn" target="_blank">
<i class="fab fa-youtube"></i>
</a>
<?php endif; ?>

</div>
</div>
</div>

<div class="col-lg-2 col-md-6 col-6">

<div class="footer-heading">Company</div>

<ul class="footer-links">

<?php
wp_nav_menu(array(
'theme_location' => 'footer_company_menu',
'container' => false,
'items_wrap' => '%3$s'
));
?>

</ul>

</div>

<div class="col-lg-2 col-md-6 col-6">

<div class="footer-heading">Services</div>

<ul class="footer-links">

<?php
wp_nav_menu(array(
'theme_location' => 'footer_services_menu',
'container' => false,
'items_wrap' => '%3$s'
));
?>

</ul>

</div>

<div class="col-lg-4 col-md-6">

<div class="footer-heading">

<?php echo esc_html(
get_theme_mod(
'newsletter_title',
'Newsletter'
)
); ?>

</div>

<p style="font-size:.82rem;color:var(--grey);margin-bottom:6px;">

<?php echo esc_html(
get_theme_mod(
'newsletter_desc',
'Stay updated with latest projects and investment opportunities.'
)
); ?>

</p>

<form class="newsletter-form">

<div class="newsletter-input-wrap">

<input
type="email"
class="newsletter-input"
placeholder="Your email address">

<button
type="submit"
class="newsletter-btn">

Subscribe

</button>

</div>

</form>

</div>

</div>
</div>
</div>

<div class="container">

<div class="footer-bottom">

<div class="footer-bottom-text">

<?php echo wp_kses_post(
get_theme_mod(
'footer_copyright',
'© 2025 Doma Holding Company. All rights reserved.'
)
); ?>

</div>

<div style="display:flex;gap:20px;flex-wrap:wrap;">

<a href="<?php echo esc_url(get_theme_mod('privacy_policy_url')); ?>">
Privacy Policy
</a>

<a href="<?php echo esc_url(get_theme_mod('terms_url')); ?>">
Terms of Service
</a>

</div>

</div>

</div>

</footer>