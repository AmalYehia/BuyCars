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
$slide_view = new cslide_view();
$Page =& $slide_view;

// Page init processing
$slide_view->Page_Init();

// Page main processing
$slide_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($slide->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var slide_view = new ew_Page("slide_view");

// page properties
slide_view.PageID = "view"; // page ID
var EW_PAGE_ID = slide_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
slide_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
slide_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
slide_view.ValidateRequired = false; // no JavaScript validation
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
<div align="center" class="msm_h1">View TABLE: Slide</div>
<p><span class="phpmaker">
<br><br>
<?php if ($slide->Export == "") { ?>
<a href="slidelist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $slide->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $slide->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $slide->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $slide_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($slide->id->Visible) { // id ?>
	<tr<?php echo $slide->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $slide->id->CellAttributes() ?>>
<div<?php echo $slide->id->ViewAttributes() ?>><?php echo $slide->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($slide->slide_photo->Visible) { // slide_photo ?>
	<tr<?php echo $slide->slide_photo->RowAttributes ?>>
		<td class="ewTableHeader">Slide Photo</td>
		<td<?php echo $slide->slide_photo->CellAttributes() ?>>
<?php if ($slide->slide_photo->HrefValue <> "") { ?>
<?php if (!is_null($slide->slide_photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/photo/") . $slide->slide_photo->Upload->DbValue ?>" border=0<?php echo $slide->slide_photo->ViewAttributes() ?>>
<?php } elseif (!in_array($slide->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($slide->slide_photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/photo/") . $slide->slide_photo->Upload->DbValue ?>" border=0<?php echo $slide->slide_photo->ViewAttributes() ?>>
<?php } elseif (!in_array($slide->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($slide->sort_order->Visible) { // sort_order ?>
	<tr<?php echo $slide->sort_order->RowAttributes ?>>
		<td class="ewTableHeader">Sort Order</td>
		<td<?php echo $slide->sort_order->CellAttributes() ?>>
<div<?php echo $slide->sort_order->ViewAttributes() ?>><?php echo $slide->sort_order->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($slide->status->Visible) { // status ?>
	<tr<?php echo $slide->status->RowAttributes ?>>
		<td class="ewTableHeader">Status</td>
		<td<?php echo $slide->status->CellAttributes() ?>>
<div<?php echo $slide->status->ViewAttributes() ?>><?php echo $slide->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($slide->Export == "") { ?>
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
class cslide_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'slide';

	// Page Object Name
	var $PageObjName = 'slide_view';

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
	function cslide_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["slide"] = new cslide();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
		global $slide;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$slide->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "slidelist.php"; // Return to list
			}

			// Get action
			$slide->CurrentAction = "I"; // Display form
			switch ($slide->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "slidelist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "slidelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$slide->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $slide;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$slide->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$slide->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $slide->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$slide->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$slide->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$slide->setStartRecordNumber($this->lStartRec);
		}
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
		// id

		$slide->id->CellCssStyle = "";
		$slide->id->CellCssClass = "";

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

			// id
			$slide->id->HrefValue = "";

			// slide_photo
			$slide->slide_photo->HrefValue = "";

			// sort_order
			$slide->sort_order->HrefValue = "";

			// status
			$slide->status->HrefValue = "";
		}

		// Call Row Rendered event
		$slide->Row_Rendered();
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
