(function () {
    // Check if WordPress editor objects are available before running
    if (typeof wp === 'undefined' || !wp.domReady || !wp.blocks) {
        return;
    }

    wp.domReady(function () {
        // ==========================================
        // 1. CORE LIST STYLES (Parent <ul> / <ol>)
        // ==========================================
        wp.blocks.registerBlockStyle('core/list', {
            name: 'bento-list',
            label: 'Bento Card List',
            isDefault: false,
        });

        wp.blocks.registerBlockStyle('core/list', {
            name: 'checkmark-list',
            label: 'Checkmark List',
            isDefault: false,
        });

        // ==========================================
        // 2. CORE LIST ITEM STYLES (Individual <li>)
        // ==========================================
        wp.blocks.registerBlockStyle('core/list-item', {
            name: 'bento-list-item',
            label: 'Bento Item',
            isDefault: false,
        });

        // ==========================================
        // 3. CORE BUTTON STYLES (Individual Buttons)
        // ==========================================
        wp.blocks.registerBlockStyle('core/button', {
            name: 'brand-blue',
            label: 'Brand Blue',
            isDefault: false,
        });

        wp.blocks.registerBlockStyle('core/button', {
            name: 'brand-outline',
            label: 'Brand Outline',
            isDefault: false,
        });

        // ==========================================
        // 4. UNREGISTER DEFAULT STYLES (Optional)
        // ==========================================
        // wp.blocks.unregisterBlockStyle('core/button', 'outline');
        // wp.blocks.unregisterBlockStyle('core/button', 'fill');
    });
})();