<?php
$title                = ! empty( $attributes['title'] ) ? $attributes['title'] : 'Diversity & Inclusion Statement';
$resource_title       = ! empty( $attributes['resourceTitle'] ) ? $attributes['resourceTitle'] : 'Support Resources';
$resource_desc        = ! empty( $attributes['resourceDescription'] ) ? $attributes['resourceDescription'] : 'Another Step, Inc. cares about the needs of our staff and families.';
$helpline_title       = ! empty( $attributes['helplineTitle'] ) ? $attributes['helplineTitle'] : 'Mental Health Helpline';
$helpline_number      = ! empty( $attributes['helplineNumber'] ) ? $attributes['helplineNumber'] : '1-844-863-9314';
$helpline_desc        = ! empty( $attributes['helplineDescription'] ) ? $attributes['helplineDescription'] : 'The New York State Mental Health Helpline is staffed by trained volunteers...';

$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => 'bg-surface-container-low py-20 px-8' ) );
?>

<section <?php echo $wrapper_attributes; ?>>
  <div class="max-w-4xl mx-auto space-y-16">
    <!-- Diversity & Inclusion Statement -->
    <div class="space-y-6 text-center md:text-left">
      <h2 class="text-[2.5rem] font-display font-extrabold text-brand-blue leading-tight">
        <?php echo wp_kses_post( $title ); ?>
      </h2>
      <div class="space-y-4">
        <?php echo $content; ?>
      </div>
    </div>

    <!-- Support Resources -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 pt-12 border-t border-outline-variant/30">
      <div class="space-y-4">
        <h3 class="text-headline-md font-display font-bold text-on-surface">
          <?php echo wp_kses_post( $resource_title ); ?>
        </h3>
        <p class="text-body-lg text-on-surface-variant leading-relaxed">
          <?php echo wp_kses_post( $resource_desc ); ?>
        </p>
      </div>

      <!-- Helpline Call-out -->
      <div class="bg-brand-blue text-on-brand-blue p-8 rounded-xl editorial-shadow">
        <div class="flex items-center gap-3 mb-4">
          <span class="material-symbols-outlined text-3xl">health_and_safety</span>
          <h4 class="text-title-lg font-bold"><?php echo wp_kses_post( $helpline_title ); ?></h4>
        </div>
        <p class="text-[1.75rem] font-display font-black mb-4">
          <?php echo wp_kses_post( $helpline_number ); ?>
        </p>
        <p class="text-on-brand-blue/90 text-label-lg leading-relaxed">
          <?php echo wp_kses_post( $helpline_desc ); ?>
        </p>
      </div>
    </div>
  </div>
</section>