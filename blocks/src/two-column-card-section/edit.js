import { useState } from '@wordpress/element';
import { useBlockProps, InspectorControls, RichText, InnerBlocks } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button, Modal } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

import { 
	HomeIcon, MapPinIcon, UserGroupIcon, AcademicCapIcon, 
	ChartBarIcon, ArrowTrendingUpIcon, StarIcon, CheckBadgeIcon, 
	HeartIcon, HandThumbUpIcon, UserPlusIcon, SunIcon, 
	BriefcaseIcon, GlobeAltIcon, BuildingOfficeIcon, CalendarDaysIcon, 
	PhoneIcon, CursorArrowRaysIcon, InformationCircleIcon, RocketLaunchIcon 
} from '@heroicons/react/24/outline';

import './editor.scss';

const ICON_MAP = {
    HomeIcon, MapPinIcon, UserGroupIcon, AcademicCapIcon,
    ChartBarIcon, ArrowTrendingUpIcon, StarIcon, CheckBadgeIcon,
    HeartIcon, HandThumbUpIcon, UserPlusIcon, SunIcon,
    BriefcaseIcon, GlobeAltIcon, BuildingOfficeIcon, CalendarDaysIcon,
    PhoneIcon, CursorArrowRaysIcon, InformationCircleIcon, RocketLaunchIcon
};

export default function Edit( props ) {
	const { attributes, setAttributes } = props;

	const {
		aboutHeadline,
		aboutSubHeadline,
		aboutImpactHeadline,
		aboutImpactTitle1,
		aboutImpactParagraph1,
		aboutImpactIcon1,
		aboutImpactTitle2,
		aboutImpactParagraph2,
		aboutImpactIcon2,
	} = attributes;

	const ALLOWED_BLOCKS = [ 'core/paragraph', 'core/heading', 'core/list' ];
	const TEMPLATE = [
		[ 'core/paragraph', { placeholder: __( 'Enter a paragraph...', 'two-column-card-section' ) } ],
	];

	const IconOne = ICON_MAP[ aboutImpactIcon1 ] || StarIcon;
	const IconTwo = ICON_MAP[ aboutImpactIcon2 ] || StarIcon;

	return (
		<>
			{/* SIDEBAR CONFIGURATION INSPECTOR */}
			<InspectorControls>
				<PanelBody title={ __( 'Impact 1 Configuration', 'two-column-card-section' ) } initialOpen={ true }>
					<IconPicker 
						label={ __( 'Impact 1 Icon', 'two-column-card-section' ) }
						currentIcon={ aboutImpactIcon1 }
						onSelect={ ( name ) => setAttributes( { aboutImpactIcon1: name } ) }
					/>
				</PanelBody>

				<PanelBody title={ __( 'Impact 2 Configuration', 'two-column-card-section' ) } initialOpen={ false }>
					<IconPicker 
						label={ __( 'Impact 2 Icon', 'two-column-card-section' ) }
						currentIcon={ aboutImpactIcon2 }
						onSelect={ ( name ) => setAttributes( { aboutImpactIcon2: name } ) }
					/>
				</PanelBody>
			</InspectorControls>

			{/* HERO-STYLE EDITOR CANVAS WORKSPACE */}
			<div { ...useBlockProps( { className: 'as-hero-editor-container' } ) }>
				
				{/* MAIN HEADLINE & SUBHEADLINE */}
				<div className="as-about-header-group">
					<textarea
						className="as-inline-title"
						value={ aboutHeadline }
						placeholder={ __( 'Enter Main Headline...', 'two-column-card-section' ) }
						rows={ 1 }
						onChange={ ( e ) => setAttributes( { aboutHeadline: e.target.value } ) }
					/>

					<textarea
						className="as-inline-subtitle"
						value={ aboutSubHeadline }
						placeholder={ __( 'Enter Sub-headline...', 'two-column-card-section' ) }
						rows={ 1 }
						onChange={ ( e ) => setAttributes( { aboutSubHeadline: e.target.value } ) }
					/>

					<div className="as-inline-description">
						<InnerBlocks
							allowedBlocks={ ALLOWED_BLOCKS }
							template={ TEMPLATE }
							templateLock={ false }
						/>
					</div>
				</div>

				{/* 2-COLUMN IMPACT GRID */}
				<div className="as-hero-editor-grid">
					<div className="as-hero-content-col">
						<textarea
							className="as-inline-title"
							value={ aboutImpactHeadline }
							placeholder={ __( 'Enter Impact Headline...', 'two-column-card-section' ) }
							rows={ 1 }
							onChange={ ( e ) => setAttributes( { aboutImpactHeadline: e.target.value } ) }
						/>
					</div>

					{/* IMPACT CARD 1 */}
					<div className="as-hero-content-col">
						<div className="as-card-header">
							<IconOne style={{ width: '24px', height: '24px', color: '#0056b3' }} />
							<input
								type="text"
								className="as-inline-card-title"
								value={ aboutImpactTitle1 }
								placeholder={ __( 'Impact 1 Title...', 'two-column-card-section' ) }
								onChange={ ( e ) => setAttributes( { aboutImpactTitle1: e.target.value } ) }
							/>
						</div>

						<RichText 
							tagName="p"
							className="as-inline-description"
							placeholder={ __( 'Impact 1 description...', 'two-column-card-section' ) }
							value={ aboutImpactParagraph1 }
							onChange={ ( val ) => setAttributes( { aboutImpactParagraph1: val } ) }
						/>
					</div>

					{/* IMPACT CARD 2 */}
					<div className="as-hero-content-col">
						<div className="as-card-header">
							<IconTwo style={{ width: '24px', height: '24px', color: '#0056b3' }} />
							<input
								type="text"
								className="as-inline-card-title"
								value={ aboutImpactTitle2 }
								placeholder={ __( 'Impact 2 Title...', 'two-column-card-section' ) }
								onChange={ ( e ) => setAttributes( { aboutImpactTitle2: e.target.value } ) }
							/>
						</div>

						<RichText 
							tagName="p"
							className="as-inline-description"
							placeholder={ __( 'Impact 2 description...', 'two-column-card-section' ) }
							value={ aboutImpactParagraph2 }
							onChange={ ( val ) => setAttributes( { aboutImpactParagraph2: val } ) }
						/>
					</div>

				</div>
			</div>
		</>
	);
}

/* HELPER COMPONENT: ICON PICKER MODAL */
const IconPicker = ( { currentIcon, onSelect, label } ) => {
	const [ isModalOpen, setModalOpen ] = useState( false );
	const [ searchTerm, setSearchTerm ] = useState( '' );

	const iconNames = Object.keys( ICON_MAP ).filter( ( name ) =>
		name.toLowerCase().includes( searchTerm.toLowerCase() )
	);

	const SelectedIcon = ICON_MAP[ currentIcon ] || StarIcon;

	return (
		<div className="as-icon-picker-wrapper">
			<label className="as-sidebar-label">{ label }</label>
			<Button 
				variant="secondary"
				onClick={ () => setModalOpen( true ) }
				style={ { width: '100%', justifyContent: 'flex-start', marginTop: '6px' } }
			>
				<SelectedIcon style={ { width: '18px', marginRight: '8px' } } />
				{ currentIcon || __( 'Select Icon', 'two-column-card-section' ) }
			</Button>

			{ isModalOpen && (
				<Modal title={ __( 'Select Heroicon', 'two-column-card-section' ) } onRequestClose={ () => setModalOpen( false ) }>
					<TextControl 
						placeholder={ __( 'Search icons...', 'two-column-card-section' ) }
						value={ searchTerm }
						onChange={ setSearchTerm }
						autoFocus
					/>
					<div style={ { display: 'grid', gridTemplateColumns: 'repeat(5, 1fr)', gap: '10px', marginTop: '12px' } }>
						{ iconNames.map( ( name ) => {
							const IconComponent = ICON_MAP[ name ];
							return (
								<Button
									key={ name }
									onClick={ () => {
										onSelect( name );
										setModalOpen( false );
									} }
									isSecondary
									label={ name }
								>
									<IconComponent style={ { width: '20px' } } />
								</Button>
							);
						} ) }
					</div>
				</Modal>
			) }
		</div>
	);
};