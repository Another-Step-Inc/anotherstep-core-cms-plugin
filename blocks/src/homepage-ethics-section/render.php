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
$ethics_headline = $attributes['ethicsHeadline'];
$ethics_link_text = $attributes['ethicsLinkText'];
$ethics_link_url = $attributes['ethicsLinkUrl'];
?>
<div class="bg-slate-50 border border-slate-200 rounded-[2rem] p-8 md:p-12" <?php echo get_block_wrapper_attributes(); ?>>
    <div class="max-w-3xl">
		<?php if ($ethics_headline) : ?>
        <h2 class="text-2xl md:text-3xl font-bold text-blue-900 mb-6 uppercase tracking-tight">
          
			<?php echo esc_html($ethics_headline); ?>
		  
        </h2>
		<?php endif; ?>
		<?php if ( ! empty( $content ) ) : ?>
            <div class="prose prose-slate lg:prose-lg text-slate-700 space-y-4">
                <?php echo $content; ?>
            </div>
        <?php endif; ?>
		<?php if ($ethics_link_text && $ethics_link_url) : ?>
        <div class="mt-8">
          <a href="<?php echo $ethics_link_url; ?>" class="inline-flex items-center gap-2 text-blue-700 font-bold hover:text-blue-900 transition-colors group">
            <span><?php echo $ethics_link_text; ?></span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </a>
        </div>
		<?php endif; ?>
    </div>
</div>
