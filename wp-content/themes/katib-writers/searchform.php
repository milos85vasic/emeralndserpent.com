<?php
/**
 * Template for displaying search forms in Katib Writers
 */
?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'katib-writers' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
	<button type="submit" class="search-submit">
		<span><?php echo esc_attr_x( 'Search', 'submit button', 'katib-writers' ); ?></span>
	</button>
</form>