import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';

export default function save( { attributes } ) {
    return (
        <div { ...useBlockProps.save() }>
            {/* Child elements / grid components markup */}
            <InnerBlocks.Content />
        </div>
    );
}