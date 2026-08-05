<?php
/**
 * PHP Render Template for Split Content Section Block
 * @var array $attributes
 * @var string $content
 */

$title            = $attributes['title'] ?? '';
$bg_color         = $attributes['backgroundColor'] ?? 'bg-brand-bg';

$card1_icon       = $attributes['card1Icon'] ?? '';
$card1_icon_color = $attributes['card1IconColor'] ?? 'text-brand-blue';
$card1_title      = $attributes['card1Title'] ?? '';
$card1_text       = $attributes['card1Text'] ?? '';

$card2_icon       = $attributes['card2Icon'] ?? '';
$card2_icon_color = $attributes['card2IconColor'] ?? 'text-brand-red';
$card2_title      = $attributes['card2Title'] ?? '';
$card2_text       = $attributes['card2Text'] ?? '';
?>

<section class="<?php echo esc_attr($bg_color); ?> py-24">
    <div class="max-w-7xl mx-auto px-8">
        <div class="flex flex-col md:flex-row gap-12 items-start">
            <div class="md:w-1/3">
                <?php if ($title) : ?>
                    <h2 class="text-3xl md:text-4xl font-black text-brand-blue uppercase tracking-widest mb-4 sticky top-32">
                        <?php echo esc_html($title); ?>
                    </h2>
                    <div class="h-2 w-24 bg-brand-dark-yellow rounded-full"></div>
                <?php endif; ?>
            </div>
            
            <div class="md:w-2/3 space-y-12">
                <div class="space-y-8">
                    <?php echo $content; ?>
                </div>

                <?php if ($card1_title || $card2_title) : ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php if ($card1_title) : ?>
                            <div class="bg-white p-8 rounded-2xl flex flex-col gap-4 shadow-sm">
                                <?php if ($card1_icon) : ?>
                                    <span class="material-symbols-outlined <?php echo esc_attr($card1_icon_color); ?> text-4xl" data-icon="<?php echo esc_attr($card1_icon); ?>">
                                        <?php echo esc_html($card1_icon); ?>
                                    </span>
                                <?php endif; ?>
                                <h3 class="text-xl font-bold text-brand-blue"><?php echo esc_html($card1_title); ?></h3>
                                <?php if ($card1_text) : ?>
                                    <p class="text-on-surface-variant"><?php echo esc_html($card1_text); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($card2_title) : ?>
                            <div class="bg-white p-8 rounded-2xl flex flex-col gap-4 shadow-sm">
                                <?php if ($card2_icon) : ?>
                                    <span class="material-symbols-outlined <?php echo esc_attr($card2_icon_color); ?> text-4xl" data-icon="<?php echo esc_attr($card2_icon); ?>">
                                        <?php echo esc_html($card2_icon); ?>
                                    </span>
                                <?php endif; ?>
                                <h3 class="text-xl font-bold text-brand-blue"><?php echo esc_html($card2_title); ?></h3>
                                <?php if ($card2_text) : ?>
                                    <p class="text-on-surface-variant"><?php echo esc_html($card2_text); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>