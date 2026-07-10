import { __ } from '@wordpress/i18n';
import { 
    useBlockProps, 
    MediaUpload, 
    MediaUploadCheck, 
    InspectorControls,
    RichText
} from '@wordpress/block-editor';
import { 
    PanelBody, 
    SelectControl, 
    ToggleControl, 
    TextControl, 
    Button 
} from '@wordpress/components';

import './editor.scss';

export default function Edit(props) {
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

    const onSelectImage = (media) => {
        props.setAttributes({
            heroImageId: media.id,
            heroImageUrl: media.url,
        });
    };

    return (
        <>
            {/* INSPECTOR SIDEBAR CONTROLS */}
            <InspectorControls>
                <PanelBody title={__('Design & Layout Strategy', 'page-hero-section')} initialOpen={true}>
                    <SelectControl
                        label={__('Structural Mode', 'page-hero-section')}
                        value={layoutType}
                        options={[
                            { label: 'Split Layout (Text Left / Image Right)', value: 'split' },
                            { label: 'Background Image Layout', value: 'background' },
                        ]}
                        onChange={(val) => props.setAttributes({ layoutType: val })}
                    />

                    <SelectControl
                        label={__('Image Mask & Background Decorations', 'page-hero-section')}
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
                        label={__('Enable Top Accent Badge', 'page-hero-section')}
                        checked={hasBadge}
                        onChange={(val) => props.setAttributes({ hasBadge: val })}
                    />

                    <ToggleControl
                        label={__('Enable Verification Badge (Extra Text Div)', 'page-hero-section')}
                        checked={hasExtraTextDiv}
                        onChange={(val) => props.setAttributes({ hasExtraTextDiv: val })}
                    />

                    {layoutType === 'split' && (
                        <ToggleControl
                            label={__('Enlarge Image Sizing Layout', 'page-hero-section')}
                            checked={isImageLarge}
                            onChange={(val) => props.setAttributes({ isImageLarge: val })}
                        />
                    )}
                </PanelBody>

                {hasBadge && (
                    <PanelBody title={__('Badge Style Options', 'page-hero-section')} initialOpen={false}>
                        <SelectControl
                            label={__('Badge Visual Theme Style', 'page-hero-section')}
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
                    <PanelBody title={__('Verification Badge Utilities', 'page-hero-section')} initialOpen={false}>
                        <TextControl
                            label={__('Material Icon Key', 'page-hero-section')}
                            value={extraDivIcon}
                            placeholder="verified"
                            onChange={(val) => props.setAttributes({ extraDivIcon: val })}
                        />
                        <TextControl
                            label={__('Icon Color Utility', 'page-hero-section')}
                            value={extraDivIconColor}
                            placeholder="brand-red"
                            onChange={(val) => props.setAttributes({ extraDivIconColor: val })}
                        />
                        <TextControl
                            label={__('Container Background Utility', 'page-hero-section')}
                            value={extraDivBgColor}
                            placeholder="surface-container-low"
                            onChange={(val) => props.setAttributes({ extraDivBgColor: val })}
                        />
                    </PanelBody>
                )}

                {imageDecoration === 'bubble-text' && (
                    <PanelBody title={__('Stats Graphic Options', 'page-hero-section')} initialOpen={false}>
                        <SelectControl
                            label={__('Bubble Background', 'page-hero-section')}
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
                            label={__('Bubble Typography Color', 'page-hero-section')}
                            value={statsTextColor}
                            options={[
                                { label: 'Charcoal Dark Text', value: 'on-surface' },
                                { label: 'Crisp White Text', value: 'white' },
                                { label: 'Brand Red Text', value: 'brand-red' },
                            ]}
                            onChange={(val) => props.setAttributes({ statsTextColor: val })}
                        />
                        <ToggleControl
                            label={__('Apply Rotation Effects', 'page-hero-section')}
                            checked={isStatsRotated !== false}
                            onChange={(val) => props.setAttributes({ isStatsRotated: val })}
                        />
                    </PanelBody>
                )}

                <PanelBody title={__('Button Links (URLs)', 'page-hero-section')} initialOpen={false}>
                    <TextControl
                        label={__('Primary Button URL', 'page-hero-section')}
                        value={btn1Url}
                        placeholder="/donate"
                        onChange={(val) => props.setAttributes({ btn1Url: val })}
                    />
                    <TextControl
                        label={__('Secondary Button URL', 'page-hero-section')}
                        value={btn2Url}
                        placeholder="/about"
                        onChange={(val) => props.setAttributes({ btn2Url: val })}
                    />
                </PanelBody>
            </InspectorControls>

            {/* FULLY RENDERED HERO PREVIEW CANVAS */}
            <div {...useBlockProps({ 
                className: `as-hero-live-preview mode-${layoutType} size-${isImageLarge ? 'large' : 'normal'}` 
            })}>
                
                {/* BACKGROUND MODE UNDERLAY */}
                {layoutType === 'background' && heroImageUrl && (
                    <div className="as-hero-bg-underlay">
                        <img src={heroImageUrl} alt="" />
                        <div className={`as-hero-bg-mask decoration-${imageDecoration}`}></div>
                    </div>
                )}

                <div className="as-hero-container-grid">
                    
                    {/* LEFT / MAIN TEXT CONTENT */}
                    <div className="as-hero-text-content">
                        {hasBadge && (
                            <RichText
                                tagName="span"
                                className={`as-hero-badge-preview theme-${badgeStyle}`}
                                value={badgeText}
                                onChange={(val) => props.setAttributes({ badgeText: val })}
                                placeholder={__('Accent Badge Label', 'page-hero-section')}
                                allowedFormats={[]}
                            />
                        )}

                        <RichText
                            tagName="h1"
                            className="as-hero-title-preview"
                            value={heroTitle}
                            onChange={(val) => props.setAttributes({ heroTitle: val })}
                            placeholder={__('Enter Hero Main Heading', 'page-hero-section')}
                            allowedFormats={['core/bold', 'core/italic']}
                        />

                        <RichText
                            tagName="p"
                            className="as-hero-desc-preview"
                            value={heroDescription}
                            onChange={(val) => props.setAttributes({ heroDescription: val })}
                            placeholder={__('Enter body paragraph content narrative here...', 'page-hero-section')}
                        />

                        <div className="as-hero-buttons-preview">
                            <RichText
                                tagName="div"
                                className="as-hero-btn btn-primary"
                                value={btn1Text}
                                onChange={(val) => props.setAttributes({ btn1Text: val })}
                                placeholder={__('Primary Button', 'page-hero-section')}
                                allowedFormats={[]}
                            />
                            <RichText
                                tagName="div"
                                className="as-hero-btn btn-secondary"
                                value={btn2Text}
                                onChange={(val) => props.setAttributes({ btn2Text: val })}
                                placeholder={__('Secondary Link', 'page-hero-section')}
                                allowedFormats={[]}
                            />
                        </div>

                        {hasExtraTextDiv && (
                            <div className={`as-hero-verification-preview bg-${extraDivBgColor}`}>
                                <span className={`material-symbols-outlined icon-${extraDivIconColor}`}>
                                    {extraDivIcon || 'verified_user'}
                                </span>
                                <RichText
                                    tagName="span"
                                    value={extraDivText}
                                    onChange={(val) => props.setAttributes({ extraDivText: val })}
                                    placeholder={__('Verification badge text...', 'page-hero-section')}
                                    allowedFormats={[]}
                                />
                            </div>
                        )}
                    </div>

                    {/* RIGHT SIDE MEDIA ENGINE (SPLIT EXCLUSIVE) */}
                    {layoutType === 'split' && (
                        <div className={`as-hero-media-content decoration-${imageDecoration}`}>
                            <div className="as-media-wrapper-layers">
                                {imageDecoration === 'yellow-box' && <div className="layer-yellow-box"></div>}
                                {imageDecoration === 'hover-frame' && <div className="layer-hover-frame"></div>}
                                {imageDecoration === 'organic-blur' && <div className="layer-organic-blur"></div>}

                                <MediaUploadCheck>
                                    <MediaUpload
                                        onSelect={onSelectImage}
                                        allowedTypes={['image']}
                                        value={heroImageId}
                                        render={({ open }) => (
                                            <div className="as-media-canvas-frame" onClick={open}>
                                                {heroImageUrl ? (
                                                    <img src={heroImageUrl} alt="" />
                                                ) : (
                                                    <div className="as-media-placeholder">
                                                        <span className="dashicons dashicons-images-alt2"></span>
                                                        <span>Click to Assign Hero Image</span>
                                                    </div>
                                                )}
                                            </div>
                                        )}
                                    />
                                </MediaUploadCheck>

                                {/* FLOATING STAT BOX OVERLAY */}
                                {imageDecoration === 'bubble-text' && (
                                    <div className={`as-floating-stat-box ${isStatsRotated ? 'rotated' : ''} bg-${statsBgColor}`}>
                                        <RichText
                                            tagName="div"
                                            className={`stat-big-num text-${statsTextColor}`}
                                            value={statsNumber}
                                            onChange={(val) => props.setAttributes({ statsNumber: val })}
                                            placeholder="100%"
                                            allowedFormats={[]}
                                        />
                                        <RichText
                                            tagName="div"
                                            className="stat-sub-label"
                                            value={statsText}
                                            onChange={(val) => props.setAttributes({ statsText: val })}
                                            placeholder="Stat description"
                                            allowedFormats={[]}
                                        />
                                    </div>
                                )}

                                {/* FLOATING TESTIMONIAL QUOTE OVERLAY */}
                                {imageDecoration === 'quote-bubble' && (
                                    <div className="as-floating-quote-box">
                                        <RichText
                                            tagName="p"
                                            value={quoteText}
                                            onChange={(val) => props.setAttributes({ quoteText: val })}
                                            placeholder={__('"Quote narrative detail..."', 'page-hero-section')}
                                        />
                                    </div>
                                )}
                            </div>

                            {heroImageUrl && (
                                <Button isDestructive isLink className="as-remove-image-lnk" onClick={() => props.setAttributes({ heroImageId: 0, heroImageUrl: '' })}>
                                    {__('Remove Image Asset', 'page-hero-section')}
                                </Button>
                            )}
                        </div>
                    )}

                </div>
            </div>
        </>
    );
}