<?php
/**
 * Render PHP for customizable grid wrapper
 */

$headline       = isset($attributes['headline']) ? $attributes['headline'] : '';
$description    = isset($attributes['description']) ? $attributes['description'] : '';
$bg_style       = isset($attributes['bgStyle']) ? $attributes['bgStyle'] : 'bg-surface-container-low';
$text_alignment = isset($attributes['textAlignment']) ? $attributes['textAlignment'] : 'text-center';
$style_variant  = isset($attributes['styleVariant']) ? $attributes['styleVariant'] : 'standard';
$use_query      = isset($attributes['useQuery']) ? $attributes['useQuery'] : false;
$post_type      = isset($attributes['postType']) ? $attributes['postType'] : 'services';
$posts_per_page = isset($attributes['postsPerPage']) ? $attributes['postsPerPage'] : 3;
?>

<section class="custom-grid-section <?php echo esc_attr($bg_style); ?> py-16 px-4 md:px-8">
    <div class="max-w-7xl mx-auto">
        
        <!-- Section Header Conditional Rendering -->
        <?php if ($headline || $description) : ?>
            
            <?php if ($style_variant === 'homepage') : ?>
                <!-- Homepage Specialized Style Variant -->
                <div class="text-center mb-12"> 
                    <?php if ($headline) : ?>
                        <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4"><?php echo esc_html($headline); ?></h2> 
                    <?php endif; ?>
                    <div class="w-24 h-1 bg-yellow-400 mx-auto rounded-full"></div> 
                    <?php if ($description) : ?>
                        <p class="mt-6 text-lg text-slate-600 max-w-3xl mx-auto italic">
                            "<?php echo esc_html($description); ?>"
                        </p> 
                    <?php endif; ?>
                </div>
            <?php else : ?>
                <!-- Standard Subpage Header Style -->
                <div class="mb-12 text-center">
                    <?php if ($headline) : ?>
                        <h2 class="text-3xl md:text-4xl font-bold mb-4"><?php echo esc_html($headline); ?></h2>
                    <?php endif; ?>
                    <?php if ($description) : ?>
                        <p class="text-lg opacity-80 max-w-2xl mx-auto"><?php echo esc_html($description); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        <?php endif; ?>

        <!-- Grid Cards Loop Container -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- WP_Query loop logic or manual $content output goes here -->
        </div>

    </div>
</section>