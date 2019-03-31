<?php
/**
 * Template Name: Home Custom Page
 */

get_header(); ?>

<?php do_action( 'katib_writers_before_banner' ); ?>

<section id="banner">
  <?php $pages = array();
    $mod = absint( get_theme_mod( 'katib_writers_banner_page' ));
    if ( 'page-none-selected' != $mod ) {
      $pages[] = $mod;
    }
  if( !empty($pages) ) :
    $args = array(
      'post_type' => 'page',
      'post__in' => $pages,
      'orderby' => 'post__in'
    );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) :
      $count = 0;
      while ( $query->have_posts() ) : $query->the_post(); ?>  
          <img src="<?php the_post_thumbnail_url('full'); ?>"/>
        <div class="box-content">
          <h2><?php the_title(); ?></h2>
          <p><i class="fas fa-quote-left"></i><?php $excerpt = get_the_excerpt(); echo esc_html( katib_writers_string_limit_words( $excerpt,20 ) ); ?><i class="fas fa-quote-right"></i></p> 
          <div class="contact">
            <?php if( get_theme_mod( 'katib_writers_call','' ) != '') { ?>
              <i class="fas fa-phone-volume"></i><span><?php echo esc_html( get_theme_mod('katib_writers_call','') ); ?></span>
            <?php }?>  
            <?php if( get_theme_mod( 'katib_writers_email','' ) != '') { ?>
              <i class="far fa-envelope"></i><span><?php echo esc_html( get_theme_mod('katib_writers_email','') ); ?></span>
            <?php }?>   
          </div>             
          <div class="social-media">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" target="_blank"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a>
            <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="fab fa-google-plus-g" aria-hidden="true"></i></a>
            <a href="https://twitter.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a>
            <a href="http://www.instagram.com/submit?url=<?php the_permalink(); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
          </div>
          <div class ="readbutton">
            <a href="<?php the_permalink(); ?>"><?php esc_html_e('READ MORE','katib-writers'); ?></a>
          </div>
          <div class="clearfix"></div>
        </div>                            
        <?php $count++; endwhile; ?>
      <?php else : ?>
        <div class="no-postfound"></div>
    <?php endif;
  endif; wp_reset_postdata();?>
</section>

<?php do_action( 'katib_writers_after_banner' ); ?>

<?php if( get_theme_mod('katib_writers_about_page') != ''){ ?>

<section id="about">
  <div class="container">
    <?php $pages = array();
      $mod = absint( get_theme_mod( 'katib_writers_about_page'));
      if ( 'page-none-selected' != $mod ) {
        $pages[] = $mod;
      }
    if( !empty($pages) ) :
      $args = array(
        'post_type' => 'page',
        'post__in' => $pages,
        'orderby' => 'post__in'
      );
      $query = new WP_Query( $args );
      if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post(); ?>
          <div class="about-text">
            <div class="row">
              <div class="col-lg-4 col-md-6">
                <img src="<?php the_post_thumbnail_url('full'); ?>"/>
              </div>
              <div class="col-lg-8 col-md-6">
                <h3><?php the_title(); ?></h3>
                <p><?php the_excerpt(); ?></p>
                <div class ="aboutbtn">
                  <a href="<?php the_permalink(); ?>"><?php esc_html_e('MORE ABOUT ME','katib-writers'); ?></a>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else : ?>
          <div class="no-postfound"></div>
      <?php endif;
    endif;
    wp_reset_postdata()?>
      <div class="clearfix"></div> 
  </div>
</section>

<?php }?>

<?php do_action( 'katib_writers_after_about' ); ?>

<div class="container">
  <?php while ( have_posts() ) : the_post();?>
    <?php the_content(); ?>
  <?php endwhile; // End of the loop.
  wp_reset_postdata(); ?>
</div>

<?php get_footer(); ?>