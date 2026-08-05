<?php
/**
 * Dynamic Render Template for Bento Card Block
 * @var array $attributes
 * @var string $content
 */

$col_span      = $attributes['colSpan'] ?? 'md:col-span-1';
$card_bg       = $attributes['cardBgStyle'] ?? 'bg-surface-container-lowest';
$text_color    = $attributes['textColor'] ?? 'text-on-surface';
$icon          = $attributes['icon'] ?? '';
$icon_color    = $attributes['iconColor'] ?? 'text-brand-blue';
$title         = $attributes['title'] ?? '';
$description   = $attributes['description'] ?? '';

$card_classes = sprintf(
    '%s %s %s p-8 md:p-10 rounded-[2rem] flex flex-col justify-between transition-transform hover:scale-[1.01]',
    esc_attr($col_span),
    esc_attr($card_bg),
    esc_attr($text_color)
);
?>

<div class="<?php echo $card_classes; ?>">
    <div>
        <?php if ($icon) : ?>
            <span class="material-symbols-outlined text-4xl md:text-5xl mb-6 <?php echo esc_attr($icon_color); ?>" data-icon="<?php echo esc_attr($icon); ?>">
                <?php echo esc_html($icon); ?>
            </span>
        <?php endif; ?>

        <?php if ($title) : ?>
            <h3 class="text-2xl md:text-3xl font-bold mb-4">
                <?php echo esc_html($title); ?>
            </h3>
        <?php endif; ?>

        <?php if ($description) : ?>
            <p class="text-lg opacity-90 mb-6">
                <?php echo esc_html($description); ?>
            </p>
        <?php endif; ?>
    </div>

    <?php if (!empty($content)) : ?>
        <div class="mt-auto">
            <?php echo $content; ?>
        </div>
    <?php endif; ?>
</div>