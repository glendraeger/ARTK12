<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(''); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta name="p:domain_verify" content="4e876a2779694aeb1e7ac0821047628c"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
            <meta name="theme-color" content="#121212">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	</head>

	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

		<div id="container-main">

			<header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">

				<div id="inner-header">


					<div class="wrap cf logo">

					<?php if(is_front_page()) { ?>
					<h1 id="logo" class="h1 ir" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></h1>
					<?php } else { ?>
					<p id="logo" class="h1 ir" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></p>
					<?php } ?>

					<?php // if you'd like to use the site description you can un-comment it below ?>
					<?php // bloginfo('description'); ?>

					</div>

					<div id="nav-icon" class="mobile-only ir">Navigation</div>

					<div class="wrap cf" style="position:relative;">
						<?php
						include('library/includes/social-icons.php');
						?>
						<div id="facebook-header">
							<div class="fb-like" data-href="http://artk12.com" data-send="false" data-width="300" data-show-faces="false"></div>
						</div>
					</div>


					<div class="navigation-outer" id="main-navigation">
						<div class="wrap cf navigation">
						<nav role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
							<?php wp_nav_menu(array(
	    					         'container' => false,             // remove nav container
	    					         'container_class' => 'menu cf',   // class of container (should you choose to use it)
	    					         'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
	    					         'menu_class' => 'nav top-nav cf', // adding custom nav class
	    					         'theme_location' => 'main-nav', // where it's located in the theme
	    					         'before' => '',            // before the menu
	        			               'after' => '',              // after the menu
	        			               'link_before' => '',    // before each link
	        			               'link_after' => '',   // after each link
	        			               'depth' => 0,       // limit the depth of the nav
	    					         'fallback_cb' => ''    // fallback function (if there is one)
							)); ?>

						</nav>


				</div>


				<!-- <div class="wrap social-header">
				
            	</div> -->


			</div>
				
				
			
				

				</div>

			</header>

			<?php if(is_front_page()) { ?>
			<?php /*
				<div id="home-banner">
					<div class="wrap cf">
						<h1>Home page banner....</h1>
					</div>
				</div>
			*/ ?>
			<?php } ?>

			<div class="woocommerce-container">
