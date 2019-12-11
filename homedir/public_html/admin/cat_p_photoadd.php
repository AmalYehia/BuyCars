<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "cat_p_photoinfo.php" ?>
<?php include "cat_productinfo.php" ?>
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
$cat_p_photo_add = new ccat_p_photo_add();
$Page =& $cat_p_photo_add;

// Page init processing
$cat_p_photo_add->Page_Init();

// Page main processing
$cat_p_photo_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var cat_p_photo_add = new ew_Page("cat_p_photo_add");

// page properties
cat_p_photo_add.PageID = "add"; // page ID
var EW_PAGE_ID = cat_p_photo_add.PageID; // for backward compatibility

// extend page with ValidateForm function
cat_p_photo_add.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_photo"];
		aelm = fobj.elements["a" + infix + "_photo"];
		var chk_photo = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_photo && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Photo");
		elm = fobj.elements["x" + infix + "_photo"];
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
cat_p_photo_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
cat_p_photo_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cat_p_photo_add.ValidateRequired = false; // no JavaScript validation
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
<div align="center" class="msm_h1">Add to TABLE: Cat P Photo</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $cat_p_photo->getReturnUrl() ?>">Go Back</a></span></p>
<?php $cat_p_photo_add->ShowMessage() ?>
<form name="fcat_p_photoadd" id="fcat_p_photoadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return cat_p_photo_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="cat_p_photo">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($cat_p_photo->product_id->Visible) { // product_id ?>
	<tr<?php echo $cat_p_photo->product_id->RowAttributes ?>>
		<td class="ewTableHeader">Product Id<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $cat_p_photo->product_id->CellAttributes() ?>><span id="el_product_id">
<?php if ($cat_p_photo->product_id->getSessionValue() <> "") { ?>
<div<?php echo $cat_p_photo->product_id->ViewAttributes() ?>><?php echo $cat_p_photo->product_id->ViewValue ?></div>
<input type="hidden" id="x_product_id" name="x_product_id" value="<?php echo ew_HtmlEncode($cat_p_photo->product_id->CurrentValue) ?>">
<?php } else { ?>
<select id="x_product_id" name="x_product_id"<?php echo $cat_p_photo->product_id->EditAttributes() ?>>
<?php
if (is_array($cat_p_photo->product_id->EditValue)) {
	$arwrk = $cat_p_photo->product_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($cat_p_photo->product_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php } ?>
</span><?php echo $cat_p_photo->product_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_p_photo->photo->Visible) { // photo ?>
	<tr<?php echo $cat_p_photo->photo->RowAttributes ?>>
		<td class="ewTableHeader">Photo<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $cat_p_photo->photo->CellAttributes() ?>><span id="el_photo">
<input type="file" name="x_photo" id="x_photo" size="30"<?php echo $cat_p_photo->photo->EditAttributes() ?>>
</div>
</span><?php echo $cat_p_photo->photo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_p_photo->sort_order->Visible) { // sort_order ?>
	<tr<?php echo $cat_p_photo->sort_order->RowAttributes ?>>
		<td class="ewTableHeader">Sort Order<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $cat_p_photo->sort_order->CellAttributes() ?>><span id="el_sort_order">
<input type="text" name="x_sort_order" id="x_sort_order" size="30" value="<?php echo $cat_p_photo->sort_order->EditValue ?>"<?php echo $cat_p_photo->sort_order->EditAttributes() ?>>
</span><?php echo $cat_p_photo->sort_order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_p_photo->status->Visible) { // status ?>
	<tr<?php echo $cat_p_photo->status->RowAttributes ?>>
		<td class="ewTableHeader">Status<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $cat_p_photo->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_status" id="x_status" value="{value}"<?php echo $cat_p_photo->status->EditAttributes() ?>></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $cat_p_photo->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($cat_p_photo->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $cat_p_photo->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $cat_p_photo->status->CustomMsg ?></td>
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
class ccat_p_photo_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'cat_p_photo';

	// Page Object Name
	var $PageObjName = 'cat_p_photo_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $cat_p_photo;
		if ($cat_p_photo->UseTokenInUrl) $PageUrl .= "t=" . $cat_p_photo->TableVar . "&"; // add page token
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
		global $objForm, $cat_p_photo;
		if ($cat_p_photo->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($cat_p_photo->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($cat_p_photo->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccat_p_photo_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["cat_p_photo"] = new ccat_p_photo();

		// Initialize other table object
		$GLOBALS['cat_product'] = new ccat_product();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cat_p_photo', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $cat_p_photo;
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
		global $objForm, $gsFormError, $cat_p_photo;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $cat_p_photo->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $cat_p_photo->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$cat_p_photo->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $cat_p_photo->CurrentAction = "C"; // Copy Record
		  } else {
		    $cat_p_photo->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($cat_p_photo->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No records found"); // No record found
		      $this->Page_Terminate("cat_p_photolist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$cat_p_photo->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Add succeeded"); // Set up success message
					$sReturnUrl = $cat_p_photo->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$cat_p_photo->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $cat_p_photo;

		// Get upload data
			if ($cat_p_photo->photo->Upload->UploadFile()) {

				// No action required
			} else {
				echo $cat_p_photo->photo->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $cat_p_photo;
		$cat_p_photo->photo->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $cat_p_photo;
		$cat_p_photo->product_id->setFormValue($objForm->GetValue("x_product_id"));
		$cat_p_photo->sort_order->setFormValue($objForm->GetValue("x_sort_order"));
		$cat_p_photo->status->setFormValue($objForm->GetValue("x_status"));
		$cat_p_photo->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $cat_p_photo;
		$cat_p_photo->id->CurrentValue = $cat_p_photo->id->FormValue;
		$cat_p_photo->product_id->CurrentValue = $cat_p_photo->product_id->FormValue;
		$cat_p_photo->sort_order->CurrentValue = $cat_p_photo->sort_order->FormValue;
		$cat_p_photo->status->CurrentValue = $cat_p_photo->status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $cat_p_photo;
		$sFilter = $cat_p_photo->KeyFilter();

		// Call Row Selecting event
		$cat_p_photo->Row_Selecting($sFilter);

		// Load sql based on filter
		$cat_p_photo->CurrentFilter = $sFilter;
		$sSql = $cat_p_photo->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$cat_p_photo->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $cat_p_photo;
		$cat_p_photo->id->setDbValue($rs->fields('id'));
		$cat_p_photo->product_id->setDbValue($rs->fields('product_id'));
		$cat_p_photo->photo->Upload->DbValue = $rs->fields('photo');
		$cat_p_photo->sort_order->setDbValue($rs->fields('sort_order'));
		$cat_p_photo->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $cat_p_photo;

		// Call Row_Rendering event
		$cat_p_photo->Row_Rendering();

		// Common render codes for all row types
		// product_id

		$cat_p_photo->product_id->CellCssStyle = "";
		$cat_p_photo->product_id->CellCssClass = "";

		// photo
		$cat_p_photo->photo->CellCssStyle = "";
		$cat_p_photo->photo->CellCssClass = "";

		// sort_order
		$cat_p_photo->sort_order->CellCssStyle = "";
		$cat_p_photo->sort_order->CellCssClass = "";

		// status
		$cat_p_photo->status->CellCssStyle = "";
		$cat_p_photo->status->CellCssClass = "";
		if ($cat_p_photo->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$cat_p_photo->id->ViewValue = $cat_p_photo->id->CurrentValue;
			$cat_p_photo->id->CssStyle = "";
			$cat_p_photo->id->CssClass = "";
			$cat_p_photo->id->ViewCustomAttributes = "";

			// product_id
			if (strval($cat_p_photo->product_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name` FROM `cat_product` WHERE `id` = " . ew_AdjustSql($cat_p_photo->product_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$cat_p_photo->product_id->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$cat_p_photo->product_id->ViewValue = $cat_p_photo->product_id->CurrentValue;
				}
			} else {
				$cat_p_photo->product_id->ViewValue = NULL;
			}
			$cat_p_photo->product_id->CssStyle = "";
			$cat_p_photo->product_id->CssClass = "";
			$cat_p_photo->product_id->ViewCustomAttributes = "";

			// photo
			if (!is_null($cat_p_photo->photo->Upload->DbValue)) {
				$cat_p_photo->photo->ViewValue = $cat_p_photo->photo->Upload->DbValue;
				$cat_p_photo->photo->ImageWidth = 120;
				$cat_p_photo->photo->ImageHeight = 0;
				$cat_p_photo->photo->ImageAlt = "";
			} else {
				$cat_p_photo->photo->ViewValue = "";
			}
			$cat_p_photo->photo->CssStyle = "";
			$cat_p_photo->photo->CssClass = "";
			$cat_p_photo->photo->ViewCustomAttributes = "";

			// sort_order
			$cat_p_photo->sort_order->ViewValue = $cat_p_photo->sort_order->CurrentValue;
			$cat_p_photo->sort_order->CssStyle = "";
			$cat_p_photo->sort_order->CssClass = "";
			$cat_p_photo->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($cat_p_photo->status->CurrentValue) <> "") {
				switch ($cat_p_photo->status->CurrentValue) {
					case "1":
						$cat_p_photo->status->ViewValue = "Active";
						break;
					case "2":
						$cat_p_photo->status->ViewValue = "Not Active";
						break;
					default:
						$cat_p_photo->status->ViewValue = $cat_p_photo->status->CurrentValue;
				}
			} else {
				$cat_p_photo->status->ViewValue = NULL;
			}
			$cat_p_photo->status->CssStyle = "";
			$cat_p_photo->status->CssClass = "";
			$cat_p_photo->status->ViewCustomAttributes = "";

			// product_id
			$cat_p_photo->product_id->HrefValue = "";

			// photo
			$cat_p_photo->photo->HrefValue = "";

			// sort_order
			$cat_p_photo->sort_order->HrefValue = "";

			// status
			$cat_p_photo->status->HrefValue = "";
		} elseif ($cat_p_photo->RowType == EW_ROWTYPE_ADD) { // Add row

			// product_id
			$cat_p_photo->product_id->EditCustomAttributes = "";
			if ($cat_p_photo->product_id->getSessionValue() <> "") {
				$cat_p_photo->product_id->CurrentValue = $cat_p_photo->product_id->getSessionValue();
			if (strval($cat_p_photo->product_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name` FROM `cat_product` WHERE `id` = " . ew_AdjustSql($cat_p_photo->product_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$cat_p_photo->product_id->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$cat_p_photo->product_id->ViewValue = $cat_p_photo->product_id->CurrentValue;
				}
			} else {
				$cat_p_photo->product_id->ViewValue = NULL;
			}
			$cat_p_photo->product_id->CssStyle = "";
			$cat_p_photo->product_id->CssClass = "";
			$cat_p_photo->product_id->ViewCustomAttributes = "";
			} else {
			$sSqlWrk = "SELECT `id`, `name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `cat_product`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$cat_p_photo->product_id->EditValue = $arwrk;
			}

			// photo
			$cat_p_photo->photo->EditCustomAttributes = "";
			if (!is_null($cat_p_photo->photo->Upload->DbValue)) {
				$cat_p_photo->photo->EditValue = $cat_p_photo->photo->Upload->DbValue;
				$cat_p_photo->photo->ImageWidth = 120;
				$cat_p_photo->photo->ImageHeight = 0;
				$cat_p_photo->photo->ImageAlt = "";
			} else {
				$cat_p_photo->photo->EditValue = "";
			}

			// sort_order
			$cat_p_photo->sort_order->EditCustomAttributes = "";
			$cat_p_photo->sort_order->EditValue = ew_HtmlEncode($cat_p_photo->sort_order->CurrentValue);

			// status
			$cat_p_photo->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Active");
			$arwrk[] = array("2", "Not Active");
			$cat_p_photo->status->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$cat_p_photo->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $cat_p_photo;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($cat_p_photo->photo->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($cat_p_photo->photo->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($cat_p_photo->photo->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($cat_p_photo->product_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Product Id";
		}
		if (is_null($cat_p_photo->photo->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Photo";
		}
		if ($cat_p_photo->sort_order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Sort Order";
		}
		if (!ew_CheckInteger($cat_p_photo->sort_order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Sort Order";
		}
		if ($cat_p_photo->status->FormValue == "") {
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
		global $conn, $Security, $cat_p_photo;
		$rsnew = array();

		// Field product_id
		$cat_p_photo->product_id->SetDbValueDef($cat_p_photo->product_id->CurrentValue, 0);
		$rsnew['product_id'] =& $cat_p_photo->product_id->DbValue;

		// Field photo
		$cat_p_photo->photo->Upload->SaveToSession(); // Save file value to Session
		if (is_null($cat_p_photo->photo->Upload->Value)) {
			$rsnew['photo'] = NULL;
		} else {
			$rsnew['photo'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../upload/image/"), $cat_p_photo->photo->Upload->FileName);
		}

		// Field sort_order
		$cat_p_photo->sort_order->SetDbValueDef($cat_p_photo->sort_order->CurrentValue, 0);
		$rsnew['sort_order'] =& $cat_p_photo->sort_order->DbValue;

		// Field status
		$cat_p_photo->status->SetDbValueDef($cat_p_photo->status->CurrentValue, 0);
		$rsnew['status'] =& $cat_p_photo->status->DbValue;

		// Call Row Inserting event
		$bInsertRow = $cat_p_photo->Row_Inserting($rsnew);
		if ($bInsertRow) {

			// Field photo
			if (!is_null($cat_p_photo->photo->Upload->Value)) {
				$cat_p_photo->photo->Upload->SaveToFile("../upload/image/", $rsnew['photo'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($cat_p_photo->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($cat_p_photo->CancelMessage <> "") {
				$this->setMessage($cat_p_photo->CancelMessage);
				$cat_p_photo->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$cat_p_photo->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $cat_p_photo->id->DbValue;

			// Call Row Inserted event
			$cat_p_photo->Row_Inserted($rsnew);
		}

		// Field photo
		$cat_p_photo->photo->Upload->RemoveFromSession(); // Remove file value from Session
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
