<?php
/*
Template Name: Link to Us
*/
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

									<form>  
            <h2>Logo: Transparent Background</h2>
<div style="margin:0;padding:0;">
<a href="http://artk12.com" title="ARTK12: Art History Disguised as Fun"><img style="margin:0;padding:0;width:246px;height:97px;border:none;" src="http://artk12.com/wp-content/uploads/2012/11/artk12-logo.png" alt="ARTK12: Art History Disguised as Fun" width="246" height="97" /></a>
</div>

<textarea readonly>
<div style="margin:0;padding:0;">
<a href="http://artk12.com" title="ARTK12: Art History Disguised as Fun"><img style="margin:0;padding:0;width:246px;height:97px;border:none;" src="http://artk12.com/wp-content/uploads/2012/11/artk12-logo.png" alt="ARTK12: Art History Disguised as Fun" width="246" height="97" /></a>
</div>
</textarea>

<h2>Logo: White Background</h2>
<div style="margin:0;padding:0;">
<a style="margin:0; padding:0; display:block; width:246px; height:97px; text-indent:-9999px; background:url(http://artk12.com/wp-content/uploads/2012/11/artk12-logo.jpg);" href="http://artk12.com" title="ARTK12: Art History Disguised as Fun">ARTK12: Art History Disguised as Fun</a>
</div>

<textarea readonly>
<div style="margin:0;padding:0;">
<a style="margin:0; padding:0; display:block; width:246px; height:97px; text-indent:-9999px; background:url(http://artk12.com/wp-content/uploads/2012/11/artk12-logo.jpg);" href="http://artk12.com" title="ARTK12: Art History Disguised as Fun">ARTK12: Art History Disguised as Fun</a>
</div>
</textarea>

<h2>Logo: Transparent Background</h2>
<div style="margin:0;padding:0;height:49px;">
<a href="http://artk12.com" title="ARTK12: Art History Disguised as Fun"><img style="margin:0;padding:0;width:125px;height:49px;border:none;" src="http://artk12.com/wp-content/uploads/2012/11/artk12-logo-125.png" alt="ARTK12: Art History Disguised as Fun" width="125" height="49" /></a>
</div>
<textarea readonly>
<div style="margin:0;padding:0;height:49px;">
<a href="http://artk12.com" title="ARTK12: Art History Disguised as Fun"><img style="margin:0;padding:0;width:125px;height:49px;border:none;" src="http://artk12.com/wp-content/uploads/2012/11/artk12-logo-125.png" alt="ARTK12: Art History Disguised as Fun" width="125" height="49" /></a>
</div>
</textarea>


<h2>Logo: White Background</h2>
<div style="margin:0;padding:0;">
<a style="margin:0; padding:0; display:block; width:125px; height:49px; text-indent:-9999px; background:url(http://artk12.com/wp-content/uploads/2012/11/artk12-logo-125.jpg);" href="http://artk12.com" title="ARTK12: Art History Disguised as Fun">ARTK12: Art History Disguised as Fun</a>
</div>
<textarea readonly>
<div style="margin:0;padding:0;">
<a style="margin:0; padding:0; display:block; width:125px; height:49px; text-indent:-9999px; background:url(http://artk12.com/wp-content/uploads/2012/11/artk12-logo-125.jpg);" href="http://artk12.com" title="ARTK12: Art History Disguised as Fun">ARTK12: Art History Disguised as Fun</a>
</div>
</textarea>

<h2>Text Link</h2>
<p>Link is not styled....it should match styling on your website</p>

<p style="padding:18px 0px;"><a href="http://artk12.com" title="ARTK12: Art History Disguised as Fun">ARTK12: Art History Curriculum Disguised as Fun</a></p>
<textarea readonly>
<a href="http://artk12.com" title="ARTK12: Art History Disguised as Fun">ARTK12: Art History Curriculum Disguised as Fun</a>
</textarea>

</form>
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
