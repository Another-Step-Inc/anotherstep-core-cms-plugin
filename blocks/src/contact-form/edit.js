import { __ } from '@wordpress/i18n';
import { RichText, useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
    const { title, subtitle, buttonText, endpointUrl } = attributes;

    const blockProps = useBlockProps({
        className: 'p-6 bg-white border border-slate-200 rounded-xl shadow-sm'
    });

    return (
        <>
            {/* Sidebar Controls for Form Settings */}
            <InspectorControls>
                <PanelBody title={__('Form Settings', 'anotherstep')} initialOpen={true}>
                    <TextControl
                        label={__('API / Action Endpoint URL', 'anotherstep')}
                        value={endpointUrl || ''}
                        onChange={(val) => setAttributes({ endpointUrl: val })}
                        help={__('Optional custom endpoint for form submissions (e.g., /wp-json/anotherstep/v1/contact).', 'anotherstep')}
                    />
                </PanelBody>
            </InspectorControls>

            <div {...blockProps}>
                <div style={{ fontSize: '10px', color: '#999', fontWeight: 'bold', letterSpacing: '1px', textTransform: 'uppercase', marginBottom: '12px' }}>
                    {__('Contact Form Component', 'anotherstep')}
                </div>

                {/* Editable Title & Subtitle */}
                <RichText
                    tagName="h2"
                    value={title}
                    onChange={(val) => setAttributes({ title: val })}
                    style={{ fontSize: '24px', fontWeight: 'bold', color: '#0055b8', marginBottom: '4px' }}
                    placeholder={__('Form Title (e.g. Send a Message)...', 'anotherstep')}
                />
                <RichText
                    tagName="p"
                    value={subtitle}
                    onChange={(val) => setAttributes({ subtitle: val })}
                    style={{ fontSize: '14px', color: '#64748b', marginBottom: '20px' }}
                    placeholder={__('Form Subtitle...', 'anotherstep')}
                />

                {/* Visual Form Field Previews (Disabled Inputs) */}
                <div style={{ display: 'flex', flexDirection: 'column', gap: '16px', opacity: 0.85 }}>
                    <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '16px' }}>
                        <div>
                            <label style={{ fontSize: '12px', fontWeight: 'bold', color: '#0055b8', display: 'block', marginBottom: '4px' }}>Full Name</label>
                            <input type="text" placeholder="Your Name" disabled style={{ width: '100%', padding: '12px', borderRadius: '8px', border: '1px solid #cbd5e1', background: '#f8fafc' }} />
                        </div>
                        <div>
                            <label style={{ fontSize: '12px', fontWeight: 'bold', color: '#0055b8', display: 'block', marginBottom: '4px' }}>Email Address</label>
                            <input type="email" placeholder="email@example.com" disabled style={{ width: '100%', padding: '12px', borderRadius: '8px', border: '1px solid #cbd5e1', background: '#f8fafc' }} />
                        </div>
                    </div>

                    <div>
                        <label style={{ fontSize: '12px', fontWeight: 'bold', color: '#0055b8', display: 'block', marginBottom: '4px' }}>How can we help?</label>
                        <select disabled style={{ width: '100%', padding: '12px', borderRadius: '8px', border: '1px solid #cbd5e1', background: '#f8fafc' }}>
                            <option>General Inquiry</option>
                            <option>Technical Support</option>
                            <option>Service Information</option>
                            <option>Billing Question</option>
                        </select>
                    </div>

                    <div>
                        <label style={{ fontSize: '12px', fontWeight: 'bold', color: '#0055b8', display: 'block', marginBottom: '4px' }}>Message</label>
                        <textarea placeholder="Tell us more about your needs..." rows={3} disabled style={{ width: '100%', padding: '12px', borderRadius: '8px', border: '1px solid #cbd5e1', background: '#f8fafc', resize: 'none' }} />
                    </div>

                    {/* Editable Submit Button Text */}
                    <div style={{ marginTop: '8px' }}>
                        <RichText
                            tagName="span"
                            value={buttonText}
                            onChange={(val) => setAttributes({ buttonText: val })}
                            style={{ display: 'inline-block', background: '#0055b8', color: '#ffffff', padding: '12px 24px', borderRadius: '9999px', fontWeight: 'bold', fontSize: '14px' }}
                            placeholder={__('Button Text (e.g. Send Message)...', 'anotherstep')}
                        />
                    </div>
                </div>
            </div>
        </>
    );
}