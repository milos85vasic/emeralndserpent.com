<?php
/**
 * The header for our theme 
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="<?php echo esc_url( __( 'http://gmpg.org/xfn/11', 'katib-writers' ) ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="masthead" class="site-header" role="banner">
		<div class="main-header">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-3">
						<div class="logo">
							<?php if( has_custom_logo() ){ the_custom_logo();
				             }else{ ?>
				            <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				            <?php $description = get_bloginfo( 'description', 'display' );
				            if ( $description || is_customize_preview() ) : ?> 
				              <p class="site-description"><?php echo esc_html($description); ?></p>
				            <?php endif; }?>
				        </div>
					</div>
					<div class="col-lg-9 col-md-9">
						<?php if ( has_nav_menu( 'top' ) ) : ?>
							<div class="navigation-top">
								<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</header>

	<div class="site-content-contain">
		<div id="content">
