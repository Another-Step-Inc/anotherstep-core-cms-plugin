<?php
/**
 * Dynamic Render Template for CTA Section Block
 * @var array $attributes
 */

$title       = $attributes['ctaTitle'] ?? '';
$desc        = $attributes['ctaDescription'] ?? '';
$style       = $attributes['ctaStyle'] ?? 'full-width';

$btn1_text   = $attributes['btn1Text'] ?? '';
$btn1_url    = $attributes['btn1Url'] ?? '#';
$btn1_style  = $attributes['btn1Style'] ?? 'yellow';

$btn2_text   = $attributes['btn2Text'] ?? '';
$btn2_url    = $attributes['btn2Url'] ?? '#';

$has_steps   = $attributes['hasSteps'] ?? false;
$step1_text  = $attributes['step1Text'] ?? '';
$step2_text  = $attributes['step2Text'] ?? '';
$step3_text  = $attributes['step3Text'] ?? '';

$has_stats   = $attributes['hasStats'] ?? false;
$stat1_num   = $attributes['stat1Number'] ?? '500+';
$stat1_lbl   = $attributes['stat1Label'] ?? 'Monthly Outings';
$stat2_num   = $attributes['stat2Number'] ?? '95%';
$stat2_lbl   = $attributes['stat2Label'] ?? 'Goal Completion';

// Primary Button Classes
$btn1_classes = 'rounded-full px-8 py-4 font-black text-lg active:scale-95 transition-all ';
if ($btn1_style === 'red') {
    $btn1_classes .= 'bg-brand-red text-on-brand-red hover:shadow-lg';
} elseif ($btn1_style === 'white') {
    $btn1_classes .= 'bg-white text-brand-blue hover:bg-surface-container-high';
} else {
    $btn1_classes .= 'bg-brand-yellow text-on-tertiary-fixed shadow-md hover:scale-105';
}
?>

<?php if ($style === 'split-steps') : ?>
    <!-- Two-Column Step Process Layout (Services Style) -->
    <section class="max-w-7xl mx-auto px-8 py-20 not-prose">
        <div class="bg-brand-blue rounded-[3rem] p-12 md:p-16 text-white grid md:grid-cols-2 gap-12 items-center relative overflow-hidden">
            <div class="space-y-6">
                <?php if ($title) : ?>
                    <h2 class="text-4xl md:text-5xl font-black leading-tight">
                        <?php echo esc_html($title); ?>
                    </h2>
                <?php endif; ?>

                <?php if ($desc) : ?>
                    <p class="text-lg opacity-90 leading-relaxed">
                        <?php echo esc_html($desc); ?>
                    </p>
                <?php endif; ?>

                <div class="pt-4 flex flex-wrap gap-4">
                    <?php if ($btn1_text) : ?>
                        <a href="<?php echo esc_url($btn1_url); ?>" class="<?php echo esc_attr($btn1_classes); ?>">
                            <?php echo esc_html($btn1_text); ?>
                        </a>
                    <?php endif; ?>

                    <?php if ($btn2_text) : ?>
                        <a href="<?php echo esc_url($btn2_url); ?>" class="bg-white/10 border border-white/20 text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white/20 transition-all">
                            <?php echo esc_html($btn2_text); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="space-y-4">
                <?php if ($step1_text) : ?>
                    <div class="flex items-center gap-4 bg-white/10 backdrop-blur p-5 rounded-2xl border border-white/10">
                        <span class="w-10 h-10 rounded-full bg-brand-yellow text-on-tertiary-fixed font-black flex items-center justify-center text-lg shrink-0">1</span>
                        <span class="font-bold text-lg"><?php echo esc_html($step1_text); ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($step2_text) : ?>
                    <div class="flex items-center gap-4 bg-white/10 backdrop-blur p-5 rounded-2xl border border-white/10">
                        <span class="w-10 h-10 rounded-full bg-brand-yellow text-on-tertiary-fixed font-black flex items-center justify-center text-lg shrink-0">2</span>
                        <span class="font-bold text-lg"><?php echo esc_html($step2_text); ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($step3_text) : ?>
                    <div class="flex items-center gap-4 bg-white/10 backdrop-blur p-5 rounded-2xl border border-white/10">
                        <span class="w-10 h-10 rounded-full bg-brand-yellow text-on-tertiary-fixed font-black flex items-center justify-center text-lg shrink-0">3</span>
                        <span class="font-bold text-lg"><?php echo esc_html($step3_text); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php elseif ($style === 'full-width' || $style === 'banner') : ?>
    <!-- Full Width Full-Bleed Section (Contact & Gallery Style) -->
    <section class="bg-brand-blue text-on-brand-blue py-24 relative overflow-hidden w-screen relative left-1/2 -translate-x-1/2 not-prose">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-blue-container rounded-full opacity-20 pointer-events-none"></div>
        <div class="max-w-[1440px] mx-auto px-8 md:px-12 relative z-10 grid <?php echo $has_stats ? 'md:grid-cols-2 gap-16 items-center' : 'text-center max-w-4xl'; ?>">
            <div class="<?php echo !$has_stats ? 'mx-auto space-y-6' : ''; ?>">
                <?php if ($title) : ?>
                    <h2 class="text-4xl md:text-6xl font-black mb-6 leading-tight">
                        <?php echo esc_html($title); ?>
                    </h2>
                <?php endif; ?>

                <?php if ($desc) : ?>
                    <p class="text-xl opacity-90 leading-relaxed mb-8">
                        <?php echo esc_html($desc); ?>
                    </p>
                <?php endif; ?>

                <div class="flex flex-wrap gap-4 <?php echo !$has_stats ? 'justify-center' : ''; ?>">
                    <?php if ($btn1_text) : ?>
                        <a href="<?php echo esc_url($btn1_url); ?>" class="<?php echo esc_attr($btn1_classes); ?>">
                            <?php echo esc_html($btn1_text); ?>
                        </a>
                    <?php endif; ?>

                    <?php if ($btn2_text) : ?>
                        <a href="<?php echo esc_url($btn2_url); ?>" class="bg-white/10 backdrop-blur-md border border-white/20 text-white rounded-full px-8 py-4 font-bold text-lg hover:bg-white/20 transition-colors">
                            <?php echo esc_html($btn2_text); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($has_stats) : ?>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-surface-container-lowest/10 backdrop-blur p-8 rounded-2xl border border-white/10 text-center">
                        <div class="text-5xl font-black text-brand-yellow mb-2">
                            <?php echo esc_html($stat1_num); ?>
                        </div>
                        <div class="text-sm uppercase tracking-widest font-bold opacity-90">
                            <?php echo esc_html($stat1_lbl); ?>
                        </div>
                    </div>
                    <div class="bg-surface-container-lowest/10 backdrop-blur p-8 rounded-2xl border border-white/10 text-center translate-y-8">
                        <div class="text-5xl font-black text-brand-red-fixed mb-2">
                            <?php echo esc_html($stat2_num); ?>
                        </div>
                        <div class="text-sm uppercase tracking-widest font-bold opacity-90">
                            <?php echo esc_html($stat2_lbl); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php else : ?>
    <!-- Centered Rounded Box CTA Style -->
    <section class="max-w-7xl mx-auto px-8 py-20 not-prose">
        <div class="bg-brand-blue rounded-[3rem] p-12 md:p-20 text-center relative overflow-hidden">
            <div class="relative z-10 space-y-8">
                <?php if ($title) : ?>
                    <h2 class="text-4xl md:text-6xl font-black text-white leading-tight">
                        <?php echo esc_html($title); ?>
                    </h2>
                <?php endif; ?>

                <?php if ($desc) : ?>
                    <p class="text-xl md:text-2xl text-on-blue-container max-w-2xl mx-auto opacity-90">
                        <?php echo esc_html($desc); ?>
                    </p>
                <?php endif; ?>

                <div class="flex flex-col sm:flex-row gap-6 justify-center pt-6">
                    <?php if ($btn1_text) : ?>
                        <a href="<?php echo esc_url($btn1_url); ?>" class="<?php echo esc_attr($btn1_classes); ?>">
                            <?php echo esc_html($btn1_text); ?>
                        </a>
                    <?php endif; ?>

                    <?php if ($btn2_text) : ?>
                        <a href="<?php echo esc_url($btn2_url); ?>" class="bg-white text-brand-blue px-10 py-5 rounded-full font-black text-xl shadow-sm hover:bg-surface-container-high transition-all">
                            <?php echo esc_html($btn2_text); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>