import { __ } from '@wordpress/i18n';
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';

const LAYOUT_TEMPLATE = [
    ['anotherstep/contact-info-card', { cardType: 'phone', title: 'Call Us', subtitle: 'Available Mon-Fri, 9am - 5pm', value: '1-800-555-0123', href: 'tel:18005550123' }],
    ['anotherstep/contact-info-card', { cardType: 'email', title: 'Email Support', subtitle: 'We typically reply within 2 hours', value: 'hello@anotherstep.com', href: 'mailto:hello@anotherstep.com' }],
    ['anotherstep/hours-card', {}],
    ['anotherstep/contact-form', {}]
];

const ALLOWED_BLOCKS = [
    'anotherstep/contact-info-card',
    'anotherstep/hours-card',
    'anotherstep/contact-form'
];

export default function Edit() {
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
                    <span>{__('Contact Grid Container', 'anotherstep')}</span>
                </div>

                {/* Editor Preview Container */}
                <div style={{ background: '#ffffff', borderRadius: '12px', padding: '32px', position: 'relative', display: 'grid', gridTemplateColumns: '1fr 2fr', gap: '24px' }}>
                    <InnerBlocks
                        allowedBlocks={ALLOWED_BLOCKS}
                        template={LAYOUT_TEMPLATE}
                        templateLock={false}
                    />
                </div>
            </div>
        </div>
    );
}