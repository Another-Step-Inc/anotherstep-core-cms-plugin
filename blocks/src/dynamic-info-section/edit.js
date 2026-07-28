import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { 
    PanelBody, 
    TextControl, 
    SelectControl, 
    ToggleControl 
} from '@wordpress/components';

import './editor.scss';

export default function Edit( props ) {
    const { attributes, setAttributes } = props;

    const {
        // Layout Strategy
        layoutType = 'two-column', // 'two-column' or 'stacked'
        showSecondarySection = true,

        // Primary Section Main Copy
        primaryTitle,
        primaryDescription,

        // Primary Section Fields (7 Fields to cover Name, Title, Org, Address, etc.)
        primaryFieldLabel1, primaryFieldValue1,
        primaryFieldLabel2, primaryFieldValue2,
        primaryFieldLabel3, primaryFieldValue3,
        primaryFieldLabel4, primaryFieldValue4,
        primaryFieldLabel5, primaryFieldValue5,
        primaryFieldLabel6, primaryFieldValue6,
        primaryFieldLabel7, primaryFieldValue7,

        // Secondary Section Data
        secondaryTitle,
        secondaryDescription,
        secondaryFieldLabel1,
        secondaryFieldValue1,

        // Meta/Footer Notice
        footerNotice,
    } = attributes;

    return (
        <>
            {/* SIDEBAR CONFIGURATION INSPECTOR */}
            <InspectorControls>
                <PanelBody title={ __( 'Layout Strategy', 'dynamic-info-section' ) } initialOpen={ true }>
                    <SelectControl
                        label={ __( 'Display Mode', 'dynamic-info-section' ) }
                        value={ layoutType }
                        options={ [
                            { label: __( 'Two-Column Grid', 'dynamic-info-section' ), value: 'two-column' },
                            { label: __( 'Single Column (Stacked)', 'dynamic-info-section' ), value: 'stacked' },
                        ] }
                        onChange={ ( val ) => setAttributes( { layoutType: val } ) }
                    />

                    <ToggleControl
                        label={ __( 'Enable Secondary Section', 'dynamic-info-section' ) }
                        checked={ showSecondarySection }
                        onChange={ ( val ) => setAttributes( { showSecondarySection: val } ) }
                    />
                </PanelBody>

                {/* PRIMARY SECTION DETAILS (ALL 7 FIELDS) */}
                <PanelBody title={ __( 'Primary Section Details', 'dynamic-info-section' ) } initialOpen={ false }>
                    <TextControl
                        label={ __( 'Field 1 Label', 'dynamic-info-section' ) }
                        value={ primaryFieldLabel1 }
                        placeholder={ __( 'e.g., Director Name', 'dynamic-info-section' ) }
                        onChange={ ( val ) => setAttributes( { primaryFieldLabel1: val } ) }
                    />
                    <TextControl
                        label={ __( 'Field 1 Value', 'dynamic-info-section' ) }
                        value={ primaryFieldValue1 }
                        onChange={ ( val ) => setAttributes( { primaryFieldValue1: val } ) }
                    />

                    <TextControl
                        label={ __( 'Field 2 Label', 'dynamic-info-section' ) }
                        value={ primaryFieldLabel2 }
                        placeholder={ __( 'e.g., Director Title', 'dynamic-info-section' ) }
                        onChange={ ( val ) => setAttributes( { primaryFieldLabel2: val } ) }
                    />
                    <TextControl
                        label={ __( 'Field 2 Value', 'dynamic-info-section' ) }
                        value={ primaryFieldValue2 }
                        onChange={ ( val ) => setAttributes( { primaryFieldValue2: val } ) }
                    />

                    <TextControl
                        label={ __( 'Field 3 Label', 'dynamic-info-section' ) }
                        value={ primaryFieldLabel3 }
                        placeholder={ __( 'e.g., Organization', 'dynamic-info-section' ) }
                        onChange={ ( val ) => setAttributes( { primaryFieldLabel3: val } ) }
                    />
                    <TextControl
                        label={ __( 'Field 3 Value', 'dynamic-info-section' ) }
                        value={ primaryFieldValue3 }
                        onChange={ ( val ) => setAttributes( { primaryFieldValue3: val } ) }
                    />

                    <TextControl
                        label={ __( 'Field 4 Label', 'dynamic-info-section' ) }
                        value={ primaryFieldLabel4 }
                        placeholder={ __( 'e.g., Street Address', 'dynamic-info-section' ) }
                        onChange={ ( val ) => setAttributes( { primaryFieldLabel4: val } ) }
                    />
                    <TextControl
                        label={ __( 'Field 4 Value', 'dynamic-info-section' ) }
                        value={ primaryFieldValue4 }
                        onChange={ ( val ) => setAttributes( { primaryFieldValue4: val } ) }
                    />

                    <TextControl
                        label={ __( 'Field 5 Label', 'dynamic-info-section' ) }
                        value={ primaryFieldLabel5 }
                        placeholder={ __( 'e.g., City', 'dynamic-info-section' ) }
                        onChange={ ( val ) => setAttributes( { primaryFieldLabel5: val } ) }
                    />
                    <TextControl
                        label={ __( 'Field 5 Value', 'dynamic-info-section' ) }
                        value={ primaryFieldValue5 }
                        onChange={ ( val ) => setAttributes( { primaryFieldValue5: val } ) }
                    />

                    <TextControl
                        label={ __( 'Field 6 Label', 'dynamic-info-section' ) }
                        value={ primaryFieldLabel6 }
                        placeholder={ __( 'e.g., State', 'dynamic-info-section' ) }
                        onChange={ ( val ) => setAttributes( { primaryFieldLabel6: val } ) }
                    />
                    <TextControl
                        label={ __( 'Field 6 Value', 'dynamic-info-section' ) }
                        value={ primaryFieldValue6 }
                        onChange={ ( val ) => setAttributes( { primaryFieldValue6: val } ) }
                    />

                    <TextControl
                        label={ __( 'Field 7 Label', 'dynamic-info-section' ) }
                        value={ primaryFieldLabel7 }
                        placeholder={ __( 'e.g., Zip Code', 'dynamic-info-section' ) }
                        onChange={ ( val ) => setAttributes( { primaryFieldLabel7: val } ) }
                    />
                    <TextControl
                        label={ __( 'Field 7 Value', 'dynamic-info-section' ) }
                        value={ primaryFieldValue7 }
                        onChange={ ( val ) => setAttributes( { primaryFieldValue7: val } ) }
                    />
                </PanelBody>

                {/* SECONDARY SECTION DETAILS */}
                { showSecondarySection && (
                    <PanelBody title={ __( 'Secondary Section Details', 'dynamic-info-section' ) } initialOpen={ false }>
                        <TextControl
                            label={ __( 'Field Label', 'dynamic-info-section' ) }
                            value={ secondaryFieldLabel1 }
                            placeholder={ __( 'e.g., Phone Number', 'dynamic-info-section' ) }
                            onChange={ ( val ) => setAttributes( { secondaryFieldLabel1: val } ) }
                        />
                        <TextControl
                            label={ __( 'Field Value', 'dynamic-info-section' ) }
                            value={ secondaryFieldValue1 }
                            onChange={ ( val ) => setAttributes( { secondaryFieldValue1: val } ) }
                        />
                    </PanelBody>
                ) }

                {/* FOOTER NOTICE */}
                <PanelBody title={ __( 'Footer Note', 'dynamic-info-section' ) } initialOpen={ false }>
                    <TextControl
                        label={ __( 'Footer Subtext', 'dynamic-info-section' ) }
                        value={ footerNotice }
                        placeholder={ __( 'e.g., Changes saved automatically.', 'dynamic-info-section' ) }
                        onChange={ ( val ) => setAttributes( { footerNotice: val } ) }
                    />
                </PanelBody>
            </InspectorControls>

            {/* EDITOR WORKSPACE CANVAS */}
            <div { ...useBlockProps( { className: `as-hero-editor-container layout-${ layoutType }` } ) }>
                <div className="as-hero-editor-grid">
                    
                    {/* PRIMARY CONTENT COLUMN */}
                    <div className="as-hero-content-col">
                        <textarea
                            className="as-inline-title"
                            value={ primaryTitle }
                            placeholder={ __( 'Primary Section Title...', 'dynamic-info-section' ) }
                            rows={ 1 }
                            onChange={ ( e ) => setAttributes( { primaryTitle: e.target.value } ) }
                        />

                        <textarea
                            className="as-inline-description"
                            value={ primaryDescription }
                            placeholder={ __( 'Enter primary section description narrative...', 'dynamic-info-section' ) }
                            rows={ 3 }
                            onChange={ ( e ) => setAttributes( { primaryDescription: e.target.value } ) }
                        />

                        {/* Verification / Dynamic Metadata Sub-card */}
                        <div className="as-editor-verification-box">
                            <span className="dashicons dashicons-id"></span>
                            <div>
                                { primaryFieldLabel1 && <p><strong>{ primaryFieldLabel1 }:</strong> { primaryFieldValue1 || '—' }</p> }
                                { primaryFieldLabel2 && <p><strong>{ primaryFieldLabel2 }:</strong> { primaryFieldValue2 || '—' }</p> }
                                { primaryFieldLabel3 && <p><strong>{ primaryFieldLabel3 }:</strong> { primaryFieldValue3 || '—' }</p> }
                                { primaryFieldLabel4 && <p><strong>{ primaryFieldLabel4 }:</strong> { primaryFieldValue4 || '—' }</p> }
                                { ( primaryFieldLabel5 || primaryFieldLabel6 || primaryFieldLabel7 ) && (
                                    <p>
                                        { primaryFieldLabel5 ? `${ primaryFieldLabel5 }: ${ primaryFieldValue5 || '—' } ` : '' }
                                        { primaryFieldLabel6 ? `${ primaryFieldLabel6 }: ${ primaryFieldValue6 || '—' } ` : '' }
                                        { primaryFieldLabel7 ? `${ primaryFieldLabel7 }: ${ primaryFieldValue7 || '—' }` : '' }
                                    </p>
                                ) }
                            </div>
                        </div>
                    </div>

                    {/* SECONDARY CONTENT COLUMN */}
                    { showSecondarySection && (
                        <div className="as-hero-content-col">
                            <textarea
                                className="as-inline-title"
                                value={ secondaryTitle }
                                placeholder={ __( 'Secondary Section Title...', 'dynamic-info-section' ) }
                                rows={ 1 }
                                onChange={ ( e ) => setAttributes( { secondaryTitle: e.target.value } ) }
                            />

                            <textarea
                                className="as-inline-description"
                                value={ secondaryDescription }
                                placeholder={ __( 'Enter secondary section description narrative...', 'dynamic-info-section' ) }
                                rows={ 3 }
                                onChange={ ( e ) => setAttributes( { secondaryDescription: e.target.value } ) }
                            />

                            { secondaryFieldLabel1 && (
                                <div className="as-editor-verification-box">
                                    <span className="dashicons dashicons-phone"></span>
                                    <div>
                                        <p><strong>{ secondaryFieldLabel1 }:</strong> { secondaryFieldValue1 || '—' }</p>
                                    </div>
                                </div>
                            ) }
                        </div>
                    ) }

                </div>

                {/* FOOTER NOTICE BAR */}
                { footerNotice && (
                    <div className="as-editor-footer-notice">
                        <small>{ footerNotice }</small>
                    </div>
                ) }
            </div>
        </>
    );
}