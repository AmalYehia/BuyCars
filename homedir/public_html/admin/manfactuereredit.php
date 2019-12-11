<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "manfactuererinfo.php" ?>
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
$manfactuerer_edit = new cmanfactuerer_edit();
$Page =& $manfactuerer_edit;

// Page init processing
$manfactuerer_edit->Page_Init();

// Page main processing
$manfactuerer_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var manfactuerer_edit = new ew_Page("manfactuerer_edit");

// page properties
manfactuerer_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = manfactuerer_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
manfactuerer_edit.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Name");
		elm = fobj.elements["x" + infix + "_logo"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "File type is not allowed.");
		elm = fobj.elements["x" + infix + "_sort_order"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Sort Order");
		elm = fobj.elements["x" + infix + "_sort_order"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - Sort Order");
		elm = fobj.elements["x" + infix + "_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Status");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
manfactuerer_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
manfactuerer_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
manfactuerer_edit.ValidateRequired = false; // no JavaScript validation
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
<div align="center" class="msm_h1">Edit TABLE: Manfactuerer</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $manfactuerer->getReturnUrl() ?>">Go Back</a></span></p>
<?php $manfactuerer_edit->ShowMessage() ?>
<form name="fmanfactuereredit" id="fmanfactuereredit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return manfactuerer_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="manfactuerer">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($manfactuerer->id->Visible) { // id ?>
	<tr<?php echo $manfactuerer->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $manfactuerer->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $manfactuerer->id->ViewAttributes() ?>><?php echo $manfactuerer->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($manfactuerer->id->CurrentValue) ?>">
</span><?php echo $manfactuerer->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($manfactuerer->name->Visible) { // name ?>
	<tr<?php echo $manfactuerer->name->RowAttributes ?>>
		<td class="ewTableHeader">Name<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $manfactuerer->name->CellAttributes() ?>><span id="el_name">
<input type="text" name="x_name" id="x_name" size="30" maxlength="200" value="<?php echo $manfactuerer->name->EditValue ?>"<?php echo $manfactuerer->name->EditAttributes() ?>>
</span><?php echo $manfactuerer->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($manfactuerer->logo->Visible) { // logo ?>
	<tr<?php echo $manfactuerer->logo->RowAttributes ?>>
		<td class="ewTableHeader">Logo</td>
		<td<?php echo $manfactuerer->logo->CellAttributes() ?>><span id="el_logo">
<div id="old_x_logo">
<?php if ($manfactuerer->logo->HrefValue <> "") { ?>
<?php if (!is_null($manfactuerer->logo->Upload->DbValue)) { ?>
<a href="<?php echo $manfactuerer->logo->HrefValue ?>"><?php echo $manfactuerer->logo->EditValue ?></a>
<?php } elseif (!in_array($manfactuerer->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($manfactuerer->logo->Upload->DbValue)) { ?>
<?php echo $manfactuerer->logo->EditValue ?>
<?php } elseif (!in_array($manfactuerer->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_logo">
<?php if (!is_null($manfactuerer->logo->Upload->DbValue)) { ?>
<input type="radio" name="a_logo" id="a_logo" value="1" checked="checked">Keep&nbsp;
<input type="radio" name="a_logo" id="a_logo" value="2">Remove&nbsp;
<input type="radio" name="a_logo" id="a_logo" value="3">Replace<br>
<?php } else { ?>
<input type="hidden" name="a_logo" id="a_logo" value="3">
<?php } ?>
<input type="file" name="x_logo" id="x_logo" size="30" onchange="if (this.form.a_logo[2]) this.form.a_logo[2].checked=true;"<?php echo $manfactuerer->logo->EditAttributes() ?>>
</div>
</span><?php echo $manfactuerer->logo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($manfactuerer->sort_order->Visible) { // sort_order ?>
	<tr<?php echo $manfactuerer->sort_order->RowAttributes ?>>
		<td class="ewTableHeader">Sort Order<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $manfactuerer->sort_order->CellAttributes() ?>><span id="el_sort_order">
<input type="text" name="x_sort_order" id="x_sort_order" size="30" value="<?php echo $manfactuerer->sort_order->EditValue ?>"<?php echo $manfactuerer->sort_order->EditAttributes() ?>>
</span><?php echo $manfactuerer->sort_order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($manfactuerer->status->Visible) { // status ?>
	<tr<?php echo $manfactuerer->status->RowAttributes ?>>
		<td class="ewTableHeader">Status<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $manfactuerer->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_status" id="x_status" value="{value}"<?php echo $manfactuerer->status->EditAttributes() ?>></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $manfactuerer->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($manfactuerer->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $manfactuerer->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $manfactuerer->status->CustomMsg ?></td>
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
class cmanfactuerer_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'manfactuerer';

	// Page Object Name
	var $PageObjName = 'manfactuerer_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $manfactuerer;
		if ($manfactuerer->UseTokenInUrl) $PageUrl .= "t=" . $manfactuerer->TableVar . "&"; // add page token
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
		global $objForm, $manfactuerer;
		if ($manfactuerer->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($manfactuerer->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($manfactuerer->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmanfactuerer_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["manfactuerer"] = new cmanfactuerer();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'manfactuerer', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $manfactuerer;
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
		global $objForm, $gsFormError, $manfactuerer;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$manfactuerer->id->setQueryStringValue($_GET["id"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$manfactuerer->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$manfactuerer->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$manfactuerer->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($manfactuerer->id->CurrentValue == "")
			$this->Page_Terminate("manfactuererlist.php"); // Invalid key, return to list
		switch ($manfactuerer->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No records found"); // No record found
					$this->Page_Terminate("manfactuererlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$manfactuerer->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Update succeeded"); // Update success
					$sReturnUrl = $manfactuerer->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$manfactuerer->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $manfactuerer;

		// Get upload data
			if ($manfactuerer->logo->Upload->UploadFile()) {

				// No action required
			} else {
				echo $manfactuerer->logo->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $manfactuerer;
		$manfactuerer->id->setFormValue($objForm->GetValue("x_id"));
		$manfactuerer->name->setFormValue($objForm->GetValue("x_name"));
		$manfactuerer->sort_order->setFormValue($objForm->GetValue("x_sort_order"));
		$manfactuerer->status->setFormValue($objForm->GetValue("x_status"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $manfactuerer;
		$this->LoadRow();
		$manfactuerer->id->CurrentValue = $manfactuerer->id->FormValue;
		$manfactuerer->name->CurrentValue = $manfactuerer->name->FormValue;
		$manfactuerer->sort_order->CurrentValue = $manfactuerer->sort_order->FormValue;
		$manfactuerer->status->CurrentValue = $manfactuerer->status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $manfactuerer;
		$sFilter = $manfactuerer->KeyFilter();

		// Call Row Selecting event
		$manfactuerer->Row_Selecting($sFilter);

		// Load sql based on filter
		$manfactuerer->CurrentFilter = $sFilter;
		$sSql = $manfactuerer->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$manfactuerer->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $manfactuerer;
		$manfactuerer->id->setDbValue($rs->fields('id'));
		$manfactuerer->name->setDbValue($rs->fields('name'));
		$manfactuerer->logo->Upload->DbValue = $rs->fields('logo');
		$manfactuerer->sort_order->setDbValue($rs->fields('sort_order'));
		$manfactuerer->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $manfactuerer;

		// Call Row_Rendering event
		$manfactuerer->Row_Rendering();

		// Common render codes for all row types
		// id

		$manfactuerer->id->CellCssStyle = "";
		$manfactuerer->id->CellCssClass = "";

		// name
		$manfactuerer->name->CellCssStyle = "";
		$manfactuerer->name->CellCssClass = "";

		// logo
		$manfactuerer->logo->CellCssStyle = "";
		$manfactuerer->logo->CellCssClass = "";

		// sort_order
		$manfactuerer->sort_order->CellCssStyle = "";
		$manfactuerer->sort_order->CellCssClass = "";

		// status
		$manfactuerer->status->CellCssStyle = "";
		$manfactuerer->status->CellCssClass = "";
		if ($manfactuerer->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$manfactuerer->id->ViewValue = $manfactuerer->id->CurrentValue;
			$manfactuerer->id->CssStyle = "";
			$manfactuerer->id->CssClass = "";
			$manfactuerer->id->ViewCustomAttributes = "";

			// name
			$manfactuerer->name->ViewValue = $manfactuerer->name->CurrentValue;
			$manfactuerer->name->CssStyle = "";
			$manfactuerer->name->CssClass = "";
			$manfactuerer->name->ViewCustomAttributes = "";

			// logo
			if (!is_null($manfactuerer->logo->Upload->DbValue)) {
				$manfactuerer->logo->ViewValue = $manfactuerer->logo->Upload->DbValue;
			} else {
				$manfactuerer->logo->ViewValue = "";
			}
			$manfactuerer->logo->CssStyle = "";
			$manfactuerer->logo->CssClass = "";
			$manfactuerer->logo->ViewCustomAttributes = "";

			// sort_order
			$manfactuerer->sort_order->ViewValue = $manfactuerer->sort_order->CurrentValue;
			$manfactuerer->sort_order->CssStyle = "";
			$manfactuerer->sort_order->CssClass = "";
			$manfactuerer->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($manfactuerer->status->CurrentValue) <> "") {
				switch ($manfactuerer->status->CurrentValue) {
					case "1":
						$manfactuerer->status->ViewValue = "Active";
						break;
					case "2":
						$manfactuerer->status->ViewValue = "Not Active";
						break;
					default:
						$manfactuerer->status->ViewValue = $manfactuerer->status->CurrentValue;
				}
			} else {
				$manfactuerer->status->ViewValue = NULL;
			}
			$manfactuerer->status->CssStyle = "";
			$manfactuerer->status->CssClass = "";
			$manfactuerer->status->ViewCustomAttributes = "";

			// id
			$manfactuerer->id->HrefValue = "";

			// name
			$manfactuerer->name->HrefValue = "";

			// logo
			if (!is_null($manfactuerer->logo->Upload->DbValue)) {
				$manfactuerer->logo->HrefValue = ew_UploadPathEx(FALSE, "../upload/photo/") . ((!empty($manfactuerer->logo->ViewValue)) ? $manfactuerer->logo->ViewValue : $manfactuerer->logo->CurrentValue);
				if ($manfactuerer->Export <> "") $manfactuerer->logo->HrefValue = ew_ConvertFullUrl($manfactuerer->logo->HrefValue);
			} else {
				$manfactuerer->logo->HrefValue = "";
			}

			// sort_order
			$manfactuerer->sort_order->HrefValue = "";

			// status
			$manfactuerer->status->HrefValue = "";
		} elseif ($manfactuerer->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$manfactuerer->id->EditCustomAttributes = "";
			$manfactuerer->id->EditValue = $manfactuerer->id->CurrentValue;
			$manfactuerer->id->CssStyle = "";
			$manfactuerer->id->CssClass = "";
			$manfactuerer->id->ViewCustomAttributes = "";

			// name
			$manfactuerer->name->EditCustomAttributes = "";
			$manfactuerer->name->EditValue = ew_HtmlEncode($manfactuerer->name->CurrentValue);

			// logo
			$manfactuerer->logo->EditCustomAttributes = "";
			if (!is_null($manfactuerer->logo->Upload->DbValue)) {
				$manfactuerer->logo->EditValue = $manfactuerer->logo->Upload->DbValue;
			} else {
				$manfactuerer->logo->EditValue = "";
			}

			// sort_order
			$manfactuerer->sort_order->EditCustomAttributes = "";
			$manfactuerer->sort_order->EditValue = ew_HtmlEncode($manfactuerer->sort_order->CurrentValue);

			// status
			$manfactuerer->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Active");
			$arwrk[] = array("2", "Not Active");
			$manfactuerer->status->EditValue = $arwrk;

			// Edit refer script
			// id

			$manfactuerer->id->HrefValue = "";

			// name
			$manfactuerer->name->HrefValue = "";

			// logo
			if (!is_null($manfactuerer->logo->Upload->DbValue)) {
				$manfactuerer->logo->HrefValue = ew_UploadPathEx(FALSE, "../upload/photo/") . ((!empty($manfactuerer->logo->EditValue)) ? $manfactuerer->logo->EditValue : $manfactuerer->logo->CurrentValue);
				if ($manfactuerer->Export <> "") $manfactuerer->logo->HrefValue = ew_ConvertFullUrl($manfactuerer->logo->HrefValue);
			} else {
				$manfactuerer->logo->HrefValue = "";
			}

			// sort_order
			$manfactuerer->sort_order->HrefValue = "";

			// status
			$manfactuerer->status->HrefValue = "";
		}

		// Call Row Rendered event
		$manfactuerer->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $manfactuerer;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($manfactuerer->logo->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($manfactuerer->logo->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($manfactuerer->logo->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($manfactuerer->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Name";
		}
		if ($manfactuerer->sort_order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Sort Order";
		}
		if (!ew_CheckInteger($manfactuerer->sort_order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Sort Order";
		}
		if ($manfactuerer->status->FormValue == "") {
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
		global $conn, $Security, $manfactuerer;
		$sFilter = $manfactuerer->KeyFilter();
		$manfactuerer->CurrentFilter = $sFilter;
		$sSql = $manfactuerer->SQL();
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
			// Field name

			$manfactuerer->name->SetDbValueDef($manfactuerer->name->CurrentValue, "");
			$rsnew['name'] =& $manfactuerer->name->DbValue;

			// Field logo
			$manfactuerer->logo->Upload->SaveToSession(); // Save file value to Session
			if ($manfactuerer->logo->Upload->Action == "2" || $manfactuerer->logo->Upload->Action == "3") { // Update/Remove
			$manfactuerer->logo->Upload->DbValue = $rs->fields('logo'); // Get original value
			if (is_null($manfactuerer->logo->Upload->Value)) {
				$rsnew['logo'] = NULL;
			} else {
				$rsnew['logo'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../upload/photo/"), $manfactuerer->logo->Upload->FileName);
			}
			}

			// Field sort_order
			$manfactuerer->sort_order->SetDbValueDef($manfactuerer->sort_order->CurrentValue, 0);
			$rsnew['sort_order'] =& $manfactuerer->sort_order->DbValue;

			// Field status
			$manfactuerer->status->SetDbValueDef($manfactuerer->status->CurrentValue, 0);
			$rsnew['status'] =& $manfactuerer->status->DbValue;

			// Call Row Updating event
			$bUpdateRow = $manfactuerer->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {

			// Field logo
			if (!is_null($manfactuerer->logo->Upload->Value)) {
				$manfactuerer->logo->Upload->SaveToFile("../upload/photo/", $rsnew['logo'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($manfactuerer->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($manfactuerer->CancelMessage <> "") {
					$this->setMessage($manfactuerer->CancelMessage);
					$manfactuerer->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$manfactuerer->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// Field logo
		$manfactuerer->logo->Upload->RemoveFromSession(); // Remove file value from Session
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
