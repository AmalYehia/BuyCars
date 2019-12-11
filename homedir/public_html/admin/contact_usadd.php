<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "contact_usinfo.php" ?>
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
$contact_us_add = new ccontact_us_add();
$Page =& $contact_us_add;

// Page init processing
$contact_us_add->Page_Init();

// Page main processing
$contact_us_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var contact_us_add = new ew_Page("contact_us_add");

// page properties
contact_us_add.PageID = "add"; // page ID
var EW_PAGE_ID = contact_us_add.PageID; // for backward compatibility

// extend page with ValidateForm function
contact_us_add.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_email"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Email");
		elm = fobj.elements["x" + infix + "_subject"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Subject");
		elm = fobj.elements["x" + infix + "_message"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Message");
		elm = fobj.elements["x" + infix + "_receive_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Receive Date");
		elm = fobj.elements["x" + infix + "_receive_date"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "Incorrect date, format = yyyy/mm/dd - Receive Date");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
contact_us_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
contact_us_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
contact_us_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
contact_us_add.ShowHighlightText = "Show highlight"; 
contact_us_add.HideHighlightText = "Hide highlight";

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

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
<div align="center" class="msm_h1">Add to TABLE: Contact Us</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $contact_us->getReturnUrl() ?>">Go Back</a></span></p>
<?php $contact_us_add->ShowMessage() ?>
<form name="fcontact_usadd" id="fcontact_usadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return contact_us_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="contact_us">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($contact_us->name->Visible) { // name ?>
	<tr<?php echo $contact_us->name->RowAttributes ?>>
		<td class="ewTableHeader">Name<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $contact_us->name->CellAttributes() ?>><span id="el_name">
<input type="text" name="x_name" id="x_name" size="30" maxlength="100" value="<?php echo $contact_us->name->EditValue ?>"<?php echo $contact_us->name->EditAttributes() ?>>
</span><?php echo $contact_us->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($contact_us->email->Visible) { // email ?>
	<tr<?php echo $contact_us->email->RowAttributes ?>>
		<td class="ewTableHeader">Email<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $contact_us->email->CellAttributes() ?>><span id="el_email">
<input type="text" name="x_email" id="x_email" size="30" maxlength="100" value="<?php echo $contact_us->email->EditValue ?>"<?php echo $contact_us->email->EditAttributes() ?>>
</span><?php echo $contact_us->email->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($contact_us->phone->Visible) { // phone ?>
	<tr<?php echo $contact_us->phone->RowAttributes ?>>
		<td class="ewTableHeader">Phone</td>
		<td<?php echo $contact_us->phone->CellAttributes() ?>><span id="el_phone">
<input type="text" name="x_phone" id="x_phone" size="30" maxlength="100" value="<?php echo $contact_us->phone->EditValue ?>"<?php echo $contact_us->phone->EditAttributes() ?>>
</span><?php echo $contact_us->phone->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($contact_us->subject->Visible) { // subject ?>
	<tr<?php echo $contact_us->subject->RowAttributes ?>>
		<td class="ewTableHeader">Subject<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $contact_us->subject->CellAttributes() ?>><span id="el_subject">
<input type="text" name="x_subject" id="x_subject" size="30" maxlength="200" value="<?php echo $contact_us->subject->EditValue ?>"<?php echo $contact_us->subject->EditAttributes() ?>>
</span><?php echo $contact_us->subject->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($contact_us->message->Visible) { // message ?>
	<tr<?php echo $contact_us->message->RowAttributes ?>>
		<td class="ewTableHeader">Message<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $contact_us->message->CellAttributes() ?>><span id="el_message">
<textarea name="x_message" id="x_message" cols="35" rows="4"<?php echo $contact_us->message->EditAttributes() ?>><?php echo $contact_us->message->EditValue ?></textarea>
</span><?php echo $contact_us->message->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($contact_us->receive_date->Visible) { // receive_date ?>
	<tr<?php echo $contact_us->receive_date->RowAttributes ?>>
		<td class="ewTableHeader">Receive Date<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $contact_us->receive_date->CellAttributes() ?>><span id="el_receive_date">
<input type="text" name="x_receive_date" id="x_receive_date" value="<?php echo $contact_us->receive_date->EditValue ?>"<?php echo $contact_us->receive_date->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_receive_date" name="cal_x_receive_date" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_receive_date", // ID of the input field
	ifFormat : "%Y/%m/%d", // the date format
	button : "cal_x_receive_date" // ID of the button
});
</script>
</span><?php echo $contact_us->receive_date->CustomMsg ?></td>
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
class ccontact_us_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'contact_us';

	// Page Object Name
	var $PageObjName = 'contact_us_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $contact_us;
		if ($contact_us->UseTokenInUrl) $PageUrl .= "t=" . $contact_us->TableVar . "&"; // add page token
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
		global $objForm, $contact_us;
		if ($contact_us->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($contact_us->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($contact_us->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccontact_us_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["contact_us"] = new ccontact_us();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'contact_us', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $contact_us;
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
		global $objForm, $gsFormError, $contact_us;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $contact_us->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $contact_us->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$contact_us->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $contact_us->CurrentAction = "C"; // Copy Record
		  } else {
		    $contact_us->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($contact_us->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No records found"); // No record found
		      $this->Page_Terminate("contact_uslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$contact_us->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Add succeeded"); // Set up success message
					$sReturnUrl = $contact_us->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$contact_us->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $contact_us;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $contact_us;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $contact_us;
		$contact_us->name->setFormValue($objForm->GetValue("x_name"));
		$contact_us->email->setFormValue($objForm->GetValue("x_email"));
		$contact_us->phone->setFormValue($objForm->GetValue("x_phone"));
		$contact_us->subject->setFormValue($objForm->GetValue("x_subject"));
		$contact_us->message->setFormValue($objForm->GetValue("x_message"));
		$contact_us->receive_date->setFormValue($objForm->GetValue("x_receive_date"));
		$contact_us->receive_date->CurrentValue = ew_UnFormatDateTime($contact_us->receive_date->CurrentValue, 5);
		$contact_us->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $contact_us;
		$contact_us->id->CurrentValue = $contact_us->id->FormValue;
		$contact_us->name->CurrentValue = $contact_us->name->FormValue;
		$contact_us->email->CurrentValue = $contact_us->email->FormValue;
		$contact_us->phone->CurrentValue = $contact_us->phone->FormValue;
		$contact_us->subject->CurrentValue = $contact_us->subject->FormValue;
		$contact_us->message->CurrentValue = $contact_us->message->FormValue;
		$contact_us->receive_date->CurrentValue = $contact_us->receive_date->FormValue;
		$contact_us->receive_date->CurrentValue = ew_UnFormatDateTime($contact_us->receive_date->CurrentValue, 5);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $contact_us;
		$sFilter = $contact_us->KeyFilter();

		// Call Row Selecting event
		$contact_us->Row_Selecting($sFilter);

		// Load sql based on filter
		$contact_us->CurrentFilter = $sFilter;
		$sSql = $contact_us->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$contact_us->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $contact_us;
		$contact_us->id->setDbValue($rs->fields('id'));
		$contact_us->name->setDbValue($rs->fields('name'));
		$contact_us->email->setDbValue($rs->fields('email'));
		$contact_us->phone->setDbValue($rs->fields('phone'));
		$contact_us->subject->setDbValue($rs->fields('subject'));
		$contact_us->message->setDbValue($rs->fields('message'));
		$contact_us->receive_date->setDbValue($rs->fields('receive_date'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $contact_us;

		// Call Row_Rendering event
		$contact_us->Row_Rendering();

		// Common render codes for all row types
		// name

		$contact_us->name->CellCssStyle = "";
		$contact_us->name->CellCssClass = "";

		// email
		$contact_us->email->CellCssStyle = "";
		$contact_us->email->CellCssClass = "";

		// phone
		$contact_us->phone->CellCssStyle = "";
		$contact_us->phone->CellCssClass = "";

		// subject
		$contact_us->subject->CellCssStyle = "";
		$contact_us->subject->CellCssClass = "";

		// message
		$contact_us->message->CellCssStyle = "";
		$contact_us->message->CellCssClass = "";

		// receive_date
		$contact_us->receive_date->CellCssStyle = "";
		$contact_us->receive_date->CellCssClass = "";
		if ($contact_us->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$contact_us->id->ViewValue = $contact_us->id->CurrentValue;
			$contact_us->id->CssStyle = "";
			$contact_us->id->CssClass = "";
			$contact_us->id->ViewCustomAttributes = "";

			// name
			$contact_us->name->ViewValue = $contact_us->name->CurrentValue;
			$contact_us->name->CssStyle = "";
			$contact_us->name->CssClass = "";
			$contact_us->name->ViewCustomAttributes = "";

			// email
			$contact_us->email->ViewValue = $contact_us->email->CurrentValue;
			$contact_us->email->CssStyle = "";
			$contact_us->email->CssClass = "";
			$contact_us->email->ViewCustomAttributes = "";

			// phone
			$contact_us->phone->ViewValue = $contact_us->phone->CurrentValue;
			$contact_us->phone->CssStyle = "";
			$contact_us->phone->CssClass = "";
			$contact_us->phone->ViewCustomAttributes = "";

			// subject
			$contact_us->subject->ViewValue = $contact_us->subject->CurrentValue;
			$contact_us->subject->CssStyle = "";
			$contact_us->subject->CssClass = "";
			$contact_us->subject->ViewCustomAttributes = "";

			// message
			$contact_us->message->ViewValue = $contact_us->message->CurrentValue;
			$contact_us->message->CssStyle = "";
			$contact_us->message->CssClass = "";
			$contact_us->message->ViewCustomAttributes = "";

			// receive_date
			$contact_us->receive_date->ViewValue = $contact_us->receive_date->CurrentValue;
			$contact_us->receive_date->ViewValue = ew_FormatDateTime($contact_us->receive_date->ViewValue, 5);
			$contact_us->receive_date->CssStyle = "";
			$contact_us->receive_date->CssClass = "";
			$contact_us->receive_date->ViewCustomAttributes = "";

			// name
			$contact_us->name->HrefValue = "";

			// email
			$contact_us->email->HrefValue = "";

			// phone
			$contact_us->phone->HrefValue = "";

			// subject
			$contact_us->subject->HrefValue = "";

			// message
			$contact_us->message->HrefValue = "";

			// receive_date
			$contact_us->receive_date->HrefValue = "";
		} elseif ($contact_us->RowType == EW_ROWTYPE_ADD) { // Add row

			// name
			$contact_us->name->EditCustomAttributes = "";
			$contact_us->name->EditValue = ew_HtmlEncode($contact_us->name->CurrentValue);

			// email
			$contact_us->email->EditCustomAttributes = "";
			$contact_us->email->EditValue = ew_HtmlEncode($contact_us->email->CurrentValue);

			// phone
			$contact_us->phone->EditCustomAttributes = "";
			$contact_us->phone->EditValue = ew_HtmlEncode($contact_us->phone->CurrentValue);

			// subject
			$contact_us->subject->EditCustomAttributes = "";
			$contact_us->subject->EditValue = ew_HtmlEncode($contact_us->subject->CurrentValue);

			// message
			$contact_us->message->EditCustomAttributes = "";
			$contact_us->message->EditValue = ew_HtmlEncode($contact_us->message->CurrentValue);

			// receive_date
			$contact_us->receive_date->EditCustomAttributes = "";
			$contact_us->receive_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($contact_us->receive_date->CurrentValue, 5));
		}

		// Call Row Rendered event
		$contact_us->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $contact_us;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($contact_us->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Name";
		}
		if ($contact_us->email->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Email";
		}
		if ($contact_us->subject->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Subject";
		}
		if ($contact_us->message->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Message";
		}
		if ($contact_us->receive_date->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Receive Date";
		}
		if (!ew_CheckDate($contact_us->receive_date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect date, format = yyyy/mm/dd - Receive Date";
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
		global $conn, $Security, $contact_us;
		$rsnew = array();

		// Field name
		$contact_us->name->SetDbValueDef($contact_us->name->CurrentValue, "");
		$rsnew['name'] =& $contact_us->name->DbValue;

		// Field email
		$contact_us->email->SetDbValueDef($contact_us->email->CurrentValue, "");
		$rsnew['email'] =& $contact_us->email->DbValue;

		// Field phone
		$contact_us->phone->SetDbValueDef($contact_us->phone->CurrentValue, NULL);
		$rsnew['phone'] =& $contact_us->phone->DbValue;

		// Field subject
		$contact_us->subject->SetDbValueDef($contact_us->subject->CurrentValue, "");
		$rsnew['subject'] =& $contact_us->subject->DbValue;

		// Field message
		$contact_us->message->SetDbValueDef($contact_us->message->CurrentValue, "");
		$rsnew['message'] =& $contact_us->message->DbValue;

		// Field receive_date
		$contact_us->receive_date->SetDbValueDef(ew_UnFormatDateTime($contact_us->receive_date->CurrentValue, 5), ew_CurrentDate());
		$rsnew['receive_date'] =& $contact_us->receive_date->DbValue;

		// Call Row Inserting event
		$bInsertRow = $contact_us->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($contact_us->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($contact_us->CancelMessage <> "") {
				$this->setMessage($contact_us->CancelMessage);
				$contact_us->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$contact_us->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $contact_us->id->DbValue;

			// Call Row Inserted event
			$contact_us->Row_Inserted($rsnew);
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
