<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "advertiseinfo.php" ?>
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
$advertise_add = new cadvertise_add();
$Page =& $advertise_add;

// Page init processing
$advertise_add->Page_Init();

// Page main processing
$advertise_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var advertise_add = new ew_Page("advertise_add");

// page properties
advertise_add.PageID = "add"; // page ID
var EW_PAGE_ID = advertise_add.PageID; // for backward compatibility

// extend page with ValidateForm function
advertise_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_adv"];
		aelm = fobj.elements["a" + infix + "_adv"];
		var chk_adv = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_adv && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Adv");
		elm = fobj.elements["x" + infix + "_adv"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "File type is not allowed.");
		elm = fobj.elements["x" + infix + "_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Status");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
advertise_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
advertise_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
advertise_add.ValidateRequired = false; // no JavaScript validation
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
<div align="center" class="msm_h1">Add to TABLE: Advertise</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $advertise->getReturnUrl() ?>">Go Back</a></span></p>
<?php $advertise_add->ShowMessage() ?>
<form name="fadvertiseadd" id="fadvertiseadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return advertise_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="advertise">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($advertise->adv->Visible) { // adv ?>
	<tr<?php echo $advertise->adv->RowAttributes ?>>
		<td class="ewTableHeader">Adv<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $advertise->adv->CellAttributes() ?>><span id="el_adv">
<input type="file" name="x_adv" id="x_adv" size="30"<?php echo $advertise->adv->EditAttributes() ?>>
</div>
</span><?php echo $advertise->adv->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($advertise->status->Visible) { // status ?>
	<tr<?php echo $advertise->status->RowAttributes ?>>
		<td class="ewTableHeader">Status<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $advertise->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_status" id="x_status" value="{value}"<?php echo $advertise->status->EditAttributes() ?>></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $advertise->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($advertise->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $advertise->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $advertise->status->CustomMsg ?></td>
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
class cadvertise_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'advertise';

	// Page Object Name
	var $PageObjName = 'advertise_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $advertise;
		if ($advertise->UseTokenInUrl) $PageUrl .= "t=" . $advertise->TableVar . "&"; // add page token
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
		global $objForm, $advertise;
		if ($advertise->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($advertise->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($advertise->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cadvertise_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["advertise"] = new cadvertise();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'advertise', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $advertise;
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
		global $objForm, $gsFormError, $advertise;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $advertise->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $advertise->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$advertise->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $advertise->CurrentAction = "C"; // Copy Record
		  } else {
		    $advertise->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($advertise->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No records found"); // No record found
		      $this->Page_Terminate("advertiselist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$advertise->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Add succeeded"); // Set up success message
					$sReturnUrl = $advertise->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$advertise->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $advertise;

		// Get upload data
			if ($advertise->adv->Upload->UploadFile()) {

				// No action required
			} else {
				echo $advertise->adv->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $advertise;
		$advertise->adv->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $advertise;
		$advertise->status->setFormValue($objForm->GetValue("x_status"));
		$advertise->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $advertise;
		$advertise->id->CurrentValue = $advertise->id->FormValue;
		$advertise->status->CurrentValue = $advertise->status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $advertise;
		$sFilter = $advertise->KeyFilter();

		// Call Row Selecting event
		$advertise->Row_Selecting($sFilter);

		// Load sql based on filter
		$advertise->CurrentFilter = $sFilter;
		$sSql = $advertise->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$advertise->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $advertise;
		$advertise->id->setDbValue($rs->fields('id'));
		$advertise->adv->Upload->DbValue = $rs->fields('adv');
		$advertise->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $advertise;

		// Call Row_Rendering event
		$advertise->Row_Rendering();

		// Common render codes for all row types
		// adv

		$advertise->adv->CellCssStyle = "";
		$advertise->adv->CellCssClass = "";

		// status
		$advertise->status->CellCssStyle = "";
		$advertise->status->CellCssClass = "";
		if ($advertise->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$advertise->id->ViewValue = $advertise->id->CurrentValue;
			$advertise->id->CssStyle = "";
			$advertise->id->CssClass = "";
			$advertise->id->ViewCustomAttributes = "";

			// adv
			if (!is_null($advertise->adv->Upload->DbValue)) {
				$advertise->adv->ViewValue = $advertise->adv->Upload->DbValue;
				$advertise->adv->ImageWidth = 200;
				$advertise->adv->ImageHeight = 0;
				$advertise->adv->ImageAlt = "";
			} else {
				$advertise->adv->ViewValue = "";
			}
			$advertise->adv->CssStyle = "";
			$advertise->adv->CssClass = "";
			$advertise->adv->ViewCustomAttributes = "";

			// status
			if (strval($advertise->status->CurrentValue) <> "") {
				switch ($advertise->status->CurrentValue) {
					case "1":
						$advertise->status->ViewValue = "Active";
						break;
					case "2":
						$advertise->status->ViewValue = "Not Active";
						break;
					default:
						$advertise->status->ViewValue = $advertise->status->CurrentValue;
				}
			} else {
				$advertise->status->ViewValue = NULL;
			}
			$advertise->status->CssStyle = "";
			$advertise->status->CssClass = "";
			$advertise->status->ViewCustomAttributes = "";

			// adv
			$advertise->adv->HrefValue = "";

			// status
			$advertise->status->HrefValue = "";
		} elseif ($advertise->RowType == EW_ROWTYPE_ADD) { // Add row

			// adv
			$advertise->adv->EditCustomAttributes = "";
			if (!is_null($advertise->adv->Upload->DbValue)) {
				$advertise->adv->EditValue = $advertise->adv->Upload->DbValue;
				$advertise->adv->ImageWidth = 200;
				$advertise->adv->ImageHeight = 0;
				$advertise->adv->ImageAlt = "";
			} else {
				$advertise->adv->EditValue = "";
			}

			// status
			$advertise->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Active");
			$arwrk[] = array("2", "Not Active");
			$advertise->status->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$advertise->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $advertise;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($advertise->adv->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($advertise->adv->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($advertise->adv->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (is_null($advertise->adv->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Adv";
		}
		if ($advertise->status->FormValue == "") {
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
		global $conn, $Security, $advertise;
		$rsnew = array();

		// Field adv
		$advertise->adv->Upload->SaveToSession(); // Save file value to Session
		if (is_null($advertise->adv->Upload->Value)) {
			$rsnew['adv'] = NULL;
		} else {
			$rsnew['adv'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../upload/photo/"), $advertise->adv->Upload->FileName);
		}

		// Field status
		$advertise->status->SetDbValueDef($advertise->status->CurrentValue, 0);
		$rsnew['status'] =& $advertise->status->DbValue;

		// Call Row Inserting event
		$bInsertRow = $advertise->Row_Inserting($rsnew);
		if ($bInsertRow) {

			// Field adv
			if (!is_null($advertise->adv->Upload->Value)) {
				$advertise->adv->Upload->SaveToFile("../upload/photo/", $rsnew['adv'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($advertise->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($advertise->CancelMessage <> "") {
				$this->setMessage($advertise->CancelMessage);
				$advertise->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$advertise->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $advertise->id->DbValue;

			// Call Row Inserted event
			$advertise->Row_Inserted($rsnew);
		}

		// Field adv
		$advertise->adv->Upload->RemoveFromSession(); // Remove file value from Session
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
