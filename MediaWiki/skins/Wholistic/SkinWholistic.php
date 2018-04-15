<?php
/**
 * Wholistic MediaWiki skin
 *
 * @file
 * @ingroup Skins
 */
if( !defined( 'MEDIAWIKI' ) ) die( -1 );

/**
 * SkinTemplate class for Dcs skin
 * @ingroup Skins
 */
class SkinWholistic extends SkinTemplate {

	var $skinname = 'wholistic', $stylename = 'wholistic',
		$template = 'WholisticTemplate', $useHeadElement = true,
		$dcsPage = false, $showTitle = true;

	/**
	 * Initializes output page and sets up skin-specific parameters
	 * @param $out OutputPage object to initialize
	 */
	public function initPage( OutputPage $out ) {
		global $wgExtensionAssetsPath;
		//$out->addStyle( $wgExtensionAssetsPath . '/skins/Wholistic/styles/main.css' );
		parent::initPage( $out );
	}

	/**
	 * Load skin and user CSS files in the correct order
	 * fixes bug 22916
	 * @param $out OutputPage object
	 */
	function setupSkinUserCss( OutputPage $out ){
		parent::setupSkinUserCss( $out );
		$out->addModuleStyles( "skin.wholistic" );
	}
}
