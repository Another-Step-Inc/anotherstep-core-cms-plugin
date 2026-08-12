<?php
/**
 * Render template for DonorPerfectFormBlock
 * @var array $attributes Block attributes.
 */

$title               = $attributes['title'] ?? '';
$description         = $attributes['description'] ?? '';
$show_mode_toggle    = $attributes['showModeToggle'] ?? true;
$general_form_url    = $attributes['generalFormUrl'] ?? '';
$tribute_form_url    = $attributes['tributeFormUrl'] ?? '';
$tax_disclosure      = $attributes['taxDisclosure'] ?? '';
$show_security_badge = $attributes['showSecurityBadge'] ?? true;

$wrapper_attributes = get_block_wrapper_attributes( array(
	'class' => 'lg:col-span-8 bg-surface-container-lowest p-8 md:p-12 rounded-[2rem] shadow-sm relative overflow-hidden border border-outline-variant/20',
) );
?>

<div <?php echo $wrapper_attributes; ?>>
	<div class="absolute top-0 right-0 w-64 h-64 bg-brand-blue/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
	<div class="relative z-10 space-y-10">
		<div class="text-center py-12 space-y-6">
			
			<div class="space-y-2">
				<?php if ( $title ) : ?>
					<h2 class="text-headline-lg font-bold text-on-surface"><?php echo esc_html( $title ); ?></h2>
				<?php endif; ?>
				<?php if ( $description ) : ?>
					<p class="text-on-surface-variant"><?php echo esc_html( $description ); ?></p>
				<?php endif; ?>
			</div>

			<?php if ( $show_mode_toggle ) : ?>
				<div class="flex justify-center mb-8">
					<div class="inline-flex p-1 bg-surface-container-high rounded-full">
						<button
							type="button"
							class="px-8 py-2 rounded-full font-bold transition-all bg-surface-container-lowest text-brand-blue shadow-sm"
							id="toggle-general"
							data-url="<?php echo esc_url( $general_form_url ); ?>"
						>
							<?php esc_html_e( 'General Donation', 'donor-perfect-form' ); ?>
						</button>
						<button
							type="button"
							class="px-8 py-2 rounded-full font-bold transition-all text-on-surface-variant"
							id="toggle-tribute"
							data-url="<?php echo esc_url( $tribute_form_url ); ?>"
						>
							<?php esc_html_e( 'Tribute Donation', 'donor-perfect-form' ); ?>
						</button>
					</div>
				</div>
			<?php endif; ?>

			<div class="w-full min-h-[600px] bg-surface-container-low rounded-2xl border-2 border-dashed border-outline-variant/30 flex flex-col items-center justify-center p-8">
				<iframe
					id="donorperfect-iframe"
					src="<?php echo esc_url( $general_form_url ); ?>"
					class="w-full h-full min-h-[600px] border-0"
				></iframe>
			</div>

			<?php if ( $tax_disclosure ) : ?>
				<div class="mt-6 px-4">
					<p class="text-sm text-on-surface-variant/80 leading-relaxed text-center italic">
						<span class="font-bold"><?php esc_html_e( 'TAX DISCLOSURE:', 'donor-perfect-form' ); ?></span>
						<?php echo esc_html( $tax_disclosure ); ?>
					</p>
				</div>
			<?php endif; ?>

			<?php if ( $show_security_badge ) : ?>
				<div class="flex items-center justify-center gap-4 pt-6 border-t border-outline-variant/30">
					<span class="material-symbols-outlined text-brand-blue">lock</span>
					<span class="text-label-md font-bold text-on-surface-variant uppercase tracking-wider">
						<?php esc_html_e( 'Secure 256-bit SSL Encryption', 'donor-perfect-form' ); ?>
					</span>
				</div>
			<?php endif; ?>

		</div>
	</div>
</div>