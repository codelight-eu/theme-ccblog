<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
  wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);

  // on single blog post pages with comments open and threaded comments
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    // enqueue the javascript that performs in-link comment reply fanciness
    wp_enqueue_script( 'comment-reply' );
  }
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
  /**
   * Enable features from Soil when plugin is activated
   * @link https://roots.io/plugins/soil/
   */
  add_theme_support('soil-clean-up');
  add_theme_support('soil-jquery-cdn');
  add_theme_support('soil-nav-walker');
  add_theme_support('soil-nice-search');
  add_theme_support('soil-relative-urls');

  /**
   * Enable plugins to manage the document title
   * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
   */
  add_theme_support('title-tag');

  /**
   * Register navigation menus
   * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
   */
  register_nav_menus([
    'mainNav' => __('Front Page Navigation', 'sage'),
    'contextBarNav' => __('Context Bar Navigation', 'sage'),
    'standardNav' => __('Standard Navigation Bar', 'sage'),
    'standardNavCollapsed' => __('Standard Navigation Bar Collapsed', 'sage'),
    'mobileNav' => __('Mobile Navigation', 'sage'),
    'footer1' => __('Footer Navigation 1', 'sage'),
    'footer2' => __('Footer Navigation 2', 'sage'),
    'footer3' => __('Footer Navigation 3', 'sage'),
  ]);

  /**
   * Enable post thumbnails
   * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
   */
  add_theme_support('post-thumbnails');

  /**
   * Enable HTML5 markup support
   * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
   */
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  /**
   * Enable selective refresh for widgets in customizer
   * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
   */
  add_theme_support('customize-selective-refresh-widgets');

  /**
   * Use main stylesheet for visual editor
   * @see resources/assets/styles/layouts/_tinymce.scss
   */
  add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
  $config = [
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget' => '</section>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ];
  register_sidebar([
      'name' => __('Primary', 'sage'),
      'id' => 'sidebar-primary'
    ] + $config);
  register_sidebar([
      'name' => __('Footer', 'sage'),
      'id' => 'sidebar-footer'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
  sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
  /**
   * Add JsonManifest to Sage container
   */
  sage()->singleton('sage.assets', function () {
    return new JsonManifest(config('assets.manifest'), config('assets.uri'));
  });

  /**
   * Add Blade to Sage container
   */
  sage()->singleton('sage.blade', function (Container $app) {
    $cachePath = config('view.compiled');
    if (!file_exists($cachePath)) {
      wp_mkdir_p($cachePath);
    }
    (new BladeProvider($app))->register();
    return new Blade($app['view']);
  });

  /**
   * Create @asset() Blade directive
   */
  sage('blade')->compiler()->directive('asset', function ($asset) {
    return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
  });
});


/* Register adaptive menus for ccblog */
/*function register_adaptive_menus()
{
  register_nav_menus(array(
    'top-menu' => __('Top Menu', 'adaptive-framework'),
    'main-menu' => __('Main Menu', 'adaptive-framework')
  ));
}

add_action('init', 'register_adaptive_menus');*/

use StoutLogic\AcfBuilder\FieldsBuilder;

/* Create fields for featured items */
$setFeaturedPost = new FieldsBuilder('featured_post');
$setFeaturedPost
  ->addTrueFalse('set_featured', ['wrapper' => ['width' => 20]])
  ->addRadio('set_featured_position', ['choices' => ['Position Top' => 'position_top', 'Position Sidebar' => 'position_sidebar'], 'wrapper' => ['width' => 30]])
  ->setInstructions(__('The post with the newest published date will be displayed on the chosen position', 'ccblog'))
  ->conditional("set_featured", '==', '1')
  ->addGroup('sidebar_settings', ['wrapper' => ['width' => 50]])
  ->conditional("set_featured_position", '==', 'position_sidebar')
  ->addRadio('set_section_title', ['choices' => ['Use MOOCWATCH No' => 'title_moocwatch', 'Use custom title' => 'title_custom']])
  ->addNumber('moocwatch_no')
  ->conditional("set_section_title", '==', 'title_moocwatch')
  ->addWysiwyg('section_title')
  ->conditional("set_section_title", '==', 'title_custom')
  ->addText('short_title')
  ->endGroup()
  ->setLocation('post_type', '==', 'post');

$setFeaturedMessage = new FieldsBuilder('call_to_action');
$setFeaturedMessage
  ->addSelect('set_footer_CTA', ['choices' =>
    [['none' => 'None'], ['CTA1' => 'CTA 1'], ['CTA2' => 'CTA 2']]])
  ->setLocation('post_type', '==', 'page');

add_action('acf/init', function () use ($setFeaturedPost, $setFeaturedMessage) {
  acf_add_local_field_group($setFeaturedPost->build());
  acf_add_local_field_group($setFeaturedMessage->build());
});

/* Create options page */
if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title' => 'Theme General Settings',
    'menu_title' => 'Theme Settings',
    'menu_slug' => 'theme-general-settings',
    'capability' => 'edit_posts'
  ));

  acf_add_options_sub_page(array(
    'page_title' => 'Footer Settings',
    'menu_title' => 'Footer content',
    'parent_slug' => 'theme-general-settings',
  ));

  acf_add_options_sub_page(array(
    'page_title' => 'External Links',
    'menu_title' => 'External Links',
    'parent_slug' => 'theme-general-settings',
  ));
}

/* Set up footer */
$footerContent = new FieldsBuilder('footer');
$footerContent
  ->addWysiwyg('footer_content', ['wrapper' => ['width' => 50]])
  ->addGroup('call_to_action', ['wrapper' => ['width' => 50]])
  ->addTab('CTA_1')
  ->addWysiwyg('CTA_1_text', ['wrapper' => ['width' => 50]])
  ->addGroup('CTA_1_links', ['wrapper' => ['width' => 50]])
  ->addLink('CTA_1_facebook_link')
  ->addLink('CTA_1_twitter_link')
  ->endGroup()
  ->addTab('CTA_2')
  ->addWysiwyg('CTA_2_text', ['wrapper' => ['width' => 50]])
  ->addLink('CTA_2_sign-up_link', ['wrapper' => ['width' => 50]])
  ->endGroup()
  ->setLocation('options_page', '==', 'acf-options-footer-content');

add_action('acf/init', function () use ($footerContent) {
  acf_add_local_field_group($footerContent->build());
});

/* Set up class central links */
$ccLinks = new FieldsBuilder('class_central');
$ccLinks
  ->addLink('link_1')
  ->addLink('link_2')
  ->addLink('link_3')
  ->addLink('link_4')
  ->setLocation('options_page', '==', 'acf-options-external-links');

/* Set up follow links */
$follow = new FieldsBuilder('follow_links');
$follow
  ->addLink('rss')
  ->addLink('facebook')
  ->addLink('twitter')
  ->setLocation('options_page', '==', 'acf-options-external-links');

/* Set up sidebar link */
$sidebar = new FieldsBuilder('sidebar');
$sidebar
  ->addLink('sidebar_link')
  ->setLocation('options_page', '==', 'acf-options-external-links');

add_action('acf/init', function () use ($sidebar, $ccLinks, $follow) {
  acf_add_local_field_group($sidebar->build());
  acf_add_local_field_group($ccLinks->build());
  acf_add_local_field_group($follow->build());
});

/* Add custom field to User Form */
$userShortDesc = new FieldsBuilder('user_short_description');
$userShortDesc
  ->addWysiwyg('short_description')
  ->setLocation('user_form', '==', 'edit');

add_action('acf/init', function () use ($userShortDesc) {
  acf_add_local_field_group($userShortDesc->build());
});

/* Add related tags field to Tags */
$relatedTags = new FieldsBuilder('related_tags');
$relatedTags
  ->addTaxonomy('set_related_tags', [
    'taxonomy' => 'post_tag',
    'field_type' => 'multi_select'])
  ->setLocation('taxonomy', '==', 'post_tag');

add_action('acf/init', function () use ($relatedTags) {
  acf_add_local_field_group($relatedTags->build());
});

/* Add disclosure option to post */
$disclosure = new FieldsBuilder('disclosure');
$disclosure
  ->addTrueFalse('edit_disclosure', ['wrapper' => ['width' => 20]])
  ->addWysiwyg('disclosure_text', ['wrapper' => ['width' => 80]])
  ->setDefaultValue('<strong class="text--bold">Disclosure:</strong> To support our site, Class Central may be compensated by some course providers.')
  ->conditional('edit_disclosure', '==', '1')
  ->setLocation('post_type', '==', 'post');

add_action('acf/init', function () use ($disclosure) {
  acf_add_local_field_group($disclosure->build());
});

/* Add cropped image field to post */
$croppedImage = new FieldsBuilder('cropped_illustration');
$croppedImage
  ->addImage('set_cropped_illustration')
  ->setLocation('post_type', '==', 'post');

add_action('acf/init', function () use ($croppedImage) {
  acf_add_local_field_group($croppedImage->build());
});

/* Add image to category */
$catIcon = new FieldsBuilder('category_options');
$catIcon
  ->addImage('category_icon')
  ->setLocation('taxonomy', '==', 'category');

add_action('acf/init', function () use ($catIcon) {
  acf_add_local_field_group($catIcon->build());
});