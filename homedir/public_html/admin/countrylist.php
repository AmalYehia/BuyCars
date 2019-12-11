<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "countryinfo.php" ?>
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
$country_list = new ccountry_list();
$Page =& $country_list;

// Page init processing
$country_list->Page_Init();

// Page main processing
$country_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($country->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var country_list = new ew_Page("country_list");

// page properties
country_list.PageID = "list"; // page ID
var EW_PAGE_ID = country_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
country_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
country_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
country_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($country->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($country->Export == "" && $country->SelectLimit);
	if (!$bSelectLimit)
		$rs = $country_list->LoadRecordset();
	$country_list->lTotalRecs = ($bSelectLimit) ? $country->SelectRecordCount() : $rs->RecordCount();
	$country_list->lStartRec = 1;
	if ($country_list->lDisplayRecs <= 0) // Display all records
		$country_list->lDisplayRecs = $country_list->lTotalRecs;
	if (!($country->ExportAll && $country->Export <> ""))
		$country_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $country_list->LoadRecordset($country_list->lStartRec-1, $country_list->lDisplayRecs);
?>
<div align="center" class="msm_h1">TABLE: Country</div>
<p><span class="phpmaker" style="white-space: nowrap;">
</span></p>
<?php $country_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($country->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($country->CurrentAction <> "gridadd" && $country->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($country_list->Pager)) $country_list->Pager = new cNumericPager($country_list->lStartRec, $country_list->lDisplayRecs, $country_list->lTotalRecs, $country_list->lRecRange) ?>
<?php if ($country_list->Pager->RecordCount > 0) { ?>
	<?php if ($country_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $country_list->PageUrl() ?>start=<?php echo $country_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($country_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $country_list->PageUrl() ?>start=<?php echo $country_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($country_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $country_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($country_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $country_list->PageUrl() ?>start=<?php echo $country_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($country_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $country_list->PageUrl() ?>start=<?php echo $country_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($country_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $country_list->Pager->FromIndex ?> to <?php echo $country_list->Pager->ToIndex ?> of <?php echo $country_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($country_list->sSrchWhere == "0=101") { ?>
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
<a href="<?php echo $country->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fcountrylist" id="fcountrylist" class="ewForm" action="" method="post">
<?php if ($country_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$country_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$country_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$country_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$country_list->lOptionCnt++; // Delete
}
	$country_list->lOptionCnt += count($country_list->ListOptions->Items); // Custom list options
?>
<?php echo $country->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($country->id->Visible) { // id ?>
	<?php if ($country->SortUrl($country->id) == "") { ?>
		<td>Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $country->SortUrl($country->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($country->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($country->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($country->name->Visible) { // name ?>
	<?php if ($country->SortUrl($country->name) == "") { ?>
		<td>Name</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $country->SortUrl($country->name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Name</td><td style="width: 10px;"><?php if ($country->name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($country->name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($country->status->Visible) { // status ?>
	<?php if ($country->SortUrl($country->status) == "") { ?>
		<td>Status</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $country->SortUrl($country->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Status</td><td style="width: 10px;"><?php if ($country->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($country->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($country->Export == "") { ?>
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
foreach ($country_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($country->ExportAll && $country->Export <> "") {
	$country_list->lStopRec = $country_list->lTotalRecs;
} else {
	$country_list->lStopRec = $country_list->lStartRec + $country_list->lDisplayRecs - 1; // Set the last record to display
}
$country_list->lRecCount = $country_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$country->SelectLimit && $country_list->lStartRec > 1)
		$rs->Move($country_list->lStartRec - 1);
}
$country_list->lRowCnt = 0;
while (($country->CurrentAction == "gridadd" || !$rs->EOF) &&
	$country_list->lRecCount < $country_list->lStopRec) {
	$country_list->lRecCount++;
	if (intval($country_list->lRecCount) >= intval($country_list->lStartRec)) {
		$country_list->lRowCnt++;

	// Init row class and style
	$country->CssClass = "";
	$country->CssStyle = "";
	$country->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($country->CurrentAction == "gridadd") {
		$country_list->LoadDefaultValues(); // Load default values
	} else {
		$country_list->LoadRowValues($rs); // Load row values
	}
	$country->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$country_list->RenderRow();
?>
	<tr<?php echo $country->RowAttributes() ?>>
	<?php if ($country->id->Visible) { // id ?>
		<td<?php echo $country->id->CellAttributes() ?>>
<div<?php echo $country->id->ViewAttributes() ?>><?php echo $country->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($country->name->Visible) { // name ?>
		<td<?php echo $country->name->CellAttributes() ?>>
<div<?php echo $country->name->ViewAttributes() ?>><?php echo $country->name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($country->status->Visible) { // status ?>
		<td<?php echo $country->status->CellAttributes() ?>>
<div<?php echo $country->status->ViewAttributes() ?>><?php echo $country->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($country->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $country->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $country->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $country->DeleteUrl() ?>"><img src='images/delete.gif' alt='Delete' title='Delete' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($country_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($country->CurrentAction <> "gridadd")
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
<?php if ($country_list->lTotalRecs > 0) { ?>
<?php if ($country->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($country->CurrentAction <> "gridadd" && $country->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($country_list->Pager)) $country_list->Pager = new cNumericPager($country_list->lStartRec, $country_list->lDisplayRecs, $country_list->lTotalRecs, $country_list->lRecRange) ?>
<?php if ($country_list->Pager->RecordCount > 0) { ?>
	<?php if ($country_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $country_list->PageUrl() ?>start=<?php echo $country_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($country_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $country_list->PageUrl() ?>start=<?php echo $country_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($country_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $country_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($country_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $country_list->PageUrl() ?>start=<?php echo $country_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($country_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $country_list->PageUrl() ?>start=<?php echo $country_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($country_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $country_list->Pager->FromIndex ?> to <?php echo $country_list->Pager->ToIndex ?> of <?php echo $country_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($country_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($country_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $country->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($country->Export == "" && $country->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(country_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($country->Export == "") { ?>
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
class ccountry_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'country';

	// Page Object Name
	var $PageObjName = 'country_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $country;
		if ($country->UseTokenInUrl) $PageUrl .= "t=" . $country->TableVar . "&"; // add page token
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
		global $objForm, $country;
		if ($country->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($country->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($country->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccountry_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["country"] = new ccountry();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'country', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $country;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$country->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $country->Export; // Get export parameter, used in header
	$gsExportFile = $country->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $country;
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
		if ($country->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $country->getRecordsPerPage(); // Restore from Session
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
		$country->setSessionWhere($sFilter);
		$country->CurrentFilter = "";
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $country;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$country->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$country->CurrentOrderType = @$_GET["ordertype"];
			$country->UpdateSort($country->id); // Field 
			$country->UpdateSort($country->name); // Field 
			$country->UpdateSort($country->status); // Field 
			$country->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $country;
		$sOrderBy = $country->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($country->SqlOrderBy() <> "") {
				$sOrderBy = $country->SqlOrderBy();
				$country->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $country;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$country->setSessionOrderBy($sOrderBy);
				$country->id->setSort("");
				$country->name->setSort("");
				$country->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$country->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $country;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$country->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$country->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $country->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$country->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$country->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$country->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $country;

		// Call Recordset Selecting event
		$country->Recordset_Selecting($country->CurrentFilter);

		// Load list page SQL
		$sSql = $country->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$country->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $country;
		$sFilter = $country->KeyFilter();

		// Call Row Selecting event
		$country->Row_Selecting($sFilter);

		// Load sql based on filter
		$country->CurrentFilter = $sFilter;
		$sSql = $country->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$country->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $country;
		$country->id->setDbValue($rs->fields('id'));
		$country->name->setDbValue($rs->fields('name'));
		$country->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $country;

		// Call Row_Rendering event
		$country->Row_Rendering();

		// Common render codes for all row types
		// id

		$country->id->CellCssStyle = "";
		$country->id->CellCssClass = "";

		// name
		$country->name->CellCssStyle = "";
		$country->name->CellCssClass = "";

		// status
		$country->status->CellCssStyle = "";
		$country->status->CellCssClass = "";
		if ($country->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$country->id->ViewValue = $country->id->CurrentValue;
			$country->id->CssStyle = "";
			$country->id->CssClass = "";
			$country->id->ViewCustomAttributes = "";

			// name
			$country->name->ViewValue = $country->name->CurrentValue;
			$country->name->CssStyle = "";
			$country->name->CssClass = "";
			$country->name->ViewCustomAttributes = "";

			// status
			if (strval($country->status->CurrentValue) <> "") {
				switch ($country->status->CurrentValue) {
					case "1":
						$country->status->ViewValue = "Active";
						break;
					case "2":
						$country->status->ViewValue = "Not Active";
						break;
					default:
						$country->status->ViewValue = $country->status->CurrentValue;
				}
			} else {
				$country->status->ViewValue = NULL;
			}
			$country->status->CssStyle = "";
			$country->status->CssClass = "";
			$country->status->ViewCustomAttributes = "";

			// id
			$country->id->HrefValue = "";

			// name
			$country->name->HrefValue = "";

			// status
			$country->status->HrefValue = "";
		}

		// Call Row Rendered event
		$country->Row_Rendered();
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
