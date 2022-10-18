<?php
		if ( is_active_sidebar('main-') ) {
			dynamic_sidebar( 'main-sidebar' );
		} else {
			_e('This is widget area. Go to Appearance -> Widgets to add some widgets.', 'textdomain');
		}
	?>