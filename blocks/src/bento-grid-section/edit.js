import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls, InnerBlocks } from '@wordpress/block-editor';
import { PanelBody, SelectControl, ToggleControl, TextControl, TextareaControl } from '@wordpress/components';

import './editor.scss';

const ALLOWED_BLOCKS = ['anotherstep/bento-card'];

export default function Edit(props) {
    const { attributes, setAttributes } = props;
    const { title, subtitle, hasUnderline, underlineColor, backgroundColor, columns } = attributes;

    const blockProps = useBlockProps({
        className: `as-bento-grid-editor ${backgroundColor}`
    });

    return (
        <>
            <InspectorControls>
                <PanelBody title={__('Section Settings', 'bento-grid-section')} initialOpen={true}>
                    <SelectControl
                        label={__('Background Color', 'bento-grid-section')}
                        value={backgroundColor}
                        options={[
                            { label: 'Transparent', value: 'bg-transparent' },
                            { label: 'Surface Low', value: 'bg-surface-container-low' }
                        ]}
                        onChange={(val) => setAttributes({ backgroundColor: val })}
                    />
                    <SelectControl
                        label={__('Grid Desktop Columns', 'bento-grid-section')}
                        value={columns}
                        options={[
                            { label: '3 Columns (Base)', value: 3 },
                            { label: '6 Columns (High Flex)', value: 6 }
                        ]}
                        onChange={(val) => setAttributes({ columns: parseInt(val, 10) })}
                    />
                    <ToggleControl
                        label={__('Show Title Accent Line', 'bento-grid-section')}
                        checked={hasUnderline}
                        onChange={(val) => setAttributes({ hasUnderline: val })}
                    />
                    {hasUnderline && (
                        <TextControl
                            label={__('Underline Color Class', 'bento-grid-section')}
                            value={underlineColor}
                            onChange={(val) => setAttributes({ underlineColor: val })}
                        />
                    )}
                </PanelBody>
            </InspectorControls>

            <div {...blockProps}>
                <div className="as-editor-header">
                    <TextControl
                        label={__('Section Title', 'bento-grid-section')}
                        value={title}
                        onChange={(val) => setAttributes({ title: val })}
                    />
                    <TextareaControl
                        label={__('Section Description', 'bento-grid-section')}
                        value={subtitle}
                        onChange={(val) => setAttributes({ subtitle: val })}
                    />
                </div>
                <div className="as-editor-body">
                    <p className="as-label">{__('Bento Grid Container', 'bento-grid-section')}</p>
                    <InnerBlocks
                        allowedBlocks={ALLOWED_BLOCKS}
                        templateLock={false}
                    />
                </div>
            </div>
        </>
    );
}