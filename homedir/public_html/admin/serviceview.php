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
$service_view = new cservice_view();
$Page =& $service_view;

// Page init processing
$service_view->Page_Init();

// Page main processing
$service_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($service->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var service_view = new ew_Page("service_view");

// page properties
service_view.PageID = "view"; // page ID
var EW_PAGE_ID = service_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
service_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
service_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
service_view.ValidateRequired = false; // no JavaScript validation
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
<div align="center" class="msm_h1">View TABLE: Service</div>
<p><span class="phpmaker">
<br><br>
<?php if ($service->Export == "") { ?>
<a href="servicelist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $service->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $service->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $service->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $service_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($service->id->Visible) { // id ?>
	<tr<?php echo $service->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $service->id->CellAttributes() ?>>
<div<?php echo $service->id->ViewAttributes() ?>><?php echo $service->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($service->photo->Visible) { // photo ?>
	<tr<?php echo $service->photo->RowAttributes ?>>
		<td class="ewTableHeader">Photo</td>
		<td<?php echo $service->photo->CellAttributes() ?>>
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
</td>
	</tr>
<?php } ?>
<?php if ($service->header->Visible) { // header ?>
	<tr<?php echo $service->header->RowAttributes ?>>
		<td class="ewTableHeader">Header</td>
		<td<?php echo $service->header->CellAttributes() ?>>
<div<?php echo $service->header->ViewAttributes() ?>><?php echo $service->header->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($service->short_desc->Visible) { // short_desc ?>
	<tr<?php echo $service->short_desc->RowAttributes ?>>
		<td class="ewTableHeader">Short Desc</td>
		<td<?php echo $service->short_desc->CellAttributes() ?>>
<div<?php echo $service->short_desc->ViewAttributes() ?>><?php echo $service->short_desc->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($service->full_desc->Visible) { // full_desc ?>
	<tr<?php echo $service->full_desc->RowAttributes ?>>
		<td class="ewTableHeader">Full Desc</td>
		<td<?php echo $service->full_desc->CellAttributes() ?>>
<div<?php echo $service->full_desc->ViewAttributes() ?>><?php echo $service->full_desc->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($service->sort_order->Visible) { // sort_order ?>
	<tr<?php echo $service->sort_order->RowAttributes ?>>
		<td class="ewTableHeader">Sort Order</td>
		<td<?php echo $service->sort_order->CellAttributes() ?>>
<div<?php echo $service->sort_order->ViewAttributes() ?>><?php echo $service->sort_order->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($service->status->Visible) { // status ?>
	<tr<?php echo $service->status->RowAttributes ?>>
		<td class="ewTableHeader">Status</td>
		<td<?php echo $service->status->CellAttributes() ?>>
<div<?php echo $service->status->ViewAttributes() ?>><?php echo $service->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($service->Export == "") { ?>
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
class cservice_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'service';

	// Page Object Name
	var $PageObjName = 'service_view';

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
	function cservice_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["service"] = new cservice();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
		global $service;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$service->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "servicelist.php"; // Return to list
			}

			// Get action
			$service->CurrentAction = "I"; // Display form
			switch ($service->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "servicelist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "servicelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$service->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $service;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$service->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$service->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $service->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$service->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$service->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$service->setStartRecordNumber($this->lStartRec);
		}
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
		}

		// Call Row Rendered event
		$service->Row_Rendered();
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
