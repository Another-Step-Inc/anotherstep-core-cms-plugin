import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, ToggleControl } from '@wordpress/components';

import './editor.scss';

export default function Edit( props ) {
    const { attributes, setAttributes } = props;
    const {
        title,
        description,
        showModeToggle,
        generalFormUrl,
        tributeFormUrl,
        taxDisclosure,
        showSecurityBadge,
    } = attributes;

    return (
        <>
            <InspectorControls>
                <PanelBody title={ __( 'Form Integration', 'donor-perfect-form' ) } initialOpen={ true }>
                    <ToggleControl
                        label={ __( 'Enable Mode Toggle', 'donor-perfect-form' ) }
                        checked={ showModeToggle }
                        onChange={ ( val ) => setAttributes( { showModeToggle: val } ) }
                    />
                    <TextControl
                        label={ __( 'General Form URL / Embed ID', 'donor-perfect-form' ) }
                        value={ generalFormUrl }
                        placeholder="https://..."
                        onChange={ ( val ) => setAttributes( { generalFormUrl: val } ) }
                    />
                    { showModeToggle && (
                        <TextControl
                            label={ __( 'Tribute Form URL / Embed ID', 'donor-perfect-form' ) }
                            value={ tributeFormUrl }
                            placeholder="https://..."
                            onChange={ ( val ) => setAttributes( { tributeFormUrl: val } ) }
                        />
                    ) }
                    <ToggleControl
                        label={ __( 'Show Security Badge Footer', 'donor-perfect-form' ) }
                        checked={ showSecurityBadge }
                        onChange={ ( val ) => setAttributes( { showSecurityBadge: val } ) }
                    />
                </PanelBody>
            </InspectorControls>

            <div { ...useBlockProps( { className: 'as-hero-content-col lg:col-span-8' } ) }>
                <textarea
                    className="as-inline-title"
                    value={ title }
                    placeholder={ __( 'Form Title...', 'donor-perfect-form' ) }
                    rows={ 1 }
                    onChange={ ( e ) => setAttributes( { title: e.target.value } ) }
                />

                <textarea
                    className="as-inline-description"
                    value={ description }
                    placeholder={ __( 'Form Description...', 'donor-perfect-form' ) }
                    rows={ 2 }
                    onChange={ ( e ) => setAttributes( { description: e.target.value } ) }
                />

                <div className="as-editor-verification-box">
                    <span className="dashicons dashicons-welcome-widgets-menus"></span>
                    <div>
                        <p><strong>DonorPerfect Embed Target:</strong> { generalFormUrl || '— (No URL provided)' }</p>
                        { showModeToggle && <p><strong>Tribute Target:</strong> { tributeFormUrl || '—' }</p> }
                    </div>
                </div>

                <div className="as-editor-tax-area">
                    <TextareaControl
                        label={ __( 'Tax Disclosure Notice', 'donor-perfect-form' ) }
                        value={ taxDisclosure }
                        rows={ 3 }
                        onChange={ ( val ) => setAttributes( { taxDisclosure: val } ) }
                    />
                </div>
            </div>
        </>
    );
}