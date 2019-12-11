<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "cat_p_photoinfo.php" ?>
<?php include "cat_productinfo.php" ?>
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
$cat_p_photo_list = new ccat_p_photo_list();
$Page =& $cat_p_photo_list;

// Page init processing
$cat_p_photo_list->Page_Init();

// Page main processing
$cat_p_photo_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($cat_p_photo->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var cat_p_photo_list = new ew_Page("cat_p_photo_list");

// page properties
cat_p_photo_list.PageID = "list"; // page ID
var EW_PAGE_ID = cat_p_photo_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
cat_p_photo_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
cat_p_photo_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cat_p_photo_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<div id="ewDetailsDiv" name="ewDetailsDivDiv" style="visibility:hidden"></div>
<script language="JavaScript" type="text/javascript">
<!--

// YUI container
var ewDetailsDiv;
var ew_AjaxDetailsTimer = null;

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
<?php if ($cat_p_photo->Export == "") { ?>
<?php
$gsMasterReturnUrl = "cat_productlist.php";
if ($cat_p_photo_list->sDbMasterFilter <> "" && $cat_p_photo->getCurrentMasterTable() == "cat_product") {
	if ($cat_p_photo_list->bMasterRecordExists) {
		if ($cat_p_photo->getCurrentMasterTable() == $cat_p_photo->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "cat_productmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = ($cat_p_photo->Export == "" && $cat_p_photo->SelectLimit);
	if (!$bSelectLimit)
		$rs = $cat_p_photo_list->LoadRecordset();
	$cat_p_photo_list->lTotalRecs = ($bSelectLimit) ? $cat_p_photo->SelectRecordCount() : $rs->RecordCount();
	$cat_p_photo_list->lStartRec = 1;
	if ($cat_p_photo_list->lDisplayRecs <= 0) // Display all records
		$cat_p_photo_list->lDisplayRecs = $cat_p_photo_list->lTotalRecs;
	if (!($cat_p_photo->ExportAll && $cat_p_photo->Export <> ""))
		$cat_p_photo_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $cat_p_photo_list->LoadRecordset($cat_p_photo_list->lStartRec-1, $cat_p_photo_list->lDisplayRecs);
?>
<div align="center" class="msm_h1">TABLE: Cat P Photo</div>
<p><span class="phpmaker" style="white-space: nowrap;">
</span></p>
<?php $cat_p_photo_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($cat_p_photo->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($cat_p_photo->CurrentAction <> "gridadd" && $cat_p_photo->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($cat_p_photo_list->Pager)) $cat_p_photo_list->Pager = new cNumericPager($cat_p_photo_list->lStartRec, $cat_p_photo_list->lDisplayRecs, $cat_p_photo_list->lTotalRecs, $cat_p_photo_list->lRecRange) ?>
<?php if ($cat_p_photo_list->Pager->RecordCount > 0) { ?>
	<?php if ($cat_p_photo_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $cat_p_photo_list->PageUrl() ?>start=<?php echo $cat_p_photo_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($cat_p_photo_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $cat_p_photo_list->PageUrl() ?>start=<?php echo $cat_p_photo_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($cat_p_photo_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $cat_p_photo_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($cat_p_photo_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $cat_p_photo_list->PageUrl() ?>start=<?php echo $cat_p_photo_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($cat_p_photo_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $cat_p_photo_list->PageUrl() ?>start=<?php echo $cat_p_photo_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($cat_p_photo_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $cat_p_photo_list->Pager->FromIndex ?> to <?php echo $cat_p_photo_list->Pager->ToIndex ?> of <?php echo $cat_p_photo_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($cat_p_photo_list->sSrchWhere == "0=101") { ?>
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
<a href="<?php echo $cat_p_photo->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fcat_p_photolist" id="fcat_p_photolist" class="ewForm" action="" method="post">
<?php if ($cat_p_photo_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$cat_p_photo_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$cat_p_photo_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$cat_p_photo_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$cat_p_photo_list->lOptionCnt++; // Delete
}
	$cat_p_photo_list->lOptionCnt += count($cat_p_photo_list->ListOptions->Items); // Custom list options
?>
<?php echo $cat_p_photo->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($cat_p_photo->id->Visible) { // id ?>
	<?php if ($cat_p_photo->SortUrl($cat_p_photo->id) == "") { ?>
		<td>Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_p_photo->SortUrl($cat_p_photo->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($cat_p_photo->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_p_photo->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_p_photo->product_id->Visible) { // product_id ?>
	<?php if ($cat_p_photo->SortUrl($cat_p_photo->product_id) == "") { ?>
		<td>Product Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_p_photo->SortUrl($cat_p_photo->product_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Product Id</td><td style="width: 10px;"><?php if ($cat_p_photo->product_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_p_photo->product_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_p_photo->photo->Visible) { // photo ?>
	<?php if ($cat_p_photo->SortUrl($cat_p_photo->photo) == "") { ?>
		<td>Photo</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_p_photo->SortUrl($cat_p_photo->photo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Photo</td><td style="width: 10px;"><?php if ($cat_p_photo->photo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_p_photo->photo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_p_photo->sort_order->Visible) { // sort_order ?>
	<?php if ($cat_p_photo->SortUrl($cat_p_photo->sort_order) == "") { ?>
		<td>Sort Order</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_p_photo->SortUrl($cat_p_photo->sort_order) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Sort Order</td><td style="width: 10px;"><?php if ($cat_p_photo->sort_order->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_p_photo->sort_order->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_p_photo->status->Visible) { // status ?>
	<?php if ($cat_p_photo->SortUrl($cat_p_photo->status) == "") { ?>
		<td>Status</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $cat_p_photo->SortUrl($cat_p_photo->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Status</td><td style="width: 10px;"><?php if ($cat_p_photo->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($cat_p_photo->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($cat_p_photo->Export == "") { ?>
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
foreach ($cat_p_photo_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($cat_p_photo->ExportAll && $cat_p_photo->Export <> "") {
	$cat_p_photo_list->lStopRec = $cat_p_photo_list->lTotalRecs;
} else {
	$cat_p_photo_list->lStopRec = $cat_p_photo_list->lStartRec + $cat_p_photo_list->lDisplayRecs - 1; // Set the last record to display
}
$cat_p_photo_list->lRecCount = $cat_p_photo_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$cat_p_photo->SelectLimit && $cat_p_photo_list->lStartRec > 1)
		$rs->Move($cat_p_photo_list->lStartRec - 1);
}
$cat_p_photo_list->lRowCnt = 0;
while (($cat_p_photo->CurrentAction == "gridadd" || !$rs->EOF) &&
	$cat_p_photo_list->lRecCount < $cat_p_photo_list->lStopRec) {
	$cat_p_photo_list->lRecCount++;
	if (intval($cat_p_photo_list->lRecCount) >= intval($cat_p_photo_list->lStartRec)) {
		$cat_p_photo_list->lRowCnt++;

	// Init row class and style
	$cat_p_photo->CssClass = "";
	$cat_p_photo->CssStyle = "";
	$cat_p_photo->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($cat_p_photo->CurrentAction == "gridadd") {
		$cat_p_photo_list->LoadDefaultValues(); // Load default values
	} else {
		$cat_p_photo_list->LoadRowValues($rs); // Load row values
	}
	$cat_p_photo->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$cat_p_photo_list->RenderRow();
?>
	<tr<?php echo $cat_p_photo->RowAttributes() ?>>
	<?php if ($cat_p_photo->id->Visible) { // id ?>
		<td<?php echo $cat_p_photo->id->CellAttributes() ?>>
<div<?php echo $cat_p_photo->id->ViewAttributes() ?>><?php echo $cat_p_photo->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cat_p_photo->product_id->Visible) { // product_id ?>
		<td<?php echo $cat_p_photo->product_id->CellAttributes() ?>>
<div<?php echo $cat_p_photo->product_id->ViewAttributes() ?>><?php echo $cat_p_photo->product_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cat_p_photo->photo->Visible) { // photo ?>
		<td<?php echo $cat_p_photo->photo->CellAttributes() ?>>
<?php if ($cat_p_photo->photo->HrefValue <> "") { ?>
<?php if (!is_null($cat_p_photo->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $cat_p_photo->photo->Upload->DbValue ?>" border=0<?php echo $cat_p_photo->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($cat_p_photo->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($cat_p_photo->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $cat_p_photo->photo->Upload->DbValue ?>" border=0<?php echo $cat_p_photo->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($cat_p_photo->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cat_p_photo->sort_order->Visible) { // sort_order ?>
		<td<?php echo $cat_p_photo->sort_order->CellAttributes() ?>>
<div<?php echo $cat_p_photo->sort_order->ViewAttributes() ?>><?php echo $cat_p_photo->sort_order->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($cat_p_photo->status->Visible) { // status ?>
		<td<?php echo $cat_p_photo->status->CellAttributes() ?>>
<div<?php echo $cat_p_photo->status->ViewAttributes() ?>><?php echo $cat_p_photo->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($cat_p_photo->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $cat_p_photo->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $cat_p_photo->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $cat_p_photo->DeleteUrl() ?>"><img src='images/delete.gif' alt='Delete' title='Delete' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($cat_p_photo_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($cat_p_photo->CurrentAction <> "gridadd")
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
<?php if ($cat_p_photo_list->lTotalRecs > 0) { ?>
<?php if ($cat_p_photo->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($cat_p_photo->CurrentAction <> "gridadd" && $cat_p_photo->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($cat_p_photo_list->Pager)) $cat_p_photo_list->Pager = new cNumericPager($cat_p_photo_list->lStartRec, $cat_p_photo_list->lDisplayRecs, $cat_p_photo_list->lTotalRecs, $cat_p_photo_list->lRecRange) ?>
<?php if ($cat_p_photo_list->Pager->RecordCount > 0) { ?>
	<?php if ($cat_p_photo_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $cat_p_photo_list->PageUrl() ?>start=<?php echo $cat_p_photo_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($cat_p_photo_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $cat_p_photo_list->PageUrl() ?>start=<?php echo $cat_p_photo_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($cat_p_photo_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $cat_p_photo_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($cat_p_photo_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $cat_p_photo_list->PageUrl() ?>start=<?php echo $cat_p_photo_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($cat_p_photo_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $cat_p_photo_list->PageUrl() ?>start=<?php echo $cat_p_photo_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($cat_p_photo_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $cat_p_photo_list->Pager->FromIndex ?> to <?php echo $cat_p_photo_list->Pager->ToIndex ?> of <?php echo $cat_p_photo_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($cat_p_photo_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($cat_p_photo_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $cat_p_photo->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($cat_p_photo->Export == "" && $cat_p_photo->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(cat_p_photo_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($cat_p_photo->Export == "") { ?>
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
class ccat_p_photo_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'cat_p_photo';

	// Page Object Name
	var $PageObjName = 'cat_p_photo_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $cat_p_photo;
		if ($cat_p_photo->UseTokenInUrl) $PageUrl .= "t=" . $cat_p_photo->TableVar . "&"; // add page token
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
		global $objForm, $cat_p_photo;
		if ($cat_p_photo->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($cat_p_photo->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($cat_p_photo->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccat_p_photo_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["cat_p_photo"] = new ccat_p_photo();

		// Initialize other table object
		$GLOBALS['cat_product'] = new ccat_product();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cat_p_photo', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $cat_p_photo;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$cat_p_photo->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $cat_p_photo->Export; // Get export parameter, used in header
	$gsExportFile = $cat_p_photo->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $cat_p_photo;
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
		if ($cat_p_photo->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $cat_p_photo->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";

		// Restore master/detail filter
		$this->sDbMasterFilter = $cat_p_photo->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $cat_p_photo->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($cat_p_photo->getMasterFilter() <> "" && $cat_p_photo->getCurrentMasterTable() == "cat_product") {
			global $cat_product;
			$rsmaster = $cat_product->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$cat_p_photo->setMasterFilter(""); // Clear master filter
				$cat_p_photo->setDetailFilter(""); // Clear detail filter
				$this->setMessage("No records found"); // Set no record found
				$this->Page_Terminate($cat_p_photo->getReturnUrl()); // Return to caller
			} else {
				$cat_product->LoadListRowValues($rsmaster);
				$cat_product->RowType = EW_ROWTYPE_MASTER; // Master row
				$cat_product->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in Session
		$cat_p_photo->setSessionWhere($sFilter);
		$cat_p_photo->CurrentFilter = "";
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $cat_p_photo;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$cat_p_photo->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$cat_p_photo->CurrentOrderType = @$_GET["ordertype"];
			$cat_p_photo->UpdateSort($cat_p_photo->id); // Field 
			$cat_p_photo->UpdateSort($cat_p_photo->product_id); // Field 
			$cat_p_photo->UpdateSort($cat_p_photo->photo); // Field 
			$cat_p_photo->UpdateSort($cat_p_photo->sort_order); // Field 
			$cat_p_photo->UpdateSort($cat_p_photo->status); // Field 
			$cat_p_photo->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $cat_p_photo;
		$sOrderBy = $cat_p_photo->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($cat_p_photo->SqlOrderBy() <> "") {
				$sOrderBy = $cat_p_photo->SqlOrderBy();
				$cat_p_photo->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $cat_p_photo;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$cat_p_photo->getCurrentMasterTable = ""; // Clear master table
				$cat_p_photo->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$cat_p_photo->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$cat_p_photo->product_id->setSessionValue("");
			}

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$cat_p_photo->setSessionOrderBy($sOrderBy);
				$cat_p_photo->id->setSort("");
				$cat_p_photo->product_id->setSort("");
				$cat_p_photo->photo->setSort("");
				$cat_p_photo->sort_order->setSort("");
				$cat_p_photo->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$cat_p_photo->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $cat_p_photo;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$cat_p_photo->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$cat_p_photo->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $cat_p_photo->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$cat_p_photo->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$cat_p_photo->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$cat_p_photo->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $cat_p_photo;

		// Call Recordset Selecting event
		$cat_p_photo->Recordset_Selecting($cat_p_photo->CurrentFilter);

		// Load list page SQL
		$sSql = $cat_p_photo->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$cat_p_photo->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $cat_p_photo;
		$sFilter = $cat_p_photo->KeyFilter();

		// Call Row Selecting event
		$cat_p_photo->Row_Selecting($sFilter);

		// Load sql based on filter
		$cat_p_photo->CurrentFilter = $sFilter;
		$sSql = $cat_p_photo->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$cat_p_photo->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $cat_p_photo;
		$cat_p_photo->id->setDbValue($rs->fields('id'));
		$cat_p_photo->product_id->setDbValue($rs->fields('product_id'));
		$cat_p_photo->photo->Upload->DbValue = $rs->fields('photo');
		$cat_p_photo->sort_order->setDbValue($rs->fields('sort_order'));
		$cat_p_photo->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $cat_p_photo;

		// Call Row_Rendering event
		$cat_p_photo->Row_Rendering();

		// Common render codes for all row types
		// id

		$cat_p_photo->id->CellCssStyle = "";
		$cat_p_photo->id->CellCssClass = "";

		// product_id
		$cat_p_photo->product_id->CellCssStyle = "";
		$cat_p_photo->product_id->CellCssClass = "";

		// photo
		$cat_p_photo->photo->CellCssStyle = "";
		$cat_p_photo->photo->CellCssClass = "";

		// sort_order
		$cat_p_photo->sort_order->CellCssStyle = "";
		$cat_p_photo->sort_order->CellCssClass = "";

		// status
		$cat_p_photo->status->CellCssStyle = "";
		$cat_p_photo->status->CellCssClass = "";
		if ($cat_p_photo->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$cat_p_photo->id->ViewValue = $cat_p_photo->id->CurrentValue;
			$cat_p_photo->id->CssStyle = "";
			$cat_p_photo->id->CssClass = "";
			$cat_p_photo->id->ViewCustomAttributes = "";

			// product_id
			if (strval($cat_p_photo->product_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name` FROM `cat_product` WHERE `id` = " . ew_AdjustSql($cat_p_photo->product_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$cat_p_photo->product_id->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$cat_p_photo->product_id->ViewValue = $cat_p_photo->product_id->CurrentValue;
				}
			} else {
				$cat_p_photo->product_id->ViewValue = NULL;
			}
			$cat_p_photo->product_id->CssStyle = "";
			$cat_p_photo->product_id->CssClass = "";
			$cat_p_photo->product_id->ViewCustomAttributes = "";

			// photo
			if (!is_null($cat_p_photo->photo->Upload->DbValue)) {
				$cat_p_photo->photo->ViewValue = $cat_p_photo->photo->Upload->DbValue;
				$cat_p_photo->photo->ImageWidth = 120;
				$cat_p_photo->photo->ImageHeight = 0;
				$cat_p_photo->photo->ImageAlt = "";
			} else {
				$cat_p_photo->photo->ViewValue = "";
			}
			$cat_p_photo->photo->CssStyle = "";
			$cat_p_photo->photo->CssClass = "";
			$cat_p_photo->photo->ViewCustomAttributes = "";

			// sort_order
			$cat_p_photo->sort_order->ViewValue = $cat_p_photo->sort_order->CurrentValue;
			$cat_p_photo->sort_order->CssStyle = "";
			$cat_p_photo->sort_order->CssClass = "";
			$cat_p_photo->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($cat_p_photo->status->CurrentValue) <> "") {
				switch ($cat_p_photo->status->CurrentValue) {
					case "1":
						$cat_p_photo->status->ViewValue = "Active";
						break;
					case "2":
						$cat_p_photo->status->ViewValue = "Not Active";
						break;
					default:
						$cat_p_photo->status->ViewValue = $cat_p_photo->status->CurrentValue;
				}
			} else {
				$cat_p_photo->status->ViewValue = NULL;
			}
			$cat_p_photo->status->CssStyle = "";
			$cat_p_photo->status->CssClass = "";
			$cat_p_photo->status->ViewCustomAttributes = "";

			// id
			$cat_p_photo->id->HrefValue = "";

			// product_id
			$cat_p_photo->product_id->HrefValue = "";

			// photo
			$cat_p_photo->photo->HrefValue = "";

			// sort_order
			$cat_p_photo->sort_order->HrefValue = "";

			// status
			$cat_p_photo->status->HrefValue = "";
		}

		// Call Row Rendered event
		$cat_p_photo->Row_Rendered();
	}

	// Set up Master Detail based on querystring parameter
	function SetUpMasterDetail() {
		global $cat_p_photo;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "cat_product") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $cat_p_photo->SqlMasterFilter_cat_product();
				$this->sDbDetailFilter = $cat_p_photo->SqlDetailFilter_cat_product();
				if (@$_GET["id"] <> "") {
					$GLOBALS["cat_product"]->id->setQueryStringValue($_GET["id"]);
					$cat_p_photo->product_id->setQueryStringValue($GLOBALS["cat_product"]->id->QueryStringValue);
					$cat_p_photo->product_id->setSessionValue($cat_p_photo->product_id->QueryStringValue);
					if (!is_numeric($GLOBALS["cat_product"]->id->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@id@", ew_AdjustSql($GLOBALS["cat_product"]->id->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@product_id@", ew_AdjustSql($GLOBALS["cat_product"]->id->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$cat_p_photo->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$cat_p_photo->setStartRecordNumber($this->lStartRec);
			$cat_p_photo->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$cat_p_photo->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master session values
			if ($sMasterTblVar <> "cat_product") {
				if ($cat_p_photo->product_id->QueryStringValue == "") $cat_p_photo->product_id->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $cat_p_photo->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $cat_p_photo->getDetailFilter(); // Restore detail filter
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
