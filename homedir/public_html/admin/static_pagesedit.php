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
$static_pages_edit = new cstatic_pages_edit();
$Page =& $static_pages_edit;

// Page init processing
$static_pages_edit->Page_Init();

// Page main processing
$static_pages_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var static_pages_edit = new ew_Page("static_pages_edit");

// page properties
static_pages_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = static_pages_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
static_pages_edit.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_description"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Description");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
static_pages_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
static_pages_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
static_pages_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

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
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<div align="center" class="msm_h1">Edit TABLE: Static Pages</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $static_pages->getReturnUrl() ?>">Go Back</a></span></p>
<?php $static_pages_edit->ShowMessage() ?>
<form name="fstatic_pagesedit" id="fstatic_pagesedit" action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="a_table" id="a_table" value="static_pages">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($static_pages->id->Visible) { // id ?>
	<tr<?php echo $static_pages->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $static_pages->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $static_pages->id->ViewAttributes() ?>><?php echo $static_pages->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($static_pages->id->CurrentValue) ?>">
</span><?php echo $static_pages->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($static_pages->header->Visible) { // header ?>
	<tr<?php echo $static_pages->header->RowAttributes ?>>
		<td class="ewTableHeader">Header<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $static_pages->header->CellAttributes() ?>><span id="el_header">
<input type="text" name="x_header" id="x_header" size="30" maxlength="200" value="<?php echo $static_pages->header->EditValue ?>"<?php echo $static_pages->header->EditAttributes() ?>>
</span><?php echo $static_pages->header->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($static_pages->description->Visible) { // description ?>
	<tr<?php echo $static_pages->description->RowAttributes ?>>
		<td class="ewTableHeader">Description<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $static_pages->description->CellAttributes() ?>><span id="el_description">
<textarea name="x_description" id="x_description" cols="45" rows="8"<?php echo $static_pages->description->EditAttributes() ?>><?php echo $static_pages->description->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_description", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_description', 45*_width_multiplier, 8*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span><?php echo $static_pages->description->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="button" name="btnAction" id="btnAction" value="   Edit   " onclick="ew_SubmitForm(static_pages_edit, this.form);">
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
class cstatic_pages_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'static_pages';

	// Page Object Name
	var $PageObjName = 'static_pages_edit';

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
	function cstatic_pages_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["static_pages"] = new cstatic_pages();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'static_pages', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
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
		global $objForm, $gsFormError, $static_pages;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$static_pages->id->setQueryStringValue($_GET["id"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$static_pages->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$static_pages->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$static_pages->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($static_pages->id->CurrentValue == "")
			$this->Page_Terminate("static_pageslist.php"); // Invalid key, return to list
		switch ($static_pages->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No records found"); // No record found
					$this->Page_Terminate("static_pageslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$static_pages->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Update succeeded"); // Update success
					$sReturnUrl = $static_pages->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$static_pages->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $static_pages;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $static_pages;
		$static_pages->id->setFormValue($objForm->GetValue("x_id"));
		$static_pages->header->setFormValue($objForm->GetValue("x_header"));
		$static_pages->description->setFormValue($objForm->GetValue("x_description"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $static_pages;
		$this->LoadRow();
		$static_pages->id->CurrentValue = $static_pages->id->FormValue;
		$static_pages->header->CurrentValue = $static_pages->header->FormValue;
		$static_pages->description->CurrentValue = $static_pages->description->FormValue;
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

		// description
		$static_pages->description->CellCssStyle = "";
		$static_pages->description->CellCssClass = "";
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

			// description
			$static_pages->description->ViewValue = $static_pages->description->CurrentValue;
			$static_pages->description->CssStyle = "";
			$static_pages->description->CssClass = "";
			$static_pages->description->ViewCustomAttributes = "";

			// id
			$static_pages->id->HrefValue = "";

			// header
			$static_pages->header->HrefValue = "";

			// description
			$static_pages->description->HrefValue = "";
		} elseif ($static_pages->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$static_pages->id->EditCustomAttributes = "";
			$static_pages->id->EditValue = $static_pages->id->CurrentValue;
			$static_pages->id->CssStyle = "";
			$static_pages->id->CssClass = "";
			$static_pages->id->ViewCustomAttributes = "";

			// header
			$static_pages->header->EditCustomAttributes = "";
			$static_pages->header->EditValue = ew_HtmlEncode($static_pages->header->CurrentValue);

			// description
			$static_pages->description->EditCustomAttributes = "";
			$static_pages->description->EditValue = ew_HtmlEncode($static_pages->description->CurrentValue);

			// Edit refer script
			// id

			$static_pages->id->HrefValue = "";

			// header
			$static_pages->header->HrefValue = "";

			// description
			$static_pages->description->HrefValue = "";
		}

		// Call Row Rendered event
		$static_pages->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $static_pages;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($static_pages->header->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Header";
		}
		if ($static_pages->description->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Description";
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
		global $conn, $Security, $static_pages;
		$sFilter = $static_pages->KeyFilter();
		$static_pages->CurrentFilter = $sFilter;
		$sSql = $static_pages->SQL();
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

			$static_pages->header->SetDbValueDef($static_pages->header->CurrentValue, "");
			$rsnew['header'] =& $static_pages->header->DbValue;

			// Field description
			$static_pages->description->SetDbValueDef($static_pages->description->CurrentValue, "");
			$rsnew['description'] =& $static_pages->description->DbValue;

			// Call Row Updating event
			$bUpdateRow = $static_pages->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($static_pages->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($static_pages->CancelMessage <> "") {
					$this->setMessage($static_pages->CancelMessage);
					$static_pages->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$static_pages->Row_Updated($rsold, $rsnew);
		$rs->Close();
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
