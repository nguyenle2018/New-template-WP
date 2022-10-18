<?php get_header(); ?>

<div id="content">
	<div class="author-box">
        <?php
		// Display avatar of author
		echo '<div class="author-avatar">'. get_avatar( get_the_author_meta( 'ID' ) ) . '</div>';

		// Display name of author
		printf( '<h3>'. __( 'Posts by %1$', 'textdomain' ) . '</h3>', get_the_author() );

		// display description of author
		echo '<p>'. get_the_author_meta( 'description' ) . '</p>';

		// Display field website of author
		if ( get_the_author_meta( 'user_url' ) ) : printf( __('<a href="%1$s" title="Visit to %2$s website">Visit to my website</a>', 'textdomain'),
			get_the_author_meta( 'user_url' ), get_the_author() );
		endif;
	    ?>
    </div>
	<section id="main-content">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>
		<?php tiw_pagination(); ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
	</section>
	<section id="sidebar">
		<?php get_sidebar(); ?>
	</section>

</div>

<?php get_footer(); ?>
