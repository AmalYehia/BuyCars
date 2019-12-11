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
$feature_product_view = new cfeature_product_view();
$Page =& $feature_product_view;

// Page init processing
$feature_product_view->Page_Init();

// Page main processing
$feature_product_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($feature_product->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var feature_product_view = new ew_Page("feature_product_view");

// page properties
feature_product_view.PageID = "view"; // page ID
var EW_PAGE_ID = feature_product_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
feature_product_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
feature_product_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
feature_product_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<div id="ewDetailsDiv" name="ewDetailsDivDiv" style="visibility:hidden"></div>
<script language="JavaScript" type="text/javascript">
<!--

// YUI container
var ewDetailsDiv;
var ew_AjaxDetailsTimer = null;

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<div align="center" class="msm_h1">View TABLE: Feature Product</div>
<p><span class="phpmaker">
<br><br>
<?php if ($feature_product->Export == "") { ?>
<a href="feature_productlist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $feature_product->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $feature_product->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $feature_product->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $feature_product_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($feature_product->id->Visible) { // id ?>
	<tr<?php echo $feature_product->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $feature_product->id->CellAttributes() ?>>
<div<?php echo $feature_product->id->ViewAttributes() ?>><?php echo $feature_product->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($feature_product->product_id->Visible) { // product_id ?>
	<tr<?php echo $feature_product->product_id->RowAttributes ?>>
		<td class="ewTableHeader">Product Id</td>
		<td<?php echo $feature_product->product_id->CellAttributes() ?>>
<div<?php echo $feature_product->product_id->ViewAttributes() ?>><?php echo $feature_product->product_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($feature_product->sort_order->Visible) { // sort_order ?>
	<tr<?php echo $feature_product->sort_order->RowAttributes ?>>
		<td class="ewTableHeader">Sort Order</td>
		<td<?php echo $feature_product->sort_order->CellAttributes() ?>>
<div<?php echo $feature_product->sort_order->ViewAttributes() ?>><?php echo $feature_product->sort_order->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($feature_product->status->Visible) { // status ?>
	<tr<?php echo $feature_product->status->RowAttributes ?>>
		<td class="ewTableHeader">Status</td>
		<td<?php echo $feature_product->status->CellAttributes() ?>>
<div<?php echo $feature_product->status->ViewAttributes() ?>><?php echo $feature_product->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($feature_product->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php

//
// Page Class
//
class cfeature_product_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'feature_product';

	// Page Object Name
	var $PageObjName = 'feature_product_view';

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
	function cfeature_product_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["feature_product"] = new cfeature_product();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
	var $lDisplayRecs; // Number of display records
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs;
	var $lRecRange;
	var $lRecCnt;

	//
	// Page main processing
	//
	function Page_Main() {
		global $feature_product;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$feature_product->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "feature_productlist.php"; // Return to list
			}

			// Get action
			$feature_product->CurrentAction = "I"; // Display form
			switch ($feature_product->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "feature_productlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "feature_productlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$feature_product->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $feature_product;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$feature_product->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$feature_product->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $feature_product->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$feature_product->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$feature_product->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$feature_product->setStartRecordNumber($this->lStartRec);
		}
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
		}

		// Call Row Rendered event
		$feature_product->Row_Rendered();
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}
}
?>
