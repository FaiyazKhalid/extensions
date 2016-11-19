<?php
/**
 * OrganicDesign MediaWiki skin
 *
 * @file
 * @ingroup Skins
 */

if( !defined( 'MEDIAWIKI' ) ) die( -1 );

$wgExtensionCredits['skin'][] = array(
	'path'           => __FILE__,
	'name'           => 'OrganicDesign', // name as shown under [[Special:Version]]
	'namemsg'        => 'organicdesign', // used since MW 1.24, see the section on "Localisation messages" below
	'version'        => '2.1.2',
	'url'            => 'http://www.organicdesign.co.nz/Wiki_skins',
	'author'         => '[http://www.organicdesign.co.nz/nad Aran Dunkley]',
	'descriptionmsg' => 'od-skin-desc', // see the section on "Localisation messages" below
	'license'        => 'GPL-2.0+',
);

// Register the skin
$wgValidSkinNames['organicdesign'] = 'OrganicDesign';

// Register the CSS file
$wgResourceModules['skins.organicdesign'] = array(
		'styles' => array( 'organicdesign.css' => array( 'media' => 'screen' ) ),
		'remoteBasePath' => "$wgStylePath/organicdesign",
		'localBasePath' => "$IP/skins/organicdesign",
);

/**
 * SkinTemplate class for OrganicDesign skin
 * @ingroup Skins
 */
class SkinOrganicDesign extends SkinTemplate {

	var $skinname = 'organicdesign', $stylename = 'organicdesign',
		$template = 'OrganicDesignTemplate', $useHeadElement = true;

	/**
	 * Load skin and user CSS files in the correct order
	 * fixes bug 22916
	 * @param $out OutputPage object
	 */
	function setupSkinUserCss( OutputPage $out ){
		parent::setupSkinUserCss( $out );
		$out->addModuleStyles( "skins.organicdesign" );
	}
}

/**
 * @todo document
 * @addtogroup Skins
 */
class OrganicDesignTemplate extends BaseTemplate {
	var $skin;
	/**
	 * Template filter callback for MonoBook skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 *
	 * @access private
	 */
	function execute() {
		// Suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();
		$uri = $_SERVER['REQUEST_URI'];

		$this->html( 'headelement' );?>
	<table class="pageWrapper" cellpadding="0" cellspacing="0" width="100%"><tr><td align="center">
		<div id="languages">
			<a href="http://www.organicdesign.co.nz<?php echo $uri; ?>" title="English"><img src="/wiki/skins/organicdesign/uk.png" /></a>
			<a href="http://pt.organicdesign.co.nz<?php echo $uri; ?>" title="Português brasileiro"><img src="/wiki/skins/organicdesign/br.png" /></a>
		</div>
	<table id="globalWrapper" cellpadding="0" cellspacing="0"><tr><td>
	<table class="pageWrapper" cellpadding="0" cellspacing="0" width="100%"><tr><td id="column-one"><div id="c1-div">
	<script type="<?php $this->text('jsmimetype') ?>"> if (window.isMSIE55) fixalpha(); </script>

	<div class="portlet" id="p-personal">
		<h5><?php $this->msg('personaltools') ?></h5>
		<div class="pBody">
			<ul<?php $this->html('userlangattributes') ?>>
<?php		foreach($this->getPersonalTools() as $key => $item) { ?>
				<?php echo $this->makeListItem($key, $item); ?>

<?php		} ?>
			</ul>
		</div>
	</div>
<?php

// Get avatar image
global $wgUser,$wgUploadDirectory,$wgUploadPath;
if ($wgUser->isLoggedIn()) {
	?><div id="p-avatar"><?php
	$name  = $wgUser->getName();
	$img = wfLocalFile( "$name.png" );
	if( is_object( $img  ) && $img->exists() ) {
		$url = $img->transform( array( 'width' => 50 ) )->getUrl();
		echo "<a href=\"" . $wgUser->getUserPage()->getLocalUrl() . "\"><img src=\"$url\" alt=\"$name\"></a>";
	} else {
		$upload = Title::newFromText( 'Upload', NS_SPECIAL );
		$url = $upload->getLocalUrl( "wpDestFile=$name.png" );
		echo "<a href=\"$url\" class=\"new\"><br>user<br>icon</a>";
	}
	?></div><?php
}

// Donations
global $wgOrganicDesignDonations;
if ( $wgOrganicDesignDonations ) {?>
	<div class="portlet" id="donations" >
		<h2 style="white-space:nowrap"><?php echo wfMsg('tips-welcome'); ?></h2>
		<h5><?php echo wfMsg('paypal-or-cc'); ?></h5>
		<div class="pBody">
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="business" value="<?php echo $wgOrganicDesignDonations ?>" />
				<input type="hidden" name="item_name" value="Donation to Organic Design">
				<input type="hidden" name="currency_code" value="USD">
				$<input style="width:35px" type="text" name="amount" value="5.00" />&nbsp;<input type="submit" value="<?php echo wfMsg('checkout'); ?>" />
			</form>
		</div>
		<h5 id="btcbest"><?php echo wfMsg('btc-awesome', '<a href="/Bitcoin">Bitcoins</a>' ); ?></h5>
		<div class="pBody" style="white-space:nowrap;vertical-align:top;background:url(/files/a/a0/Bitcoin-icon.png) no-repeat 5px 2px;">
			<input style="width:139px;margin-left:23px" readonly="1" value="1Aran5dJVJVz1UVU8mLAGdrxCjCpZgm1Mz" onmouseover="this.select()" />
		</div>
		<h5 id="nmccool"><?php echo wfMsg('also'); ?> <a href="/Litecoin">LTC</a>, <a href="/Ripple">XRP</a> & <a href="/Stellar">STR</a></h5>
		<div class="pBody" style="white-space:nowrap;vertical-align:top;background:url(/files/a/a4/Litecoin-icon.png) no-repeat 5px 2px;">
			<input style="width:139px;margin-left:23px" readonly="1" value="LUoC9TbjN4iPVh1wKNfFBHUr4DozuVKr4X" onmouseover="this.select()" />
		</div>
		<div class="pBody" style="white-space:nowrap;vertical-align:top;background:url(/files/2/23/Ripple.png) no-repeat 5px 2px;">
			<input style="width:139px;margin-left:23px" readonly="1" value="rBSVzXKvPiRVKa4aBpr3SNqSem1RBDdhqy" onmouseover="this.select()" />
		</div>
		<div class="pBody" style="white-space:nowrap;vertical-align:top;background:url(/files/thumb/8/86/StellarLogo.png/30px-StellarLogo.png) no-repeat -1px 1px;">
			<input style="width:139px;margin-left:23px" readonly="1" value="gHAcuAzTNXzq7wM74znnWsZ1N92mJTpNZ9" onmouseover="this.select()" />
		</div>
</div>
<?php }?>
<div class="fb-like-box" data-href="http://www.facebook.com/organicdesign.co.nz" data-width="200" data-show-faces="false" data-stream="false" data-header="false"></div>

<!-- search -->
<div id="p-search" class="portlet">
	<h2><label for="searchInput"><?php $this->msg('search') ?></label></h2>
	<div id="searchBody" class="pBody">
		<form action="<?php $this->text('wgScript') ?>" id="searchform">
			<input type='hidden' name="title" value="<?php $this->text('searchtitle') ?>"/>
			<?php
			echo $this->makeSearchInput(array( "id" => "searchInput" ));
			echo $this->makeSearchButton("go", array( "id" => "searchGoButton", "class" => "searchButton" ));
			echo $this->makeSearchButton("fulltext", array( "id" => "mw-searchButton", "class" => "searchButton" ));
			?>
		</form>
	</div>
</div>

<div itemscope itemtype="http://www.schema.org/SiteNavigationElement">
	<?php
	// Sidebar
	global $wgUser,$wgTitle,$wgParser;
	$title = 'od-sidebar';
	$article = new Article( Title::newFromText( $title, NS_MEDIAWIKI ), 0 );
	$text = $article->getContent();
	if( empty( $text ) ) $text = wfMsg( $title );
	if( is_object( $wgParser ) ) { $psr = $wgParser; $opt = $wgParser->mOptions; }
	else { $psr = new Parser; $opt = NULL; }
	if( !is_object( $opt ) ) $opt = ParserOptions::newFromUser( $wgUser );
	echo $psr->parse( $text, $wgTitle, $opt, true, true )->getText();
	?>
</div>
</div></td>

<!-- Main content area -->
	<td id="contentWrapper">
		<table cellpadding="0" cellspacing="0" width="100%"><tr>
		<tr>
			<td><div id="shadow-tl"></div></td>
			<td id="shadow-t" align="right"><div id="logo-t"></div></td>
			<td align="left"><div id="shadow-tr"></div></td>
		</tr>
		<td id="shadow-l">
		<td width="100%" id="content">
			<div id="p-cactions" class="portlet">
				<h5><?php $this->msg('views') ?></h5>
				<div class="pBody">
					<ul><?php
						foreach($this->data['content_actions'] as $key => $tab) {
							echo $this->makeListItem( $key, $tab );
						} ?>

					</ul>
				</div>
			</div>
	<a id="top"></a>
	<?php if($this->data['sitenotice']) { ?><div id="siteNotice"><?php $this->html('sitenotice') ?></div><?php } ?>

	<h1 id="firstHeading" class="firstHeading"><span dir="auto"><?php $this->html('title') ?></span></h1>
	<div id="bodyContent" class="mw-body">
		<div id="siteSub"><?php $this->msg('tagline') ?></div>
		<div id="contentSub"<?php $this->html('userlangattributes') ?>><?php $this->html('subtitle') ?></div>
<?php if($this->data['undelete']) { ?>
		<div id="contentSub2"><?php $this->html('undelete') ?></div>
<?php } ?><?php if($this->data['newtalk'] ) { ?>
		<div class="usermessage"><?php $this->html('newtalk')  ?></div>
<?php } ?><?php if($this->data['showjumplinks']) { ?>
		<div id="jump-to-nav" class="mw-jump"><?php $this->msg('jumpto') ?> <a href="#column-one"><?php $this->msg('jumptonavigation') ?></a>, <a href="#searchInput"><?php $this->msg('jumptosearch') ?></a></div>
<?php } ?>
		<!-- start content -->
<?php $this->html('bodytext') ?>
		<?php if($this->data['catlinks']) { $this->html('catlinks'); } ?>
		<!-- end content -->
		<?php if($this->data['dataAfterContent']) { $this->html ('dataAfterContent'); } ?>
		<div class="visualClear"></div>
	</div>
		</td>
			<td valign="top" id="shadow-r"><div id="logo-r"></div></td>
		</tr>
		<tr>
			<td><div id="shadow-bl"></div></td>
			<td><div id="shadow-b"></div></td>
			<td><div id="shadow-br"></div></td>
		</tr>
		<tr><td colspan="3"><?php
// MediaWiki:Footer
global $wgUser,$wgTitle,$wgParser;
$title = 'footer';
$article = new Article( Title::newFromText( $title, NS_MEDIAWIKI ) );
$text = $article->getContent();
if( empty( $text ) ) $text = wfMsg( $title );
if( is_object( $wgParser ) ) { $psr = $wgParser; $opt = $wgParser->mOptions; }
else { $psr = new Parser; $opt = NULL; }
if( !is_object( $opt ) ) $opt = ParserOptions::newFromUser( $wgUser );
echo $psr->parse( $text, $wgTitle, $opt, true, true )->getText();
?></td></tr>
		</table>
	</td></tr>
	</table>
	</td></tr>
</table>
<?php
		$this->printTrail();
		echo "\n" . Html::closeElement( 'body' );
		echo Html::closeElement( 'html' );
		wfRestoreWarnings();
	} // end of execute() method
} // end of class

global $wgHooks;
$wgHooks['PageBeforeDisplay'][] = 'wfSidebarTree';
function wfSidebarTree( $out, $skin ) {
	global $wgUser, $wgParser;
	static $done = false;
	if( $done ) return true;
	$done = true;
	$opt = ParserOptions::newFromUser( $wgUser );
	$title = Title::newFromText( 'SidebarTree', NS_MEDIAWIKI );
	$article = new Article( $title );
	$html = $this->searchBox();
	$html .= $wgParser->parse( $article->getContent(), $title, $opt, true, true )->getText();
	$out->addHTML( "<div id=\"sidebar-tree\">$html</div>" );
	return true;
}
