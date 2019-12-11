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
$password_edit = new cpassword_edit();
$Page =& $password_edit;

// Page init processing
$password_edit->Page_Init();

// Page main processing
$password_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var password_edit = new ew_Page("password_edit");

// page properties
password_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = password_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
password_edit.ValidateForm = function(fobj) {
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
password_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
password_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
password_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

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
<div align="center" class="msm_h1">Edit TABLE: Password</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $password->getReturnUrl() ?>">Go Back</a></span></p>
<?php $password_edit->ShowMessage() ?>
<form name="fpasswordedit" id="fpasswordedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return password_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="password">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($password->id->Visible) { // id ?>
	<tr<?php echo $password->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $password->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $password->id->ViewAttributes() ?>><?php echo $password->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($password->id->CurrentValue) ?>">
</span><?php echo $password->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($password->user_name->Visible) { // user_name ?>
	<tr<?php echo $password->user_name->RowAttributes ?>>
		<td class="ewTableHeader">User Name<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $password->user_name->CellAttributes() ?>><span id="el_user_name">
<input type="text" name="x_user_name" id="x_user_name" size="30" maxlength="200" value="<?php echo $password->user_name->EditValue ?>"<?php echo $password->user_name->EditAttributes() ?>>
</span><?php echo $password->user_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($password->password->Visible) { // password ?>
	<tr<?php echo $password->password->RowAttributes ?>>
		<td class="ewTableHeader">Password<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $password->password->CellAttributes() ?>><span id="el_password">
<input type="text" name="x_password" id="x_password" size="30" maxlength="200" value="<?php echo $password->password->EditValue ?>"<?php echo $password->password->EditAttributes() ?>>
</span><?php echo $password->password->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="   Edit   ">
</form>
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
class cpassword_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'password';

	// Page Object Name
	var $PageObjName = 'password_edit';

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
	function cpassword_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["password"] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'password', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
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
		global $objForm, $gsFormError, $password;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$password->id->setQueryStringValue($_GET["id"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$password->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$password->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$password->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($password->id->CurrentValue == "")
			$this->Page_Terminate("passwordlist.php"); // Invalid key, return to list
		switch ($password->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No records found"); // No record found
					$this->Page_Terminate("passwordlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$password->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Update succeeded"); // Update success
					$sReturnUrl = $password->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$password->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $password;

		// Get upload data
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
		$this->LoadRow();
		$password->id->CurrentValue = $password->id->FormValue;
		$password->user_name->CurrentValue = $password->user_name->FormValue;
		$password->password->CurrentValue = $password->password->FormValue;
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
