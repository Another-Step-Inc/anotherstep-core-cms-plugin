<?php
/**
 * Plugin Name: Another Step Core CMS
 * Description: The core infrastructure for a headless Astro integration. This plugin registers essential Custom Post Types (Services, Promos), extends the WP-REST API with custom artist metadata, and implements a high-level content approval system for leadership roles. It also enforces a streamlined, role-based dashboard UI and handles automated Gutenberg block registration.
 * Version: 1.0
 * Author: IT Department
 */

if ( ! defined('ABSPATH') ) exit;

define( 'AS_CORE_PATH', plugin_dir_path( __FILE__) );
define( 'AS_CORE_URL', plugin_dir_path( __FILE__) );

// Load Autoloader
require_once AS_CORE_PATH . 'includes/Autoloader.php';

use AnotherStep\Autoloader;

// Core
use AnotherStep\Core\Capabilities;
use AnotherStep\Core\AdminUI;

// Shop Integration Subsystem
use AnotherStep\Shop\ShopCapabilities;
use AnotherStep\Shop\ShopAdminUI;

// PostTypes
use AnotherStep\PostTypes\ServicePostType;
use AnotherStep\PostTypes\ValuesPostType;

// MetaBoxes
use AnotherStep\MetaBoxes\ServiceMetaBox;
use AnotherStep\MetaBoxes\ValuesMetaBox;

// API
use AnotherStep\Api\RestRegistrations;
use AnotherStep\Api\GraphQLRegistrations;

// Track 1: Content Staging Subsystem
use AnotherStep\Staging\StagingInterceptor;
use AnotherStep\Staging\StagingMetaBox;
use AnotherStep\Staging\StagingWidget;
use AnotherStep\Staging\MergeHandler;

// Track 2: Dev Sequential Pipeline Subsystem
use AnotherStep\DevWorkflow\DevTaskPostType;
use AnotherStep\DevWorkflow\DevTaskMetaBox;
use AnotherStep\DevWorkflow\SequentialGateMetaBox;
use AnotherStep\DevWorkflow\PipelineHandler;
use AnotherStep\DevWorkflow\DevTaskWidget;

// Blocks
use AnotherStep\Blocks\BlockRegistrar;

// Integrations
use AnotherStep\Integrations\FooterSettings;

Autoloader::register();

// Register Activation Hooks
register_activation_hook(__FILE__, function() {
    Capabilities::add_approval_capabilities();
    ShopCapabilities::register_shop_roles();
});

// Initialize Subsystems
add_action( 'plugins_loaded', function() {
    Capabilities::add_approval_capabilities();

    // 1. Post Types & Custom Fields
    ( new ServicePostType() )->init();
    ( new ValuesPostType() )->init();
    ( new DevTaskPostType() )->init(); // CPT: dev_task

    ( new ServiceMetaBox() )->init();
    ( new ValuesMetaBox() )->init();
    ( new DevTaskMetaBox() )->init(); // Scope, PR, Preview URL, Rollback fields

    // 2. API Extensions 
    ( new RestRegistrations() )->init();
    ( new GraphQLRegistrations() )->init();

    // 3. Track 1: Content Staging Engine
    ( new StagingInterceptor() )->init();
    ( new StagingMetaBox() )->init();
    ( new StagingWidget() )->init();
    ( new MergeHandler() )->init();

    // 4. Track 2: Dev Pipeline Engine
    ( new SequentialGateMetaBox() )->init(); // 4-Stage Approval Sidebar
    ( new PipelineHandler() )->init(); // Handles gating logic & deployment webhooks
    ( new DevTaskWidget() )->init(); //Pipeline status dashboard widget

    // 5. System UI & Block Integrations
    ( new BlockRegistrar() )->init();
    ( new AdminUI() )->init();
    ( new FooterSettings() )->init();

    // 6. Shop & E-commerce Subsystem
    ( new ShopAdminUI() )->init();
});
