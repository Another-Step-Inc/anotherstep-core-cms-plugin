<?php
$heading     = ! empty( $attributes['heading'] ) ? $attributes['heading'] : 'Important Service Note';
$notice_text = ! empty( $attributes['noticeText'] ) ? $attributes['noticeText'] : 'In order to receive 24 hour respite service, the caregiver must access Site Based Respite, <span class="text-brand-red font-bold">which Another Step does not offer.</span>';

$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => 'bg-surface-container-low py-24' ) );
?>

<section <?php echo $wrapper_attributes; ?>>
  <div class="max-w-7xl mx-auto px-8">
    <div class="bg-surface-container-lowest rounded-xl p-12 lg:p-16 relative overflow-hidden flex flex-col md:flex-row items-center gap-12">
      <div class="w-20 h-20 shrink-0 bg-brand-red rounded-full flex items-center justify-center">
        <span class="material-symbols-outlined text-white text-4xl" style="font-variation-settings: 'FILL' 1;">info</span>
      </div>
      <div>
        <h2 class="text-title-lg font-bold text-brand-red mb-4">
          <?php echo wp_kses_post( $heading ); ?>
        </h2>
        <p class="text-2xl lg:text-3xl font-display font-medium text-on-surface leading-tight">
          <?php echo wp_kses_post( $notice_text ); ?>
        </p>
      </div>
      <!-- Signature Texture/Gradient -->
      <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-brand-red/10 to-transparent rounded-bl-full"></div>
    </div>
  </div>
</section>