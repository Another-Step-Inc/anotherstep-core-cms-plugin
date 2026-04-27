<?php
/**
 * @var array    $attributes The block attributes.
 */

$display_title = $attributes['heroTitle'];
$display_desc  = $attributes['heroDescription'];
$display_image_url = $attributes['heroImageUrl'];
$display_btn1_text = $attributes['btn1Text'];
$display_btn1_url = $attributes['btn1Url'];
$display_btn2_text = $attributes['btn2Text'];
$display_btn2_url = $attributes['btn2Url'];
?>

<div class="p-8 md:p-16 md:w-1/2 text-white">
    <span class="inline-block px-3 py-1 mb-4 text-xs font-semibold tracking-wider uppercase bg-yellow-400 text-blue-900 rounded-full">
        Established 1992
    </span>

    <?php if ( $display_title ) : ?>
        <h1 class="text-3xl md:text-5xl font-extrabold leading-tight mb-6">
            <?php echo esc_html( $display_title ); ?>
        </h1>
    <?php endif; ?>

    <?php if ( $display_desc ) : ?>
        <p class="text-lg text-blue-50 mb-8 leading-relaxed">
            <?php echo esc_html( $display_desc ); ?>
        </p>
    <?php endif; ?>

    <div class="flex flex-wrap gap-4">
	<?php if ( $display_btn1_text ) : ?>
        <a href="<?php echo esc_url($display_btn1_url); ?>" class="bg-yellow-400 text-blue-900 px-8 py-3 rounded-xl font-bold hover:bg-yellow-300 transition-all hover:scale-105">
            <?php echo esc_html($display_btn1_text); ?>
        </a>
    <?php endif; ?>

    <?php if ( $display_btn2_text ) : ?>
        <a href="<?php echo esc_url($display_btn2_url); ?>" class="bg-white/10 backdrop-blur-sm border border-white/20 px-8 py-3 rounded-xl font-bold hover:bg-white/20 transition-all">
            <?php echo esc_html($display_btn2_text); ?>
        </a>
    <?php endif; ?>
    </div>
</div>

<div class="md:w-1/2 w-full h-64 md:h-[500px] relative">
	<img 
        src="<?php echo esc_url($display_image_url); ?>" 
        alt="<?php echo esc_attr($display_title); ?>" 
        class="absolute inset-0 w-full h-full rounded-3xl object-cover"
    />
    <div class="absolute inset-0 bg-blue-900/10"></div>
</div>

