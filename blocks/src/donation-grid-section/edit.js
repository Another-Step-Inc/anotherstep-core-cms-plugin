import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls, InnerBlocks } from '@wordpress/block-editor';
import { PanelBody, RangeControl } from '@wordpress/components';

import './editor.scss';

// Template enforces 1 DonorPerfect Form in the form column and Trust Cards in the sidebar
const TEMPLATE = [
    [ 'anotherstep/donor-perfect-form', {} ],
    [ 'anotherstep/sidebar-trust-card', { title: 'Terms & Conditions', iconName: 'gavel' } ],
    [ 'anotherstep/sidebar-trust-card', { title: 'Secure & Private', iconName: 'shield' } ]
];

export default function Edit( props ) {
    const { attributes, setAttributes } = props;
    const { formColumnSpan = 8, sidebarColumnSpan = 4 } = attributes;

    return (
        <>
            <InspectorControls>
                <PanelBody title={ __( 'Grid Strategy', 'donation-grid-section' ) } initialOpen={ true }>
                    <RangeControl
                        label={ __( 'Form Column Span (Max 12)', 'donation-grid-section' ) }
                        value={ formColumnSpan }
                        onChange={ ( val ) => setAttributes( { formColumnSpan: val } ) }
                        min={ 1 }
                        max={ 12 }
                    />
                    <RangeControl
                        label={ __( 'Sidebar Column Span (Max 12)', 'donation-grid-section' ) }
                        value={ sidebarColumnSpan }
                        onChange={ ( val ) => setAttributes( { sidebarColumnSpan: val } ) }
                        min={ 1 }
                        max={ 12 }
                    />
                </PanelBody>
            </InspectorControls>

            <div { ...useBlockProps( { className: 'as-hero-editor-container' } ) }>
                <div className="as-hero-editor-grid">
                    <InnerBlocks
                        allowedBlocks={ [ 'anotherstep/donor-perfect-form', 'anotherstep/sidebar-trust-card' ] }
                        template={ TEMPLATE }
                        templateLock={ false }
                    />
                </div>
            </div>
        </>
    );
}