<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
$about_headline = $attributes['aboutHeadline'];
$about_description = isset( $attributes['aboutDescription'] ) ? $attributes['aboutDescription'] : '';
$about_subheadline = $attributes['aboutSubHeadline'];
$about_impact_title1 = $attributes['aboutImpactTitle1'];
$about_impact_paragraph1 = isset( $attributes['aboutImpactParagraph1'] ) ? $attributes['aboutImpactParagraph1'] : '';
$about_impact_icon1 = $attributes['aboutImpactIcon1'];
$about_impact_title2 = $attributes['aboutImpactTitle2'];
$about_impact_paragraph2 = isset( $attributes['aboutImpactParagraph2'] ) ? $attributes['aboutImpactParagraph2'] : '';
$about_impact_icon2 = $attributes['aboutImpactIcon2'];
?>
      <div class="space-y-6">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-blue-900 text-sm font-bold uppercase tracking-wider">
          <span class="relative flex h-2 w-2">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-600"></span>
          </span>
          Who we are
        </div>
        <?php if ($about_headline) : ?>
        <h2 class="text-3xl md:text-4xl font-bold text-slate-900 leading-tight">
          <?php echo $about_headline; ?>
        </h2>
		<?php endif; ?>
        
		<?php if ($about_description) : ?>
			<div <?php echo get_block_wrapper_attributes(); ?>>
				<div class="prose prose-lg text-slate-600 space-y-4">
				<?php 
					echo wp_kses_post( $about_description ); 
				?>
				</div>
			</div>
		<?php endif; ?>
      </div>

      <div class="relative">
        <div class="bg-white p-8 md:p-12 rounded-[2rem] shadow-xl border border-slate-100 relative z-10">
		<?php if ($about_subheadline) : ?>
          <h3 class="text-2xl font-bold text-blue-900 mb-6"><?php echo esc_html($about_subheadline) ?></h3>
        <?php endif; ?>
          <div class="space-y-8">
            <div class="flex items-start gap-4">
              <div class="w-12 h-12 bg-yellow-400 rounded-2xl flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                </svg>
              </div>
              <div>
				<?php if ($about_impact_title1) : ?>
                <h4 class="font-bold text-slate-900"><?php echo esc_html($about_impact_title1) ?></h4>
				<?php endif; ?>
				<?php if ($about_impact_paragraph1) : ?>
					<div <?php echo get_block_wrapper_attributes(); ?>>
						<div class="as-impact-description text-slate-500 text-sm">
							<?php echo wp_kses_post( $about_impact_paragraph1 ); ?>
						</div>
					</div>
				<?php endif; ?>
              </div>
            </div>

            <div class="flex items-start gap-4">
              <div class="w-12 h-12 bg-blue-900 rounded-2xl flex items-center justify-center shrink-0 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
              </div>
              <div>
				<?php if ($about_impact_title2) : ?>
                <h4 class="font-bold text-slate-900"><?php echo esc_html($about_impact_title2) ?></h4>
				<?php endif; ?>
				<?php if ($about_impact_paragraph2) : ?>
					<div <?php echo get_block_wrapper_attributes(); ?>>
						<div class="as-impact-description text-slate-500 text-sm">
							<?php echo wp_kses_post( $about_impact_paragraph2 ); ?>
						</div>
					</div>
				<?php endif; ?>
              </div>
            </div>

            <div class="pt-6 border-t border-slate-100">
              <p class="text-sm italic text-slate-400">Founded in 1992</p>
            </div>
          </div>
        </div>
        
        <div class="absolute -bottom-6 -right-6 w-64 h-64 bg-yellow-100 rounded-full blur-3xl opacity-50 -z-0"></div>
      </div>
