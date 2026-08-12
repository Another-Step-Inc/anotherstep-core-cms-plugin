import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';

import './editor.scss';

export default function Edit( props ) {
    const { attributes, setAttributes } = props;
    const { title, body, iconName, cardStyle } = attributes;

    return (
        <>
            <InspectorControls>
                <PanelBody title={ __( 'Card Style & Icon', 'sidebar-trust-card' ) } initialOpen={ true }>
                    <TextControl
                        label={ __( 'Material Icon Name', 'sidebar-trust-card' ) }
                        value={ iconName }
                        placeholder="e.g., gavel, shield, lock"
                        onChange={ ( val ) => setAttributes( { iconName: val } ) }
                    />
                    <SelectControl
                        label={ __( 'Card Style Variant', 'sidebar-trust-card' ) }
                        value={ cardStyle }
                        options={ [
                            { label: __( 'Primary Blue Container', 'sidebar-trust-card' ), value: 'primary-blue' },
                            { label: __( 'Surface Light Container', 'sidebar-trust-card' ), value: 'surface-light' },
                        ] }
                        onChange={ ( val ) => setAttributes( { cardStyle: val } ) }
                    />
                </PanelBody>
            </InspectorControls>

            <div { ...useBlockProps( { className: `as-hero-content-col variant-${ cardStyle }` } ) }>
                <textarea
                    className="as-inline-title"
                    value={ title }
                    placeholder={ __( 'Card Title...', 'sidebar-trust-card' ) }
                    rows={ 1 }
                    onChange={ ( e ) => setAttributes( { title: e.target.value } ) }
                />

                <textarea
                    className="as-inline-description"
                    value={ body }
                    placeholder={ __( 'Card Disclosure Paragraph...', 'sidebar-trust-card' ) }
                    rows={ 4 }
                    onChange={ ( e ) => setAttributes( { body: e.target.value } ) }
                />

                <div className="as-editor-verification-box">
                    <span className="dashicons dashicons-admin-customizer"></span>
                    <div>
                        <p><strong>Icon:</strong> { iconName || 'none' } | <strong>Variant:</strong> { cardStyle }</p>
                    </div>
                </div>
            </div>
        </>
    );
}