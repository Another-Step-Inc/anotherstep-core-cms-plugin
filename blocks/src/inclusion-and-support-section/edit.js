import { __ } from '@wordpress/i18n';
import { RichText, InnerBlocks, useBlockProps } from '@wordpress/block-editor';

const ALLOWED_BLOCKS = ['core/paragraph'];

const TEMPLATE = [
    [
        'core/paragraph',
        {
            content:
                'Consistent with our mission to partner with developmentally disabled individuals to create the lives they choose, we partner with black, indigenous, and people of all colors in the fight against systemic racism and social injustice. Our organization has a proud history of employing and servicing people of various races and cultural backgrounds.',
            className: 'text-body-lg text-on-surface-variant leading-relaxed'
        }
    ],
    [
        'core/paragraph',
        {
            content:
                'We are committed to a society that is diverse, inclusive, tolerant, and respectful. Another Step will continue to consciously work together to support one another and our developmentally disabled community, especially in times when it is needed most.',
            className: 'text-body-lg text-on-surface-variant leading-relaxed font-semibold'
        }
    ],
    [
        'core/paragraph',
        {
            content: 'We stand against racism! We stand for inclusion!',
            className: 'text-headline-sm font-bold text-brand-blue italic uppercase tracking-wide'
        }
    ]
];

export default function Edit({ attributes, setAttributes }) {
    const {
        title,
        resourceTitle,
        resourceDescription,
        helplineTitle,
        helplineNumber,
        helplineDescription
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
                    <span>{__('Inclusion Statement & Resources Block', 'anotherstep')}</span>
                </div>

                {/* Editor Preview Layout */}
                <div style={{ background: '#ffffff', borderRadius: '12px', padding: '32px', position: 'relative', display: 'flex', flexDirection: 'column', gap: '32px' }}>
                    
                    {/* Statement Section */}
                    <div style={{ borderBottom: '1px solid #eee', paddingBottom: '24px' }}>
                        <RichText
                            tagName="h2"
                            value={title}
                            onChange={(val) => setAttributes({ title: val })}
                            style={{ fontSize: '28px', fontWeight: 'bold', color: '#1a365d', marginBottom: '16px' }}
                            placeholder={__('Enter statement title...', 'anotherstep')}
                        />
                        <div className="inner-blocks-container">
                            <InnerBlocks
                                allowedBlocks={ALLOWED_BLOCKS}
                                template={TEMPLATE}
                                templateLock={false}
                            />
                        </div>
                    </div>

                    {/* Support Resources Grid */}
                    <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '24px' }}>
                        <div>
                            <RichText
                                tagName="h3"
                                value={resourceTitle}
                                onChange={(val) => setAttributes({ resourceTitle: val })}
                                style={{ fontSize: '20px', fontWeight: 'bold', marginBottom: '8px' }}
                                placeholder={__('Resource Title...', 'anotherstep')}
                            />
                            <RichText
                                tagName="p"
                                value={resourceDescription}
                                onChange={(val) => setAttributes({ resourceDescription: val })}
                                style={{ fontSize: '14px', color: '#555' }}
                                placeholder={__('Resource Description...', 'anotherstep')}
                            />
                        </div>

                        {/* Helpline Card */}
                        <div style={{ background: '#0055b8', color: '#ffffff', padding: '24px', borderRadius: '12px' }}>
                            <RichText
                                tagName="h4"
                                value={helplineTitle}
                                onChange={(val) => setAttributes({ helplineTitle: val })}
                                style={{ fontSize: '18px', fontWeight: 'bold', marginBottom: '8px', color: '#ffffff' }}
                                placeholder={__('Helpline Title...', 'anotherstep')}
                            />
                            <RichText
                                tagName="p"
                                value={helplineNumber}
                                onChange={(val) => setAttributes({ helplineNumber: val })}
                                style={{ fontSize: '22px', fontWeight: '900', marginBottom: '8px', color: '#ffffff' }}
                                placeholder={__('Phone Number...', 'anotherstep')}
                            />
                            <RichText
                                tagName="p"
                                value={helplineDescription}
                                onChange={(val) => setAttributes({ helplineDescription: val })}
                                style={{ fontSize: '12px', color: '#e2e8f0' }}
                                placeholder={__('Helpline Description...', 'anotherstep')}
                            />
                        </div>
                    </div>

                </div>
            </div>
        </div>
    );
}