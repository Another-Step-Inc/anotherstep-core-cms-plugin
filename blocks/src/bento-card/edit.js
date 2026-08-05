import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls, InnerBlocks } from '@wordpress/block-editor';
import { PanelBody, SelectControl, TextControl, TextareaControl } from '@wordpress/components';

import './editor.scss';

export default function Edit(props) {
    const { attributes, setAttributes } = props;
    const { colSpan, cardBgStyle, textColor, icon, iconColor, title, description } = attributes;

    const blockProps = useBlockProps({
        className: `as-bento-card-editor ${cardBgStyle}`
    });

    return (
        <>
            <InspectorControls>
                <PanelBody title={__('Card Layout & Style', 'bento-card')} initialOpen={true}>
                    <SelectControl
                        label={__('Column Span Class', 'bento-card')}
                        value={colSpan}
                        options={[
                            { label: 'Span 1 Column', value: 'md:col-span-1' },
                            { label: 'Span 2 Columns', value: 'md:col-span-2' },
                            { label: 'Span 3 Columns', value: 'md:col-span-3' }
                        ]}
                        onChange={(val) => setAttributes({ colSpan: val })}
                    />
                    <SelectControl
                        label={__('Background Preset', 'bento-card')}
                        value={cardBgStyle}
                        options={[
                            { label: 'Surface Lowest (White)', value: 'bg-surface-container-lowest' },
                            { label: 'Transparent', value: 'bg-transparent' },
                            { label: 'Surface Container High', value: 'bg-surface-container-high' },
                            { label: 'Primary Brand Blue', value: 'bg-primary' },
                            { label: 'Dark Yellow', value: 'bg-brand-dark-yellow' },
                            { label: 'Dark Red', value: 'bg-brand-dark-red' }
                        ]}
                        onChange={(val) => setAttributes({ cardBgStyle: val })}
                    />
                    <TextControl
                        label={__('Text Color Class', 'bento-card')}
                        value={textColor}
                        onChange={(val) => setAttributes({ textColor: val })}
                    />
                </PanelBody>

                <PanelBody title={__('Card Header Content', 'bento-card')} initialOpen={false}>
                    <TextControl
                        label={__('Material Icon Name', 'bento-card')}
                        value={icon}
                        onChange={(val) => setAttributes({ icon: val })}
                    />
                    <TextControl
                        label={__('Icon Color Class', 'bento-card')}
                        value={iconColor}
                        onChange={(val) => setAttributes({ iconColor: val })}
                    />
                    <TextControl
                        label={__('Card Title', 'bento-card')}
                        value={title}
                        onChange={(val) => setAttributes({ title: val })}
                    />
                    <TextareaControl
                        label={__('Card Description', 'bento-card')}
                        value={description}
                        onChange={(val) => setAttributes({ description: val })}
                    />
                </PanelBody>
            </InspectorControls>

            <div {...blockProps}>
                <div className="as-card-controls">
                    <span className="as-badge">{colSpan}</span>
                    <TextControl
                        label={__('Title', 'bento-card')}
                        value={title}
                        placeholder="Card Title..."
                        onChange={(val) => setAttributes({ title: val })}
                    />
                </div>
                <div className="as-card-inner-slot">
                    <p className="as-slot-label">{__('Custom Content / Bottom Slot (Buttons, Lists, Images)', 'bento-card')}</p>
                    <InnerBlocks templateLock={false} />
                </div>
            </div>
        </>
    );
}