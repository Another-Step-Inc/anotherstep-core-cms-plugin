<?php
/**
 * PHP file to render individual Grid Cards
 */
// 1. Check if the block is receiving data from attributes (Dynamic Mode)
$title   = isset($attributes['title']) ? $attributes['title'] : '';
$content = isset($attributes['content']) ? $attributes['content'] : '';
$icon    = isset($attributes['icon']) ? $attributes['icon'] : '';
$theme   = isset($attributes['theme']) ? $attributes['theme'] : '';

// 2. Fallback to global post values if attributes are empty (Manual Mode or Direct Render)
if (empty($title) && empty($content)) {
    $title   = get_the_title();
    $content = has_excerpt() ? get_the_excerpt() : wp_strip_all_tags(get_the_content());
}
?>

<div class="custom-grid-card p-8 rounded-[2rem] border border-slate-100 bg-white hover:shadow-md transition-all">
    <?php if ($icon) : ?>
        <div class="w-14 h-14 bg-blue-50 text-blue-900 rounded-2xl flex items-center justify-center mb-6">
            <span class="material-symbols-outlined text-3xl"><?php echo esc_html($icon); ?></span>
        </div>
    <?php endif; ?>

    <?php if ($title) : ?>
        <h3 class="text-xl font-bold text-slate-900 mb-4"><?php echo esc_html($title); ?></h3>
    <?php endif; ?>

    <?php if ($content) : ?>
        <p class="text-slate-600 leading-relaxed"><?php echo esc_html($content); ?></p>
    <?php endif; ?>
</div>