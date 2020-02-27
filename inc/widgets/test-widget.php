<?php

use Elementor\Widget_Base;

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Test_Widget extends Widget_Base {
	public $script_version = '1.0.0';

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		wp_register_style( 'test-elementor-style', ELEMENTOR_TEST_ASSETS_URL . '/css/widget.css', '', $this->script_version );
		wp_register_script( 'test-elementor-script', ELEMENTOR_TEST_ASSETS_URL . '/js/main.js', [ 'jquery' ], $this->script_version, true );
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @return string Widget name.
	 * @since  1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'digthis-test-widget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @return string Widget title.
	 * @since  1.0.0
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'Digthis Test Widget', 'elementor-test-extension' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @return string Widget icon.
	 * @since  1.0.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'fa fa-code';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @return array Widget categories.
	 * @since  1.0.0
	 * @access public
	 *
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'elementor-test-extension' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'url',
			[
				'label'       => __( 'URL to embed', 'elementor-test-extension' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'input_type'  => 'url',
				'placeholder' => __( 'https://your-link.com', 'elementor-test-extension' ),
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$html = wp_oembed_get( $settings['url'] );

		echo '<div class="oembed-elementor-widget">';

		echo ( $html ) ? $html : $settings['url'];

		echo '</div>';

	}

	public function get_script_depends() {
		return [ 'test-elementor-script' ];
	}

	public function get_style_depends() {
		return [ 'test-elementor-style' ];
	}

}