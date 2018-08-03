<?php
/**
 * The template for adding Customizer Custom Controls
 *
 * @package NepalBuzz
 */

	//Custom control for dropdown category multiple select
	class nepalbuzz_Customize_Dropdown_Categories_Control extends WP_Customize_Control {
		public $type = 'dropdown-categories';

		public $name;

		public function render_content() {
			$dropdown = wp_dropdown_categories(
				array(
					'name'             => $this->name,
					'echo'             => 0,
					'hide_empty'       => false,
					'show_option_none' => false,
					'hide_if_empty'    => false,
					'show_option_all'  => __( 'All Categories', 'nepalbuzz' )
				)
			);

			$dropdown = str_replace('<select', '<select multiple = "multiple" style = "height:95px;" ' . $this->get_link(), $dropdown );

			printf( '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',esc_html( $this->label ), $dropdown ); // WPCS: XSS OK.
			echo '<p class="description">'. esc_html__( 'Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.', 'nepalbuzz' ) . '</p>';
		}
	}

	//Custom control for dropdown category multiple select
	class nepalbuzz_Important_Links extends WP_Customize_Control {
        public $type = 'important-links';

        public function render_content() {
        	//Add Theme instruction, Support Forum, Changelog, Donate link, Review, Facebook, Twitter, Google+, Pinterest links
            $important_links = array(
							'theme_instructions' => array(
								'link'	=> esc_url( 'https://catchthemes.com/theme-instructions/nepalbuzz/' ),
								'text' 	=> esc_html__( 'Theme Instructions', 'nepalbuzz' ),
								),
							'support' => array(
								'link'	=> esc_url( 'https://catchthemes.com/support/' ),
								'text' 	=> esc_html__( 'Support', 'nepalbuzz' ),
								),
							'changelog' => array(
								'link'	=> esc_url( 'https://catchthemes.com/changelogs/nepalbuzz-theme/' ),
								'text' 	=> esc_html__( 'Changelog', 'nepalbuzz' ),
								),
							);
			foreach ( $important_links as $important_link) {
				echo '<p><a target="_blank" href="' . $important_link['link'] .'" >' . esc_attr( $important_link['text'] ) .' </a></p>';
			}
        }
    }
