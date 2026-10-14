<?php

namespace AnotherStep\Api;

use AnotherStep\Services\SecureMailer;

class IncidentFormHandler
{
    public function init(): void
    {
        add_action('rest_api_init', function () {
            register_rest_route(
                'anotherstep/v1',
                '/incident-form',
                [
                    'methods'             => 'POST',
                    'callback'            => [$this, 'submit'],
                    'permission_callback' => '__return_true',
                ]
            );
        });
    }

    public function submit(\WP_REST_Request $request)
    {
        $data = [
            'reporterName'    => sanitize_text_field($request->get_param('reporterName')),
            'phone'           => sanitize_text_field($request->get_param('phone')),
            'email'           => sanitize_email($request->get_param('email')),
            'dateOfIncident'  => sanitize_text_field($request->get_param('dateOfIncident')),
            'location'        => sanitize_text_field($request->get_param('location')),
            'details'         => wp_kses_post($request->get_param('details')),
            'personsInvolved' => wp_kses_post($request->get_param('personsInvolved')),
        ];

        $html = $this->buildEmail($data);

        $sent = SecureMailer::send(
            ANOTHERSTEP_INCIDENT_SMTP_USER,
            ANOTHERSTEP_INCIDENT_SMTP_PASS,
            'incident@anotherstep.org',
            'New Incident Report',
            $html
        );

        if (!$sent) {
            return new \WP_REST_Response([
                'success' => false,
                'message' => 'Unable to submit report.',
            ], 500);
        }

        return new \WP_REST_Response([
            'success' => true,
            'message' => 'Incident report submitted successfully.',
        ], 200);
    }

    private function buildEmail(array $data): string
    {
        ob_start();
        ?>
        <h2>Incident Report</h2>

        <p><strong>Reporter:</strong> <?= esc_html($data['reporterName'] ?: 'Anonymous'); ?></p>
        <p><strong>Phone:</strong> <?= esc_html($data['phone']); ?></p>
        <p><strong>Email:</strong> <?= esc_html($data['email']); ?></p>

        <p><strong>Date:</strong> <?= esc_html($data['dateOfIncident']); ?></p>
        <p><strong>Location:</strong> <?= esc_html($data['location']); ?></p>

        <hr>

        <p><strong>Incident Details:</strong></p>
        <p><?= nl2br(esc_html($data['details'])); ?></p>

        <p><strong>Persons Involved:</strong></p>
        <p><?= nl2br(esc_html($data['personsInvolved'])); ?></p>
        <?php

        return ob_get_clean();
    }
}