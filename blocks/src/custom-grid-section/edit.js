import { __ } from '@wordpress/i18n';
import { useBlockProps, InnerBlocks, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
	const { headline, description, bgStyle } = attributes;

	return (
		<div {...useBlockProps()}>
			<InspectorControls>
				<PanelBody title={__('Grid Layout Settings', 'custom-grid-section')} initialOpen={true}>
					<SelectControl
						label={__('Background Design Style', 'custom-grid-section')}
						value={bgStyle}
						options={[
							{ label: 'Surface Container Low', value: 'bg-surface-container-low' },
							{ label: 'Surface Container Lowest', value: 'bg-surface-container-lowest' },
							{ label: 'Clean Transparent', value: 'bg-transparent' }
						]}
						onChange={(val) => setAttributes({ bgStyle: val })}
					/>
				</PanelBody>
			</InspectorControls>

			{/* LIVE CANVAS PREVIEW FRAME */}
			<div style={{
				padding: '40px 24px',
				background: bgStyle === 'bg-surface-container-lowest' ? '#ffffff' : '#f5f5f5',
				border: '1px solid #5e5d5d',
				borderRadius: '12px',
				fontFamily: 'sans-serif'
			}}>
				
				{/* Top Status Header Badge */}
				<div style={{ 
					display: 'flex', 
					justifyContent: 'between', 
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
					<span>{__('Customizable Grid Wrapper Section', 'custom-grid-section')}</span>
				</div>

				{/* Section Header Editor Area */}
				<div style={{ marginBottom: '32px', textAlign: 'center', maxWidth: '600px', marginLeft: 'auto', marginRight: 'auto' }}>
					<input
						type="text"
						value={headline}
						placeholder={__('Enter Section Main Headline...', 'custom-grid-section')}
						onChange={(e) => setAttributes({ headline: e.target.value })}
						style={{
							fontSize: '28px',
							fontWeight: 'bold',
							color: '#1e1e1e',
							textAlign: 'center',
							width: '100%',
							marginBottom: '12px',
							border: 'none',
							borderBottom: '1px dashed #ccc',
							padding: '4px'
						}}
					/>
					<textarea
						value={description}
						placeholder={__('Enter section summary description copy context here...', 'custom-grid-section')}
						onChange={(e) => setAttributes({ description: e.target.value })}
						rows={2}
						style={{
							fontSize: '14px',
							color: '#50575e',
							textAlign: 'center',
							width: '100%',
							border: 'none',
							borderBottom: '1px dashed #ccc',
							resize: 'none',
							padding: '4px'
						}}
					/>
				</div>

				{/* Child Blocks Inner Canvas Container */}
				<div style={{
					display: 'grid',
					gridTemplateColumns: 'repeat(auto-fit, minmax(280px, 1fr))',
					gap: '24px',
					background: '#f0f2f5',
					padding: '20px',
					borderRadius: '8px',
					border: '1px dashed #ccd0d4'
				}}>
					<InnerBlocks 
						allowedBlocks={['anotherstep/customizable-grid-card']}
						template={[
							['anotherstep/customizable-grid-card', { theme: 'blue', title: 'Services One' }],
							['anotherstep/customizable-grid-card', { theme: 'red', title: 'Services Two' }],
							['anotherstep/customizable-grid-card', { theme: 'yellow', title: 'Services Three' }]
						]}
						templateLock={false}
					/>
				</div>
			</div>
		</div>
	);
}