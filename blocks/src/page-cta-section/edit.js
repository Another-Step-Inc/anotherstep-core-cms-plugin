import { __ } from '@wordpress/i18n';
import { 
    useBlockProps, 
    InspectorControls 
} from '@wordpress/block-editor';
import { 
    PanelBody, 
    SelectControl, 
    ToggleControl, 
    TextControl,
    TextareaControl 
} from '@wordpress/components';

import './editor.scss';

export default function Edit( props ) {
    const {
        ctaTitle,
        ctaDescription,
        ctaStyle,
        btn1Text,
        btn1Url,
        btn1Style,
        btn2Text,
        btn2Url,
        hasSteps,
        step1Text,
        step2Text,
        step3Text,
        hasCard,
        cardTitle,
        cardDescription,
        cardBtnText,
        cardBtnUrl,
        hasStats,
        stat1Number,
        stat1Label,
        stat2Number,
        stat2Label
    } = props.attributes;

    return (
        <>
            <InspectorControls>
                <PanelBody title={__( 'Layout & Preset Settings', 'page-cta-section' )} initialOpen={true}>
                    <SelectControl
                        label={__( 'CTA Preset Style', 'page-cta-section' )}
                        value={ctaStyle}
                        options={[
                            { label: 'Centered Box (About Page Style)', value: 'centered' },
                            { label: 'Two-Column Step Process (Services Style)', value: 'split-steps' },
                            { label: 'Full Width Edge-to-Edge (Contact & Gallery Style)', value: 'full-width' },
                            { label: 'Banner Overlay', value: 'banner' },
                        ]}
                        onChange={(val) => props.setAttributes({ ctaStyle: val })}
                    />
                    <ToggleControl
                        label={__( 'Enable 3-Step Process List', 'page-cta-section' )}
                        checked={hasSteps}
                        onChange={(val) => props.setAttributes({ hasSteps: val })}
                    />
                    <ToggleControl
                        label={__( 'Enable Floating Action Card', 'page-cta-section' )}
                        checked={hasCard}
                        onChange={(val) => props.setAttributes({ hasCard: val })}
                    />
                    <ToggleControl
                        label={__( 'Enable Impact Stats Cards', 'page-cta-section' )}
                        checked={hasStats}
                        onChange={(val) => props.setAttributes({ hasStats: val })}
                    />
                </PanelBody>

                <PanelBody title={__( 'Button Configuration', 'page-cta-section' )} initialOpen={false}>
                    <SelectControl
                        label={__( 'Primary Button Color Theme', 'page-cta-section' )}
                        value={btn1Style}
                        options={[
                            { label: 'Brand Yellow Accent', value: 'yellow' },
                            { label: 'Solid White', value: 'white' },
                            { label: 'Brand Red', value: 'red' },
                        ]}
                        onChange={(val) => props.setAttributes({ btn1Style: val })}
                    />
                    <TextControl
                        label={__( 'Primary Button Link URL', 'page-cta-section' )}
                        value={btn1Url}
                        onChange={(val) => props.setAttributes({ btn1Url: val })}
                    />
                    <TextControl
                        label={__( 'Secondary Button Link URL', 'page-cta-section' )}
                        value={btn2Url}
                        onChange={(val) => props.setAttributes({ btn2Url: val })}
                    />
                </PanelBody>

                {hasSteps && (
                    <PanelBody title={__( 'Process Steps Data', 'page-cta-section' )} initialOpen={false}>
                        <TextControl
                            label={__( 'Step 01 Title', 'page-cta-section' )}
                            value={step1Text}
                            onChange={(val) => props.setAttributes({ step1Text: val })}
                        />
                        <TextControl
                            label={__( 'Step 02 Title', 'page-cta-section' )}
                            value={step2Text}
                            onChange={(val) => props.setAttributes({ step2Text: val })}
                        />
                        <TextControl
                            label={__( 'Step 03 Title', 'page-cta-section' )}
                            value={step3Text}
                            onChange={(val) => props.setAttributes({ step3Text: val })}
                        />
                    </PanelBody>
                )}

                {hasCard && (
                    <PanelBody title={__( 'Floating Card Settings', 'page-cta-section' )} initialOpen={false}>
                        <TextControl
                            label={__( 'Card Title', 'page-cta-section' )}
                            value={cardTitle}
                            onChange={(val) => props.setAttributes({ cardTitle: val })}
                        />
                        <TextareaControl
                            label={__( 'Card Description', 'page-cta-section' )}
                            value={cardDescription}
                            onChange={(val) => props.setAttributes({ cardDescription: val })}
                        />
                        <TextControl
                            label={__( 'Card Button Label', 'page-cta-section' )}
                            value={cardBtnText}
                            onChange={(val) => props.setAttributes({ cardBtnText: val })}
                        />
                        <TextControl
                            label={__( 'Card Button Link URL', 'page-cta-section' )}
                            value={cardBtnUrl}
                            onChange={(val) => props.setAttributes({ cardBtnUrl: val })}
                        />
                    </PanelBody>
                )}

                {hasStats && (
                    <PanelBody title={__( 'Impact Stats Data', 'page-cta-section' )} initialOpen={false}>
                        <TextControl
                            label={__( 'Stat 1 Value', 'page-cta-section' )}
                            value={stat1Number}
                            onChange={(val) => props.setAttributes({ stat1Number: val })}
                        />
                        <TextControl
                            label={__( 'Stat 1 Label', 'page-cta-section' )}
                            value={stat1Label}
                            onChange={(val) => props.setAttributes({ stat1Label: val })}
                        />
                        <TextControl
                            label={__( 'Stat 2 Value', 'page-cta-section' )}
                            value={stat2Number}
                            onChange={(val) => props.setAttributes({ stat2Number: val })}
                        />
                        <TextControl
                            label={__( 'Stat 2 Label', 'page-cta-section' )}
                            value={stat2Label}
                            onChange={(val) => props.setAttributes({ stat2Label: val })}
                        />
                    </PanelBody>
                )}
            </InspectorControls>

            <div { ...useBlockProps( { className: `as-cta-editor-container style-${ctaStyle}` } ) }>
                <div className="as-cta-editor-inner">
                    <TextareaControl
                        className="as-inline-cta-title"
                        value={ctaTitle}
                        placeholder={__( 'Enter CTA Heading Title...', 'page-cta-section' )}
                        onChange={(val) => props.setAttributes({ ctaTitle: val })}
                    />
                    
                    <TextareaControl
                        className="as-inline-cta-desc"
                        value={ctaDescription}
                        placeholder={__( 'Enter description or subtext narrative...', 'page-cta-section' )}
                        onChange={(val) => props.setAttributes({ ctaDescription: val })}
                    />

                    <div className="as-cta-buttons-mock">
                        <div className="as-btn-input primary">
                            <input
                                type="text"
                                placeholder={__( 'Primary Button Text', 'page-cta-section' )}
                                value={btn1Text}
                                onChange={(e) => props.setAttributes({ btn1Text: e.target.value })}
                            />
                        </div>
                        <div className="as-btn-input secondary">
                            <input
                                type="text"
                                placeholder={__( 'Secondary Button Text', 'page-cta-section' )}
                                value={btn2Text}
                                onChange={(e) => props.setAttributes({ btn2Text: e.target.value })}
                            />
                        </div>
                    </div>

                    {hasSteps && (
                        <div className="as-cta-steps-mock">
                            <div>1. {step1Text}</div>
                            <div>2. {step2Text}</div>
                            <div>3. {step3Text}</div>
                        </div>
                    )}
                </div>
            </div>
        </>
    );
}