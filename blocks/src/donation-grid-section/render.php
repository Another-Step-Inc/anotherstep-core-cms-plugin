<?php
/**
 * Render template for DonationGridSection
 * @var array    $attributes Block attributes.
 * @var string   $content    Rendered HTML of child InnerBlocks.
 */

$form_span    = $attributes['formColumnSpan'] ?? 8;
$sidebar_span = $attributes['sidebarColumnSpan'] ?? 4;

$wrapper_attributes = get_block_wrapper_attributes( array(
	'class' => 'max-w-7xl mx-auto px-8 grid grid-cols-1 lg:grid-cols-12 gap-8 mb-24',
) );
?>

<section <?php echo $wrapper_attributes; ?>>
	<?php echo $content; ?>
</section>