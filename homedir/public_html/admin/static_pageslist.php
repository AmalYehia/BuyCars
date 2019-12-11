<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "static_pagesinfo.php" ?>
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
$static_pages_list = new cstatic_pages_list();
$Page =& $static_pages_list;

// Page init processing
$static_pages_list->Page_Init();

// Page main processing
$static_pages_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($static_pages->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var static_pages_list = new ew_Page("static_pages_list");

// page properties
static_pages_list.PageID = "list"; // page ID
var EW_PAGE_ID = static_pages_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
static_pages_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
static_pages_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
static_pages_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($static_pages->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($static_pages->Export == "" && $static_pages->SelectLimit);
	if (!$bSelectLimit)
		$rs = $static_pages_list->LoadRecordset();
	$static_pages_list->lTotalRecs = ($bSelectLimit) ? $static_pages->SelectRecordCount() : $rs->RecordCount();
	$static_pages_list->lStartRec = 1;
	if ($static_pages_list->lDisplayRecs <= 0) // Display all records
		$static_pages_list->lDisplayRecs = $static_pages_list->lTotalRecs;
	if (!($static_pages->ExportAll && $static_pages->Export <> ""))
		$static_pages_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $static_pages_list->LoadRecordset($static_pages_list->lStartRec-1, $static_pages_list->lDisplayRecs);
?>
<div align="center" class="msm_h1">TABLE: Static Pages</div>
<p><span class="phpmaker" style="white-space: nowrap;">
</span></p>
<?php $static_pages_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($static_pages->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($static_pages->CurrentAction <> "gridadd" && $static_pages->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($static_pages_list->Pager)) $static_pages_list->Pager = new cNumericPager($static_pages_list->lStartRec, $static_pages_list->lDisplayRecs, $static_pages_list->lTotalRecs, $static_pages_list->lRecRange) ?>
<?php if ($static_pages_list->Pager->RecordCount > 0) { ?>
	<?php if ($static_pages_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $static_pages_list->PageUrl() ?>start=<?php echo $static_pages_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($static_pages_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $static_pages_list->PageUrl() ?>start=<?php echo $static_pages_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($static_pages_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $static_pages_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($static_pages_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $static_pages_list->PageUrl() ?>start=<?php echo $static_pages_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($static_pages_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $static_pages_list->PageUrl() ?>start=<?php echo $static_pages_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($static_pages_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $static_pages_list->Pager->FromIndex ?> to <?php echo $static_pages_list->Pager->ToIndex ?> of <?php echo $static_pages_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($static_pages_list->sSrchWhere == "0=101") { ?>
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
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fstatic_pageslist" id="fstatic_pageslist" class="ewForm" action="" method="post">
<?php if ($static_pages_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$static_pages_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$static_pages_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$static_pages_list->lOptionCnt++; // edit
}
	$static_pages_list->lOptionCnt += count($static_pages_list->ListOptions->Items); // Custom list options
?>
<?php echo $static_pages->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($static_pages->id->Visible) { // id ?>
	<?php if ($static_pages->SortUrl($static_pages->id) == "") { ?>
		<td>Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $static_pages->SortUrl($static_pages->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($static_pages->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($static_pages->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($static_pages->header->Visible) { // header ?>
	<?php if ($static_pages->SortUrl($static_pages->header) == "") { ?>
		<td>Header</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $static_pages->SortUrl($static_pages->header) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Header</td><td style="width: 10px;"><?php if ($static_pages->header->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($static_pages->header->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($static_pages->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php

// Custom list options
foreach ($static_pages_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($static_pages->ExportAll && $static_pages->Export <> "") {
	$static_pages_list->lStopRec = $static_pages_list->lTotalRecs;
} else {
	$static_pages_list->lStopRec = $static_pages_list->lStartRec + $static_pages_list->lDisplayRecs - 1; // Set the last record to display
}
$static_pages_list->lRecCount = $static_pages_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$static_pages->SelectLimit && $static_pages_list->lStartRec > 1)
		$rs->Move($static_pages_list->lStartRec - 1);
}
$static_pages_list->lRowCnt = 0;
while (($static_pages->CurrentAction == "gridadd" || !$rs->EOF) &&
	$static_pages_list->lRecCount < $static_pages_list->lStopRec) {
	$static_pages_list->lRecCount++;
	if (intval($static_pages_list->lRecCount) >= intval($static_pages_list->lStartRec)) {
		$static_pages_list->lRowCnt++;

	// Init row class and style
	$static_pages->CssClass = "";
	$static_pages->CssStyle = "";
	$static_pages->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($static_pages->CurrentAction == "gridadd") {
		$static_pages_list->LoadDefaultValues(); // Load default values
	} else {
		$static_pages_list->LoadRowValues($rs); // Load row values
	}
	$static_pages->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$static_pages_list->RenderRow();
?>
	<tr<?php echo $static_pages->RowAttributes() ?>>
	<?php if ($static_pages->id->Visible) { // id ?>
		<td<?php echo $static_pages->id->CellAttributes() ?>>
<div<?php echo $static_pages->id->ViewAttributes() ?>><?php echo $static_pages->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($static_pages->header->Visible) { // header ?>
		<td<?php echo $static_pages->header->CellAttributes() ?>>
<div<?php echo $static_pages->header->ViewAttributes() ?>><?php echo $static_pages->header->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($static_pages->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $static_pages->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $static_pages->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($static_pages_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($static_pages->CurrentAction <> "gridadd")
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
<?php if ($static_pages_list->lTotalRecs > 0) { ?>
<?php if ($static_pages->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($static_pages->CurrentAction <> "gridadd" && $static_pages->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($static_pages_list->Pager)) $static_pages_list->Pager = new cNumericPager($static_pages_list->lStartRec, $static_pages_list->lDisplayRecs, $static_pages_list->lTotalRecs, $static_pages_list->lRecRange) ?>
<?php if ($static_pages_list->Pager->RecordCount > 0) { ?>
	<?php if ($static_pages_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $static_pages_list->PageUrl() ?>start=<?php echo $static_pages_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($static_pages_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $static_pages_list->PageUrl() ?>start=<?php echo $static_pages_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($static_pages_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $static_pages_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($static_pages_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $static_pages_list->PageUrl() ?>start=<?php echo $static_pages_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($static_pages_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $static_pages_list->PageUrl() ?>start=<?php echo $static_pages_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($static_pages_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $static_pages_list->Pager->FromIndex ?> to <?php echo $static_pages_list->Pager->ToIndex ?> of <?php echo $static_pages_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($static_pages_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($static_pages_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($static_pages->Export == "" && $static_pages->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(static_pages_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($static_pages->Export == "") { ?>
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
class cstatic_pages_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'static_pages';

	// Page Object Name
	var $PageObjName = 'static_pages_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $static_pages;
		if ($static_pages->UseTokenInUrl) $PageUrl .= "t=" . $static_pages->TableVar . "&"; // add page token
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
		global $objForm, $static_pages;
		if ($static_pages->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($static_pages->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($static_pages->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cstatic_pages_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["static_pages"] = new cstatic_pages();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'static_pages', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $static_pages;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$static_pages->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $static_pages->Export; // Get export parameter, used in header
	$gsExportFile = $static_pages->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $static_pages;
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
		if ($static_pages->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $static_pages->getRecordsPerPage(); // Restore from Session
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
		$static_pages->setSessionWhere($sFilter);
		$static_pages->CurrentFilter = "";
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $static_pages;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$static_pages->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$static_pages->CurrentOrderType = @$_GET["ordertype"];
			$static_pages->UpdateSort($static_pages->id); // Field 
			$static_pages->UpdateSort($static_pages->header); // Field 
			$static_pages->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $static_pages;
		$sOrderBy = $static_pages->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($static_pages->SqlOrderBy() <> "") {
				$sOrderBy = $static_pages->SqlOrderBy();
				$static_pages->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $static_pages;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$static_pages->setSessionOrderBy($sOrderBy);
				$static_pages->id->setSort("");
				$static_pages->header->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$static_pages->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $static_pages;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$static_pages->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$static_pages->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $static_pages->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$static_pages->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$static_pages->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$static_pages->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $static_pages;

		// Call Recordset Selecting event
		$static_pages->Recordset_Selecting($static_pages->CurrentFilter);

		// Load list page SQL
		$sSql = $static_pages->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$static_pages->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $static_pages;
		$sFilter = $static_pages->KeyFilter();

		// Call Row Selecting event
		$static_pages->Row_Selecting($sFilter);

		// Load sql based on filter
		$static_pages->CurrentFilter = $sFilter;
		$sSql = $static_pages->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$static_pages->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $static_pages;
		$static_pages->id->setDbValue($rs->fields('id'));
		$static_pages->header->setDbValue($rs->fields('header'));
		$static_pages->description->setDbValue($rs->fields('description'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $static_pages;

		// Call Row_Rendering event
		$static_pages->Row_Rendering();

		// Common render codes for all row types
		// id

		$static_pages->id->CellCssStyle = "";
		$static_pages->id->CellCssClass = "";

		// header
		$static_pages->header->CellCssStyle = "";
		$static_pages->header->CellCssClass = "";
		if ($static_pages->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$static_pages->id->ViewValue = $static_pages->id->CurrentValue;
			$static_pages->id->CssStyle = "";
			$static_pages->id->CssClass = "";
			$static_pages->id->ViewCustomAttributes = "";

			// header
			$static_pages->header->ViewValue = $static_pages->header->CurrentValue;
			$static_pages->header->CssStyle = "";
			$static_pages->header->CssClass = "";
			$static_pages->header->ViewCustomAttributes = "";

			// id
			$static_pages->id->HrefValue = "";

			// header
			$static_pages->header->HrefValue = "";
		}

		// Call Row Rendered event
		$static_pages->Row_Rendered();
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
