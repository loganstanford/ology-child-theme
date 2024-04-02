<?php
if (isset($args_template['prefix'])) {
	$prefix = $args_template['prefix'];
} else {
	$prefix = 'ology_beers_';
}
if (isset($args_template['location'])) {
	$location = $args_template['location'];
}
/**
 * @package pro
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="progression-studios-beers-index">
        <?php
		?>

        <?php if ($settings[$prefix . 'image'] == 'yes'): ?>
        <?php if (has_post_thumbnail()): ?>
        <div class="progression-studios-feaured-beer-image">
            <?php progression_studios_portfolio_image_link(); ?>
            <?php the_post_thumbnail('ology-beers-index'); ?>
            <?php if (get_post_meta($post->ID, 'progression_studios_blog_featured_image_link', true) != 'progression_link_none'): ?></a>
            <?php endif; ?>
        </div><!-- close .progression-studios-feaured-beer-image -->
        <?php endif; ?>
        <!-- close featured thumbnail -->
        <?php endif; ?>

        <div class="progression-beers-content">
            <?php if ($settings[$prefix . 'style'] == 'yes'): ?>
            <?php
				$terms = get_the_terms($post->ID, 'beer-style');
				//print_r($terms);
				if (!empty($terms)):
					echo '<ul class="beers-category-index">';
					foreach ($terms as $term_single) {
						if ($term_single->parent != 0) {
							continue;
						}
						$term_link = get_term_link($term_single, 'beer-style');
						if (is_wp_error($term_link))
							continue;
						//echo '<li><a href="' . $term_link . '">' . $term_single->name . '</a></li>';
						echo '<li>' . $term_single->name . '</li>';
					}
					echo '</ul>';
				endif;
				?>
            <?php endif; ?>

            <h2 class="progression-beers-title">
                <?php ology_beers_portfolio_image_link(); ?>
                <?php the_title(); ?>
                <?php if (get_post_meta($post->ID, 'progression_studios_featured_image_link', true) != 'progression_link_none'): ?></a>
                <?php endif; ?>
            </h2>

            <?php if ($settings[$prefix . 'features'] == 'yes'): ?>
            <?php if ($abv = get_post_meta(get_the_ID(), 'ology_abv', true)) {
					?>
            <ul class="beers-repeat-list-container">
                <?php
						if ($flavors = get_post_meta(get_the_ID(), 'ology_hops', true)) {
							?>
                <li class="beers-description-repeat-pro">
                    <?php echo wp_kses($flavors, true); ?>
                </li>
                <?php
						} else {
							?>
                <li class="beers-description-repeat-pro"></li>
                <?php
						}
						if ($abv) {
							if (!str_contains($abv, '%')) {
								$abv .= '%';
							}
							?>
                <li class="beers-description-repeat-pro">
                    <?php echo $abv . " ABV"; ?>
                </li>
                <?php
						}
						?>
            </ul>
            <?php

				} ?>
            <?php endif; ?>
            <?php if ($settings[$prefix . 'availability'] == 'yes' && isset($location)): ?>
            <?php //if(get_post_meta( get_the_ID(), 'progression_studios_display_season', true )):  ?>
            <ul class="beers-availability-list-container">
                <?php
					$containers = get_post_meta(get_the_ID(), 'ology_' . $location . '_availability');
					if ($containers) {
						?>
                <li class="beers-availability-list">Available in</li>
                <?php
						foreach ($containers as $slug) {
							$term = get_term_by('slug', $slug, 'ology-container'); // replace 'your_taxonomy' with the actual taxonomy slug
							if ($term) {
								?>
                <li class="beers-availability-list">
                    <?php echo esc_html($term->name); ?>
                </li>
                <?php
							}
						}
					}
					?>
            </ul>
            <div class="clearfix-pro"></div>
            <?php endif; ?>

            <?php if ($settings[$prefix . 'excerpt'] == 'yes'): ?>
            <?php if (has_excerpt()): ?>
            <div class="progression-studios-beers-excerpt">
                <?php the_excerpt(); ?>
            </div><!-- close .progression-studios-beers-excerpt -->
            <?php endif; ?>
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