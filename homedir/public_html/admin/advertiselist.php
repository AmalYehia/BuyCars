<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "advertiseinfo.php" ?>
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
$advertise_list = new cadvertise_list();
$Page =& $advertise_list;

// Page init processing
$advertise_list->Page_Init();

// Page main processing
$advertise_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($advertise->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var advertise_list = new ew_Page("advertise_list");

// page properties
advertise_list.PageID = "list"; // page ID
var EW_PAGE_ID = advertise_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
advertise_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
advertise_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
advertise_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($advertise->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($advertise->Export == "" && $advertise->SelectLimit);
	if (!$bSelectLimit)
		$rs = $advertise_list->LoadRecordset();
	$advertise_list->lTotalRecs = ($bSelectLimit) ? $advertise->SelectRecordCount() : $rs->RecordCount();
	$advertise_list->lStartRec = 1;
	if ($advertise_list->lDisplayRecs <= 0) // Display all records
		$advertise_list->lDisplayRecs = $advertise_list->lTotalRecs;
	if (!($advertise->ExportAll && $advertise->Export <> ""))
		$advertise_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $advertise_list->LoadRecordset($advertise_list->lStartRec-1, $advertise_list->lDisplayRecs);
?>
<div align="center" class="msm_h1">TABLE: Advertise</div>
<p><span class="phpmaker" style="white-space: nowrap;">
</span></p>
<?php $advertise_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($advertise->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($advertise->CurrentAction <> "gridadd" && $advertise->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($advertise_list->Pager)) $advertise_list->Pager = new cNumericPager($advertise_list->lStartRec, $advertise_list->lDisplayRecs, $advertise_list->lTotalRecs, $advertise_list->lRecRange) ?>
<?php if ($advertise_list->Pager->RecordCount > 0) { ?>
	<?php if ($advertise_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $advertise_list->PageUrl() ?>start=<?php echo $advertise_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($advertise_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $advertise_list->PageUrl() ?>start=<?php echo $advertise_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($advertise_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $advertise_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($advertise_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $advertise_list->PageUrl() ?>start=<?php echo $advertise_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($advertise_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $advertise_list->PageUrl() ?>start=<?php echo $advertise_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($advertise_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $advertise_list->Pager->FromIndex ?> to <?php echo $advertise_list->Pager->ToIndex ?> of <?php echo $advertise_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($advertise_list->sSrchWhere == "0=101") { ?>
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
<a href="<?php echo $advertise->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fadvertiselist" id="fadvertiselist" class="ewForm" action="" method="post">
<?php if ($advertise_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$advertise_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$advertise_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$advertise_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$advertise_list->lOptionCnt++; // Delete
}
	$advertise_list->lOptionCnt += count($advertise_list->ListOptions->Items); // Custom list options
?>
<?php echo $advertise->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($advertise->id->Visible) { // id ?>
	<?php if ($advertise->SortUrl($advertise->id) == "") { ?>
		<td>Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $advertise->SortUrl($advertise->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($advertise->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($advertise->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($advertise->adv->Visible) { // adv ?>
	<?php if ($advertise->SortUrl($advertise->adv) == "") { ?>
		<td>Adv</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $advertise->SortUrl($advertise->adv) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Adv</td><td style="width: 10px;"><?php if ($advertise->adv->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($advertise->adv->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($advertise->status->Visible) { // status ?>
	<?php if ($advertise->SortUrl($advertise->status) == "") { ?>
		<td>Status</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $advertise->SortUrl($advertise->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Status</td><td style="width: 10px;"><?php if ($advertise->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($advertise->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($advertise->Export == "") { ?>
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
foreach ($advertise_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($advertise->ExportAll && $advertise->Export <> "") {
	$advertise_list->lStopRec = $advertise_list->lTotalRecs;
} else {
	$advertise_list->lStopRec = $advertise_list->lStartRec + $advertise_list->lDisplayRecs - 1; // Set the last record to display
}
$advertise_list->lRecCount = $advertise_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$advertise->SelectLimit && $advertise_list->lStartRec > 1)
		$rs->Move($advertise_list->lStartRec - 1);
}
$advertise_list->lRowCnt = 0;
while (($advertise->CurrentAction == "gridadd" || !$rs->EOF) &&
	$advertise_list->lRecCount < $advertise_list->lStopRec) {
	$advertise_list->lRecCount++;
	if (intval($advertise_list->lRecCount) >= intval($advertise_list->lStartRec)) {
		$advertise_list->lRowCnt++;

	// Init row class and style
	$advertise->CssClass = "";
	$advertise->CssStyle = "";
	$advertise->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($advertise->CurrentAction == "gridadd") {
		$advertise_list->LoadDefaultValues(); // Load default values
	} else {
		$advertise_list->LoadRowValues($rs); // Load row values
	}
	$advertise->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$advertise_list->RenderRow();
?>
	<tr<?php echo $advertise->RowAttributes() ?>>
	<?php if ($advertise->id->Visible) { // id ?>
		<td<?php echo $advertise->id->CellAttributes() ?>>
<div<?php echo $advertise->id->ViewAttributes() ?>><?php echo $advertise->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($advertise->adv->Visible) { // adv ?>
		<td<?php echo $advertise->adv->CellAttributes() ?>>
<?php if ($advertise->adv->HrefValue <> "") { ?>
<?php if (!is_null($advertise->adv->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/photo/") . $advertise->adv->Upload->DbValue ?>" border=0<?php echo $advertise->adv->ViewAttributes() ?>>
<?php } elseif (!in_array($advertise->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($advertise->adv->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/photo/") . $advertise->adv->Upload->DbValue ?>" border=0<?php echo $advertise->adv->ViewAttributes() ?>>
<?php } elseif (!in_array($advertise->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($advertise->status->Visible) { // status ?>
		<td<?php echo $advertise->status->CellAttributes() ?>>
<div<?php echo $advertise->status->ViewAttributes() ?>><?php echo $advertise->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($advertise->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $advertise->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $advertise->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $advertise->DeleteUrl() ?>"><img src='images/delete.gif' alt='Delete' title='Delete' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($advertise_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($advertise->CurrentAction <> "gridadd")
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
<?php if ($advertise_list->lTotalRecs > 0) { ?>
<?php if ($advertise->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($advertise->CurrentAction <> "gridadd" && $advertise->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($advertise_list->Pager)) $advertise_list->Pager = new cNumericPager($advertise_list->lStartRec, $advertise_list->lDisplayRecs, $advertise_list->lTotalRecs, $advertise_list->lRecRange) ?>
<?php if ($advertise_list->Pager->RecordCount > 0) { ?>
	<?php if ($advertise_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $advertise_list->PageUrl() ?>start=<?php echo $advertise_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($advertise_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $advertise_list->PageUrl() ?>start=<?php echo $advertise_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($advertise_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $advertise_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($advertise_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $advertise_list->PageUrl() ?>start=<?php echo $advertise_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($advertise_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $advertise_list->PageUrl() ?>start=<?php echo $advertise_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($advertise_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $advertise_list->Pager->FromIndex ?> to <?php echo $advertise_list->Pager->ToIndex ?> of <?php echo $advertise_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($advertise_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($advertise_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $advertise->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($advertise->Export == "" && $advertise->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(advertise_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($advertise->Export == "") { ?>
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
class cadvertise_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'advertise';

	// Page Object Name
	var $PageObjName = 'advertise_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $advertise;
		if ($advertise->UseTokenInUrl) $PageUrl .= "t=" . $advertise->TableVar . "&"; // add page token
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
		global $objForm, $advertise;
		if ($advertise->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($advertise->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($advertise->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cadvertise_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["advertise"] = new cadvertise();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'advertise', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $advertise;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$advertise->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $advertise->Export; // Get export parameter, used in header
	$gsExportFile = $advertise->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $advertise;
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
		if ($advertise->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $advertise->getRecordsPerPage(); // Restore from Session
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
		$advertise->setSessionWhere($sFilter);
		$advertise->CurrentFilter = "";
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $advertise;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$advertise->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$advertise->CurrentOrderType = @$_GET["ordertype"];
			$advertise->UpdateSort($advertise->id); // Field 
			$advertise->UpdateSort($advertise->adv); // Field 
			$advertise->UpdateSort($advertise->status); // Field 
			$advertise->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $advertise;
		$sOrderBy = $advertise->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($advertise->SqlOrderBy() <> "") {
				$sOrderBy = $advertise->SqlOrderBy();
				$advertise->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $advertise;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$advertise->setSessionOrderBy($sOrderBy);
				$advertise->id->setSort("");
				$advertise->adv->setSort("");
				$advertise->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$advertise->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $advertise;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$advertise->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$advertise->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $advertise->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$advertise->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$advertise->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$advertise->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $advertise;

		// Call Recordset Selecting event
		$advertise->Recordset_Selecting($advertise->CurrentFilter);

		// Load list page SQL
		$sSql = $advertise->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$advertise->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $advertise;
		$sFilter = $advertise->KeyFilter();

		// Call Row Selecting event
		$advertise->Row_Selecting($sFilter);

		// Load sql based on filter
		$advertise->CurrentFilter = $sFilter;
		$sSql = $advertise->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$advertise->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $advertise;
		$advertise->id->setDbValue($rs->fields('id'));
		$advertise->adv->Upload->DbValue = $rs->fields('adv');
		$advertise->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $advertise;

		// Call Row_Rendering event
		$advertise->Row_Rendering();

		// Common render codes for all row types
		// id

		$advertise->id->CellCssStyle = "";
		$advertise->id->CellCssClass = "";

		// adv
		$advertise->adv->CellCssStyle = "";
		$advertise->adv->CellCssClass = "";

		// status
		$advertise->status->CellCssStyle = "";
		$advertise->status->CellCssClass = "";
		if ($advertise->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$advertise->id->ViewValue = $advertise->id->CurrentValue;
			$advertise->id->CssStyle = "";
			$advertise->id->CssClass = "";
			$advertise->id->ViewCustomAttributes = "";

			// adv
			if (!is_null($advertise->adv->Upload->DbValue)) {
				$advertise->adv->ViewValue = $advertise->adv->Upload->DbValue;
				$advertise->adv->ImageWidth = 200;
				$advertise->adv->ImageHeight = 0;
				$advertise->adv->ImageAlt = "";
			} else {
				$advertise->adv->ViewValue = "";
			}
			$advertise->adv->CssStyle = "";
			$advertise->adv->CssClass = "";
			$advertise->adv->ViewCustomAttributes = "";

			// status
			if (strval($advertise->status->CurrentValue) <> "") {
				switch ($advertise->status->CurrentValue) {
					case "1":
						$advertise->status->ViewValue = "Active";
						break;
					case "2":
						$advertise->status->ViewValue = "Not Active";
						break;
					default:
						$advertise->status->ViewValue = $advertise->status->CurrentValue;
				}
			} else {
				$advertise->status->ViewValue = NULL;
			}
			$advertise->status->CssStyle = "";
			$advertise->status->CssClass = "";
			$advertise->status->ViewCustomAttributes = "";

			// id
			$advertise->id->HrefValue = "";

			// adv
			$advertise->adv->HrefValue = "";

			// status
			$advertise->status->HrefValue = "";
		}

		// Call Row Rendered event
		$advertise->Row_Rendered();
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
