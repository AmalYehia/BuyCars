<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
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
$password_list = new cpassword_list();
$Page =& $password_list;

// Page init processing
$password_list->Page_Init();

// Page main processing
$password_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($password->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var password_list = new ew_Page("password_list");

// page properties
password_list.PageID = "list"; // page ID
var EW_PAGE_ID = password_list.PageID; // for backward compatibility

// extend page with ValidateForm function
password_list.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_user_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - User Name");
		elm = fobj.elements["x" + infix + "_password"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Password");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
password_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
password_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
password_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($password->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($password->Export == "" && $password->SelectLimit);
	if (!$bSelectLimit)
		$rs = $password_list->LoadRecordset();
	$password_list->lTotalRecs = ($bSelectLimit) ? $password->SelectRecordCount() : $rs->RecordCount();
	$password_list->lStartRec = 1;
	if ($password_list->lDisplayRecs <= 0) // Display all records
		$password_list->lDisplayRecs = $password_list->lTotalRecs;
	if (!($password->ExportAll && $password->Export <> ""))
		$password_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $password_list->LoadRecordset($password_list->lStartRec-1, $password_list->lDisplayRecs);
?>
<div align="center" class="msm_h1">TABLE: Password</div>
<p><span class="phpmaker" style="white-space: nowrap;">
</span></p>
<?php $password_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($password->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($password->CurrentAction <> "gridadd" && $password->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($password_list->Pager)) $password_list->Pager = new cNumericPager($password_list->lStartRec, $password_list->lDisplayRecs, $password_list->lTotalRecs, $password_list->lRecRange) ?>
<?php if ($password_list->Pager->RecordCount > 0) { ?>
	<?php if ($password_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $password_list->PageUrl() ?>start=<?php echo $password_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($password_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $password_list->PageUrl() ?>start=<?php echo $password_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($password_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $password_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($password_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $password_list->PageUrl() ?>start=<?php echo $password_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($password_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $password_list->PageUrl() ?>start=<?php echo $password_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($password_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $password_list->Pager->FromIndex ?> to <?php echo $password_list->Pager->ToIndex ?> of <?php echo $password_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($password_list->sSrchWhere == "0=101") { ?>
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
<a href="<?php echo $password_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fpasswordlist" id="fpasswordlist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="password">
<?php if ($password_list->lTotalRecs > 0 || $password->CurrentAction == "add" || $password->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$password_list->lOptionCnt = 0;
if ($Security->IsLoggedIn()) {
	$password_list->lOptionCnt++; // edit
}
if ($Security->IsLoggedIn()) {
	$password_list->lOptionCnt++; // Delete
}
	$password_list->lOptionCnt += count($password_list->ListOptions->Items); // Custom list options
?>
<?php echo $password->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($password->id->Visible) { // id ?>
	<?php if ($password->SortUrl($password->id) == "") { ?>
		<td>Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $password->SortUrl($password->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($password->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($password->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($password->user_name->Visible) { // user_name ?>
	<?php if ($password->SortUrl($password->user_name) == "") { ?>
		<td>User Name</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $password->SortUrl($password->user_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>User Name</td><td style="width: 10px;"><?php if ($password->user_name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($password->user_name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($password->password->Visible) { // password ?>
	<?php if ($password->SortUrl($password->password) == "") { ?>
		<td>Password</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $password->SortUrl($password->password) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Password</td><td style="width: 10px;"><?php if ($password->password->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($password->password->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($password->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($password_list->lOptionCnt == 0 && $password->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php

// Custom list options
foreach ($password_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
	if ($password->CurrentAction == "add" || $password->CurrentAction == "copy") {
		$password_list->lRowIndex = 1;
		if ($password->CurrentAction == "add")
			$password_list->LoadDefaultValues();
		if ($password->EventCancelled) // Insert failed
			$password_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$password->CssClass = "ewTableEditRow";
		$password->CssStyle = "";
		$password->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$password->RowType = EW_ROWTYPE_ADD;

		// Render row
		$password_list->RenderRow();
?>
	<tr<?php echo $password->RowAttributes() ?>>
	<?php if ($password->id->Visible) { // id ?>
		<td>&nbsp;</td>
	<?php } ?>
	<?php if ($password->user_name->Visible) { // user_name ?>
		<td>
<input type="text" name="x<?php echo $password_list->lRowIndex ?>_user_name" id="x<?php echo $password_list->lRowIndex ?>_user_name" size="30" maxlength="200" value="<?php echo $password->user_name->EditValue ?>"<?php echo $password->user_name->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($password->password->Visible) { // password ?>
		<td>
<input type="text" name="x<?php echo $password_list->lRowIndex ?>_password" id="x<?php echo $password_list->lRowIndex ?>_password" size="30" maxlength="200" value="<?php echo $password->password->EditValue ?>"<?php echo $password->password->EditAttributes() ?>>
</td>
	<?php } ?>
<td colspan="<?php echo $password_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (password_list.ValidateForm(document.fpasswordlist)) document.fpasswordlist.submit();return false;"><img src='images/insert.gif' alt='Insert' title='Insert' width='16' height='16' border='0'></a>&nbsp;<a href="<?php echo $password_list->PageUrl() ?>a=cancel"><img src='images/cancel.gif' alt='Cancel' title='Cancel' width='16' height='16' border='0'></a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	</tr>
<?php
}
?>
<?php
if ($password->ExportAll && $password->Export <> "") {
	$password_list->lStopRec = $password_list->lTotalRecs;
} else {
	$password_list->lStopRec = $password_list->lStartRec + $password_list->lDisplayRecs - 1; // Set the last record to display
}
$password_list->lRecCount = $password_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$password->SelectLimit && $password_list->lStartRec > 1)
		$rs->Move($password_list->lStartRec - 1);
}
$password_list->lRowCnt = 0;
$password_list->lEditRowCnt = 0;
if ($password->CurrentAction == "edit")
	$password_list->lRowIndex = 1;
while (($password->CurrentAction == "gridadd" || !$rs->EOF) &&
	$password_list->lRecCount < $password_list->lStopRec) {
	$password_list->lRecCount++;
	if (intval($password_list->lRecCount) >= intval($password_list->lStartRec)) {
		$password_list->lRowCnt++;

	// Init row class and style
	$password->CssClass = "";
	$password->CssStyle = "";
	$password->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($password->CurrentAction == "gridadd") {
		$password_list->LoadDefaultValues(); // Load default values
	} else {
		$password_list->LoadRowValues($rs); // Load row values
	}
	$password->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($password->CurrentAction == "edit") {
		if ($password_list->CheckInlineEditKey() && $password_list->lEditRowCnt == 0) // Inline edit
			$password->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($password->RowType == EW_ROWTYPE_EDIT && $password->EventCancelled) { // Update failed
		if ($password->CurrentAction == "edit")
			$password_list->RestoreFormValues(); // Restore form values
	}
	if ($password->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$password_list->lEditRowCnt++;
		$password->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($password->RowType == EW_ROWTYPE_ADD || $password->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$password->CssClass = "ewTableEditRow";

	// Render row
	$password_list->RenderRow();
?>
	<tr<?php echo $password->RowAttributes() ?>>
	<?php if ($password->id->Visible) { // id ?>
		<td<?php echo $password->id->CellAttributes() ?>>
<?php if ($password->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $password->id->ViewAttributes() ?>><?php echo $password->id->EditValue ?></div><input type="hidden" name="x<?php echo $password_list->lRowIndex ?>_id" id="x<?php echo $password_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($password->id->CurrentValue) ?>">
<?php } ?>
<?php if ($password->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $password->id->ViewAttributes() ?>><?php echo $password->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($password->user_name->Visible) { // user_name ?>
		<td<?php echo $password->user_name->CellAttributes() ?>>
<?php if ($password->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $password_list->lRowIndex ?>_user_name" id="x<?php echo $password_list->lRowIndex ?>_user_name" size="30" maxlength="200" value="<?php echo $password->user_name->EditValue ?>"<?php echo $password->user_name->EditAttributes() ?>>
<?php } ?>
<?php if ($password->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $password->user_name->ViewAttributes() ?>><?php echo $password->user_name->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($password->password->Visible) { // password ?>
		<td<?php echo $password->password->CellAttributes() ?>>
<?php if ($password->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $password_list->lRowIndex ?>_password" id="x<?php echo $password_list->lRowIndex ?>_password" size="30" maxlength="200" value="<?php echo $password->password->EditValue ?>"<?php echo $password->password->EditAttributes() ?>>
<?php } ?>
<?php if ($password->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $password->password->ViewAttributes() ?>><?php echo $password->password->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php if ($password->RowType == EW_ROWTYPE_ADD || $password->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($password->CurrentAction == "edit") { ?>
<td colspan="<?php echo $password_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (password_list.ValidateForm(document.fpasswordlist)) document.fpasswordlist.submit();return false;"><img src='images/update.gif' alt='Update' title='Update' width='16' height='16' border='0'></a>&nbsp;<a href="<?php echo $password_list->PageUrl() ?>a=cancel"><img src='images/cancel.gif' alt='Cancel' title='Cancel' width='16' height='16' border='0'></a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php } else { ?>
<?php if ($password->Export == "") { ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $password->EditUrl() ?>"><img src='images/edit.gif' alt='Edit' title='Edit' width='16' height='16' border='0'></a><span class="ewSeparator">&nbsp;|&nbsp;</span><a href="<?php echo $password->InlineEditUrl() ?>"><img src='images/inlineedit.gif' alt='Inline Edit' title='Inline Edit' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($password_list->lOptionCnt == 0 && $password->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $password->DeleteUrl() ?>"><img src='images/delete.gif' alt='Delete' title='Delete' width='16' height='16' border='0'></a>
</span></td>
<?php } ?>
<?php

// Custom list options
foreach ($password_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
<?php if ($password->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($password->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($password->CurrentAction == "add" || $password->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $password_list->lRowIndex ?>">
<?php } ?>
<?php if ($password->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $password_list->lRowIndex ?>">
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($password_list->lTotalRecs > 0) { ?>
<?php if ($password->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($password->CurrentAction <> "gridadd" && $password->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<span class="phpmaker">
<?php if (!isset($password_list->Pager)) $password_list->Pager = new cNumericPager($password_list->lStartRec, $password_list->lDisplayRecs, $password_list->lTotalRecs, $password_list->lRecRange) ?>
<?php if ($password_list->Pager->RecordCount > 0) { ?>
	<?php if ($password_list->Pager->FirstButton->Enabled) { ?>
	<a href="<?php echo $password_list->PageUrl() ?>start=<?php echo $password_list->Pager->FirstButton->Start ?>"><b>First</b></a>&nbsp;
	<?php } ?>
	<?php if ($password_list->Pager->PrevButton->Enabled) { ?>
	<a href="<?php echo $password_list->PageUrl() ?>start=<?php echo $password_list->Pager->PrevButton->Start ?>"><b>Previous</b></a>&nbsp;
	<?php } ?>
	<?php foreach ($password_list->Pager->Items as $PagerItem) { ?>
		<?php if ($PagerItem->Enabled) { ?><a href="<?php echo $password_list->PageUrl() ?>start=<?php echo $PagerItem->Start ?>"><?php } ?><b><?php echo $PagerItem->Text ?></b><?php if ($PagerItem->Enabled) { ?></a><?php } ?>&nbsp;
	<?php } ?>
	<?php if ($password_list->Pager->NextButton->Enabled) { ?>
	<a href="<?php echo $password_list->PageUrl() ?>start=<?php echo $password_list->Pager->NextButton->Start ?>"><b>Next</b></a>&nbsp;
	<?php } ?>
	<?php if ($password_list->Pager->LastButton->Enabled) { ?>
	<a href="<?php echo $password_list->PageUrl() ?>start=<?php echo $password_list->Pager->LastButton->Start ?>"><b>Last</b></a>&nbsp;
	<?php } ?>
	<?php if ($password_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	Records <?php echo $password_list->Pager->FromIndex ?> to <?php echo $password_list->Pager->ToIndex ?> of <?php echo $password_list->Pager->RecordCount ?>
<?php } else { ?>	
	<?php if ($password_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($password_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $password_list->PageUrl() ?>a=add">Inline Add</a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($password->Export == "" && $password->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(password_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($password->Export == "") { ?>
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
class cpassword_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'password';

	// Page Object Name
	var $PageObjName = 'password_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $password;
		if ($password->UseTokenInUrl) $PageUrl .= "t=" . $password->TableVar . "&"; // add page token
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
		global $objForm, $password;
		if ($password->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($password->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($password->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cpassword_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["password"] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'password', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $password;
		global $Security;
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
	$password->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $password->Export; // Get export parameter, used in header
	$gsExportFile = $password->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $password;
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

		// Create form object
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$password->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($password->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($password->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($password->CurrentAction == "add" || $password->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$password->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if ($password->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($password->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();
				}
			}

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($password->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $password->getRecordsPerPage(); // Restore from Session
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
		$password->setSessionWhere($sFilter);
		$password->CurrentFilter = "";
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $password;
		$password->setKey("id", ""); // Clear inline edit key
		$password->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit Mode
	function InlineEditMode() {
		global $Security, $password;
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$password->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$password->setKey("id", $password->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Peform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $password;
		$objForm->Index = 1; 
		$this->LoadFormValues(); // Get form values

		// Validate Form
		$bInlineUpdate = TRUE;
		if (!$this->ValidateForm()) {	
			$bInlineUpdate = FALSE; // Form error, reset action
			$this->setMessage($gsFormError);
		} else {
			$bInlineUpdate = FALSE;	
			if ($this->CheckInlineEditKey()) { // Check key
				$password->SendEmail = TRUE; // Send email on update success
				$bInlineUpdate = $this->EditRow(); // Update record
			} else {
				$bInlineUpdate = FALSE;
			}
		}
		if ($bInlineUpdate) { // Update success
			$this->setMessage("Update succeeded"); // Set success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getMessage() == "")
				$this->setMessage("Update failed"); // Set update failed message
			$password->EventCancelled = TRUE; // Cancel event
			$password->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $password;

		//CheckInlineEditKey = True
		if (strval($password->getKey("id")) <> strval($password->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $password;
		$password->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Peform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $password;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$password->EventCancelled = TRUE; // Set event cancelled
			$password->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$password->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$password->EventCancelled = TRUE; // Set event cancelled
			$password->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $password;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$password->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$password->CurrentOrderType = @$_GET["ordertype"];
			$password->UpdateSort($password->id); // Field 
			$password->UpdateSort($password->user_name); // Field 
			$password->UpdateSort($password->password); // Field 
			$password->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $password;
		$sOrderBy = $password->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($password->SqlOrderBy() <> "") {
				$sOrderBy = $password->SqlOrderBy();
				$password->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $password;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$password->setSessionOrderBy($sOrderBy);
				$password->id->setSort("");
				$password->user_name->setSort("");
				$password->password->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$password->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $password;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$password->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$password->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $password->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$password->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$password->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$password->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $password;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $password;
		$password->id->setFormValue($objForm->GetValue("x_id"));
		$password->user_name->setFormValue($objForm->GetValue("x_user_name"));
		$password->password->setFormValue($objForm->GetValue("x_password"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $password;
		$password->id->CurrentValue = $password->id->FormValue;
		$password->user_name->CurrentValue = $password->user_name->FormValue;
		$password->password->CurrentValue = $password->password->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $password;

		// Call Recordset Selecting event
		$password->Recordset_Selecting($password->CurrentFilter);

		// Load list page SQL
		$sSql = $password->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$password->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $password;
		$sFilter = $password->KeyFilter();

		// Call Row Selecting event
		$password->Row_Selecting($sFilter);

		// Load sql based on filter
		$password->CurrentFilter = $sFilter;
		$sSql = $password->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$password->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $password;
		$password->id->setDbValue($rs->fields('id'));
		$password->user_name->setDbValue($rs->fields('user_name'));
		$password->password->setDbValue($rs->fields('password'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $password;

		// Call Row_Rendering event
		$password->Row_Rendering();

		// Common render codes for all row types
		// id

		$password->id->CellCssStyle = "";
		$password->id->CellCssClass = "";

		// user_name
		$password->user_name->CellCssStyle = "";
		$password->user_name->CellCssClass = "";

		// password
		$password->password->CellCssStyle = "";
		$password->password->CellCssClass = "";
		if ($password->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$password->id->ViewValue = $password->id->CurrentValue;
			$password->id->CssStyle = "";
			$password->id->CssClass = "";
			$password->id->ViewCustomAttributes = "";

			// user_name
			$password->user_name->ViewValue = $password->user_name->CurrentValue;
			$password->user_name->CssStyle = "";
			$password->user_name->CssClass = "";
			$password->user_name->ViewCustomAttributes = "";

			// password
			$password->password->ViewValue = $password->password->CurrentValue;
			$password->password->CssStyle = "";
			$password->password->CssClass = "";
			$password->password->ViewCustomAttributes = "";

			// id
			$password->id->HrefValue = "";

			// user_name
			$password->user_name->HrefValue = "";

			// password
			$password->password->HrefValue = "";
		} elseif ($password->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			// user_name

			$password->user_name->EditCustomAttributes = "";
			$password->user_name->EditValue = ew_HtmlEncode($password->user_name->CurrentValue);

			// password
			$password->password->EditCustomAttributes = "";
			$password->password->EditValue = ew_HtmlEncode($password->password->CurrentValue);
		} elseif ($password->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$password->id->EditCustomAttributes = "";
			$password->id->EditValue = $password->id->CurrentValue;
			$password->id->CssStyle = "";
			$password->id->CssClass = "";
			$password->id->ViewCustomAttributes = "";

			// user_name
			$password->user_name->EditCustomAttributes = "";
			$password->user_name->EditValue = ew_HtmlEncode($password->user_name->CurrentValue);

			// password
			$password->password->EditCustomAttributes = "";
			$password->password->EditValue = ew_HtmlEncode($password->password->CurrentValue);

			// Edit refer script
			// id

			$password->id->HrefValue = "";

			// user_name
			$password->user_name->HrefValue = "";

			// password
			$password->password->HrefValue = "";
		}

		// Call Row Rendered event
		$password->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $password;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($password->user_name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - User Name";
		}
		if ($password->password->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Password";
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $password;
		$sFilter = $password->KeyFilter();
		$password->CurrentFilter = $sFilter;
		$sSql = $password->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// Field id
			// Field user_name

			$password->user_name->SetDbValueDef($password->user_name->CurrentValue, "");
			$rsnew['user_name'] =& $password->user_name->DbValue;

			// Field password
			$password->password->SetDbValueDef($password->password->CurrentValue, "");
			$rsnew['password'] =& $password->password->DbValue;

			// Call Row Updating event
			$bUpdateRow = $password->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($password->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($password->CancelMessage <> "") {
					$this->setMessage($password->CancelMessage);
					$password->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$password->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $password;
		$rsnew = array();

		// Field id
		// Field user_name

		$password->user_name->SetDbValueDef($password->user_name->CurrentValue, "");
		$rsnew['user_name'] =& $password->user_name->DbValue;

		// Field password
		$password->password->SetDbValueDef($password->password->CurrentValue, "");
		$rsnew['password'] =& $password->password->DbValue;

		// Call Row Inserting event
		$bInsertRow = $password->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($password->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($password->CancelMessage <> "") {
				$this->setMessage($password->CancelMessage);
				$password->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$password->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $password->id->DbValue;

			// Call Row Inserted event
			$password->Row_Inserted($rsnew);
		}
		return $AddRow;
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
