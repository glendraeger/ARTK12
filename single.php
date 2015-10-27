<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" class="ninecol first cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

                <header class="article-header entry-header">

                  <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>

                  <p class="byline entry-meta vcard">

                    <?php printf( __( 'Posted %1$s %2$s', 'bonestheme' ),
                       /* the time the post was published */
                       '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
                       /* the author of the post */
                       '<span class="by">by</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
                    ); ?>

                  </p>

                </header> <?php // end article header ?>

                <section class="entry-content cf" itemprop="articleBody">
                  <div class="the-content">
                  <?php the_content(); ?>
                  </div>

                  <?php 
                  //*********************************
                  // PUZZLE PAGES START
                  //*********************************

                  if(in_category('puzzle') && has_post_thumbnail()) { 
                    $comments_class = ' sixcol';
                    include_once('library/games/puzzles.php'); 
                  

                  //*********************************
                  // FORGERY PAGES START
                  //*********************************

                  } elseif(in_category('forgery')) {
                    $comments_class = ' sixcol';


                  //*********************************
                  // MATCHING PAGES START
                  //*********************************

                  } elseif(in_category('matching-games')) {
                    $comments_class = ' sixcol';

                     //echo do_shortcode('[matching_game]');
                    
                  } else { 
                    
                  $comments_class = '';

                  } ?>




                </section> <?php // end article section ?>

                <footer class="article-footer">

                  <?php printf( __( 'Filed under: %1$s', 'bonestheme' ), get_the_category_list(', ') ); ?>

                  <?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

                </footer> <?php // end article footer ?>
                <div class="single-comments<?php echo $comments_class; ?>">
                  <?php comments_template(); ?>
                </div>

              </article> <?php // end article ?>

						<?php endwhile; ?>

						<?php endif; ?>

					</main>

					<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
