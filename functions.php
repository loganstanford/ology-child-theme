<?php
//
// Recommended way to include parent theme styles.
//  (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
//  
add_action( 'wp_enqueue_scripts', 'ontap_child_progression_studios_enqueue_styles' );
function ontap_child_progression_studios_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
		get_stylesheet_uri(),
        //get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}

//
// Your code goes below
//
/**
 * Enqueue scripts and styles
 */

function ology_scripts() {

	//if (  is_tax( 'ology-location' ) ) {
		wp_enqueue_script( 'particles', get_template_directory_uri() . '/js/particles.js', array( 'jquery' ), '20120206', true );
		wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.js', array( 'jquery' ), '20120206', true );
		wp_enqueue_script( 'ontap-progression-infinite-scroll', get_template_directory_uri() . '/js/infinite-scroll.js', array( 'jquery' ), '20120206', true );
	//}
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_action( 'wp_enqueue_scripts', 'ology_scripts' );


function ology_spirit_portfolio_image_link() {
	global $post;
?>

<?php if(get_post_meta($post->ID, 'ology_spirit_blog_featured_image_link', true) != 'progression_link_none'): ?>
<?php if(get_post_meta($post->ID, 'ology_spirit_blog_featured_image_link', true) == 'progression_link_url'): ?>

<a href="<?php echo esc_url( get_post_meta($post->ID, 'ology_spirit_external_link', true) );?>">

    <?php else: ?>

    <?php if(get_post_meta($post->ID, 'ology_spirit_blog_featured_image_link', true) == 'progression_link_url_new_window'): ?>

    <a href="<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_external_link', true) );?>"
        target="_blank">

        <?php else: ?>
        <a href="<?php the_permalink(); ?>">

            <?php endif; ?>

            <?php endif; ?>
            <?php endif; ?>



            <?php
}

function ology_spirit_setup() {
	
	// Post Thumbnails
	add_theme_support( 'post-thumbnails' );
	
	add_image_size('ology_spirit-blog-index', 900, 500, true);
	add_image_size('ology-spirit-post-title', 1400, 600, true);
	add_image_size('ology-spirit-index', 279, 496, true);
    
}

add_action( 'after_setup_theme', 'ology_spirit_setup' );

function ology_beers_portfolio_image_link() {
	global $post;
?>

            <?php if(get_post_meta($post->ID, 'progression_studios_blog_featured_image_link', true) != 'progression_link_none'): ?>
            <?php if(get_post_meta($post->ID, 'progression_studios_blog_featured_image_link', true) == 'progression_link_url'): ?>

            <a href="<?php echo esc_url( get_post_meta($post->ID, 'progression_elements_external_link', true) );?>">

                <?php else: ?>

                <?php if(get_post_meta($post->ID, 'progression_elements_blog_featured_image_link', true) == 'progression_link_url_new_window'): ?>

                <a href="<?php echo esc_url( get_post_meta($post->ID, 'ology_beers_external_link', true) );?>"
                    target="_blank">

                    <?php else: ?>
                    <a href="<?php the_permalink(); ?>">

                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php
}


function ology_beers_setup() {
    add_image_size('ology-beers-index', 300, 300, true);
}
add_action( 'after_setup_theme', 'ology_beers_setup');