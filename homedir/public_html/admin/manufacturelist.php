<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "manufactureinfo.php" ?>
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
$manufacture_list = new cmanufacture_list();
$Page =& $manufacture_list;

// Page init processing
$manufacture_list->Page_Init();

// Page main processing
$manufacture_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($manufacture->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var manufacture_list = new ew_Page("manufacture_list");

// page properties
manufacture_list.PageID = "list"; // page ID
var EW_PAGE_ID = manufacture_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
manufacture_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
manufacture_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
manufacture_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($manufacture->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($manufacture->Export == "" && $manufacture->SelectLimit);
	if (!$bSelectLimit)
		$rs = $manufacture_list->LoadRecordset();
	$manufacture_list->lTotalRecs = ($bSelectLimit) ? $manufacture->SelectRecordCount() : $rs->RecordCount();
	$manufacture_list->lStartRec = 1;
	if ($manufacture_list->lDisplayRecs <= 0) // Display all records
		$manufacture_list->lDisplayRecs = $manufacture_list->lTotalRecs;
	if (!($manufacture->ExportAll && $manufacture->Export <> ""))
		$manufacture_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $manufacture_list->LoadRecordset($manufacture_list->lStartRec-1, $manufacture_list->lDisplayRecs);
?>
<div align="center" class="msm_h1">TABLE: Manufacture</div>
<p><span class="phpmaker" style="white-space: nowrap;">
</span></p>
<?php $manufacture_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($manufacture->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($manufacture->CurrentAction <> "gridadd" && $manufacture->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($manufacture_list->Pager)) $manufacture_list->Pager = new cNumericPager($manufacture_list->lStartRec, $manufacture_list->lDisplayRecs, $manufacture_list->lTotalRecs, $manufacture_list->lRecRange) ?>
<?php if ($manufacture_list->Pager->RecordCount > 0) { ?>
	<?php if ($manufacture_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $manufacture_list->PageUrl() ?>start=<?php echo $manufacture_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($manufacture_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $manufacture_list->PageUrl() ?>start=<?php echo $manufacture_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($manufacture_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $manufacture_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($manufacture_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $manufacture_list->PageUrl() ?>start=<?php echo $manufacture_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($manufacture_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $manufacture_list->PageUrl() ?>start=<?php echo $manufacture_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($manufacture_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $manufacture_list->Pager->FromIndex ?> to <?php echo $manufacture_list->Pager->ToIndex ?> of <?php echo $manufacture_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($manufacture_list->sSrchWhere == "0=101") { ?>
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
<a href="<?php echo $manufacture->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fmanufacturelist" id="fmanufacturelist" class="ewForm" action="" method="post">
<?php if ($manufacture_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$manufacture_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$manufacture_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$manufacture_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$manufacture_list->lOptionCnt++; // Delete
}
	$manufacture_list->lOptionCnt += count($manufacture_list->ListOptions->Items); // Custom list options
?>
<?php echo $manufacture->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($manufacture->id->Visible) { // id ?>
	<?php if ($manufacture->SortUrl($manufacture->id) == "") { ?>
		<td>Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $manufacture->SortUrl($manufacture->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($manufacture->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($manufacture->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($manufacture->name->Visible) { // name ?>
	<?php if ($manufacture->SortUrl($manufacture->name) == "") { ?>
		<td>Name</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $manufacture->SortUrl($manufacture->name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Name</td><td style="width: 10px;"><?php if ($manufacture->name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($manufacture->name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($manufacture->logo->Visible) { // logo ?>
	<?php if ($manufacture->SortUrl($manufacture->logo) == "") { ?>
		<td>Logo</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $manufacture->SortUrl($manufacture->logo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Logo</td><td style="width: 10px;"><?php if ($manufacture->logo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($manufacture->logo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($manufacture->web_site->Visible) { // web_site ?>
	<?php if ($manufacture->SortUrl($manufacture->web_site) == "") { ?>
		<td>Web Site</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $manufacture->SortUrl($manufacture->web_site) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Web Site</td><td style="width: 10px;"><?php if ($manufacture->web_site->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($manufacture->web_site->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($manufacture->sort_order->Visible) { // sort_order ?>
	<?php if ($manufacture->SortUrl($manufacture->sort_order) == "") { ?>
		<td>Sort Order</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $manufacture->SortUrl($manufacture->sort_order) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Sort Order</td><td style="width: 10px;"><?php if ($manufacture->sort_order->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($manufacture->sort_order->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($manufacture->status->Visible) { // status ?>
	<?php if ($manufacture->SortUrl($manufacture->status) == "") { ?>
		<td>Status</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $manufacture->SortUrl($manufacture->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Status</td><td style="width: 10px;"><?php if ($manufacture->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($manufacture->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($manufacture->Export == "") { ?>
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
foreach ($manufacture_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($manufacture->ExportAll && $manufacture->Export <> "") {
	$manufacture_list->lStopRec = $manufacture_list->lTotalRecs;
} else {
	$manufacture_list->lStopRec = $manufacture_list->lStartRec + $manufacture_list->lDisplayRecs - 1; // Set the last record to display
}
$manufacture_list->lRecCount = $manufacture_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$manufacture->SelectLimit && $manufacture_list->lStartRec > 1)
		$rs->Move($manufacture_list->lStartRec - 1);
}
$manufacture_list->lRowCnt = 0;
while (($manufacture->CurrentAction == "gridadd" || !$rs->EOF) &&
	$manufacture_list->lRecCount < $manufacture_list->lStopRec) {
	$manufacture_list->lRecCount++;
	if (intval($manufacture_list->lRecCount) >= intval($manufacture_list->lStartRec)) {
		$manufacture_list->lRowCnt++;

	// Init row class and style
	$manufacture->CssClass = "";
	$manufacture->CssStyle = "";
	$manufacture->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($manufacture->CurrentAction == "gridadd") {
		$manufacture_list->LoadDefaultValues(); // Load default values
	} else {
		$manufacture_list->LoadRowValues($rs); // Load row values
	}
	$manufacture->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$manufacture_list->RenderRow();
?>
	<tr<?php echo $manufacture->RowAttributes() ?>>
	<?php if ($manufacture->id->Visible) { // id ?>
		<td<?php echo $manufacture->id->CellAttributes() ?>>
<div<?php echo $manufacture->id->ViewAttributes() ?>><?php echo $manufacture->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($manufacture->name->Visible) { // name ?>
		<td<?php echo $manufacture->name->CellAttributes() ?>>
<div<?php echo $manufacture->name->ViewAttributes() ?>><?php echo $manufacture->name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($manufacture->logo->Visible) { // logo ?>
		<td<?php echo $manufacture->logo->CellAttributes() ?>>
<?php if ($manufacture->logo->HrefValue <> "") { ?>
<?php if (!is_null($manufacture->logo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $manufacture->logo->Upload->DbValue ?>" border=0<?php echo $manufacture->logo->ViewAttributes() ?>>
<?php } elseif (!in_array($manufacture->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($manufacture->logo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $manufacture->logo->Upload->DbValue ?>" border=0<?php echo $manufacture->logo->ViewAttributes() ?>>
<?php } elseif (!in_array($manufacture->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($manufacture->web_site->Visible) { // web_site ?>
		<td<?php echo $manufacture->web_site->CellAttributes() ?>>
<div<?php echo $manufacture->web_site->ViewAttributes() ?>><?php echo $manufacture->web_site->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($manufacture->sort_order->Visible) { // sort_order ?>
		<td<?php echo $manufacture->sort_order->CellAttributes() ?>>
<div<?php echo $manufacture->sort_order->ViewAttributes() ?>><?php echo $manufacture->sort_order->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($manufacture->status->Visible) { // status ?>
		<td<?php echo $manufacture->status->CellAttributes() ?>>
<div<?php echo $manufacture->status->ViewAttributes() ?>><?php echo $manufacture->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($manufacture->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $manufacture->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $manufacture->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $manufacture->DeleteUrl() ?>"><img src='images/delete.gif' alt='Delete' title='Delete' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($manufacture_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($manufacture->CurrentAction <> "gridadd")
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
<?php if ($manufacture_list->lTotalRecs > 0) { ?>
<?php if ($manufacture->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($manufacture->CurrentAction <> "gridadd" && $manufacture->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($manufacture_list->Pager)) $manufacture_list->Pager = new cNumericPager($manufacture_list->lStartRec, $manufacture_list->lDisplayRecs, $manufacture_list->lTotalRecs, $manufacture_list->lRecRange) ?>
<?php if ($manufacture_list->Pager->RecordCount > 0) { ?>
	<?php if ($manufacture_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $manufacture_list->PageUrl() ?>start=<?php echo $manufacture_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($manufacture_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $manufacture_list->PageUrl() ?>start=<?php echo $manufacture_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($manufacture_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $manufacture_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($manufacture_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $manufacture_list->PageUrl() ?>start=<?php echo $manufacture_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($manufacture_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $manufacture_list->PageUrl() ?>start=<?php echo $manufacture_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($manufacture_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $manufacture_list->Pager->FromIndex ?> to <?php echo $manufacture_list->Pager->ToIndex ?> of <?php echo $manufacture_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($manufacture_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($manufacture_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $manufacture->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($manufacture->Export == "" && $manufacture->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(manufacture_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($manufacture->Export == "") { ?>
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
class cmanufacture_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'manufacture';

	// Page Object Name
	var $PageObjName = 'manufacture_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $manufacture;
		if ($manufacture->UseTokenInUrl) $PageUrl .= "t=" . $manufacture->TableVar . "&"; // add page token
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
		global $objForm, $manufacture;
		if ($manufacture->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($manufacture->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($manufacture->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmanufacture_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["manufacture"] = new cmanufacture();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'manufacture', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $manufacture;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$manufacture->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $manufacture->Export; // Get export parameter, used in header
	$gsExportFile = $manufacture->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $manufacture;
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
		if ($manufacture->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $manufacture->getRecordsPerPage(); // Restore from Session
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
		$manufacture->setSessionWhere($sFilter);
		$manufacture->CurrentFilter = "";
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $manufacture;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$manufacture->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$manufacture->CurrentOrderType = @$_GET["ordertype"];
			$manufacture->UpdateSort($manufacture->id); // Field 
			$manufacture->UpdateSort($manufacture->name); // Field 
			$manufacture->UpdateSort($manufacture->logo); // Field 
			$manufacture->UpdateSort($manufacture->web_site); // Field 
			$manufacture->UpdateSort($manufacture->sort_order); // Field 
			$manufacture->UpdateSort($manufacture->status); // Field 
			$manufacture->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $manufacture;
		$sOrderBy = $manufacture->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($manufacture->SqlOrderBy() <> "") {
				$sOrderBy = $manufacture->SqlOrderBy();
				$manufacture->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $manufacture;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$manufacture->setSessionOrderBy($sOrderBy);
				$manufacture->id->setSort("");
				$manufacture->name->setSort("");
				$manufacture->logo->setSort("");
				$manufacture->web_site->setSort("");
				$manufacture->sort_order->setSort("");
				$manufacture->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$manufacture->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $manufacture;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$manufacture->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$manufacture->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $manufacture->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$manufacture->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$manufacture->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$manufacture->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $manufacture;

		// Call Recordset Selecting event
		$manufacture->Recordset_Selecting($manufacture->CurrentFilter);

		// Load list page SQL
		$sSql = $manufacture->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$manufacture->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $manufacture;
		$sFilter = $manufacture->KeyFilter();

		// Call Row Selecting event
		$manufacture->Row_Selecting($sFilter);

		// Load sql based on filter
		$manufacture->CurrentFilter = $sFilter;
		$sSql = $manufacture->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$manufacture->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $manufacture;
		$manufacture->id->setDbValue($rs->fields('id'));
		$manufacture->name->setDbValue($rs->fields('name'));
		$manufacture->logo->Upload->DbValue = $rs->fields('logo');
		$manufacture->web_site->setDbValue($rs->fields('web_site'));
		$manufacture->sort_order->setDbValue($rs->fields('sort_order'));
		$manufacture->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $manufacture;

		// Call Row_Rendering event
		$manufacture->Row_Rendering();

		// Common render codes for all row types
		// id

		$manufacture->id->CellCssStyle = "";
		$manufacture->id->CellCssClass = "";

		// name
		$manufacture->name->CellCssStyle = "";
		$manufacture->name->CellCssClass = "";

		// logo
		$manufacture->logo->CellCssStyle = "";
		$manufacture->logo->CellCssClass = "";

		// web_site
		$manufacture->web_site->CellCssStyle = "";
		$manufacture->web_site->CellCssClass = "";

		// sort_order
		$manufacture->sort_order->CellCssStyle = "";
		$manufacture->sort_order->CellCssClass = "";

		// status
		$manufacture->status->CellCssStyle = "";
		$manufacture->status->CellCssClass = "";
		if ($manufacture->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$manufacture->id->ViewValue = $manufacture->id->CurrentValue;
			$manufacture->id->CssStyle = "";
			$manufacture->id->CssClass = "";
			$manufacture->id->ViewCustomAttributes = "";

			// name
			$manufacture->name->ViewValue = $manufacture->name->CurrentValue;
			$manufacture->name->CssStyle = "";
			$manufacture->name->CssClass = "";
			$manufacture->name->ViewCustomAttributes = "";

			// logo
			if (!is_null($manufacture->logo->Upload->DbValue)) {
				$manufacture->logo->ViewValue = $manufacture->logo->Upload->DbValue;
				$manufacture->logo->ImageWidth = 100;
				$manufacture->logo->ImageHeight = 0;
				$manufacture->logo->ImageAlt = "";
			} else {
				$manufacture->logo->ViewValue = "";
			}
			$manufacture->logo->CssStyle = "";
			$manufacture->logo->CssClass = "";
			$manufacture->logo->ViewCustomAttributes = "";

			// web_site
			$manufacture->web_site->ViewValue = $manufacture->web_site->CurrentValue;
			$manufacture->web_site->CssStyle = "";
			$manufacture->web_site->CssClass = "";
			$manufacture->web_site->ViewCustomAttributes = "";

			// sort_order
			$manufacture->sort_order->ViewValue = $manufacture->sort_order->CurrentValue;
			$manufacture->sort_order->CssStyle = "";
			$manufacture->sort_order->CssClass = "";
			$manufacture->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($manufacture->status->CurrentValue) <> "") {
				switch ($manufacture->status->CurrentValue) {
					case "1":
						$manufacture->status->ViewValue = "Active";
						break;
					case "2":
						$manufacture->status->ViewValue = "Not Active";
						break;
					default:
						$manufacture->status->ViewValue = $manufacture->status->CurrentValue;
				}
			} else {
				$manufacture->status->ViewValue = NULL;
			}
			$manufacture->status->CssStyle = "";
			$manufacture->status->CssClass = "";
			$manufacture->status->ViewCustomAttributes = "";

			// id
			$manufacture->id->HrefValue = "";

			// name
			$manufacture->name->HrefValue = "";

			// logo
			$manufacture->logo->HrefValue = "";

			// web_site
			$manufacture->web_site->HrefValue = "";

			// sort_order
			$manufacture->sort_order->HrefValue = "";

			// status
			$manufacture->status->HrefValue = "";
		}

		// Call Row Rendered event
		$manufacture->Row_Rendered();
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
