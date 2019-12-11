<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "contact_usinfo.php" ?>
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
$contact_us_list = new ccontact_us_list();
$Page =& $contact_us_list;

// Page init processing
$contact_us_list->Page_Init();

// Page main processing
$contact_us_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($contact_us->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var contact_us_list = new ew_Page("contact_us_list");

// page properties
contact_us_list.PageID = "list"; // page ID
var EW_PAGE_ID = contact_us_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
contact_us_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
contact_us_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
contact_us_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
contact_us_list.ShowHighlightText = "Show highlight"; 
contact_us_list.HideHighlightText = "Hide highlight";

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
<?php if ($contact_us->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($contact_us->Export == "" && $contact_us->SelectLimit);
	if (!$bSelectLimit)
		$rs = $contact_us_list->LoadRecordset();
	$contact_us_list->lTotalRecs = ($bSelectLimit) ? $contact_us->SelectRecordCount() : $rs->RecordCount();
	$contact_us_list->lStartRec = 1;
	if ($contact_us_list->lDisplayRecs <= 0) // Display all records
		$contact_us_list->lDisplayRecs = $contact_us_list->lTotalRecs;
	if (!($contact_us->ExportAll && $contact_us->Export <> ""))
		$contact_us_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $contact_us_list->LoadRecordset($contact_us_list->lStartRec-1, $contact_us_list->lDisplayRecs);
?>
<div align="center" class="msm_h1">TABLE: Contact Us</div>
<p><span class="phpmaker" style="white-space: nowrap;">
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($contact_us->Export == "" && $contact_us->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(contact_us_list);" style="text-decoration: none;"><img id="contact_us_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="contact_us_list_SearchPanel">
<form name="fcontact_uslistsrch" id="fcontact_uslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="contact_us">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($contact_us->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<a href="<?php echo $contact_us_list->PageUrl() ?>cmd=reset">Show all</a>&nbsp;
			<?php if ($contact_us_list->sSrchWhere <> "" && $contact_us_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(contact_us_list, this, '<?php echo $contact_us->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($contact_us->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Exact phrase</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($contact_us->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>All words</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($contact_us->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Any word</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $contact_us_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($contact_us->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($contact_us->CurrentAction <> "gridadd" && $contact_us->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($contact_us_list->Pager)) $contact_us_list->Pager = new cNumericPager($contact_us_list->lStartRec, $contact_us_list->lDisplayRecs, $contact_us_list->lTotalRecs, $contact_us_list->lRecRange) ?>
<?php if ($contact_us_list->Pager->RecordCount > 0) { ?>
	<?php if ($contact_us_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $contact_us_list->PageUrl() ?>start=<?php echo $contact_us_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($contact_us_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $contact_us_list->PageUrl() ?>start=<?php echo $contact_us_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($contact_us_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $contact_us_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($contact_us_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $contact_us_list->PageUrl() ?>start=<?php echo $contact_us_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($contact_us_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $contact_us_list->PageUrl() ?>start=<?php echo $contact_us_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($contact_us_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $contact_us_list->Pager->FromIndex ?> to <?php echo $contact_us_list->Pager->ToIndex ?> of <?php echo $contact_us_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($contact_us_list->sSrchWhere == "0=101") { ?>
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
<form name="fcontact_uslist" id="fcontact_uslist" class="ewForm" action="" method="post">
<?php if ($contact_us_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$contact_us_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$contact_us_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$contact_us_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$contact_us_list->lOptionCnt++; // Delete
}
	$contact_us_list->lOptionCnt += count($contact_us_list->ListOptions->Items); // Custom list options
?>
<?php echo $contact_us->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($contact_us->id->Visible) { // id ?>
	<?php if ($contact_us->SortUrl($contact_us->id) == "") { ?>
		<td>Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $contact_us->SortUrl($contact_us->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($contact_us->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($contact_us->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($contact_us->name->Visible) { // name ?>
	<?php if ($contact_us->SortUrl($contact_us->name) == "") { ?>
		<td>Name</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $contact_us->SortUrl($contact_us->name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Name&nbsp;(*)</td><td style="width: 10px;"><?php if ($contact_us->name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($contact_us->name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($contact_us->email->Visible) { // email ?>
	<?php if ($contact_us->SortUrl($contact_us->email) == "") { ?>
		<td>Email</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $contact_us->SortUrl($contact_us->email) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Email&nbsp;(*)</td><td style="width: 10px;"><?php if ($contact_us->email->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($contact_us->email->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($contact_us->phone->Visible) { // phone ?>
	<?php if ($contact_us->SortUrl($contact_us->phone) == "") { ?>
		<td>Phone</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $contact_us->SortUrl($contact_us->phone) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Phone&nbsp;(*)</td><td style="width: 10px;"><?php if ($contact_us->phone->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($contact_us->phone->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($contact_us->subject->Visible) { // subject ?>
	<?php if ($contact_us->SortUrl($contact_us->subject) == "") { ?>
		<td>Subject</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $contact_us->SortUrl($contact_us->subject) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Subject&nbsp;(*)</td><td style="width: 10px;"><?php if ($contact_us->subject->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($contact_us->subject->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($contact_us->receive_date->Visible) { // receive_date ?>
	<?php if ($contact_us->SortUrl($contact_us->receive_date) == "") { ?>
		<td>Receive Date</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $contact_us->SortUrl($contact_us->receive_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Receive Date</td><td style="width: 10px;"><?php if ($contact_us->receive_date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($contact_us->receive_date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($contact_us->Export == "") { ?>
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
foreach ($contact_us_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($contact_us->ExportAll && $contact_us->Export <> "") {
	$contact_us_list->lStopRec = $contact_us_list->lTotalRecs;
} else {
	$contact_us_list->lStopRec = $contact_us_list->lStartRec + $contact_us_list->lDisplayRecs - 1; // Set the last record to display
}
$contact_us_list->lRecCount = $contact_us_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$contact_us->SelectLimit && $contact_us_list->lStartRec > 1)
		$rs->Move($contact_us_list->lStartRec - 1);
}
$contact_us_list->lRowCnt = 0;
while (($contact_us->CurrentAction == "gridadd" || !$rs->EOF) &&
	$contact_us_list->lRecCount < $contact_us_list->lStopRec) {
	$contact_us_list->lRecCount++;
	if (intval($contact_us_list->lRecCount) >= intval($contact_us_list->lStartRec)) {
		$contact_us_list->lRowCnt++;

	// Init row class and style
	$contact_us->CssClass = "";
	$contact_us->CssStyle = "";
	$contact_us->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($contact_us->CurrentAction == "gridadd") {
		$contact_us_list->LoadDefaultValues(); // Load default values
	} else {
		$contact_us_list->LoadRowValues($rs); // Load row values
	}
	$contact_us->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$contact_us_list->RenderRow();
?>
	<tr<?php echo $contact_us->RowAttributes() ?>>
	<?php if ($contact_us->id->Visible) { // id ?>
		<td<?php echo $contact_us->id->CellAttributes() ?>>
<div<?php echo $contact_us->id->ViewAttributes() ?>><?php echo $contact_us->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($contact_us->name->Visible) { // name ?>
		<td<?php echo $contact_us->name->CellAttributes() ?>>
<div<?php echo $contact_us->name->ViewAttributes() ?>><?php echo $contact_us->name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($contact_us->email->Visible) { // email ?>
		<td<?php echo $contact_us->email->CellAttributes() ?>>
<div<?php echo $contact_us->email->ViewAttributes() ?>><?php echo $contact_us->email->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($contact_us->phone->Visible) { // phone ?>
		<td<?php echo $contact_us->phone->CellAttributes() ?>>
<div<?php echo $contact_us->phone->ViewAttributes() ?>><?php echo $contact_us->phone->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($contact_us->subject->Visible) { // subject ?>
		<td<?php echo $contact_us->subject->CellAttributes() ?>>
<div<?php echo $contact_us->subject->ViewAttributes() ?>><?php echo $contact_us->subject->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($contact_us->receive_date->Visible) { // receive_date ?>
		<td<?php echo $contact_us->receive_date->CellAttributes() ?>>
<div<?php echo $contact_us->receive_date->ViewAttributes() ?>><?php echo $contact_us->receive_date->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($contact_us->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $contact_us->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $contact_us->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $contact_us->DeleteUrl() ?>"><img src='images/delete.gif' alt='Delete' title='Delete' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($contact_us_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($contact_us->CurrentAction <> "gridadd")
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
<?php if ($contact_us_list->lTotalRecs > 0) { ?>
<?php if ($contact_us->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($contact_us->CurrentAction <> "gridadd" && $contact_us->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($contact_us_list->Pager)) $contact_us_list->Pager = new cNumericPager($contact_us_list->lStartRec, $contact_us_list->lDisplayRecs, $contact_us_list->lTotalRecs, $contact_us_list->lRecRange) ?>
<?php if ($contact_us_list->Pager->RecordCount > 0) { ?>
	<?php if ($contact_us_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $contact_us_list->PageUrl() ?>start=<?php echo $contact_us_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($contact_us_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $contact_us_list->PageUrl() ?>start=<?php echo $contact_us_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($contact_us_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $contact_us_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($contact_us_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $contact_us_list->PageUrl() ?>start=<?php echo $contact_us_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($contact_us_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $contact_us_list->PageUrl() ?>start=<?php echo $contact_us_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($contact_us_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $contact_us_list->Pager->FromIndex ?> to <?php echo $contact_us_list->Pager->ToIndex ?> of <?php echo $contact_us_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($contact_us_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($contact_us_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($contact_us->Export == "" && $contact_us->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(contact_us_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($contact_us->Export == "") { ?>
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
class ccontact_us_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'contact_us';

	// Page Object Name
	var $PageObjName = 'contact_us_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $contact_us;
		if ($contact_us->UseTokenInUrl) $PageUrl .= "t=" . $contact_us->TableVar . "&"; // add page token
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
		global $objForm, $contact_us;
		if ($contact_us->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($contact_us->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($contact_us->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccontact_us_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["contact_us"] = new ccontact_us();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'contact_us', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $contact_us;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$contact_us->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $contact_us->Export; // Get export parameter, used in header
	$gsExportFile = $contact_us->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $contact_us;
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
		if ($contact_us->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $contact_us->getRecordsPerPage(); // Restore from Session
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
		$contact_us->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$contact_us->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$contact_us->setStartRecordNumber($this->lStartRec);
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
		$contact_us->setSessionWhere($sFilter);
		$contact_us->CurrentFilter = "";
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $contact_us;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $contact_us->name->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $contact_us->email->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $contact_us->phone->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $contact_us->subject->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $contact_us->message->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $contact_us;
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
			$contact_us->setBasicSearchKeyword($sSearchKeyword);
			$contact_us->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $contact_us;
		$this->sSrchWhere = "";
		$contact_us->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $contact_us;
		$contact_us->setBasicSearchKeyword("");
		$contact_us->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $contact_us;
		$this->sSrchWhere = $contact_us->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $contact_us;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$contact_us->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$contact_us->CurrentOrderType = @$_GET["ordertype"];
			$contact_us->UpdateSort($contact_us->id); // Field 
			$contact_us->UpdateSort($contact_us->name); // Field 
			$contact_us->UpdateSort($contact_us->email); // Field 
			$contact_us->UpdateSort($contact_us->phone); // Field 
			$contact_us->UpdateSort($contact_us->subject); // Field 
			$contact_us->UpdateSort($contact_us->receive_date); // Field 
			$contact_us->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $contact_us;
		$sOrderBy = $contact_us->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($contact_us->SqlOrderBy() <> "") {
				$sOrderBy = $contact_us->SqlOrderBy();
				$contact_us->setSessionOrderBy($sOrderBy);
				$contact_us->receive_date->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $contact_us;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$contact_us->setSessionOrderBy($sOrderBy);
				$contact_us->id->setSort("");
				$contact_us->name->setSort("");
				$contact_us->email->setSort("");
				$contact_us->phone->setSort("");
				$contact_us->subject->setSort("");
				$contact_us->receive_date->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$contact_us->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $contact_us;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$contact_us->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$contact_us->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $contact_us->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$contact_us->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$contact_us->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$contact_us->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $contact_us;

		// Call Recordset Selecting event
		$contact_us->Recordset_Selecting($contact_us->CurrentFilter);

		// Load list page SQL
		$sSql = $contact_us->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$contact_us->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $contact_us;
		$sFilter = $contact_us->KeyFilter();

		// Call Row Selecting event
		$contact_us->Row_Selecting($sFilter);

		// Load sql based on filter
		$contact_us->CurrentFilter = $sFilter;
		$sSql = $contact_us->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$contact_us->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $contact_us;
		$contact_us->id->setDbValue($rs->fields('id'));
		$contact_us->name->setDbValue($rs->fields('name'));
		$contact_us->email->setDbValue($rs->fields('email'));
		$contact_us->phone->setDbValue($rs->fields('phone'));
		$contact_us->subject->setDbValue($rs->fields('subject'));
		$contact_us->message->setDbValue($rs->fields('message'));
		$contact_us->receive_date->setDbValue($rs->fields('receive_date'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $contact_us;

		// Call Row_Rendering event
		$contact_us->Row_Rendering();

		// Common render codes for all row types
		// id

		$contact_us->id->CellCssStyle = "";
		$contact_us->id->CellCssClass = "";

		// name
		$contact_us->name->CellCssStyle = "";
		$contact_us->name->CellCssClass = "";

		// email
		$contact_us->email->CellCssStyle = "";
		$contact_us->email->CellCssClass = "";

		// phone
		$contact_us->phone->CellCssStyle = "";
		$contact_us->phone->CellCssClass = "";

		// subject
		$contact_us->subject->CellCssStyle = "";
		$contact_us->subject->CellCssClass = "";

		// receive_date
		$contact_us->receive_date->CellCssStyle = "";
		$contact_us->receive_date->CellCssClass = "";
		if ($contact_us->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$contact_us->id->ViewValue = $contact_us->id->CurrentValue;
			$contact_us->id->CssStyle = "";
			$contact_us->id->CssClass = "";
			$contact_us->id->ViewCustomAttributes = "";

			// name
			$contact_us->name->ViewValue = $contact_us->name->CurrentValue;
			$contact_us->name->ViewValue = ew_Highlight($contact_us->HighlightName(), $contact_us->name->ViewValue, $contact_us->getBasicSearchKeyword(), $contact_us->getBasicSearchType(), "");
			$contact_us->name->CssStyle = "";
			$contact_us->name->CssClass = "";
			$contact_us->name->ViewCustomAttributes = "";

			// email
			$contact_us->email->ViewValue = $contact_us->email->CurrentValue;
			$contact_us->email->ViewValue = ew_Highlight($contact_us->HighlightName(), $contact_us->email->ViewValue, $contact_us->getBasicSearchKeyword(), $contact_us->getBasicSearchType(), "");
			$contact_us->email->CssStyle = "";
			$contact_us->email->CssClass = "";
			$contact_us->email->ViewCustomAttributes = "";

			// phone
			$contact_us->phone->ViewValue = $contact_us->phone->CurrentValue;
			$contact_us->phone->ViewValue = ew_Highlight($contact_us->HighlightName(), $contact_us->phone->ViewValue, $contact_us->getBasicSearchKeyword(), $contact_us->getBasicSearchType(), "");
			$contact_us->phone->CssStyle = "";
			$contact_us->phone->CssClass = "";
			$contact_us->phone->ViewCustomAttributes = "";

			// subject
			$contact_us->subject->ViewValue = $contact_us->subject->CurrentValue;
			$contact_us->subject->ViewValue = ew_Highlight($contact_us->HighlightName(), $contact_us->subject->ViewValue, $contact_us->getBasicSearchKeyword(), $contact_us->getBasicSearchType(), "");
			$contact_us->subject->CssStyle = "";
			$contact_us->subject->CssClass = "";
			$contact_us->subject->ViewCustomAttributes = "";

			// receive_date
			$contact_us->receive_date->ViewValue = $contact_us->receive_date->CurrentValue;
			$contact_us->receive_date->ViewValue = ew_FormatDateTime($contact_us->receive_date->ViewValue, 5);
			$contact_us->receive_date->CssStyle = "";
			$contact_us->receive_date->CssClass = "";
			$contact_us->receive_date->ViewCustomAttributes = "";

			// id
			$contact_us->id->HrefValue = "";

			// name
			$contact_us->name->HrefValue = "";

			// email
			$contact_us->email->HrefValue = "";

			// phone
			$contact_us->phone->HrefValue = "";

			// subject
			$contact_us->subject->HrefValue = "";

			// receive_date
			$contact_us->receive_date->HrefValue = "";
		}

		// Call Row Rendered event
		$contact_us->Row_Rendered();
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
