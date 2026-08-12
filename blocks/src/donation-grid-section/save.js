import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';

export default function save( props ) {
	const { attributes } = props;
	const { formColumnSpan = 8, sidebarColumnSpan = 4 } = attributes;

	return (
		<section
			{ ...useBlockProps.save( {
				className: 'max-w-7xl mx-auto px-8 grid grid-cols-1 lg:grid-cols-12 gap-8 mb-24',
			} ) }
		>
			<InnerBlocks.Content />
		</section>
	);
}