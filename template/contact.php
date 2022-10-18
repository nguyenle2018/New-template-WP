<?php
/*
 Template Name: Contact
 */
 ?>

 <?php get_header(); ?>

<div id="content">

	<section id="main-content">
   
        <div class="contact-info">
        <h4>Adresse</h4>
        <p>4 cours Kenedy 35000 Rennes</p>
        <p>Tel: 02 34 56 78 90</p>
        </div>
        <div class="contact-form">
        <?php echo do_shortcode('[CONTACT FORM]'); ?>
        </div>

	</section>
	<section id="sidebar">
		<?php get_sidebar(); ?>
	</section>

</div>

 
<?php get_footer(); ?>
