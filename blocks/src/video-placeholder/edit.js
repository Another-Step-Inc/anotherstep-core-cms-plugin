import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { 
    PanelBody, 
    TextControl, 
    SelectControl, 
    ToggleControl 
} from '@wordpress/components';

import './editor.scss';

export default function Edit( props ) {
    const { attributes, setAttributes } = props;

    const {
        // Layout & Display Controls
        layoutType = 'grid', // 'grid', 'masonry', or 'stacked'
        showFilterBar = true,
        itemsPerPage = '12',

        // Header Narrative & Section Copy
        videoTitle = '',
        videoDescription = '',

        // GraphQL Query Filters
        categorySlug = '',
        tagFilter = '',
        maxItems = '24',

        // Notice & Status Controls
        footerNotice = '',
    } = attributes;

    return (
        <>
            {/* SIDEBAR CONFIGURATION INSPECTOR */}
            <InspectorControls>
                <PanelBody title={ __( 'Video Layout Strategy', 'video-placeholder' ) } initialOpen={ true }>
                    <SelectControl
                        label={ __( 'Display Mode', 'video-placeholder' ) }
                        value={ layoutType }
                        options={ [
                            { label: __( 'Multi-Column Grid', 'video-placeholder' ), value: 'grid' },
                            { label: __( 'Dynamic Masonry', 'video-placeholder' ), value: 'masonry' },
                            { label: __( 'Single Column (Stacked)', 'video-placeholder' ), value: 'stacked' },
                        ] }
                        onChange={ ( val ) => setAttributes( { layoutType: val } ) }
                    />

                    <ToggleControl
                        label={ __( 'Enable Category Filter Bar', 'video-placeholder' ) }
                        checked={ showFilterBar }
                        onChange={ ( val ) => setAttributes( { showFilterBar: val } ) }
                    />

                    <TextControl
                        label={ __( 'Items Per Page (Pagination)', 'video-placeholder' ) }
                        value={ itemsPerPage }
                        onChange={ ( val ) => setAttributes( { itemsPerPage: val } ) }
                    />
                </PanelBody>

                {/* GRAPHQL DATA QUERY SETTINGS */}
                <PanelBody title={ __( 'GraphQL Query Settings', 'video-placeholder' ) } initialOpen={ false }>
                    <TextControl
                        label={ __( 'Category Slug Filter', 'video-placeholder' ) }
                        value={ categorySlug }
                        placeholder={ __( 'e.g., community-outings', 'video-placeholder' ) }
                        onChange={ ( val ) => setAttributes( { categorySlug: val } ) }
                    />

                    <TextControl
                        label={ __( 'Tag Filter', 'video-placeholder' ) }
                        value={ tagFilter }
                        placeholder={ __( 'e.g., featured', 'video-placeholder' ) }
                        onChange={ ( val ) => setAttributes( { tagFilter: val } ) }
                    />

                    <TextControl
                        label={ __( 'Max Fetch Limit', 'video-placeholder' ) }
                        value={ maxItems }
                        onChange={ ( val ) => setAttributes( { maxItems: val } ) }
                    />
                </PanelBody>

                {/* FOOTER NOTE / NOTICE */}
                <PanelBody title={ __( 'Footer Note', 'video-placeholder' ) } initialOpen={ false }>
                    <TextControl
                        label={ __( 'Editor Footer Subtext', 'video-placeholder' ) }
                        value={ footerNotice }
                        placeholder={ __( 'e.g., Dynamic GraphQL photo stream populated on frontend.', 'video-placeholder' ) }
                        onChange={ ( val ) => setAttributes( { footerNotice: val } ) }
                    />
                </PanelBody>
            </InspectorControls>

            {/* EDITOR WORKSPACE CANVAS */}
            <div { ...useBlockProps( { className: `as-hero-editor-container layout-${ layoutType }` } ) }>
                <div className="as-hero-editor-grid">
                    
                    {/* PRIMARY GALLERY CONFIGURATION COLUMN */}
                    <div className="as-hero-content-col">
                        <textarea
                            className="as-inline-title"
                            value={ videoTitle }
                            placeholder={ __( 'Video Section Title...', 'video-placeholder' ) }
                            rows={ 1 }
                            onChange={ ( e ) => setAttributes( { videoTitle: e.target.value } ) }
                        />

                        <textarea
                            className="as-inline-description"
                            value={ videoDescription }
                            placeholder={ __( 'Enter video section description narrative...', 'video-placeholder' ) }
                            rows={ 3 }
                            onChange={ ( e ) => setAttributes( { videoDescription: e.target.value } ) }
                        />

                        {/* GraphQL Live Query Summary Card */}
                        <div className="as-editor-verification-box">
                            <span className="dashicons dashicons-format-gallery"></span>
                            <div>
                                <p><strong>{ __( 'GraphQL Query Active', 'video-placeholder' ) }:</strong> { layoutType.toUpperCase() } Mode</p>
                                <p><strong>{ __( 'Filter Category', 'video-placeholder' ) }:</strong> { categorySlug || __( 'All Categories', 'video-placeholder' ) }</p>
                                { tagFilter && <p><strong>{ __( 'Tag Filter', 'video-placeholder' ) }:</strong> { tagFilter }</p> }
                                <p><strong>{ __( 'Items Limit', 'video-placeholder' ) }:</strong> { itemsPerPage } per page (Max { maxItems })</p>
                            </div>
                        </div>
                    </div>

                    {/* FRONTEND PLACEHOLDER PREVIEW CARD */}
                    <div className="as-hero-content-col">
                        <div className="as-inline-title" style={ { fontSize: '18px' } }>
                            🖼️ { __( 'Frontend Render Placeholder', 'video-placeholder' ) }
                        </div>
                        
                        <p className="as-inline-description">
                            { __( 'This block acts as an anchor. In Astro, BlockResolver intercepting this position will replace this block with your dynamic GraphQL photo grid.', 'video-placeholder' ) }
                        </p>

                        { showFilterBar && (
                            <div className="as-editor-verification-box" style={ { borderLeftColor: '#f59e0b' } }>
                                <span className="dashicons dashicons-filter" style={ { color: '#f59e0b' } }></span>
                                <div>
                                    <p><strong>{ __( 'Filter Bar', 'video-placeholder' ) }:</strong> { __( 'ENABLED', 'video-placeholder' ) }</p>
                                    <p>{ __( 'Interactive category pills will render on Astro frontend.', 'video-placeholder' ) }</p>
                                </div>
                            </div>
                        ) }
                    </div>

                </div>

                {/* FOOTER NOTICE BAR */}
                { footerNotice && (
                    <div className="as-editor-footer-notice">
                        <small>{ footerNotice }</small>
                    </div>
                ) }
            </div>
        </>
    );
}