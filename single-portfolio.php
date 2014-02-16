<?php
/**
 * Template for displaying a portfolio post
 *
 * @package Portfolio Press
 */

get_header(); ?>

	<div id="primary">
		<div id="content" role="main">

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-meta">
						<?php portfoliopress_postby_meta(); ?>
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->

				<div class="entry-content">

					<?php if ( !post_password_required() ) :
	                	if ( has_post_thumbnail() && of_get_option( 'portfolio_images', '1' ) ) {
		                	if ( of_get_option( 'layout') == 'layout-1col' ) {
			                	the_post_thumbnail( 'portfolio-fullwidth' );
		                	} else {
			                	the_post_thumbnail( 'portfolio-large' );
		                	}
						}
					endif;
					?>

					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'portfoliopress' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->

				<footer class="entry-meta">
					<?php
						$cat_list = get_the_term_list( $post->ID, 'portfolio_category', '', ', ', '' );
						$tag_list = get_the_term_list( $post->ID, 'portfolio_tag', '', ', ', '' );
						$utility_text = '';
						if ( ( $cat_list ) && ( '' ==  $tag_list ) )
							$utility_text = __( 'This entry was posted in %1$s.', 'portfoliopress' );
						if ( ( '' != $tag_list ) && ( '' ==  $cat_list ) )
							$utility_text = __( 'This entry was tagged %2$s.', 'portfoliopress' );
						if ( ( '' != $cat_list ) && ( '' !=  $tag_list ) )
							$utility_text = __( 'This entry was posted in %1$s and tagged %2$s.', 'portfoliopress' );
						printf(
							$utility_text,
							$cat_list,
							$tag_list
						);
					?>

					<?php edit_post_link( __( 'Edit', 'portfoliopress' ), '<span class="edit-link">', '</span>' ); ?>
				</footer><!-- .entry-meta -->
			</article><!-- #post-<?php the_ID(); ?> -->

			<nav id="nav-below">
				<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'portfoliopress' ); ?></h1>
				<div class="nav-previous"><?php previous_post_link( '%link', '%title <span class="meta-nav">' . _e( '&rarr;', 'Previous post link', 'portfoliopress' ) . '</span>' ); ?></div>
				<div class="nav-next"><?php next_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Next post link', 'portfoliopress' ) . '</span> %title' ); ?></div>
			</nav><!-- #nav-below -->

			<?php if ( comments_open() ) {
				comments_template( '', true );
            } ?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>