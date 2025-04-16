<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package pro
 */
get_header(); ?>
<style>
body #page-title-overlay-image {
    background-image: url('http://ology.penguindevstudio.local/wp-content/uploads/2023/04/background-dark-2.jpg');
}
</style>
	<?php
	$term_cat = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	?>
	

	<div id="page-title-pro">
		<div id="progression-studios-page-title-container">
			<div class="width-container-pro">
				<h1 class="page-title"><?php echo esc_attr('' . $term_cat->name . '');?></h1>
				<?php the_archive_description( '<h4 class="progression-sub-title">', '</h4>' ); ?>
			</div><!-- #progression-studios-page-title-container -->
			<div class="clearfix-pro"></div>
		</div><!-- close .width-container-pro -->
		<div id="page-title-overlay-image"></div>
	</div><!-- #page-title-pro -->
	
		<div id="content-pro" class="site-content-beers-style-taxonomy">
			<div class="width-container-pro">
				<?php 
				$location_slug = strtolower( str_replace(' ', '-', $term_cat->name) );
				if ($term_cat->name == 'Northside' || $term_cat->name == 'Tampa' || $term_cat->name == 'PowerMill' ) {
					getUntappdItems('tampa', false);
					getUntappdItems('northside', false);
					getUntappdItems('powermill', false);
					//print_r(wp_get_schedules());
				}
				
				?>
				
				<div class="progression-masonry-margins" style="margin-top:-<?php echo esc_attr(get_theme_mod('progression_studios_blog_index_gap', '15')); ?>px; margin-left:-<?php echo esc_attr(get_theme_mod('progression_studios_blog_index_gap', '15')); ?>px; margin-right:-<?php echo esc_attr(get_theme_mod('progression_studios_blog_index_gap', '15')); ?>px;">
					<div class="progression-studios-video-index-list">
					<?php if ( have_posts() ) : ?>
							<?php while ( have_posts() ) : the_post(); 
								// Skip not beers
								if ($post->post_type != 'beer_ontap') {
									continue;
								}
							?>
								<div class="progression-masonry-item progression-masonry-col-<?php echo esc_attr(get_theme_mod( 'progression_studios_blog_columns', '3')); ?>">
									<div class="progression-masonry-padding-blog" style="padding:<?php echo esc_attr(get_theme_mod('progression_studios_blog_index_gap', '15')); ?>px;">
										<div class="progression-studios-isotope-animation">
											<?php get_template_part( 'template-parts/content', 'beers-ontap', array( 'location' => $location_slug)); ?>
										</div><!-- close .studios-isotope-animation -->
									</div><!-- close .progression-masonry-padding-blog -->
								</div><!-- cl ose .progression-masonry-item -->
							<?php endwhile; ?>
				
					<div class="clearfix-pro"></div>
					
					</div><!-- close .progression-studios-video-index-list -->
					
					</div><!-- close .progression-masonry-margins -->
					
					
					<?php if (get_theme_mod( 'progression_studios_blog_pagination', 'default' ) == 'default') : ?>
						<?php progression_studios_show_pagination_links_pro(); ?>
					<?php endif; ?>
			
					<?php if (get_theme_mod( 'progression_studios_blog_pagination') == 'load-more') : ?>
						<div id="progression-load-more-manual"><?php progression_studios_infinite_content_nav_pro( 'nav-below' ); ?></div>
					<?php endif; ?>
			
					<?php if (get_theme_mod( 'progression_studios_blog_pagination') == 'infinite-scroll') : ?>
						<?php progression_studios_infinite_content_nav_pro( 'nav-below' ); ?>
					<?php endif; ?>
			
					<div class="clearfix-pro"></div>
				
					<?php else : ?>
				
						<div class="progression-studios-blog-index">
							<?php get_template_part( 'template-parts/content', 'none' ); ?>
						</div><!-- close .progression-masonry-margins -->
				
					<?php endif; ?>
			<div class="clearfix-pro"></div>
			</div><!-- close .width-container-pro -->
		</div><!-- #content-pro -->
<?php get_footer(); ?>
<script type="text/javascript" id="ontap-progression-scripts-js-after">
	
				jQuery(document).ready(function($) { 
					"use strict";
		
					/* Default Isotope Load Code */
					var $container = $(".progression-studios-video-index-list").isotope();
					$container.imagesLoaded( function() {
						$(".progression-masonry-item").addClass("opacity-progression");
						$container.isotope({
							itemSelector: ".progression-masonry-item",				
							percentPosition: true,
							layoutMode: "fitRows" 
				 		});
					});
					/* END Default Isotope Code */
					
					
					/* Begin Infinite Scroll */
					$container.infinitescroll({
						errorCallback: function(){  $(".infinite-nav-pro").delay(500).fadeOut(500, function(){ $(this).remove(); }); },
					  navSelector  : ".infinite-nav-pro",  
					  nextSelector : ".nav-previous a", 
					  itemSelector : ".progression-masonry-item", 
				   		loading: {
				   		 	img: "http://ology.penguindevstudio.local/wp-content/themes/ontap-progression/images/loader.gif",
				   			 msgText: "",
				   		 	finishedMsg: "<div id='no-more-posts'>No more posts</div>",
				   		 	speed: 0, }
					  },
					  // trigger Isotope as a callback
					  function( newElements ) {
												
					    var $newElems = $( newElements );
		 	
							$newElems.imagesLoaded(function(){
							
							$container.isotope( "appended", $newElems );
							$(".progression-masonry-item").addClass("opacity-progression");
						
						});

					  }
					);
				    /* END Infinite Scroll */
					 
	 	 			/* PAUSE FOR LOAD MORE */
	 	 			$(window).unbind(".infscr");
	 	 			// Resume Infinite Scroll
	 	 			$(".nav-previous a").click(function(){
	 	 				$container.infinitescroll("retrieve");
	 	 				return false;
	 	 			});
	 	 			/* End Infinite Scroll */

				});
			
</script>