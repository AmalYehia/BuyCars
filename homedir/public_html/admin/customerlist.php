<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "customerinfo.php" ?>
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
$customer_list = new ccustomer_list();
$Page =& $customer_list;

// Page init processing
$customer_list->Page_Init();

// Page main processing
$customer_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($customer->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var customer_list = new ew_Page("customer_list");

// page properties
customer_list.PageID = "list"; // page ID
var EW_PAGE_ID = customer_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
customer_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
customer_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
customer_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
customer_list.ShowHighlightText = "Show highlight"; 
customer_list.HideHighlightText = "Hide highlight";

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
<?php if ($customer->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($customer->Export == "" && $customer->SelectLimit);
	if (!$bSelectLimit)
		$rs = $customer_list->LoadRecordset();
	$customer_list->lTotalRecs = ($bSelectLimit) ? $customer->SelectRecordCount() : $rs->RecordCount();
	$customer_list->lStartRec = 1;
	if ($customer_list->lDisplayRecs <= 0) // Display all records
		$customer_list->lDisplayRecs = $customer_list->lTotalRecs;
	if (!($customer->ExportAll && $customer->Export <> ""))
		$customer_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $customer_list->LoadRecordset($customer_list->lStartRec-1, $customer_list->lDisplayRecs);
?>
<div align="center" class="msm_h1">TABLE: Customer</div>
<p><span class="phpmaker" style="white-space: nowrap;">
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($customer->Export == "" && $customer->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(customer_list);" style="text-decoration: none;"><img id="customer_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="customer_list_SearchPanel">
<form name="fcustomerlistsrch" id="fcustomerlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="customer">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($customer->getBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<a href="<?php echo $customer_list->PageUrl() ?>cmd=reset">Show all</a>&nbsp;
			<?php if ($customer_list->sSrchWhere <> "" && $customer_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(customer_list, this, '<?php echo $customer->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($customer->getBasicSearchType() == "") { ?> checked="checked"<?php } ?>>Exact phrase</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($customer->getBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>>All words</label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($customer->getBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>>Any word</label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php $customer_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($customer->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($customer->CurrentAction <> "gridadd" && $customer->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($customer_list->Pager)) $customer_list->Pager = new cNumericPager($customer_list->lStartRec, $customer_list->lDisplayRecs, $customer_list->lTotalRecs, $customer_list->lRecRange) ?>
<?php if ($customer_list->Pager->RecordCount > 0) { ?>
	<?php if ($customer_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $customer_list->PageUrl() ?>start=<?php echo $customer_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($customer_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $customer_list->PageUrl() ?>start=<?php echo $customer_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($customer_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $customer_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($customer_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $customer_list->PageUrl() ?>start=<?php echo $customer_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($customer_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $customer_list->PageUrl() ?>start=<?php echo $customer_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($customer_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $customer_list->Pager->FromIndex ?> to <?php echo $customer_list->Pager->ToIndex ?> of <?php echo $customer_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($customer_list->sSrchWhere == "0=101") { ?>
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
<a href="<?php echo $customer->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fcustomerlist" id="fcustomerlist" class="ewForm" action="" method="post">
<?php if ($customer_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$customer_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$customer_list->lOptionCnt++; // view
}
if ($Security->IsLoggedIn()) {
	$customer_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$customer_list->lOptionCnt++; // Delete
}
	$customer_list->lOptionCnt += count($customer_list->ListOptions->Items); // Custom list options
?>
<?php echo $customer->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($customer->id->Visible) { // id ?>
	<?php if ($customer->SortUrl($customer->id) == "") { ?>
		<td>Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customer->SortUrl($customer->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($customer->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customer->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($customer->user_name->Visible) { // user_name ?>
	<?php if ($customer->SortUrl($customer->user_name) == "") { ?>
		<td>User Name</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customer->SortUrl($customer->user_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>User Name&nbsp;(*)</td><td style="width: 10px;"><?php if ($customer->user_name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customer->user_name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($customer->password->Visible) { // password ?>
	<?php if ($customer->SortUrl($customer->password) == "") { ?>
		<td>Password</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customer->SortUrl($customer->password) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Password&nbsp;(*)</td><td style="width: 10px;"><?php if ($customer->password->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customer->password->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($customer->name->Visible) { // name ?>
	<?php if ($customer->SortUrl($customer->name) == "") { ?>
		<td>Name</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customer->SortUrl($customer->name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Name&nbsp;(*)</td><td style="width: 10px;"><?php if ($customer->name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customer->name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($customer->email->Visible) { // email ?>
	<?php if ($customer->SortUrl($customer->email) == "") { ?>
		<td>Email</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customer->SortUrl($customer->email) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Email&nbsp;(*)</td><td style="width: 10px;"><?php if ($customer->email->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customer->email->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($customer->mobile->Visible) { // mobile ?>
	<?php if ($customer->SortUrl($customer->mobile) == "") { ?>
		<td>Mobile</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customer->SortUrl($customer->mobile) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Mobile&nbsp;(*)</td><td style="width: 10px;"><?php if ($customer->mobile->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customer->mobile->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($customer->country->Visible) { // country ?>
	<?php if ($customer->SortUrl($customer->country) == "") { ?>
		<td>Country</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customer->SortUrl($customer->country) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Country</td><td style="width: 10px;"><?php if ($customer->country->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customer->country->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($customer->date_lastlogin->Visible) { // date_lastlogin ?>
	<?php if ($customer->SortUrl($customer->date_lastlogin) == "") { ?>
		<td>Date Lastlogin</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customer->SortUrl($customer->date_lastlogin) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Date Lastlogin</td><td style="width: 10px;"><?php if ($customer->date_lastlogin->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customer->date_lastlogin->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($customer->date_register->Visible) { // date_register ?>
	<?php if ($customer->SortUrl($customer->date_register) == "") { ?>
		<td>Date Register</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customer->SortUrl($customer->date_register) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Date Register</td><td style="width: 10px;"><?php if ($customer->date_register->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customer->date_register->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($customer->status->Visible) { // status ?>
	<?php if ($customer->SortUrl($customer->status) == "") { ?>
		<td>Status</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $customer->SortUrl($customer->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Status</td><td style="width: 10px;"><?php if ($customer->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($customer->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($customer->Export == "") { ?>
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
foreach ($customer_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
if ($customer->ExportAll && $customer->Export <> "") {
	$customer_list->lStopRec = $customer_list->lTotalRecs;
} else {
	$customer_list->lStopRec = $customer_list->lStartRec + $customer_list->lDisplayRecs - 1; // Set the last record to display
}
$customer_list->lRecCount = $customer_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$customer->SelectLimit && $customer_list->lStartRec > 1)
		$rs->Move($customer_list->lStartRec - 1);
}
$customer_list->lRowCnt = 0;
while (($customer->CurrentAction == "gridadd" || !$rs->EOF) &&
	$customer_list->lRecCount < $customer_list->lStopRec) {
	$customer_list->lRecCount++;
	if (intval($customer_list->lRecCount) >= intval($customer_list->lStartRec)) {
		$customer_list->lRowCnt++;

	// Init row class and style
	$customer->CssClass = "";
	$customer->CssStyle = "";
	$customer->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($customer->CurrentAction == "gridadd") {
		$customer_list->LoadDefaultValues(); // Load default values
	} else {
		$customer_list->LoadRowValues($rs); // Load row values
	}
	$customer->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$customer_list->RenderRow();
?>
	<tr<?php echo $customer->RowAttributes() ?>>
	<?php if ($customer->id->Visible) { // id ?>
		<td<?php echo $customer->id->CellAttributes() ?>>
<div<?php echo $customer->id->ViewAttributes() ?>><?php echo $customer->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customer->user_name->Visible) { // user_name ?>
		<td<?php echo $customer->user_name->CellAttributes() ?>>
<div<?php echo $customer->user_name->ViewAttributes() ?>><?php echo $customer->user_name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customer->password->Visible) { // password ?>
		<td<?php echo $customer->password->CellAttributes() ?>>
<div<?php echo $customer->password->ViewAttributes() ?>><?php echo $customer->password->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customer->name->Visible) { // name ?>
		<td<?php echo $customer->name->CellAttributes() ?>>
<div<?php echo $customer->name->ViewAttributes() ?>><?php echo $customer->name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customer->email->Visible) { // email ?>
		<td<?php echo $customer->email->CellAttributes() ?>>
<div<?php echo $customer->email->ViewAttributes() ?>><?php echo $customer->email->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customer->mobile->Visible) { // mobile ?>
		<td<?php echo $customer->mobile->CellAttributes() ?>>
<div<?php echo $customer->mobile->ViewAttributes() ?>><?php echo $customer->mobile->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customer->country->Visible) { // country ?>
		<td<?php echo $customer->country->CellAttributes() ?>>
<div<?php echo $customer->country->ViewAttributes() ?>><?php echo $customer->country->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customer->date_lastlogin->Visible) { // date_lastlogin ?>
		<td<?php echo $customer->date_lastlogin->CellAttributes() ?>>
<div<?php echo $customer->date_lastlogin->ViewAttributes() ?>><?php echo $customer->date_lastlogin->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customer->date_register->Visible) { // date_register ?>
		<td<?php echo $customer->date_register->CellAttributes() ?>>
<div<?php echo $customer->date_register->ViewAttributes() ?>><?php echo $customer->date_register->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($customer->status->Visible) { // status ?>
		<td<?php echo $customer->status->CellAttributes() ?>>
<div<?php echo $customer->status->ViewAttributes() ?>><?php echo $customer->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php if ($customer->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $customer->ViewUrl() ?>"><img src='images/view.gif' alt='View' title='View' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $customer->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $customer->DeleteUrl() ?>"><img src='images/delete.gif' alt='Delete' title='Delete' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($customer_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	</tr>
<?php
	}
	if ($customer->CurrentAction <> "gridadd")
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
<?php if ($customer_list->lTotalRecs > 0) { ?>
<?php if ($customer->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($customer->CurrentAction <> "gridadd" && $customer->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($customer_list->Pager)) $customer_list->Pager = new cNumericPager($customer_list->lStartRec, $customer_list->lDisplayRecs, $customer_list->lTotalRecs, $customer_list->lRecRange) ?>
<?php if ($customer_list->Pager->RecordCount > 0) { ?>
	<?php if ($customer_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $customer_list->PageUrl() ?>start=<?php echo $customer_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($customer_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $customer_list->PageUrl() ?>start=<?php echo $customer_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($customer_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $customer_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($customer_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $customer_list->PageUrl() ?>start=<?php echo $customer_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($customer_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $customer_list->PageUrl() ?>start=<?php echo $customer_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($customer_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $customer_list->Pager->FromIndex ?> to <?php echo $customer_list->Pager->ToIndex ?> of <?php echo $customer_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($customer_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($customer_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $customer->AddUrl() ?>">Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($customer->Export == "" && $customer->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(customer_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($customer->Export == "") { ?>
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
class ccustomer_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'customer';

	// Page Object Name
	var $PageObjName = 'customer_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $customer;
		if ($customer->UseTokenInUrl) $PageUrl .= "t=" . $customer->TableVar . "&"; // add page token
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
		global $objForm, $customer;
		if ($customer->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($customer->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($customer->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccustomer_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["customer"] = new ccustomer();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'customer', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $customer;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$customer->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $customer->Export; // Get export parameter, used in header
	$gsExportFile = $customer->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $customer;
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
		if ($customer->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $customer->getRecordsPerPage(); // Restore from Session
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
		$customer->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$customer->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$customer->setStartRecordNumber($this->lStartRec);
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
		$customer->setSessionWhere($sFilter);
		$customer->CurrentFilter = "";
	}

	// Return Basic Search sql
	function BasicSearchSQL($Keyword) {
		global $customer;
		$sKeyword = ew_AdjustSql($Keyword);
		$sql = "";
		$sql .= $customer->user_name->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $customer->password->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $customer->name->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $customer->email->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $customer->phone->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $customer->mobile->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		$sql .= $customer->address->FldExpression . " LIKE '%" . $sKeyword . "%' OR ";
		if (substr($sql, -4) == " OR ") $sql = substr($sql, 0, strlen($sql)-4);
		return $sql;
	}

	// Return Basic Search Where based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $customer;
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
			$customer->setBasicSearchKeyword($sSearchKeyword);
			$customer->setBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $customer;
		$this->sSrchWhere = "";
		$customer->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {

		// Clear basic search parameters
		global $customer;
		$customer->setBasicSearchKeyword("");
		$customer->setBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $customer;
		$this->sSrchWhere = $customer->getSearchWhere();
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $customer;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$customer->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$customer->CurrentOrderType = @$_GET["ordertype"];
			$customer->UpdateSort($customer->id); // Field 
			$customer->UpdateSort($customer->user_name); // Field 
			$customer->UpdateSort($customer->password); // Field 
			$customer->UpdateSort($customer->name); // Field 
			$customer->UpdateSort($customer->email); // Field 
			$customer->UpdateSort($customer->mobile); // Field 
			$customer->UpdateSort($customer->country); // Field 
			$customer->UpdateSort($customer->date_lastlogin); // Field 
			$customer->UpdateSort($customer->date_register); // Field 
			$customer->UpdateSort($customer->status); // Field 
			$customer->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $customer;
		$sOrderBy = $customer->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($customer->SqlOrderBy() <> "") {
				$sOrderBy = $customer->SqlOrderBy();
				$customer->setSessionOrderBy($sOrderBy);
				$customer->date_register->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $customer;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$customer->setSessionOrderBy($sOrderBy);
				$customer->id->setSort("");
				$customer->user_name->setSort("");
				$customer->password->setSort("");
				$customer->name->setSort("");
				$customer->email->setSort("");
				$customer->mobile->setSort("");
				$customer->country->setSort("");
				$customer->date_lastlogin->setSort("");
				$customer->date_register->setSort("");
				$customer->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$customer->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $customer;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$customer->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$customer->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $customer->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$customer->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$customer->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$customer->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $customer;

		// Call Recordset Selecting event
		$customer->Recordset_Selecting($customer->CurrentFilter);

		// Load list page SQL
		$sSql = $customer->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$customer->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $customer;
		$sFilter = $customer->KeyFilter();

		// Call Row Selecting event
		$customer->Row_Selecting($sFilter);

		// Load sql based on filter
		$customer->CurrentFilter = $sFilter;
		$sSql = $customer->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$customer->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $customer;
		$customer->id->setDbValue($rs->fields('id'));
		$customer->user_name->setDbValue($rs->fields('user_name'));
		$customer->password->setDbValue($rs->fields('password'));
		$customer->name->setDbValue($rs->fields('name'));
		$customer->email->setDbValue($rs->fields('email'));
		$customer->phone->setDbValue($rs->fields('phone'));
		$customer->mobile->setDbValue($rs->fields('mobile'));
		$customer->country->setDbValue($rs->fields('country'));
		$customer->address->setDbValue($rs->fields('address'));
		$customer->date_lastlogin->setDbValue($rs->fields('date_lastlogin'));
		$customer->date_register->setDbValue($rs->fields('date_register'));
		$customer->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $customer;

		// Call Row_Rendering event
		$customer->Row_Rendering();

		// Common render codes for all row types
		// id

		$customer->id->CellCssStyle = "";
		$customer->id->CellCssClass = "";

		// user_name
		$customer->user_name->CellCssStyle = "";
		$customer->user_name->CellCssClass = "";

		// password
		$customer->password->CellCssStyle = "";
		$customer->password->CellCssClass = "";

		// name
		$customer->name->CellCssStyle = "";
		$customer->name->CellCssClass = "";

		// email
		$customer->email->CellCssStyle = "";
		$customer->email->CellCssClass = "";

		// mobile
		$customer->mobile->CellCssStyle = "";
		$customer->mobile->CellCssClass = "";

		// country
		$customer->country->CellCssStyle = "";
		$customer->country->CellCssClass = "";

		// date_lastlogin
		$customer->date_lastlogin->CellCssStyle = "";
		$customer->date_lastlogin->CellCssClass = "";

		// date_register
		$customer->date_register->CellCssStyle = "";
		$customer->date_register->CellCssClass = "";

		// status
		$customer->status->CellCssStyle = "";
		$customer->status->CellCssClass = "";
		if ($customer->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$customer->id->ViewValue = $customer->id->CurrentValue;
			$customer->id->CssStyle = "";
			$customer->id->CssClass = "";
			$customer->id->ViewCustomAttributes = "";

			// user_name
			$customer->user_name->ViewValue = $customer->user_name->CurrentValue;
			$customer->user_name->ViewValue = ew_Highlight($customer->HighlightName(), $customer->user_name->ViewValue, $customer->getBasicSearchKeyword(), $customer->getBasicSearchType(), "");
			$customer->user_name->CssStyle = "";
			$customer->user_name->CssClass = "";
			$customer->user_name->ViewCustomAttributes = "";

			// password
			$customer->password->ViewValue = $customer->password->CurrentValue;
			$customer->password->ViewValue = ew_Highlight($customer->HighlightName(), $customer->password->ViewValue, $customer->getBasicSearchKeyword(), $customer->getBasicSearchType(), "");
			$customer->password->CssStyle = "";
			$customer->password->CssClass = "";
			$customer->password->ViewCustomAttributes = "";

			// name
			$customer->name->ViewValue = $customer->name->CurrentValue;
			$customer->name->ViewValue = ew_Highlight($customer->HighlightName(), $customer->name->ViewValue, $customer->getBasicSearchKeyword(), $customer->getBasicSearchType(), "");
			$customer->name->CssStyle = "";
			$customer->name->CssClass = "";
			$customer->name->ViewCustomAttributes = "";

			// email
			$customer->email->ViewValue = $customer->email->CurrentValue;
			$customer->email->ViewValue = ew_Highlight($customer->HighlightName(), $customer->email->ViewValue, $customer->getBasicSearchKeyword(), $customer->getBasicSearchType(), "");
			$customer->email->CssStyle = "";
			$customer->email->CssClass = "";
			$customer->email->ViewCustomAttributes = "";

			// phone
			$customer->phone->ViewValue = $customer->phone->CurrentValue;
			$customer->phone->ViewValue = ew_Highlight($customer->HighlightName(), $customer->phone->ViewValue, $customer->getBasicSearchKeyword(), $customer->getBasicSearchType(), "");
			$customer->phone->CssStyle = "";
			$customer->phone->CssClass = "";
			$customer->phone->ViewCustomAttributes = "";

			// mobile
			$customer->mobile->ViewValue = $customer->mobile->CurrentValue;
			$customer->mobile->ViewValue = ew_Highlight($customer->HighlightName(), $customer->mobile->ViewValue, $customer->getBasicSearchKeyword(), $customer->getBasicSearchType(), "");
			$customer->mobile->CssStyle = "";
			$customer->mobile->CssClass = "";
			$customer->mobile->ViewCustomAttributes = "";

			// country
			$customer->country->ViewValue = $customer->country->CurrentValue;
			$customer->country->CssStyle = "";
			$customer->country->CssClass = "";
			$customer->country->ViewCustomAttributes = "";

			// date_lastlogin
			$customer->date_lastlogin->ViewValue = $customer->date_lastlogin->CurrentValue;
			$customer->date_lastlogin->ViewValue = ew_FormatDateTime($customer->date_lastlogin->ViewValue, 5);
			$customer->date_lastlogin->CssStyle = "";
			$customer->date_lastlogin->CssClass = "";
			$customer->date_lastlogin->ViewCustomAttributes = "";

			// date_register
			$customer->date_register->ViewValue = $customer->date_register->CurrentValue;
			$customer->date_register->ViewValue = ew_FormatDateTime($customer->date_register->ViewValue, 5);
			$customer->date_register->CssStyle = "";
			$customer->date_register->CssClass = "";
			$customer->date_register->ViewCustomAttributes = "";

			// status
			if (strval($customer->status->CurrentValue) <> "") {
				switch ($customer->status->CurrentValue) {
					case "1":
						$customer->status->ViewValue = "Active";
						break;
					case "2":
						$customer->status->ViewValue = "Not Active";
						break;
					default:
						$customer->status->ViewValue = $customer->status->CurrentValue;
				}
			} else {
				$customer->status->ViewValue = NULL;
			}
			$customer->status->CssStyle = "";
			$customer->status->CssClass = "";
			$customer->status->ViewCustomAttributes = "";

			// id
			$customer->id->HrefValue = "";

			// user_name
			$customer->user_name->HrefValue = "";

			// password
			$customer->password->HrefValue = "";

			// name
			$customer->name->HrefValue = "";

			// email
			$customer->email->HrefValue = "";

			// mobile
			$customer->mobile->HrefValue = "";

			// country
			$customer->country->HrefValue = "";

			// date_lastlogin
			$customer->date_lastlogin->HrefValue = "";

			// date_register
			$customer->date_register->HrefValue = "";

			// status
			$customer->status->HrefValue = "";
		}

		// Call Row Rendered event
		$customer->Row_Rendered();
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
