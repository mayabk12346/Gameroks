<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="content-aa">
 *
 * @package Advance Blogging
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
  <link rel="profile" href="<?php echo esc_url( __( 'http://gmpg.org/xfn/11', 'advance-blogging' ) ); ?>">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> class="main-bodybox">
  <header role="banner">
    <a class="screen-reader-text skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'advance-blogging' ); ?></a>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-lg-11 col-md-10 col-8 social-icons ">
            <?php if( get_theme_mod( 'advance_blogging_facebook_url' ) != '') { ?>
              <a href="<?php echo esc_url( get_theme_mod( 'advance_blogging_facebook_url','' ) ); ?>"><i class="fab fa-facebook-f" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_attr_e( 'Facebook','advance-blogging' );?></span></a>
            <?php } ?>
            <?php if( get_theme_mod( 'advance_blogging_twitter_url' ) != '') { ?>
              <a href="<?php echo esc_url( get_theme_mod( 'advance_blogging_twitter_url','' ) ); ?>"><i class="fab fa-twitter" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_attr_e( 'Twitter','advance-blogging' );?></span></a>
            <?php } ?>
            <?php if( get_theme_mod( 'advance_blogging_googleplus_url' ) != '') { ?>
              <a href="<?php echo esc_url( get_theme_mod( 'advance_blogging_googleplus_url','' ) ); ?>"><i class="fab fa-google-plus-g"></i><span class="screen-reader-text"><?php esc_attr_e( 'Google plus','advance-blogging' );?></span></a>
            <?php } ?>
            <?php if( get_theme_mod( 'advance_blogging_pinterest_url' ) != '') { ?>
              <a href="<?php echo esc_url( get_theme_mod( 'advance_blogging_pinterest_url','' ) ); ?>"><i class="fab fa-pinterest-p"></i><span class="screen-reader-text"><?php esc_attr_e( 'Pinterest','advance-blogging' );?></span></a>
            <?php } ?>
            <?php if( get_theme_mod( 'advance_blogging_linkedin_url' ) != '') { ?>
              <a href="<?php echo esc_url( get_theme_mod( 'advance_blogging_linkedin_url','' ) ); ?>"><i class="fab fa-linkedin-in"></i><span class="screen-reader-text"><?php esc_attr_e( 'Linkedin','advance-blogging' );?></span></a>
            <?php } ?>
            <?php if( get_theme_mod( 'advance_blogging_insta_url' ) != '') { ?>
              <a href="<?php echo esc_url( get_theme_mod( 'advance_blogging_insta_url','' ) ); ?>"><i class="fab fa-instagram"></i><span class="screen-reader-text"><?php esc_attr_e( 'Instagram','advance-blogging' );?></span></a>
            <?php } ?>
            <?php if( get_theme_mod( 'advance_blogging_youtube_url' ) != '') { ?>
              <a href="<?php echo esc_url( get_theme_mod( 'advance_blogging_youtube_url','' ) ); ?>"><i class="fab fa-youtube" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_attr_e( 'Youtube','advance-blogging' );?></span></a>
            <?php } ?>
          </div>
          <div class="search-box col-lg-1 col-md-2 col-4">
            <span class="search-icon"><a href="#" onclick="search_open()"><i class="fas fa-search"></i><span class="screen-reader-text"><?php the_title(); ?></span></a></span>
          </div>
        </div>  
        <div class="serach_outer">
          <div class="closepop"><a href="#" onclick="search_close()"><i class="far fa-window-close"></i><span class="screen-reader-text"><?php the_title(); ?></span></a></div>
          <div class="serach_inner">
            <?php get_search_form(); ?>
          </div>
        </div>
      </div>
    </div>
    <div id="header">
      <div class="logo">
        <?php if ( has_custom_logo() ) : ?>
          <div class="site-logo"><?php the_custom_logo(); ?></div>
        <?php else: ?>
          <?php $blog_info = get_bloginfo( 'name' ); ?>
          <?php if ( ! empty( $blog_info ) ) : ?>
            <?php if ( is_front_page() && is_home() ) : ?>
              <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h1>
            <?php else : ?>
              <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></p>
            <?php endif; ?>
          <?php endif; ?>
          <?php
          $description = get_bloginfo( 'description', 'display' );
          if ( $description || is_customize_preview() ) :
            ?>
          <p class="site-description">
            <?php echo esc_html($description); ?>
          </p>
          <?php endif; ?>
        <?php endif; ?>
      </div>
      <div class="container">
        <div class="row menu-cart">
          <div class="col-lg-10 col-md-10 col-6 p-0">
            <div class="toggle-menu responsive-menu">
              <button role="tab" onclick="resMenu_open()"><i class="fas fa-bars"></i><span class="screen-reader-text"><?php esc_html_e('Open Menu','advance-blogging'); ?></span></button>
            </div>
           <div id="menu-sidebar" class="nav sidebar">
            <nav id="primary-site-navigation" class="primary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'advance-blogging' ); ?>">
                <a href="javascript:void(0)" class="closebtn responsive-menu" onclick="resMenu_close()"><i class="fas fa-times"></i><span class="screen-reader-text"><?php esc_html_e('Close Menu','advance-blogging'); ?></span></a>
                <?php 
                  wp_nav_menu( array( 
                    'theme_location' => 'primary',
                    'container_class' => 'main-menu-navigation clearfix' ,
                    'menu_class' => 'clearfix',
                    'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
                    'fallback_cb' => 'wp_page_menu',
                  ) ); 
                ?>
            </nav>
          </div>
            <div class="clear"></div>
          </div>
          <div class="col-lg-2 col-md-2 col-6 cart m-0">
            <?php if(class_exists('woocommerce')){ ?>
              <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_cart_page_id') ) ); ?>"><span class="cart-box"><i class="fab fa-opencart"></i><?php  esc_html_e( 'CART','advance-blogging' ); ?></span><span class="screen-reader-text"><?php esc_html_e( 'CART','advance-blogging' );?></span></a> 
              <div class="top-cart-content">
                <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
              </div>
            <?php } ?>
          </div> 
        </div> 
      </div>
    </div>
  </header>