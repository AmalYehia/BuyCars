<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "manfactuererinfo.php" ?>
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
$manfactuerer_list = new cmanfactuerer_list();
$Page =& $manfactuerer_list;

// Page init processing
$manfactuerer_list->Page_Init();

// Page main processing
$manfactuerer_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($manfactuerer->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var manfactuerer_list = new ew_Page("manfactuerer_list");

// page properties
manfactuerer_list.PageID = "list"; // page ID
var EW_PAGE_ID = manfactuerer_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
manfactuerer_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
manfactuerer_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
manfactuerer_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($manfactuerer->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($manfactuerer->Export == "" && $manfactuerer->SelectLimit);
	if (!$bSelectLimit)
		$rs = $manfactuerer_list->LoadRecordset();
	$manfactuerer_list->lTotalRecs = ($bSelectLimit) ? $manfactuerer->SelectRecordCount() : $rs->RecordCount();
	$manfactuerer_list->lStartRec = 1;
	if ($manfactuerer_list->lDisplayRecs <= 0) // Display all records
		$manfactuerer_list->lDisplayRecs = $manfactuerer_list->lTotalRecs;
	if (!($manfactuerer->ExportAll && $manfactuerer->Export <> ""))
		$manfactuerer_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $manfactuerer_list->LoadRecordset($manfactuerer_list->lStartRec-1, $manfactuerer_list->lDisplayRecs);
?>
<div align="center" class="msm_h1">TABLE: Manfactuerer</div>
<p><span class="phpmaker" style="white-space: nowrap;">
</span></p>
<?php $manfactuerer_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($manfactuerer->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($manfactuerer->CurrentAction <> "gridadd" && $manfactuerer->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($manfactuerer_list->Pager)) $manfactuerer_list->Pager = new cNumericPager($manfactuerer_list->lStartRec, $manfactuerer_list->lDisplayRecs, $manfactuerer_list->lTotalRecs, $manfactuerer_list->lRecRange) ?>
<?php if ($manfactuerer_list->Pager->RecordCount > 0) { ?>
	<?php if ($manfactuerer_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $manfactuerer_list->PageUrl() ?>start=<?php echo $manfactuerer_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($manfactuerer_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $manfactuerer_list->PageUrl() ?>start=<?php echo $manfactuerer_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($manfactuerer_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $manfactuerer_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($manfactuerer_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $manfactuerer_list->PageUrl() ?>start=<?php echo $manfactuerer_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($manfactuerer_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $manfactuerer_list->PageUrl() ?>start=<?php echo $manfactuerer_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($manfactuerer_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $manfactuerer_list->Pager->FromIndex ?> to <?php echo $manfactuerer_list->Pager->ToIndex ?> of <?php echo $manfactuerer_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($manfactuerer_list->sSrchWhere == "0=101") { ?>
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
<a href="<?php echo $manfactuerer->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fmanfactuererlist" id="fmanfactuererlist" class="ewForm" action="" method="post">
<?php if ($manfactuerer_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$manfactuerer_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$manfactuerer_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$manfactuerer_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$manfactuerer_list->lOptionCnt++; // Delete
}
	$manfactuerer_list->lOptionCnt += count($manfactuerer_list->ListOptions->Items); // Custom list options
?>
<?php echo $manfactuerer->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($manfactuerer->id->Visible) { // id ?>
	<?php if ($manfactuerer->SortUrl($manfactuerer->id) == "") { ?>
		<td>Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $manfactuerer->SortUrl($manfactuerer->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($manfactuerer->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($manfactuerer->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($manfactuerer->name->Visible) { // name ?>
	<?php if ($manfactuerer->SortUrl($manfactuerer->name) == "") { ?>
		<td>Name</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $manfactuerer->SortUrl($manfactuerer->name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Name</td><td style="width: 10px;"><?php if ($manfactuerer->name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($manfactuerer->name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($manfactuerer->logo->Visible) { // logo ?>
	<?php if ($manfactuerer->SortUrl($manfactuerer->logo) == "") { ?>
		<td>Logo</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $manfactuerer->SortUrl($manfactuerer->logo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Logo</td><td style="width: 10px;"><?php if ($manfactuerer->logo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($manfactuerer->logo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($manfactuerer->sort_order->Visible) { // sort_order ?>
	<?php if ($manfactuerer->SortUrl($manfactuerer->sort_order) == "") { ?>
		<td>Sort Order</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $manfactuerer->SortUrl($manfactuerer->sort_order) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Sort Order</td><td style="width: 10px;"><?php if ($manfactuerer->sort_order->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($manfactuerer->sort_order->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($manfactuerer->status->Visible) { // status ?>
	<?php if ($manfactuerer->SortUrl($manfactuerer->status) == "") { ?>
		<td>Status</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $manfactuerer->SortUrl($manfactuerer->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Status</td><td style="width: 10px;"><?php if ($manfactuerer->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($manfactuerer->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($manfactuerer->Export == "") { ?>
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
foreach ($manfactuerer_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($manfactuerer->ExportAll && $manfactuerer->Export <> "") {
	$manfactuerer_list->lStopRec = $manfactuerer_list->lTotalRecs;
} else {
	$manfactuerer_list->lStopRec = $manfactuerer_list->lStartRec + $manfactuerer_list->lDisplayRecs - 1; // Set the last record to display
}
$manfactuerer_list->lRecCount = $manfactuerer_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$manfactuerer->SelectLimit && $manfactuerer_list->lStartRec > 1)
		$rs->Move($manfactuerer_list->lStartRec - 1);
}
$manfactuerer_list->lRowCnt = 0;
while (($manfactuerer->CurrentAction == "gridadd" || !$rs->EOF) &&
	$manfactuerer_list->lRecCount < $manfactuerer_list->lStopRec) {
	$manfactuerer_list->lRecCount++;
	if (intval($manfactuerer_list->lRecCount) >= intval($manfactuerer_list->lStartRec)) {
		$manfactuerer_list->lRowCnt++;

	// Init row class and style
	$manfactuerer->CssClass = "";
	$manfactuerer->CssStyle = "";
	$manfactuerer->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($manfactuerer->CurrentAction == "gridadd") {
		$manfactuerer_list->LoadDefaultValues(); // Load default values
	} else {
		$manfactuerer_list->LoadRowValues($rs); // Load row values
	}
	$manfactuerer->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$manfactuerer_list->RenderRow();
?>
	<tr<?php echo $manfactuerer->RowAttributes() ?>>
	<?php if ($manfactuerer->id->Visible) { // id ?>
		<td<?php echo $manfactuerer->id->CellAttributes() ?>>
<div<?php echo $manfactuerer->id->ViewAttributes() ?>><?php echo $manfactuerer->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($manfactuerer->name->Visible) { // name ?>
		<td<?php echo $manfactuerer->name->CellAttributes() ?>>
<div<?php echo $manfactuerer->name->ViewAttributes() ?>><?php echo $manfactuerer->name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($manfactuerer->logo->Visible) { // logo ?>
		<td<?php echo $manfactuerer->logo->CellAttributes() ?>>
<?php if ($manfactuerer->logo->HrefValue <> "") { ?>
<?php if (!is_null($manfactuerer->logo->Upload->DbValue)) { ?>
<a href="<?php echo $manfactuerer->logo->HrefValue ?>"><?php echo $manfactuerer->logo->ListViewValue() ?></a>
<?php } elseif (!in_array($manfactuerer->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($manfactuerer->logo->Upload->DbValue)) { ?>
<?php echo $manfactuerer->logo->ListViewValue() ?>
<?php } elseif (!in_array($manfactuerer->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($manfactuerer->sort_order->Visible) { // sort_order ?>
		<td<?php echo $manfactuerer->sort_order->CellAttributes() ?>>
<div<?php echo $manfactuerer->sort_order->ViewAttributes() ?>><?php echo $manfactuerer->sort_order->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($manfactuerer->status->Visible) { // status ?>
		<td<?php echo $manfactuerer->status->CellAttributes() ?>>
<div<?php echo $manfactuerer->status->ViewAttributes() ?>><?php echo $manfactuerer->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($manfactuerer->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $manfactuerer->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $manfactuerer->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $manfactuerer->DeleteUrl() ?>"><img src='images/delete.gif' alt='Delete' title='Delete' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($manfactuerer_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($manfactuerer->CurrentAction <> "gridadd")
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
<?php if ($manfactuerer_list->lTotalRecs > 0) { ?>
<?php if ($manfactuerer->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($manfactuerer->CurrentAction <> "gridadd" && $manfactuerer->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($manfactuerer_list->Pager)) $manfactuerer_list->Pager = new cNumericPager($manfactuerer_list->lStartRec, $manfactuerer_list->lDisplayRecs, $manfactuerer_list->lTotalRecs, $manfactuerer_list->lRecRange) ?>
<?php if ($manfactuerer_list->Pager->RecordCount > 0) { ?>
	<?php if ($manfactuerer_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $manfactuerer_list->PageUrl() ?>start=<?php echo $manfactuerer_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($manfactuerer_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $manfactuerer_list->PageUrl() ?>start=<?php echo $manfactuerer_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($manfactuerer_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $manfactuerer_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($manfactuerer_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $manfactuerer_list->PageUrl() ?>start=<?php echo $manfactuerer_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($manfactuerer_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $manfactuerer_list->PageUrl() ?>start=<?php echo $manfactuerer_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($manfactuerer_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $manfactuerer_list->Pager->FromIndex ?> to <?php echo $manfactuerer_list->Pager->ToIndex ?> of <?php echo $manfactuerer_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($manfactuerer_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($manfactuerer_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $manfactuerer->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($manfactuerer->Export == "" && $manfactuerer->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(manfactuerer_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($manfactuerer->Export == "") { ?>
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
class cmanfactuerer_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'manfactuerer';

	// Page Object Name
	var $PageObjName = 'manfactuerer_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $manfactuerer;
		if ($manfactuerer->UseTokenInUrl) $PageUrl .= "t=" . $manfactuerer->TableVar . "&"; // add page token
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
		global $objForm, $manfactuerer;
		if ($manfactuerer->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($manfactuerer->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($manfactuerer->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmanfactuerer_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["manfactuerer"] = new cmanfactuerer();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'manfactuerer', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $manfactuerer;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$manfactuerer->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $manfactuerer->Export; // Get export parameter, used in header
	$gsExportFile = $manfactuerer->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $manfactuerer;
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

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($manfactuerer->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $manfactuerer->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in Session
		$manfactuerer->setSessionWhere($sFilter);
		$manfactuerer->CurrentFilter = "";
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $manfactuerer;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$manfactuerer->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$manfactuerer->CurrentOrderType = @$_GET["ordertype"];
			$manfactuerer->UpdateSort($manfactuerer->id); // Field 
			$manfactuerer->UpdateSort($manfactuerer->name); // Field 
			$manfactuerer->UpdateSort($manfactuerer->logo); // Field 
			$manfactuerer->UpdateSort($manfactuerer->sort_order); // Field 
			$manfactuerer->UpdateSort($manfactuerer->status); // Field 
			$manfactuerer->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $manfactuerer;
		$sOrderBy = $manfactuerer->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($manfactuerer->SqlOrderBy() <> "") {
				$sOrderBy = $manfactuerer->SqlOrderBy();
				$manfactuerer->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $manfactuerer;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$manfactuerer->setSessionOrderBy($sOrderBy);
				$manfactuerer->id->setSort("");
				$manfactuerer->name->setSort("");
				$manfactuerer->logo->setSort("");
				$manfactuerer->sort_order->setSort("");
				$manfactuerer->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$manfactuerer->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $manfactuerer;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$manfactuerer->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$manfactuerer->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $manfactuerer->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$manfactuerer->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$manfactuerer->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$manfactuerer->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $manfactuerer;

		// Call Recordset Selecting event
		$manfactuerer->Recordset_Selecting($manfactuerer->CurrentFilter);

		// Load list page SQL
		$sSql = $manfactuerer->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$manfactuerer->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $manfactuerer;
		$sFilter = $manfactuerer->KeyFilter();

		// Call Row Selecting event
		$manfactuerer->Row_Selecting($sFilter);

		// Load sql based on filter
		$manfactuerer->CurrentFilter = $sFilter;
		$sSql = $manfactuerer->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$manfactuerer->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $manfactuerer;
		$manfactuerer->id->setDbValue($rs->fields('id'));
		$manfactuerer->name->setDbValue($rs->fields('name'));
		$manfactuerer->logo->Upload->DbValue = $rs->fields('logo');
		$manfactuerer->sort_order->setDbValue($rs->fields('sort_order'));
		$manfactuerer->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $manfactuerer;

		// Call Row_Rendering event
		$manfactuerer->Row_Rendering();

		// Common render codes for all row types
		// id

		$manfactuerer->id->CellCssStyle = "";
		$manfactuerer->id->CellCssClass = "";

		// name
		$manfactuerer->name->CellCssStyle = "";
		$manfactuerer->name->CellCssClass = "";

		// logo
		$manfactuerer->logo->CellCssStyle = "";
		$manfactuerer->logo->CellCssClass = "";

		// sort_order
		$manfactuerer->sort_order->CellCssStyle = "";
		$manfactuerer->sort_order->CellCssClass = "";

		// status
		$manfactuerer->status->CellCssStyle = "";
		$manfactuerer->status->CellCssClass = "";
		if ($manfactuerer->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$manfactuerer->id->ViewValue = $manfactuerer->id->CurrentValue;
			$manfactuerer->id->CssStyle = "";
			$manfactuerer->id->CssClass = "";
			$manfactuerer->id->ViewCustomAttributes = "";

			// name
			$manfactuerer->name->ViewValue = $manfactuerer->name->CurrentValue;
			$manfactuerer->name->CssStyle = "";
			$manfactuerer->name->CssClass = "";
			$manfactuerer->name->ViewCustomAttributes = "";

			// logo
			if (!is_null($manfactuerer->logo->Upload->DbValue)) {
				$manfactuerer->logo->ViewValue = $manfactuerer->logo->Upload->DbValue;
			} else {
				$manfactuerer->logo->ViewValue = "";
			}
			$manfactuerer->logo->CssStyle = "";
			$manfactuerer->logo->CssClass = "";
			$manfactuerer->logo->ViewCustomAttributes = "";

			// sort_order
			$manfactuerer->sort_order->ViewValue = $manfactuerer->sort_order->CurrentValue;
			$manfactuerer->sort_order->CssStyle = "";
			$manfactuerer->sort_order->CssClass = "";
			$manfactuerer->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($manfactuerer->status->CurrentValue) <> "") {
				switch ($manfactuerer->status->CurrentValue) {
					case "1":
						$manfactuerer->status->ViewValue = "Active";
						break;
					case "2":
						$manfactuerer->status->ViewValue = "Not Active";
						break;
					default:
						$manfactuerer->status->ViewValue = $manfactuerer->status->CurrentValue;
				}
			} else {
				$manfactuerer->status->ViewValue = NULL;
			}
			$manfactuerer->status->CssStyle = "";
			$manfactuerer->status->CssClass = "";
			$manfactuerer->status->ViewCustomAttributes = "";

			// id
			$manfactuerer->id->HrefValue = "";

			// name
			$manfactuerer->name->HrefValue = "";

			// logo
			if (!is_null($manfactuerer->logo->Upload->DbValue)) {
				$manfactuerer->logo->HrefValue = ew_UploadPathEx(FALSE, "../upload/photo/") . ((!empty($manfactuerer->logo->ViewValue)) ? $manfactuerer->logo->ViewValue : $manfactuerer->logo->CurrentValue);
				if ($manfactuerer->Export <> "") $manfactuerer->logo->HrefValue = ew_ConvertFullUrl($manfactuerer->logo->HrefValue);
			} else {
				$manfactuerer->logo->HrefValue = "";
			}

			// sort_order
			$manfactuerer->sort_order->HrefValue = "";

			// status
			$manfactuerer->status->HrefValue = "";
		}

		// Call Row Rendered event
		$manfactuerer->Row_Rendered();
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
