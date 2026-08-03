import { __ } from '@wordpress/i18n';
import { 
    useBlockProps, 
    MediaUpload, 
    MediaUploadCheck, 
    InspectorControls 
} from '@wordpress/block-editor';
import { 
    PanelBody, 
    SelectControl, 
    ToggleControl, 
    TextControl, 
    Button 
} from '@wordpress/components';

import './editor.scss';

export default function Edit( props ) {
    const {
        layoutType,
        imageDecoration,
        hasBadge,
        badgeText,
        badgeStyle,
        heroTitle,
        heroDescription,
        hasExtraTextDiv,
        extraDivText,
        extraDivIcon,
        extraDivIconColor,
        extraDivBgColor,
        statsNumber,
        statsText,
        statsBgColor,
        statsTextColor,
        quoteText,
        heroImageId,
        heroImageUrl,
        btn1Text,
        btn1Url,
        btn2Text,
        btn2Url,
        isImageLarge,
        isStatsRotated
    } = props.attributes;

    const onSelectImage = ( media ) => {
        props.setAttributes( {
            heroImageId: media.id,
            heroImageUrl: media.url,
        } );
    };

    return (
        <>
            {/* SIDEBAR CONFIGURATION INSPECTOR */}
            <InspectorControls>
                <PanelBody title={__( 'Design & Layout Strategy', 'page-hero-section' )} initialOpen={true}>
                    <SelectControl
                        label={__( 'Structural Mode', 'page-hero-section' )}
                        value={layoutType}
                        options={[
                            { label: 'Single Column (Text Above Text and No Image)', value: 'stacked' },
                            { label: 'Split Layout (Text Left / Image Right)', value: 'split' },
                            { label: 'Background Image Layout', value: 'background' },
                        ]}
                        onChange={(val) => props.setAttributes({ layoutType: val })}
                    />

                    <SelectControl
                        label={__( 'Image Mask & Background Decorations', 'page-hero-section' )}
                        value={imageDecoration}
                        options={[
                            { label: 'Plain Image (Sharp Corners)', value: 'none' },
                            { label: 'Organic Editorialism (Rounded + Ambient Color Blur)', value: 'organic-blur' },
                            { label: 'Gradient Overlay Mask', value: 'gradient-overlay' },
                            { label: 'Floating Stat Box (Overlay on bottom corner)', value: 'bubble-text' },
                            { label: 'Floating Testimonial Quote (Overlay on bottom corner)', value: 'quote-bubble' },
                            { label: 'Offset Background Card (Solid Yellow Block behind)', value: 'yellow-box' },
                            { label: 'Animated Frame (Rotated Underlay Card on Hover)', value: 'hover-frame' },
                        ]}
                        onChange={(val) => props.setAttributes({ imageDecoration: val })}
                    />

                    <ToggleControl
                        label={__( 'Enable Top Accent Badge', 'page-hero-section' )}
                        checked={hasBadge}
                        onChange={(val) => props.setAttributes({ hasBadge: val })}
                    />

                    <ToggleControl
                        label={__( 'Enable Verification Badge (Extra Text Div)', 'page-hero-section' )}
                        checked={hasExtraTextDiv}
                        onChange={(val) => props.setAttributes({ hasExtraTextDiv: val })}
                    />

                    {layoutType === 'split' && (
                        <ToggleControl
                            label={__( 'Enlarge Image Sizing Layout', 'page-hero-section' )}
                            checked={isImageLarge}
                            onChange={(val) => props.setAttributes({ isImageLarge: val })}
                        />
                    )}
                </PanelBody>

                {hasBadge && (
                    <PanelBody title={__( 'Badge Style Options', 'page-hero-section' )} initialOpen={false}>
                        <SelectControl
                            label={__( 'Badge Visual Theme Style', 'page-hero-section' )}
                            value={badgeStyle || 'pill-yellow'}
                            options={[
                                { label: 'Pill Shape (Solid Yellow / Dark Text)', value: 'pill-yellow' },
                                { label: 'Clean Text (Brand Blue Font Only)', value: 'text-blue' },
                                { label: 'Pill Shape (Solid Blue / Black Text)', value: 'pill-blue' },
                            ]}
                            onChange={(val) => props.setAttributes({ badgeStyle: val })}
                        />
                    </PanelBody>
                )}

                {hasExtraTextDiv && (
                    <PanelBody title={__( 'Verification Badge Utilities', 'page-hero-section' )} initialOpen={false}>
                        <TextControl
                            label={__( 'Material Icon Key', 'page-hero-section' )}
                            value={extraDivIcon}
                            placeholder="verified"
                            onChange={(val) => props.setAttributes({ extraDivIcon: val })}
                        />
                        <TextControl
                            label={__( 'Icon Color Utility', 'page-hero-section' )}
                            value={extraDivIconColor}
                            placeholder="text-brand-red"
                            onChange={(val) => props.setAttributes({ extraDivIconColor: val })}
                        />
                        <TextControl
                            label={__( 'Container Background Utility', 'page-hero-section' )}
                            value={extraDivBgColor}
                            placeholder="bg-surface-container-low"
                            onChange={(val) => props.setAttributes({ extraDivBgColor: val })}
                        />
                    </PanelBody>
                )}

                {imageDecoration === 'bubble-text' && (
                    <PanelBody title={__( 'Stats Graphic Options', 'page-hero-section' )} initialOpen={false}>
                        <SelectControl
                            label={__( 'Bubble Background', 'page-hero-section' )}
                            value={statsBgColor}
                            options={[
                                { label: 'Clean White', value: 'white' },
                                { label: 'Brand Red', value: 'brand-red' },
                                { label: 'Brand Blue', value: 'brand-blue' },
                                { label: 'Muted Grey', value: 'surface-container-high' },
                            ]}
                            onChange={(val) => props.setAttributes({ statsBgColor: val })}
                        />
                        <SelectControl
                            label={__( 'Bubble Typography Color', 'page-hero-section' )}
                            value={statsTextColor}
                            options={[
                                { label: 'Charcoal Dark Text', value: 'on-surface' },
                                { label: 'Crisp White Text', value: 'white' },
                                { label: 'Brand Red Text', value: 'brand-red' },
                            ]}
                            onChange={(val) => props.setAttributes({ statsTextColor: val })}
                        />
                        <ToggleControl
                            label={__( 'Apply Rotation Effects', 'page-hero-section' )}
                            checked={isStatsRotated !== false}
                            onChange={(val) => props.setAttributes({ isStatsRotated: val })}
                        />
                    </PanelBody>
                )}

                <PanelBody title={__( 'Button Link Targets (URLs)', 'page-hero-section' )} initialOpen={false}>
                    <TextControl
                        label={__( 'Primary Button URL', 'page-hero-section' )}
                        value={btn1Url}
                        placeholder="/services"
                        onChange={(val) => props.setAttributes({ btn1Url: val })}
                    />
                    <TextControl
                        label={__( 'Secondary Button URL', 'page-hero-section' )}
                        value={btn2Url}
                        placeholder="#"
                        onChange={(val) => props.setAttributes({ btn2Url: val })}
                    />
                </PanelBody>
            </InspectorControls>

            {/* HERO GRID WORKSPACE CANVASES */}
            <div { ...useBlockProps( { className: `as-hero-editor-container layout-${layoutType}` } ) }>
                <div className="as-hero-editor-grid">
                    
                    {/* TEXT CONTENT COLUMN */}
                    <div className="as-hero-content-col">
                        
                        {/* Top Accent Badge Row */}
                        { hasBadge && (
                            <div className="as-editor-badge-wrapper">
                                <input
                                    type="text"
                                    className={`as-inline-badge ${badgeStyle}`}
                                    value={ badgeText }
                                    placeholder="ACCENT BADGE TEXT..."
                                    onChange={ ( e ) => props.setAttributes( { badgeText: e.target.value } ) }
                                />
                            </div>
                        ) }

                        {/* Main Title Field */}
                        <textarea
                            className="as-inline-title"
                            value={ heroTitle }
                            placeholder="Enter Hero Title Narrative..."
                            rows={ 2 }
                            onChange={ ( e ) => props.setAttributes( { heroTitle: e.target.value } ) }
                        />

                        {/* Description Paragraph Field */}
                        <textarea
                            className="as-inline-description"
                            value={ heroDescription }
                            placeholder="Enter descriptive body copy paragraphs here..."
                            rows={ 3 }
                            onChange={ ( e ) => props.setAttributes( { heroDescription: e.target.value } ) }
                        />

                        {/* Call to Action Button Group Mockup */}
                        <div className="as-editor-btn-group">
                            <div className="as-btn-mock primary">
                                <input 
                                    type="text" 
                                    placeholder="Primary Action" 
                                    value={ btn1Text } 
                                    onChange={ ( e ) => props.setAttributes( { btn1Text: e.target.value } ) } 
                                />
                            </div>
                            <div className="as-btn-mock secondary">
                                <input 
                                    type="text" 
                                    placeholder="Secondary Link" 
                                    value={ btn2Text } 
                                    onChange={ ( e ) => props.setAttributes( { btn2Text: e.target.value } ) } 
                                />
                            </div>
                        </div>

                        {/* Verification / Extra Info Badge Module */}
                        { hasExtraTextDiv && (
                            <div className="as-editor-verification-box">
                                <span className="material-symbols-outlined">{ extraDivIcon || 'verified' }</span>
                                <input 
                                    type="text" 
                                    placeholder="Verification subtext..." 
                                    value={ extraDivText } 
                                    onChange={ ( e ) => props.setAttributes( { extraDivText: e.target.value } ) } 
                                />
                            </div>
                        ) }
                    </div>

                    {/* GRAPHIC MEDIA & DECORATIONS COLUMN */}
                    <div className={ `as-hero-media-col size-${ isImageLarge ? 'large' : 'normal' } decoration-${ imageDecoration }` }>
                        <MediaUploadCheck>
                            <MediaUpload
                                onSelect={ onSelectImage }
                                allowedTypes={ [ 'image' ] }
                                value={ heroImageId }
                                render={ ( { open } ) => (
                                    <div className="as-editor-image-frame" onClick={ open }>
                                        { heroImageUrl ? (
                                            <>
                                                <img src={ heroImageUrl } alt="Hero Preview" />
                                                <div className="as-image-overlay-actions">
                                                    <Button isSecondary onClick={ open }>Swap Image</Button>
                                                    <Button isDestructive onClick={ ( e ) => {
                                                        e.stopPropagation();
                                                        props.setAttributes( { heroImageId: 0, heroImageUrl: '' } );
                                                    } }>Remove</Button>
                                                </div>
                                            </>
                                        ) : (
                                            <div className="as-image-upload-prompt">
                                                <span className="dashicons dashicons-format-image"></span>
                                                <span>Assign Hero Asset</span>
                                            </div>
                                        ) }
                                    </div>
                                ) }
                            />
                        </MediaUploadCheck>

                        {/* Floating Statistics Overlay Box Preview */}
                        { imageDecoration === 'bubble-text' && (
                            <div className={`as-editor-floating-stat ${isStatsRotated ? 'rotated' : ''}`}>
                                <input 
                                    type="text" 
                                    placeholder="100%" 
                                    value={ statsNumber } 
                                    onChange={ ( e ) => props.setAttributes( { statsNumber: e.target.value } ) } 
                                />
                                <input 
                                    type="text" 
                                    placeholder="Stat subtext label" 
                                    value={ statsText } 
                                    onChange={ ( e ) => props.setAttributes( { statsText: e.target.value } ) } 
                                />
                            </div>
                        ) }

                        {/* Floating Testimonial Quote Overlay Box Preview */}
                        { imageDecoration === 'quote-bubble' && (
                            <div className="as-editor-floating-quote">
                                <textarea 
                                    placeholder="Enter overlay quote statement..." 
                                    value={ quoteText } 
                                    rows={ 2 }
                                    onChange={ ( e ) => props.setAttributes( { quoteText: e.target.value } ) } 
                                />
                            </div>
                        ) }
                    </div>

                </div>
            </div>
        </>
    );
}