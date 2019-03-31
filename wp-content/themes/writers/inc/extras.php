<?php
/**
 * @package writers
 */
/**
 * Display Post breadcrumbs when applicable.
 *
 * @since writers 1.0
 * 
 * @link: https://www.branded3.com/blog/creating-a-really-simple-breadcrumb-function-for-pages-in-wordpress/
 */
if ( ! function_exists( 'writers_breadcrumbs' ) ) :
  function writers_breadcrumb() {
    
    global $post;
    
    $output = '';
    $breadcrumbs = array();
    $separator = '<span class="breadcrumb-separator">&raquo;</span>';
    $breadcrumb_id = 'breadcrumbs';
    $breadcrumb_class = 'entry-meta';
    
    $page_title = '<span class="current">' . get_the_title( $post->ID ) . '</span>';
    $home_link = '<a aria-label="' . esc_html__( 'Home', 'writers' ) .'" title="' . esc_html__( 'Home', 'writers' ) .'" class="breadcrumb-home" href="' . esc_url( home_url() ) . '"><i class="fa fa-home"></i></a>' . $separator;
    
    $output .= "<div aria-label='" . esc_html__( 'You are here:', 'writers' ) . "' id='$breadcrumb_id' class='$breadcrumb_class'>";
    $output .= $home_link;
    
    if( $post->post_parent ) {
      $parent_id = $post->post_parent;
      
      while( $parent_id ) {
        $page = get_page( $parent_id );
        $breadcrumbs[] = '<a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . get_the_title( $page->ID ) . '</a>';
        $parent_id = $page->post_parent;
      }
      
      $breadcrumbs = array_reverse( $breadcrumbs );
      $breadcrumbs_str = implode( $separator, $breadcrumbs ); 
      $output .= $breadcrumbs_str . $separator;
    }
    
    $output .= $page_title;
    $output .= "</div>";
    
    echo wp_kses_post( $output );
    
  }

  endif;



/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function writers_body_classes( $classes ) {
  // Adds a class of group-blog to blogs with more than 1 published author.
  if ( is_multi_author() ) {
    $classes[] = 'group-blog';
  }

  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    $classes[] = 'hfeed';
  }

  return $classes;
}


function  writers_add_top_level_menu_url( $atts, $item, $args ){
  if ( isset($args->has_children) && $args->has_children  ) {
    $atts['href'] = ! empty( $item->url ) ? $item->url : '';
  }
  return $atts;
}
add_filter( 'nav_menu_link_attributes', 'writers_add_top_level_menu_url', 99, 3 );



if ( ! function_exists( 'writers_header_menu' ) ) :

  function writers_header_menu() {
    wp_nav_menu(array(
      'theme_location'    => 'primary',
      'depth'             => 2,
      'container'         => 'div',
      'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
      'menu_class'        => 'nav navbar-nav',
      'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
      'walker'            => new wp_bootstrap_navwalker()
      ));
  } /* end header menu */
  endif;
