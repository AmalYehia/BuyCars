<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "serviceinfo.php" ?>
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
$service_list = new cservice_list();
$Page =& $service_list;

// Page init processing
$service_list->Page_Init();

// Page main processing
$service_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($service->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var service_list = new ew_Page("service_list");

// page properties
service_list.PageID = "list"; // page ID
var EW_PAGE_ID = service_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
service_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
service_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
service_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($service->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($service->Export == "" && $service->SelectLimit);
	if (!$bSelectLimit)
		$rs = $service_list->LoadRecordset();
	$service_list->lTotalRecs = ($bSelectLimit) ? $service->SelectRecordCount() : $rs->RecordCount();
	$service_list->lStartRec = 1;
	if ($service_list->lDisplayRecs <= 0) // Display all records
		$service_list->lDisplayRecs = $service_list->lTotalRecs;
	if (!($service->ExportAll && $service->Export <> ""))
		$service_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $service_list->LoadRecordset($service_list->lStartRec-1, $service_list->lDisplayRecs);
?>
<div align="center" class="msm_h1">TABLE: Service</div>
<p><span class="phpmaker" style="white-space: nowrap;">
</span></p>
<?php $service_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($service->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($service->CurrentAction <> "gridadd" && $service->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($service_list->Pager)) $service_list->Pager = new cNumericPager($service_list->lStartRec, $service_list->lDisplayRecs, $service_list->lTotalRecs, $service_list->lRecRange) ?>
<?php if ($service_list->Pager->RecordCount > 0) { ?>
	<?php if ($service_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $service_list->PageUrl() ?>start=<?php echo $service_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($service_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $service_list->PageUrl() ?>start=<?php echo $service_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($service_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $service_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($service_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $service_list->PageUrl() ?>start=<?php echo $service_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($service_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $service_list->PageUrl() ?>start=<?php echo $service_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($service_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $service_list->Pager->FromIndex ?> to <?php echo $service_list->Pager->ToIndex ?> of <?php echo $service_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($service_list->sSrchWhere == "0=101") { ?>
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
<a href="<?php echo $service->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fservicelist" id="fservicelist" class="ewForm" action="" method="post">
<?php if ($service_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$service_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$service_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$service_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$service_list->lOptionCnt++; // Delete
}
	$service_list->lOptionCnt += count($service_list->ListOptions->Items); // Custom list options
?>
<?php echo $service->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($service->id->Visible) { // id ?>
	<?php if ($service->SortUrl($service->id) == "") { ?>
		<td>Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $service->SortUrl($service->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($service->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($service->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($service->photo->Visible) { // photo ?>
	<?php if ($service->SortUrl($service->photo) == "") { ?>
		<td>Photo</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $service->SortUrl($service->photo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Photo</td><td style="width: 10px;"><?php if ($service->photo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($service->photo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($service->header->Visible) { // header ?>
	<?php if ($service->SortUrl($service->header) == "") { ?>
		<td>Header</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $service->SortUrl($service->header) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Header</td><td style="width: 10px;"><?php if ($service->header->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($service->header->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($service->sort_order->Visible) { // sort_order ?>
	<?php if ($service->SortUrl($service->sort_order) == "") { ?>
		<td>Sort Order</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $service->SortUrl($service->sort_order) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Sort Order</td><td style="width: 10px;"><?php if ($service->sort_order->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($service->sort_order->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($service->status->Visible) { // status ?>
	<?php if ($service->SortUrl($service->status) == "") { ?>
		<td>Status</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $service->SortUrl($service->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Status</td><td style="width: 10px;"><?php if ($service->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($service->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($service->Export == "") { ?>
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
foreach ($service_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($service->ExportAll && $service->Export <> "") {
	$service_list->lStopRec = $service_list->lTotalRecs;
} else {
	$service_list->lStopRec = $service_list->lStartRec + $service_list->lDisplayRecs - 1; // Set the last record to display
}
$service_list->lRecCount = $service_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$service->SelectLimit && $service_list->lStartRec > 1)
		$rs->Move($service_list->lStartRec - 1);
}
$service_list->lRowCnt = 0;
while (($service->CurrentAction == "gridadd" || !$rs->EOF) &&
	$service_list->lRecCount < $service_list->lStopRec) {
	$service_list->lRecCount++;
	if (intval($service_list->lRecCount) >= intval($service_list->lStartRec)) {
		$service_list->lRowCnt++;

	// Init row class and style
	$service->CssClass = "";
	$service->CssStyle = "";
	$service->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($service->CurrentAction == "gridadd") {
		$service_list->LoadDefaultValues(); // Load default values
	} else {
		$service_list->LoadRowValues($rs); // Load row values
	}
	$service->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$service_list->RenderRow();
?>
	<tr<?php echo $service->RowAttributes() ?>>
	<?php if ($service->id->Visible) { // id ?>
		<td<?php echo $service->id->CellAttributes() ?>>
<div<?php echo $service->id->ViewAttributes() ?>><?php echo $service->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($service->photo->Visible) { // photo ?>
		<td<?php echo $service->photo->CellAttributes() ?>>
<?php if ($service->photo->HrefValue <> "") { ?>
<?php if (!is_null($service->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../image/") . $service->photo->Upload->DbValue ?>" border=0<?php echo $service->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($service->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($service->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../image/") . $service->photo->Upload->DbValue ?>" border=0<?php echo $service->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($service->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($service->header->Visible) { // header ?>
		<td<?php echo $service->header->CellAttributes() ?>>
<div<?php echo $service->header->ViewAttributes() ?>><?php echo $service->header->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($service->sort_order->Visible) { // sort_order ?>
		<td<?php echo $service->sort_order->CellAttributes() ?>>
<div<?php echo $service->sort_order->ViewAttributes() ?>><?php echo $service->sort_order->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($service->status->Visible) { // status ?>
		<td<?php echo $service->status->CellAttributes() ?>>
<div<?php echo $service->status->ViewAttributes() ?>><?php echo $service->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($service->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $service->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $service->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $service->DeleteUrl() ?>"><img src='images/delete.gif' alt='Delete' title='Delete' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($service_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($service->CurrentAction <> "gridadd")
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
<?php if ($service_list->lTotalRecs > 0) { ?>
<?php if ($service->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($service->CurrentAction <> "gridadd" && $service->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($service_list->Pager)) $service_list->Pager = new cNumericPager($service_list->lStartRec, $service_list->lDisplayRecs, $service_list->lTotalRecs, $service_list->lRecRange) ?>
<?php if ($service_list->Pager->RecordCount > 0) { ?>
	<?php if ($service_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $service_list->PageUrl() ?>start=<?php echo $service_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($service_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $service_list->PageUrl() ?>start=<?php echo $service_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($service_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $service_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($service_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $service_list->PageUrl() ?>start=<?php echo $service_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($service_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $service_list->PageUrl() ?>start=<?php echo $service_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($service_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $service_list->Pager->FromIndex ?> to <?php echo $service_list->Pager->ToIndex ?> of <?php echo $service_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($service_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($service_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $service->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($service->Export == "" && $service->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(service_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($service->Export == "") { ?>
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
class cservice_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'service';

	// Page Object Name
	var $PageObjName = 'service_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $service;
		if ($service->UseTokenInUrl) $PageUrl .= "t=" . $service->TableVar . "&"; // add page token
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
		global $objForm, $service;
		if ($service->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($service->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($service->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cservice_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["service"] = new cservice();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'service', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $service;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$service->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $service->Export; // Get export parameter, used in header
	$gsExportFile = $service->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $service;
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
		if ($service->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $service->getRecordsPerPage(); // Restore from Session
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
		$service->setSessionWhere($sFilter);
		$service->CurrentFilter = "";
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $service;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$service->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$service->CurrentOrderType = @$_GET["ordertype"];
			$service->UpdateSort($service->id); // Field 
			$service->UpdateSort($service->photo); // Field 
			$service->UpdateSort($service->header); // Field 
			$service->UpdateSort($service->sort_order); // Field 
			$service->UpdateSort($service->status); // Field 
			$service->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $service;
		$sOrderBy = $service->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($service->SqlOrderBy() <> "") {
				$sOrderBy = $service->SqlOrderBy();
				$service->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $service;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$service->setSessionOrderBy($sOrderBy);
				$service->id->setSort("");
				$service->photo->setSort("");
				$service->header->setSort("");
				$service->sort_order->setSort("");
				$service->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$service->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $service;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$service->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$service->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $service->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$service->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$service->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$service->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $service;

		// Call Recordset Selecting event
		$service->Recordset_Selecting($service->CurrentFilter);

		// Load list page SQL
		$sSql = $service->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$service->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $service;
		$sFilter = $service->KeyFilter();

		// Call Row Selecting event
		$service->Row_Selecting($sFilter);

		// Load sql based on filter
		$service->CurrentFilter = $sFilter;
		$sSql = $service->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$service->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $service;
		$service->id->setDbValue($rs->fields('id'));
		$service->photo->Upload->DbValue = $rs->fields('photo');
		$service->header->setDbValue($rs->fields('header'));
		$service->short_desc->setDbValue($rs->fields('short_desc'));
		$service->full_desc->setDbValue($rs->fields('full_desc'));
		$service->sort_order->setDbValue($rs->fields('sort_order'));
		$service->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $service;

		// Call Row_Rendering event
		$service->Row_Rendering();

		// Common render codes for all row types
		// id

		$service->id->CellCssStyle = "";
		$service->id->CellCssClass = "";

		// photo
		$service->photo->CellCssStyle = "";
		$service->photo->CellCssClass = "";

		// header
		$service->header->CellCssStyle = "";
		$service->header->CellCssClass = "";

		// sort_order
		$service->sort_order->CellCssStyle = "";
		$service->sort_order->CellCssClass = "";

		// status
		$service->status->CellCssStyle = "";
		$service->status->CellCssClass = "";
		if ($service->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$service->id->ViewValue = $service->id->CurrentValue;
			$service->id->CssStyle = "";
			$service->id->CssClass = "";
			$service->id->ViewCustomAttributes = "";

			// photo
			if (!is_null($service->photo->Upload->DbValue)) {
				$service->photo->ViewValue = $service->photo->Upload->DbValue;
				$service->photo->ImageWidth = 100;
				$service->photo->ImageHeight = 0;
				$service->photo->ImageAlt = "";
			} else {
				$service->photo->ViewValue = "";
			}
			$service->photo->CssStyle = "";
			$service->photo->CssClass = "";
			$service->photo->ViewCustomAttributes = "";

			// header
			$service->header->ViewValue = $service->header->CurrentValue;
			$service->header->CssStyle = "";
			$service->header->CssClass = "";
			$service->header->ViewCustomAttributes = "";

			// sort_order
			$service->sort_order->ViewValue = $service->sort_order->CurrentValue;
			$service->sort_order->CssStyle = "";
			$service->sort_order->CssClass = "";
			$service->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($service->status->CurrentValue) <> "") {
				switch ($service->status->CurrentValue) {
					case "1":
						$service->status->ViewValue = "Active";
						break;
					case "2":
						$service->status->ViewValue = "Not Active";
						break;
					default:
						$service->status->ViewValue = $service->status->CurrentValue;
				}
			} else {
				$service->status->ViewValue = NULL;
			}
			$service->status->CssStyle = "";
			$service->status->CssClass = "";
			$service->status->ViewCustomAttributes = "";

			// id
			$service->id->HrefValue = "";

			// photo
			$service->photo->HrefValue = "";

			// header
			$service->header->HrefValue = "";

			// sort_order
			$service->sort_order->HrefValue = "";

			// status
			$service->status->HrefValue = "";
		}

		// Call Row Rendered event
		$service->Row_Rendered();
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
