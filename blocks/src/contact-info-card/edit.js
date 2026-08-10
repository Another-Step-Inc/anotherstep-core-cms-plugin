import { RichText, useBlockProps } from '@wordpress/block-editor';

export default function Edit({ attributes, setAttributes }) {
    const { title, subtitle, value, href } = attributes;
    const blockProps = useBlockProps({ className: 'p-4 border rounded-lg bg-white mb-4' });

    return (
        <div {...blockProps}>
            <RichText tagName="h3" value={title} onChange={(val) => setAttributes({ title: val })} style={{ fontWeight: 'bold' }} />
            <RichText tagName="p" value={subtitle} onChange={(val) => setAttributes({ subtitle: val })} style={{ fontSize: '12px', color: '#666' }} />
            <RichText tagName="p" value={value} onChange={(val) => setAttributes({ value: val })} style={{ fontWeight: 'bold', color: '#d97706' }} />
            <RichText tagName="p" value={href} onChange={(val) => setAttributes({ href: val })} style={{ fontSize: '10px', color: '#999' }} />
        </div>
    );
}