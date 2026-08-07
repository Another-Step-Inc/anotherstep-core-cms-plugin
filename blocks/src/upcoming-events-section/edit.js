import { __ } from '@wordpress/i18n';
import { RichText, useBlockProps } from '@wordpress/block-editor';

export default function Edit({ attributes, setAttributes }) {
    const {
        sectionTitle,
        sideTitle,
        sideDescription,
        saveTheDateText,
        meetingTitle,
        meetingDescription,
        inPersonTitle,
        inPersonDetails,
        digitalTitle,
        zoomUrl,
        zoomButtonText,
        phoneText,
        phoneDetails,
        meetingId
    } = attributes;

    const blockProps = useBlockProps({
        className: 'p-8 bg-slate-50 border border-slate-200 rounded-2xl max-w-6xl mx-auto my-8 relative'
    });

    return (
        <div {...blockProps}>
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
                    <span>{__('Upcoming Events Block', 'anotherstep')}</span>
                </div>

                {/* Editor Preview Container */}
                <div style={{ background: '#ffffff', borderRadius: '12px', padding: '32px', position: 'relative', display: 'flex', flexDirection: 'column', gap: '32px' }}>
                    
                    {/* Header Title */}
                    <div style={{ borderBottom: '1px solid #eee', paddingBottom: '16px' }}>
                        <RichText
                            tagName="h2"
                            value={sectionTitle}
                            onChange={(val) => setAttributes({ sectionTitle: val })}
                            style={{ fontSize: '28px', fontWeight: 'bold', color: '#1a365d' }}
                            placeholder={__('Section Title...', 'anotherstep')}
                        />
                    </div>

                    <div style={{ display: 'grid', gridTemplateColumns: '1fr 2fr', gap: '24px' }}>
                        
                        {/* Sidebar Column */}
                        <div style={{ background: '#f8fafc', border: '1px solid #e2e8f0', borderRadius: '12px', padding: '20px' }}>
                            <RichText
                                tagName="h3"
                                value={sideTitle}
                                onChange={(val) => setAttributes({ sideTitle: val })}
                                style={{ fontSize: '18px', fontWeight: 'bold', color: '#0055b8', marginBottom: '12px' }}
                                placeholder={__('Sidebar Title...', 'anotherstep')}
                            />
                            <RichText
                                tagName="p"
                                value={sideDescription}
                                onChange={(val) => setAttributes({ sideDescription: val })}
                                style={{ fontSize: '14px', color: '#555', marginBottom: '16px' }}
                                placeholder={__('Sidebar Description...', 'anotherstep')}
                            />
                            <div style={{ color: '#d97706', fontWeight: 'bold', fontSize: '14px' }}>
                                <RichText
                                    tagName="span"
                                    value={saveTheDateText}
                                    onChange={(val) => setAttributes({ saveTheDateText: val })}
                                    placeholder={__('Save the Date Text...', 'anotherstep')}
                                />
                            </div>
                        </div>

                        {/* Main Grid Content */}
                        <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '16px' }}>
                            
                            {/* Monthly Meetings Card (Full Span) */}
                            <div style={{ gridColumn: 'span 2', background: '#f1f5f9', padding: '20px', borderRadius: '12px' }}>
                                <RichText
                                    tagName="h3"
                                    value={meetingTitle}
                                    onChange={(val) => setAttributes({ meetingTitle: val })}
                                    style={{ fontSize: '18px', fontWeight: 'bold', marginBottom: '8px' }}
                                    placeholder={__('Meeting Title...', 'anotherstep')}
                                />
                                <RichText
                                    tagName="p"
                                    value={meetingDescription}
                                    onChange={(val) => setAttributes({ meetingDescription: val })}
                                    style={{ fontSize: '14px', color: '#475569' }}
                                    placeholder={__('Meeting Description...', 'anotherstep')}
                                />
                            </div>

                            {/* Join In Person Card */}
                            <div style={{ border: '1px solid #e2e8f0', padding: '20px', borderRadius: '12px' }}>
                                <RichText
                                    tagName="h4"
                                    value={inPersonTitle}
                                    onChange={(val) => setAttributes({ inPersonTitle: val })}
                                    style={{ fontSize: '16px', fontWeight: 'bold', color: '#0055b8', marginBottom: '8px' }}
                                    placeholder={__('In-Person Title...', 'anotherstep')}
                                />
                                <RichText
                                    tagName="p"
                                    value={inPersonDetails}
                                    onChange={(val) => setAttributes({ inPersonDetails: val })}
                                    style={{ fontSize: '13px', color: '#64748b' }}
                                    placeholder={__('In-Person Details...', 'anotherstep')}
                                />
                            </div>

                            {/* Join Digitally Card */}
                            <div style={{ border: '1px solid #e2e8f0', padding: '20px', borderRadius: '12px' }}>
                                <RichText
                                    tagName="h4"
                                    value={digitalTitle}
                                    onChange={(val) => setAttributes({ digitalTitle: val })}
                                    style={{ fontSize: '16px', fontWeight: 'bold', color: '#0055b8', marginBottom: '8px' }}
                                    placeholder={__('Digital Title...', 'anotherstep')}
                                />
                                <div style={{ marginBottom: '12px' }}>
                                    <RichText
                                        tagName="a"
                                        value={zoomButtonText}
                                        onChange={(val) => setAttributes({ zoomButtonText: val })}
                                        style={{ display: 'block', background: '#0055b8', color: '#ffffff', padding: '8px 12px', borderRadius: '20px', textAlign: 'center', fontSize: '12px', fontWeight: 'bold', textDecoration: 'none' }}
                                        placeholder={__('Zoom Button Text...', 'anotherstep')}
                                    />
                                    <div style={{ marginTop: '8px' }}>
                                        <label style={{ fontSize: '10px', color: '#94a3b8', display: 'block' }}>{__('Zoom URL:', 'anotherstep')}</label>
                                        <RichText
                                            tagName="p"
                                            value={zoomUrl}
                                            onChange={(val) => setAttributes({ zoomUrl: val })}
                                            style={{ fontSize: '11px', color: '#0055b8', wordBreak: 'break-all' }}
                                            placeholder={__('https://zoom.us/...', 'anotherstep')}
                                        />
                                    </div>
                                </div>
                                <div style={{ fontSize: '12px', color: '#64748b' }}>
                                    <RichText
                                        tagName="p"
                                        value={phoneText}
                                        onChange={(val) => setAttributes({ phoneText: val })}
                                        style={{ fontWeight: 'bold' }}
                                    />
                                    <RichText
                                        tagName="p"
                                        value={phoneDetails}
                                        onChange={(val) => setAttributes({ phoneDetails: val })}
                                    />
                                    <RichText
                                        tagName="p"
                                        value={meetingId}
                                        onChange={(val) => setAttributes({ meetingId: val })}
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