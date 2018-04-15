<?php
class WholisticTemplate extends BaseTemplate {

	/**
	 * @var Skin Cached skin object
	 */
	var $skin;
	var $mSuccess = '';
	var $mError = '';

	/**
	 * Outputs the entire contents of the XHTML page
	 */
	public function execute() {
		global $wgOut;

?><div id="globalWrapper"><table width="100%"><tr><td align="center">
<div id="content" <?php $this->html("specialpageattributes") ?>>

<?php
	// Sidebar tree
	$article = new Article( Title::newFromText( 'Wholistic Panel', NS_TEMPLATE ) );
	$content = $article->getPage()->getContent();
	echo $wgOut->parse( is_object( $content ) ? $content->getNativeData() : $content );
?>

	<a id="top"></a>
	<?php if($this->data['sitenotice']) { ?><div id="siteNotice"><?php $this->html('sitenotice') ?></div><?php } ?>

	<h1 id="firstHeading" class="firstHeading"><?php $this->html('title') ?></h1>
	<div id="bodyContent">
		<h3 id="siteSub"><?php $this->msg('tagline') ?></h3>
		<div id="contentSub"<?php $this->html('userlangattributes') ?>><?php $this->html('subtitle') ?></div>
<?php if($this->data['undelete']) { ?>
		<div id="contentSub2"><?php $this->html('undelete') ?></div>
<?php } ?><?php if($this->data['newtalk'] ) { ?>
		<div class="usermessage"><?php $this->html('newtalk')  ?></div>
<?php } ?><?php if($this->data['showjumplinks']) { ?>
		<div id="jump-to-nav"><?php $this->msg('jumpto') ?> <a href="#column-one"><?php $this->msg('jumptonavigation') ?></a>, <a href="#searchInput"><?php $this->msg('jumptosearch') ?></a></div>
<?php } ?>
		<!-- start content -->
<?php $this->html('bodytext') ?>
		<!-- end content -->
		<?php if($this->data['dataAfterContent']) { $this->html ('dataAfterContent'); } ?>
		<div class="visualClear"></div>
	</div>
</div>
</td></tr></table></div>

</div><!-- end of the left (by default at least) column -->
<div class="visualClear"></div>

<?php
		// Closing scripts and elements
		echo "<script type=\"$wgJsMimeType\"> if ( window.isMSIE55 ) fixalpha(); </script>\n";
		$this->printTrail();
		echo "\n</body>\n</html>\n";
	}
}
