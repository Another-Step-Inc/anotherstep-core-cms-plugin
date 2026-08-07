<?php
/**
 * Post Render template for Journey Forward Section
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block inner content.
 * @var WP_Block $block      Block instance.
 */

$section_title = ! empty( $attributes['sectionTitle'] ) ? esc_html( $attributes['sectionTitle'] ) : 'The Journey Forward';
$step1_number  = ! empty( $attributes['step1Number'] ) ? esc_html( $attributes['step1Number'] ) : '01';
$step1_label   = ! empty( $attributes['step1Label'] ) ? esc_html( $attributes['step1Label'] ) : 'Identify';
$step2_number  = ! empty( $attributes['step2Number'] ) ? esc_html( $attributes['step2Number'] ) : '02';
$step2_label   = ! empty( $attributes['step2Label'] ) ? esc_html( $attributes['step2Label'] ) : 'Strategize';
$step3_number  = ! empty( $attributes['step3Number'] ) ? esc_html( $attributes['step3Number'] ) : '03';
$step3_label   = ! empty( $attributes['step3Label'] ) ? esc_html( $attributes['step3Label'] ) : 'Succeed';

$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => 'max-w-7xl mx-auto px-8 py-24 border-t-0 text-center' ) );
?>

<section <?php echo $wrapper_attributes; ?>>
  <h2 class="text-4xl md:text-5xl font-black text-brand-blue mb-12">
    <?php echo $section_title; ?>
  </h2>
  <div class="flex flex-col md:flex-row items-center justify-center gap-4">
    
    <!-- Step 01 -->
    <div class="w-full md:w-64 h-32 bg-brand-blue rounded-2xl flex flex-col items-center justify-center text-on-primary p-4 shadow-lg">
      <span class="text-4xl font-black mb-1"><?php echo $step1_number; ?></span>
      <span class="text-sm font-bold uppercase tracking-widest"><?php echo $step1_label; ?></span>
    </div>

    <div class="hidden md:block w-12 h-2 bg-surface-container-highest rounded-full"></div>

    <!-- Step 02 -->
    <div class="w-full md:w-64 h-32 bg-brand-red rounded-2xl flex flex-col items-center justify-center text-on-secondary p-4 shadow-lg">
      <span class="text-4xl font-black mb-1"><?php echo $step2_number; ?></span>
      <span class="text-sm font-bold uppercase tracking-widest"><?php echo $step2_label; ?></span>
    </div>

    <div class="hidden md:block w-12 h-2 bg-surface-container-highest rounded-full"></div>

    <!-- Step 03 -->
    <div class="w-full md:w-64 h-32 bg-brand-yellow text-on-tertiary-fixed rounded-2xl flex flex-col items-center justify-center p-4 shadow-lg">
      <span class="text-4xl font-black mb-1"><?php echo $step3_number; ?></span>
      <span class="text-sm font-bold uppercase tracking-widest"><?php echo $step3_label; ?></span>
    </div>

  </div>
</section>