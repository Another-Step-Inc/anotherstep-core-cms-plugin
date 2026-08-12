<?php
/**
 * Render template for SidebarTrustCardBlock
 * @var array $attributes Block attributes.
 */

$title      = $attributes['title'] ?? '';
$body       = $attributes['body'] ?? '';
$icon_name  = $attributes['iconName'] ?? 'gavel';
$card_style = $attributes['cardStyle'] ?? 'primary-blue';

$style_classes = ($card_style === 'primary-blue')
	? 'bg-brand-blue-container text-on-brand-blue'
	: 'bg-surface-container-low text-on-surface';

$wrapper_attributes = get_block_wrapper_attributes( array(
	'class' => $style_classes . ' p-8 rounded-[2rem] relative overflow-hidden space-y-8',
) );
?>

<div <?php echo $wrapper_attributes; ?>>
	<?php if ( $icon_name ) : ?>
		<span class="material-symbols-outlined absolute -right-8 -bottom-8 text-[12rem] opacity-10">
			<?php echo esc_html( $icon_name ); ?>
		</span>
	<?php endif; ?>

	<?php if ( $title ) : ?>
		<h3 class="text-title-lg font-bold mb-4"><?php echo esc_html( $title ); ?></h3>
	<?php endif; ?>

	<?php if ( $body ) : ?>
		<p class="text-body-lg opacity-90 leading-relaxed"><?php echo esc_html( $body ); ?></p>
	<?php endif; ?>
</div>