<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "countryinfo.php" ?>
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
$country_add = new ccountry_add();
$Page =& $country_add;

// Page init processing
$country_add->Page_Init();

// Page main processing
$country_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var country_add = new ew_Page("country_add");

// page properties
country_add.PageID = "add"; // page ID
var EW_PAGE_ID = country_add.PageID; // for backward compatibility

// extend page with ValidateForm function
country_add.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Status");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
country_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
country_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
country_add.ValidateRequired = false; // no JavaScript validation
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
<div align="center" class="msm_h1">Add to TABLE: Country</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $country->getReturnUrl() ?>">Go Back</a></span></p>
<?php $country_add->ShowMessage() ?>
<form name="fcountryadd" id="fcountryadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return country_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="country">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($country->name->Visible) { // name ?>
	<tr<?php echo $country->name->RowAttributes ?>>
		<td class="ewTableHeader">Name<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $country->name->CellAttributes() ?>><span id="el_name">
<input type="text" name="x_name" id="x_name" size="30" maxlength="200" value="<?php echo $country->name->EditValue ?>"<?php echo $country->name->EditAttributes() ?>>
</span><?php echo $country->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($country->status->Visible) { // status ?>
	<tr<?php echo $country->status->RowAttributes ?>>
		<td class="ewTableHeader">Status<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $country->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_status" id="x_status" value="{value}"<?php echo $country->status->EditAttributes() ?>></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $country->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($country->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $country->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $country->status->CustomMsg ?></td>
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
class ccountry_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'country';

	// Page Object Name
	var $PageObjName = 'country_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $country;
		if ($country->UseTokenInUrl) $PageUrl .= "t=" . $country->TableVar . "&"; // add page token
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
		global $objForm, $country;
		if ($country->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($country->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($country->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccountry_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["country"] = new ccountry();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'country', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $country;
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
		global $objForm, $gsFormError, $country;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $country->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $country->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$country->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $country->CurrentAction = "C"; // Copy Record
		  } else {
		    $country->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($country->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No records found"); // No record found
		      $this->Page_Terminate("countrylist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$country->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Add succeeded"); // Set up success message
					$sReturnUrl = $country->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$country->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $country;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $country;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $country;
		$country->name->setFormValue($objForm->GetValue("x_name"));
		$country->status->setFormValue($objForm->GetValue("x_status"));
		$country->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $country;
		$country->id->CurrentValue = $country->id->FormValue;
		$country->name->CurrentValue = $country->name->FormValue;
		$country->status->CurrentValue = $country->status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $country;
		$sFilter = $country->KeyFilter();

		// Call Row Selecting event
		$country->Row_Selecting($sFilter);

		// Load sql based on filter
		$country->CurrentFilter = $sFilter;
		$sSql = $country->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$country->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $country;
		$country->id->setDbValue($rs->fields('id'));
		$country->name->setDbValue($rs->fields('name'));
		$country->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $country;

		// Call Row_Rendering event
		$country->Row_Rendering();

		// Common render codes for all row types
		// name

		$country->name->CellCssStyle = "";
		$country->name->CellCssClass = "";

		// status
		$country->status->CellCssStyle = "";
		$country->status->CellCssClass = "";
		if ($country->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$country->id->ViewValue = $country->id->CurrentValue;
			$country->id->CssStyle = "";
			$country->id->CssClass = "";
			$country->id->ViewCustomAttributes = "";

			// name
			$country->name->ViewValue = $country->name->CurrentValue;
			$country->name->CssStyle = "";
			$country->name->CssClass = "";
			$country->name->ViewCustomAttributes = "";

			// status
			if (strval($country->status->CurrentValue) <> "") {
				switch ($country->status->CurrentValue) {
					case "1":
						$country->status->ViewValue = "Active";
						break;
					case "2":
						$country->status->ViewValue = "Not Active";
						break;
					default:
						$country->status->ViewValue = $country->status->CurrentValue;
				}
			} else {
				$country->status->ViewValue = NULL;
			}
			$country->status->CssStyle = "";
			$country->status->CssClass = "";
			$country->status->ViewCustomAttributes = "";

			// name
			$country->name->HrefValue = "";

			// status
			$country->status->HrefValue = "";
		} elseif ($country->RowType == EW_ROWTYPE_ADD) { // Add row

			// name
			$country->name->EditCustomAttributes = "";
			$country->name->EditValue = ew_HtmlEncode($country->name->CurrentValue);

			// status
			$country->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Active");
			$arwrk[] = array("2", "Not Active");
			$country->status->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$country->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $country;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($country->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Name";
		}
		if ($country->status->FormValue == "") {
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
		global $conn, $Security, $country;
		$rsnew = array();

		// Field name
		$country->name->SetDbValueDef($country->name->CurrentValue, "");
		$rsnew['name'] =& $country->name->DbValue;

		// Field status
		$country->status->SetDbValueDef($country->status->CurrentValue, 0);
		$rsnew['status'] =& $country->status->DbValue;

		// Call Row Inserting event
		$bInsertRow = $country->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($country->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($country->CancelMessage <> "") {
				$this->setMessage($country->CancelMessage);
				$country->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$country->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $country->id->DbValue;

			// Call Row Inserted event
			$country->Row_Inserted($rsnew);
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
