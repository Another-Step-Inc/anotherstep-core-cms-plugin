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
$core_values_headline = $attributes['coreValuesHeadline'];
$core_values_quote = $attributes['coreValuesQuote'];
$args = array(
    'post_type'      => 'values',
    'posts_per_page' => 5,
);

$core_values_query = new WP_Query( $args );
?>
    <div class="text-center mb-12">
	<?php if ($core_values_headline) : ?>
      <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4"><?php echo $core_values_headline ?></h2>
	<?php endif; ?>
      <div class="w-24 h-1 bg-yellow-400 mx-auto rounded-full"></div>
	<?php if ($core_values_quote) : ?>
      <p class="mt-6 text-lg text-slate-600 max-w-3xl mx-auto italic">
        "<?php echo $core_values_quote ?>"
      </p>
	<?php endif; ?>
    </div>

	<?php if ($core_values_query->have_posts()) : ?>
    <div class="grid md:grid-cols-3 gap-8">
    	<?php while ($core_values_query->have_posts()) : $core_values_query->the_post(); ?>
		<div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
			<div class="w-14 h-14 bg-blue-50 text-blue-900 rounded-2xl flex items-center justify-center mb-6">
			<!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
			</svg> -->
			</div>
			<h3 class="text-xl font-bold text-slate-900 mb-4"><?php echo esc_html(the_title()); ?></h3>
			<p class="text-slate-600 leading-relaxed">
			<?php echo wp_strip_all_tags( get_the_content() ); ?>
			</p>
		</div>
		<?php
			wp_reset_postdata();
		endwhile;
		?>
    </div>
	<?php endif; ?>
