<?php
/**
 * @package pro
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="progression-studios-beers-index">

		<?php if (has_post_thumbnail()): ?>
			<div class="progression-studios-feaured-beer-image">
				<?php ology_spirit_portfolio_image_link(); ?>
				<?php the_post_thumbnail('ology-spirit-index');
				//print_r(get_post_meta($post->ID, 'ology_spirit_blog_featured_image_link', true));   ?>
				<?php if (get_post_meta($post->ID, 'ology_spirit_blog_featured_image_link', true) != 'progression_link_none'): ?></a>
				<?php endif; ?>
			</div><!-- close .progression-studios-feaured-beer-image -->
		<?php endif; ?>
		<!-- close featured thumbnail -->

		<div class="progression-beers-content">

			<?php
			$terms = get_the_terms($post->ID, 'spirit-style');
			if (!empty($terms)):
				echo '<ul class="beers-category-index">';
				foreach ($terms as $term_single) {
					$term_link = get_term_link($term_single, 'spirit-style');
					if (is_wp_error($term_link))
						continue;
					echo '<li><a href="' . $term_link . '">' . $term_single->name . '</a></li>';
				}
				echo '</ul>';
			endif;
			?>

			<h2 class="progression-beers-title">
				<?php ology_spirit_portfolio_image_link(); ?>
				<?php the_title(); ?>
				<?php if (get_post_meta($post->ID, 'ology_spirit_blog_featured_image_link', true) != 'progression_link_none'): ?></a>
				<?php endif; ?>
			</h2>

			<?php if (get_post_meta(get_the_ID(), 'progression_studios_display_season', true)): ?>
				<ul class="beers-repeat-list-container">
					<?php $entries = get_post_meta(get_the_ID(), 'ology_spirit_display_season', true);
					$count = 1;
					foreach ((array) $entries as $key => $entry): ?>
						<?php if (isset($entry['progression_studios_description']) && $entry['progression_studios_description'] != ''): ?>
							<li class="beers-description-repeat-pro">
								<?php echo wp_kses(($entry['progression_studios_description']), true) ?>
							</li>
						<?php endif; ?>
						<?php $count++; endforeach; ?>
				</ul>
				<div class="clearfix-pro"></div>
			<?php endif; ?>

			<?php if (has_excerpt()): ?>
				<div class="progression-studios-beers-excerpt">
					<?php the_excerpt(); ?>
				</div><!-- close .progression-studios-beers-excerpt -->
			<?php endif; ?>

			<?php if (get_post_meta($post->ID, 'progression_studios_button_text', true)): ?>
				<div class="progression-button-centered">
					<?php progression_studios_portfolio_button_link(); ?>
					<?php echo esc_html(get_post_meta($post->ID, 'progression_studios_button_text', true)); ?></a>
				</div>
			<?php endif; ?>

			<div class="clearfix-pro"></div>
		</div><!-- close .progression-beers-content -->

	</div><!-- close .progression-studios-beers-index -->
</div><!-- #post-## -->