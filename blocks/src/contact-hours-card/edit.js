import { __ } from '@wordpress/i18n';
import { RichText, useBlockProps } from '@wordpress/block-editor';

export default function Edit({ attributes, setAttributes }) {
    const { title, weekdayHours, saturdayHours, sundayHours } = attributes;

    const blockProps = useBlockProps({
        className: 'p-6 bg-slate-100 border border-slate-200 rounded-xl mb-4'
    });

    return (
        <div {...blockProps}>
            <div style={{ display: 'flex', alignItems: 'center', gap: '8px', marginBottom: '16px' }}>
                <span className="material-symbols-outlined" style={{ fontSize: '20px', color: '#0055b8' }}>schedule</span>
                <RichText
                    tagName="h3"
                    value={title}
                    onChange={(val) => setAttributes({ title: val })}
                    style={{ fontSize: '18px', fontWeight: 'bold', color: '#0055b8', margin: 0 }}
                    placeholder={__('Operating Hours Title...', 'anotherstep')}
                />
            </div>

            <div style={{ display: 'flex', flexDirection: 'column', gap: '8px', fontSize: '14px', color: '#475569' }}>
                <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', borderBottom: '1px solid #e2e8f0', paddingBottom: '6px' }}>
                    <span style={{ fontWeight: '500' }}>{__('Monday - Friday', 'anotherstep')}</span>
                    <RichText
                        tagName="span"
                        value={weekdayHours}
                        onChange={(val) => setAttributes({ weekdayHours: val })}
                        style={{ fontWeight: 'bold', color: '#1e293b' }}
                        placeholder={__('9:00 - 17:00', 'anotherstep')}
                    />
                </div>

                <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', borderBottom: '1px solid #e2e8f0', paddingBottom: '6px' }}>
                    <span style={{ fontWeight: '500' }}>{__('Saturday', 'anotherstep')}</span>
                    <RichText
                        tagName="span"
                        value={saturdayHours}
                        onChange={(val) => setAttributes({ saturdayHours: val })}
                        style={{ fontWeight: 'bold', color: '#1e293b' }}
                        placeholder={__('10:00 - 14:00', 'anotherstep')}
                    />
                </div>

                <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                    <span style={{ fontWeight: '500' }}>{__('Sunday', 'anotherstep')}</span>
                    <RichText
                        tagName="span"
                        value={sundayHours}
                        onChange={(val) => setAttributes({ sundayHours: val })}
                        style={{ fontWeight: 'bold', color: '#1e293b' }}
                        placeholder={__('Closed', 'anotherstep')}
                    />
                </div>
            </div>
        </div>
    );
}