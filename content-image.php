<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry-thumbnail">
 			<?php tiw_thumbnail('large'); ?>
        </div>
        <header class="entry-header">
 			<?php tiw_entry_header(); ?>
 			<?php 
                $attatchment = get_children(array('post_parent' => $post -> ID)); // count the number of image
                $attatchment_number = count($attatchment);
                //printf(__('This image post contains %1$s photos', 'textdomain'), $attatchment_number);
            ?>
        </header>
		<div class="entry-content">
		        <?php tiw_entry_content(); ?>
		        <?php ( is_single() ? tiw_entry_tag() :'' ); ?>
		</div>
</article>