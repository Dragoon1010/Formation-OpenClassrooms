<?php
/**
 * Pro customizer section.
 *
 * @since NepalBuzz 0.1
 * @access public
 */
class nepalbuzz_upgrade_pro_customize_section_pro extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since NepalBuzz 0.1
	 * @access public
	 * @var    string
	 */
	public $type = 'upgrade-button';

	/**
	 * Custom button text to output.
	 *
	 * @since NepalBuzz 0.1
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since NepalBuzz 0.1
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since NepalBuzz 0.1
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since NepalBuzz 0.1
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}