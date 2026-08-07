import { __ } from '@wordpress/i18n';
import { InspectorControls, RichText, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
    const {
        sectionTitle,
        step1Number,
        step1Label,
        step2Number,
        step2Label,
        step3Number,
        step3Label
    } = attributes;

    const blockProps = useBlockProps({
        className: 'p-8 bg-slate-50 border border-slate-200 rounded-2xl max-w-6xl mx-auto my-8 relative'
    });

    return (
        <div {...blockProps}>
            <InspectorControls>
                <PanelBody title={__('Step Numbers', 'journey-forward-section')} initialOpen={true}>
                    <TextControl
                        label={__('Step 1 Number', 'journey-forward-section')}
                        value={step1Number}
                        onChange={(val) => setAttributes({ step1Number: val })}
                    />
                    <TextControl
                        label={__('Step 2 Number', 'journey-forward-section')}
                        value={step2Number}
                        onChange={(val) => setAttributes({ step2Number: val })}
                    />
                    <TextControl
                        label={__('Step 3 Number', 'journey-forward-section')}
                        value={step3Number}
                        onChange={(val) => setAttributes({ step3Number: val })}
                    />
                </PanelBody>
            </InspectorControls>

            <div style={{ background: '#f5f5f5', border: '1px solid #5e5d5d', borderRadius: '12px', padding: '32px 24px' }}>
                <div style={{ 
                    display: 'flex', 
                    justifyContent: 'space-between', 
                    alignItems: 'center',
                    fontSize: '10px', 
                    color: '#999', 
                    fontWeight: 'bold', 
                    letterSpacing: '1.5px', 
                    textTransform: 'uppercase', 
                    marginBottom: '24px', 
                    borderBottom: '1px solid #eee', 
                    paddingBottom: '8px' 
                }}>
                    <span>{__('Journey Forward Section', 'journey-forward-section')}</span>
                </div>

                {/* Main Headline */}
                <div style={{ textCenter: 'center', marginBottom: '32px', textAlign: 'center' }}>
                    <RichText
                        tagName="h2"
                        value={sectionTitle}
                        onChange={(val) => setAttributes({ sectionTitle: val })}
                        style={{ fontSize: '32px', fontWeight: '900', color: '#004e8b', margin: '0' }}
                        placeholder={__('Enter Section Title...', 'journey-forward-section')}
                        allowedFormats={[]}
                    />
                </div>

                {/* 3 Step Cards Layout */}
                <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '16px', flexWrap: 'wrap' }}>
                    
                    {/* Step 1 Card */}
                    <div style={{ background: '#004e8b', color: '#ffffff', border: '1px dashed #cbd5e1', borderRadius: '16px', width: '220px', padding: '20px', textAlign: 'center' }}>
                        <RichText
                            tagName="span"
                            value={step1Number}
                            onChange={(val) => setAttributes({ step1Number: val })}
                            style={{ display: 'block', fontSize: '32px', fontWeight: '900', marginBottom: '4px' }}
                            allowedFormats={[]}
                        />
                        <RichText
                            tagName="span"
                            value={step1Label}
                            onChange={(val) => setAttributes({ step1Label: val })}
                            style={{ display: 'block', fontSize: '12px', fontWeight: 'bold', textTransform: 'uppercase', letterSpacing: '1px' }}
                            placeholder={__('Step 1 Label', 'journey-forward-section')}
                            allowedFormats={[]}
                        />
                    </div>

                    <div style={{ width: '32px', height: '8px', background: '#cbd5e1', borderRadius: '9999px' }}></div>

                    {/* Step 2 Card */}
                    <div style={{ background: '#bb0014', color: '#ffffff', border: '1px dashed #cbd5e1', borderRadius: '16px', width: '220px', padding: '20px', textAlign: 'center' }}>
                        <RichText
                            tagName="span"
                            value={step2Number}
                            onChange={(val) => setAttributes({ step2Number: val })}
                            style={{ display: 'block', fontSize: '32px', fontWeight: '900', marginBottom: '4px' }}
                            allowedFormats={[]}
                        />
                        <RichText
                            tagName="span"
                            value={step2Label}
                            onChange={(val) => setAttributes({ step2Label: val })}
                            style={{ display: 'block', fontSize: '12px', fontWeight: 'bold', textTransform: 'uppercase', letterSpacing: '1px' }}
                            placeholder={__('Step 2 Label', 'journey-forward-section')}
                            allowedFormats={[]}
                        />
                    </div>

                    <div style={{ width: '32px', height: '8px', background: '#cbd5e1', borderRadius: '9999px' }}></div>

                    {/* Step 3 Card */}
                    <div style={{ background: '#eab308', color: '#1e293b', border: '1px dashed #cbd5e1', borderRadius: '16px', width: '220px', padding: '20px', textAlign: 'center' }}>
                        <RichText
                            tagName="span"
                            value={step3Number}
                            onChange={(val) => setAttributes({ step3Number: val })}
                            style={{ display: 'block', fontSize: '32px', fontWeight: '900', marginBottom: '4px' }}
                            allowedFormats={[]}
                        />
                        <RichText
                            tagName="span"
                            value={step3Label}
                            onChange={(val) => setAttributes({ step3Label: val })}
                            style={{ display: 'block', fontSize: '12px', fontWeight: 'bold', textTransform: 'uppercase', letterSpacing: '1px' }}
                            placeholder={__('Step 3 Label', 'journey-forward-section')}
                            allowedFormats={[]}
                        />
                    </div>

                </div>
            </div>
        </div>
    );
}