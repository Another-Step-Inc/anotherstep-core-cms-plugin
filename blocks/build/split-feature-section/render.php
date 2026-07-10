<?php
/**
 * Dynamic block render template for Bento Split Feature.
 */

$attrs             = isset( $attributes ) ? $attributes : array();
$alignment         = isset( $attrs['imageAlignment'] ) ? esc_attr( $attrs['imageAlignment'] ) : 'right';
$bg_color          = isset( $attrs['backgroundColor'] ) ? esc_attr( $attrs['backgroundColor'] ) : 'surface';
$underline_class   = ! empty( $attrs['underlineAccent'] ) ? 'relative accent-underline pb-4' : '';
$flex_direction    = ( 'left' === $alignment ) ? 'lg:flex-row-reverse' : '';

$eyebrow           = isset( $attrs['eyebrowText'] ) ? esc_html( $attrs['eyebrowText'] ) : '';
$media_url         = isset( $attrs['mediaUrl'] ) ? esc_url( $attrs['mediaUrl'] ) : '';
$media_alt         = isset( $attrs['mediaAlt'] ) ? esc_attr( $attrs['mediaAlt'] ) : '';
$secondary_url     = isset( $attrs['secondaryMediaUrl'] ) ? esc_url( $attrs['secondaryMediaUrl'] ) : '';
$metric_num        = isset( $attrs['metricNumber'] ) ? esc_html( $attrs['metricNumber'] ) : '';
$metric_lab        = isset( $attrs['metricLabel'] ) ? esc_html( $attrs['metricLabel'] ) : '';
$icon_name         = isset( $attrs['iconName'] ) ? esc_attr( $attrs['iconName'] ) : '';
$icon_title        = isset( $attrs['iconTitle'] ) ? esc_html( $attrs['iconTitle'] ) : '';

$title_content     = isset( $attrs['splitTitle'] ) ? esc_html( $attrs['splitTitle'] ) : '';
$description_content = isset( $attrs['splitDescription'] ) ? esc_html( $attrs['splitDescription'] ) : '';
?>

<section class="py-24 bg-<?php echo $bg_color; ?> project-split-feature">
  <div class="max-w-7xl mx-auto px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center <?php echo $flex_direction; ?>">
      
      <!-- Primary Content Area -->
      <div class="lg:col-span-7">
        <?php if ( ! empty( $eyebrow ) ) : ?>
          <span class="inline-block px-4 py-1 rounded-full bg-brand-blue-fixed text-on-brand-blue-fixed text-label-md font-bold mb-6">
            <?php echo $eyebrow; ?>
          </span>
        <?php endif; ?>
        
        <div class="content-wrapper-slot <?php echo $underline_class; ?>">
          <?php echo $title_content; ?>
          <?php echo $description_content; ?>
        </div>
      </div>

      <!-- Asymmetric Mosaic Graphic Grid Layout -->
      <div class="lg:col-span-5 relative">
        <div class="grid grid-cols-2 gap-4 pt-12">
          
          <!-- Column 1: Media Asset & Brand Accent Box -->
          <div class="space-y-4">
            <?php if ( ! empty( $media_url ) ) : ?>
              <div class="aspect-square rounded-xl overflow-hidden shadow-lg">
                <img src="<?php echo $media_url; ?>" alt="<?php echo $media_alt; ?>" class="w-full h-full object-cover" />
              </div>
            <?php endif; ?>
            
            <?php if ( ! empty( $metric_num ) || ! empty( $metric_lab ) ) : ?>
              <div class="bg-brand-red p-8 rounded-xl text-on-brand-red">
                <div class="text-4xl font-extrabold mb-2"><?php echo $metric_num; ?></div>
                <div class="text-label-md font-bold uppercase tracking-widest"><?php echo $metric_lab; ?></div>
              </div>
            <?php endif; ?>
          </div>
          
          <!-- Column 2: Service Block Card & Secondary Media Element -->
          <div class="space-y-4 translate-y-12">
            <div class="bg-brand-blue-container p-8 rounded-xl text-on-brand-blue-container">
              <?php if ( ! empty( $icon_name ) ) : ?>
                <span class="material-symbols-outlined text-4xl mb-4"><?php echo $icon_name; ?></span>
              <?php endif; ?>
              <div class="text-title-lg font-bold leading-tight"><?php echo $icon_title; ?></div>
            </div>
            
            <?php if ( ! empty( $secondary_url ) ) : ?>
              <div class="aspect-[3/4] rounded-xl overflow-hidden shadow-lg">
                <img src="<?php echo $secondary_url; ?>" alt="" class="w-full h-full object-cover" />
              </div>
            <?php endif; ?>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>