<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "cat_productinfo.php" ?>
<?php include "categoryinfo.php" ?>
<?php include "passwordinfo.php" ?>
<?php include "userfn6.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Define page object
$cat_product_list = new ccat_product_list();
$Page =& $cat_product_list;

// Page init processing
$cat_product_list->Page_Init();

// Page main processing
$cat_product_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($cat_product->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var cat_product_list = new ew_Page("cat_product_list");

// page properties
cat_product_list.PageID = "list"; // page ID
var EW_PAGE_ID = cat_product_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
cat_product_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
cat_product_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cat_product_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
cat_product_list.ShowHighlightText = "Show highlight"; 
cat_product_list.HideHighlightText = "Hide highlight";

//-->
</script>
<style>

	/* styles for details panel */
	.yui-overlay { position:absolute;background:#fff;border:2px solid orange;padding:4px;margin:10px; }
	.yui-overlay .hd { border:1px solid red;padding:5px; }
	.yui-overlay .bd { border:0px solid green;padding:5px; }
	.yui-overlay .ft { border:1px solid blue;padding:5px; }
</style>
<div id="ewDetailsDiv" name="ewDetailsDivDiv" style="visibility:hidden"></div>
<script language="JavaScript" type="text/javascript">
<!--

// YUI container
var ewDetailsDiv;
var ew_AjaxDetailsTimer = null;

// init details div
function ew_InitDetailsDiv() {
	ewDetailsDiv = new YAHOO.widget.Overlay("ewDetailsDiv", { context:null, visible:false} );
	ewDetailsDiv.beforeMoveEvent.subscribe(ew_EnforceConstraints, ewDetailsDiv, true);
	ewDetailsDiv.render();
}

// init details div on window.load
YAHOO.util.Event.addListener(window, "load", ew_InitDetailsDiv);

// show results in details div
var ew_AjaxHandleSuccess = function(o) {
	if (ewDetailsDiv && o.responseText !== undefined) {
		ewDetailsDiv.cfg.applyConfig({context:[o.argument.id,o.argument.elcorner,o.argument.ctxcorner], visible:false}, true);
		ewDetailsDiv.setBody(o.responseText);
		ewDetailsDiv.render();
		ew_SetupTable(document.getElementById("ewDetailsPreviewTable"));
		ewDetailsDiv.show();
	}
}

// show error in details div
var ew_AjaxHandleFailure = function(o) {
	if (ewDetailsDiv && o.responseText != "") {
		ewDetailsDiv.cfg.applyConfig({context:[o.argument.id,o.argument.elcorner,o.argument.ctxcorner], visible:false, constraintoviewport:true}, true);
		ewDetailsDiv.setBody(o.responseText);
		ewDetailsDiv.render();
		ewDetailsDiv.show();
	}
}

// show details div
function ew_AjaxShowDetails(obj, url) {
	if (ew_AjaxDetailsTimer)
		clearTimeout(ew_AjaxDetailsTimer);
	ew_AjaxDetailsTimer = setTimeout(function() { YAHOO.util.Connect.asyncRequest('GET', url, {success: ew_AjaxHandleSuccess , failure: ew_AjaxHandleFailure, argument:{id: obj.id, elcorner: "tr", ctxcorner: "tl"}}) }, 200);
}

// hide details div
function ew_AjaxHideDetails(obj) {
	if (ew_AjaxDetailsTimer)
		clearTimeout(ew_AjaxDetailsTimer);
	if (ewDetailsDiv)
		ewDetailsDiv.hide();
}

// move details div
ew_EnforceConstraints = function(type, args, obj) {
	var pos = args[0];
	var x = pos[0];
	var y = pos[1];
	var offsetHeight = this.element.offsetHeight;
	var offsetWidth = this.element.offsetWidth;
	var viewPortWidth = YAHOO.util.Dom.getViewportWidth();
	var viewPortHeight = YAHOO.util.Dom.getViewportHeight();
	var scrollX = document.documentElement.scrollLeft || document.body.scrollLeft;
	var scrollY = document.documentElement.scrollTop || document.body.scrollTop;
	var topConstraint = scrollY + 10;
	var leftConstraint = scrollX + 10;
	var bottomConstraint = scrollY + viewPortHeight - offsetHeight - 10;
	var rightConstraint = scrollX + viewPortWidth - offsetWidth - 10;

// if (x < leftConstraint) {
// x = leftConstraint;
// } else if (x > rightConstraint) {
// x = rightConstraint;
// }

	if (y < topConstraint) {
		y = topConstraint;
	} else if (y > bottomConstraint) {
		y = (bottomConstraint < topConstraint) ? topConstraint : bottomConstraint;
	}

// this.cfg.setProperty("x", x, true);
	this.cfg.setProperty("y", y, true);
	this.cfg.setProperty("xy", [x,y], true);
};

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($cat_product->Export == "") { ?>
<?php
$gsMasterReturnUrl = "categorylist.php";
if ($cat_product_list->sDbMasterFilter <> "" && $cat_product->getCurrentMasterTable() == "category") {
	if ($cat_product_list->bMasterRecordExists) {
		if ($cat_product->getCurrentMasterTable() == $cat_product->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "categorymaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = ($cat_product->Export == "" && $cat_product->SelectLimit);
	if (!$bSelectLimit)
		$rs = $cat_product_list->LoadRecordset();
	$cat_product_list->lTotalRecs = ($bSelectLimit) ? $cat_product->SelectRecordCount() : $rs->RecordCount();
	$cat_product_list->lStartRec = 1;
	if ($cat_product_list->lDisplayRecs <= 0) // Display all records
		$cat_product_list->lDisplayRecs = $cat_product_list->lTotalRecs;
	if (!($cat_product->ExportAll && $cat_product->Export <> ""))
		$cat_product_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $cat_product_list->LoadRecordset($cat_product_list->lStartRec-1, $cat_product_list->lDisplayRecs);
?>
<div align="center" class="msm_h1">TABLE: Cat Product</div>
<p><span class="phpmaker" style="white-space: nowrap;">
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($cat_product->Export == "" && $cat_product->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(cat_product_list);" style="text-decoration: none;"><img id="cat_product_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="cat_product_list_SearchPanel">
<form name="fcat_productlistsrch" id="fcat_productlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="cat_product">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($cat_product->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<a href="<?php echo $cat_product_list->PageUrl() ?>cmd=reset">Show all</a>&nbsp;
			<?php if ($cat_product_list->sSrchWhere <> "" && $cat_product_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(cat_product_list, this, '<?php echo $cat_product->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($cat_product->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Exact phrase</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($cat_product->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>All words</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($cat_product->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Any word</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $cat_product_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($cat_product->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($cat_product->CurrentAction <> "gridadd" && $cat_product->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($cat_product_list->Pager)) $cat_product_list->Pager = new cNumericPager($cat_product_list->lStartRec, $cat_product_list->lDisplayRecs, $cat_product_list->lTotalRecs, $cat_product_list->lRecRange) ?>
<?php if ($cat_product_list->Pager->RecordCount > 0) { ?>
	<?php if ($cat_product_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $cat_product_list->PageUrl() ?>start=<?php echo $cat_product_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($cat_product_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $cat_product_list->PageUrl() ?>start=<?php echo $cat_product_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($cat_product_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $cat_product_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($cat_product_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $cat_product_list->PageUrl() ?>start=<?php echo $cat_product_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($cat_product_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $cat_product_list->PageUrl() ?>start=<?php echo $cat_product_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($cat_product_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $cat_product_list->Pager->FromIndex ?> to <?php echo $cat_product_list->Pager->ToIndex ?> of <?php echo $cat_product_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($cat_product_list->sSrchWhere == "0=101") { ?>
	Please enter search criteria
	<?php } else { ?>
	No records found
	<?php } ?>
<?php } ?>
</span>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $cat_product->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fcat_productlist" id="fcat_productlist" class="ewForm" action="" method="post">
<?php if ($cat_product_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$cat_product_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$cat_product_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$cat_product_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$cat_product_list->lOptionCnt++; // Delete
}
if ($Security->IsLoggedIn()) {
	$cat_product_list->lOptionCnt++; // Detail
}
	$cat_product_list->lOptionCnt += count($cat_product_list->ListOptions->Items); // Custom list options
?>
<?php echo $cat_product->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($cat_product->id->Visible) { // id ?>
	<?php if ($cat_product->SortUrl($cat_product->id) == "") { ?>
		<td>Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_product->SortUrl($cat_product->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($cat_product->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_product->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_product->cat_id->Visible) { // cat_id ?>
	<?php if ($cat_product->SortUrl($cat_product->cat_id) == "") { ?>
		<td>Cat Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_product->SortUrl($cat_product->cat_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Cat Id</td><td style="width: 10px;"><?php if ($cat_product->cat_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_product->cat_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_product->manufacture_id->Visible) { // manufacture_id ?>
	<?php if ($cat_product->SortUrl($cat_product->manufacture_id) == "") { ?>
		<td>Manufacture Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_product->SortUrl($cat_product->manufacture_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Manufacture Id</td><td style="width: 10px;"><?php if ($cat_product->manufacture_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_product->manufacture_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_product->type->Visible) { // type ?>
	<?php if ($cat_product->SortUrl($cat_product->type) == "") { ?>
		<td>Type</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_product->SortUrl($cat_product->type) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Type</td><td style="width: 10px;"><?php if ($cat_product->type->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_product->type->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_product->name->Visible) { // name ?>
	<?php if ($cat_product->SortUrl($cat_product->name) == "") { ?>
		<td>Name</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_product->SortUrl($cat_product->name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Name&nbsp;(*)</td><td style="width: 10px;"><?php if ($cat_product->name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_product->name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_product->photo->Visible) { // photo ?>
	<?php if ($cat_product->SortUrl($cat_product->photo) == "") { ?>
		<td>Photo</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_product->SortUrl($cat_product->photo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Photo</td><td style="width: 10px;"><?php if ($cat_product->photo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_product->photo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_product->year->Visible) { // year ?>
	<?php if ($cat_product->SortUrl($cat_product->year) == "") { ?>
		<td>Year</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_product->SortUrl($cat_product->year) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Year&nbsp;(*)</td><td style="width: 10px;"><?php if ($cat_product->year->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_product->year->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_product->model->Visible) { // model ?>
	<?php if ($cat_product->SortUrl($cat_product->model) == "") { ?>
		<td>Model</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_product->SortUrl($cat_product->model) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Model&nbsp;(*)</td><td style="width: 10px;"><?php if ($cat_product->model->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_product->model->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_product->price->Visible) { // price ?>
	<?php if ($cat_product->SortUrl($cat_product->price) == "") { ?>
		<td>Price</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_product->SortUrl($cat_product->price) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Price&nbsp;(*)</td><td style="width: 10px;"><?php if ($cat_product->price->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_product->price->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_product->location->Visible) { // location ?>
	<?php if ($cat_product->SortUrl($cat_product->location) == "") { ?>
		<td>Location</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_product->SortUrl($cat_product->location) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Location&nbsp;(*)</td><td style="width: 10px;"><?php if ($cat_product->location->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_product->location->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_product->serial_no->Visible) { // serial_no ?>
	<?php if ($cat_product->SortUrl($cat_product->serial_no) == "") { ?>
		<td>Serial No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_product->SortUrl($cat_product->serial_no) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Serial No&nbsp;(*)</td><td style="width: 10px;"><?php if ($cat_product->serial_no->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_product->serial_no->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_product->condition->Visible) { // condition ?>
	<?php if ($cat_product->SortUrl($cat_product->condition) == "") { ?>
		<td>Condition</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_product->SortUrl($cat_product->condition) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Condition</td><td style="width: 10px;"><?php if ($cat_product->condition->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_product->condition->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_product->stock_no->Visible) { // stock_no ?>
	<?php if ($cat_product->SortUrl($cat_product->stock_no) == "") { ?>
		<td>Stock No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_product->SortUrl($cat_product->stock_no) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Stock No&nbsp;(*)</td><td style="width: 10px;"><?php if ($cat_product->stock_no->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_product->stock_no->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_product->horse_power->Visible) { // horse_power ?>
	<?php if ($cat_product->SortUrl($cat_product->horse_power) == "") { ?>
		<td>Horse Power</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_product->SortUrl($cat_product->horse_power) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Horse Power&nbsp;(*)</td><td style="width: 10px;"><?php if ($cat_product->horse_power->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_product->horse_power->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_product->hour->Visible) { // hour ?>
	<?php if ($cat_product->SortUrl($cat_product->hour) == "") { ?>
		<td>Hour</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_product->SortUrl($cat_product->hour) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Hour&nbsp;(*)</td><td style="width: 10px;"><?php if ($cat_product->hour->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_product->hour->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_product->drive->Visible) { // drive ?>
	<?php if ($cat_product->SortUrl($cat_product->drive) == "") { ?>
		<td>Drive</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_product->SortUrl($cat_product->drive) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Drive&nbsp;(*)</td><td style="width: 10px;"><?php if ($cat_product->drive->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_product->drive->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_product->date_update->Visible) { // date_update ?>
	<?php if ($cat_product->SortUrl($cat_product->date_update) == "") { ?>
		<td>Date Update</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_product->SortUrl($cat_product->date_update) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Date Update</td><td style="width: 10px;"><?php if ($cat_product->date_update->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_product->date_update->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_product->sort_order->Visible) { // sort_order ?>
	<?php if ($cat_product->SortUrl($cat_product->sort_order) == "") { ?>
		<td>Sort Order</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_product->SortUrl($cat_product->sort_order) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Sort Order</td><td style="width: 10px;"><?php if ($cat_product->sort_order->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_product->sort_order->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_product->status->Visible) { // status ?>
	<?php if ($cat_product->SortUrl($cat_product->status) == "") { ?>
		<td>Status</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_product->SortUrl($cat_product->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Status</td><td style="width: 10px;"><?php if ($cat_product->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_product->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_product->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php

// Custom list options
foreach ($cat_product_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($cat_product->ExportAll && $cat_product->Export <> "") {
	$cat_product_list->lStopRec = $cat_product_list->lTotalRecs;
} else {
	$cat_product_list->lStopRec = $cat_product_list->lStartRec + $cat_product_list->lDisplayRecs - 1; // Set the last record to display
}
$cat_product_list->lRecCount = $cat_product_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$cat_product->SelectLimit && $cat_product_list->lStartRec > 1)
		$rs->Move($cat_product_list->lStartRec - 1);
}
$cat_product_list->lRowCnt = 0;
while (($cat_product->CurrentAction == "gridadd" || !$rs->EOF) &&
	$cat_product_list->lRecCount < $cat_product_list->lStopRec) {
	$cat_product_list->lRecCount++;
	if (intval($cat_product_list->lRecCount) >= intval($cat_product_list->lStartRec)) {
		$cat_product_list->lRowCnt++;

	// Init row class and style
	$cat_product->CssClass = "";
	$cat_product->CssStyle = "";
	$cat_product->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($cat_product->CurrentAction == "gridadd") {
		$cat_product_list->LoadDefaultValues(); // Load default values
	} else {
		$cat_product_list->LoadRowValues($rs); // Load row values
	}
	$cat_product->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$cat_product_list->RenderRow();
?>
	<tr<?php echo $cat_product->RowAttributes() ?>>
	<?php if ($cat_product->id->Visible) { // id ?>
		<td<?php echo $cat_product->id->CellAttributes() ?>>
<div<?php echo $cat_product->id->ViewAttributes() ?>><?php echo $cat_product->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cat_product->cat_id->Visible) { // cat_id ?>
		<td<?php echo $cat_product->cat_id->CellAttributes() ?>>
<div<?php echo $cat_product->cat_id->ViewAttributes() ?>><?php echo $cat_product->cat_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cat_product->manufacture_id->Visible) { // manufacture_id ?>
		<td<?php echo $cat_product->manufacture_id->CellAttributes() ?>>
<div<?php echo $cat_product->manufacture_id->ViewAttributes() ?>><?php echo $cat_product->manufacture_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cat_product->type->Visible) { // type ?>
		<td<?php echo $cat_product->type->CellAttributes() ?>>
<div<?php echo $cat_product->type->ViewAttributes() ?>><?php echo $cat_product->type->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cat_product->name->Visible) { // name ?>
		<td<?php echo $cat_product->name->CellAttributes() ?>>
<div<?php echo $cat_product->name->ViewAttributes() ?>><?php echo $cat_product->name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cat_product->photo->Visible) { // photo ?>
		<td<?php echo $cat_product->photo->CellAttributes() ?>>
<?php if ($cat_product->photo->HrefValue <> "") { ?>
<?php if (!is_null($cat_product->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $cat_product->photo->Upload->DbValue ?>" border=0<?php echo $cat_product->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($cat_product->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($cat_product->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $cat_product->photo->Upload->DbValue ?>" border=0<?php echo $cat_product->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($cat_product->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cat_product->year->Visible) { // year ?>
		<td<?php echo $cat_product->year->CellAttributes() ?>>
<div<?php echo $cat_product->year->ViewAttributes() ?>><?php echo $cat_product->year->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cat_product->model->Visible) { // model ?>
		<td<?php echo $cat_product->model->CellAttributes() ?>>
<div<?php echo $cat_product->model->ViewAttributes() ?>><?php echo $cat_product->model->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cat_product->price->Visible) { // price ?>
		<td<?php echo $cat_product->price->CellAttributes() ?>>
<div<?php echo $cat_product->price->ViewAttributes() ?>><?php echo $cat_product->price->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cat_product->location->Visible) { // location ?>
		<td<?php echo $cat_product->location->CellAttributes() ?>>
<div<?php echo $cat_product->location->ViewAttributes() ?>><?php echo $cat_product->location->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cat_product->serial_no->Visible) { // serial_no ?>
		<td<?php echo $cat_product->serial_no->CellAttributes() ?>>
<div<?php echo $cat_product->serial_no->ViewAttributes() ?>><?php echo $cat_product->serial_no->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cat_product->condition->Visible) { // condition ?>
		<td<?php echo $cat_product->condition->CellAttributes() ?>>
<div<?php echo $cat_product->condition->ViewAttributes() ?>><?php echo $cat_product->condition->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cat_product->stock_no->Visible) { // stock_no ?>
		<td<?php echo $cat_product->stock_no->CellAttributes() ?>>
<div<?php echo $cat_product->stock_no->ViewAttributes() ?>><?php echo $cat_product->stock_no->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cat_product->horse_power->Visible) { // horse_power ?>
		<td<?php echo $cat_product->horse_power->CellAttributes() ?>>
<div<?php echo $cat_product->horse_power->ViewAttributes() ?>><?php echo $cat_product->horse_power->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cat_product->hour->Visible) { // hour ?>
		<td<?php echo $cat_product->hour->CellAttributes() ?>>
<div<?php echo $cat_product->hour->ViewAttributes() ?>><?php echo $cat_product->hour->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cat_product->drive->Visible) { // drive ?>
		<td<?php echo $cat_product->drive->CellAttributes() ?>>
<div<?php echo $cat_product->drive->ViewAttributes() ?>><?php echo $cat_product->drive->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cat_product->date_update->Visible) { // date_update ?>
		<td<?php echo $cat_product->date_update->CellAttributes() ?>>
<div<?php echo $cat_product->date_update->ViewAttributes() ?>><?php echo $cat_product->date_update->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cat_product->sort_order->Visible) { // sort_order ?>
		<td<?php echo $cat_product->sort_order->CellAttributes() ?>>
<div<?php echo $cat_product->sort_order->ViewAttributes() ?>><?php echo $cat_product->sort_order->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cat_product->status->Visible) { // status ?>
		<td<?php echo $cat_product->status->CellAttributes() ?>>
<div<?php echo $cat_product->status->ViewAttributes() ?>><?php echo $cat_product->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($cat_product->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $cat_product->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $cat_product->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $cat_product->DeleteUrl() ?>"><img src='images/delete.gif' alt='Delete' title='Delete' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<?php
$sSqlWrk = "`product_id`=" . ew_AdjustSql($cat_product->id->CurrentValue) . "";
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
$sSqlWrk = str_replace("'", "\'", $sSqlWrk);
?>
<a name="ew_cat_product_cat_p_photo_DetailLink<?php echo $cat_product_list->lRowCnt ?>" id="ew_cat_product_cat_p_photo_DetailLink<?php echo $cat_product_list->lRowCnt ?>" href="cat_p_photolist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=cat_product&id=<?php echo urlencode(strval($cat_product->id->CurrentValue)) ?>" onmouseover="ew_AjaxShowDetails(this, 'cat_p_photopreview.php?f=<?php echo $sSqlWrk ?>')" onmouseout="ew_AjaxHideDetails(this);">Cat P Photo<img src='images/detail.gif' alt='Details' title='Details' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($cat_product_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($cat_product->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($cat_product_list->lTotalRecs > 0) { ?>
<?php if ($cat_product->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($cat_product->CurrentAction <> "gridadd" && $cat_product->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($cat_product_list->Pager)) $cat_product_list->Pager = new cNumericPager($cat_product_list->lStartRec, $cat_product_list->lDisplayRecs, $cat_product_list->lTotalRecs, $cat_product_list->lRecRange) ?>
<?php if ($cat_product_list->Pager->RecordCount > 0) { ?>
	<?php if ($cat_product_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $cat_product_list->PageUrl() ?>start=<?php echo $cat_product_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($cat_product_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $cat_product_list->PageUrl() ?>start=<?php echo $cat_product_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($cat_product_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $cat_product_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($cat_product_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $cat_product_list->PageUrl() ?>start=<?php echo $cat_product_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($cat_product_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $cat_product_list->PageUrl() ?>start=<?php echo $cat_product_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($cat_product_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $cat_product_list->Pager->FromIndex ?> to <?php echo $cat_product_list->Pager->ToIndex ?> of <?php echo $cat_product_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($cat_product_list->sSrchWhere == "0=101") { ?>
	Please enter search criteria
	<?php } else { ?>
	No records found
	<?php } ?>
<?php } ?>
</span>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($cat_product_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $cat_product->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($cat_product->Export == "" && $cat_product->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(cat_product_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($cat_product->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php

//
// Page Class
//
class ccat_product_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'cat_product';

	// Page Object Name
	var $PageObjName = 'cat_product_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $cat_product;
		if ($cat_product->UseTokenInUrl) $PageUrl .= "t=" . $cat_product->TableVar . "&"; // add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show Message
	function ShowMessage() {
		if ($this->getMessage() <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $this->getMessage() . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate Page request
	function IsPageRequest() {
		global $objForm, $cat_product;
		if ($cat_product->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($cat_product->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($cat_product->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccat_product_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["cat_product"] = new ccat_product();

		// Initialize other table object
		$GLOBALS['category'] = new ccategory();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cat_product', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $cat_product;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$cat_product->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $cat_product->Export; // Get export parameter, used in header
	$gsExportFile = $cat_product->TableVar; // Get export file, used in header

		// Global page loading event (in userfn6.php)
		Page_Loading();

		// Page load event, used in current page
		$this->Page_Load();
	}

	//
	//  Page_Terminate
	//  - called when exit page
	//  - if URL specified, redirect to the URL
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page unload event, used in current page
		$this->Page_Unload();

		// Global page unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close Connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			ob_end_clean();
			header("Location: $url");
		}
		exit();
	}
	var $lDisplayRecs; // Number of display records
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs;
	var $lRecRange;
	var $sSrchWhere;
	var $lRecCnt;
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex;
	var $lOptionCnt;
	var $lRecPerRow;
	var $lColCnt;
	var $sDeleteConfirmMsg; // Delete confirm message
	var $sDbMasterFilter;
	var $sDbDetailFilter;
	var $bMasterRecordExists;	
	var $ListOptions;
	var $sMultiSelectKey;

	//
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsSearchError, $Security, $cat_product;
		$this->lDisplayRecs = 20;
		$this->lRecRange = 10;
		$this->lRecCnt = 0; // Record count

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		$this->sSrchWhere = ""; // Search WHERE clause

		// Master/Detail
		$this->sDbMasterFilter = ""; // Master filter
		$this->sDbDetailFilter = ""; // Detail filter
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up master detail parameters
			$this->SetUpMasterDetail();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($cat_product->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $cat_product->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "($this->sSrchWhere) AND ($sSrchAdvanced)" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "($this->sSrchWhere) AND ($sSrchBasic)" : $sSrchBasic;

		// Call Recordset_Searching event
		$cat_product->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$cat_product->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$cat_product->setStartRecordNumber($this->lStartRec);
		} else {
			$this->RestoreSearchParms();
		}

		// Build filter
		$sFilter = "";

		// Restore master/detail filter
		$this->sDbMasterFilter = $cat_product->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $cat_product->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($cat_product->getMasterFilter() <> "" && $cat_product->getCurrentMasterTable() == "category") {
			global $category;
			$rsmaster = $category->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$cat_product->setMasterFilter(""); // Clear master filter
				$cat_product->setDetailFilter(""); // Clear detail filter
				$this->setMessage("No records found"); // Set no record found
				$this->Page_Terminate($cat_product->getReturnUrl()); // Return to caller
			} else {
				$category->LoadListRowValues($rsmaster);
				$category->RowType = EW_ROWTYPE_MASTER; // Master row
				$category->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in Session
		$cat_product->setSessionWhere($sFilter);
		$cat_product->CurrentFilter = "";
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $cat_product;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $cat_product->name->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $cat_product->photo->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $cat_product->year->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $cat_product->model->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $cat_product->price->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $cat_product->location->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $cat_product->serial_no->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $cat_product->stock_no->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $cat_product->horse_power->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $cat_product->hour->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $cat_product->drive->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $cat_product->general_info->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $cat_product->description->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $cat_product;
		$sSearchStr = "";
		$sSearchKeyword = ew_StripSlashes(@$_GET[EW_TABLE_BASIC_SEARCH]);
		$sSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$cat_product->setBasicSearchKeyword($sSearchKeyword);
			$cat_product->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $cat_product;
		$this->sSrchWhere = "";
		$cat_product->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $cat_product;
		$cat_product->setBasicSearchKeyword("");
		$cat_product->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $cat_product;
		$this->sSrchWhere = $cat_product->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $cat_product;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$cat_product->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$cat_product->CurrentOrderType = @$_GET["ordertype"];
			$cat_product->UpdateSort($cat_product->id); // Field 
			$cat_product->UpdateSort($cat_product->cat_id); // Field 
			$cat_product->UpdateSort($cat_product->manufacture_id); // Field 
			$cat_product->UpdateSort($cat_product->type); // Field 
			$cat_product->UpdateSort($cat_product->name); // Field 
			$cat_product->UpdateSort($cat_product->photo); // Field 
			$cat_product->UpdateSort($cat_product->year); // Field 
			$cat_product->UpdateSort($cat_product->model); // Field 
			$cat_product->UpdateSort($cat_product->price); // Field 
			$cat_product->UpdateSort($cat_product->location); // Field 
			$cat_product->UpdateSort($cat_product->serial_no); // Field 
			$cat_product->UpdateSort($cat_product->condition); // Field 
			$cat_product->UpdateSort($cat_product->stock_no); // Field 
			$cat_product->UpdateSort($cat_product->horse_power); // Field 
			$cat_product->UpdateSort($cat_product->hour); // Field 
			$cat_product->UpdateSort($cat_product->drive); // Field 
			$cat_product->UpdateSort($cat_product->date_update); // Field 
			$cat_product->UpdateSort($cat_product->sort_order); // Field 
			$cat_product->UpdateSort($cat_product->status); // Field 
			$cat_product->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $cat_product;
		$sOrderBy = $cat_product->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($cat_product->SqlOrderBy() <> "") {
				$sOrderBy = $cat_product->SqlOrderBy();
				$cat_product->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $cat_product;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$cat_product->getCurrentMasterTable = ""; // Clear master table
				$cat_product->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$cat_product->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$cat_product->cat_id->setSessionValue("");
			}

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$cat_product->setSessionOrderBy($sOrderBy);
				$cat_product->id->setSort("");
				$cat_product->cat_id->setSort("");
				$cat_product->manufacture_id->setSort("");
				$cat_product->type->setSort("");
				$cat_product->name->setSort("");
				$cat_product->photo->setSort("");
				$cat_product->year->setSort("");
				$cat_product->model->setSort("");
				$cat_product->price->setSort("");
				$cat_product->location->setSort("");
				$cat_product->serial_no->setSort("");
				$cat_product->condition->setSort("");
				$cat_product->stock_no->setSort("");
				$cat_product->horse_power->setSort("");
				$cat_product->hour->setSort("");
				$cat_product->drive->setSort("");
				$cat_product->date_update->setSort("");
				$cat_product->sort_order->setSort("");
				$cat_product->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$cat_product->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $cat_product;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$cat_product->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$cat_product->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $cat_product->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$cat_product->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$cat_product->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$cat_product->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $cat_product;

		// Call Recordset Selecting event
		$cat_product->Recordset_Selecting($cat_product->CurrentFilter);

		// Load list page SQL
		$sSql = $cat_product->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$cat_product->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $cat_product;
		$sFilter = $cat_product->KeyFilter();

		// Call Row Selecting event
		$cat_product->Row_Selecting($sFilter);

		// Load sql based on filter
		$cat_product->CurrentFilter = $sFilter;
		$sSql = $cat_product->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$cat_product->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $cat_product;
		$cat_product->id->setDbValue($rs->fields('id'));
		$cat_product->cat_id->setDbValue($rs->fields('cat_id'));
		$cat_product->manufacture_id->setDbValue($rs->fields('manufacture_id'));
		$cat_product->type->setDbValue($rs->fields('type'));
		$cat_product->name->setDbValue($rs->fields('name'));
		$cat_product->photo->Upload->DbValue = $rs->fields('photo');
		$cat_product->year->setDbValue($rs->fields('year'));
		$cat_product->model->setDbValue($rs->fields('model'));
		$cat_product->price->setDbValue($rs->fields('price'));
		$cat_product->location->setDbValue($rs->fields('location'));
		$cat_product->serial_no->setDbValue($rs->fields('serial_no'));
		$cat_product->condition->setDbValue($rs->fields('condition'));
		$cat_product->stock_no->setDbValue($rs->fields('stock_no'));
		$cat_product->horse_power->setDbValue($rs->fields('horse_power'));
		$cat_product->hour->setDbValue($rs->fields('hour'));
		$cat_product->drive->setDbValue($rs->fields('drive'));
		$cat_product->general_info->setDbValue($rs->fields('general_info'));
		$cat_product->description->setDbValue($rs->fields('description'));
		$cat_product->date_update->setDbValue($rs->fields('date_update'));
		$cat_product->sort_order->setDbValue($rs->fields('sort_order'));
		$cat_product->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $cat_product;

		// Call Row_Rendering event
		$cat_product->Row_Rendering();

		// Common render codes for all row types
		// id

		$cat_product->id->CellCssStyle = "";
		$cat_product->id->CellCssClass = "";

		// cat_id
		$cat_product->cat_id->CellCssStyle = "";
		$cat_product->cat_id->CellCssClass = "";

		// manufacture_id
		$cat_product->manufacture_id->CellCssStyle = "";
		$cat_product->manufacture_id->CellCssClass = "";

		// type
		$cat_product->type->CellCssStyle = "";
		$cat_product->type->CellCssClass = "";

		// name
		$cat_product->name->CellCssStyle = "";
		$cat_product->name->CellCssClass = "";

		// photo
		$cat_product->photo->CellCssStyle = "";
		$cat_product->photo->CellCssClass = "";

		// year
		$cat_product->year->CellCssStyle = "";
		$cat_product->year->CellCssClass = "";

		// model
		$cat_product->model->CellCssStyle = "";
		$cat_product->model->CellCssClass = "";

		// price
		$cat_product->price->CellCssStyle = "";
		$cat_product->price->CellCssClass = "";

		// location
		$cat_product->location->CellCssStyle = "";
		$cat_product->location->CellCssClass = "";

		// serial_no
		$cat_product->serial_no->CellCssStyle = "";
		$cat_product->serial_no->CellCssClass = "";

		// condition
		$cat_product->condition->CellCssStyle = "";
		$cat_product->condition->CellCssClass = "";

		// stock_no
		$cat_product->stock_no->CellCssStyle = "";
		$cat_product->stock_no->CellCssClass = "";

		// horse_power
		$cat_product->horse_power->CellCssStyle = "";
		$cat_product->horse_power->CellCssClass = "";

		// hour
		$cat_product->hour->CellCssStyle = "";
		$cat_product->hour->CellCssClass = "";

		// drive
		$cat_product->drive->CellCssStyle = "";
		$cat_product->drive->CellCssClass = "";

		// date_update
		$cat_product->date_update->CellCssStyle = "";
		$cat_product->date_update->CellCssClass = "";

		// sort_order
		$cat_product->sort_order->CellCssStyle = "";
		$cat_product->sort_order->CellCssClass = "";

		// status
		$cat_product->status->CellCssStyle = "";
		$cat_product->status->CellCssClass = "";
		if ($cat_product->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$cat_product->id->ViewValue = $cat_product->id->CurrentValue;
			$cat_product->id->CssStyle = "";
			$cat_product->id->CssClass = "";
			$cat_product->id->ViewCustomAttributes = "";

			// cat_id
			if (strval($cat_product->cat_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name` FROM `category` WHERE `id` = " . ew_AdjustSql($cat_product->cat_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$cat_product->cat_id->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$cat_product->cat_id->ViewValue = $cat_product->cat_id->CurrentValue;
				}
			} else {
				$cat_product->cat_id->ViewValue = NULL;
			}
			$cat_product->cat_id->CssStyle = "";
			$cat_product->cat_id->CssClass = "";
			$cat_product->cat_id->ViewCustomAttributes = "";

			// manufacture_id
			if (strval($cat_product->manufacture_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name` FROM `manufacture` WHERE `id` = " . ew_AdjustSql($cat_product->manufacture_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$cat_product->manufacture_id->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$cat_product->manufacture_id->ViewValue = $cat_product->manufacture_id->CurrentValue;
				}
			} else {
				$cat_product->manufacture_id->ViewValue = NULL;
			}
			$cat_product->manufacture_id->CssStyle = "";
			$cat_product->manufacture_id->CssClass = "";
			$cat_product->manufacture_id->ViewCustomAttributes = "";

			// type
			if (strval($cat_product->type->CurrentValue) <> "") {
				switch ($cat_product->type->CurrentValue) {
					case "1":
						$cat_product->type->ViewValue = "Machine";
						break;
					case "2":
						$cat_product->type->ViewValue = "parts";
						break;
					default:
						$cat_product->type->ViewValue = $cat_product->type->CurrentValue;
				}
			} else {
				$cat_product->type->ViewValue = NULL;
			}
			$cat_product->type->CssStyle = "";
			$cat_product->type->CssClass = "";
			$cat_product->type->ViewCustomAttributes = "";

			// name
			$cat_product->name->ViewValue = $cat_product->name->CurrentValue;
			$cat_product->name->ViewValue = ew_Highlight($cat_product->HighlightName(), $cat_product->name->ViewValue, $cat_product->getBasicSearchKeyword(), $cat_product->getBasicSearchType(), "");
			$cat_product->name->CssStyle = "";
			$cat_product->name->CssClass = "";
			$cat_product->name->ViewCustomAttributes = "";

			// photo
			if (!is_null($cat_product->photo->Upload->DbValue)) {
				$cat_product->photo->ViewValue = $cat_product->photo->Upload->DbValue;
				$cat_product->photo->ImageWidth = 120;
				$cat_product->photo->ImageHeight = 0;
				$cat_product->photo->ImageAlt = "";
			} else {
				$cat_product->photo->ViewValue = "";
			}
			$cat_product->photo->CssStyle = "";
			$cat_product->photo->CssClass = "";
			$cat_product->photo->ViewCustomAttributes = "";

			// year
			$cat_product->year->ViewValue = $cat_product->year->CurrentValue;
			$cat_product->year->ViewValue = ew_Highlight($cat_product->HighlightName(), $cat_product->year->ViewValue, $cat_product->getBasicSearchKeyword(), $cat_product->getBasicSearchType(), "");
			$cat_product->year->CssStyle = "";
			$cat_product->year->CssClass = "";
			$cat_product->year->ViewCustomAttributes = "";

			// model
			$cat_product->model->ViewValue = $cat_product->model->CurrentValue;
			$cat_product->model->ViewValue = ew_Highlight($cat_product->HighlightName(), $cat_product->model->ViewValue, $cat_product->getBasicSearchKeyword(), $cat_product->getBasicSearchType(), "");
			$cat_product->model->CssStyle = "";
			$cat_product->model->CssClass = "";
			$cat_product->model->ViewCustomAttributes = "";

			// price
			$cat_product->price->ViewValue = $cat_product->price->CurrentValue;
			$cat_product->price->ViewValue = ew_Highlight($cat_product->HighlightName(), $cat_product->price->ViewValue, $cat_product->getBasicSearchKeyword(), $cat_product->getBasicSearchType(), "");
			$cat_product->price->CssStyle = "";
			$cat_product->price->CssClass = "";
			$cat_product->price->ViewCustomAttributes = "";

			// location
			$cat_product->location->ViewValue = $cat_product->location->CurrentValue;
			$cat_product->location->ViewValue = ew_Highlight($cat_product->HighlightName(), $cat_product->location->ViewValue, $cat_product->getBasicSearchKeyword(), $cat_product->getBasicSearchType(), "");
			$cat_product->location->CssStyle = "";
			$cat_product->location->CssClass = "";
			$cat_product->location->ViewCustomAttributes = "";

			// serial_no
			$cat_product->serial_no->ViewValue = $cat_product->serial_no->CurrentValue;
			$cat_product->serial_no->ViewValue = ew_Highlight($cat_product->HighlightName(), $cat_product->serial_no->ViewValue, $cat_product->getBasicSearchKeyword(), $cat_product->getBasicSearchType(), "");
			$cat_product->serial_no->CssStyle = "";
			$cat_product->serial_no->CssClass = "";
			$cat_product->serial_no->ViewCustomAttributes = "";

			// condition
			if (strval($cat_product->condition->CurrentValue) <> "") {
				switch ($cat_product->condition->CurrentValue) {
					case "1":
						$cat_product->condition->ViewValue = "Used";
						break;
					case "2":
						$cat_product->condition->ViewValue = "Un Used";
						break;
					default:
						$cat_product->condition->ViewValue = $cat_product->condition->CurrentValue;
				}
			} else {
				$cat_product->condition->ViewValue = NULL;
			}
			$cat_product->condition->CssStyle = "";
			$cat_product->condition->CssClass = "";
			$cat_product->condition->ViewCustomAttributes = "";

			// stock_no
			$cat_product->stock_no->ViewValue = $cat_product->stock_no->CurrentValue;
			$cat_product->stock_no->ViewValue = ew_Highlight($cat_product->HighlightName(), $cat_product->stock_no->ViewValue, $cat_product->getBasicSearchKeyword(), $cat_product->getBasicSearchType(), "");
			$cat_product->stock_no->CssStyle = "";
			$cat_product->stock_no->CssClass = "";
			$cat_product->stock_no->ViewCustomAttributes = "";

			// horse_power
			$cat_product->horse_power->ViewValue = $cat_product->horse_power->CurrentValue;
			$cat_product->horse_power->ViewValue = ew_Highlight($cat_product->HighlightName(), $cat_product->horse_power->ViewValue, $cat_product->getBasicSearchKeyword(), $cat_product->getBasicSearchType(), "");
			$cat_product->horse_power->CssStyle = "";
			$cat_product->horse_power->CssClass = "";
			$cat_product->horse_power->ViewCustomAttributes = "";

			// hour
			$cat_product->hour->ViewValue = $cat_product->hour->CurrentValue;
			$cat_product->hour->ViewValue = ew_Highlight($cat_product->HighlightName(), $cat_product->hour->ViewValue, $cat_product->getBasicSearchKeyword(), $cat_product->getBasicSearchType(), "");
			$cat_product->hour->CssStyle = "";
			$cat_product->hour->CssClass = "";
			$cat_product->hour->ViewCustomAttributes = "";

			// drive
			$cat_product->drive->ViewValue = $cat_product->drive->CurrentValue;
			$cat_product->drive->ViewValue = ew_Highlight($cat_product->HighlightName(), $cat_product->drive->ViewValue, $cat_product->getBasicSearchKeyword(), $cat_product->getBasicSearchType(), "");
			$cat_product->drive->CssStyle = "";
			$cat_product->drive->CssClass = "";
			$cat_product->drive->ViewCustomAttributes = "";

			// date_update
			$cat_product->date_update->ViewValue = $cat_product->date_update->CurrentValue;
			$cat_product->date_update->ViewValue = ew_FormatDateTime($cat_product->date_update->ViewValue, 5);
			$cat_product->date_update->CssStyle = "";
			$cat_product->date_update->CssClass = "";
			$cat_product->date_update->ViewCustomAttributes = "";

			// sort_order
			$cat_product->sort_order->ViewValue = $cat_product->sort_order->CurrentValue;
			$cat_product->sort_order->CssStyle = "";
			$cat_product->sort_order->CssClass = "";
			$cat_product->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($cat_product->status->CurrentValue) <> "") {
				switch ($cat_product->status->CurrentValue) {
					case "1":
						$cat_product->status->ViewValue = "Active";
						break;
					case "2":
						$cat_product->status->ViewValue = "Not Active";
						break;
					default:
						$cat_product->status->ViewValue = $cat_product->status->CurrentValue;
				}
			} else {
				$cat_product->status->ViewValue = NULL;
			}
			$cat_product->status->CssStyle = "";
			$cat_product->status->CssClass = "";
			$cat_product->status->ViewCustomAttributes = "";

			// id
			$cat_product->id->HrefValue = "";

			// cat_id
			$cat_product->cat_id->HrefValue = "";

			// manufacture_id
			$cat_product->manufacture_id->HrefValue = "";

			// type
			$cat_product->type->HrefValue = "";

			// name
			$cat_product->name->HrefValue = "";

			// photo
			$cat_product->photo->HrefValue = "";

			// year
			$cat_product->year->HrefValue = "";

			// model
			$cat_product->model->HrefValue = "";

			// price
			$cat_product->price->HrefValue = "";

			// location
			$cat_product->location->HrefValue = "";

			// serial_no
			$cat_product->serial_no->HrefValue = "";

			// condition
			$cat_product->condition->HrefValue = "";

			// stock_no
			$cat_product->stock_no->HrefValue = "";

			// horse_power
			$cat_product->horse_power->HrefValue = "";

			// hour
			$cat_product->hour->HrefValue = "";

			// drive
			$cat_product->drive->HrefValue = "";

			// date_update
			$cat_product->date_update->HrefValue = "";

			// sort_order
			$cat_product->sort_order->HrefValue = "";

			// status
			$cat_product->status->HrefValue = "";
		}

		// Call Row Rendered event
		$cat_product->Row_Rendered();
	}

	// Set up Master Detail based on querystring parameter
	function SetUpMasterDetail() {
		global $cat_product;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "category") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $cat_product->SqlMasterFilter_category();
				$this->sDbDetailFilter = $cat_product->SqlDetailFilter_category();
				if (@$_GET["id"] <> "") {
					$GLOBALS["category"]->id->setQueryStringValue($_GET["id"]);
					$cat_product->cat_id->setQueryStringValue($GLOBALS["category"]->id->QueryStringValue);
					$cat_product->cat_id->setSessionValue($cat_product->cat_id->QueryStringValue);
					if (!is_numeric($GLOBALS["category"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["category"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@cat_id@", ew_AdjustSql($GLOBALS["category"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$cat_product->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$cat_product->setStartRecordNumber($this->lStartRec);
			$cat_product->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$cat_product->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master session values
			if ($sMasterTblVar <> "category") {
				if ($cat_product->cat_id->QueryStringValue == "") $cat_product->cat_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $cat_product->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $cat_product->getDetailFilter(); // Restore detail filter
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
