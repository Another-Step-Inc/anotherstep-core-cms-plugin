import { registerBlockStyle } from '@wordpress/blocks';
import { domReady } from '@wordpress/dom-ready';

domReady(() => {
    // Custom List Styles
    registerBlockStyle('core/list', {
        name: 'bento-list',
        label: 'Bento Card List',
        isDefault: false,
    });

    registerBlockStyle('core/list', {
        name: 'checkmark-list',
        label: 'Checkmark List',
        isDefault: false,
    });

    // Custom Button Styles
    registerBlockStyle('core/button', {
        name: 'brand-blue',
        label: 'Brand Blue',
        isDefault: false,
    });

    registerBlockStyle('core/button', {
        name: 'brand-outline',
        label: 'Brand Outline',
        isDefault: false,
    });
});