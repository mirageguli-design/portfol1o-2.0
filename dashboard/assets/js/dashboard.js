( function ( $, window ) {
	'use strict';

	const Dashboard = {
		init() {
			this.bindSidebarToggle();
			this.bindCardTabs();
		},

		bindSidebarToggle() {
			const $toggle = $( '[data-toggle="sidebar"]' );
			const $sidebarInner = $( '.consult-dashboard__sidebar-inner' );

			if ( ! $toggle.length || ! $sidebarInner.length ) {
				return;
			}

			$toggle.on( 'click', function () {
				$sidebarInner.toggleClass( 'is-open' );
				$( this ).toggleClass( 'is-active' );
			} );
		},

		bindCardTabs() {
			const $tabContainers = $( '[data-dashboard-tabs]' );

			if ( ! $tabContainers.length ) {
				return;
			}

			$tabContainers.each( function () {
				const $container = $( this );
				const $navItems  = $container.find( '[data-dashboard-tab]' );
				const $panes     = $container.find( '[data-dashboard-pane]' );

				$navItems.on( 'click', function ( event ) {
					event.preventDefault();

					const target = $( this ).data( 'dashboard-tab' );

					$navItems.removeClass( 'is-active' );
					$( this ).addClass( 'is-active' );

					$panes.removeClass( 'is-active' );
					$panes.filter( `[data-dashboard-pane="${ target }"]` ).addClass( 'is-active' );
				} );

				$navItems.first().trigger( 'click' );
			} );
		},
	};

	$( document ).ready( () => {
		Dashboard.init();
	} );
}( jQuery, window ) );

