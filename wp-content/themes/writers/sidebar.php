<?php
/**
 * The sidebar containing the main widget area.
 *
 *  
 * @package writers
 */
?>
<div id="secondary" class="col-md-3 sidebar widget-area" role="complementary">
    <?php do_action( 'lighthouse_before_sidebar' ); ?>
   <?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary .widget-area -->


