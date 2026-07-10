import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck, InnerBlocks } from '@wordpress/block-editor';
import { PanelBody, SelectControl, ToggleControl, TextControl, Button, ResponsiveControl } from '@wordpress/components';
import { useSelect, useDispatch } from '@wordpress/data';
import { useEffect } from '@wordpress/element';
import { getBlockContent } from '@wordpress/blocks';

import './editor.scss';

export default function Edit( { attributes, setAttributes, clientId } ) {
	const blockProps = useBlockProps();
	
	const {
        splitTitle,
        splitDescription,
		imageAlignment,
		backgroundColor,
		eyebrowText,
		underlineAccent,
		mediaUrl,
		secondaryMediaUrl,
		metricNumber,
		metricLabel,
		iconName,
		iconTitle
	} = attributes;

    // 1. Monitor the inner blocks inside this specific component instance
    const innerBlocks = useSelect( ( select ) => {
        return select( 'core/block-editor' ).getBlocks( clientId );
    }, [ clientId ] );

    // 2. Automatically update splitDescription whenever inner blocks change
    useEffect( () => {
        if ( innerBlocks && innerBlocks.length > 0 ) {
            // Convert the array of blocks (paragraphs, quotes, etc.) into a clean HTML string
            const htmlContent = innerBlocks.map( block => getBlockContent( block ) ).join( '' );
            
            // Save it cleanly inside your attribute object
            if ( attributes.splitDescription !== htmlContent ) {
                setAttributes( { splitDescription: htmlContent } );
            }
        }
    }, [ innerBlocks ] );

    // 3. Define the Allowed Templates (Heading, Paragraphs, Quotes)
    const ALLOWED_BLOCKS = [ 'core/paragraph', 'core/quote' ];
    const TEMPLATE = [
        [ 'core/paragraph', { placeholder: 'Start typing paragraphs or add a quote block...' } ],
        [ 'core/quote', { placeholder: __( 'Enter quote text...', 'split-feature-section' ) } ]
    ];

	const isLeft = imageAlignment === 'left';

	return (
		<div { ...blockProps }>
			{ /* Keep the sidebar panels as an option for precise typing */ }
			<InspectorControls>
				<PanelBody title={ __( 'Layout Mode', 'split-feature-section' ) } initialOpen={ true }>
					<SelectControl
						label={ __( 'Bento Grid Alignment', 'split-feature-section' ) }
						value={ imageAlignment }
						options={ [
							{ label: __( 'Images on Right', 'split-feature-section' ), value: 'right' },
							{ label: __( 'Images on Left', 'split-feature-section' ), value: 'left' }
						] }
						onChange={ ( val ) => setAttributes( { imageAlignment: val } ) }
					/>
					<SelectControl
						label={ __( 'Background Style', 'split-feature-section' ) }
						value={ backgroundColor }
						options={ [
							{ label: __( 'Plain Surface (White)', 'split-feature-section' ), value: 'surface' },
							{ label: __( 'Container Surface (Light Gray)', 'split-feature-section' ), value: 'surface-container-low' }
						] }
						onChange={ ( val ) => setAttributes( { backgroundColor: val } ) }
					/>
					<ToggleControl
						label={ __( 'Heading Red Underline Accent', 'split-feature-section' ) }
						checked={ underlineAccent }
						onChange={ ( val ) => setAttributes( { underlineAccent: val } ) }
					/>
				</PanelBody>
			</InspectorControls>

			{ /* LIVE CANVAS PREVIEW 
				This mimics your actual site layout inside the editor window 
			*/ }
			<div style={ {
				padding: '40px 24px',
				background: backgroundColor === 'surface' ? '#ffffff' : '#f5f5f5',
				border: '1px solid #e0e0e0',
				borderRadius: '12px',
				fontFamily: 'sans-serif'
			} }>
				
				{ /* Tiny Label indicating block borders to author */ }
				<div style={ { fontSize: '10px', color: '#999', fontWeight: 'bold', letterSpacing: '1.5px', textTransform: 'uppercase', marginBottom: '24px', borderBottom: '1px solid #eee', paddingBottom: '8px' } }>
					{ __( 'Bento Split Feature Section Layout', 'split-feature-section' ) }
				</div>

				<div style={ {
					display: 'flex',
					gap: '40px',
					flexDirection: isLeft ? 'row-reverse' : 'row',
					alignItems: 'center'
				} }>
					
					{ /* Left Side Stack: Clean Content Input Engine */ }
					<div style={ { flex: '1', minWidth: '0' } }>
						<div style={ { marginBottom: '16px' } }>
							<input
								type="text"
								value={ eyebrowText }
								placeholder={ __( 'Add Category Eyebrow Badge (Optional)...', 'split-feature-section' ) }
								onChange={ ( e ) => setAttributes( { eyebrowText: e.target.value } ) }
								style={ {
									background: '#002f6c',
									color: '#ffffff',
									border: 'none',
									borderRadius: '20px',
									padding: '4px 14px',
									fontSize: '12px',
									fontWeight: 'bold',
									width: 'auto'
								} }
							/>
						</div>
						
                        <div style={ { padding: '24px', background: '#ffffff', border: '1px solid #ccd0d4', borderRadius: '8px' } }>
                            <input
                                type="text"
                                value={ attributes.splitTitle }
                                placeholder="Enter Split Title..."
                                onChange={ ( e ) => setAttributes( { splitTitle: e.target.value } ) }
                                style={ { fontSize: '28px', fontWeight: 'bold', width: '100%', marginBottom: '16px', border: 'none', borderBottom: '1px dashed #ccc' } }
                            />
                            <InnerBlocks 
                                allowedBlocks={ ALLOWED_BLOCKS }
                                template={ TEMPLATE }
                                templateLock={ false }
                            />
                        </div>
					</div>

					{ /* Right Side Matrix: Live Graphic Box Matrix Elements */ }
					<div style={ { width: '380px', shrink: '0' } }>
						<div style={ { display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '16px' } }>
							
							{ /* Col 1 Item A: Main Photo Attachment Drag target */ }
							<div style={ { display: 'flex', flexDirection: 'column', gap: '16px' } }>
								<MediaUploadCheck>
									<MediaUpload
										onSelect={ ( media ) => setAttributes( { mediaId: media.id, mediaUrl: media.url, mediaAlt: media.alt || '' } ) }
										allowedTypes={ [ 'image' ] }
										value={ attributes.mediaId }
										render={ ( { open } ) => (
											<div 
												onClick={ open }
												style={ {
													aspectRatio: '1/1',
													background: mediaUrl ? `url(${mediaUrl}) center/cover no-repeat` : '#e0e0e0',
													borderRadius: '12px',
													cursor: 'pointer',
													display: 'flex',
													alignItems: 'center',
													justifyContent: 'center',
													padding: '12px',
													textAlign: 'center',
													boxShadow: '0 4px 6px -1px rgba(0,0,0,0.1)'
												} }
											>
												{ ! mediaUrl && <span style={ { fontSize: '11px', color: '#666', fontWeight: 'bold' } }>{ __( '＋ Click to Add Primary Image', 'split-feature-section' ) }</span> }
											</div>
										) }
									/>
								</MediaUploadCheck>

								{ /* Col 1 Item B: Red Metric Color Badge Input variables */ }
								<div style={ { background: '#bb0014', color: '#ffffff', padding: '20px', borderRadius: '12px' } }>
									<input 
										type="text"
										value={ metricNumber }
										placeholder="100%"
										onChange={ ( e ) => setAttributes( { metricNumber: e.target.value } ) }
										style={ { background: 'transparent', border: 'none', color: '#fff', fontSize: '28px', fontWeight: '9xl', width: '100%', padding: '0', marginBottom: '4px' } }
									/>
									<input 
										type="text"
										value={ metricLabel }
										placeholder="In-Home Support"
										onChange={ ( e ) => setAttributes( { metricLabel: e.target.value } ) }
										style={ { background: 'transparent', border: 'none', color: '#fff', fontSize: '11px', fontWeight: 'bold', textTransform: 'uppercase', letterSpacing: '1px', width: '100%', padding: '0' } }
									/>
								</div>
							</div>

							{ /* Col 2: Secondary Content and Staggered Graphic Block Stack */ }
							<div style={ { display: 'flex', flexDirection: 'column', gap: '16px', transform: 'translateY(16px)' } }>
								
								{ /* Col 2 Item A: Icon Identifier and Small Title Header Field */ }
								<div style={ { background: '#b2d1f0', color: '#001f4d', padding: '20px', borderRadius: '12px' } }>
									<div style={ { display: 'flex', alignItems: 'center', gap: '6px', marginBottom: '8px' } }>
										<span style={ { fontSize: '11px', color: '#002f6c', fontWeight: '600' } }>{ __( 'Icon:', 'split-feature-section' ) }</span>
										<input 
											type="text"
											value={ iconName }
											placeholder="home_health"
											onChange={ ( e ) => setAttributes( { iconName: e.target.value } ) }
											style={ { background: '#ffffff', border: '1px solid #999', fontSize: '11px', borderRadius: '4px', padding: '2px 6px', width: '90px' } }
										/>
									</div>
									<input 
										type="text"
										value={ iconTitle }
										placeholder="Personalized Care"
										onChange={ ( e ) => setAttributes( { iconTitle: e.target.value } ) }
										style={ { background: 'transparent', border: 'none', color: '#001f4d', fontSize: '16px', fontWeight: 'bold', width: '100%', padding: '0' } }
									/>
								</div>

								{ /* Col 2 Item B: Staggered Tall Secondary Thumbnail selection wrapper */ }
								<MediaUploadCheck>
									<MediaUpload
										onSelect={ ( media ) => setAttributes( { secondaryMediaId: media.id, secondaryMediaUrl: media.url } ) }
										allowedTypes={ [ 'image' ] }
										value={ attributes.secondaryMediaId }
										render={ ( { open } ) => (
											<div 
												onClick={ open }
												style={ {
													aspectRatio: '3/4',
													background: secondaryMediaUrl ? `url(${secondaryMediaUrl}) center/cover no-repeat` : '#e5e5e5',
													borderRadius: '12px',
													cursor: 'pointer',
													display: 'flex',
													alignItems: 'center',
													justifyContent: 'center',
													padding: '12px',
													textAlign: 'center',
													boxShadow: '0 4px 6px -1px rgba(0,0,0,0.1)'
												} }
											>
												{ ! secondaryMediaUrl && <span style={ { fontSize: '11px', color: '#777', fontWeight: 'bold' } }>{ __( '＋ Add Tall Image', 'split-feature-section' ) }</span> }
											</div>
										) }
									/>
								</MediaUploadCheck>

							</div>

						</div>
					</div>

				</div>
			</div>
		</div>
	);
}