import { __ } from '@wordpress/i18n';
import { useBlockProps, InnerBlocks, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl, ToggleControl, TextControl } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
	const { headline, description, bgStyle, useQuery, postType, postsPerPage, styleVariant } = attributes;

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
				<PanelBody title={ __( 'Grid Settings', 'custom-grid-section' ) } initialOpen={ true }>
                    <ToggleControl
                        label={ __( 'Query Dynamic Posts', 'custom-grid-section' ) }
                        help={ useQuery ? __( 'Querying posts automatically.', 'custom-grid-section' ) : __( 'Manually build your grid using card blocks.', 'custom-grid-section' ) }
                        checked={ useQuery }
                        onChange={ ( value ) => setAttributes( { useQuery: value } ) }
                    />

                    { useQuery && (
                        <>
                            <TextControl
                                label={ __( 'Post Type Slug', 'custom-grid-section' ) }
                                value={ postType }
                                onChange={ ( value ) => setAttributes( { postType: value } ) }
                            />
                            <TextControl
                                label={ __( 'Number of Cards', 'custom-grid-section' ) }
                                type="number"
                                value={ postsPerPage }
                                onChange={ ( value ) => setAttributes( { postsPerPage: parseInt( value ) || 3 } ) }
                            />
                        </>
                    ) }
                </PanelBody>
				<PanelBody title={ __( 'Grid Layout Options', 'custom-grid-section' ) } initialOpen={ true }>
                    <SelectControl
                        label={ __( 'Header Style Variant', 'custom-grid-section' ) }
                        value={ styleVariant }
                        options={ [
                            { label: 'Standard Header', value: 'standard' },
							{ label: 'Accent Line Block', value: 'accent-line' },
                            { label: 'Minimal Spaced', value: 'minimal-spaced' }
                        ] }
                        onChange={ ( value ) => setAttributes( { styleVariant: value } ) }
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
				<div className="editor-grid-container">
					{ useQuery && (
						<div className="dynamic-query-placeholder" style={{
							background: '#e3f2fd',
							padding: '20px',
							borderRadius: '8px',
							border: '1px solid #2196f3',
							marginBottom: '16px',
							textAlign: 'center'
						}}>
							<p className="placeholder-info" style={{ margin: 0, color: '#0d47a1', fontWeight: '500' }}>
								{ `🔄 Dynamic Query Active: Fetching ${ postsPerPage } entries from "${ postType }"` }
							</p>
							<small style={{ color: '#1565c0' }}>Manual card blocks below are hidden on the live frontend.</small>
						</div>
					) }

					{/* Always leave InnerBlocks mounted, but hide its container visually when querying */}
					<div style={{
						display: useQuery ? 'none' : 'grid', // 💡 Hides it cleanly without destroying the React tree!
						gridTemplateColumns: 'repeat(auto-fit, minmax(280px, 1fr))',
						gap: '24px',
						background: '#f0f2f5',
						padding: '20px',
						borderRadius: '8px',
						border: '1px dashed #ccd0d4'
					}}>
						<InnerBlocks 
							allowedBlocks={['anotherstep/custom-grid-card']} // Adjusted to match your block.json name
							template={[
								['anotherstep/custom-grid-card', { theme: 'blue', title: 'Services One' }],
								['anotherstep/custom-grid-card', { theme: 'red', title: 'Services Two' }],
								['anotherstep/custom-grid-card', { theme: 'yellow', title: 'Services Three' }]
							]}
							templateLock={false}
						/>
					</div>
				</div>
			</div>
		</div>
	);
}