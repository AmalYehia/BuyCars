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
$feature_product_edit = new cfeature_product_edit();
$Page =& $feature_product_edit;

// Page init processing
$feature_product_edit->Page_Init();

// Page main processing
$feature_product_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var feature_product_edit = new ew_Page("feature_product_edit");

// page properties
feature_product_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = feature_product_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
feature_product_edit.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_product_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Product Id");
		elm = fobj.elements["x" + infix + "_product_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - Product Id");
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
feature_product_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
feature_product_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
feature_product_edit.ValidateRequired = false; // no JavaScript validation
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
<div align="center" class="msm_h1">Edit TABLE: Feature Product</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $feature_product->getReturnUrl() ?>">Go Back</a></span></p>
<?php $feature_product_edit->ShowMessage() ?>
<form name="ffeature_productedit" id="ffeature_productedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return feature_product_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="feature_product">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($feature_product->id->Visible) { // id ?>
	<tr<?php echo $feature_product->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $feature_product->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $feature_product->id->ViewAttributes() ?>><?php echo $feature_product->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($feature_product->id->CurrentValue) ?>">
</span><?php echo $feature_product->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($feature_product->product_id->Visible) { // product_id ?>
	<tr<?php echo $feature_product->product_id->RowAttributes ?>>
		<td class="ewTableHeader">Product Id<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $feature_product->product_id->CellAttributes() ?>><span id="el_product_id">
<input type="text" name="x_product_id" id="x_product_id" size="30" value="<?php echo $feature_product->product_id->EditValue ?>"<?php echo $feature_product->product_id->EditAttributes() ?>>
</span><?php echo $feature_product->product_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($feature_product->sort_order->Visible) { // sort_order ?>
	<tr<?php echo $feature_product->sort_order->RowAttributes ?>>
		<td class="ewTableHeader">Sort Order<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $feature_product->sort_order->CellAttributes() ?>><span id="el_sort_order">
<input type="text" name="x_sort_order" id="x_sort_order" size="30" value="<?php echo $feature_product->sort_order->EditValue ?>"<?php echo $feature_product->sort_order->EditAttributes() ?>>
</span><?php echo $feature_product->sort_order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($feature_product->status->Visible) { // status ?>
	<tr<?php echo $feature_product->status->RowAttributes ?>>
		<td class="ewTableHeader">Status<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $feature_product->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_status" id="x_status" value="{value}"<?php echo $feature_product->status->EditAttributes() ?>></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $feature_product->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($feature_product->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $feature_product->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $feature_product->status->CustomMsg ?></td>
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
class cfeature_product_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'feature_product';

	// Page Object Name
	var $PageObjName = 'feature_product_edit';

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
	function cfeature_product_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["feature_product"] = new cfeature_product();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'feature_product', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
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
		global $objForm, $gsFormError, $feature_product;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$feature_product->id->setQueryStringValue($_GET["id"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$feature_product->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$feature_product->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$feature_product->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($feature_product->id->CurrentValue == "")
			$this->Page_Terminate("feature_productlist.php"); // Invalid key, return to list
		switch ($feature_product->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No records found"); // No record found
					$this->Page_Terminate("feature_productlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$feature_product->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Update succeeded"); // Update success
					$sReturnUrl = $feature_product->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$feature_product->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $feature_product;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $feature_product;
		$feature_product->id->setFormValue($objForm->GetValue("x_id"));
		$feature_product->product_id->setFormValue($objForm->GetValue("x_product_id"));
		$feature_product->sort_order->setFormValue($objForm->GetValue("x_sort_order"));
		$feature_product->status->setFormValue($objForm->GetValue("x_status"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $feature_product;
		$this->LoadRow();
		$feature_product->id->CurrentValue = $feature_product->id->FormValue;
		$feature_product->product_id->CurrentValue = $feature_product->product_id->FormValue;
		$feature_product->sort_order->CurrentValue = $feature_product->sort_order->FormValue;
		$feature_product->status->CurrentValue = $feature_product->status->FormValue;
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
		} elseif ($feature_product->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$feature_product->id->EditCustomAttributes = "";
			$feature_product->id->EditValue = $feature_product->id->CurrentValue;
			$feature_product->id->CssStyle = "";
			$feature_product->id->CssClass = "";
			$feature_product->id->ViewCustomAttributes = "";

			// product_id
			$feature_product->product_id->EditCustomAttributes = "";
			$feature_product->product_id->EditValue = ew_HtmlEncode($feature_product->product_id->CurrentValue);

			// sort_order
			$feature_product->sort_order->EditCustomAttributes = "";
			$feature_product->sort_order->EditValue = ew_HtmlEncode($feature_product->sort_order->CurrentValue);

			// status
			$feature_product->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Active");
			$arwrk[] = array("2", "Not Active");
			$feature_product->status->EditValue = $arwrk;

			// Edit refer script
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

	// Validate form
	function ValidateForm() {
		global $gsFormError, $feature_product;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($feature_product->product_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Product Id";
		}
		if (!ew_CheckInteger($feature_product->product_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Product Id";
		}
		if ($feature_product->sort_order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Sort Order";
		}
		if (!ew_CheckInteger($feature_product->sort_order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Sort Order";
		}
		if ($feature_product->status->FormValue == "") {
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
		global $conn, $Security, $feature_product;
		$sFilter = $feature_product->KeyFilter();
		$feature_product->CurrentFilter = $sFilter;
		$sSql = $feature_product->SQL();
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
			// Field product_id

			$feature_product->product_id->SetDbValueDef($feature_product->product_id->CurrentValue, 0);
			$rsnew['product_id'] =& $feature_product->product_id->DbValue;

			// Field sort_order
			$feature_product->sort_order->SetDbValueDef($feature_product->sort_order->CurrentValue, 0);
			$rsnew['sort_order'] =& $feature_product->sort_order->DbValue;

			// Field status
			$feature_product->status->SetDbValueDef($feature_product->status->CurrentValue, 0);
			$rsnew['status'] =& $feature_product->status->DbValue;

			// Call Row Updating event
			$bUpdateRow = $feature_product->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($feature_product->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($feature_product->CancelMessage <> "") {
					$this->setMessage($feature_product->CancelMessage);
					$feature_product->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$feature_product->Row_Updated($rsold, $rsnew);
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
