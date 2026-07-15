import { __ } from '@wordpress/i18n';
import { InspectorControls, MediaUpload, RichText, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, Button, TextControl } from '@wordpress/components'; // TextControl is safe to use here

export default function Edit({ attributes, setAttributes }) {
    const {
        headline,
        description,
        btn1Text,
        btn1Url,
        btn2Text,
        btn2Url,
        directorName,
        directorTitle,
        directorRegions,
        directorPhone,
        directorImageUrl,
        directorImageId
    } = attributes;

    const blockProps = useBlockProps({
        className: 'p-8 bg-slate-50 border border-slate-200 rounded-2xl max-w-6xl mx-auto my-8 relative'
    });

    return (
        <div {...blockProps}>
            {/* Sidebar Controls */}
            <InspectorControls>
                <PanelBody title="Action Settings" initialOpen={true}>
                    <TextControl
                        label="Button 1 URL"
                        value={btn1Url}
                        onChange={(val) => setAttributes({ btn1Url: val })}
                    />
                    <TextControl
                        label="Button 2 URL"
                        value={btn2Url}
                        onChange={(val) => setAttributes({ btn2Url: val })}
                    />
                </PanelBody>
                <PanelBody title="Director Media" initialOpen={true}>
                    <MediaUpload
                        onSelect={(media) => setAttributes({ directorImageUrl: media.url, directorImageId: media.id })}
                        allowedTypes={['image']}
                        value={attributes.directorImageId}
                        render={({ open }) => (
                            <Button isSecondary onClick={open} style={{ width: '100%', justifyContent: 'center' }}>
                                Change Portrait Photo
                            </Button>
                        )}
                    />
                </PanelBody>
            </InspectorControls>

            {/* Canvas Block Work Area */}
            <div style={{ display: 'grid', gridTemplateColumns: '1.2fr 1fr', gap: '40px', alignItems: 'center', padding: '40px 24px', background: '#f5f5f5', border: '1px solid #5e5d5d', borderRadius: '12px', }}>
                {/* Top Status Header Badge */}
                    <div style={{ 
                        display: 'flex', 
                        justifyContent: 'between', 
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
                        <span>{__('CTA Contact Card Section', 'cta-contact-card-section')}</span>
                    </div>
                {/* Left Side: Call to Action Inputs */}
                <div style={{ padding: '16px', border: '1px dashed #cbd5e1', borderRadius: '12px', background: '#ffffff' }}>
                    <span style={{ textTransform: 'uppercase', fontSize: '11px', fontWeight: 'bold', color: '#004e8b', display: 'block', marginBottom: '8px' }}>
                        Call to Action Text
                    </span>
                    <RichText
                        tagName="h2"
                        value={headline}
                        onChange={(val) => setAttributes({ headline: val })}
                        style={{ fontSize: '28px', fontWeight: '800', color: '#004e8b', margin: '0 0 12px 0', lineHeight: '1.2' }}
                        placeholder="Enter Section Headline..."
                        allowedFormats={[]}
                    />
                    <RichText
                        tagName="p"
                        value={description}
                        onChange={(val) => setAttributes({ description: val })}
                        style={{ fontSize: '15px', color: '#475569', margin: '0 0 20px 0', lineHeight: '1.5' }}
                        placeholder="Enter block description Context..."
                    />
                    
                    {/* Inline Editable Button Mockups */}
                    <div style={{ display: 'flex', gap: '12px' }}>
                        <div style={{ background: '#004e8b', color: '#fff', borderRadius: '9999px', padding: '10px 20px', fontSize: '13px', fontWeight: 'bold' }}>
                            <RichText
                                tagName="span"
                                value={btn1Text}
                                onChange={(val) => setAttributes({ btn1Text: val })}
                                placeholder="Button 1"
                                allowedFormats={[]}
                            />
                        </div>
                        <div style={{ border: '2px solid #cbd5e1', color: '#475569', borderRadius: '9999px', padding: '8px 20px', fontSize: '13px', fontWeight: 'bold' }}>
                            <RichText
                                tagName="span"
                                value={btn2Text}
                                onChange={(val) => setAttributes({ btn2Text: val })}
                                placeholder="Button 2"
                                allowedFormats={[]}
                            />
                        </div>
                    </div>
                </div>

                {/* Right Side: Director Card Inputs */}
                <div style={{ background: '#ffffff', padding: '24px', borderRadius: '16px', border: '1px dashed #cbd5e1', borderLeft: '6px solid #bb0014' }}>
                    <span style={{ textTransform: 'uppercase', fontSize: '11px', fontWeight: 'bold', color: '#bb0014', display: 'block', marginBottom: '16px' }}>
                        Director Contact Box
                    </span>
                    <div style={{ display: 'flex', gap: '16px', alignItems: 'flex-start' }}>
                        
                        {/* Interactive Image Placeholder */}
                        <div style={{ width: '80px', height: '80px', borderRadius: '50%', overflow: 'hidden', background: '#f1f5f9', border: '1px solid #e2e8f0', flexShrink: 0 }}>
                            {directorImageUrl ? (
                                <img src={directorImageUrl} style={{ width: '100%', height: '100%', objectFit: 'cover' }} alt="" />
                            ) : (
                                <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'center', height: '100%', color: '#94a3b8', fontSize: '10px' }}>No Photo</div>
                            )}
                        </div>

                        {/* Inline Profile Fields */}
                        <div style={{ flexGrow: 1 }}>
                            <RichText
                                tagName="h4"
                                value={directorName}
                                onChange={(val) => setAttributes({ directorName: val })}
                                style={{ fontSize: '18px', fontWeight: 'bold', color: '#1e293b', margin: '0 0 4px 0' }}
                                placeholder="Director Name"
                                allowedFormats={[]}
                            />
                            <RichText
                                tagName="p"
                                value={directorTitle}
                                onChange={(val) => setAttributes({ directorTitle: val })}
                                style={{ fontSize: '11px', color: '#bb0014', fontWeight: '600', textTransform: 'uppercase', letterSpacing: '0.5px', margin: '0 0 12px 0', lineHeight: '1.4' }}
                                placeholder="Position Title"
                                allowedFormats={[]}
                            />
                            
                            <div style={{ display: 'flex', flexDirection: 'column', gap: '8px', fontSize: '13px', color: '#4a5568' }}>
                                <div style={{ display: 'flex', alignItems: 'center', gap: '8px' }}>
                                    <span>📍</span>
                                    <RichText
                                        tagName="span"
                                        value={directorRegions}
                                        onChange={(val) => setAttributes({ directorRegions: val })}
                                        placeholder="Regions served..."
                                        allowedFormats={[]}
                                        style={{ width: '100%' }}
                                    />
                                </div>
                                <div style={{ display: 'flex', alignItems: 'center', gap: '8px', fontWeight: 'bold' }}>
                                    <span>📞</span>
                                    <RichText
                                        tagName="span"
                                        value={directorPhone}
                                        onChange={(val) => setAttributes({ directorPhone: val })}
                                        placeholder="Phone Number"
                                        allowedFormats={[]}
                                        style={{ width: '100%' }}
                                    />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    );
}