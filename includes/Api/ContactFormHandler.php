<?php
namespace AnotherStep\Api;

use WP_REST_Request;
use WP_REST_Response;

class ContactFormHandler
{
    public function init(): void {
        add_action( 'rest_api_init', [$this, 'register_routes'] );
    }

    public function register_routes(): void 
    {
        register_rest_route( 'anotherstep/v1', '/contact-form', [
            'methods'  => 'POST',
            'callback' => [$this, 'handle_contact_form_submission'],
            'permission_callback' => '__return_true',
        ]);
    }

    public function handle_contact_form_submission( WP_REST_Request $request ): WP_REST_Response 
    {
        $name = sanitize_text_field( $request->get_param( 'full_name' ) );
        $email = sanitize_email( $request->get_param( 'email' ) );
        $category = sanitize_text_field( $request->get_param( 'subject' ) );
        $message = sanitize_textarea_field( $request->get_param( 'message' ) );

        if ( empty( $name ) || empty( $email ) || !is_email( $email ) || empty( $category ) || empty( $message ) ) {
            return new WP_REST_Response( [
                'success' => false,
                'message' => 'Please fill in all required fields and provide a valid email address.'
            ], 400 );
        }

        // Recipient mapping per category selection
        $recipients = [
            'General Inquiry' => 'gmohan@anotherstep.org',
            'Technical Support' => 'helpdesk@anotherstep.org',
            'Service Information' => 'gmohan@anotherstep.org',
            'Billing Question' => 'gmohan@anotherstep.org'
        ];

        $to_email = $recipients[ $category ] ?? get_option( 'admin_email' );

        $subject = 'New Contact Request from website, and the category is: ' . ( $category ?? 'General' );
        $headers = [
            'Content-Type: text/html; charset=UTF-8',
            'From: Another Step Website <no-reply@anotherstep.org>',
            "Reply-To: {$name} <{$email}>"
        ];

        $body = '<h2>New Contact Form Submission</h2>';
        $body .= '<p><strong>Name:</strong> ' . esc_html( $name ) . '</p>';
        $body .= '<p><strong>Email:</strong> ' . esc_html( $email ) . '</p>';
        $body .= '<p><strong>Category:</strong> ' . esc_html( $category ) . '</p>';
        $body .= '<p><strong>Message:</strong><br>' . nl2br( esc_html( $message ) ) . '</p>';

        $sent = wp_mail( $to_email, $subject, $body, $headers );

        if ( $sent ) {
            return new WP_REST_Response( [
                'success' => true,
                'message' => 'Thank you! Your message has been sent successfully.'
            ], 200 );
        }

        return new WP_REST_Response( [
            'success' => false,
            'message' => 'Server error: Unable to send email.'
        ], 500 );
    }
}