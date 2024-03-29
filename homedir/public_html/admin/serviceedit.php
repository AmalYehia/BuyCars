<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "serviceinfo.php" ?>
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
$service_edit = new cservice_edit();
$Page =& $service_edit;

// Page init processing
$service_edit->Page_Init();

// Page main processing
$service_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var service_edit = new ew_Page("service_edit");

// page properties
service_edit.PageID = "edit"; // page ID
var EW_PAGE_ID = service_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
service_edit.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_photo"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "File type is not allowed.");
		elm = fobj.elements["x" + infix + "_header"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Header");
		elm = fobj.elements["x" + infix + "_short_desc"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Short Desc");
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
service_edit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
service_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
service_edit.ValidateRequired = false; // no JavaScript validation
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
<div align="center" class="msm_h1">Edit TABLE: Service</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $service->getReturnUrl() ?>">Go Back</a></span></p>
<?php $service_edit->ShowMessage() ?>
<form name="fserviceedit" id="fserviceedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data">
<p>
<input type="hidden" name="a_table" id="a_table" value="service">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($service->id->Visible) { // id ?>
	<tr<?php echo $service->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $service->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $service->id->ViewAttributes() ?>><?php echo $service->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($service->id->CurrentValue) ?>">
</span><?php echo $service->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($service->photo->Visible) { // photo ?>
	<tr<?php echo $service->photo->RowAttributes ?>>
		<td class="ewTableHeader">Photo</td>
		<td<?php echo $service->photo->CellAttributes() ?>><span id="el_photo">
<div id="old_x_photo">
<?php if ($service->photo->HrefValue <> "") { ?>
<?php if (!is_null($service->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../image/") . $service->photo->Upload->DbValue ?>" border=0<?php echo $service->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($service->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($service->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../image/") . $service->photo->Upload->DbValue ?>" border=0<?php echo $service->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($service->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_photo">
<?php if (!is_null($service->photo->Upload->DbValue)) { ?>
<input type="radio" name="a_photo" id="a_photo" value="1" checked="checked">Keep&nbsp;
<input type="radio" name="a_photo" id="a_photo" value="2">Remove&nbsp;
<input type="radio" name="a_photo" id="a_photo" value="3">Replace<br>
<?php } else { ?>
<input type="hidden" name="a_photo" id="a_photo" value="3">
<?php } ?>
<input type="file" name="x_photo" id="x_photo" size="30" onchange="if (this.form.a_photo[2]) this.form.a_photo[2].checked=true;"<?php echo $service->photo->EditAttributes() ?>>
</div>
</span><?php echo $service->photo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($service->header->Visible) { // header ?>
	<tr<?php echo $service->header->RowAttributes ?>>
		<td class="ewTableHeader">Header<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $service->header->CellAttributes() ?>><span id="el_header">
<input type="text" name="x_header" id="x_header" size="30" maxlength="200" value="<?php echo $service->header->EditValue ?>"<?php echo $service->header->EditAttributes() ?>>
</span><?php echo $service->header->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($service->short_desc->Visible) { // short_desc ?>
	<tr<?php echo $service->short_desc->RowAttributes ?>>
		<td class="ewTableHeader">Short Desc<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $service->short_desc->CellAttributes() ?>><span id="el_short_desc">
<textarea name="x_short_desc" id="x_short_desc" cols="45" rows="4"<?php echo $service->short_desc->EditAttributes() ?>><?php echo $service->short_desc->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_short_desc", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_short_desc', 45*_width_multiplier, 4*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span><?php echo $service->short_desc->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($service->full_desc->Visible) { // full_desc ?>
	<tr<?php echo $service->full_desc->RowAttributes ?>>
		<td class="ewTableHeader">Full Desc</td>
		<td<?php echo $service->full_desc->CellAttributes() ?>><span id="el_full_desc">
<textarea name="x_full_desc" id="x_full_desc" cols="45" rows="8"<?php echo $service->full_desc->EditAttributes() ?>><?php echo $service->full_desc->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_full_desc", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_full_desc', 45*_width_multiplier, 8*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span><?php echo $service->full_desc->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($service->sort_order->Visible) { // sort_order ?>
	<tr<?php echo $service->sort_order->RowAttributes ?>>
		<td class="ewTableHeader">Sort Order<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $service->sort_order->CellAttributes() ?>><span id="el_sort_order">
<input type="text" name="x_sort_order" id="x_sort_order" size="30" value="<?php echo $service->sort_order->EditValue ?>"<?php echo $service->sort_order->EditAttributes() ?>>
</span><?php echo $service->sort_order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($service->status->Visible) { // status ?>
	<tr<?php echo $service->status->RowAttributes ?>>
		<td class="ewTableHeader">Status<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $service->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_status" id="x_status" value="{value}"<?php echo $service->status->EditAttributes() ?>></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $service->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($service->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $service->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $service->status->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="button" name="btnAction" id="btnAction" value="   Edit   " onclick="ew_SubmitForm(service_edit, this.form);">
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
class cservice_edit {

	// Page ID
	var $PageID = 'edit';

	// Table Name
	var $TableName = 'service';

	// Page Object Name
	var $PageObjName = 'service_edit';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $service;
		if ($service->UseTokenInUrl) $PageUrl .= "t=" . $service->TableVar . "&"; // add page token
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
		global $objForm, $service;
		if ($service->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($service->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($service->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cservice_edit() {
		global $conn;

		// Initialize table object
		$GLOBALS["service"] = new cservice();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'service', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $service;
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
		global $objForm, $gsFormError, $service;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$service->id->setQueryStringValue($_GET["id"]);

		// Create form object
		$objForm = new cFormObj();
		if (@$_POST["a_edit"] <> "") {
			$service->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$service->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$this->RestoreFormValues();
			}
		} else {
			$service->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($service->id->CurrentValue == "")
			$this->Page_Terminate("servicelist.php"); // Invalid key, return to list
		switch ($service->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage("No records found"); // No record found
					$this->Page_Terminate("servicelist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$service->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage("Update succeeded"); // Update success
					$sReturnUrl = $service->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$service->RowType = EW_ROWTYPE_EDIT; // Render as edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $service;

		// Get upload data
			if ($service->photo->Upload->UploadFile()) {

				// No action required
			} else {
				echo $service->photo->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $service;
		$service->id->setFormValue($objForm->GetValue("x_id"));
		$service->header->setFormValue($objForm->GetValue("x_header"));
		$service->short_desc->setFormValue($objForm->GetValue("x_short_desc"));
		$service->full_desc->setFormValue($objForm->GetValue("x_full_desc"));
		$service->sort_order->setFormValue($objForm->GetValue("x_sort_order"));
		$service->status->setFormValue($objForm->GetValue("x_status"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $service;
		$this->LoadRow();
		$service->id->CurrentValue = $service->id->FormValue;
		$service->header->CurrentValue = $service->header->FormValue;
		$service->short_desc->CurrentValue = $service->short_desc->FormValue;
		$service->full_desc->CurrentValue = $service->full_desc->FormValue;
		$service->sort_order->CurrentValue = $service->sort_order->FormValue;
		$service->status->CurrentValue = $service->status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $service;
		$sFilter = $service->KeyFilter();

		// Call Row Selecting event
		$service->Row_Selecting($sFilter);

		// Load sql based on filter
		$service->CurrentFilter = $sFilter;
		$sSql = $service->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$service->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $service;
		$service->id->setDbValue($rs->fields('id'));
		$service->photo->Upload->DbValue = $rs->fields('photo');
		$service->header->setDbValue($rs->fields('header'));
		$service->short_desc->setDbValue($rs->fields('short_desc'));
		$service->full_desc->setDbValue($rs->fields('full_desc'));
		$service->sort_order->setDbValue($rs->fields('sort_order'));
		$service->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $service;

		// Call Row_Rendering event
		$service->Row_Rendering();

		// Common render codes for all row types
		// id

		$service->id->CellCssStyle = "";
		$service->id->CellCssClass = "";

		// photo
		$service->photo->CellCssStyle = "";
		$service->photo->CellCssClass = "";

		// header
		$service->header->CellCssStyle = "";
		$service->header->CellCssClass = "";

		// short_desc
		$service->short_desc->CellCssStyle = "";
		$service->short_desc->CellCssClass = "";

		// full_desc
		$service->full_desc->CellCssStyle = "";
		$service->full_desc->CellCssClass = "";

		// sort_order
		$service->sort_order->CellCssStyle = "";
		$service->sort_order->CellCssClass = "";

		// status
		$service->status->CellCssStyle = "";
		$service->status->CellCssClass = "";
		if ($service->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$service->id->ViewValue = $service->id->CurrentValue;
			$service->id->CssStyle = "";
			$service->id->CssClass = "";
			$service->id->ViewCustomAttributes = "";

			// photo
			if (!is_null($service->photo->Upload->DbValue)) {
				$service->photo->ViewValue = $service->photo->Upload->DbValue;
				$service->photo->ImageWidth = 100;
				$service->photo->ImageHeight = 0;
				$service->photo->ImageAlt = "";
			} else {
				$service->photo->ViewValue = "";
			}
			$service->photo->CssStyle = "";
			$service->photo->CssClass = "";
			$service->photo->ViewCustomAttributes = "";

			// header
			$service->header->ViewValue = $service->header->CurrentValue;
			$service->header->CssStyle = "";
			$service->header->CssClass = "";
			$service->header->ViewCustomAttributes = "";

			// short_desc
			$service->short_desc->ViewValue = $service->short_desc->CurrentValue;
			$service->short_desc->CssStyle = "";
			$service->short_desc->CssClass = "";
			$service->short_desc->ViewCustomAttributes = "";

			// full_desc
			$service->full_desc->ViewValue = $service->full_desc->CurrentValue;
			$service->full_desc->CssStyle = "";
			$service->full_desc->CssClass = "";
			$service->full_desc->ViewCustomAttributes = "";

			// sort_order
			$service->sort_order->ViewValue = $service->sort_order->CurrentValue;
			$service->sort_order->CssStyle = "";
			$service->sort_order->CssClass = "";
			$service->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($service->status->CurrentValue) <> "") {
				switch ($service->status->CurrentValue) {
					case "1":
						$service->status->ViewValue = "Active";
						break;
					case "2":
						$service->status->ViewValue = "Not Active";
						break;
					default:
						$service->status->ViewValue = $service->status->CurrentValue;
				}
			} else {
				$service->status->ViewValue = NULL;
			}
			$service->status->CssStyle = "";
			$service->status->CssClass = "";
			$service->status->ViewCustomAttributes = "";

			// id
			$service->id->HrefValue = "";

			// photo
			$service->photo->HrefValue = "";

			// header
			$service->header->HrefValue = "";

			// short_desc
			$service->short_desc->HrefValue = "";

			// full_desc
			$service->full_desc->HrefValue = "";

			// sort_order
			$service->sort_order->HrefValue = "";

			// status
			$service->status->HrefValue = "";
		} elseif ($service->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$service->id->EditCustomAttributes = "";
			$service->id->EditValue = $service->id->CurrentValue;
			$service->id->CssStyle = "";
			$service->id->CssClass = "";
			$service->id->ViewCustomAttributes = "";

			// photo
			$service->photo->EditCustomAttributes = "";
			if (!is_null($service->photo->Upload->DbValue)) {
				$service->photo->EditValue = $service->photo->Upload->DbValue;
				$service->photo->ImageWidth = 100;
				$service->photo->ImageHeight = 0;
				$service->photo->ImageAlt = "";
			} else {
				$service->photo->EditValue = "";
			}

			// header
			$service->header->EditCustomAttributes = "";
			$service->header->EditValue = ew_HtmlEncode($service->header->CurrentValue);

			// short_desc
			$service->short_desc->EditCustomAttributes = "";
			$service->short_desc->EditValue = ew_HtmlEncode($service->short_desc->CurrentValue);

			// full_desc
			$service->full_desc->EditCustomAttributes = "";
			$service->full_desc->EditValue = ew_HtmlEncode($service->full_desc->CurrentValue);

			// sort_order
			$service->sort_order->EditCustomAttributes = "";
			$service->sort_order->EditValue = ew_HtmlEncode($service->sort_order->CurrentValue);

			// status
			$service->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Active");
			$arwrk[] = array("2", "Not Active");
			$service->status->EditValue = $arwrk;

			// Edit refer script
			// id

			$service->id->HrefValue = "";

			// photo
			$service->photo->HrefValue = "";

			// header
			$service->header->HrefValue = "";

			// short_desc
			$service->short_desc->HrefValue = "";

			// full_desc
			$service->full_desc->HrefValue = "";

			// sort_order
			$service->sort_order->HrefValue = "";

			// status
			$service->status->HrefValue = "";
		}

		// Call Row Rendered event
		$service->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $service;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($service->photo->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($service->photo->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($service->photo->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($service->header->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Header";
		}
		if ($service->short_desc->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Short Desc";
		}
		if ($service->sort_order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Sort Order";
		}
		if (!ew_CheckInteger($service->sort_order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Sort Order";
		}
		if ($service->status->FormValue == "") {
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
		global $conn, $Security, $service;
		$sFilter = $service->KeyFilter();
		$service->CurrentFilter = $sFilter;
		$sSql = $service->SQL();
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
			// Field photo

			$service->photo->Upload->SaveToSession(); // Save file value to Session
			if ($service->photo->Upload->Action == "2" || $service->photo->Upload->Action == "3") { // Update/Remove
			$service->photo->Upload->DbValue = $rs->fields('photo'); // Get original value
			if (is_null($service->photo->Upload->Value)) {
				$rsnew['photo'] = NULL;
			} else {
				$rsnew['photo'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../image/"), $service->photo->Upload->FileName);
			}
			}

			// Field header
			$service->header->SetDbValueDef($service->header->CurrentValue, "");
			$rsnew['header'] =& $service->header->DbValue;

			// Field short_desc
			$service->short_desc->SetDbValueDef($service->short_desc->CurrentValue, "");
			$rsnew['short_desc'] =& $service->short_desc->DbValue;

			// Field full_desc
			$service->full_desc->SetDbValueDef($service->full_desc->CurrentValue, NULL);
			$rsnew['full_desc'] =& $service->full_desc->DbValue;

			// Field sort_order
			$service->sort_order->SetDbValueDef($service->sort_order->CurrentValue, 0);
			$rsnew['sort_order'] =& $service->sort_order->DbValue;

			// Field status
			$service->status->SetDbValueDef($service->status->CurrentValue, 0);
			$rsnew['status'] =& $service->status->DbValue;

			// Call Row Updating event
			$bUpdateRow = $service->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {

			// Field photo
			if (!is_null($service->photo->Upload->Value)) {
				$service->photo->Upload->SaveToFile("../image/", $rsnew['photo'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($service->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($service->CancelMessage <> "") {
					$this->setMessage($service->CancelMessage);
					$service->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$service->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// Field photo
		$service->photo->Upload->RemoveFromSession(); // Remove file value from Session
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
