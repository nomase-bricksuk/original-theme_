<?php
/**
* Template Name: Fixed Page
*/

get_header();
?>

<?php if( have_posts() ): ?>
	<?php while( have_posts() ): ?>
		<?php the_post(); ?>

		<?php remove_filter( 'the_content', 'wpautop' ); ?>
		<?php the_content(); ?>

	<?php endwhile; ?>
<?php endif; ?>

<?php
get_footer();
