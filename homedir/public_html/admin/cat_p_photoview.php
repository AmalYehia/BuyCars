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
$cat_p_photo_view = new ccat_p_photo_view();
$Page =& $cat_p_photo_view;

// Page init processing
$cat_p_photo_view->Page_Init();

// Page main processing
$cat_p_photo_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($cat_p_photo->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var cat_p_photo_view = new ew_Page("cat_p_photo_view");

// page properties
cat_p_photo_view.PageID = "view"; // page ID
var EW_PAGE_ID = cat_p_photo_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
cat_p_photo_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
cat_p_photo_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cat_p_photo_view.ValidateRequired = false; // no JavaScript validation
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
<div align="center" class="msm_h1">View TABLE: Cat P Photo</div>
<p><span class="phpmaker">
<br><br>
<?php if ($cat_p_photo->Export == "") { ?>
<a href="cat_p_photolist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $cat_p_photo->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $cat_p_photo->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $cat_p_photo->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $cat_p_photo_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($cat_p_photo->id->Visible) { // id ?>
	<tr<?php echo $cat_p_photo->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $cat_p_photo->id->CellAttributes() ?>>
<div<?php echo $cat_p_photo->id->ViewAttributes() ?>><?php echo $cat_p_photo->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_p_photo->product_id->Visible) { // product_id ?>
	<tr<?php echo $cat_p_photo->product_id->RowAttributes ?>>
		<td class="ewTableHeader">Product Id</td>
		<td<?php echo $cat_p_photo->product_id->CellAttributes() ?>>
<div<?php echo $cat_p_photo->product_id->ViewAttributes() ?>><?php echo $cat_p_photo->product_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_p_photo->photo->Visible) { // photo ?>
	<tr<?php echo $cat_p_photo->photo->RowAttributes ?>>
		<td class="ewTableHeader">Photo</td>
		<td<?php echo $cat_p_photo->photo->CellAttributes() ?>>
<?php if ($cat_p_photo->photo->HrefValue <> "") { ?>
<?php if (!is_null($cat_p_photo->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $cat_p_photo->photo->Upload->DbValue ?>" border=0<?php echo $cat_p_photo->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($cat_p_photo->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($cat_p_photo->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $cat_p_photo->photo->Upload->DbValue ?>" border=0<?php echo $cat_p_photo->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($cat_p_photo->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($cat_p_photo->sort_order->Visible) { // sort_order ?>
	<tr<?php echo $cat_p_photo->sort_order->RowAttributes ?>>
		<td class="ewTableHeader">Sort Order</td>
		<td<?php echo $cat_p_photo->sort_order->CellAttributes() ?>>
<div<?php echo $cat_p_photo->sort_order->ViewAttributes() ?>><?php echo $cat_p_photo->sort_order->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_p_photo->status->Visible) { // status ?>
	<tr<?php echo $cat_p_photo->status->RowAttributes ?>>
		<td class="ewTableHeader">Status</td>
		<td<?php echo $cat_p_photo->status->CellAttributes() ?>>
<div<?php echo $cat_p_photo->status->ViewAttributes() ?>><?php echo $cat_p_photo->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($cat_p_photo->Export == "") { ?>
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
class ccat_p_photo_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'cat_p_photo';

	// Page Object Name
	var $PageObjName = 'cat_p_photo_view';

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
	function ccat_p_photo_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["cat_p_photo"] = new ccat_p_photo();

		// Initialize other table object
		$GLOBALS['cat_product'] = new ccat_product();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
		global $cat_p_photo;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$cat_p_photo->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "cat_p_photolist.php"; // Return to list
			}

			// Get action
			$cat_p_photo->CurrentAction = "I"; // Display form
			switch ($cat_p_photo->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "cat_p_photolist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "cat_p_photolist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$cat_p_photo->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $cat_p_photo;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$cat_p_photo->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$cat_p_photo->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $cat_p_photo->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$cat_p_photo->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$cat_p_photo->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$cat_p_photo->setStartRecordNumber($this->lStartRec);
		}
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
		// id

		$cat_p_photo->id->CellCssStyle = "";
		$cat_p_photo->id->CellCssClass = "";

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

			// id
			$cat_p_photo->id->HrefValue = "";

			// product_id
			$cat_p_photo->product_id->HrefValue = "";

			// photo
			$cat_p_photo->photo->HrefValue = "";

			// sort_order
			$cat_p_photo->sort_order->HrefValue = "";

			// status
			$cat_p_photo->status->HrefValue = "";
		}

		// Call Row Rendered event
		$cat_p_photo->Row_Rendered();
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
