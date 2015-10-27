<?php
/*
Template Name: Products + Blog
*/
?>

<?php get_header(); ?>

<div id="content">

	<div id="inner-content" class="wrap cf">

			<main id="main" class="twelvecol first cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="twelvecol first">
					<?php the_content(); ?>
				</div>

				<?php endwhile; ?>
				<?php endif; ?>

				<div clas="twelvecol first">
				
				<div class="twelvecol first home-product-feed">

				

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

					<section class="entry-content cf" itemprop="articleBody">
						<?php
							// the content (pretty self explanatory huh)
							//the_content();
						?>
						<?php //echo do_shortcode('[products orderby="menu_order" order="asc" columns="3"]'); ?>
						<h2>Geography!</h2>
						<?php echo do_shortcode('[products ids="2883, 2669, 2744, 2865" orderby="list" order="asc"]'); ?>

						<?php //echo do_shortcode('[product_category category="geography"]'); ?>
						
						
						<h2>American Art History (Semester 1)</h2>
						<?php echo do_shortcode('[products ids="2676, 2682, 2688, 2690" orderby="id" order="asc"]'); ?>

						<p style="text-align:center;"><a class="blue-btn more-books" href="<?php bloginfo('wpurl'); ?>/product-category/books/">View All ARTK12 Books &raquo;</a></p>


						

						<div id="instagram-feed">
							<h2><a target="_blank" rel="nofollow" href="https://instagram.com/artk12/"><i class="fa fa-instagram"></i></a> Share ARTK12! <a target="_blank" rel="nofollow" href="https://instagram.com/explore/tags/artk12/"><span>#ARTK12</span></a></h2>
							
								<?php //do_shortcode('[artk12_show_tag_info]'); ?>

								<?php do_action('artk12_show_tag_info'); ?>
							
						</div>


						<div id="home-social" style="clear:both;">
						<h2>Connect with ARTK12!</h2>
						<?php
						include('library/includes/social-icons.php');
						?>
						</div>


						<div id="pinterest-feed">
							<h2><a target="_blank" rel="nofollow" href="https://www.pinterest.com/artk12books/"><i class="fa fa-pinterest"></i></a>Pinterest! <a target="_blank" rel="nofollow" href="https://www.pinterest.com/artk12books/"><span>See More!</span></a></h2>
							<div id="feed-one">
							<?php echo get_pins_feed_list('artk12books', 'artk12-map-books', 6, 'artk12', 1, 'newwindow', 'yes', 207, 207,''); ?>
							</div>
							<div id="feed-three">
								<?php echo get_pins_feed_list('artk12books', 'childrens-art-history-books', 6, 'artk12z', 1, 'newwindow', 'yes',  207, 207,''); ?>
							</div>
							<div id="feed-two">
								<?php echo get_pins_feed_list('artk12books', 'american-art-history-semester-one', 6, 'artk12zz', 1, 'newwindow', 'yes',  207, 207,'large'); ?>
							</div>

						</div>






						<h2>American Art History (Semester 2)</h2>
						<?php echo do_shortcode('[products ids="2673, 2685, 2694, 2696" orderby="id" order="asc"]'); ?>

						<h2>Serious Fun! Mona Lisa! Monet Haystacks!</h2>
						<?php echo do_shortcode('[products ids="2668, 2671, 2672, 3143" orderby="list"]'); ?>

						<div class="twelvecol first home-blog-feed2">
						<h2>Latest Blog Posts</h2>
						<?php 
						$args = array(
							'post_type'			=> 'post',
							'posts_per_page'    => 4,
							'order'	=> 'DESC',
							'orderby' => 'date'
						);
							
						// the query
						$the_query = new WP_Query( $args ); ?>

						<?php if ( $the_query->have_posts() ) : ?>
						<?php
						$x = 1; 
						while ( $the_query->have_posts() ) : $the_query->the_post(); 
						$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
						$url = $thumb['0'];
						if($x % 4 == 1) {
							$class = ' first';
						} elseif($x % 4 == 0) {
							$class = ' last';
						} else {
							$class = '';
						}
						?>

						<div class="threecol<?php echo $class; ?>">
							<a href="<?php the_permalink(); ?>"><span style="background-image:url(<?php echo $url; ?>);" class="post-image"></span></a>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							
							<?php the_excerpt(); ?>
							<?php if(has_excerpt()) { ?>
							<p><a class="excerpt-read-more" href="<?php the_permalink(); ?>">Read More</a></p>
							<?php } ?>

						</div>

						<?php 
						$x++;
						endwhile; 
						?>

						<?php wp_reset_postdata(); ?>

						<?php endif; ?>
						</div>



						
					</section> <?php // end article section ?>


				</article>

				

				</div>
			</div>



			</main>

	</div>

</div>

<?php get_footer(); ?>
