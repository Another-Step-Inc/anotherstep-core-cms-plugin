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
$ar_title = $attributes['administrativeRecordsTitle'];
$ar_description = $attributes['administrativeRecordsDescription'];
$ar_director = $attributes['directorName'];
$ar_director_title = $attributes['directorTitle'];
$ar_organization = $attributes['organizationName'];
$ar_street = $attributes['street'];
$ar_city = $attributes['city'];
$ar_state = $attributes['state'];
$ar_zip = $attributes['zipCode'];
$ci_title = $attributes['charityInfoTitle'];
$ci_description = $attributes['charityInfoDescription'];
$ci_ag_phone = $attributes['attorneyGeneralPhone'];
?>
<div <?php echo get_block_wrapper_attributes(array('class' => 'max-w-7xl mx-auto grid md:grid-cols-2 gap-12')); ?>>
	<div class="space-y-4">
		<?php if ($ar_title): ?>
		<h3 class="font-bold text-blue-900 uppercase text-sm tracking-widest"><?php echo esc_html( $ar_title ); ?></h3>
		<?php endif; ?>

		<?php if ($ar_description): ?>
		<p class="text-slate-600 text-sm leading-relaxed">
			<?php echo esc_html( $ar_description ); ?>
		</p>
		<?php endif; ?>
		
		
		<div class="text-slate-800 text-sm font-medium">
			<?php if ($ar_director && $ar_director_title): ?>
			<p class="font-bold"><?php echo esc_html( $ar_director ); ?>, <?php echo esc_html( $ar_director_title ); ?></p>
			<?php endif; ?>

			<?php if ($ar_organization): ?>
			<p><?php echo esc_html( $ar_organization ); ?></p>
			<?php endif; ?>

			<?php if ($ar_street && $ar_city && $ar_state && $ar_zip): ?>
			<p><?php echo esc_html( $ar_street ); ?></p>
			<p><?php echo esc_html( $ar_city ); ?>, <?php echo esc_html( $ar_state ); ?> <?php echo esc_html( $ar_zip ); ?></p>
			<?php endif; ?>
		</div>
	</div>

	<div class="bg-blue-900 text-white p-8 rounded-3xl flex flex-col justify-center">
		<?php if ($ci_title && $ci_description && $ci_ag_phone): ?>
		<h3 class="font-bold mb-2"><?php echo esc_html( $ci_title ); ?></h3>
		<p class="text-blue-100 text-sm mb-4">
			<?php echo esc_html( $ci_description ); ?>
		</p>
		<a href="tel:<?php echo esc_attr( preg_replace( '/\D/', '', $ci_ag_phone ) ); ?>" class="text-2xl font-bold text-yellow-400 hover:text-yellow-300 transition-colors">
			<?php echo esc_html( $ci_ag_phone ); ?>
		</a>
		<?php endif; ?>
	</div>
</div>
