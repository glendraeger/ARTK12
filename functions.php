<?php
/*
Author: Eddie Machado
URL: http://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  //Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  require_once( 'library/custom-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
add_image_size( 'artk12-puzzle' , 500, 500, false);

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ) );
}

// get rid of game category on blog feed page
function artk12_exclude_category( $query ) {

    if ( $query->is_home() && $query->is_main_query() ) {
        
        $query->set( 'cat', '-73' );
    }
}

add_action( 'pre_get_posts', 'artk12_exclude_category' );

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* THEME CUSTOMIZE *********************/

/* 
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722
  
  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162
  
  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
  - Create some boilerplate Sections, Controls and Settings
*/

function bones_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');
  
  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'bones_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

  register_sidebar( array(
    'name' => __( 'Store Sidebar', 'bonestheme' ),
    'id' => 'store-sidebar',
    'description' => __( 'The store sidebar.', 'bonestheme' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ) );

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/*
This is a modification of a function found in the
twentythirteen theme where we can declare some
external fonts. If you're using Google Fonts, you
can replace these fonts, change it in your scss files
and be up and running in seconds.
*/
function bones_fonts() {
  wp_enqueue_style('googleFonts', 'http://fonts.googleapis.com/css?family=Josefin+Slab:400,600,700|Cinzel');
}

add_action('wp_enqueue_scripts', 'bones_fonts');

// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form'
	) );

  // to hide email addresses in content
// USAGE [hideemail email="you@you.com"]
function hide_email_now( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'email' => '',
      ), $atts ) );
    return '<a href="mailto:' . antispambot($email) . '">' . antispambot($email) . '</a>';
}

add_shortcode('hideemail','hide_email_now');


function hide_phone_now( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'phone' => '',
      ), $atts ) );
    return antispambot($phone);
}

add_shortcode('hidephone','hide_phone_now');


function artk12_testimonial( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'author' => '',
    'float' => '',
      ), $atts ) );
    return '<aside class="testimonial '.$float.'"><blockquote><span class="quote-left">&ldquo;</span>'.$content.'<p class="t-author">&mdash;'.$author.'</p></blockquote></aside>';
}

add_shortcode('testimonial','artk12_testimonial');

add_action('wp_head','artk12_facebook_like');

function artk12_facebook_like() {

echo '<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=185578961515215";
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));</script>';

}

// WOOCOMMERCE

//add_action('woocommerce_after_shop_loop_item_title','link_to_product_page');
add_action('woocommerce_after_shop_loop_item','link_to_product_page');


function link_to_product_page() {

  echo '<p class="product-link">';
  echo '<a class="blue-btn" href="'.get_the_permalink().'">More Info</a>';
  echo '</p>';
}


add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );
  function wcs_woo_remove_reviews_tab($tabs) {
    unset($tabs['reviews']);
    return $tabs;
} 


add_filter( 'wc_product_sku_enabled', 'mycode_remove_sku_from_product_page' );
function mycode_remove_sku_from_product_page( $boolean ) {
  if ( is_single() ) {
    $boolean = false;
  }
  return $boolean;
}


//Functions File
// add category nicenames in body and post class
function category_id_class( $classes ) {
  global $post;
  foreach ( ( get_the_category( $post->ID ) ) as $category ) {
    $classes[] = $category->category_nicename;
  }
  return $classes;
}
add_filter( 'post_class', 'category_id_class' );
add_filter( 'body_class', 'category_id_class' );



function artk12_game_container($atts, $content = null) {
  return '<div id="memory-game-container"><p style="margin:0 0 24px 0;" id="instructions">Here is an online version of this game. After you click "START GAME" you will have one minute to study the painting that appears. After your time is up, questions will appear about the painting. See how many you can answer correctly.</p><p><button id="game-start">START GAME</button></p><div id="game-question-container">'.do_shortcode($content).'<p id="your-score">You scored 3 out of 5!</p><p id="check-answers-para"><button id="check-answers">CHECK MY ANSWERS</button></p></div></div>';
}

add_shortcode('game_container','artk12_game_container');

function artk12_game_question($atts, $content = null) {
  return '<h2 class="question">'.$content.'</h2>';
}

add_shortcode('game_question','artk12_game_question');


function artk12_game_answer($atts, $content = null) {
  extract( shortcode_atts( array(
     'class' => 'incorrect',
     'group' => 'group',
     'random' => rand(),
     ), $atts ) );
  return '<p class="answer"><label class="'.$class.'" for="question-'.$random.'"> <input id="question-'.$random.'" type="radio" name="'.$group.'" />'.$content.'</label></p>'; 
}


add_shortcode('game_answer','artk12_game_answer');


function artk12_game_image($atts, $content = null) {
  return '<div id="game-image"><p id="counter-container">Time remaining: <span id="counter"></span> seconds.</p>'.$content.'</div>';
}

add_shortcode('game_image','artk12_game_image');

add_filter( 'woocommerce_product_description_heading', 'remove_product_description_heading' );
function remove_product_description_heading() {
return '';
}






//include(get_stylesheet_directory_uri() . '/library/games/matching.php');


function artk12_matching_game($atts, $content = null) {

// images hold six bits of information
// image|image|popup image|popup content|front card 1st text (optional)|front card 2nd text (optional) || new one.... 
// this is each smaller section
// separate main sections with double pipe || smaller sections with |
  
  extract( shortcode_atts( array(
     'images' => 'http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-1.jpg|http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-1.jpg|http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-11.jpg|<em>Haystacks, (Snow Effect)</em> 1890-91. National Gallery of Scotland, Edinburgh, Scotland.||http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-2.jpg|http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-2.jpg|http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-21.jpg|<em>Wheatstack (Thaw, Sunset)</em> 1891. Oil on canvas. The Art Institute of Chicago, Chicago, Illinois.||http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-3.jpg|http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-3.jpg|http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-31.jpg|<em>Haystacks, (Midday)</em> 1890-91. Oil on canvas, 65.6 x 100.6 cm. National Gallery of Australia, Parkes, Australian Capital Territory, Australia.||http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-4.jpg|http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-4.jpg|http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-41.jpg|<em>Grainstacks in the Sunlight, Morning Effect</em> 1890. Oil on canvas. Private collection.||http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-5.jpg|http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-5.jpg|http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-51.jpg|<em>Haystacks on a Foggy Morning</em> 1891. Oil on canvas.||http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-6.jpg|http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-6.jpg|http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-61.jpg|<em>Haystacks, End of Summer, (Morning Effect)</em> 1890-91. Oil on canvas, 60.5 cm x 100.8 cm. Musée d’Orsay, Paris, France.||http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-7.jpg|http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-7.jpg|http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-71.jpg|<em>Wheatstacks, Snow Effect, (Morning)</em> 1890-91. Oil on canvas. J. Paul Getty Museum, Los Angeles, California.||http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-8.jpg|http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-8.jpg|http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-81.jpg|<em>Grainstacks in Sunshine</em> 1891. Oil on canvas, 60 cm x 100 cm. Kunshaus Zurich, Zurich, Switzerland.||http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-9.jpg|http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-9.jpg|http://artk12.com/wp-content/uploads/2015/09/monet-haystacks-91.jpg|<em>Stacks of Wheat, (End of Summer)</em> 1890-91. Oil on canvas, 60 cm x 100 cm. Art Institute of Chicago, Chicago, Illinois. ',
     'artist' => 'Claude Monet',
     'class' => 'landscape', // default is portrait 135x170 / landscape 160x100
     'card_cover' => 'http://artk12.com/wp-content/uploads/2015/09/wall-paper-for-monet.jpg',
     'card_cover_alt' => 'Beige Wallpaper',
     'play_again_link' => 'http://artk12.com/monets-haystacks/'
     ), $atts ) );
  
    // build the array
    $image_array = array();

    $images = explode('||',$images);

    $x = 0;
    foreach($images as $info) {
      // explode the array within array
      $info = explode('|',$info);

      $image_array[$x]['image1'] = $info[0];
      $image_array[$x]['image2'] = $info[1];
      $image_array[$x]['popup'] = $info[2];
      $image_array[$x]['popup_content'] = $info[3];
      if(isset($info[4])) {
        $image_array[$x]['front_content1'] = $info[4];
      }
      if(isset($info[5])) {
        $image_array[$x]['front_content2'] = $info[5];
      }

      $x++;

    }


    // create another array with all these images


    $image_array_2 = array();
    $image_array_popups = array();
    $x = 1; // this is for the array itself
    $y = 1; // is to create a common class for each two images
    foreach($image_array as $info) {

      $image_array_2[$x]['image1'] = $info['image1'];
      $image_array_2[$x]['class1'] = 'class-'.$y;
      $image_array_2[$x]['front_content1'] = $info['front_content1'];
      $image_array_2[$x]['image_alt'] = $info['popup_content'];
      $image_array_popups[$x]['image'] = $info['popup'];
      $image_array_popups[$x]['id'] = 'class-'.$y;
      $image_array_popups[$x]['content'] = $info['popup_content'];

      $x++;

      $image_array_2[$x]['image1'] = $info['image2'];;
      $image_array_2[$x]['class1'] = 'class-'.$y;
      $image_array_2[$x]['front_content1'] = $info['front_content2'];
      $image_array_2[$x]['image_alt'] = $info['popup_content'];
      $x++;


    $y++;
    }

// Let's put all this on the page!

$matching = '';
$matching .= '<div class="twelvecol first match-game-wrapper">';
$matching .= '<p>Find the matching or related images.<br />The timer will stop when the large window pops up and start again when you close it.</p>';
$matching .= '<p>Time(seconds): <span id="timer">0</span> &nbsp; / &nbsp; ';
$matching .= 'Moves: <span id="moves">0</span></p>';
$matching .= '<div id="matching-game" class="'.$class.'">';

if($class == 'landscape') {
    $img_width = '160';
    $img_height = '100';
} elseif($class == 'portrait') {
    $img_width = '135';
    $img_height = '170';
}

shuffle($image_array_2);
$x = 1; // we want to give each .matching-image a unique id
foreach($image_array_2 as $info) { 

    $matching .= '<div class="matching-image" id="parent-'.$x.'" data-popup-id="'.$info['class1'].'">';
    $matching .= '<div class="back '.$info['class1'].'">';
    $matching .= '<img src="'.$info['image1'].'" alt="'.strip_tags($info['image_alt']).'" width="'.$img_width.'" height="'.$img_height.'" /></div>';
    $matching .= '<div class="front">';
    if($card_cover != '') {
      $matching .= '<img src="'.$card_cover.'" alt="'.$card_cover_alt.' '.$x.'" width="'.$img_width.'" height="'.$img_height.'" />';
    } else { // if no card cover check for text
      // Optional this can be card text if we want it
      if(isset($info['front_content1']) && $info['front_content1'] != '') {
        $matching .= '<span class="front-card-text">'.$info['front_content1'].'</span>';
      }

      // TESTING ONLY
      //$matching .= '<span class="front-card-text">'.$info['class1'].'</span>'; 
      // EOF TESTING ONLY

    }
    // eof Optional
    $matching .= '</div>';
    $matching .= '</div>';

$x++;
} 


$matching .= '</div>';
$matching .= '<div id="matching-popups">';


foreach($image_array_popups as $info) { 


    $matching .= '<div class="main-popup" id="'.$info['id'].'">';
    $matching .= '<div class="popup-content '.$class.'-popup">';
    $matching .= '<span data-id="'.$info['id'].'" class="close-btn">Close</span>';
    $matching .= '<p class="art-info"><span class="artist">'.$artist.'</span>'.$info['content'].'</p>';
    $matching .= '<p class="art-image"><img src="'.$info['image'].'" alt="'.strip_tags($info['content']).'" /></p>';
    $matching .= '<p class="no-worries">Don\'t worry, your time has stopped!</p>';
    $matching .= '</div>';
    $matching .= '</div>';
}


    $matching .= '<div id="matching-completed-message" class="main-popup">';
    $matching .= '<div class="popup-content">';
    $matching .= '<span id="button-close">Close</span>';
    $matching .= '<p>Good Job! The lower your score the better!<br />Try again to see if you can beat it.<br />Here are your stats:<br />';
    $matching .= 'Moves: <span id="moves-done">0</span><br />';
    $matching .= 'Time(seconds): <span id="time-done">0</span><br />';
    $matching .= 'Combined Score: <span id="combined-score">0</span><br />(<small>Moves are weighted more than time</small>)';
    $matching .= '</p>';
    $matching .= '<p><a href="'.$play_again_link.'">Play Again!</a></p>';
    $matching .= '</div></div>';




$matching .= '</div>';
$matching .= '</div>';



return $matching;
}

add_shortcode('matching_game','artk12_matching_game');



/* DON'T DELETE THIS CLOSING TAG */ ?>