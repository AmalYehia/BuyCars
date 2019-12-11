<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "customerinfo.php" ?>
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
$customer_edit = new ccustomer_edit();
$Page =& $customer_edit;

// Page init processing
$customer_edit->Page_Init();

// Page main processing
$customer_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var customer_edit = new ew_Page("customer_edit");

// page properties
customer_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = customer_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
customer_edit.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Name");
		elm = fobj.elements["x" + infix + "_email"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Email");
		elm = fobj.elements["x" + infix + "_country"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - Country");
		elm = fobj.elements["x" + infix + "_date_lastlogin"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "Incorrect date, format = yyyy/mm/dd - Date Lastlogin");
		elm = fobj.elements["x" + infix + "_date_register"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Date Register");
		elm = fobj.elements["x" + infix + "_date_register"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "Incorrect date, format = yyyy/mm/dd - Date Register");
		elm = fobj.elements["x" + infix + "_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Status");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
customer_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
customer_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
customer_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
customer_edit.ShowHighlightText = "Show highlight"; 
customer_edit.HideHighlightText = "Hide highlight";

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
<div align="center" class="msm_h1">Edit TABLE: Customer</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $customer->getReturnUrl() ?>">Go Back</a></span></p>
<?php $customer_edit->ShowMessage() ?>
<form name="fcustomeredit" id="fcustomeredit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return customer_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="customer">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($customer->id->Visible) { // id ?>
	<tr<?php echo $customer->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $customer->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $customer->id->ViewAttributes() ?>><?php echo $customer->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($customer->id->CurrentValue) ?>">
</span><?php echo $customer->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customer->user_name->Visible) { // user_name ?>
	<tr<?php echo $customer->user_name->RowAttributes ?>>
		<td class="ewTableHeader">User Name<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $customer->user_name->CellAttributes() ?>><span id="el_user_name">
<input type="text" name="x_user_name" id="x_user_name" size="30" maxlength="200" value="<?php echo $customer->user_name->EditValue ?>"<?php echo $customer->user_name->EditAttributes() ?>>
</span><?php echo $customer->user_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customer->password->Visible) { // password ?>
	<tr<?php echo $customer->password->RowAttributes ?>>
		<td class="ewTableHeader">Password<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $customer->password->CellAttributes() ?>><span id="el_password">
<input type="text" name="x_password" id="x_password" size="30" maxlength="100" value="<?php echo $customer->password->EditValue ?>"<?php echo $customer->password->EditAttributes() ?>>
</span><?php echo $customer->password->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customer->name->Visible) { // name ?>
	<tr<?php echo $customer->name->RowAttributes ?>>
		<td class="ewTableHeader">Name<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $customer->name->CellAttributes() ?>><span id="el_name">
<input type="text" name="x_name" id="x_name" size="30" maxlength="200" value="<?php echo $customer->name->EditValue ?>"<?php echo $customer->name->EditAttributes() ?>>
</span><?php echo $customer->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customer->email->Visible) { // email ?>
	<tr<?php echo $customer->email->RowAttributes ?>>
		<td class="ewTableHeader">Email<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $customer->email->CellAttributes() ?>><span id="el_email">
<input type="text" name="x_email" id="x_email" size="30" maxlength="100" value="<?php echo $customer->email->EditValue ?>"<?php echo $customer->email->EditAttributes() ?>>
</span><?php echo $customer->email->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customer->phone->Visible) { // phone ?>
	<tr<?php echo $customer->phone->RowAttributes ?>>
		<td class="ewTableHeader">Phone</td>
		<td<?php echo $customer->phone->CellAttributes() ?>><span id="el_phone">
<input type="text" name="x_phone" id="x_phone" size="30" maxlength="200" value="<?php echo $customer->phone->EditValue ?>"<?php echo $customer->phone->EditAttributes() ?>>
</span><?php echo $customer->phone->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customer->mobile->Visible) { // mobile ?>
	<tr<?php echo $customer->mobile->RowAttributes ?>>
		<td class="ewTableHeader">Mobile<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $customer->mobile->CellAttributes() ?>><span id="el_mobile">
<input type="text" name="x_mobile" id="x_mobile" size="30" maxlength="250" value="<?php echo $customer->mobile->EditValue ?>"<?php echo $customer->mobile->EditAttributes() ?>>
</span><?php echo $customer->mobile->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customer->country->Visible) { // country ?>
	<tr<?php echo $customer->country->RowAttributes ?>>
		<td class="ewTableHeader">Country<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $customer->country->CellAttributes() ?>><span id="el_country">
<input type="text" name="x_country" id="x_country" size="30" value="<?php echo $customer->country->EditValue ?>"<?php echo $customer->country->EditAttributes() ?>>
</span><?php echo $customer->country->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customer->address->Visible) { // address ?>
	<tr<?php echo $customer->address->RowAttributes ?>>
		<td class="ewTableHeader">Address</td>
		<td<?php echo $customer->address->CellAttributes() ?>><span id="el_address">
<textarea name="x_address" id="x_address" cols="35" rows="4"<?php echo $customer->address->EditAttributes() ?>><?php echo $customer->address->EditValue ?></textarea>
</span><?php echo $customer->address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customer->date_lastlogin->Visible) { // date_lastlogin ?>
	<tr<?php echo $customer->date_lastlogin->RowAttributes ?>>
		<td class="ewTableHeader">Date Lastlogin<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $customer->date_lastlogin->CellAttributes() ?>><span id="el_date_lastlogin">
<input type="text" name="x_date_lastlogin" id="x_date_lastlogin" value="<?php echo $customer->date_lastlogin->EditValue ?>"<?php echo $customer->date_lastlogin->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_date_lastlogin" name="cal_x_date_lastlogin" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_date_lastlogin", // ID of the input field
	ifFormat : "%Y/%m/%d", // the date format
	button : "cal_x_date_lastlogin" // ID of the button
});
</script>
</span><?php echo $customer->date_lastlogin->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customer->date_register->Visible) { // date_register ?>
	<tr<?php echo $customer->date_register->RowAttributes ?>>
		<td class="ewTableHeader">Date Register<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $customer->date_register->CellAttributes() ?>><span id="el_date_register">
<input type="text" name="x_date_register" id="x_date_register" value="<?php echo $customer->date_register->EditValue ?>"<?php echo $customer->date_register->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_date_register" name="cal_x_date_register" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_date_register", // ID of the input field
	ifFormat : "%Y/%m/%d", // the date format
	button : "cal_x_date_register" // ID of the button
});
</script>
</span><?php echo $customer->date_register->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($customer->status->Visible) { // status ?>
	<tr<?php echo $customer->status->RowAttributes ?>>
		<td class="ewTableHeader">Status<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $customer->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_status" id="x_status" value="{value}"<?php echo $customer->status->EditAttributes() ?>></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $customer->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($customer->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $customer->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $customer->status->CustomMsg ?></td>
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
class ccustomer_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'customer';

	// Page Object Name
	var $PageObjName = 'customer_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $customer;
		if ($customer->UseTokenInUrl) $PageUrl .= "t=" . $customer->TableVar . "&"; // add page token
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
		global $objForm, $customer;
		if ($customer->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($customer->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($customer->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccustomer_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["customer"] = new ccustomer();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'customer', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $customer;
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
		global $objForm, $gsFormError, $customer;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$customer->id->setQueryStringValue($_GET["id"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$customer->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$customer->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$customer->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($customer->id->CurrentValue == "")
			$this->Page_Terminate("customerlist.php"); // Invalid key, return to list
		switch ($customer->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No records found"); // No record found
					$this->Page_Terminate("customerlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$customer->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Update succeeded"); // Update success
					$sReturnUrl = $customer->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$customer->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $customer;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $customer;
		$customer->id->setFormValue($objForm->GetValue("x_id"));
		$customer->user_name->setFormValue($objForm->GetValue("x_user_name"));
		$customer->password->setFormValue($objForm->GetValue("x_password"));
		$customer->name->setFormValue($objForm->GetValue("x_name"));
		$customer->email->setFormValue($objForm->GetValue("x_email"));
		$customer->phone->setFormValue($objForm->GetValue("x_phone"));
		$customer->mobile->setFormValue($objForm->GetValue("x_mobile"));
		$customer->country->setFormValue($objForm->GetValue("x_country"));
		$customer->address->setFormValue($objForm->GetValue("x_address"));
		$customer->date_lastlogin->setFormValue($objForm->GetValue("x_date_lastlogin"));
		$customer->date_lastlogin->CurrentValue = ew_UnFormatDateTime($customer->date_lastlogin->CurrentValue, 5);
		$customer->date_register->setFormValue($objForm->GetValue("x_date_register"));
		$customer->date_register->CurrentValue = ew_UnFormatDateTime($customer->date_register->CurrentValue, 5);
		$customer->status->setFormValue($objForm->GetValue("x_status"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $customer;
		$this->LoadRow();
		$customer->id->CurrentValue = $customer->id->FormValue;
		$customer->user_name->CurrentValue = $customer->user_name->FormValue;
		$customer->password->CurrentValue = $customer->password->FormValue;
		$customer->name->CurrentValue = $customer->name->FormValue;
		$customer->email->CurrentValue = $customer->email->FormValue;
		$customer->phone->CurrentValue = $customer->phone->FormValue;
		$customer->mobile->CurrentValue = $customer->mobile->FormValue;
		$customer->country->CurrentValue = $customer->country->FormValue;
		$customer->address->CurrentValue = $customer->address->FormValue;
		$customer->date_lastlogin->CurrentValue = $customer->date_lastlogin->FormValue;
		$customer->date_lastlogin->CurrentValue = ew_UnFormatDateTime($customer->date_lastlogin->CurrentValue, 5);
		$customer->date_register->CurrentValue = $customer->date_register->FormValue;
		$customer->date_register->CurrentValue = ew_UnFormatDateTime($customer->date_register->CurrentValue, 5);
		$customer->status->CurrentValue = $customer->status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $customer;
		$sFilter = $customer->KeyFilter();

		// Call Row Selecting event
		$customer->Row_Selecting($sFilter);

		// Load sql based on filter
		$customer->CurrentFilter = $sFilter;
		$sSql = $customer->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$customer->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $customer;
		$customer->id->setDbValue($rs->fields('id'));
		$customer->user_name->setDbValue($rs->fields('user_name'));
		$customer->password->setDbValue($rs->fields('password'));
		$customer->name->setDbValue($rs->fields('name'));
		$customer->email->setDbValue($rs->fields('email'));
		$customer->phone->setDbValue($rs->fields('phone'));
		$customer->mobile->setDbValue($rs->fields('mobile'));
		$customer->country->setDbValue($rs->fields('country'));
		$customer->address->setDbValue($rs->fields('address'));
		$customer->date_lastlogin->setDbValue($rs->fields('date_lastlogin'));
		$customer->date_register->setDbValue($rs->fields('date_register'));
		$customer->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $customer;

		// Call Row_Rendering event
		$customer->Row_Rendering();

		// Common render codes for all row types
		// id

		$customer->id->CellCssStyle = "";
		$customer->id->CellCssClass = "";

		// user_name
		$customer->user_name->CellCssStyle = "";
		$customer->user_name->CellCssClass = "";

		// password
		$customer->password->CellCssStyle = "";
		$customer->password->CellCssClass = "";

		// name
		$customer->name->CellCssStyle = "";
		$customer->name->CellCssClass = "";

		// email
		$customer->email->CellCssStyle = "";
		$customer->email->CellCssClass = "";

		// phone
		$customer->phone->CellCssStyle = "";
		$customer->phone->CellCssClass = "";

		// mobile
		$customer->mobile->CellCssStyle = "";
		$customer->mobile->CellCssClass = "";

		// country
		$customer->country->CellCssStyle = "";
		$customer->country->CellCssClass = "";

		// address
		$customer->address->CellCssStyle = "";
		$customer->address->CellCssClass = "";

		// date_lastlogin
		$customer->date_lastlogin->CellCssStyle = "";
		$customer->date_lastlogin->CellCssClass = "";

		// date_register
		$customer->date_register->CellCssStyle = "";
		$customer->date_register->CellCssClass = "";

		// status
		$customer->status->CellCssStyle = "";
		$customer->status->CellCssClass = "";
		if ($customer->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$customer->id->ViewValue = $customer->id->CurrentValue;
			$customer->id->CssStyle = "";
			$customer->id->CssClass = "";
			$customer->id->ViewCustomAttributes = "";

			// user_name
			$customer->user_name->ViewValue = $customer->user_name->CurrentValue;
			$customer->user_name->CssStyle = "";
			$customer->user_name->CssClass = "";
			$customer->user_name->ViewCustomAttributes = "";

			// password
			$customer->password->ViewValue = $customer->password->CurrentValue;
			$customer->password->CssStyle = "";
			$customer->password->CssClass = "";
			$customer->password->ViewCustomAttributes = "";

			// name
			$customer->name->ViewValue = $customer->name->CurrentValue;
			$customer->name->CssStyle = "";
			$customer->name->CssClass = "";
			$customer->name->ViewCustomAttributes = "";

			// email
			$customer->email->ViewValue = $customer->email->CurrentValue;
			$customer->email->CssStyle = "";
			$customer->email->CssClass = "";
			$customer->email->ViewCustomAttributes = "";

			// phone
			$customer->phone->ViewValue = $customer->phone->CurrentValue;
			$customer->phone->CssStyle = "";
			$customer->phone->CssClass = "";
			$customer->phone->ViewCustomAttributes = "";

			// mobile
			$customer->mobile->ViewValue = $customer->mobile->CurrentValue;
			$customer->mobile->CssStyle = "";
			$customer->mobile->CssClass = "";
			$customer->mobile->ViewCustomAttributes = "";

			// country
			$customer->country->ViewValue = $customer->country->CurrentValue;
			$customer->country->CssStyle = "";
			$customer->country->CssClass = "";
			$customer->country->ViewCustomAttributes = "";

			// address
			$customer->address->ViewValue = $customer->address->CurrentValue;
			$customer->address->CssStyle = "";
			$customer->address->CssClass = "";
			$customer->address->ViewCustomAttributes = "";

			// date_lastlogin
			$customer->date_lastlogin->ViewValue = $customer->date_lastlogin->CurrentValue;
			$customer->date_lastlogin->ViewValue = ew_FormatDateTime($customer->date_lastlogin->ViewValue, 5);
			$customer->date_lastlogin->CssStyle = "";
			$customer->date_lastlogin->CssClass = "";
			$customer->date_lastlogin->ViewCustomAttributes = "";

			// date_register
			$customer->date_register->ViewValue = $customer->date_register->CurrentValue;
			$customer->date_register->ViewValue = ew_FormatDateTime($customer->date_register->ViewValue, 5);
			$customer->date_register->CssStyle = "";
			$customer->date_register->CssClass = "";
			$customer->date_register->ViewCustomAttributes = "";

			// status
			if (strval($customer->status->CurrentValue) <> "") {
				switch ($customer->status->CurrentValue) {
					case "1":
						$customer->status->ViewValue = "Active";
						break;
					case "2":
						$customer->status->ViewValue = "Not Active";
						break;
					default:
						$customer->status->ViewValue = $customer->status->CurrentValue;
				}
			} else {
				$customer->status->ViewValue = NULL;
			}
			$customer->status->CssStyle = "";
			$customer->status->CssClass = "";
			$customer->status->ViewCustomAttributes = "";

			// id
			$customer->id->HrefValue = "";

			// user_name
			$customer->user_name->HrefValue = "";

			// password
			$customer->password->HrefValue = "";

			// name
			$customer->name->HrefValue = "";

			// email
			$customer->email->HrefValue = "";

			// phone
			$customer->phone->HrefValue = "";

			// mobile
			$customer->mobile->HrefValue = "";

			// country
			$customer->country->HrefValue = "";

			// address
			$customer->address->HrefValue = "";

			// date_lastlogin
			$customer->date_lastlogin->HrefValue = "";

			// date_register
			$customer->date_register->HrefValue = "";

			// status
			$customer->status->HrefValue = "";
		} elseif ($customer->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$customer->id->EditCustomAttributes = "";
			$customer->id->EditValue = $customer->id->CurrentValue;
			$customer->id->CssStyle = "";
			$customer->id->CssClass = "";
			$customer->id->ViewCustomAttributes = "";

			// user_name
			$customer->user_name->EditCustomAttributes = "";
			$customer->user_name->EditValue = ew_HtmlEncode($customer->user_name->CurrentValue);

			// password
			$customer->password->EditCustomAttributes = "";
			$customer->password->EditValue = ew_HtmlEncode($customer->password->CurrentValue);

			// name
			$customer->name->EditCustomAttributes = "";
			$customer->name->EditValue = ew_HtmlEncode($customer->name->CurrentValue);

			// email
			$customer->email->EditCustomAttributes = "";
			$customer->email->EditValue = ew_HtmlEncode($customer->email->CurrentValue);

			// phone
			$customer->phone->EditCustomAttributes = "";
			$customer->phone->EditValue = ew_HtmlEncode($customer->phone->CurrentValue);

			// mobile
			$customer->mobile->EditCustomAttributes = "";
			$customer->mobile->EditValue = ew_HtmlEncode($customer->mobile->CurrentValue);

			// country
			$customer->country->EditCustomAttributes = "";
			$customer->country->EditValue = ew_HtmlEncode($customer->country->CurrentValue);

			// address
			$customer->address->EditCustomAttributes = "";
			$customer->address->EditValue = ew_HtmlEncode($customer->address->CurrentValue);

			// date_lastlogin
			$customer->date_lastlogin->EditCustomAttributes = "";
			$customer->date_lastlogin->EditValue = ew_HtmlEncode(ew_FormatDateTime($customer->date_lastlogin->CurrentValue, 5));

			// date_register
			$customer->date_register->EditCustomAttributes = "";
			$customer->date_register->EditValue = ew_HtmlEncode(ew_FormatDateTime($customer->date_register->CurrentValue, 5));

			// status
			$customer->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Active");
			$arwrk[] = array("2", "Not Active");
			$customer->status->EditValue = $arwrk;

			// Edit refer script
			// id

			$customer->id->HrefValue = "";

			// user_name
			$customer->user_name->HrefValue = "";

			// password
			$customer->password->HrefValue = "";

			// name
			$customer->name->HrefValue = "";

			// email
			$customer->email->HrefValue = "";

			// phone
			$customer->phone->HrefValue = "";

			// mobile
			$customer->mobile->HrefValue = "";

			// country
			$customer->country->HrefValue = "";

			// address
			$customer->address->HrefValue = "";

			// date_lastlogin
			$customer->date_lastlogin->HrefValue = "";

			// date_register
			$customer->date_register->HrefValue = "";

			// status
			$customer->status->HrefValue = "";
		}

		// Call Row Rendered event
		$customer->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $customer;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($customer->user_name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - User Name";
		}
		if ($customer->password->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Password";
		}
		if ($customer->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Name";
		}
		if ($customer->email->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Email";
		}
		if (!ew_CheckInteger($customer->country->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Country";
		}
		if (!ew_CheckDate($customer->date_lastlogin->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect date, format = yyyy/mm/dd - Date Lastlogin";
		}
		if ($customer->date_register->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Date Register";
		}
		if (!ew_CheckDate($customer->date_register->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect date, format = yyyy/mm/dd - Date Register";
		}
		if ($customer->status->FormValue == "") {
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
		global $conn, $Security, $customer;
		$sFilter = $customer->KeyFilter();
		$customer->CurrentFilter = $sFilter;
		$sSql = $customer->SQL();
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

			$customer->user_name->SetDbValueDef($customer->user_name->CurrentValue, "");
			$rsnew['user_name'] =& $customer->user_name->DbValue;

			// Field password
			$customer->password->SetDbValueDef($customer->password->CurrentValue, "");
			$rsnew['password'] =& $customer->password->DbValue;

			// Field name
			$customer->name->SetDbValueDef($customer->name->CurrentValue, "");
			$rsnew['name'] =& $customer->name->DbValue;

			// Field email
			$customer->email->SetDbValueDef($customer->email->CurrentValue, "");
			$rsnew['email'] =& $customer->email->DbValue;

			// Field phone
			$customer->phone->SetDbValueDef($customer->phone->CurrentValue, NULL);
			$rsnew['phone'] =& $customer->phone->DbValue;

			// Field mobile
			$customer->mobile->SetDbValueDef($customer->mobile->CurrentValue, "");
			$rsnew['mobile'] =& $customer->mobile->DbValue;

			// Field country
			$customer->country->SetDbValueDef($customer->country->CurrentValue, 0);
			$rsnew['country'] =& $customer->country->DbValue;

			// Field address
			$customer->address->SetDbValueDef($customer->address->CurrentValue, NULL);
			$rsnew['address'] =& $customer->address->DbValue;

			// Field date_lastlogin
			$customer->date_lastlogin->SetDbValueDef(ew_UnFormatDateTime($customer->date_lastlogin->CurrentValue, 5), ew_CurrentDate());
			$rsnew['date_lastlogin'] =& $customer->date_lastlogin->DbValue;

			// Field date_register
			$customer->date_register->SetDbValueDef(ew_UnFormatDateTime($customer->date_register->CurrentValue, 5), ew_CurrentDate());
			$rsnew['date_register'] =& $customer->date_register->DbValue;

			// Field status
			$customer->status->SetDbValueDef($customer->status->CurrentValue, 0);
			$rsnew['status'] =& $customer->status->DbValue;

			// Call Row Updating event
			$bUpdateRow = $customer->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($customer->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($customer->CancelMessage <> "") {
					$this->setMessage($customer->CancelMessage);
					$customer->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$customer->Row_Updated($rsold, $rsnew);
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
