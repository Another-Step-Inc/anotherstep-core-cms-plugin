<?php
/**
 * Post Render template for CTA Director Section
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block inner content (empty for this block).
 * @var WP_Block $block      Block instance.
 */

// Fallbacks for empty fields
$headline         = ! empty( $attributes['headline'] ) ? esc_html( $attributes['headline'] ) : 'Ready to take the next step?';
$description      = ! empty( $attributes['description'] ) ? esc_html( $attributes['description'] ) : '';
$btn1_text        = ! empty( $attributes['btn1Text'] ) ? esc_html( $attributes['btn1Text'] ) : 'Schedule a Call';
$btn1_url         = ! empty( $attributes['btn1Url'] ) ? esc_url( $attributes['btn1Url'] ) : '#';
$btn2_text        = ! empty( $attributes['btn2Text'] ) ? esc_html( $attributes['btn2Text'] ) : 'Email Us';
$btn2_url         = ! empty( $attributes['btn2Url'] ) ? esc_url( $attributes['btn2Url'] ) : '#';
$director_name    = ! empty( $attributes['directorName'] ) ? esc_html( $attributes['directorName'] ) : 'Jaison Jacob';
$director_title   = ! empty( $attributes['directorTitle'] ) ? esc_html( $attributes['directorTitle'] ) : '';
$director_regions = ! empty( $attributes['directorRegions'] ) ? esc_html( $attributes['directorRegions'] ) : '';
$director_phone   = ! empty( $attributes['directorPhone'] ) ? esc_html( $attributes['directorPhone'] ) : '';
$director_image   = ! empty( $attributes['directorImageUrl'] ) ? esc_url( $attributes['directorImageUrl'] ) : '';

$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => 'py-24 bg-surface' ) );
?>

<section <?php echo $wrapper_attributes; ?>>
  <div class="max-w-screen-2xl mx-auto px-8">
    <div class="bg-surface-container p-12 md:p-20 rounded-xl relative overflow-hidden">
      
      <!-- Background SVG Accent -->
      <div class="absolute top-0 right-0 w-1/3 h-full opacity-10 pointer-events-none">
        <svg class="h-full w-full" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
          <path d="M44.7,-76.4C58.1,-69.2,69.2,-58.1,76.4,-44.7C83.7,-31.3,87.1,-15.7,87.1,0C87.1,15.7,83.7,31.3,76.4,44.7C69.2,58.1,58.1,69.2,44.7,76.4C31.3,83.7,15.7,87.1,0,87.1C-15.7,87.1,-31.3,83.7,-44.7,76.4C-58.1,69.2,-69.2,58.1,-76.4,44.7C-83.7,31.3,-87.1,15.7,-87.1,0C-87.1,-15.7,-83.7,-31.3,-76.4,-44.7C-69.2,-58.1,-58.1,-69.2,-44.7,-76.4C-31.3,-83.7,-15.7,-87.1,0,-87.1C15.7,-87.1,31.3,-83.7,44.7,-76.4Z" fill="#004E8B" transform="translate(100 100)"></path>
        </svg>
      </div>

      <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <!-- Text CTA area -->
        <div>
          <h2 class="text-[3rem] font-extrabold text-brand-blue leading-tight mb-6">
            <?php echo $headline; ?>
          </h2>
          <?php if ( $description ) : ?>
            <p class="text-xl text-on-surface-variant mb-12">
              <?php echo $description; ?>
            </p>
          <?php endif; ?>
          <div class="mt-12 flex flex-wrap gap-4">
            <a href="<?php echo $btn1_url; ?>" class="bg-brand-blue text-on-brand-blue px-10 py-4 rounded-full font-bold text-body-lg shadow-lg hover:bg-brand-blue-container transition-all text-center inline-block">
              <?php echo $btn1_text; ?>
            </a>
            <a href="<?php echo $btn2_url; ?>" class="border-2 border-outline-variant px-10 py-4 rounded-full font-bold text-body-lg hover:bg-surface-container-low transition-all text-center inline-block">
              <?php echo $btn2_text; ?>
            </a>
          </div>
        </div>

        <!-- Sidebar Director Display Card -->
        <div class="bg-surface-container-lowest p-10 rounded-xl shadow-xl border-l-8 border-brand-red">
          <div class="flex flex-col sm:flex-row items-start gap-6">
            <?php if ( $director_image ) : ?>
              <div class="w-24 h-24 rounded-full bg-surface-container-high flex-shrink-0 overflow-hidden">
                <img class="w-full h-full object-cover" alt="<?php echo $director_name; ?>" src="<?php echo $director_image; ?>" />
              </div>
            <?php endif; ?>
            <div>
              <h4 class="text-2xl font-bold text-on-surface"><?php echo $director_name; ?></h4>
              <?php if ( $director_title ) : ?>
                <p class="text-brand-red font-medium uppercase tracking-wider text-sm mb-4">
                  <?php echo $director_title; ?>
                </p>
              <?php endif; ?>
              <div class="space-y-3">
                <?php if ( $director_regions ) : ?>
                  <div class="flex items-center gap-3 text-on-surface-variant">
                    <span class="material-symbols-outlined text-brand-blue">location_on</span>
                    <span><?php echo $director_regions; ?></span>
                  </div>
                <?php endif; ?>
                <?php if ( $director_phone ) : ?>
                  <div class="flex items-center gap-3 text-on-surface-variant">
                    <span class="material-symbols-outlined text-brand-blue">call</span>
                    <span class="font-bold text-on-surface"><?php echo $director_phone; ?></span>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>