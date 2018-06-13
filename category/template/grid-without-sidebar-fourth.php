<?php
/**
 * The Grid template for Category.
 *
 * @package WordPress
 * @subpackage MyStem
 * @since MyStem 1.2
 */

get_header(); 
$term = get_queried_object();
$mystem_cat_meta = get_option( "mystem_taxonomy_".$term->term_id );
$icon_color = !empty( $mystem_cat_meta['icon_color'] ) ? ' style="color:' . esc_attr( $mystem_cat_meta['icon_color'] ) . '"' : '';
$icon = !empty( $mystem_cat_meta['icon_field'] ) ? '<i class="' . esc_attr( $mystem_cat_meta['icon_field'] ) . '"' . $icon_color . '></i> ' : '';
?>

	<section id="primary-full" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

		<?php if ( empty( $mystem_cat_meta['hide_header'] ) ) : ?>
		<header class="page-header">
			<h1 class="page-title">
				<?php echo $icon . single_cat_title( '', false ); ?>
			</h1>
			<?php echo category_description(); ?>
			</header>
		<?php endif; ?>
			
			<div class="cat-grid fourth">
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content/content', get_post_format() );
				?>
				
			<?php endwhile; ?>
			</div>
			<?php the_posts_pagination(); ?>	

		<?php else : ?>

			<?php get_template_part( 'content/content', 'none' ); ?>

		<?php endif; ?>

		</main>
	</section>

<?php get_footer(); ?>
