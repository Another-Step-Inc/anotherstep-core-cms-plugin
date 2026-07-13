<?php
/**
 * Dynamic front-end presentation context wrapper for the custom grid framework.
 */
$bg_style       = esc_attr($attributes['bgStyle'] ?? 'bg-surface-container-low');
$text_align     = esc_attr($attributes['textAlignment'] ?? 'text-center mx-auto');
$headline       = $attributes['headline'] ?? '';
$description    = $attributes['description'] ?? '';
?>

<section class="<?php echo $bg_style; ?> py-24 px-8">
    <div class="max-w-7xl mx-auto">
        <?php if (!empty($headline) || !empty($description)) : ?>
            <div class="mb-16 max-w-2xl <?php echo $text_align; ?>">
                <?php if (!empty($headline)) : ?>
                    <h2 class="text-headline-lg font-display font-bold text-on-surface mb-4">
                        <?php echo esc_html($headline); ?>
                    </h2>
                <?php endif; ?>
                <?php if (!empty($description)) : ?>
                    <p class="text-on-surface-variant">
                        <?php echo esc_html($description); ?>
                    </p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php echo $content; ?>
        </div>
    </div>
</section>
