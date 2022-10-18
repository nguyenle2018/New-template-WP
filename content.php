<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry-thumbnail">
 			<?php tiw_thumbnail('thumbnail'); ?>
        </div>
        <header class="entry-header">
 			<?php tiw_entry_header(); ?>
 			<?php tiw_entry_meta() ?>
        </header>
		<div class="entry-content">
		        <?php tiw_entry_content(); ?>
		        <?php ( is_single() ? tiw_entry_tag() :'' ); ?>
		</div>
</article>