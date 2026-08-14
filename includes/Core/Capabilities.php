<?php
namespace AnotherStep\Core;

class Capabilities
{
    /**
     * Automatically grant capabilities to leadership roles on activation.
     */
    public static function add_approval_capabilities(): void {
        $dev_caps = [
            'edit_dev_task', 'read_dev_task', 'delete_dev_task',
            'edit_dev_tasks', 'edit_others_dev_tasks', 'publish_dev_tasks',
            'read_private_dev_tasks', 'delete_dev_tasks'
        ];

        // 1. Grant limited capabilities to systems_developer (No publish capability!)
        $sys_dev = get_role('systems_developer');
        if ($sys_dev) {
            foreach ($dev_caps as $cap) {
                // Remove publish permission so button changes to "Submit for Review"
                if ($cap !== 'publish_dev_tasks') {
                    $sys_dev->add_cap($cap);
                } else {
                    $sys_dev->remove_cap('publish_dev_tasks');
                }
            }
        }

        $approvers = [
            'dev_approver_1' => 'Dev Approver (Level 1 - Lead Review)',
            'dev_approver_2' => 'Dev Approver (Level 2 - QA & Functional)',
            'dev_approver_3' => 'Dev Approver (Level 3 - Security & Compliance)',
            'dev_approver_4' => 'Dev Approver (Level 4 - Final Sign-off)',
        ];
        $roles = [ 'operations_manager', 'administration_management', 'executive_director' ];

        foreach ( $approvers as $role_key => $name ) {
            if ( ! get_role( $role_key ) ) {
                $role_caps = array_fill_keys( $dev_caps, true );
                $role_caps['read'] = true;
                $role_caps['approve_dev_tasks'] = true;
                add_role( $role_key, $name, $role_caps );
            }
        }

        foreach ( $roles as $role_name ) {
            $role = get_role( $role_name );
            if ($role && ! $role->has_cap( 'approve_content_merge' )) {
                $role->add_cap( 'approve_content_merge' );
            }
        }
    }
}