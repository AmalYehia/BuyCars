<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "manufactureinfo.php" ?>
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
$manufacture_view = new cmanufacture_view();
$Page =& $manufacture_view;

// Page init processing
$manufacture_view->Page_Init();

// Page main processing
$manufacture_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($manufacture->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var manufacture_view = new ew_Page("manufacture_view");

// page properties
manufacture_view.PageID = "view"; // page ID
var EW_PAGE_ID = manufacture_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
manufacture_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
manufacture_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
manufacture_view.ValidateRequired = false; // no JavaScript validation
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
<div align="center" class="msm_h1">View TABLE: Manufacture</div>
<p><span class="phpmaker">
<br><br>
<?php if ($manufacture->Export == "") { ?>
<a href="manufacturelist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $manufacture->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $manufacture->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $manufacture->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $manufacture_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($manufacture->id->Visible) { // id ?>
	<tr<?php echo $manufacture->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $manufacture->id->CellAttributes() ?>>
<div<?php echo $manufacture->id->ViewAttributes() ?>><?php echo $manufacture->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($manufacture->name->Visible) { // name ?>
	<tr<?php echo $manufacture->name->RowAttributes ?>>
		<td class="ewTableHeader">Name</td>
		<td<?php echo $manufacture->name->CellAttributes() ?>>
<div<?php echo $manufacture->name->ViewAttributes() ?>><?php echo $manufacture->name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($manufacture->logo->Visible) { // logo ?>
	<tr<?php echo $manufacture->logo->RowAttributes ?>>
		<td class="ewTableHeader">Logo</td>
		<td<?php echo $manufacture->logo->CellAttributes() ?>>
<?php if ($manufacture->logo->HrefValue <> "") { ?>
<?php if (!is_null($manufacture->logo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $manufacture->logo->Upload->DbValue ?>" border=0<?php echo $manufacture->logo->ViewAttributes() ?>>
<?php } elseif (!in_array($manufacture->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($manufacture->logo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $manufacture->logo->Upload->DbValue ?>" border=0<?php echo $manufacture->logo->ViewAttributes() ?>>
<?php } elseif (!in_array($manufacture->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($manufacture->web_site->Visible) { // web_site ?>
	<tr<?php echo $manufacture->web_site->RowAttributes ?>>
		<td class="ewTableHeader">Web Site</td>
		<td<?php echo $manufacture->web_site->CellAttributes() ?>>
<div<?php echo $manufacture->web_site->ViewAttributes() ?>><?php echo $manufacture->web_site->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($manufacture->sort_order->Visible) { // sort_order ?>
	<tr<?php echo $manufacture->sort_order->RowAttributes ?>>
		<td class="ewTableHeader">Sort Order</td>
		<td<?php echo $manufacture->sort_order->CellAttributes() ?>>
<div<?php echo $manufacture->sort_order->ViewAttributes() ?>><?php echo $manufacture->sort_order->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($manufacture->status->Visible) { // status ?>
	<tr<?php echo $manufacture->status->RowAttributes ?>>
		<td class="ewTableHeader">Status</td>
		<td<?php echo $manufacture->status->CellAttributes() ?>>
<div<?php echo $manufacture->status->ViewAttributes() ?>><?php echo $manufacture->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($manufacture->Export == "") { ?>
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
class cmanufacture_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'manufacture';

	// Page Object Name
	var $PageObjName = 'manufacture_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $manufacture;
		if ($manufacture->UseTokenInUrl) $PageUrl .= "t=" . $manufacture->TableVar . "&"; // add page token
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
		global $objForm, $manufacture;
		if ($manufacture->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($manufacture->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($manufacture->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmanufacture_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["manufacture"] = new cmanufacture();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'manufacture', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $manufacture;
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
		global $manufacture;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$manufacture->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "manufacturelist.php"; // Return to list
			}

			// Get action
			$manufacture->CurrentAction = "I"; // Display form
			switch ($manufacture->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "manufacturelist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "manufacturelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$manufacture->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $manufacture;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$manufacture->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$manufacture->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $manufacture->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$manufacture->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$manufacture->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$manufacture->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $manufacture;
		$sFilter = $manufacture->KeyFilter();

		// Call Row Selecting event
		$manufacture->Row_Selecting($sFilter);

		// Load sql based on filter
		$manufacture->CurrentFilter = $sFilter;
		$sSql = $manufacture->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$manufacture->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $manufacture;
		$manufacture->id->setDbValue($rs->fields('id'));
		$manufacture->name->setDbValue($rs->fields('name'));
		$manufacture->logo->Upload->DbValue = $rs->fields('logo');
		$manufacture->web_site->setDbValue($rs->fields('web_site'));
		$manufacture->sort_order->setDbValue($rs->fields('sort_order'));
		$manufacture->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $manufacture;

		// Call Row_Rendering event
		$manufacture->Row_Rendering();

		// Common render codes for all row types
		// id

		$manufacture->id->CellCssStyle = "";
		$manufacture->id->CellCssClass = "";

		// name
		$manufacture->name->CellCssStyle = "";
		$manufacture->name->CellCssClass = "";

		// logo
		$manufacture->logo->CellCssStyle = "";
		$manufacture->logo->CellCssClass = "";

		// web_site
		$manufacture->web_site->CellCssStyle = "";
		$manufacture->web_site->CellCssClass = "";

		// sort_order
		$manufacture->sort_order->CellCssStyle = "";
		$manufacture->sort_order->CellCssClass = "";

		// status
		$manufacture->status->CellCssStyle = "";
		$manufacture->status->CellCssClass = "";
		if ($manufacture->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$manufacture->id->ViewValue = $manufacture->id->CurrentValue;
			$manufacture->id->CssStyle = "";
			$manufacture->id->CssClass = "";
			$manufacture->id->ViewCustomAttributes = "";

			// name
			$manufacture->name->ViewValue = $manufacture->name->CurrentValue;
			$manufacture->name->CssStyle = "";
			$manufacture->name->CssClass = "";
			$manufacture->name->ViewCustomAttributes = "";

			// logo
			if (!is_null($manufacture->logo->Upload->DbValue)) {
				$manufacture->logo->ViewValue = $manufacture->logo->Upload->DbValue;
				$manufacture->logo->ImageWidth = 100;
				$manufacture->logo->ImageHeight = 0;
				$manufacture->logo->ImageAlt = "";
			} else {
				$manufacture->logo->ViewValue = "";
			}
			$manufacture->logo->CssStyle = "";
			$manufacture->logo->CssClass = "";
			$manufacture->logo->ViewCustomAttributes = "";

			// web_site
			$manufacture->web_site->ViewValue = $manufacture->web_site->CurrentValue;
			$manufacture->web_site->CssStyle = "";
			$manufacture->web_site->CssClass = "";
			$manufacture->web_site->ViewCustomAttributes = "";

			// sort_order
			$manufacture->sort_order->ViewValue = $manufacture->sort_order->CurrentValue;
			$manufacture->sort_order->CssStyle = "";
			$manufacture->sort_order->CssClass = "";
			$manufacture->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($manufacture->status->CurrentValue) <> "") {
				switch ($manufacture->status->CurrentValue) {
					case "1":
						$manufacture->status->ViewValue = "Active";
						break;
					case "2":
						$manufacture->status->ViewValue = "Not Active";
						break;
					default:
						$manufacture->status->ViewValue = $manufacture->status->CurrentValue;
				}
			} else {
				$manufacture->status->ViewValue = NULL;
			}
			$manufacture->status->CssStyle = "";
			$manufacture->status->CssClass = "";
			$manufacture->status->ViewCustomAttributes = "";

			// id
			$manufacture->id->HrefValue = "";

			// name
			$manufacture->name->HrefValue = "";

			// logo
			$manufacture->logo->HrefValue = "";

			// web_site
			$manufacture->web_site->HrefValue = "";

			// sort_order
			$manufacture->sort_order->HrefValue = "";

			// status
			$manufacture->status->HrefValue = "";
		}

		// Call Row Rendered event
		$manufacture->Row_Rendered();
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
