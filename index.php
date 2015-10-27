<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="ninecol first cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article class="feed-item" id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<div class="ninecol last cf">

								<header class="article-header">

									<h1 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
									<p class="byline entry-meta vcard">
                                        <?php printf( __( 'Posted %1$s %2$s', 'bonestheme' ),
                       								/* the time the post was published */
                       					'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
                       								/* the author of the post */
                       					'<span class="by">by</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
                    							); ?>
									</p>

								</header>

								<section class="entry-content cf">
									<?php //the_content(); ?>

									<?php
									if(has_excerpt()) { 
										the_excerpt(); ?>
									<a class="excerpt-read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Read more &raquo;</a>
									<?php

									} else {
										the_excerpt();
									} 

									?>
								</section>

								<footer class="article-footer cf">
									<!-- <p class="footer-comment-count">
										<?php comments_number( __( '<span>No</span> Comments', 'bonestheme' ), __( '<span>One</span> Comment', 'bonestheme' ), __( '<span>%</span> Comments', 'bonestheme' ) );?>
									</p> -->


                 	<?php printf( '<p class="footer-category">' . __('Category', 'bonestheme' ) . ': %1$s</p>' , get_the_category_list(', ') ); ?>

                  <?php //the_tags( '<p class="footer-tags tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>


								</footer>

							</div>
							<div class="threecol first blog-featured">
								<?php the_post_thumbnail('medium'); ?>
							</div>

							</article>

							<?php endwhile; ?>

									<?php bones_page_navi(); ?>

							<?php endif; ?>


						</main>

					<?php get_sidebar(); ?>

				</div>

			</div>


<?php get_footer(); ?>
