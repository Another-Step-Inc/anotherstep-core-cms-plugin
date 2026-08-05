<?php
/**
 * Dynamic Render Template for Bento Grid Section Block
 * @var array $attributes
 * @var string $content
 */

$title           = $attributes['title'] ?? '';
$subtitle        = $attributes['subtitle'] ?? '';
$has_underline   = $attributes['hasUnderline'] ?? false;
$underline_color = $attributes['underlineColor'] ?? 'bg-brand-dark-red';
$bg_color        = $attributes['backgroundColor'] ?? 'bg-transparent';
$columns         = $attributes['columns'] ?? 3;

$grid_cols_class = $columns === 6 ? 'md:grid-cols-6' : 'md:grid-cols-3';
$container_class = $bg_color === 'bg-surface-container-low' ? 'max-w-screen-2xl' : 'max-w-7xl';
?>

<section class="py-24 <?php echo esc_attr($bg_color); ?>">
    <div class="<?php echo esc_attr($container_class); ?> mx-auto px-8">
        <?php if ($title || $subtitle) : ?>
            <div class="mb-16">
                <?php if ($title) : ?>
                    <h2 class="text-4xl font-bold text-on-surface mb-4">
                        <?php echo esc_html($title); ?>
                    </h2>
                <?php endif; ?>

                <?php if ($has_underline) : ?>
                    <div class="h-2 w-32 <?php echo esc_attr($underline_color); ?> rounded-full mb-4"></div>
                <?php endif; ?>

                <?php if ($subtitle) : ?>
                    <p class="text-lg text-on-surface-variant max-w-2xl">
                        <?php echo esc_html($subtitle); ?>
                    </p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 <?php echo esc_attr($grid_cols_class); ?> gap-6">
            <?php echo $content; ?>
        </div>
    </div>
</section>