<section class="bg-surface-container-low py-24 px-8">
    <div class="max-w-7xl mx-auto">
        <div class="mb-16 text-center max-w-2xl mx-auto">
            <h2 class="text-headline-lg font-display font-bold text-on-surface mb-4"><?php echo esc_html($attributes['headline']); ?></h2>
            <p class="text-on-surface-variant"><?php echo esc_html($attributes['description']); ?></p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php echo $content; // This automatically holds the compiled raw HTML string output of all child cards! ?>
        </div>
    </div>
</section>