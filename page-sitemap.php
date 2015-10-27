<?php
/*
Template Name: Site Map
*/
$args = array(
	'depth'        => 0,
	'show_date'    => '',
	'date_format'  => get_option('date_format'),
	'child_of'     => 0,
	'exclude'      => '83,92,86,186,743,783,265,1578,1570',
	'include'      => '',
	'title_li'     => __(''),
	'echo'         => 1,
	'authors'      => '',
	'sort_column'  => 'post_title',
	'link_before'  => '',
	'link_after'   => '',
	'walker'       => '' );
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="twelvecol first cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

								</header> <?php // end article header ?>

								<section class="entry-content cf" itemprop="articleBody">
									<?php
										// the content (pretty self explanatory huh)
										the_content();
									?>

									<div class="fourcol first">
            <h2>Art History Curriculum</h2>
            <ul>
            <?php
            $query = new WP_Query('post_type=product&orderby=title&order=ASC&posts_per_page=200' );
			while ( $query->have_posts() ) : $query->the_post();
			
			?>

			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	
			<?php
			
			endwhile; 
			wp_reset_postdata();
			?>
            </ul>
        </div>
            
            <div class="fourcol">
            <h2>ARTK12 Blog</h2>
            <ul>
            <?php
            $query = new WP_Query( 'post_type=post&order=DESC&posts_per_page=200' );
			while ( $query->have_posts() ) : $query->the_post();
			$art_parent_id = $post->post_parent;
			
			?>

			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	
			<?php
			endwhile; 
			wp_reset_postdata();
			?>
            </ul>
			</div>
            
            
            <div class="fourcol last">
            <h2>ARTK12 Content</h2>
            <ul>
            <?php wp_list_pages($args); ?>
            </ul>
            </div>
								</section> <?php // end article section ?>

								<footer class="article-footer cf">

								</footer>

								<?php comments_template(); ?>

							</article>

							<?php endwhile; ?>
							<?php endif; ?>

						</main>

				</div>

			</div>

<?php get_footer(); ?>
