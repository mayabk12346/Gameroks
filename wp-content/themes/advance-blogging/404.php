<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Advance Blogging
 */
get_header(); ?>

<main id="main" role="main" class="content-aa">
	<div class="container">
        <div class="page-content">
			<h1><?php esc_html_e( '404 Not Found', 'advance-blogging' ); ?></h1>
			<p class="text-404"><?php esc_html_e( 'Looks like you have taken a wrong turn', 'advance-blogging' ); ?></p>
			<p class="text-404"><?php esc_html_e( 'Dont worry it happens to the best of us.', 'advance-blogging' ); ?></p>
			<div class="read-moresec">
        		<a href="<?php echo esc_url( home_url() ); ?>" class="button"><?php esc_html_e( 'Back to Home Page', 'advance-blogging' ); ?><span class="screen-reader-text"><?php esc_html_e( 'Back to Home Page','advance-blogging' );?></span></a>
			</div>
			<div class="clearfix"></div>
        </div>
	</div>
</main>
	
<?php get_footer(); ?>