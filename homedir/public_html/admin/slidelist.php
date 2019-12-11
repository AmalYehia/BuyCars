<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "slideinfo.php" ?>
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
$slide_list = new cslide_list();
$Page =& $slide_list;

// Page init processing
$slide_list->Page_Init();

// Page main processing
$slide_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($slide->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var slide_list = new ew_Page("slide_list");

// page properties
slide_list.PageID = "list"; // page ID
var EW_PAGE_ID = slide_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
slide_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
slide_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
slide_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($slide->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($slide->Export == "" && $slide->SelectLimit);
	if (!$bSelectLimit)
		$rs = $slide_list->LoadRecordset();
	$slide_list->lTotalRecs = ($bSelectLimit) ? $slide->SelectRecordCount() : $rs->RecordCount();
	$slide_list->lStartRec = 1;
	if ($slide_list->lDisplayRecs <= 0) // Display all records
		$slide_list->lDisplayRecs = $slide_list->lTotalRecs;
	if (!($slide->ExportAll && $slide->Export <> ""))
		$slide_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $slide_list->LoadRecordset($slide_list->lStartRec-1, $slide_list->lDisplayRecs);
?>
<div align="center" class="msm_h1">TABLE: Slide</div>
<p><span class="phpmaker" style="white-space: nowrap;">
</span></p>
<?php $slide_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($slide->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($slide->CurrentAction <> "gridadd" && $slide->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($slide_list->Pager)) $slide_list->Pager = new cNumericPager($slide_list->lStartRec, $slide_list->lDisplayRecs, $slide_list->lTotalRecs, $slide_list->lRecRange) ?>
<?php if ($slide_list->Pager->RecordCount > 0) { ?>
	<?php if ($slide_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $slide_list->PageUrl() ?>start=<?php echo $slide_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($slide_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $slide_list->PageUrl() ?>start=<?php echo $slide_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($slide_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $slide_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($slide_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $slide_list->PageUrl() ?>start=<?php echo $slide_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($slide_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $slide_list->PageUrl() ?>start=<?php echo $slide_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($slide_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $slide_list->Pager->FromIndex ?> to <?php echo $slide_list->Pager->ToIndex ?> of <?php echo $slide_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($slide_list->sSrchWhere == "0=101") { ?>
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
<a href="<?php echo $slide->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fslidelist" id="fslidelist" class="ewForm" action="" method="post">
<?php if ($slide_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$slide_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$slide_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$slide_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$slide_list->lOptionCnt++; // Delete
}
	$slide_list->lOptionCnt += count($slide_list->ListOptions->Items); // Custom list options
?>
<?php echo $slide->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($slide->id->Visible) { // id ?>
	<?php if ($slide->SortUrl($slide->id) == "") { ?>
		<td>Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $slide->SortUrl($slide->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($slide->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($slide->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($slide->slide_photo->Visible) { // slide_photo ?>
	<?php if ($slide->SortUrl($slide->slide_photo) == "") { ?>
		<td>Slide Photo</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $slide->SortUrl($slide->slide_photo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Slide Photo</td><td style="width: 10px;"><?php if ($slide->slide_photo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($slide->slide_photo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($slide->sort_order->Visible) { // sort_order ?>
	<?php if ($slide->SortUrl($slide->sort_order) == "") { ?>
		<td>Sort Order</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $slide->SortUrl($slide->sort_order) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Sort Order</td><td style="width: 10px;"><?php if ($slide->sort_order->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($slide->sort_order->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($slide->status->Visible) { // status ?>
	<?php if ($slide->SortUrl($slide->status) == "") { ?>
		<td>Status</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $slide->SortUrl($slide->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Status</td><td style="width: 10px;"><?php if ($slide->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($slide->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($slide->Export == "") { ?>
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
foreach ($slide_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($slide->ExportAll && $slide->Export <> "") {
	$slide_list->lStopRec = $slide_list->lTotalRecs;
} else {
	$slide_list->lStopRec = $slide_list->lStartRec + $slide_list->lDisplayRecs - 1; // Set the last record to display
}
$slide_list->lRecCount = $slide_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$slide->SelectLimit && $slide_list->lStartRec > 1)
		$rs->Move($slide_list->lStartRec - 1);
}
$slide_list->lRowCnt = 0;
while (($slide->CurrentAction == "gridadd" || !$rs->EOF) &&
	$slide_list->lRecCount < $slide_list->lStopRec) {
	$slide_list->lRecCount++;
	if (intval($slide_list->lRecCount) >= intval($slide_list->lStartRec)) {
		$slide_list->lRowCnt++;

	// Init row class and style
	$slide->CssClass = "";
	$slide->CssStyle = "";
	$slide->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($slide->CurrentAction == "gridadd") {
		$slide_list->LoadDefaultValues(); // Load default values
	} else {
		$slide_list->LoadRowValues($rs); // Load row values
	}
	$slide->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$slide_list->RenderRow();
?>
	<tr<?php echo $slide->RowAttributes() ?>>
	<?php if ($slide->id->Visible) { // id ?>
		<td<?php echo $slide->id->CellAttributes() ?>>
<div<?php echo $slide->id->ViewAttributes() ?>><?php echo $slide->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($slide->slide_photo->Visible) { // slide_photo ?>
		<td<?php echo $slide->slide_photo->CellAttributes() ?>>
<?php if ($slide->slide_photo->HrefValue <> "") { ?>
<?php if (!is_null($slide->slide_photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/photo/") . $slide->slide_photo->Upload->DbValue ?>" border=0<?php echo $slide->slide_photo->ViewAttributes() ?>>
<?php } elseif (!in_array($slide->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($slide->slide_photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/photo/") . $slide->slide_photo->Upload->DbValue ?>" border=0<?php echo $slide->slide_photo->ViewAttributes() ?>>
<?php } elseif (!in_array($slide->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($slide->sort_order->Visible) { // sort_order ?>
		<td<?php echo $slide->sort_order->CellAttributes() ?>>
<div<?php echo $slide->sort_order->ViewAttributes() ?>><?php echo $slide->sort_order->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($slide->status->Visible) { // status ?>
		<td<?php echo $slide->status->CellAttributes() ?>>
<div<?php echo $slide->status->ViewAttributes() ?>><?php echo $slide->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($slide->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $slide->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $slide->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $slide->DeleteUrl() ?>"><img src='images/delete.gif' alt='Delete' title='Delete' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($slide_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($slide->CurrentAction <> "gridadd")
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
<?php if ($slide_list->lTotalRecs > 0) { ?>
<?php if ($slide->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($slide->CurrentAction <> "gridadd" && $slide->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($slide_list->Pager)) $slide_list->Pager = new cNumericPager($slide_list->lStartRec, $slide_list->lDisplayRecs, $slide_list->lTotalRecs, $slide_list->lRecRange) ?>
<?php if ($slide_list->Pager->RecordCount > 0) { ?>
	<?php if ($slide_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $slide_list->PageUrl() ?>start=<?php echo $slide_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($slide_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $slide_list->PageUrl() ?>start=<?php echo $slide_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($slide_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $slide_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($slide_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $slide_list->PageUrl() ?>start=<?php echo $slide_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($slide_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $slide_list->PageUrl() ?>start=<?php echo $slide_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($slide_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $slide_list->Pager->FromIndex ?> to <?php echo $slide_list->Pager->ToIndex ?> of <?php echo $slide_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($slide_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($slide_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $slide->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($slide->Export == "" && $slide->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(slide_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($slide->Export == "") { ?>
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
class cslide_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'slide';

	// Page Object Name
	var $PageObjName = 'slide_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $slide;
		if ($slide->UseTokenInUrl) $PageUrl .= "t=" . $slide->TableVar . "&"; // add page token
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
		global $objForm, $slide;
		if ($slide->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($slide->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($slide->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cslide_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["slide"] = new cslide();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'slide', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $slide;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$slide->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $slide->Export; // Get export parameter, used in header
	$gsExportFile = $slide->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $slide;
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
		if ($slide->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $slide->getRecordsPerPage(); // Restore from Session
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
		$slide->setSessionWhere($sFilter);
		$slide->CurrentFilter = "";
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $slide;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$slide->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$slide->CurrentOrderType = @$_GET["ordertype"];
			$slide->UpdateSort($slide->id); // Field 
			$slide->UpdateSort($slide->slide_photo); // Field 
			$slide->UpdateSort($slide->sort_order); // Field 
			$slide->UpdateSort($slide->status); // Field 
			$slide->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $slide;
		$sOrderBy = $slide->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($slide->SqlOrderBy() <> "") {
				$sOrderBy = $slide->SqlOrderBy();
				$slide->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $slide;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$slide->setSessionOrderBy($sOrderBy);
				$slide->id->setSort("");
				$slide->slide_photo->setSort("");
				$slide->sort_order->setSort("");
				$slide->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$slide->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $slide;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$slide->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$slide->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $slide->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$slide->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$slide->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$slide->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $slide;

		// Call Recordset Selecting event
		$slide->Recordset_Selecting($slide->CurrentFilter);

		// Load list page SQL
		$sSql = $slide->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$slide->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $slide;
		$sFilter = $slide->KeyFilter();

		// Call Row Selecting event
		$slide->Row_Selecting($sFilter);

		// Load sql based on filter
		$slide->CurrentFilter = $sFilter;
		$sSql = $slide->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$slide->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $slide;
		$slide->id->setDbValue($rs->fields('id'));
		$slide->slide_photo->Upload->DbValue = $rs->fields('slide_photo');
		$slide->sort_order->setDbValue($rs->fields('sort_order'));
		$slide->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $slide;

		// Call Row_Rendering event
		$slide->Row_Rendering();

		// Common render codes for all row types
		// id

		$slide->id->CellCssStyle = "";
		$slide->id->CellCssClass = "";

		// slide_photo
		$slide->slide_photo->CellCssStyle = "";
		$slide->slide_photo->CellCssClass = "";

		// sort_order
		$slide->sort_order->CellCssStyle = "";
		$slide->sort_order->CellCssClass = "";

		// status
		$slide->status->CellCssStyle = "";
		$slide->status->CellCssClass = "";
		if ($slide->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$slide->id->ViewValue = $slide->id->CurrentValue;
			$slide->id->CssStyle = "";
			$slide->id->CssClass = "";
			$slide->id->ViewCustomAttributes = "";

			// slide_photo
			if (!is_null($slide->slide_photo->Upload->DbValue)) {
				$slide->slide_photo->ViewValue = $slide->slide_photo->Upload->DbValue;
				$slide->slide_photo->ImageWidth = 100;
				$slide->slide_photo->ImageHeight = 0;
				$slide->slide_photo->ImageAlt = "";
			} else {
				$slide->slide_photo->ViewValue = "";
			}
			$slide->slide_photo->CssStyle = "";
			$slide->slide_photo->CssClass = "";
			$slide->slide_photo->ViewCustomAttributes = "";

			// sort_order
			$slide->sort_order->ViewValue = $slide->sort_order->CurrentValue;
			$slide->sort_order->CssStyle = "";
			$slide->sort_order->CssClass = "";
			$slide->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($slide->status->CurrentValue) <> "") {
				switch ($slide->status->CurrentValue) {
					case "1":
						$slide->status->ViewValue = "Active";
						break;
					case "2":
						$slide->status->ViewValue = "Not Active";
						break;
					default:
						$slide->status->ViewValue = $slide->status->CurrentValue;
				}
			} else {
				$slide->status->ViewValue = NULL;
			}
			$slide->status->CssStyle = "";
			$slide->status->CssClass = "";
			$slide->status->ViewCustomAttributes = "";

			// id
			$slide->id->HrefValue = "";

			// slide_photo
			$slide->slide_photo->HrefValue = "";

			// sort_order
			$slide->sort_order->HrefValue = "";

			// status
			$slide->status->HrefValue = "";
		}

		// Call Row Rendered event
		$slide->Row_Rendered();
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
