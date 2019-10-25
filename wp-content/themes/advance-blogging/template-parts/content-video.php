<?php
/**
 * The template part for displaying single-post
 *
 * @package Advance Blogging
 * @subpackage advance_blogging
 * @since Advance Blogging 1.0
 */
?>
<?php
  $content = apply_filters( 'the_content', get_the_content() );
  $video = false;
  // Only get video from the content if a playlist isn't present.
  if ( false === strpos( $content, 'wp-playlist-script' ) ) {
    $video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
  }
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="postbox mdallpostimage">
    <div class="postimage">
      <?php
        if ( ! is_single() ) {
          // If not a single post, highlight the video file.
          if ( ! empty( $video ) ) {
            foreach ( $video as $video_html ) {
              echo '<div class="entry-video">';
                echo $video_html;
              echo '</div>';
            }
          }
        }; 
      ?>
      <div class="metabox">
        <div class="dateday"><?php echo esc_html( get_the_date( 'd') ); ?></div>
        <hr class="metahr m-0 p-0">
        <div class="month"><?php echo esc_html( get_the_date( 'M' ) ); ?></div>
        <div class="year"><?php echo esc_html( get_the_date( 'Y' ) ); ?></div>
      </div>
    </div>
    <div class="new-text">
      <div class="box-content">
        <h2><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
        <div class="entry-content"><p><?php echo the_excerpt(); ?></p></div>
        <a href="<?php echo esc_url( the_permalink() );?>" class="blogbutton-mdall" title="<?php esc_attr_e( 'READ MORE', 'advance-blogging' ); ?>"><?php esc_html_e('READ MORE','advance-blogging'); ?><span class="screen-reader-text"><?php esc_html_e( 'READ MORE','advance-blogging' );?></span></a>
      </div>
    </div>
    <div class="clearfix"></div> 
  </div> 
</article>