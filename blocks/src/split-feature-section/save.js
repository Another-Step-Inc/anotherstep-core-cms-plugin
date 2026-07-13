import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';

export default function save( { attributes } ) {
    return (
        <div { ...useBlockProps.save() }>
            {/* The structural markup Gutenberg extracts properties from */}
            { attributes.splitTitle && (
                <h2 className="as-split-feature-title">{ attributes.splitTitle }</h2>
            ) }

            { attributes.splitDescription && (
                <div className="as-split-feature-desc">{ attributes.splitDescription }</div>
            ) }
            
            {/* Child elements / grid components markup */}
            <InnerBlocks.Content />
        </div>
    );
}