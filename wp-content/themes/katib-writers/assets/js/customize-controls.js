( function( api ) {

	// Extends our custom "katib-writers" section.
	api.sectionConstructor['katib-writers'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );