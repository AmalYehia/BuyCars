<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "newsinfo.php" ?>
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
$news_list = new cnews_list();
$Page =& $news_list;

// Page init processing
$news_list->Page_Init();

// Page main processing
$news_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($news->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var news_list = new ew_Page("news_list");

// page properties
news_list.PageID = "list"; // page ID
var EW_PAGE_ID = news_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
news_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
news_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
news_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
news_list.ShowHighlightText = "Show highlight"; 
news_list.HideHighlightText = "Hide highlight";

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
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($news->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($news->Export == "" && $news->SelectLimit);
	if (!$bSelectLimit)
		$rs = $news_list->LoadRecordset();
	$news_list->lTotalRecs = ($bSelectLimit) ? $news->SelectRecordCount() : $rs->RecordCount();
	$news_list->lStartRec = 1;
	if ($news_list->lDisplayRecs <= 0) // Display all records
		$news_list->lDisplayRecs = $news_list->lTotalRecs;
	if (!($news->ExportAll && $news->Export <> ""))
		$news_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $news_list->LoadRecordset($news_list->lStartRec-1, $news_list->lDisplayRecs);
?>
<div align="center" class="msm_h1">TABLE: News</div>
<p><span class="phpmaker" style="white-space: nowrap;">
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($news->Export == "" && $news->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(news_list);" style="text-decoration: none;"><img id="news_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="news_list_SearchPanel">
<form name="fnewslistsrch" id="fnewslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="news">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($news->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<a href="<?php echo $news_list->PageUrl() ?>cmd=reset">Show all</a>&nbsp;
			<?php if ($news_list->sSrchWhere <> "" && $news_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(news_list, this, '<?php echo $news->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($news->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Exact phrase</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($news->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>All words</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($news->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Any word</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $news_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($news->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($news->CurrentAction <> "gridadd" && $news->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($news_list->Pager)) $news_list->Pager = new cNumericPager($news_list->lStartRec, $news_list->lDisplayRecs, $news_list->lTotalRecs, $news_list->lRecRange) ?>
<?php if ($news_list->Pager->RecordCount > 0) { ?>
	<?php if ($news_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $news_list->PageUrl() ?>start=<?php echo $news_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($news_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $news_list->PageUrl() ?>start=<?php echo $news_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($news_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $news_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($news_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $news_list->PageUrl() ?>start=<?php echo $news_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($news_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $news_list->PageUrl() ?>start=<?php echo $news_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($news_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $news_list->Pager->FromIndex ?> to <?php echo $news_list->Pager->ToIndex ?> of <?php echo $news_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($news_list->sSrchWhere == "0=101") { ?>
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
<a href="<?php echo $news->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fnewslist" id="fnewslist" class="ewForm" action="" method="post">
<?php if ($news_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$news_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$news_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$news_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$news_list->lOptionCnt++; // Delete
}
	$news_list->lOptionCnt += count($news_list->ListOptions->Items); // Custom list options
?>
<?php echo $news->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($news->id->Visible) { // id ?>
	<?php if ($news->SortUrl($news->id) == "") { ?>
		<td>Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $news->SortUrl($news->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($news->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($news->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($news->header->Visible) { // header ?>
	<?php if ($news->SortUrl($news->header) == "") { ?>
		<td>Header</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $news->SortUrl($news->header) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Header&nbsp;(*)</td><td style="width: 10px;"><?php if ($news->header->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($news->header->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($news->photo->Visible) { // photo ?>
	<?php if ($news->SortUrl($news->photo) == "") { ?>
		<td>Photo</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $news->SortUrl($news->photo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Photo</td><td style="width: 10px;"><?php if ($news->photo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($news->photo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($news->insert_date->Visible) { // insert_date ?>
	<?php if ($news->SortUrl($news->insert_date) == "") { ?>
		<td>Insert Date</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $news->SortUrl($news->insert_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Insert Date</td><td style="width: 10px;"><?php if ($news->insert_date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($news->insert_date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($news->status->Visible) { // status ?>
	<?php if ($news->SortUrl($news->status) == "") { ?>
		<td>Status</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $news->SortUrl($news->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Status</td><td style="width: 10px;"><?php if ($news->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($news->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($news->Export == "") { ?>
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
foreach ($news_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($news->ExportAll && $news->Export <> "") {
	$news_list->lStopRec = $news_list->lTotalRecs;
} else {
	$news_list->lStopRec = $news_list->lStartRec + $news_list->lDisplayRecs - 1; // Set the last record to display
}
$news_list->lRecCount = $news_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$news->SelectLimit && $news_list->lStartRec > 1)
		$rs->Move($news_list->lStartRec - 1);
}
$news_list->lRowCnt = 0;
while (($news->CurrentAction == "gridadd" || !$rs->EOF) &&
	$news_list->lRecCount < $news_list->lStopRec) {
	$news_list->lRecCount++;
	if (intval($news_list->lRecCount) >= intval($news_list->lStartRec)) {
		$news_list->lRowCnt++;

	// Init row class and style
	$news->CssClass = "";
	$news->CssStyle = "";
	$news->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($news->CurrentAction == "gridadd") {
		$news_list->LoadDefaultValues(); // Load default values
	} else {
		$news_list->LoadRowValues($rs); // Load row values
	}
	$news->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$news_list->RenderRow();
?>
	<tr<?php echo $news->RowAttributes() ?>>
	<?php if ($news->id->Visible) { // id ?>
		<td<?php echo $news->id->CellAttributes() ?>>
<div<?php echo $news->id->ViewAttributes() ?>><?php echo $news->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($news->header->Visible) { // header ?>
		<td<?php echo $news->header->CellAttributes() ?>>
<div<?php echo $news->header->ViewAttributes() ?>><?php echo $news->header->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($news->photo->Visible) { // photo ?>
		<td<?php echo $news->photo->CellAttributes() ?>>
<?php if ($news->photo->HrefValue <> "") { ?>
<?php if (!is_null($news->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $news->photo->Upload->DbValue ?>" border=0<?php echo $news->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($news->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($news->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $news->photo->Upload->DbValue ?>" border=0<?php echo $news->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($news->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($news->insert_date->Visible) { // insert_date ?>
		<td<?php echo $news->insert_date->CellAttributes() ?>>
<div<?php echo $news->insert_date->ViewAttributes() ?>><?php echo $news->insert_date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($news->status->Visible) { // status ?>
		<td<?php echo $news->status->CellAttributes() ?>>
<div<?php echo $news->status->ViewAttributes() ?>><?php echo $news->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($news->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $news->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $news->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $news->DeleteUrl() ?>"><img src='images/delete.gif' alt='Delete' title='Delete' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($news_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($news->CurrentAction <> "gridadd")
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
<?php if ($news_list->lTotalRecs > 0) { ?>
<?php if ($news->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($news->CurrentAction <> "gridadd" && $news->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($news_list->Pager)) $news_list->Pager = new cNumericPager($news_list->lStartRec, $news_list->lDisplayRecs, $news_list->lTotalRecs, $news_list->lRecRange) ?>
<?php if ($news_list->Pager->RecordCount > 0) { ?>
	<?php if ($news_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $news_list->PageUrl() ?>start=<?php echo $news_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($news_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $news_list->PageUrl() ?>start=<?php echo $news_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($news_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $news_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($news_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $news_list->PageUrl() ?>start=<?php echo $news_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($news_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $news_list->PageUrl() ?>start=<?php echo $news_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($news_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $news_list->Pager->FromIndex ?> to <?php echo $news_list->Pager->ToIndex ?> of <?php echo $news_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($news_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($news_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $news->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($news->Export == "" && $news->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(news_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($news->Export == "") { ?>
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
class cnews_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'news';

	// Page Object Name
	var $PageObjName = 'news_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $news;
		if ($news->UseTokenInUrl) $PageUrl .= "t=" . $news->TableVar . "&"; // add page token
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
		global $objForm, $news;
		if ($news->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($news->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($news->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cnews_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["news"] = new cnews();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'news', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $news;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$news->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $news->Export; // Get export parameter, used in header
	$gsExportFile = $news->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $news;
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

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($news->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $news->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "($this->sSrchWhere) AND ($sSrchAdvanced)" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "($this->sSrchWhere) AND ($sSrchBasic)" : $sSrchBasic;

		// Call Recordset_Searching event
		$news->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$news->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$news->setStartRecordNumber($this->lStartRec);
		} else {
			$this->RestoreSearchParms();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in Session
		$news->setSessionWhere($sFilter);
		$news->CurrentFilter = "";
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $news;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $news->header->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $news->photo->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $news->short_desc->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $news->full_desc->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $news;
		$sSearchStr = "";
		$sSearchKeyword = ew_StripSlashes(@$_GET[EW_TABLE_BASIC_SEARCH]);
		$sSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$news->setBasicSearchKeyword($sSearchKeyword);
			$news->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $news;
		$this->sSrchWhere = "";
		$news->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $news;
		$news->setBasicSearchKeyword("");
		$news->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $news;
		$this->sSrchWhere = $news->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $news;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$news->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$news->CurrentOrderType = @$_GET["ordertype"];
			$news->UpdateSort($news->id); // Field 
			$news->UpdateSort($news->header); // Field 
			$news->UpdateSort($news->photo); // Field 
			$news->UpdateSort($news->insert_date); // Field 
			$news->UpdateSort($news->status); // Field 
			$news->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $news;
		$sOrderBy = $news->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($news->SqlOrderBy() <> "") {
				$sOrderBy = $news->SqlOrderBy();
				$news->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $news;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$news->setSessionOrderBy($sOrderBy);
				$news->id->setSort("");
				$news->header->setSort("");
				$news->photo->setSort("");
				$news->insert_date->setSort("");
				$news->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$news->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $news;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$news->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$news->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $news->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$news->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$news->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$news->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $news;

		// Call Recordset Selecting event
		$news->Recordset_Selecting($news->CurrentFilter);

		// Load list page SQL
		$sSql = $news->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$news->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $news;
		$sFilter = $news->KeyFilter();

		// Call Row Selecting event
		$news->Row_Selecting($sFilter);

		// Load sql based on filter
		$news->CurrentFilter = $sFilter;
		$sSql = $news->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$news->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $news;
		$news->id->setDbValue($rs->fields('id'));
		$news->header->setDbValue($rs->fields('header'));
		$news->photo->Upload->DbValue = $rs->fields('photo');
		$news->short_desc->setDbValue($rs->fields('short_desc'));
		$news->full_desc->setDbValue($rs->fields('full_desc'));
		$news->insert_date->setDbValue($rs->fields('insert_date'));
		$news->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $news;

		// Call Row_Rendering event
		$news->Row_Rendering();

		// Common render codes for all row types
		// id

		$news->id->CellCssStyle = "";
		$news->id->CellCssClass = "";

		// header
		$news->header->CellCssStyle = "";
		$news->header->CellCssClass = "";

		// photo
		$news->photo->CellCssStyle = "";
		$news->photo->CellCssClass = "";

		// insert_date
		$news->insert_date->CellCssStyle = "";
		$news->insert_date->CellCssClass = "";

		// status
		$news->status->CellCssStyle = "";
		$news->status->CellCssClass = "";
		if ($news->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$news->id->ViewValue = $news->id->CurrentValue;
			$news->id->CssStyle = "";
			$news->id->CssClass = "";
			$news->id->ViewCustomAttributes = "";

			// header
			$news->header->ViewValue = $news->header->CurrentValue;
			$news->header->ViewValue = ew_Highlight($news->HighlightName(), $news->header->ViewValue, $news->getBasicSearchKeyword(), $news->getBasicSearchType(), "");
			$news->header->CssStyle = "";
			$news->header->CssClass = "";
			$news->header->ViewCustomAttributes = "";

			// photo
			if (!is_null($news->photo->Upload->DbValue)) {
				$news->photo->ViewValue = $news->photo->Upload->DbValue;
				$news->photo->ImageWidth = 100;
				$news->photo->ImageHeight = 0;
				$news->photo->ImageAlt = "";
			} else {
				$news->photo->ViewValue = "";
			}
			$news->photo->CssStyle = "";
			$news->photo->CssClass = "";
			$news->photo->ViewCustomAttributes = "";

			// insert_date
			$news->insert_date->ViewValue = $news->insert_date->CurrentValue;
			$news->insert_date->ViewValue = ew_FormatDateTime($news->insert_date->ViewValue, 5);
			$news->insert_date->CssStyle = "";
			$news->insert_date->CssClass = "";
			$news->insert_date->ViewCustomAttributes = "";

			// status
			if (strval($news->status->CurrentValue) <> "") {
				switch ($news->status->CurrentValue) {
					case "1":
						$news->status->ViewValue = "Active";
						break;
					case "2":
						$news->status->ViewValue = "Not Active";
						break;
					default:
						$news->status->ViewValue = $news->status->CurrentValue;
				}
			} else {
				$news->status->ViewValue = NULL;
			}
			$news->status->CssStyle = "";
			$news->status->CssClass = "";
			$news->status->ViewCustomAttributes = "";

			// id
			$news->id->HrefValue = "";

			// header
			$news->header->HrefValue = "";

			// photo
			$news->photo->HrefValue = "";

			// insert_date
			$news->insert_date->HrefValue = "";

			// status
			$news->status->HrefValue = "";
		}

		// Call Row Rendered event
		$news->Row_Rendered();
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
