<?php
/**
 * The template for displaying all single posts.
 *
 * @package pro
 */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
	
	<div id="page-title-pro">
			<div id="progression-studios-page-title-container">
				<div class="width-container-pro">
					<h1 class="page-title"><?php esc_html_e( 'Beers', 'ontap-progression' ); ?></h1>
					<h4 class="progression-sub-title"><?php esc_html_e( 'See what we have been brewing lately', 'ontap-progression' ); ?></h4>
					
					
				</div><!-- close .width-container-pro -->
			</div><!-- close #progression-studios-page-title-container -->
			<div class="clearfix-pro"></div>
			<div id="page-title-overlay-image"></div>
	</div><!-- #page-title-pro -->
	
	
	<div id="content-pro" class="site-content-beers-post">

		<div class="width-container-pro">
				
				<div id="progression-beer-single-content">
	

								<?php 
									$terms = get_the_terms( $post->ID , 'spirit-style' ); 
									if ( !empty( $terms ) ) :
										echo '<ul class="beers-category-index">';
									foreach ( $terms as $term_single ) {
										$term_link = get_term_link( $term_single, 'spirit-style' );
										if( is_wp_error( $term_link ) )
											continue;
										echo '<li><a href="' . $term_link . '">' . $term_single->name . '</a></li>';
									} 
									echo '</ul>';
								endif;
								?>
								<h2 class="progression-beers-title"><?php the_title(); ?></h2>
			
								<?php if(get_post_meta( get_the_ID(), 'progression_studios_display_season', true )): ?>
									<ul class="beers-repeat-list-container">
										<?php $entries = get_post_meta( get_the_ID(), 'progression_studios_display_season', true ); $count = 1; foreach ( (array) $entries as $key => $entry ) :   ?><?php if(isset( $entry['progression_studios_description'] ) && $entry['progression_studios_description'] != '') : ?><li class="beers-description-repeat-pro"><?php echo wp_kses (( $entry['progression_studios_description'] ), true)?></li><?php endif; ?><?php  $count++;  endforeach; ?>
									</ul>
									<div class="clearfix-pro"></div>
								<?php endif; ?>
			
				
									<div class="progression-studios-beers-content"><?php the_content(); ?></div><!-- close .progression-studios-beers-excerpt -->


								<div class="clearfix-pro"></div>


					<div class="clearfix-pro"></div>
	

				</div><!-- close #progression-beer-single-content -->
				
		<div class="clearfix-pro"></div>
		</div><!-- close .width-container-pro -->
				
		
		
	</div><!-- #content-pro -->
		
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>