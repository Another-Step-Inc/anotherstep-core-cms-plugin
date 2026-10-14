<?php

namespace AnotherStep\Api;

use AnotherStep\Services\SecureMailer;

class ComplianceFormHandler
{
    public function init(): void
    {
        add_action('rest_api_init', function() {
            register_rest_route(
                'anotherstep/v1',
                'compliance-form',
                [
                    'methods' => 'POST',
                    'callback' => [$this, 'submit'],
                    'permission_callback' => '__return_true',
                ]
            );
        });
    }

    public function submit(\WP_REST_request $request)
    {
            $data = [
                'reporterName' => sanitize_text_field($request->get_param('reporterName')),
                'dateOfOccurrence' => sanitize_text_field($request->get_param('dateOfOccurrence')),
                'location' => sanitize_text_field($request->get_param('location')),
                'details' => wp_kses_post($request->get_param('details')),
                'personsInvolved' => wp_kses_post($request->get_param('personsInvolved')),
                'discussedInternal' => sanitize_text_field($request->get_param('discussedInternal')),
                'internalContacts' => sanitize_text_field($request->get_param('internalContacts')),
                'discussedExternal' => sanitize_text_field($request->get_param('discussedExternal')),
                'externalContacts' => sanitize_text_field($request->get_param('externalContacts')),
            ];

            $html = $this->buildEmail($data);

            $sent = SecureMailer::send(
                ANOTHERSTEP_COMPLIANCE_SMTP_USER,
                ANOTHERSTEP_COMPLIANCE_SMTP_PASS,
                'compliance@anotherstep.org',
                'New Compliance Report',
                $html
            );

            if (!$sent) {
                return new \WP_REST_Response([
                    'success' => false,
                    'message' => 'Unable to send report.',
                ], 500);
            }

            return new \WP_REST_Response([
                'success' => true,
                'message' => 'Compliance report submitted successfully.',
            ], 200);
    }

    private function buildEmail(array $data): string
    {
            ob_start();
            ?>
            <h2>Compliance Report</h2>

            <p><strong>Reporter:</strong> <?= esc_html($data['reporterName'] ?: 'Anonymous'); ?></p>
            <p><strong>Date of Occurrence:</strong> <?= esc_html($data['dateOfOccurrence']); ?></p>
            <p><strong>Location:</strong> <?= esc_html($data['location']); ?></p>
            
            <hr>
            
            <p><strong>What Occurred:</strong></p>
            <p><?= nl2br(esc_html($data['details'])); ?></p>
            
            <p><strong>Persons Involved:</strong></p>
            <p><?= nl2br(esc_html($data['personsInvolved'])); ?></p>
            
            <p><strong>Discussed Internally:</strong> <?= esc_html($data['discussedInternal']); ?></p>
            <p><strong>Internal Contacts:</strong> <?= esc_html($data['internalContacts']); ?></p>
            
            <p><strong>Discussed Externally:</strong> <?= esc_html($data['discussedExternal']); ?></p>
            <p><strong>External Contacts:</strong> <?= esc_html($data['externalContacts']); ?></p>
            <?php
            
            return ob_get_clean();
    }
}