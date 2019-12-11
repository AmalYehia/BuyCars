<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
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
$category_list = new ccategory_list();
$Page =& $category_list;

// Page init processing
$category_list->Page_Init();

// Page main processing
$category_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($category->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var category_list = new ew_Page("category_list");

// page properties
category_list.PageID = "list"; // page ID
var EW_PAGE_ID = category_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
category_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
category_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
category_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

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
<?php if ($category->Export == "") { ?>
<?php
$gsMasterReturnUrl = "categorylist.php";
if ($category_list->sDbMasterFilter <> "" && $category->getCurrentMasterTable() == "category") {
	if ($category_list->bMasterRecordExists) {
		if ($category->getCurrentMasterTable() == $category->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "categorymaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = ($category->Export == "" && $category->SelectLimit);
	if (!$bSelectLimit)
		$rs = $category_list->LoadRecordset();
	$category_list->lTotalRecs = ($bSelectLimit) ? $category->SelectRecordCount() : $rs->RecordCount();
	$category_list->lStartRec = 1;
	if ($category_list->lDisplayRecs <= 0) // Display all records
		$category_list->lDisplayRecs = $category_list->lTotalRecs;
	if (!($category->ExportAll && $category->Export <> ""))
		$category_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $category_list->LoadRecordset($category_list->lStartRec-1, $category_list->lDisplayRecs);
?>
<div align="center" class="msm_h1">TABLE: Category</div>
<p><span class="phpmaker" style="white-space: nowrap;">
</span></p>
<?php $category_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($category->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($category->CurrentAction <> "gridadd" && $category->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($category_list->Pager)) $category_list->Pager = new cNumericPager($category_list->lStartRec, $category_list->lDisplayRecs, $category_list->lTotalRecs, $category_list->lRecRange) ?>
<?php if ($category_list->Pager->RecordCount > 0) { ?>
	<?php if ($category_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $category_list->PageUrl() ?>start=<?php echo $category_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($category_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $category_list->PageUrl() ?>start=<?php echo $category_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($category_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $category_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($category_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $category_list->PageUrl() ?>start=<?php echo $category_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($category_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $category_list->PageUrl() ?>start=<?php echo $category_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($category_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $category_list->Pager->FromIndex ?> to <?php echo $category_list->Pager->ToIndex ?> of <?php echo $category_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($category_list->sSrchWhere == "0=101") { ?>
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
<a href="<?php echo $category->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fcategorylist" id="fcategorylist" class="ewForm" action="" method="post">
<?php if ($category_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$category_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$category_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$category_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$category_list->lOptionCnt++; // Delete
}
if ($Security->IsLoggedIn()) {
	$category_list->lOptionCnt++; // Detail
}
if ($Security->IsLoggedIn()) {
	$category_list->lOptionCnt++; // Detail
}
	$category_list->lOptionCnt += count($category_list->ListOptions->Items); // Custom list options
?>
<?php echo $category->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($category->id->Visible) { // id ?>
	<?php if ($category->SortUrl($category->id) == "") { ?>
		<td>Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $category->SortUrl($category->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($category->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($category->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($category->parent_id->Visible) { // parent_id ?>
	<?php if ($category->SortUrl($category->parent_id) == "") { ?>
		<td>Parent Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $category->SortUrl($category->parent_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Parent Id</td><td style="width: 10px;"><?php if ($category->parent_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($category->parent_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($category->name->Visible) { // name ?>
	<?php if ($category->SortUrl($category->name) == "") { ?>
		<td>Name</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $category->SortUrl($category->name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Name</td><td style="width: 10px;"><?php if ($category->name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($category->name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($category->photo->Visible) { // photo ?>
	<?php if ($category->SortUrl($category->photo) == "") { ?>
		<td>Photo</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $category->SortUrl($category->photo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Photo</td><td style="width: 10px;"><?php if ($category->photo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($category->photo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($category->sort_order->Visible) { // sort_order ?>
	<?php if ($category->SortUrl($category->sort_order) == "") { ?>
		<td>Sort Order</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $category->SortUrl($category->sort_order) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Sort Order</td><td style="width: 10px;"><?php if ($category->sort_order->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($category->sort_order->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($category->status->Visible) { // status ?>
	<?php if ($category->SortUrl($category->status) == "") { ?>
		<td>Status</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $category->SortUrl($category->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Status</td><td style="width: 10px;"><?php if ($category->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($category->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($category->Export == "") { ?>
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
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php

// Custom list options
foreach ($category_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($category->ExportAll && $category->Export <> "") {
	$category_list->lStopRec = $category_list->lTotalRecs;
} else {
	$category_list->lStopRec = $category_list->lStartRec + $category_list->lDisplayRecs - 1; // Set the last record to display
}
$category_list->lRecCount = $category_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$category->SelectLimit && $category_list->lStartRec > 1)
		$rs->Move($category_list->lStartRec - 1);
}
$category_list->lRowCnt = 0;
while (($category->CurrentAction == "gridadd" || !$rs->EOF) &&
	$category_list->lRecCount < $category_list->lStopRec) {
	$category_list->lRecCount++;
	if (intval($category_list->lRecCount) >= intval($category_list->lStartRec)) {
		$category_list->lRowCnt++;

	// Init row class and style
	$category->CssClass = "";
	$category->CssStyle = "";
	$category->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($category->CurrentAction == "gridadd") {
		$category_list->LoadDefaultValues(); // Load default values
	} else {
		$category_list->LoadRowValues($rs); // Load row values
	}
	$category->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$category_list->RenderRow();
?>
	<tr<?php echo $category->RowAttributes() ?>>
	<?php if ($category->id->Visible) { // id ?>
		<td<?php echo $category->id->CellAttributes() ?>>
<div<?php echo $category->id->ViewAttributes() ?>><?php echo $category->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($category->parent_id->Visible) { // parent_id ?>
		<td<?php echo $category->parent_id->CellAttributes() ?>>
<div<?php echo $category->parent_id->ViewAttributes() ?>><?php echo $category->parent_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($category->name->Visible) { // name ?>
		<td<?php echo $category->name->CellAttributes() ?>>
<div<?php echo $category->name->ViewAttributes() ?>><?php echo $category->name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($category->photo->Visible) { // photo ?>
		<td<?php echo $category->photo->CellAttributes() ?>>
<?php if ($category->photo->HrefValue <> "") { ?>
<?php if (!is_null($category->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $category->photo->Upload->DbValue ?>" border=0<?php echo $category->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($category->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($category->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $category->photo->Upload->DbValue ?>" border=0<?php echo $category->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($category->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($category->sort_order->Visible) { // sort_order ?>
		<td<?php echo $category->sort_order->CellAttributes() ?>>
<div<?php echo $category->sort_order->ViewAttributes() ?>><?php echo $category->sort_order->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($category->status->Visible) { // status ?>
		<td<?php echo $category->status->CellAttributes() ?>>
<div<?php echo $category->status->ViewAttributes() ?>><?php echo $category->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($category->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $category->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $category->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $category->DeleteUrl() ?>"><img src='images/delete.gif' alt='Delete' title='Delete' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<?php
$sSqlWrk = "`parent_id`=" . ew_AdjustSql($category->id->CurrentValue) . "";
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
$sSqlWrk = str_replace("'", "\'", $sSqlWrk);
?>
<a name="ew_category_category_DetailLink<?php echo $category_list->lRowCnt ?>" id="ew_category_category_DetailLink<?php echo $category_list->lRowCnt ?>" href="categorylist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=category&id=<?php echo urlencode(strval($category->id->CurrentValue)) ?>" onmouseover="ew_AjaxShowDetails(this, 'categorypreview.php?f=<?php echo $sSqlWrk ?>')" onmouseout="ew_AjaxHideDetails(this);">Category<img src='images/detail.gif' alt='Details' title='Details' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<?php
$sSqlWrk = "`cat_id`=" . ew_AdjustSql($category->id->CurrentValue) . "";
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
$sSqlWrk = str_replace("'", "\'", $sSqlWrk);
?>
<a name="ew_category_cat_product_DetailLink<?php echo $category_list->lRowCnt ?>" id="ew_category_cat_product_DetailLink<?php echo $category_list->lRowCnt ?>" href="cat_productlist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=category&id=<?php echo urlencode(strval($category->id->CurrentValue)) ?>" onmouseover="ew_AjaxShowDetails(this, 'cat_productpreview.php?f=<?php echo $sSqlWrk ?>')" onmouseout="ew_AjaxHideDetails(this);">Cat Product<img src='images/detail.gif' alt='Details' title='Details' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($category_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($category->CurrentAction <> "gridadd")
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
<?php if ($category_list->lTotalRecs > 0) { ?>
<?php if ($category->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($category->CurrentAction <> "gridadd" && $category->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($category_list->Pager)) $category_list->Pager = new cNumericPager($category_list->lStartRec, $category_list->lDisplayRecs, $category_list->lTotalRecs, $category_list->lRecRange) ?>
<?php if ($category_list->Pager->RecordCount > 0) { ?>
	<?php if ($category_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $category_list->PageUrl() ?>start=<?php echo $category_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($category_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $category_list->PageUrl() ?>start=<?php echo $category_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($category_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $category_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($category_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $category_list->PageUrl() ?>start=<?php echo $category_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($category_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $category_list->PageUrl() ?>start=<?php echo $category_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($category_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $category_list->Pager->FromIndex ?> to <?php echo $category_list->Pager->ToIndex ?> of <?php echo $category_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($category_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($category_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $category->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($category->Export == "" && $category->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(category_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($category->Export == "") { ?>
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
class ccategory_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'category';

	// Page Object Name
	var $PageObjName = 'category_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $category;
		if ($category->UseTokenInUrl) $PageUrl .= "t=" . $category->TableVar . "&"; // add page token
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
		global $objForm, $category;
		if ($category->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($category->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($category->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccategory_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["category"] = new ccategory();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'category', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $category;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$category->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $category->Export; // Get export parameter, used in header
	$gsExportFile = $category->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $category;
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

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($category->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $category->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";

		// Restore master/detail filter
		$this->sDbMasterFilter = $category->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $category->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($category->getMasterFilter() <> "" && $category->getCurrentMasterTable() == "category") {
			global $category;
			$rsmaster = $category->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$category->setMasterFilter(""); // Clear master filter
				$category->setDetailFilter(""); // Clear detail filter
				$this->setMessage("No records found"); // Set no record found
				$this->Page_Terminate($category->getReturnUrl()); // Return to caller
			} else {
				$category->LoadListRowValues($rsmaster);
				$category->RowType = EW_ROWTYPE_MASTER; // Master row
				$category->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in Session
		$category->setSessionWhere($sFilter);
		$category->CurrentFilter = "";
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $category;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$category->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$category->CurrentOrderType = @$_GET["ordertype"];
			$category->UpdateSort($category->id); // Field 
			$category->UpdateSort($category->parent_id); // Field 
			$category->UpdateSort($category->name); // Field 
			$category->UpdateSort($category->photo); // Field 
			$category->UpdateSort($category->sort_order); // Field 
			$category->UpdateSort($category->status); // Field 
			$category->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $category;
		$sOrderBy = $category->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($category->SqlOrderBy() <> "") {
				$sOrderBy = $category->SqlOrderBy();
				$category->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $category;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$category->getCurrentMasterTable = ""; // Clear master table
				$category->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$category->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$category->parent_id->setSessionValue("");
			}

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$category->setSessionOrderBy($sOrderBy);
				$category->id->setSort("");
				$category->parent_id->setSort("");
				$category->name->setSort("");
				$category->photo->setSort("");
				$category->sort_order->setSort("");
				$category->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$category->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $category;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$category->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$category->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $category->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$category->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$category->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$category->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $category;

		// Call Recordset Selecting event
		$category->Recordset_Selecting($category->CurrentFilter);

		// Load list page SQL
		$sSql = $category->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$category->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $category;
		$sFilter = $category->KeyFilter();

		// Call Row Selecting event
		$category->Row_Selecting($sFilter);

		// Load sql based on filter
		$category->CurrentFilter = $sFilter;
		$sSql = $category->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$category->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $category;
		$category->id->setDbValue($rs->fields('id'));
		$category->parent_id->setDbValue($rs->fields('parent_id'));
		$category->name->setDbValue($rs->fields('name'));
		$category->photo->Upload->DbValue = $rs->fields('photo');
		$category->description->setDbValue($rs->fields('description'));
		$category->sort_order->setDbValue($rs->fields('sort_order'));
		$category->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $category;

		// Call Row_Rendering event
		$category->Row_Rendering();

		// Common render codes for all row types
		// id

		$category->id->CellCssStyle = "";
		$category->id->CellCssClass = "";

		// parent_id
		$category->parent_id->CellCssStyle = "";
		$category->parent_id->CellCssClass = "";

		// name
		$category->name->CellCssStyle = "";
		$category->name->CellCssClass = "";

		// photo
		$category->photo->CellCssStyle = "";
		$category->photo->CellCssClass = "";

		// sort_order
		$category->sort_order->CellCssStyle = "";
		$category->sort_order->CellCssClass = "";

		// status
		$category->status->CellCssStyle = "";
		$category->status->CellCssClass = "";
		if ($category->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$category->id->ViewValue = $category->id->CurrentValue;
			$category->id->CssStyle = "";
			$category->id->CssClass = "";
			$category->id->ViewCustomAttributes = "";

			// parent_id
			if (strval($category->parent_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name` FROM `category` WHERE `id` = " . ew_AdjustSql($category->parent_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$category->parent_id->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$category->parent_id->ViewValue = $category->parent_id->CurrentValue;
				}
			} else {
				$category->parent_id->ViewValue = NULL;
			}
			$category->parent_id->CssStyle = "";
			$category->parent_id->CssClass = "";
			$category->parent_id->ViewCustomAttributes = "";

			// name
			$category->name->ViewValue = $category->name->CurrentValue;
			$category->name->CssStyle = "";
			$category->name->CssClass = "";
			$category->name->ViewCustomAttributes = "";

			// photo
			if (!is_null($category->photo->Upload->DbValue)) {
				$category->photo->ViewValue = $category->photo->Upload->DbValue;
				$category->photo->ImageWidth = 100;
				$category->photo->ImageHeight = 0;
				$category->photo->ImageAlt = "";
			} else {
				$category->photo->ViewValue = "";
			}
			$category->photo->CssStyle = "";
			$category->photo->CssClass = "";
			$category->photo->ViewCustomAttributes = "";

			// sort_order
			$category->sort_order->ViewValue = $category->sort_order->CurrentValue;
			$category->sort_order->CssStyle = "";
			$category->sort_order->CssClass = "";
			$category->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($category->status->CurrentValue) <> "") {
				switch ($category->status->CurrentValue) {
					case "1":
						$category->status->ViewValue = "Active";
						break;
					case "2":
						$category->status->ViewValue = "Not Active";
						break;
					default:
						$category->status->ViewValue = $category->status->CurrentValue;
				}
			} else {
				$category->status->ViewValue = NULL;
			}
			$category->status->CssStyle = "";
			$category->status->CssClass = "";
			$category->status->ViewCustomAttributes = "";

			// id
			$category->id->HrefValue = "";

			// parent_id
			$category->parent_id->HrefValue = "";

			// name
			$category->name->HrefValue = "";

			// photo
			$category->photo->HrefValue = "";

			// sort_order
			$category->sort_order->HrefValue = "";

			// status
			$category->status->HrefValue = "";
		}

		// Call Row Rendered event
		$category->Row_Rendered();
	}

	// Set up Master Detail based on querystring parameter
	function SetUpMasterDetail() {
		global $category;
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
				$this->sDbMasterFilter = $category->SqlMasterFilter_category();
				$this->sDbDetailFilter = $category->SqlDetailFilter_category();
				if (@$_GET["id"] <> "") {
					$GLOBALS["category"]->id->setQueryStringValue($_GET["id"]);
					$category->parent_id->setQueryStringValue($GLOBALS["category"]->id->QueryStringValue);
					$category->parent_id->setSessionValue($category->parent_id->QueryStringValue);
					if (!is_numeric($GLOBALS["category"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["category"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@parent_id@", ew_AdjustSql($GLOBALS["category"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$category->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$category->setStartRecordNumber($this->lStartRec);
			$category->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$category->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master session values
			if ($sMasterTblVar <> "category") {
				if ($category->parent_id->QueryStringValue == "") $category->parent_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $category->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $category->getDetailFilter(); // Restore detail filter
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
