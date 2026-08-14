<?php
namespace AnotherStep\Integrations;

class FooterSettings
{
    public function init(): void
    {
        add_action( 'init', [ $this, 'register_nav_menus' ] );
        add_action( 'acf/init', [ $this, 'register_acf_options' ] );
        add_action( 'acf/init', [ $this, 'register_acf_fields' ] );
    }

    public function register_nav_menus(): void
    {
        register_nav_menus([
            'quick-links'  => __( 'Quick Links Menu', 'anotherstep' ),
            'our-services' => __( 'Our Services Menu', 'anotherstep' ),
            'legal-links'  => __( 'Legal Links Menu', 'anotherstep' ),
        ]);
    }

    public function register_acf_options(): void
    {
        if ( function_exists( 'acf_add_options_page' ) ) {
            acf_add_options_page([
                'page_title'         => 'Footer Settings',
                'menu_title'         => 'Footer Settings',
                'menu_slug'          => 'footer-settings',
                'capability'         => 'manage_options',
                'show_in_graphql'    => true,
                'graphql_field_name' => 'footerSettings',
            ]);
        }
    }

    public function register_acf_fields(): void
    {
        if ( function_exists( 'acf_add_local_field_group' ) ) {
            acf_add_local_field_group([
                'key'                => 'group_footer_settings',
                'title'              => 'Footer Settings',
                'show_in_graphql'    => true,
                'graphql_field_name' => 'officeDetails',
                'fields'             => [
                    [
                        'key'                => 'field_footer_logo',
                        'label'              => 'Footer Logo',
                        'name'               => 'logo',
                        'type'               => 'image',
                        'return_format'      => 'array',
                        'show_in_graphql'    => true,
                        'graphql_field_name' => 'logo',
                    ],
                    [
                        'key'                => 'field_company_name',
                        'label'              => 'Company Name',
                        'name'               => 'company_name',
                        'type'               => 'text',
                        'default_value'      => 'Another Step',
                        'show_in_graphql'    => true,
                        'graphql_field_name' => 'companyName',
                    ],
                    [
                        'key'                => 'field_footer_description',
                        'label'              => 'Footer Description',
                        'name'               => 'description',
                        'type'               => 'textarea',
                        'default_value'      => 'Supporting independent living with clarity, care, and community for everyone.',
                        'show_in_graphql'    => true,
                        'graphql_field_name' => 'description',
                    ],
                    [
                        'key'                => 'field_copyright_text',
                        'label'              => 'Copyright Text',
                        'name'               => 'copyright_text',
                        'type'               => 'text',
                        'instructions'       => 'Use {year} as a placeholder for the current year.',
                        'default_value'      => '© {year} Another Step. All rights reserved.',
                        'show_in_graphql'    => true,
                        'graphql_field_name' => 'copyrightText',
                    ],
                    [
                        'key'                => 'field_footer_offices',
                        'label'              => 'Offices',
                        'name'               => 'offices',
                        'type'               => 'repeater',
                        'show_in_graphql'    => true,
                        'graphql_field_name' => 'offices',
                        'layout'             => 'block',
                        'sub_fields'         => [
                            [
                                'key'             => 'field_office_name',
                                'label'           => 'Office Name',
                                'name'            => 'name',
                                'type'            => 'text',
                                'show_in_graphql' => true,
                            ],
                            [
                                'key'             => 'field_office_address',
                                'label'           => 'Address',
                                'name'            => 'address',
                                'type'            => 'textarea',
                                'show_in_graphql' => true,
                            ],
                            [
                                'key'             => 'field_office_phone',
                                'label'           => 'Phone Number',
                                'name'            => 'phone',
                                'type'            => 'text',
                                'show_in_graphql' => true,
                            ],
                            [
                                'key'             => 'field_office_email',
                                'label'           => 'Email Address',
                                'name'            => 'email',
                                'type'            => 'email',
                                'show_in_graphql' => true,
                            ],
                        ],
                    ],
                ],
                'location' => [
                    [
                        [
                            'param'    => 'options_page',
                            'operator' => '==',
                            'value'    => 'footer-settings',
                        ],
                    ],
                ],
            ]);
        }
    }
}