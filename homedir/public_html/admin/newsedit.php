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
$news_edit = new cnews_edit();
$Page =& $news_edit;

// Page init processing
$news_edit->Page_Init();

// Page main processing
$news_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var news_edit = new ew_Page("news_edit");

// page properties
news_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = news_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
news_edit.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_header"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Header");
		elm = fobj.elements["x" + infix + "_photo"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "File type is not allowed.");
		elm = fobj.elements["x" + infix + "_short_desc"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Short Desc");
		elm = fobj.elements["x" + infix + "_insert_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Insert Date");
		elm = fobj.elements["x" + infix + "_insert_date"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "Incorrect date, format = yyyy/mm/dd - Insert Date");
		elm = fobj.elements["x" + infix + "_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Status");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
news_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
news_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
news_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
news_edit.ShowHighlightText = "Show highlight"; 
news_edit.HideHighlightText = "Hide highlight";

//-->
</script>
<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
<script type="text/javascript">
<!--
_width_multiplier = 16;
_height_multiplier = 60;
var ew_DHTMLEditors = [];

// update value from editor to textarea
function ew_UpdateTextArea() {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {			
			var inst;			
			for (inst in FCKeditorAPI.__Instances)
				FCKeditorAPI.__Instances[inst].UpdateLinkedField();
	}
}

// update value from textarea to editor
function ew_UpdateDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {
		var inst = FCKeditorAPI.GetInstance(name);		
		if (inst)
			inst.SetHTML(inst.LinkedField.value)
	}
}

// focus editor
function ew_FocusDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {
		var inst = FCKeditorAPI.GetInstance(name);	
		if (inst && inst.EditorWindow) {
			inst.EditorWindow.focus();
		}
	}
}

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
<div align="center" class="msm_h1">Edit TABLE: News</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $news->getReturnUrl() ?>">Go Back</a></span></p>
<?php $news_edit->ShowMessage() ?>
<form name="fnewsedit" id="fnewsedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data">
<p>
<input type="hidden" name="a_table" id="a_table" value="news">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($news->id->Visible) { // id ?>
	<tr<?php echo $news->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $news->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $news->id->ViewAttributes() ?>><?php echo $news->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($news->id->CurrentValue) ?>">
</span><?php echo $news->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($news->header->Visible) { // header ?>
	<tr<?php echo $news->header->RowAttributes ?>>
		<td class="ewTableHeader">Header<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $news->header->CellAttributes() ?>><span id="el_header">
<input type="text" name="x_header" id="x_header" size="30" maxlength="200" value="<?php echo $news->header->EditValue ?>"<?php echo $news->header->EditAttributes() ?>>
</span><?php echo $news->header->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($news->photo->Visible) { // photo ?>
	<tr<?php echo $news->photo->RowAttributes ?>>
		<td class="ewTableHeader">Photo</td>
		<td<?php echo $news->photo->CellAttributes() ?>><span id="el_photo">
<div id="old_x_photo">
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
</div>
<div id="new_x_photo">
<?php if (!is_null($news->photo->Upload->DbValue)) { ?>
<input type="radio" name="a_photo" id="a_photo" value="1" checked="checked">Keep&nbsp;
<input type="radio" name="a_photo" id="a_photo" value="2">Remove&nbsp;
<input type="radio" name="a_photo" id="a_photo" value="3">Replace<br>
<?php } else { ?>
<input type="hidden" name="a_photo" id="a_photo" value="3">
<?php } ?>
<input type="file" name="x_photo" id="x_photo" size="30" onchange="if (this.form.a_photo[2]) this.form.a_photo[2].checked=true;"<?php echo $news->photo->EditAttributes() ?>>
</div>
</span><?php echo $news->photo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($news->short_desc->Visible) { // short_desc ?>
	<tr<?php echo $news->short_desc->RowAttributes ?>>
		<td class="ewTableHeader">Short Desc<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $news->short_desc->CellAttributes() ?>><span id="el_short_desc">
<textarea name="x_short_desc" id="x_short_desc" cols="45" rows="4"<?php echo $news->short_desc->EditAttributes() ?>><?php echo $news->short_desc->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_short_desc", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_short_desc', 45*_width_multiplier, 4*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span><?php echo $news->short_desc->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($news->full_desc->Visible) { // full_desc ?>
	<tr<?php echo $news->full_desc->RowAttributes ?>>
		<td class="ewTableHeader">Full Desc</td>
		<td<?php echo $news->full_desc->CellAttributes() ?>><span id="el_full_desc">
<textarea name="x_full_desc" id="x_full_desc" cols="45" rows="8"<?php echo $news->full_desc->EditAttributes() ?>><?php echo $news->full_desc->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_full_desc", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_full_desc', 45*_width_multiplier, 8*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span><?php echo $news->full_desc->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($news->insert_date->Visible) { // insert_date ?>
	<tr<?php echo $news->insert_date->RowAttributes ?>>
		<td class="ewTableHeader">Insert Date<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $news->insert_date->CellAttributes() ?>><span id="el_insert_date">
<input type="text" name="x_insert_date" id="x_insert_date" value="<?php echo $news->insert_date->EditValue ?>"<?php echo $news->insert_date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_insert_date" name="cal_x_insert_date" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_insert_date", // ID of the input field
	ifFormat : "%Y/%m/%d", // the date format
	button : "cal_x_insert_date" // ID of the button
});
</script>
</span><?php echo $news->insert_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($news->status->Visible) { // status ?>
	<tr<?php echo $news->status->RowAttributes ?>>
		<td class="ewTableHeader">Status<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $news->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_status" id="x_status" value="{value}"<?php echo $news->status->EditAttributes() ?>></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $news->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($news->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $news->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $news->status->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="button" name="btnAction" id="btnAction" value="   Edit   " onclick="ew_SubmitForm(news_edit, this.form);">
</form>
<script type="text/javascript">
<!--
ew_CreateEditor();  // Create DHTML editor(s)

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php

//
// Page Class
//
class cnews_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'news';

	// Page Object Name
	var $PageObjName = 'news_edit';

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
	function cnews_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["news"] = new cnews();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'news', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
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

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $news;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$news->id->setQueryStringValue($_GET["id"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$news->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$news->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$news->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($news->id->CurrentValue == "")
			$this->Page_Terminate("newslist.php"); // Invalid key, return to list
		switch ($news->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No records found"); // No record found
					$this->Page_Terminate("newslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$news->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Update succeeded"); // Update success
					$sReturnUrl = $news->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$news->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $news;

		// Get upload data
			if ($news->photo->Upload->UploadFile()) {

				// No action required
			} else {
				echo $news->photo->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $news;
		$news->id->setFormValue($objForm->GetValue("x_id"));
		$news->header->setFormValue($objForm->GetValue("x_header"));
		$news->short_desc->setFormValue($objForm->GetValue("x_short_desc"));
		$news->full_desc->setFormValue($objForm->GetValue("x_full_desc"));
		$news->insert_date->setFormValue($objForm->GetValue("x_insert_date"));
		$news->insert_date->CurrentValue = ew_UnFormatDateTime($news->insert_date->CurrentValue, 5);
		$news->status->setFormValue($objForm->GetValue("x_status"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $news;
		$this->LoadRow();
		$news->id->CurrentValue = $news->id->FormValue;
		$news->header->CurrentValue = $news->header->FormValue;
		$news->short_desc->CurrentValue = $news->short_desc->FormValue;
		$news->full_desc->CurrentValue = $news->full_desc->FormValue;
		$news->insert_date->CurrentValue = $news->insert_date->FormValue;
		$news->insert_date->CurrentValue = ew_UnFormatDateTime($news->insert_date->CurrentValue, 5);
		$news->status->CurrentValue = $news->status->FormValue;
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

		// short_desc
		$news->short_desc->CellCssStyle = "";
		$news->short_desc->CellCssClass = "";

		// full_desc
		$news->full_desc->CellCssStyle = "";
		$news->full_desc->CellCssClass = "";

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

			// short_desc
			$news->short_desc->ViewValue = $news->short_desc->CurrentValue;
			$news->short_desc->CssStyle = "";
			$news->short_desc->CssClass = "";
			$news->short_desc->ViewCustomAttributes = "";

			// full_desc
			$news->full_desc->ViewValue = $news->full_desc->CurrentValue;
			$news->full_desc->CssStyle = "";
			$news->full_desc->CssClass = "";
			$news->full_desc->ViewCustomAttributes = "";

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

			// short_desc
			$news->short_desc->HrefValue = "";

			// full_desc
			$news->full_desc->HrefValue = "";

			// insert_date
			$news->insert_date->HrefValue = "";

			// status
			$news->status->HrefValue = "";
		} elseif ($news->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$news->id->EditCustomAttributes = "";
			$news->id->EditValue = $news->id->CurrentValue;
			$news->id->CssStyle = "";
			$news->id->CssClass = "";
			$news->id->ViewCustomAttributes = "";

			// header
			$news->header->EditCustomAttributes = "";
			$news->header->EditValue = ew_HtmlEncode($news->header->CurrentValue);

			// photo
			$news->photo->EditCustomAttributes = "";
			if (!is_null($news->photo->Upload->DbValue)) {
				$news->photo->EditValue = $news->photo->Upload->DbValue;
				$news->photo->ImageWidth = 100;
				$news->photo->ImageHeight = 0;
				$news->photo->ImageAlt = "";
			} else {
				$news->photo->EditValue = "";
			}

			// short_desc
			$news->short_desc->EditCustomAttributes = "";
			$news->short_desc->EditValue = ew_HtmlEncode($news->short_desc->CurrentValue);

			// full_desc
			$news->full_desc->EditCustomAttributes = "";
			$news->full_desc->EditValue = ew_HtmlEncode($news->full_desc->CurrentValue);

			// insert_date
			$news->insert_date->EditCustomAttributes = "";
			$news->insert_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($news->insert_date->CurrentValue, 5));

			// status
			$news->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Active");
			$arwrk[] = array("2", "Not Active");
			$news->status->EditValue = $arwrk;

			// Edit refer script
			// id

			$news->id->HrefValue = "";

			// header
			$news->header->HrefValue = "";

			// photo
			$news->photo->HrefValue = "";

			// short_desc
			$news->short_desc->HrefValue = "";

			// full_desc
			$news->full_desc->HrefValue = "";

			// insert_date
			$news->insert_date->HrefValue = "";

			// status
			$news->status->HrefValue = "";
		}

		// Call Row Rendered event
		$news->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $news;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($news->photo->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($news->photo->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($news->photo->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($news->header->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Header";
		}
		if ($news->short_desc->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Short Desc";
		}
		if ($news->insert_date->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Insert Date";
		}
		if (!ew_CheckDate($news->insert_date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect date, format = yyyy/mm/dd - Insert Date";
		}
		if ($news->status->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Status";
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
		global $conn, $Security, $news;
		$sFilter = $news->KeyFilter();
		$news->CurrentFilter = $sFilter;
		$sSql = $news->SQL();
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
			// Field header

			$news->header->SetDbValueDef($news->header->CurrentValue, "");
			$rsnew['header'] =& $news->header->DbValue;

			// Field photo
			$news->photo->Upload->SaveToSession(); // Save file value to Session
			if ($news->photo->Upload->Action == "2" || $news->photo->Upload->Action == "3") { // Update/Remove
			$news->photo->Upload->DbValue = $rs->fields('photo'); // Get original value
			if (is_null($news->photo->Upload->Value)) {
				$rsnew['photo'] = NULL;
			} else {
				$rsnew['photo'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../upload/image/"), $news->photo->Upload->FileName);
			}
			}

			// Field short_desc
			$news->short_desc->SetDbValueDef($news->short_desc->CurrentValue, "");
			$rsnew['short_desc'] =& $news->short_desc->DbValue;

			// Field full_desc
			$news->full_desc->SetDbValueDef($news->full_desc->CurrentValue, NULL);
			$rsnew['full_desc'] =& $news->full_desc->DbValue;

			// Field insert_date
			$news->insert_date->SetDbValueDef(ew_UnFormatDateTime($news->insert_date->CurrentValue, 5), ew_CurrentDate());
			$rsnew['insert_date'] =& $news->insert_date->DbValue;

			// Field status
			$news->status->SetDbValueDef($news->status->CurrentValue, 0);
			$rsnew['status'] =& $news->status->DbValue;

			// Call Row Updating event
			$bUpdateRow = $news->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {

			// Field photo
			if (!is_null($news->photo->Upload->Value)) {
				$news->photo->Upload->SaveToFile("../upload/image/", $rsnew['photo'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($news->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($news->CancelMessage <> "") {
					$this->setMessage($news->CancelMessage);
					$news->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$news->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// Field photo
		$news->photo->Upload->RemoveFromSession(); // Remove file value from Session
		return $EditRow;
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
