import { __ } from '@wordpress/i18n';
import { RichText, useBlockProps } from '@wordpress/block-editor';

export default function Edit({ attributes, setAttributes }) {
    const { heading, noticeText } = attributes;

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
                    <span>{__('Important Notice Block', 'important-notice')}</span>
                </div>

                {/* Editor Preview Layout */}
                <div style={{ background: '#ffffff', borderRadius: '12px', padding: '48px', position: 'relative', overflow: 'hidden', display: 'flex', gap: '48px', alignItems: 'center' }}>
                    
                    {/* Icon Mockup */}
                    <div style={{ width: '80px', height: '80px', flexShrink: 0, background: '#bb0014', borderRadius: '50%', display: 'flex', alignItems: 'center', justifyContent: 'center' }}>
                        <span style={{ color: 'white', fontSize: '36px', fontWeight: 'bold' }}>i</span>
                    </div>

                    <div>
                        <RichText
                            tagName="h2"
                            value={heading}
                            onChange={(val) => setAttributes({ heading: val })}
                            style={{ fontSize: '24px', fontWeight: 'bold', color: '#bb0014', marginBottom: '16px', marginTop: 0 }}
                            placeholder={__('Enter heading...', 'important-notice')}
                            allowedFormats={[]}
                        />
                        <RichText
                            tagName="p"
                            value={noticeText}
                            onChange={(val) => setAttributes({ noticeText: val })}
                            style={{ fontSize: '24px', fontWeight: '500', color: '#1e1e1e', lineHeight: '1.2', margin: 0 }}
                            placeholder={__('Enter notice text...', 'important-notice')}
                            allowedFormats={['core/bold', 'core/italic', 'core/text-color', 'core/link', 'core/code']}
                        />
                    </div>
                </div>
            </div>
        </div>
    );
}