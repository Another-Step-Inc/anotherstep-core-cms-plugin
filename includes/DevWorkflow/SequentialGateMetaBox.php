<?php
namespace AnotherStep\DevWorkflow;

class SequentialGateMetaBox
{
    public function init(): void 
    {
        add_action( 'add_meta_boxes', [ $this, 'add_meta_box' ] );
    }

    public function add_meta_box(): void 
    {
        add_meta_box(
            'sequential_gate_meta_box',
            __( 'Sequential Gate Details' ),
            [ $this, 'render' ],
            'dev_task',
            'normal',
            'default'
        );
    }

    public function render($post): void 
    {
        wp_nonce_field('process_approval_gate', 'dev_approval_gate_nonce');
        $current_stage = (int) get_post_meta($post->ID, '_dev_approval_status', true) ?: 0;
        $audit_log     = get_post_meta($post->ID, '_dev_approval_audit_log', true) ?: [];
        $user_roles    = (array) wp_get_current_user()->roles;

        $stages = [
            1 => 'Level 1: Lead Code Review',
            2 => 'Level 2: QA & Responsive Test',
            3 => 'Level 3: Security & API Audit',
            4 => 'Level 4: Release Sign-off',
        ];

        echo '<p><strong>Status:</strong> ' . ($current_stage === 4 ? '<span style="color:green;font-weight:bold;">APPROVED & DEPLOYED</span>' : '<span style="color:red;">Pending Stage ' . ($current_stage + 1) . '</span>') . '</p><hr />';
        
        foreach ($stages as $level => $label) {
            $done = ($current_stage >= $level);
            echo '<p style="color:' . ($done ? 'green' : '#888') . ';">' . ($done ? '✔' : '◯') . ' ' . esc_html($label) . '</p>';
        }
        echo '<hr />';

        $next_stage = $current_stage + 1;
        $req_role   = "dev_approver_" . $next_stage;
        if ($current_stage < 4) {
            if (in_array($req_role, $user_roles) || in_array('administrator', $user_roles)) {
                echo '<p style="background:#e7f4e4;padding:8px;border-left:4px solid #28a745;">';
                echo '<label><input type="checkbox" name="advance_to_next_stage" value="1" /> <strong>Sign off Stage ' . $next_stage . '</strong></label></p>';
            } else {
                echo '<p style="font-size:11px;color:#666;">Requires role: <code>' . esc_html($req_role) . '</code></p>';
            }
        }
    }
}