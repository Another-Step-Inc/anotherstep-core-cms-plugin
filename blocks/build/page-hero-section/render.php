<?php
/**
 * @var array    $attributes The block attributes.
 */

// Core Strings & Media
$display_title     = $attributes['heroTitle'] ?? '';
$display_desc      = $attributes['heroDescription'] ?? '';
$display_image_url = $attributes['heroImageUrl'] ?? '';
$display_btn1_text = $attributes['btn1Text'] ?? '';
$display_btn1_url  = $attributes['btn1Url'] ?? '';
$display_btn2_text = $attributes['btn2Text'] ?? '';
$display_btn2_url  = $attributes['btn2Url'] ?? '';

// Structural Toggles
$layout_type      = $attributes['layoutType'] ?? 'split';
$is_image_large   = $attributes['isImageLarge'] ?? false;
$image_decoration = $attributes['imageDecoration'] ?? 'none';

// Accent Badge Configuration
$has_badge   = $attributes['hasBadge'] ?? false;
$badge_text  = $attributes['badgeText'] ?? '';
$badge_style = $attributes['badgeStyle'] ?? 'pill-yellow';

// Verification Badge (Extra Text Div) Configuration
$has_extra_text_div = $attributes['hasExtraTextDiv'] ?? false;
$extra_div_text     = $attributes['extraDivText'] ?? '';
$extra_div_icon     = !empty($attributes['extraDivIcon']) ? $attributes['extraDivIcon'] : 'domain_disabled';
$extra_div_icon_clr = !empty($attributes['extraDivIconColor']) ? $attributes['extraDivIconColor'] : 'text-brand-red';
$extra_div_bg_clr   = !empty($attributes['extraDivBgColor']) ? $attributes['extraDivBgColor'] : 'bg-surface-container-low';

// Floating Decorations Context
$stats_number     = $attributes['statsNumber'] ?? '';
$stats_text       = $attributes['statsText'] ?? '';
$stats_bg_color   = $attributes['statsBgColor'] ?? 'white';
$stats_text_color = $attributes['statsTextColor'] ?? 'on-surface';
$is_stats_rotated = $attributes['isStatsRotated'] ?? true;
$quote_text       = $attributes['quoteText'] ?? '';

// Process Accent Badge Classes
$badge_classes = 'inline-block px-3 py-1 mb-6 text-xs font-semibold tracking-wider uppercase rounded-full ';
if ($badge_style === 'pill-yellow') {
    $badge_classes .= 'bg-yellow-400 text-blue-900';
} elseif ($badge_style === 'text-blue') {
    $badge_classes .= 'text-blue-400 font-bold p-0 mb-4 tracking-normal normal-case';
} else { // pill-blue
    $badge_classes .= 'bg-blue-600 text-white';
}

// Process Stats Overlay Styles
$stats_bg_map = [
    'white'                  => 'bg-white',
    'brand-red'              => 'bg-red-600',
    'brand-blue'             => 'bg-blue-600',
    'surface-container-high' => 'bg-gray-800'
];
$stats_text_map = [
    'on-surface' => 'text-gray-900',
    'white'      => 'text-white',
    'brand-red'  => 'text-red-500'
];
$stats_container_bg   = $stats_bg_map[$stats_bg_color] ?? 'bg-white';
$stats_container_text = $stats_text_map[$stats_text_color] ?? 'text-gray-900';
$stats_rotation_class = $is_stats_rotated ? 'rotate-3 hover:rotate-0 transition-transform' : '';

// Assign Image Decoration Masks
$image_classes = 'w-full h-full object-cover ';
if ($image_decoration === 'organic-blur') {
    $image_classes .= 'rounded-[2rem_4rem_2rem_4rem]';
} else {
    $image_classes .= 'rounded-2xl';
}

// Layout Sizing Architecture Calculations
$text_col_width  = 'w-full md:w-1/2';
$image_col_width = 'w-full md:w-1/2';

if ($layout_type === 'split' && $is_image_large) {
    $text_col_width  = 'w-full md:w-2/5';
    $image_col_width = 'w-full md:w-3/5';
}
?>

<?php if ($layout_type === 'background') : ?>
    <div class="relative w-full min-h-[600px] flex items-center justify-start p-8 md:p-24 overflow-hidden rounded-3xl not-prose bg-gray-900">
        <?php if ($display_image_url) : ?>
            <img 
                src="<?php echo esc_url($display_image_url); ?>" 
                alt="<?php echo esc_attr($display_title); ?>" 
                class="absolute inset-0 w-full h-full object-cover opacity-40 <?php echo $image_decoration === 'gradient-overlay' ? 'mix-blend-multiply' : ''; ?>"
            />
        <?php endif; ?>
        
        <?php if ($image_decoration === 'gradient-overlay') : ?>
            <div class="absolute inset-0 bg-gradient-to-r from-blue-950 via-blue-900/80 to-transparent"></div>
        <?php else : ?>
            <div class="absolute inset-0 bg-blue-950/20"></div>
        <?php endif; ?>

        <div class="relative z-10 max-w-2xl text-white">
            <?php if ($has_badge && $badge_text) : ?>
                <span class="<?php echo esc_attr($badge_classes); ?>">
                    <?php echo esc_html($badge_text); ?>
                </span>
            <?php endif; ?>

            <?php if ($display_title) : ?>
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                    <?php echo esc_html($display_title); ?>
                </h1>
            <?php endif; ?>

            <?php if ($display_desc) : ?>
                <p class="text-xl text-blue-50/90 mb-8 leading-relaxed">
                    <?php echo esc_html($display_desc); ?>
                </p>
            <?php endif; ?>

            <div class="flex flex-wrap gap-4 items-center mb-6">
                <?php if ($display_btn1_text) : ?>
                    <a href="<?php echo esc_url($display_btn1_url); ?>" class="bg-yellow-400 text-blue-900 px-8 py-3 rounded-xl font-bold hover:bg-yellow-300 transition-all hover:scale-105">
                        <?php echo esc_html($display_btn1_text); ?>
                    </a>
                <?php endif; ?>

                <?php if ($display_btn2_text) : ?>
                    <a href="<?php echo esc_url($display_btn2_url); ?>" class="bg-white/10 backdrop-blur-sm border border-white/20 px-8 py-3 rounded-xl font-bold hover:bg-white/20 transition-all">
                        <?php echo esc_html($display_btn2_text); ?>
                    </a>
                <?php endif; ?>
            </div>

            <?php if ($has_extra_text_div && $extra_div_text) : ?>
                <div class="flex items-center gap-4 p-4 rounded-xl max-w-lg mt-6 <?php echo esc_attr($extra_div_bg_clr); ?>"> 
                    <span class="material-symbols-outlined text-3xl <?php echo esc_attr($extra_div_icon_clr); ?>">
                        <?php echo esc_html($extra_div_icon); ?>
                    </span> 
                    <p class="text-body-lg font-medium text-on-surface">
                        <?php echo esc_html($extra_div_text); ?>
                    </p> 
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php else : ?>
    <div class="flex flex-col md:flex-row items-center gap-8 md:gap-12 w-full min-h-[500px] not-prose">
        
        <div class="<?php echo esc_attr($text_col_width); ?> text-white flex flex-col justify-center">
            <?php if ($has_badge && $badge_text) : ?>
                <div>
                    <span class="<?php echo esc_attr($badge_classes); ?>">
                        <?php echo esc_html($badge_text); ?>
                    </span>
                </div>
            <?php endif; ?>

            <?php if ($display_title) : ?>
                <h1 class="text-3xl md:text-5xl font-extrabold leading-tight mb-6 text-blue-950">
                    <?php echo esc_html($display_title); ?>
                </h1>
            <?php endif; ?>

            <?php if ($display_desc) : ?>
                <p class="text-lg text-gray-700 mb-8 leading-relaxed">
                    <?php echo esc_html($display_desc); ?>
                </p>
            <?php endif; ?>

            <div class="flex flex-wrap gap-4 items-center mb-6">
                <?php if ($display_btn1_text) : ?>
                    <a href="<?php echo esc_url($display_btn1_url); ?>" class="bg-yellow-400 text-blue-900 px-8 py-3 rounded-xl font-bold hover:bg-yellow-300 transition-all hover:scale-105 shadow-md">
                        <?php echo esc_html($display_btn1_text); ?>
                    </a>
                <?php endif; ?>

                <?php if ($display_btn2_text) : ?>
                    <a href="<?php echo esc_url($display_btn2_url); ?>" class="bg-blue-50 text-blue-900 border border-blue-200 px-8 py-3 rounded-xl font-bold hover:bg-blue-100 transition-all">
                        <?php echo esc_html($display_btn2_text); ?>
                    </a>
                <?php endif; ?>
            </div>

            <?php if ($has_extra_text_div && $extra_div_text) : ?>
                <div class="flex items-center gap-4 p-4 rounded-xl max-w-lg mt-2 <?php echo esc_attr($extra_div_bg_clr); ?>"> 
                    <span class="material-symbols-outlined text-3xl <?php echo esc_attr($extra_div_icon_clr); ?>">
                        <?php echo esc_html($extra_div_icon); ?>
                    </span> 
                    <p class="text-body-lg font-medium text-on-surface">
                        <?php echo esc_html($extra_div_text); ?>
                    </p> 
                </div>
            <?php endif; ?>
        </div>

        <div class="<?php echo esc_attr($image_col_width); ?> relative">
            <div class="relative w-full h-72 md:h-[550px] overflow-visible group">
                
                <?php if ($image_decoration === 'yellow-box') : ?>
                    <div class="absolute -inset-3 bg-yellow-400 rounded-2xl transform translate-x-2 translate-y-2 z-0"></div>
                <?php endif; ?>

                <?php if ($image_decoration === 'organic-blur') : ?>
                    <div class="absolute inset-4 bg-blue-500/30 blur-3xl rounded-full transform scale-110 -z-10"></div>
                <?php endif; ?>

                <div class="relative w-full h-full rounded-2xl overflow-hidden shadow-xl z-10">
                    <?php if ($display_image_url) : ?>
                        <img
                            src="<?php echo esc_url($display_image_url); ?>"
                            alt="<?php echo esc_attr($display_title); ?>"
                            class="<?php echo esc_attr($image_classes); ?>"
                        />
                    <?php endif; ?>
                    <div class="absolute inset-0 bg-blue-900/5 mix-blend-multiply"></div>
                </div>

                <?php if ($image_decoration === 'bubble-text' && $stats_number) : ?>
                    <div class="absolute bottom-6 left-6 z-20 p-5 rounded-2xl shadow-xl max-w-[240px] <?php echo esc_attr($stats_container_bg . ' ' . $stats_container_text . ' ' . $stats_rotation_class); ?>">
                        <div class="text-2xl font-black tracking-tight mb-1"><?php echo esc_html($stats_number); ?></div>
                        <?php if ($stats_text) : ?>
                            <div class="text-xs font-semibold leading-snug opacity-90"><?php echo esc_html($stats_text); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ($image_decoration === 'quote-bubble' && $quote_text) : ?>
                    <div class="absolute bottom-6 right-6 left-6 md:left-auto md:max-w-sm z-20 p-5 bg-white text-gray-800 rounded-2xl shadow-2xl border border-gray-100">
                        <p class="text-sm italic font-medium leading-relaxed mb-1"><?php echo esc_html($quote_text); ?></p>
                    </div>
                <?php endif; ?>

                <?php if ($image_decoration === 'hover-frame') : ?>
                    <div class="absolute -inset-4 bg-yellow-500/10 rounded-[2rem] -rotate-2 group-hover:rotate-0 transition-transform duration-500"></div>
                <?php endif; ?>
            </div>
        </div>

    </div>
<?php endif; ?>