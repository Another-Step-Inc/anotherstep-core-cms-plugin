import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
	const { title, content, icon, theme } = attributes;

	// Palette hex definitions to present beautiful contextual backgrounds inside the Gutenberg canvas
	const paletteMap = {
		blue: { bg: '#e3f2fd', text: '#002f6c', border: '#2196f3' },
		red: { bg: '#fde8e8', text: '#bb0014', border: '#f05252' },
		yellow: { bg: '#fef9c3', text: '#854d0e', border: '#eab308' }
	};

	const currentPalette = paletteMap[theme] || paletteMap.blue;

	return (
		<div {...useBlockProps()}>
			<InspectorControls>
				<PanelBody title={__('Card Styles', 'customizable-grid-card')} initialOpen={true}>
					<SelectControl
						label={__('Card Color Theme Variation', 'customizable-grid-card')}
						value={theme}
						options={[
							{ label: __('Brand Blue Scheme', 'customizable-grid-card'), value: 'blue' },
							{ label: __('Brand Red Scheme', 'customizable-grid-card'), value: 'red' },
							{ label: __('Brand Yellow Scheme', 'customizable-grid-card'), value: 'yellow' }
						]}
						onChange={(val) => setAttributes({ theme: val })}
					/>
				</PanelBody>
			</InspectorControls>

			{/* CARD COMPONENT SETTINGS PANEL ENGINE */}
			<div className="as-custom-settings-panel" style={{ margin: '0', border: `1px solid ${currentPalette.border}` }}>
				
				{/* Stylized Internal Panel Header Badge */}
				<div className="as-panel-header" style={{ backgroundColor: '#1e1e1e', display: 'flex', justifyContent: 'space-between', alignItems: 'center', padding: '8px 12px' }}>
					<span className="as-panel-title" style={{ fontSize: '11px', color: '#fff', fontWeight: 'bold' }}>
						{__('Grid Item Block', 'customizable-grid-card')}
					</span>
					<span className="as-panel-badge" style={{ backgroundColor: currentPalette.bg, color: currentPalette.text, fontSize: '9px', padding: '2px 6px', borderRadius: '4px', fontWeight: 'bold', textTransform: 'uppercase' }}>
						{theme}
					</span>
				</div>

				{/* Card Editor Body Inputs */}
				<div className="as-panel-body" style={{ padding: '16px', backgroundColor: '#ffffff' }}>
					
					{/* Icon configuration field */}
					<div style={{ display: 'flex', alignItems: 'center', gap: '8px', marginBottom: '12px', background: '#f5f5f5', padding: '6px 10px', borderRadius: '6px' }}>
						<span className="material-symbols-outlined" style={{ fontSize: '18px', color: currentPalette.text }}>
							{icon || 'star'}
						</span>
						<span style={{ fontSize: '11px', color: '#646970', fontWeight: 'bold' }}>{__('Icon Name:', 'customizable-grid-card')}</span>
						<input
							type="text"
							value={icon}
							placeholder="psychology"
							onChange={(e) => setAttributes({ icon: e.target.value })}
							style={{
								flex: '1',
								fontSize: '12px',
								padding: '2px 6px',
								border: '1px solid #ccd0d4',
								borderRadius: '4px',
								fontFamily: 'monospace'
							}}
						/>
					</div>

					{/* Title Text Input Field */}
					<div style={{ marginBottom: '12px' }}>
						<input
							type="text"
							value={title}
							placeholder={__('Enter Card Heading Title...', 'customizable-grid-card')}
							onChange={(e) => setAttributes({ title: e.target.value })}
							style={{
								fontSize: '16px',
								fontWeight: 'bold',
								color: currentPalette.text,
								width: '100%',
								padding: '6px',
								border: '1px solid #ccd0d4',
								borderRadius: '4px'
							}}
						/>
					</div>

					{/* Content Textarea Field */}
					<div>
						<textarea
							value={content}
							placeholder={__('Enter card body text copy...', 'customizable-grid-card')}
							onChange={(e) => setAttributes({ content: e.target.value })}
							rows={3}
							style={{
								fontSize: '13px',
								color: '#50575e',
								width: '100%',
								padding: '6px',
								border: '1px solid #ccd0d4',
								borderRadius: '4px',
								resize: 'none',
								lineHeight: '1.4'
							}}
						/>
					</div>

				</div>
			</div>
		</div>
	);
}