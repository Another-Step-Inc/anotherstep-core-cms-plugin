import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls, InnerBlocks } from '@wordpress/block-editor';
import { PanelBody, SelectControl, ToggleControl, TextControl, TextareaControl } from '@wordpress/components';

import './editor.scss';

const ALLOWED_BLOCKS = ['core/paragraph', 'core/heading', 'core/list', 'core/quote'];

export default function Edit(props) {
    const { attributes, setAttributes } = props;
    const {
        title,
        hasUnderline,
        backgroundColor,
        headline,
        card1Icon,
        card1IconColor,
        card1Title,
        card1Text,
        card2Icon,
        card2IconColor,
        card2Title,
        card2Text
    } = attributes;

    const blockProps = useBlockProps({
    className: `as-split-content-editor ${backgroundColor}`
    });

    return (
        <>
            <InspectorControls>
                <PanelBody title={__('Section Settings', 'split-narrative-section')} initialOpen={true}>
                    <SelectControl
                        label={__('Background Color', 'split-narrative-section')}
                        value={backgroundColor}
                        options={[
                            { label: 'Brand Light (bg-brand-bg)', value: 'bg-brand-bg' },
                            { label: 'Surface Low (bg-surface-container-low)', value: 'bg-surface-container-low' }
                        ]}
                        onChange={(val) => setAttributes({ backgroundColor: val })}
                    />
                    <ToggleControl
                        label={__('Show Title Underline Accent', 'split-narrative-section')}
                        checked={hasUnderline}
                        onChange={(val) => setAttributes({ hasUnderline: val })}
                    />
                </PanelBody>

                <PanelBody title={__('Card 1 (Left)', 'split-narrative-section')} initialOpen={false}>
                    <TextControl
                        label={__('Icon Name', 'split-narrative-section')}
                        value={card1Icon}
                        onChange={(val) => setAttributes({ card1Icon: val })}
                    />
                    <TextControl
                        label={__('Icon Color Class', 'split-narrative-section')}
                        value={card1IconColor}
                        onChange={(val) => setAttributes({ card1IconColor: val })}
                    />
                    <TextControl
                        label={__('Title', 'split-narrative-section')}
                        value={card1Title}
                        onChange={(val) => setAttributes({ card1Title: val })}
                    />
                    <TextareaControl
                        label={__('Description', 'split-narrative-section')}
                        value={card1Text}
                        onChange={(val) => setAttributes({ card1Text: val })}
                    />
                </PanelBody>

                <PanelBody title={__('Card 2 (Right)', 'split-narrative-section')} initialOpen={false}>
                    <TextControl
                        label={__('Icon Name', 'split-narrative-section')}
                        value={card2Icon}
                        onChange={(val) => setAttributes({ card2Icon: val })}
                    />
                    <TextControl
                        label={__('Icon Color Class', 'split-narrative-section')}
                        value={card2IconColor}
                        onChange={(val) => setAttributes({ card2IconColor: val })}
                    />
                    <TextControl
                        label={__('Title', 'split-narrative-section')}
                        value={card2Title}
                        onChange={(val) => setAttributes({ card2Title: val })}
                    />
                    <TextareaControl
                        label={__('Description', 'split-narrative-section')}
                        value={card2Text}
                        onChange={(val) => setAttributes({ card2Text: val })}
                    />
                </PanelBody>
            </InspectorControls>

            <div {...blockProps}>
                <div className="as-editor-header">
                    <TextControl
                        label={__('Section Title Attribute', 'split-narrative-section')}
                        value={title}
                        placeholder="Our Mission / Life at Home"
                        onChange={(val) => setAttributes({ title: val })}
                    />
                    <TextControl
                        label={__('Headline', 'split-narrative-section')}
                        value={headline}
                        placeholder="Enter headline..."
                        onChange={(val) => setAttributes({ headline: val })}
                    />
                </div>
                <div className="as-editor-body">
                    <p className="as-label">{__('Section Content (InnerBlocks)', 'split-narrative-section')}</p>
                    <InnerBlocks
                        allowedBlocks={ALLOWED_BLOCKS}
                        templateLock={false}
                    />
                </div>
            </div>
        </>
    );
}