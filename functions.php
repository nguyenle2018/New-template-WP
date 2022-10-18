<?php
/*=========== retirer Glutenberg =============== */
add_filter( 'use_block_editor_for_post', '__return_false' );



/**
  @ Set important data and constants
  @ THEME_URL = get_stylesheet_directory() – path to theme folder
  @ CORE = folder /core of theme, contains important source files.
  **/
  define( 'THEME_URL', get_stylesheet_directory() );
  define( 'CORE', THEME_URL . '/core');



/**
  @ Load file /core/init.php
  @ This is the theme's initial configuration file that should not be changed later.
  **/

  require_once( CORE . '/init.php' );

 /**
  @ set up $content_width to declare the width and size of the content
  **/
  if ( ! isset( $content_width ) ) {
  	/*
  	 * If the $content_width variable has no data, assign a value to it
  	 */
  	$content_width = 620;
   }

/**
  @ Set the functions that will be supported by the theme
  **/
  if ( ! function_exists( 'TIW4_theme_setup' ) ) {
  	/*
  	 * If there is no TIW4_theme_setup() function, it will create a new function
  	 */
  	function TIW4_theme_setup() {
  		/*
  		 * Set a translatable theme
  		 */
  		$language_folder = THEME_URL . '/languages';
  		load_theme_textdomain( 'textdomain', $language_folder );


  		/*
  		 * Insert RSS Feed links to <head>
  		 */
  		add_theme_support( 'automatic-feed-links' );

  		/*
  		 * Add post thumbnail
  		 */
  		add_theme_support( 'post-thumbnails' );

  		/*
  		 * Add title-tag for <title>
  		 */
  		add_theme_support( 'title-tag' );

  		/*
  		 * Add post format
  		 */
  		add_theme_support('post-formats',
  			array(
  				'video',
  				'image',
  				'link',
				'quote',
  				'gallery'
  			)
  		 );


  		/*
  		 * Add custom background
  		 */
  		$default_background = array(
  			'default-color' => '#e8e8e8',
  		);
  		add_theme_support( 'custom-background', $default_background );

                /*
                 * Create menu for theme
                 */
                 register_nav_menu ( 'primary-menu', __('Primary Menu', 'textdomain') );

                /*
                 * Create sidebar for theme
                 */
                 $sidebar = array(
                    'name' => __('Main Sidebar', 'textdomain'),
                    'id' => 'main-sidebar',
                    'description' => 'Main sidebar for TIW4 theme',
                    'class' => 'main-sidebar',
                    'before_title' => '<h3 class="widgettitle">',
                    'after_title' => '</h3>'
                 );
                 register_sidebar( $sidebar );
  	}
  	add_action ( 'init', 'TIW4_theme_setup' );

  }


  /**
@ set up a functio to display logo
@ tiw_logo()
**/
if ( ! function_exists( 'tiw_logo' ) ) {
	function tiw_logo() {?>
	  <div class="logo">
  
		<div class="site-name">
		  <?php if ( is_home() ) {
			printf(
			  '<h1><a href="%1$s" title="%2$s">%3$s</a></h1>',
			  get_bloginfo( 'url' ),
			  get_bloginfo( 'description' ),
			  get_bloginfo( 'sitename' )
			);
		  } else {
			printf(
			  '<p><a href="%1$s" title="%2$s">%3$s</a></p>',
			  get_bloginfo( 'url' ),
			  get_bloginfo( 'description' ),
			  get_bloginfo( 'sitename' )
			);
		  } // endif ?>
		</div>
		<div class="site-description"><?php bloginfo( 'description' ); ?></div>
  
	  </div>
	<?php }
  }

  /**
  @ set up a function to display menu
  @ tiw_menu( $slug )
  **/
  if ( ! function_exists( 'tiw_menu' ) ) {
    function tiw_menu( $slug ) {
      $menu = array(
        'theme_location' => $slug,
        'container' => 'nav',
        'container_class' => $slug,
		'items_wrap' => '<ul id="%1$s" class="%2$s sf-menu">%3$s</ul>'
      );
      wp_nav_menu( $menu );
    }
  }



/**
  @ Creative a function for pagination for index, archive.
  @ This function will display connection of pagination : Newer Posts & Older Posts
  @ tiw_pagination()
  **/
  if ( ! function_exists( 'tiw_pagination' ) ) {
    function tiw_pagination() {
      /*
       * No display the pagination if there are less than two pages
       */
       if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
         return '';
      }
    ?>

    <nav class="pagination" role="navigation">
      	<?php if ( get_next_posts_link() ) : ?>
        	<div class="prev"><?php next_posts_link( __('Older Posts', 'textdomain') ); ?></div>
     	<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
        	<div class="next"><?php previous_posts_link( __('Newer Posts', 'textdomain') ); ?></div>
      <?php endif; ?>

    </nav><?php
    }
  }

  /**
@ A function display thumbnail image of the post.
@ Thumbnail image will not display in single page
@ Thumbnail image will display in single page if that post has a format for image
@ tiw_thumbnail( $size )
**/
if ( ! function_exists( 'tiw_thumbnail' ) ) {
	function tiw_thumbnail( $size ) {
	  // Only display thumbnail with post without password
	  if ( ! is_single() &&  has_post_thumbnail()  && ! post_password_required() || has_post_format( 'image' ) ) : ?>
		<figure class="post-thumbnail"><?php the_post_thumbnail( $size ); ?></figure>
<?php  endif;
	}
  }
  
  /**
  @ A function display title of the post in .entry-header
  @ The title of post is in the tag <h1> in the page of single page
  @ The title in Home page is the tag <h2>
  @ tiw_entry_header()
  **/
if ( ! function_exists( 'tiw_entry_header' ) ) {
	function tiw_entry_header() {
	  if ( is_single() ) : ?>
  
		<h1 class="entry-title">
		  <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"> <?php the_title(); ?>
		  </a>
		</h1>
	  <?php else : ?>
		<h2 class="entry-title">
		  <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"> <?php the_title(); ?>
		  </a>
		</h2><?php
  
endif;
	}
  }

  /**
@ A function display information of the post (Post Meta)
@ tiw_entry_meta()
**/
if( ! function_exists( 'tiw_entry_meta' ) ) {
	function tiw_entry_meta() {
	  if ( ! is_page() ) :
		echo '<div class="entry-meta">';
  
		  // Display name of author, category and date oo the pushlish
		  printf( __('<span class="author">Posted by %1$s</span>', 'textdomain'),
			get_the_author() );
  
		  printf( __('<span class="date-published"> at %1$s</span>', 'textdomain'),
			get_the_date() );
  
		  printf( __('<span class="category"> in %1$s </span>', 'textdomain'),
			get_the_category_list( ',' ) );
  
		  // Display the number of the comments
		  if ( comments_open() ) :
			echo '<span class="meta-reply">';
			  comments_popup_link(
				__('Leave a comment', 'textdomain'),
				__('One comment', 'textdomain'),
				__('% comments', 'textdomain'),
				__('Read all comments', 'textdomain')
			   );
			echo '</span>';
		  endif;
		echo '</div>';
	  endif;
	}
  }
  
  /*
   * Add Read More in excerpt
   */
  function tiw_readmore() {
	return '…<a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'textdomain') . '</a>';
  }
  add_filter( 'excerpt_more', 'tiw_readmore' );
  
	/**
	@ A function display the content of the post type
	@ This function display a part of the post content  outside the home page (the_excerpt)
	@ But it will display all of post content in single page (the_content)
	@ tiw_entry_content()
	**/
	if ( ! function_exists( 'tiw_entry_content' ) ) {
	  function tiw_entry_content() {
  		if ( ! is_single() && !is_page() ) :
		  the_excerpt(); //sumary f content
		else :
		  the_content();
  
		  /*
		   * Code for pagination in the post type
		   */
		  $link_pages = array(
			'before' => __('<p>Page:', 'textdomain'),
			'after' => '</p>',
			'nextpagelink'     => __('Next page', 'textdomain'),
			'previouspagelink' => __('Previous page', 'textdomain')
		  );
		  wp_link_pages( $link_pages );
		endif;
  
	  }
	}
  
	/**
  @ A function display tag of post
  @ tiw_entry_tag()
  **/
  if ( ! function_exists( 'tiw_entry_tag' ) ) {
	function tiw_entry_tag() {
	  if ( has_tag() ) :
		echo '<div class="entry-tag">';
		printf( __('Tagged in %1$s', 'textdomain'), get_the_tag_list( '', ',' ) );
		echo '</div>';
	  endif;
	}
  }
  

/**
  @ link CSS and Javascript in theme
  @ use hook wp_enqueue_scripts() to display in front-end
  **/
function tiw_styles() {
    /*
     * get_stylesheet_uri() sẽ trả về giá trị dẫn đến file style.css của theme
     * Nếu sử dụng child theme, thì file style.css này vẫn load ra từ theme mẹ
     */
    wp_register_style( 'main-style', get_template_directory_uri() . '/style.css', 'all' );
    wp_enqueue_style( 'main-style' );

	/*
	* Chèn các file CSS của SuperFish Menu
	*/
	wp_register_style( 'superfish-css', get_template_directory_uri() . '/css/superfish.css', 'all' );
	wp_enqueue_style( 'superfish-css' );

	/*
	* Chèn file JS của SuperFish Menu
	*/
	wp_register_script( 'superfish-js', get_template_directory_uri() . '/js/superfish.js', array('jquery') );
	wp_enqueue_script( 'superfish-js' );

	/*
	* Chèn file JS custom.js
	*/
	wp_register_script( 'custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery') );
	wp_enqueue_script( 'custom-js' );

}
  add_action( 'wp_enqueue_scripts', 'tiw_styles' );