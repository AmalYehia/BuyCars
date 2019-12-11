<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "manufactureinfo.php" ?>
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
$manufacture_add = new cmanufacture_add();
$Page =& $manufacture_add;

// Page init processing
$manufacture_add->Page_Init();

// Page main processing
$manufacture_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var manufacture_add = new ew_Page("manufacture_add");

// page properties
manufacture_add.PageID = "add"; // page ID
var EW_PAGE_ID = manufacture_add.PageID; // for backward compatibility

// extend page with ValidateForm function
manufacture_add.ValidateForm = function(fobj) {
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
manufacture_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
manufacture_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
manufacture_add.ValidateRequired = false; // no JavaScript validation
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
<div align="center" class="msm_h1">Add to TABLE: Manufacture</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $manufacture->getReturnUrl() ?>">Go Back</a></span></p>
<?php $manufacture_add->ShowMessage() ?>
<form name="fmanufactureadd" id="fmanufactureadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return manufacture_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="manufacture">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($manufacture->name->Visible) { // name ?>
	<tr<?php echo $manufacture->name->RowAttributes ?>>
		<td class="ewTableHeader">Name<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $manufacture->name->CellAttributes() ?>><span id="el_name">
<input type="text" name="x_name" id="x_name" size="30" maxlength="200" value="<?php echo $manufacture->name->EditValue ?>"<?php echo $manufacture->name->EditAttributes() ?>>
</span><?php echo $manufacture->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($manufacture->logo->Visible) { // logo ?>
	<tr<?php echo $manufacture->logo->RowAttributes ?>>
		<td class="ewTableHeader">Logo</td>
		<td<?php echo $manufacture->logo->CellAttributes() ?>><span id="el_logo">
<input type="file" name="x_logo" id="x_logo" size="30"<?php echo $manufacture->logo->EditAttributes() ?>>
</div>
</span><?php echo $manufacture->logo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($manufacture->web_site->Visible) { // web_site ?>
	<tr<?php echo $manufacture->web_site->RowAttributes ?>>
		<td class="ewTableHeader">Web Site</td>
		<td<?php echo $manufacture->web_site->CellAttributes() ?>><span id="el_web_site">
<input type="text" name="x_web_site" id="x_web_site" size="30" maxlength="200" value="<?php echo $manufacture->web_site->EditValue ?>"<?php echo $manufacture->web_site->EditAttributes() ?>>
</span><?php echo $manufacture->web_site->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($manufacture->sort_order->Visible) { // sort_order ?>
	<tr<?php echo $manufacture->sort_order->RowAttributes ?>>
		<td class="ewTableHeader">Sort Order<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $manufacture->sort_order->CellAttributes() ?>><span id="el_sort_order">
<input type="text" name="x_sort_order" id="x_sort_order" size="30" value="<?php echo $manufacture->sort_order->EditValue ?>"<?php echo $manufacture->sort_order->EditAttributes() ?>>
</span><?php echo $manufacture->sort_order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($manufacture->status->Visible) { // status ?>
	<tr<?php echo $manufacture->status->RowAttributes ?>>
		<td class="ewTableHeader">Status<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $manufacture->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_status" id="x_status" value="{value}"<?php echo $manufacture->status->EditAttributes() ?>></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $manufacture->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($manufacture->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $manufacture->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $manufacture->status->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="    Add    ">
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
class cmanufacture_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'manufacture';

	// Page Object Name
	var $PageObjName = 'manufacture_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $manufacture;
		if ($manufacture->UseTokenInUrl) $PageUrl .= "t=" . $manufacture->TableVar . "&"; // add page token
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
		global $objForm, $manufacture;
		if ($manufacture->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($manufacture->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($manufacture->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmanufacture_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["manufacture"] = new cmanufacture();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'manufacture', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $manufacture;
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
	var $x_ewPriv = 0;

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $manufacture;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $manufacture->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $manufacture->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$manufacture->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $manufacture->CurrentAction = "C"; // Copy Record
		  } else {
		    $manufacture->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($manufacture->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No records found"); // No record found
		      $this->Page_Terminate("manufacturelist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$manufacture->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Add succeeded"); // Set up success message
					$sReturnUrl = $manufacture->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$manufacture->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $manufacture;

		// Get upload data
			if ($manufacture->logo->Upload->UploadFile()) {

				// No action required
			} else {
				echo $manufacture->logo->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $manufacture;
		$manufacture->logo->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $manufacture;
		$manufacture->name->setFormValue($objForm->GetValue("x_name"));
		$manufacture->web_site->setFormValue($objForm->GetValue("x_web_site"));
		$manufacture->sort_order->setFormValue($objForm->GetValue("x_sort_order"));
		$manufacture->status->setFormValue($objForm->GetValue("x_status"));
		$manufacture->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $manufacture;
		$manufacture->id->CurrentValue = $manufacture->id->FormValue;
		$manufacture->name->CurrentValue = $manufacture->name->FormValue;
		$manufacture->web_site->CurrentValue = $manufacture->web_site->FormValue;
		$manufacture->sort_order->CurrentValue = $manufacture->sort_order->FormValue;
		$manufacture->status->CurrentValue = $manufacture->status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $manufacture;
		$sFilter = $manufacture->KeyFilter();

		// Call Row Selecting event
		$manufacture->Row_Selecting($sFilter);

		// Load sql based on filter
		$manufacture->CurrentFilter = $sFilter;
		$sSql = $manufacture->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$manufacture->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $manufacture;
		$manufacture->id->setDbValue($rs->fields('id'));
		$manufacture->name->setDbValue($rs->fields('name'));
		$manufacture->logo->Upload->DbValue = $rs->fields('logo');
		$manufacture->web_site->setDbValue($rs->fields('web_site'));
		$manufacture->sort_order->setDbValue($rs->fields('sort_order'));
		$manufacture->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $manufacture;

		// Call Row_Rendering event
		$manufacture->Row_Rendering();

		// Common render codes for all row types
		// name

		$manufacture->name->CellCssStyle = "";
		$manufacture->name->CellCssClass = "";

		// logo
		$manufacture->logo->CellCssStyle = "";
		$manufacture->logo->CellCssClass = "";

		// web_site
		$manufacture->web_site->CellCssStyle = "";
		$manufacture->web_site->CellCssClass = "";

		// sort_order
		$manufacture->sort_order->CellCssStyle = "";
		$manufacture->sort_order->CellCssClass = "";

		// status
		$manufacture->status->CellCssStyle = "";
		$manufacture->status->CellCssClass = "";
		if ($manufacture->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$manufacture->id->ViewValue = $manufacture->id->CurrentValue;
			$manufacture->id->CssStyle = "";
			$manufacture->id->CssClass = "";
			$manufacture->id->ViewCustomAttributes = "";

			// name
			$manufacture->name->ViewValue = $manufacture->name->CurrentValue;
			$manufacture->name->CssStyle = "";
			$manufacture->name->CssClass = "";
			$manufacture->name->ViewCustomAttributes = "";

			// logo
			if (!is_null($manufacture->logo->Upload->DbValue)) {
				$manufacture->logo->ViewValue = $manufacture->logo->Upload->DbValue;
				$manufacture->logo->ImageWidth = 100;
				$manufacture->logo->ImageHeight = 0;
				$manufacture->logo->ImageAlt = "";
			} else {
				$manufacture->logo->ViewValue = "";
			}
			$manufacture->logo->CssStyle = "";
			$manufacture->logo->CssClass = "";
			$manufacture->logo->ViewCustomAttributes = "";

			// web_site
			$manufacture->web_site->ViewValue = $manufacture->web_site->CurrentValue;
			$manufacture->web_site->CssStyle = "";
			$manufacture->web_site->CssClass = "";
			$manufacture->web_site->ViewCustomAttributes = "";

			// sort_order
			$manufacture->sort_order->ViewValue = $manufacture->sort_order->CurrentValue;
			$manufacture->sort_order->CssStyle = "";
			$manufacture->sort_order->CssClass = "";
			$manufacture->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($manufacture->status->CurrentValue) <> "") {
				switch ($manufacture->status->CurrentValue) {
					case "1":
						$manufacture->status->ViewValue = "Active";
						break;
					case "2":
						$manufacture->status->ViewValue = "Not Active";
						break;
					default:
						$manufacture->status->ViewValue = $manufacture->status->CurrentValue;
				}
			} else {
				$manufacture->status->ViewValue = NULL;
			}
			$manufacture->status->CssStyle = "";
			$manufacture->status->CssClass = "";
			$manufacture->status->ViewCustomAttributes = "";

			// name
			$manufacture->name->HrefValue = "";

			// logo
			$manufacture->logo->HrefValue = "";

			// web_site
			$manufacture->web_site->HrefValue = "";

			// sort_order
			$manufacture->sort_order->HrefValue = "";

			// status
			$manufacture->status->HrefValue = "";
		} elseif ($manufacture->RowType == EW_ROWTYPE_ADD) { // Add row

			// name
			$manufacture->name->EditCustomAttributes = "";
			$manufacture->name->EditValue = ew_HtmlEncode($manufacture->name->CurrentValue);

			// logo
			$manufacture->logo->EditCustomAttributes = "";
			if (!is_null($manufacture->logo->Upload->DbValue)) {
				$manufacture->logo->EditValue = $manufacture->logo->Upload->DbValue;
				$manufacture->logo->ImageWidth = 100;
				$manufacture->logo->ImageHeight = 0;
				$manufacture->logo->ImageAlt = "";
			} else {
				$manufacture->logo->EditValue = "";
			}

			// web_site
			$manufacture->web_site->EditCustomAttributes = "";
			$manufacture->web_site->EditValue = ew_HtmlEncode($manufacture->web_site->CurrentValue);

			// sort_order
			$manufacture->sort_order->EditCustomAttributes = "";
			$manufacture->sort_order->EditValue = ew_HtmlEncode($manufacture->sort_order->CurrentValue);

			// status
			$manufacture->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Active");
			$arwrk[] = array("2", "Not Active");
			$manufacture->status->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$manufacture->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $manufacture;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($manufacture->logo->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($manufacture->logo->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($manufacture->logo->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($manufacture->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Name";
		}
		if ($manufacture->sort_order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Sort Order";
		}
		if (!ew_CheckInteger($manufacture->sort_order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Sort Order";
		}
		if ($manufacture->status->FormValue == "") {
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

	// Add record
	function AddRow() {
		global $conn, $Security, $manufacture;
		$rsnew = array();

		// Field name
		$manufacture->name->SetDbValueDef($manufacture->name->CurrentValue, "");
		$rsnew['name'] =& $manufacture->name->DbValue;

		// Field logo
		$manufacture->logo->Upload->SaveToSession(); // Save file value to Session
		if (is_null($manufacture->logo->Upload->Value)) {
			$rsnew['logo'] = NULL;
		} else {
			$rsnew['logo'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../upload/image/"), $manufacture->logo->Upload->FileName);
		}

		// Field web_site
		$manufacture->web_site->SetDbValueDef($manufacture->web_site->CurrentValue, NULL);
		$rsnew['web_site'] =& $manufacture->web_site->DbValue;

		// Field sort_order
		$manufacture->sort_order->SetDbValueDef($manufacture->sort_order->CurrentValue, 0);
		$rsnew['sort_order'] =& $manufacture->sort_order->DbValue;

		// Field status
		$manufacture->status->SetDbValueDef($manufacture->status->CurrentValue, 0);
		$rsnew['status'] =& $manufacture->status->DbValue;

		// Call Row Inserting event
		$bInsertRow = $manufacture->Row_Inserting($rsnew);
		if ($bInsertRow) {

			// Field logo
			if (!is_null($manufacture->logo->Upload->Value)) {
				$manufacture->logo->Upload->SaveToFile("../upload/image/", $rsnew['logo'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($manufacture->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($manufacture->CancelMessage <> "") {
				$this->setMessage($manufacture->CancelMessage);
				$manufacture->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$manufacture->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $manufacture->id->DbValue;

			// Call Row Inserted event
			$manufacture->Row_Inserted($rsnew);
		}

		// Field logo
		$manufacture->logo->Upload->RemoveFromSession(); // Remove file value from Session
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
