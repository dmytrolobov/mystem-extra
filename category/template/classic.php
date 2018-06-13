<?php
	/**
		* The Classic template for Category.
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

<section id="primary" class="content-area">
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
		
		<div class="cat-classic">
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		
				<div class="post-img">
					<?php
						// display featured image
					if ( has_post_thumbnail() ) { ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'featured-img', array('class' => 'featured-img',	) );?></a>
					<?php
					}	else { ?>						
						<a href="<?php the_permalink(); ?>" rel="bookmark"><img src="<?php echo MyStem_Category_Temlates_Url .'/assets/img/no-image-icon.png';?>" class="featured-img"></a>
							
					<?php	} 
					?>
				</div>
				<div class="post-content">
					<header class="entry-header">
						<h4 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
						<?php if ( 'post' == get_post_type() ) : ?>
						<div class="entry-meta">
							<?php mystem_posted_on(); ?>
						</div>
						<?php endif; ?>
					</header>	
					
					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div>
				</div>
			</article>
			
			
			<?php endwhile; ?>
		</div>
		<?php the_posts_pagination(); ?>	
		
		<?php else : ?>
		
		<?php get_template_part( 'content/content', 'none' ); ?>
		
		<?php endif; ?>
		
	</main>
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
