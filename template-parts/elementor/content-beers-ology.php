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

        <?php if ($settings[$prefix . 'image'] == 'yes' && has_post_thumbnail()) : ?>
        <div class="progression-studios-feaured-beer-image">
            <?php the_post_thumbnail('ology-beers-index'); ?>
        </div><!-- close .progression-studios-feaured-beer-image -->
        <?php endif; ?>

        <div class="progression-beers-content">
            <?php if ($settings[$prefix . 'style'] == 'yes') : ?>
            <?php
                $terms = get_the_terms($post->ID, 'beer-style');
                if (!empty($terms)) :
                    echo '<ul class="beers-category-index">';
                    foreach ($terms as $term_single) {
                        if ($term_single->parent != 0) {
                            continue;
                        }
                        echo '<li>' . $term_single->name . '</li>';
                    }
                    echo '</ul>';
                endif;
                ?>
            <?php endif; ?>

            <h2 class="progression-beers-title">
                <?php // ology_beers_portfolio_image_link(); -- If this adds a link, it should be removed or commented out as done here. 
                ?>
                <?php the_title(); ?>
            </h2>

            <?php if ($settings[$prefix . 'features'] == 'yes' && ($abv = get_post_meta(get_the_ID(), 'ology_abv', true))) : ?>
            <ul class="beers-repeat-list-container">
                <?php
                    $flavors = get_post_meta(get_the_ID(), 'ology_hops', true);
                    ?>
                <li class="beers-description-repeat-pro<?php echo empty($flavors) ? ' hidden' : ''; ?>">
                    <?php echo !empty($flavors) ? wp_kses_post($flavors) : ''; ?>
                </li>

                <?php
                    if (!str_contains($abv, '%')) {
                        $abv .= '%';
                    }
                    ?>
                <li class="beers-description-repeat-pro">
                    <?php echo esc_html($abv) . " ABV"; ?>
                </li>
            </ul>
            <?php endif; ?>

            <?php if ($settings[$prefix . 'availability'] == 'yes' && isset($location)) : ?>
            <?php //if(get_post_meta( get_the_ID(), 'progression_studios_display_season', true )):  
                ?>
            <ul class="beers-availability-list-container">
                <?php
                    $containers = get_post_meta(get_the_ID(), 'ology_' . $location . '_availability');
                    if ($containers) {
                    ?>
                <li class="beers-availability-list text-nowrap">Available in</li>
                <?php
                        foreach ($containers[0] as $slug) {
                            $term = get_term_by('slug', $slug, 'ology-container'); // replace 'your_taxonomy' with the actual taxonomy slug
                            if ($term) {
                        ?>
                <li class="beers-availability-list text-nowrap">
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

            <?php if ($settings[$prefix . 'excerpt'] == 'yes') : ?>
            <!-- Conditionally display Beer Description or excerpt -->
            <?php
                $beer_description = get_post_meta(get_the_ID(), 'ology_beer_description', true);
                if (!empty($beer_description)) {
                    echo '<div class="progression-studios-beers-excerpt">' . esc_html($beer_description) . '</div>';
                } elseif (has_excerpt()) {
                    echo '<div class="progression-studios-beers-excerpt">';
                    the_excerpt();
                    echo '</div>';
                }
                ?>
            <?php endif; ?>

            <?php if (get_post_meta($post->ID, 'progression_studios_button_text', true)) : ?>
            <div class="progression-button-centered">
                <?php progression_studios_portfolio_button_link(); ?>
                <?php echo esc_html(get_post_meta($post->ID, 'progression_studios_button_text', true)); ?></a>
            </div>
            <?php endif; ?>

            <div class="clearfix-pro"></div>
        </div><!-- close .progression-beers-content -->

    </div><!-- close .progression-studios-beers-index -->
</div><!-- #post-## -->