<?php
/**
 * DCS MediaWiki skin
 *
 * @file
 * @ingroup Skins
 */
if( !defined( 'MEDIAWIKI' ) ) die( -1 );

/**
 * SkinTemplate class for Dcs skin
 * @ingroup Skins
 */
class SkinDcs extends SkinTemplate {

	var $skinname = 'dcs', $stylename = 'dcs',
		$template = 'DcsTemplate', $useHeadElement = true,
		$dcsPage = false, $showTitle = true;

	/**
	 * Initializes output page and sets up skin-specific parameters
	 * @param $out OutputPage object to initialize
	 */
	public function initPage( OutputPage $out ) {
		global $wgExtensionAssetsPath;
		$out->addStyle( $wgExtensionAssetsPath . '/dcs/DcsSkin/styles/dcs.css' );
		parent::initPage( $out );
	}

	/**
	 * Load skin and user CSS files in the correct order
	 * fixes bug 22916
	 * @param $out OutputPage object
	 */
	function setupSkinUserCss( OutputPage $out ){
		parent::setupSkinUserCss( $out );
		$out->addModuleStyles( "skin.dcs" );
	}
}
