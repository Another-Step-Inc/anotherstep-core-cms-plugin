<?php
// This file is generated. Do not modify it manually.
return array(
	'cta-contact-card-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'anotherstep/cta-contact-card-section',
		'version' => '1.0.0',
		'title' => 'CTA Contact Card Section',
		'category' => 'layout',
		'description' => 'Call to action card matching a user with a contact person',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./editor.scss',
		'style' => 'file:./style.scss',
		'render' => 'file:./render.php',
		'supports' => array(
			'html' => false
		),
		'attributes' => array(
			'headline' => array(
				'type' => 'string',
				'default' => 'Ready to take the next step?'
			),
			'description' => array(
				'type' => 'string',
				'default' => 'Connect with our dedicated leadership team to learn more about how our programs can support your journey towards independence.'
			),
			'btn1Text' => array(
				'type' => 'string',
				'default' => 'Schedule a Call'
			),
			'btn1Url' => array(
				'type' => 'string',
				'default' => ''
			),
			'btn2Text' => array(
				'type' => 'string',
				'default' => 'Email Us'
			),
			'btn2Url' => array(
				'type' => 'string',
				'default' => ''
			),
			'directorName' => array(
				'type' => 'string',
				'default' => ''
			),
			'directorTitle' => array(
				'type' => 'string',
				'default' => ''
			),
			'directorRegions' => array(
				'type' => 'string',
				'default' => ''
			),
			'directorPhone' => array(
				'type' => 'string',
				'default' => ''
			),
			'directorImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'directorImageId' => array(
				'type' => 'number'
			)
		)
	),
	'custom-grid-card' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'anotherstep/custom-grid-card',
		'version' => '0.1.0',
		'title' => 'Grid Card Item',
		'category' => 'design',
		'parent' => array(
			'anotherstep/custom-grid-section'
		),
		'attributes' => array(
			'title' => array(
				'type' => 'string',
				'default' => ''
			),
			'content' => array(
				'type' => 'string',
				'default' => ''
			),
			'icon' => array(
				'type' => 'string',
				'default' => ''
			),
			'theme' => array(
				'type' => 'string',
				'default' => ''
			),
			'linkText' => array(
				'type' => 'string',
				'default' => ''
			),
			'linkUrl' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'icon' => 'portfolio',
		'description' => 'An individual card cell designed to inhabit a Customizable Grid column.',
		'textdomain' => 'custom-grid-card',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./editor.scss',
		'style' => 'file:./style.scss',
		'render' => 'file:./render.php'
	),
	'custom-grid-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'anotherstep/custom-grid-section',
		'version' => '0.1.0',
		'title' => 'Customizable Grid Section',
		'category' => 'design',
		'attributes' => array(
			'headline' => array(
				'type' => 'string',
				'default' => ''
			),
			'description' => array(
				'type' => 'string',
				'default' => ''
			),
			'bgStyle' => array(
				'type' => 'string',
				'default' => 'bg-surface-container-low'
			),
			'textAlignment' => array(
				'type' => 'string',
				'default' => 'text-center'
			),
			'styleVariant' => array(
				'type' => 'string',
				'default' => 'standard'
			),
			'useQuery' => array(
				'type' => 'boolean',
				'default' => false
			),
			'postType' => array(
				'type' => 'string',
				'default' => ''
			),
			'postsPerPage' => array(
				'type' => 'number',
				'default' => 3
			)
		),
		'allowedBlocks' => array(
			'anotherstep/custom-grid-card'
		),
		'icon' => 'layout',
		'description' => 'A highly customizable 3-column wrapper block with independent inner cards.',
		'supports' => array(
			'html' => false,
			'align' => array(
				'full',
				'wide'
			)
		),
		'textdomain' => 'custom-grid-section',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./editor.scss',
		'style' => 'file:./style.scss',
		'render' => 'file:./render.php'
	),
	'dynamic-info-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'anotherstep/dynamic-info-section',
		'version' => '0.1.0',
		'title' => 'Dynamic Info Section',
		'category' => 'design',
		'attributes' => array(
			'layoutType' => array(
				'type' => 'string',
				'default' => 'two-column'
			),
			'showSecondarySection' => array(
				'type' => 'boolean',
				'default' => true
			),
			'primaryTitle' => array(
				'type' => 'string',
				'default' => ''
			),
			'primaryDescription' => array(
				'type' => 'string',
				'default' => ''
			),
			'primaryFieldLabel1' => array(
				'type' => 'string',
				'default' => ''
			),
			'primaryFieldValue1' => array(
				'type' => 'string',
				'default' => ''
			),
			'primaryFieldLabel2' => array(
				'type' => 'string',
				'default' => ''
			),
			'primaryFieldValue2' => array(
				'type' => 'string',
				'default' => ''
			),
			'primaryFieldLabel3' => array(
				'type' => 'string',
				'default' => ''
			),
			'primaryFieldValue3' => array(
				'type' => 'string',
				'default' => ''
			),
			'primaryFieldLabel4' => array(
				'type' => 'string',
				'default' => ''
			),
			'primaryFieldValue4' => array(
				'type' => 'string',
				'default' => ''
			),
			'primaryFieldLabel5' => array(
				'type' => 'string',
				'default' => ''
			),
			'primaryFieldValue5' => array(
				'type' => 'string',
				'default' => ''
			),
			'primaryFieldLabel6' => array(
				'type' => 'string',
				'default' => ''
			),
			'primaryFieldValue6' => array(
				'type' => 'string',
				'default' => ''
			),
			'primaryFieldLabel7' => array(
				'type' => 'string',
				'default' => ''
			),
			'primaryFieldValue7' => array(
				'type' => 'string',
				'default' => ''
			),
			'secondaryTitle' => array(
				'type' => 'string',
				'default' => ''
			),
			'secondaryDescription' => array(
				'type' => 'string',
				'default' => ''
			),
			'secondaryFieldLabel1' => array(
				'type' => 'string',
				'default' => ''
			),
			'secondaryFieldValue1' => array(
				'type' => 'string',
				'default' => ''
			),
			'footerNotice' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'icon' => 'grid-view',
		'description' => 'Block used for displaying dynamic information sections on the page. For the legal section, it can be used to display information such as company details, contact information, and other relevant data. The block allows for customization of the layout and content, making it suitable for various use cases.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'dynamic-info-section',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js'
	),
	'gallery-placeholder' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'anotherstep/gallery-placeholder',
		'version' => '0.1.0',
		'title' => 'Gallery Section Anchor',
		'category' => 'widgets',
		'icon' => 'format-gallery',
		'description' => 'Places the GraphQL dynamic gallery grid between blocks on the frontend.',
		'attributes' => array(
			'layoutType' => array(
				'type' => 'string',
				'default' => 'grid'
			),
			'showFilterBar' => array(
				'type' => 'boolean',
				'default' => true
			),
			'itemsPerPage' => array(
				'type' => 'string',
				'default' => '12'
			),
			'galleryTitle' => array(
				'type' => 'string',
				'default' => ''
			),
			'galleryDescription' => array(
				'type' => 'string',
				'default' => ''
			),
			'categorySlug' => array(
				'type' => 'string',
				'default' => ''
			),
			'tagFilter' => array(
				'type' => 'string',
				'default' => ''
			),
			'maxItems' => array(
				'type' => 'string',
				'default' => '24'
			),
			'footerNotice' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'gallery-placeholder',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./editor.scss'
	),
	'homepage-ethics-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'anotherstep/homepage-ethics-section',
		'version' => '0.1.0',
		'title' => 'Homepage Ethics Section',
		'category' => 'widgets',
		'attributes' => array(
			'ethicsHeadline' => array(
				'type' => 'string',
				'default' => 'Code Of Ethics'
			),
			'ethicsLinkText' => array(
				'type' => 'string',
				'default' => ''
			),
			'ethicsLinkUrl' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'icon' => 'smiley',
		'description' => 'Block to be used specifically for the home page code of ethics.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'homepage-ethics-section',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js'
	),
	'page-cta-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'anotherstep/page-cta-section',
		'version' => '0.1.0',
		'title' => 'Page CTA Section',
		'category' => 'widgets',
		'attributes' => array(
			'ctaTitle' => array(
				'type' => 'string',
				'default' => ''
			),
			'ctaDescription' => array(
				'type' => 'string',
				'default' => ''
			),
			'ctaStyle' => array(
				'type' => 'string',
				'default' => 'centered'
			),
			'btn1Text' => array(
				'type' => 'string',
				'default' => ''
			),
			'btn1Url' => array(
				'type' => 'string',
				'default' => ''
			),
			'btn1Style' => array(
				'type' => 'string',
				'default' => 'yellow'
			),
			'btn2Text' => array(
				'type' => 'string',
				'default' => ''
			),
			'btn2Url' => array(
				'type' => 'string',
				'default' => ''
			),
			'hasSteps' => array(
				'type' => 'boolean',
				'default' => false
			),
			'step1Text' => array(
				'type' => 'string',
				'default' => ''
			),
			'step2Text' => array(
				'type' => 'string',
				'default' => ''
			),
			'step3Text' => array(
				'type' => 'string',
				'default' => ''
			),
			'hasCard' => array(
				'type' => 'boolean',
				'default' => false
			),
			'cardTitle' => array(
				'type' => 'string',
				'default' => ''
			),
			'cardDescription' => array(
				'type' => 'string',
				'default' => ''
			),
			'cardBtnText' => array(
				'type' => 'string',
				'default' => ''
			),
			'cardBtnUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'hasStats' => array(
				'type' => 'boolean',
				'default' => false
			),
			'stat1Number' => array(
				'type' => 'string',
				'default' => ''
			),
			'stat1Label' => array(
				'type' => 'string',
				'default' => ''
			),
			'stat2Number' => array(
				'type' => 'string',
				'default' => ''
			),
			'stat2Label' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'icon' => 'megaphone',
		'description' => 'Flexible Call-To-Action section supporting standard centered, step-based, and card layout styles.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'page-cta-section',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php'
	),
	'page-hero-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'anotherstep/page-hero-section',
		'version' => '0.1.0',
		'title' => 'Page Hero Section',
		'category' => 'widgets',
		'attributes' => array(
			'heroTitle' => array(
				'type' => 'string',
				'default' => ''
			),
			'heroDescription' => array(
				'type' => 'string',
				'default' => ''
			),
			'heroImageId' => array(
				'type' => 'number'
			),
			'heroImageUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'btn1Text' => array(
				'type' => 'string',
				'default' => ''
			),
			'btn1Url' => array(
				'type' => 'string',
				'default' => ''
			),
			'btn2Text' => array(
				'type' => 'string',
				'default' => ''
			),
			'btn2Url' => array(
				'type' => 'string',
				'default' => ''
			),
			'layoutType' => array(
				'type' => 'string',
				'default' => 'split'
			),
			'hasBadge' => array(
				'type' => 'boolean',
				'default' => false
			),
			'badgeText' => array(
				'type' => 'string',
				'default' => ''
			),
			'badgeStyle' => array(
				'type' => 'string',
				'default' => 'pill-yellow'
			),
			'ctaStyle' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'imageDecoration' => array(
				'type' => 'string',
				'default' => 'none'
			),
			'quoteText' => array(
				'type' => 'string',
				'default' => ''
			),
			'statsNumber' => array(
				'type' => 'string',
				'default' => ''
			),
			'statsText' => array(
				'type' => 'string',
				'default' => ''
			),
			'statsBgColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'statsTextColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'isImageLarge' => array(
				'type' => 'boolean',
				'default' => false
			),
			'isStatsRotated' => array(
				'type' => 'boolean',
				'default' => true
			),
			'hasExtraTextDiv' => array(
				'type' => 'boolean',
				'default' => false
			),
			'extraDivText' => array(
				'type' => 'string',
				'default' => ''
			),
			'extraDivIcon' => array(
				'type' => 'string',
				'default' => ''
			),
			'extraDivIconColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'extraDivBgColor' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'icon' => 'smiley',
		'description' => 'Block to be used for any page that has a top hero section to display hero content.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'page-hero-section',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js'
	),
	'split-feature-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'anotherstep/split-feature-section',
		'version' => '0.1.0',
		'title' => 'Bento Split Feature Section',
		'category' => 'design',
		'icon' => 'layout',
		'description' => 'Asymmetric side-by-side bento layout featuring text content alongside a structural grid of images and metric badges.',
		'attributes' => array(
			'splitTitle' => array(
				'type' => 'string',
				'default' => ''
			),
			'splitDescription' => array(
				'type' => 'string',
				'source' => 'html',
				'selector' => '.as-split-feature-desc',
				'default' => ''
			),
			'imageAlignment' => array(
				'type' => 'string',
				'default' => ''
			),
			'backgroundColor' => array(
				'type' => 'string',
				'default' => ''
			),
			'eyebrowText' => array(
				'type' => 'string',
				'default' => ''
			),
			'underlineAccent' => array(
				'type' => 'boolean',
				'default' => true
			),
			'mediaId' => array(
				'type' => 'number'
			),
			'mediaUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'mediaAlt' => array(
				'type' => 'string',
				'default' => ''
			),
			'secondaryMediaId' => array(
				'type' => 'number'
			),
			'secondaryMediaUrl' => array(
				'type' => 'string',
				'default' => ''
			),
			'metricNumber' => array(
				'type' => 'string',
				'default' => '100%'
			),
			'metricLabel' => array(
				'type' => 'string',
				'default' => 'In-Home Support'
			),
			'iconName' => array(
				'type' => 'string',
				'default' => 'home_health'
			),
			'iconTitle' => array(
				'type' => 'string',
				'default' => 'Personalized Care'
			)
		),
		'supports' => array(
			'html' => true
		),
		'textdomain' => 'split-feature-section',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js'
	),
	'two-column-card-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'anotherstep/two-column-card-section',
		'version' => '0.1.0',
		'title' => 'Two-Column Card Section',
		'category' => 'design',
		'attributes' => array(
			'aboutHeadline' => array(
				'type' => 'string',
				'default' => ''
			),
			'aboutSubHeadline' => array(
				'type' => 'string',
				'default' => ''
			),
			'aboutImpactHeadline' => array(
				'type' => 'string',
				'default' => ''
			),
			'aboutImpactTitle1' => array(
				'type' => 'string',
				'default' => ''
			),
			'aboutImpactParagraph1' => array(
				'type' => 'string',
				'default' => ''
			),
			'aboutImpactIcon1' => array(
				'type' => 'string',
				'default' => ''
			),
			'aboutImpactTitle2' => array(
				'type' => 'string',
				'default' => ''
			),
			'aboutImpactParagraph2' => array(
				'type' => 'string',
				'default' => ''
			),
			'aboutImpactIcon2' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'icon' => 'index-card',
		'description' => 'Flexible multi-column card block for custom structured content. Block to be used specifically for the home page Who We Are section.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'two-column-card-section',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js'
	),
	'video-placeholder' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'anotherstep/video-placeholder',
		'version' => '0.1.0',
		'title' => 'Video Section Anchor',
		'category' => 'widgets',
		'icon' => 'format-video',
		'description' => 'Places the GraphQL dynamic video section between blocks on the frontend.',
		'attributes' => array(
			'layoutType' => array(
				'type' => 'string',
				'default' => 'grid'
			),
			'showFilterBar' => array(
				'type' => 'boolean',
				'default' => true
			),
			'itemsPerPage' => array(
				'type' => 'string',
				'default' => '12'
			),
			'videoTitle' => array(
				'type' => 'string',
				'default' => ''
			),
			'videoDescription' => array(
				'type' => 'string',
				'default' => ''
			),
			'categorySlug' => array(
				'type' => 'string',
				'default' => ''
			),
			'tagFilter' => array(
				'type' => 'string',
				'default' => ''
			),
			'maxItems' => array(
				'type' => 'string',
				'default' => '24'
			),
			'footerNotice' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'video-placeholder',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./editor.scss'
	)
);
