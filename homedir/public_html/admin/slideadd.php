<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "slideinfo.php" ?>
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
$slide_add = new cslide_add();
$Page =& $slide_add;

// Page init processing
$slide_add->Page_Init();

// Page main processing
$slide_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var slide_add = new ew_Page("slide_add");

// page properties
slide_add.PageID = "add"; // page ID
var EW_PAGE_ID = slide_add.PageID; // for backward compatibility

// extend page with ValidateForm function
slide_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_slide_photo"];
		aelm = fobj.elements["a" + infix + "_slide_photo"];
		var chk_slide_photo = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_slide_photo && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Slide Photo");
		elm = fobj.elements["x" + infix + "_slide_photo"];
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
slide_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
slide_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
slide_add.ValidateRequired = false; // no JavaScript validation
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
<div align="center" class="msm_h1">Add to TABLE: Slide</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $slide->getReturnUrl() ?>">Go Back</a></span></p>
<?php $slide_add->ShowMessage() ?>
<form name="fslideadd" id="fslideadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return slide_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="slide">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($slide->slide_photo->Visible) { // slide_photo ?>
	<tr<?php echo $slide->slide_photo->RowAttributes ?>>
		<td class="ewTableHeader">Slide Photo<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $slide->slide_photo->CellAttributes() ?>><span id="el_slide_photo">
<input type="file" name="x_slide_photo" id="x_slide_photo" size="30"<?php echo $slide->slide_photo->EditAttributes() ?>>
</div>
</span><?php echo $slide->slide_photo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($slide->sort_order->Visible) { // sort_order ?>
	<tr<?php echo $slide->sort_order->RowAttributes ?>>
		<td class="ewTableHeader">Sort Order<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $slide->sort_order->CellAttributes() ?>><span id="el_sort_order">
<input type="text" name="x_sort_order" id="x_sort_order" size="30" value="<?php echo $slide->sort_order->EditValue ?>"<?php echo $slide->sort_order->EditAttributes() ?>>
</span><?php echo $slide->sort_order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($slide->status->Visible) { // status ?>
	<tr<?php echo $slide->status->RowAttributes ?>>
		<td class="ewTableHeader">Status<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $slide->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_status" id="x_status" value="{value}"<?php echo $slide->status->EditAttributes() ?>></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $slide->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($slide->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $slide->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $slide->status->CustomMsg ?></td>
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
class cslide_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'slide';

	// Page Object Name
	var $PageObjName = 'slide_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $slide;
		if ($slide->UseTokenInUrl) $PageUrl .= "t=" . $slide->TableVar . "&"; // add page token
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
		global $objForm, $slide;
		if ($slide->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($slide->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($slide->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cslide_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["slide"] = new cslide();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'slide', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $slide;
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
		global $objForm, $gsFormError, $slide;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $slide->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $slide->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$slide->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $slide->CurrentAction = "C"; // Copy Record
		  } else {
		    $slide->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($slide->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No records found"); // No record found
		      $this->Page_Terminate("slidelist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$slide->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Add succeeded"); // Set up success message
					$sReturnUrl = $slide->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$slide->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $slide;

		// Get upload data
			if ($slide->slide_photo->Upload->UploadFile()) {

				// No action required
			} else {
				echo $slide->slide_photo->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $slide;
		$slide->slide_photo->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $slide;
		$slide->sort_order->setFormValue($objForm->GetValue("x_sort_order"));
		$slide->status->setFormValue($objForm->GetValue("x_status"));
		$slide->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $slide;
		$slide->id->CurrentValue = $slide->id->FormValue;
		$slide->sort_order->CurrentValue = $slide->sort_order->FormValue;
		$slide->status->CurrentValue = $slide->status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $slide;
		$sFilter = $slide->KeyFilter();

		// Call Row Selecting event
		$slide->Row_Selecting($sFilter);

		// Load sql based on filter
		$slide->CurrentFilter = $sFilter;
		$sSql = $slide->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$slide->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $slide;
		$slide->id->setDbValue($rs->fields('id'));
		$slide->slide_photo->Upload->DbValue = $rs->fields('slide_photo');
		$slide->sort_order->setDbValue($rs->fields('sort_order'));
		$slide->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $slide;

		// Call Row_Rendering event
		$slide->Row_Rendering();

		// Common render codes for all row types
		// slide_photo

		$slide->slide_photo->CellCssStyle = "";
		$slide->slide_photo->CellCssClass = "";

		// sort_order
		$slide->sort_order->CellCssStyle = "";
		$slide->sort_order->CellCssClass = "";

		// status
		$slide->status->CellCssStyle = "";
		$slide->status->CellCssClass = "";
		if ($slide->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$slide->id->ViewValue = $slide->id->CurrentValue;
			$slide->id->CssStyle = "";
			$slide->id->CssClass = "";
			$slide->id->ViewCustomAttributes = "";

			// slide_photo
			if (!is_null($slide->slide_photo->Upload->DbValue)) {
				$slide->slide_photo->ViewValue = $slide->slide_photo->Upload->DbValue;
				$slide->slide_photo->ImageWidth = 100;
				$slide->slide_photo->ImageHeight = 0;
				$slide->slide_photo->ImageAlt = "";
			} else {
				$slide->slide_photo->ViewValue = "";
			}
			$slide->slide_photo->CssStyle = "";
			$slide->slide_photo->CssClass = "";
			$slide->slide_photo->ViewCustomAttributes = "";

			// sort_order
			$slide->sort_order->ViewValue = $slide->sort_order->CurrentValue;
			$slide->sort_order->CssStyle = "";
			$slide->sort_order->CssClass = "";
			$slide->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($slide->status->CurrentValue) <> "") {
				switch ($slide->status->CurrentValue) {
					case "1":
						$slide->status->ViewValue = "Active";
						break;
					case "2":
						$slide->status->ViewValue = "Not Active";
						break;
					default:
						$slide->status->ViewValue = $slide->status->CurrentValue;
				}
			} else {
				$slide->status->ViewValue = NULL;
			}
			$slide->status->CssStyle = "";
			$slide->status->CssClass = "";
			$slide->status->ViewCustomAttributes = "";

			// slide_photo
			$slide->slide_photo->HrefValue = "";

			// sort_order
			$slide->sort_order->HrefValue = "";

			// status
			$slide->status->HrefValue = "";
		} elseif ($slide->RowType == EW_ROWTYPE_ADD) { // Add row

			// slide_photo
			$slide->slide_photo->EditCustomAttributes = "";
			if (!is_null($slide->slide_photo->Upload->DbValue)) {
				$slide->slide_photo->EditValue = $slide->slide_photo->Upload->DbValue;
				$slide->slide_photo->ImageWidth = 100;
				$slide->slide_photo->ImageHeight = 0;
				$slide->slide_photo->ImageAlt = "";
			} else {
				$slide->slide_photo->EditValue = "";
			}

			// sort_order
			$slide->sort_order->EditCustomAttributes = "";
			$slide->sort_order->EditValue = ew_HtmlEncode($slide->sort_order->CurrentValue);

			// status
			$slide->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Active");
			$arwrk[] = array("2", "Not Active");
			$slide->status->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$slide->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $slide;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($slide->slide_photo->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($slide->slide_photo->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($slide->slide_photo->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (is_null($slide->slide_photo->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Slide Photo";
		}
		if ($slide->sort_order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Sort Order";
		}
		if (!ew_CheckInteger($slide->sort_order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Sort Order";
		}
		if ($slide->status->FormValue == "") {
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
		global $conn, $Security, $slide;
		$rsnew = array();

		// Field slide_photo
		$slide->slide_photo->Upload->SaveToSession(); // Save file value to Session
		if (is_null($slide->slide_photo->Upload->Value)) {
			$rsnew['slide_photo'] = NULL;
		} else {
			$rsnew['slide_photo'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../upload/photo/"), $slide->slide_photo->Upload->FileName);
		}

		// Field sort_order
		$slide->sort_order->SetDbValueDef($slide->sort_order->CurrentValue, 0);
		$rsnew['sort_order'] =& $slide->sort_order->DbValue;

		// Field status
		$slide->status->SetDbValueDef($slide->status->CurrentValue, 0);
		$rsnew['status'] =& $slide->status->DbValue;

		// Call Row Inserting event
		$bInsertRow = $slide->Row_Inserting($rsnew);
		if ($bInsertRow) {

			// Field slide_photo
			if (!is_null($slide->slide_photo->Upload->Value)) {
				$slide->slide_photo->Upload->SaveToFile("../upload/photo/", $rsnew['slide_photo'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($slide->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($slide->CancelMessage <> "") {
				$this->setMessage($slide->CancelMessage);
				$slide->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$slide->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $slide->id->DbValue;

			// Call Row Inserted event
			$slide->Row_Inserted($rsnew);
		}

		// Field slide_photo
		$slide->slide_photo->Upload->RemoveFromSession(); // Remove file value from Session
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
