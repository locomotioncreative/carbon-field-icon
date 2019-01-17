<?php

namespace Carbon_Field_Icon\Providers;

class Font_Awesome_Provider implements Icon_Provider_Interface {
	const VERSION = '5.5.0';

	/**
	 * Enqueue assets in the backend.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		wp_enqueue_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.5.0/css/all.css', array(), '5.5.0' );
	}

	/**
	 * Get the provider options.
	 *
	 * @access public
	 *
	 * @return array
	 */
	public function parse_options() {
		$options = [];

		$icons = json_decode( file_get_contents( \Carbon_Field_Icon\DIR . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'fontawesome.json' ), true );

		foreach ( $icons as $icon ) {
			$value = $icon['id'];
			
			if ( $icon['styles'][0] === 'brands' ) {
				$icon_class = 'fab';
			} else if ( $icon['styles'][0] === 'solid' ) {
				$icon_class = 'fas';
			}

			$options[ $value ] = array(
				'value'        => $value,
				'name'         => $icon['name'],
				'class'        => "{$icon_class} fa-" . $icon['id'],
				'search_terms' => $icon['search_terms'],
			);
		}

		return $options;
	}
}
