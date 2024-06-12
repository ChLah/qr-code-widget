<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Qr_Code_Widget extends \Elementor\Widget_Base
{
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
    }

    public function get_name()
    {
        return 'QR-Code';
    }

    public function get_title()
    {
        return esc_html__('QR Code Widget', 'qr-code-gen');
    }

    public function get_icon()
    {
        return 'eicon-barcode';
    }

    public function get_custom_help_url()
    {
        return 'https://seenland-solutions.de';
    }

    public function get_categories()
    {
        return ['general'];
    }

    public function get_keywords()
    {
        return ['qr', 'qrcode'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'qr-code-gen'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'Text',
            [
                'label' => esc_html__('Text', 'qr-code-gen'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('The text to display as qr code', 'qr-code-gen'),
                'label_block' => true,
                'dynamic' => [
		        	'active' => true,
		        ],
            ]
        );

        $this->add_responsive_control(
			'Size',
			[
				'label' => esc_html__( 'Size', 'qr-code-gen' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					]
				],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 5,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 3,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 2,
					'unit' => 'px',
				],
			]
		);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $text = $settings['Text'];
        $size_val = $settings['Size'];

        if (!empty($text)) {
            $size = $size_val['size'] . $size_val['unit'];
            $qr = QRCode::getMinimumQRCode($text, QR_ERROR_CORRECT_LEVEL_L);
            $qr->printHTML($size);
        }
    }
}
