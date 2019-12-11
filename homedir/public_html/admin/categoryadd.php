<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "categoryinfo.php" ?>
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
$category_add = new ccategory_add();
$Page =& $category_add;

// Page init processing
$category_add->Page_Init();

// Page main processing
$category_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var category_add = new ew_Page("category_add");

// page properties
category_add.PageID = "add"; // page ID
var EW_PAGE_ID = category_add.PageID; // for backward compatibility

// extend page with ValidateForm function
category_add.ValidateForm = function(fobj) {
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
category_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
category_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
category_add.ValidateRequired = false; // no JavaScript validation
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
<div align="center" class="msm_h1">Add to TABLE: Category</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $category->getReturnUrl() ?>">Go Back</a></span></p>
<?php $category_add->ShowMessage() ?>
<form name="fcategoryadd" id="fcategoryadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return category_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="category">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($category->parent_id->Visible) { // parent_id ?>
	<tr<?php echo $category->parent_id->RowAttributes ?>>
		<td class="ewTableHeader">Parent Id</td>
		<td<?php echo $category->parent_id->CellAttributes() ?>><span id="el_parent_id">
<?php if ($category->parent_id->getSessionValue() <> "") { ?>
<div<?php echo $category->parent_id->ViewAttributes() ?>><?php echo $category->parent_id->ViewValue ?></div>
<input type="hidden" id="x_parent_id" name="x_parent_id" value="<?php echo ew_HtmlEncode($category->parent_id->CurrentValue) ?>">
<?php } else { ?>
<select id="x_parent_id" name="x_parent_id"<?php echo $category->parent_id->EditAttributes() ?>>
<?php
if (is_array($category->parent_id->EditValue)) {
	$arwrk = $category->parent_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($category->parent_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $category->parent_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($category->name->Visible) { // name ?>
	<tr<?php echo $category->name->RowAttributes ?>>
		<td class="ewTableHeader">Name<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $category->name->CellAttributes() ?>><span id="el_name">
<input type="text" name="x_name" id="x_name" size="30" maxlength="200" value="<?php echo $category->name->EditValue ?>"<?php echo $category->name->EditAttributes() ?>>
</span><?php echo $category->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($category->photo->Visible) { // photo ?>
	<tr<?php echo $category->photo->RowAttributes ?>>
		<td class="ewTableHeader">Photo</td>
		<td<?php echo $category->photo->CellAttributes() ?>><span id="el_photo">
<input type="file" name="x_photo" id="x_photo" size="30"<?php echo $category->photo->EditAttributes() ?>>
</div>
</span><?php echo $category->photo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($category->description->Visible) { // description ?>
	<tr<?php echo $category->description->RowAttributes ?>>
		<td class="ewTableHeader">Description</td>
		<td<?php echo $category->description->CellAttributes() ?>><span id="el_description">
<textarea name="x_description" id="x_description" cols="35" rows="4"<?php echo $category->description->EditAttributes() ?>><?php echo $category->description->EditValue ?></textarea>
</span><?php echo $category->description->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($category->sort_order->Visible) { // sort_order ?>
	<tr<?php echo $category->sort_order->RowAttributes ?>>
		<td class="ewTableHeader">Sort Order<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $category->sort_order->CellAttributes() ?>><span id="el_sort_order">
<input type="text" name="x_sort_order" id="x_sort_order" size="30" value="<?php echo $category->sort_order->EditValue ?>"<?php echo $category->sort_order->EditAttributes() ?>>
</span><?php echo $category->sort_order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($category->status->Visible) { // status ?>
	<tr<?php echo $category->status->RowAttributes ?>>
		<td class="ewTableHeader">Status<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $category->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_status" id="x_status" value="{value}"<?php echo $category->status->EditAttributes() ?>></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $category->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($category->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $category->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $category->status->CustomMsg ?></td>
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
class ccategory_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'category';

	// Page Object Name
	var $PageObjName = 'category_add';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $category;
		if ($category->UseTokenInUrl) $PageUrl .= "t=" . $category->TableVar . "&"; // add page token
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
		global $objForm, $category;
		if ($category->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($category->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($category->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccategory_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["category"] = new ccategory();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'category', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $category;
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
		global $objForm, $gsFormError, $category;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $category->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $category->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$category->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $category->CurrentAction = "C"; // Copy Record
		  } else {
		    $category->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($category->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No records found"); // No record found
		      $this->Page_Terminate("categorylist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$category->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Add succeeded"); // Set up success message
					$sReturnUrl = $category->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$category->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $category;

		// Get upload data
			if ($category->photo->Upload->UploadFile()) {

				// No action required
			} else {
				echo $category->photo->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $category;
		$category->parent_id->CurrentValue = 0;
		$category->photo->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $category;
		$category->parent_id->setFormValue($objForm->GetValue("x_parent_id"));
		$category->name->setFormValue($objForm->GetValue("x_name"));
		$category->description->setFormValue($objForm->GetValue("x_description"));
		$category->sort_order->setFormValue($objForm->GetValue("x_sort_order"));
		$category->status->setFormValue($objForm->GetValue("x_status"));
		$category->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $category;
		$category->id->CurrentValue = $category->id->FormValue;
		$category->parent_id->CurrentValue = $category->parent_id->FormValue;
		$category->name->CurrentValue = $category->name->FormValue;
		$category->description->CurrentValue = $category->description->FormValue;
		$category->sort_order->CurrentValue = $category->sort_order->FormValue;
		$category->status->CurrentValue = $category->status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $category;
		$sFilter = $category->KeyFilter();

		// Call Row Selecting event
		$category->Row_Selecting($sFilter);

		// Load sql based on filter
		$category->CurrentFilter = $sFilter;
		$sSql = $category->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$category->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $category;
		$category->id->setDbValue($rs->fields('id'));
		$category->parent_id->setDbValue($rs->fields('parent_id'));
		$category->name->setDbValue($rs->fields('name'));
		$category->photo->Upload->DbValue = $rs->fields('photo');
		$category->description->setDbValue($rs->fields('description'));
		$category->sort_order->setDbValue($rs->fields('sort_order'));
		$category->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $category;

		// Call Row_Rendering event
		$category->Row_Rendering();

		// Common render codes for all row types
		// parent_id

		$category->parent_id->CellCssStyle = "";
		$category->parent_id->CellCssClass = "";

		// name
		$category->name->CellCssStyle = "";
		$category->name->CellCssClass = "";

		// photo
		$category->photo->CellCssStyle = "";
		$category->photo->CellCssClass = "";

		// description
		$category->description->CellCssStyle = "";
		$category->description->CellCssClass = "";

		// sort_order
		$category->sort_order->CellCssStyle = "";
		$category->sort_order->CellCssClass = "";

		// status
		$category->status->CellCssStyle = "";
		$category->status->CellCssClass = "";
		if ($category->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$category->id->ViewValue = $category->id->CurrentValue;
			$category->id->CssStyle = "";
			$category->id->CssClass = "";
			$category->id->ViewCustomAttributes = "";

			// parent_id
			if (strval($category->parent_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name` FROM `category` WHERE `id` = " . ew_AdjustSql($category->parent_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$category->parent_id->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$category->parent_id->ViewValue = $category->parent_id->CurrentValue;
				}
			} else {
				$category->parent_id->ViewValue = NULL;
			}
			$category->parent_id->CssStyle = "";
			$category->parent_id->CssClass = "";
			$category->parent_id->ViewCustomAttributes = "";

			// name
			$category->name->ViewValue = $category->name->CurrentValue;
			$category->name->CssStyle = "";
			$category->name->CssClass = "";
			$category->name->ViewCustomAttributes = "";

			// photo
			if (!is_null($category->photo->Upload->DbValue)) {
				$category->photo->ViewValue = $category->photo->Upload->DbValue;
				$category->photo->ImageWidth = 100;
				$category->photo->ImageHeight = 0;
				$category->photo->ImageAlt = "";
			} else {
				$category->photo->ViewValue = "";
			}
			$category->photo->CssStyle = "";
			$category->photo->CssClass = "";
			$category->photo->ViewCustomAttributes = "";

			// description
			$category->description->ViewValue = $category->description->CurrentValue;
			$category->description->CssStyle = "";
			$category->description->CssClass = "";
			$category->description->ViewCustomAttributes = "";

			// sort_order
			$category->sort_order->ViewValue = $category->sort_order->CurrentValue;
			$category->sort_order->CssStyle = "";
			$category->sort_order->CssClass = "";
			$category->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($category->status->CurrentValue) <> "") {
				switch ($category->status->CurrentValue) {
					case "1":
						$category->status->ViewValue = "Active";
						break;
					case "2":
						$category->status->ViewValue = "Not Active";
						break;
					default:
						$category->status->ViewValue = $category->status->CurrentValue;
				}
			} else {
				$category->status->ViewValue = NULL;
			}
			$category->status->CssStyle = "";
			$category->status->CssClass = "";
			$category->status->ViewCustomAttributes = "";

			// parent_id
			$category->parent_id->HrefValue = "";

			// name
			$category->name->HrefValue = "";

			// photo
			$category->photo->HrefValue = "";

			// description
			$category->description->HrefValue = "";

			// sort_order
			$category->sort_order->HrefValue = "";

			// status
			$category->status->HrefValue = "";
		} elseif ($category->RowType == EW_ROWTYPE_ADD) { // Add row

			// parent_id
			$category->parent_id->EditCustomAttributes = "";
			if ($category->parent_id->getSessionValue() <> "") {
				$category->parent_id->CurrentValue = $category->parent_id->getSessionValue();
			if (strval($category->parent_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name` FROM `category` WHERE `id` = " . ew_AdjustSql($category->parent_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$category->parent_id->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$category->parent_id->ViewValue = $category->parent_id->CurrentValue;
				}
			} else {
				$category->parent_id->ViewValue = NULL;
			}
			$category->parent_id->CssStyle = "";
			$category->parent_id->CssClass = "";
			$category->parent_id->ViewCustomAttributes = "";
			} else {
			$sSqlWrk = "SELECT `id`, `name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `category`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$category->parent_id->EditValue = $arwrk;
			}

			// name
			$category->name->EditCustomAttributes = "";
			$category->name->EditValue = ew_HtmlEncode($category->name->CurrentValue);

			// photo
			$category->photo->EditCustomAttributes = "";
			if (!is_null($category->photo->Upload->DbValue)) {
				$category->photo->EditValue = $category->photo->Upload->DbValue;
				$category->photo->ImageWidth = 100;
				$category->photo->ImageHeight = 0;
				$category->photo->ImageAlt = "";
			} else {
				$category->photo->EditValue = "";
			}

			// description
			$category->description->EditCustomAttributes = "";
			$category->description->EditValue = ew_HtmlEncode($category->description->CurrentValue);

			// sort_order
			$category->sort_order->EditCustomAttributes = "";
			$category->sort_order->EditValue = ew_HtmlEncode($category->sort_order->CurrentValue);

			// status
			$category->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Active");
			$arwrk[] = array("2", "Not Active");
			$category->status->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$category->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $category;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($category->photo->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($category->photo->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($category->photo->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($category->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Name";
		}
		if ($category->sort_order->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Sort Order";
		}
		if (!ew_CheckInteger($category->sort_order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Sort Order";
		}
		if ($category->status->FormValue == "") {
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
		global $conn, $Security, $category;
		$rsnew = array();

		// Field parent_id
		$category->parent_id->SetDbValueDef($category->parent_id->CurrentValue, NULL);
		$rsnew['parent_id'] =& $category->parent_id->DbValue;

		// Field name
		$category->name->SetDbValueDef($category->name->CurrentValue, "");
		$rsnew['name'] =& $category->name->DbValue;

		// Field photo
		$category->photo->Upload->SaveToSession(); // Save file value to Session
		if (is_null($category->photo->Upload->Value)) {
			$rsnew['photo'] = NULL;
		} else {
			$rsnew['photo'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../upload/image/"), $category->photo->Upload->FileName);
		}

		// Field description
		$category->description->SetDbValueDef($category->description->CurrentValue, NULL);
		$rsnew['description'] =& $category->description->DbValue;

		// Field sort_order
		$category->sort_order->SetDbValueDef($category->sort_order->CurrentValue, 0);
		$rsnew['sort_order'] =& $category->sort_order->DbValue;

		// Field status
		$category->status->SetDbValueDef($category->status->CurrentValue, 0);
		$rsnew['status'] =& $category->status->DbValue;

		// Call Row Inserting event
		$bInsertRow = $category->Row_Inserting($rsnew);
		if ($bInsertRow) {

			// Field photo
			if (!is_null($category->photo->Upload->Value)) {
				$category->photo->Upload->SaveToFile("../upload/image/", $rsnew['photo'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($category->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($category->CancelMessage <> "") {
				$this->setMessage($category->CancelMessage);
				$category->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$category->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $category->id->DbValue;

			// Call Row Inserted event
			$category->Row_Inserted($rsnew);
		}

		// Field photo
		$category->photo->Upload->RemoveFromSession(); // Remove file value from Session
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
