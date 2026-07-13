<?php
// This file is generated. Do not modify it manually.
return array(
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
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php'
	),
	'homepage-about-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'anotherstep/homepage-about-section',
		'version' => '0.1.0',
		'title' => 'Homepage About Section',
		'category' => 'widgets',
		'attributes' => array(
			'aboutHeadline' => array(
				'type' => 'string',
				'default' => ''
			),
			'aboutDescription' => array(
				'type' => 'string',
				'default' => ''
			),
			'aboutSubHeadline' => array(
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
		'icon' => 'smiley',
		'description' => 'Block to be used specifically for the home page Who We Are section.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'homepage-about-section',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js'
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
	'homepage-legal-section' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'anotherstep/homepage-legal-section',
		'version' => '0.1.0',
		'title' => 'Homepage Legal Section',
		'category' => 'widgets',
		'attributes' => array(
			'administrativeRecordsTitle' => array(
				'type' => 'string',
				'default' => 'Administrative Records'
			),
			'administrativeRecordsDescription' => array(
				'type' => 'string',
				'default' => 'Governing documents, conflict of interest policy, and financial statements are available upon request to:'
			),
			'directorName' => array(
				'type' => 'string',
				'default' => 'Dawn Rich Meitrott'
			),
			'directorTitle' => array(
				'type' => 'string',
				'default' => 'Executive Director'
			),
			'organizationName' => array(
				'type' => 'string',
				'default' => 'Another Step, Inc.'
			),
			'street' => array(
				'type' => 'string',
				'default' => '30 Ramland Road, Suite 202'
			),
			'city' => array(
				'type' => 'string',
				'default' => 'Orangeburg'
			),
			'state' => array(
				'type' => 'string',
				'default' => 'NY'
			),
			'zipCode' => array(
				'type' => 'string',
				'default' => '10962'
			),
			'charityInfoTitle' => array(
				'type' => 'string',
				'default' => 'Charity Information'
			),
			'charityInfoDescription' => array(
				'type' => 'string',
				'default' => 'You can obtain more information about charities by calling the Attorney General:'
			),
			'attorneyGeneralPhone' => array(
				'type' => 'string',
				'default' => '212-416-8686'
			)
		),
		'icon' => 'smiley',
		'description' => 'Block to be used specifically for the home page legal documentation.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'homepage-legal-section',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js'
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
				'source' => 'text',
				'selector' => '.as-split-feature-title',
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
	)
);
