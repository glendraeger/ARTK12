<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" class="ninecol first cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<article id="post-not-found" class="hentry cf">

							

							

							<div class="sixcol first">
										<header class="article-header">
											<h1><?php _e( 'Uh Oh,! Nothing Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											
											<p><?php _e( 'Not to worry! Worse things have happened. Maybe try searching with the form below or try the navigation above to find some great art curriculum....okay, that is a little self-serving, okay maybe a lot. Forgive us.', 'bonestheme' ); ?></p>
										</section>

										<section class="search">
											<p><?php get_search_form(); ?></p>
										</section>
										</div>
							<div class="sixcol last"><p><img src="<?php bloginfo('template_directory'); ?>/library/images/girl_404_page.jpg" alt="UH OH! Little girl." /></p></div>

		

						</article>

					</main>

				</div>

			</div>

<?php get_footer(); ?>
