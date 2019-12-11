<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "feature_productinfo.php" ?>
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
$feature_product_list = new cfeature_product_list();
$Page =& $feature_product_list;

// Page init processing
$feature_product_list->Page_Init();

// Page main processing
$feature_product_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($feature_product->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var feature_product_list = new ew_Page("feature_product_list");

// page properties
feature_product_list.PageID = "list"; // page ID
var EW_PAGE_ID = feature_product_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
feature_product_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
feature_product_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
feature_product_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($feature_product->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($feature_product->Export == "" && $feature_product->SelectLimit);
	if (!$bSelectLimit)
		$rs = $feature_product_list->LoadRecordset();
	$feature_product_list->lTotalRecs = ($bSelectLimit) ? $feature_product->SelectRecordCount() : $rs->RecordCount();
	$feature_product_list->lStartRec = 1;
	if ($feature_product_list->lDisplayRecs <= 0) // Display all records
		$feature_product_list->lDisplayRecs = $feature_product_list->lTotalRecs;
	if (!($feature_product->ExportAll && $feature_product->Export <> ""))
		$feature_product_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $feature_product_list->LoadRecordset($feature_product_list->lStartRec-1, $feature_product_list->lDisplayRecs);
?>
<div align="center" class="msm_h1">TABLE: Feature Product</div>
<p><span class="phpmaker" style="white-space: nowrap;">
</span></p>
<?php $feature_product_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($feature_product->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($feature_product->CurrentAction <> "gridadd" && $feature_product->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($feature_product_list->Pager)) $feature_product_list->Pager = new cNumericPager($feature_product_list->lStartRec, $feature_product_list->lDisplayRecs, $feature_product_list->lTotalRecs, $feature_product_list->lRecRange) ?>
<?php if ($feature_product_list->Pager->RecordCount > 0) { ?>
	<?php if ($feature_product_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $feature_product_list->PageUrl() ?>start=<?php echo $feature_product_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($feature_product_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $feature_product_list->PageUrl() ?>start=<?php echo $feature_product_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($feature_product_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $feature_product_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($feature_product_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $feature_product_list->PageUrl() ?>start=<?php echo $feature_product_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($feature_product_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $feature_product_list->PageUrl() ?>start=<?php echo $feature_product_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($feature_product_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $feature_product_list->Pager->FromIndex ?> to <?php echo $feature_product_list->Pager->ToIndex ?> of <?php echo $feature_product_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($feature_product_list->sSrchWhere == "0=101") { ?>
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
<a href="<?php echo $feature_product->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="ffeature_productlist" id="ffeature_productlist" class="ewForm" action="" method="post">
<?php if ($feature_product_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$feature_product_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$feature_product_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$feature_product_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$feature_product_list->lOptionCnt++; // Delete
}
	$feature_product_list->lOptionCnt += count($feature_product_list->ListOptions->Items); // Custom list options
?>
<?php echo $feature_product->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($feature_product->id->Visible) { // id ?>
	<?php if ($feature_product->SortUrl($feature_product->id) == "") { ?>
		<td>Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $feature_product->SortUrl($feature_product->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($feature_product->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($feature_product->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($feature_product->product_id->Visible) { // product_id ?>
	<?php if ($feature_product->SortUrl($feature_product->product_id) == "") { ?>
		<td>Product Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $feature_product->SortUrl($feature_product->product_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Product Id</td><td style="width: 10px;"><?php if ($feature_product->product_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($feature_product->product_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($feature_product->sort_order->Visible) { // sort_order ?>
	<?php if ($feature_product->SortUrl($feature_product->sort_order) == "") { ?>
		<td>Sort Order</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $feature_product->SortUrl($feature_product->sort_order) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Sort Order</td><td style="width: 10px;"><?php if ($feature_product->sort_order->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($feature_product->sort_order->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($feature_product->status->Visible) { // status ?>
	<?php if ($feature_product->SortUrl($feature_product->status) == "") { ?>
		<td>Status</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $feature_product->SortUrl($feature_product->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Status</td><td style="width: 10px;"><?php if ($feature_product->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($feature_product->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($feature_product->Export == "") { ?>
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
foreach ($feature_product_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($feature_product->ExportAll && $feature_product->Export <> "") {
	$feature_product_list->lStopRec = $feature_product_list->lTotalRecs;
} else {
	$feature_product_list->lStopRec = $feature_product_list->lStartRec + $feature_product_list->lDisplayRecs - 1; // Set the last record to display
}
$feature_product_list->lRecCount = $feature_product_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$feature_product->SelectLimit && $feature_product_list->lStartRec > 1)
		$rs->Move($feature_product_list->lStartRec - 1);
}
$feature_product_list->lRowCnt = 0;
while (($feature_product->CurrentAction == "gridadd" || !$rs->EOF) &&
	$feature_product_list->lRecCount < $feature_product_list->lStopRec) {
	$feature_product_list->lRecCount++;
	if (intval($feature_product_list->lRecCount) >= intval($feature_product_list->lStartRec)) {
		$feature_product_list->lRowCnt++;

	// Init row class and style
	$feature_product->CssClass = "";
	$feature_product->CssStyle = "";
	$feature_product->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($feature_product->CurrentAction == "gridadd") {
		$feature_product_list->LoadDefaultValues(); // Load default values
	} else {
		$feature_product_list->LoadRowValues($rs); // Load row values
	}
	$feature_product->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$feature_product_list->RenderRow();
?>
	<tr<?php echo $feature_product->RowAttributes() ?>>
	<?php if ($feature_product->id->Visible) { // id ?>
		<td<?php echo $feature_product->id->CellAttributes() ?>>
<div<?php echo $feature_product->id->ViewAttributes() ?>><?php echo $feature_product->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($feature_product->product_id->Visible) { // product_id ?>
		<td<?php echo $feature_product->product_id->CellAttributes() ?>>
<div<?php echo $feature_product->product_id->ViewAttributes() ?>><?php echo $feature_product->product_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($feature_product->sort_order->Visible) { // sort_order ?>
		<td<?php echo $feature_product->sort_order->CellAttributes() ?>>
<div<?php echo $feature_product->sort_order->ViewAttributes() ?>><?php echo $feature_product->sort_order->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($feature_product->status->Visible) { // status ?>
		<td<?php echo $feature_product->status->CellAttributes() ?>>
<div<?php echo $feature_product->status->ViewAttributes() ?>><?php echo $feature_product->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($feature_product->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $feature_product->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $feature_product->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $feature_product->DeleteUrl() ?>"><img src='images/delete.gif' alt='Delete' title='Delete' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($feature_product_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($feature_product->CurrentAction <> "gridadd")
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
<?php if ($feature_product_list->lTotalRecs > 0) { ?>
<?php if ($feature_product->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($feature_product->CurrentAction <> "gridadd" && $feature_product->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($feature_product_list->Pager)) $feature_product_list->Pager = new cNumericPager($feature_product_list->lStartRec, $feature_product_list->lDisplayRecs, $feature_product_list->lTotalRecs, $feature_product_list->lRecRange) ?>
<?php if ($feature_product_list->Pager->RecordCount > 0) { ?>
	<?php if ($feature_product_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $feature_product_list->PageUrl() ?>start=<?php echo $feature_product_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($feature_product_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $feature_product_list->PageUrl() ?>start=<?php echo $feature_product_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($feature_product_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $feature_product_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($feature_product_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $feature_product_list->PageUrl() ?>start=<?php echo $feature_product_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($feature_product_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $feature_product_list->PageUrl() ?>start=<?php echo $feature_product_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($feature_product_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $feature_product_list->Pager->FromIndex ?> to <?php echo $feature_product_list->Pager->ToIndex ?> of <?php echo $feature_product_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($feature_product_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($feature_product_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $feature_product->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($feature_product->Export == "" && $feature_product->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(feature_product_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($feature_product->Export == "") { ?>
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
class cfeature_product_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'feature_product';

	// Page Object Name
	var $PageObjName = 'feature_product_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $feature_product;
		if ($feature_product->UseTokenInUrl) $PageUrl .= "t=" . $feature_product->TableVar . "&"; // add page token
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
		global $objForm, $feature_product;
		if ($feature_product->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($feature_product->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($feature_product->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cfeature_product_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["feature_product"] = new cfeature_product();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'feature_product', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $feature_product;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$feature_product->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $feature_product->Export; // Get export parameter, used in header
	$gsExportFile = $feature_product->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $feature_product;
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
		if ($feature_product->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $feature_product->getRecordsPerPage(); // Restore from Session
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
		$feature_product->setSessionWhere($sFilter);
		$feature_product->CurrentFilter = "";
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $feature_product;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$feature_product->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$feature_product->CurrentOrderType = @$_GET["ordertype"];
			$feature_product->UpdateSort($feature_product->id); // Field 
			$feature_product->UpdateSort($feature_product->product_id); // Field 
			$feature_product->UpdateSort($feature_product->sort_order); // Field 
			$feature_product->UpdateSort($feature_product->status); // Field 
			$feature_product->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $feature_product;
		$sOrderBy = $feature_product->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($feature_product->SqlOrderBy() <> "") {
				$sOrderBy = $feature_product->SqlOrderBy();
				$feature_product->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $feature_product;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$feature_product->setSessionOrderBy($sOrderBy);
				$feature_product->id->setSort("");
				$feature_product->product_id->setSort("");
				$feature_product->sort_order->setSort("");
				$feature_product->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$feature_product->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $feature_product;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$feature_product->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$feature_product->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $feature_product->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$feature_product->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$feature_product->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$feature_product->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $feature_product;

		// Call Recordset Selecting event
		$feature_product->Recordset_Selecting($feature_product->CurrentFilter);

		// Load list page SQL
		$sSql = $feature_product->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$feature_product->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $feature_product;
		$sFilter = $feature_product->KeyFilter();

		// Call Row Selecting event
		$feature_product->Row_Selecting($sFilter);

		// Load sql based on filter
		$feature_product->CurrentFilter = $sFilter;
		$sSql = $feature_product->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$feature_product->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $feature_product;
		$feature_product->id->setDbValue($rs->fields('id'));
		$feature_product->product_id->setDbValue($rs->fields('product_id'));
		$feature_product->sort_order->setDbValue($rs->fields('sort_order'));
		$feature_product->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $feature_product;

		// Call Row_Rendering event
		$feature_product->Row_Rendering();

		// Common render codes for all row types
		// id

		$feature_product->id->CellCssStyle = "";
		$feature_product->id->CellCssClass = "";

		// product_id
		$feature_product->product_id->CellCssStyle = "";
		$feature_product->product_id->CellCssClass = "";

		// sort_order
		$feature_product->sort_order->CellCssStyle = "";
		$feature_product->sort_order->CellCssClass = "";

		// status
		$feature_product->status->CellCssStyle = "";
		$feature_product->status->CellCssClass = "";
		if ($feature_product->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$feature_product->id->ViewValue = $feature_product->id->CurrentValue;
			$feature_product->id->CssStyle = "";
			$feature_product->id->CssClass = "";
			$feature_product->id->ViewCustomAttributes = "";

			// product_id
			$feature_product->product_id->ViewValue = $feature_product->product_id->CurrentValue;
			$feature_product->product_id->CssStyle = "";
			$feature_product->product_id->CssClass = "";
			$feature_product->product_id->ViewCustomAttributes = "";

			// sort_order
			$feature_product->sort_order->ViewValue = $feature_product->sort_order->CurrentValue;
			$feature_product->sort_order->CssStyle = "";
			$feature_product->sort_order->CssClass = "";
			$feature_product->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($feature_product->status->CurrentValue) <> "") {
				switch ($feature_product->status->CurrentValue) {
					case "1":
						$feature_product->status->ViewValue = "Active";
						break;
					case "2":
						$feature_product->status->ViewValue = "Not Active";
						break;
					default:
						$feature_product->status->ViewValue = $feature_product->status->CurrentValue;
				}
			} else {
				$feature_product->status->ViewValue = NULL;
			}
			$feature_product->status->CssStyle = "";
			$feature_product->status->CssClass = "";
			$feature_product->status->ViewCustomAttributes = "";

			// id
			$feature_product->id->HrefValue = "";

			// product_id
			$feature_product->product_id->HrefValue = "";

			// sort_order
			$feature_product->sort_order->HrefValue = "";

			// status
			$feature_product->status->HrefValue = "";
		}

		// Call Row Rendered event
		$feature_product->Row_Rendered();
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
