<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "advertiseinfo.php" ?>
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
$advertise_view = new cadvertise_view();
$Page =& $advertise_view;

// Page init processing
$advertise_view->Page_Init();

// Page main processing
$advertise_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($advertise->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var advertise_view = new ew_Page("advertise_view");

// page properties
advertise_view.PageID = "view"; // page ID
var EW_PAGE_ID = advertise_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
advertise_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
advertise_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
advertise_view.ValidateRequired = false; // no JavaScript validation
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
<div align="center" class="msm_h1">View TABLE: Advertise</div>
<p><span class="phpmaker">
<br><br>
<?php if ($advertise->Export == "") { ?>
<a href="advertiselist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $advertise->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $advertise->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $advertise->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $advertise_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($advertise->id->Visible) { // id ?>
	<tr<?php echo $advertise->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $advertise->id->CellAttributes() ?>>
<div<?php echo $advertise->id->ViewAttributes() ?>><?php echo $advertise->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($advertise->adv->Visible) { // adv ?>
	<tr<?php echo $advertise->adv->RowAttributes ?>>
		<td class="ewTableHeader">Adv</td>
		<td<?php echo $advertise->adv->CellAttributes() ?>>
<?php if ($advertise->adv->HrefValue <> "") { ?>
<?php if (!is_null($advertise->adv->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/photo/") . $advertise->adv->Upload->DbValue ?>" border=0<?php echo $advertise->adv->ViewAttributes() ?>>
<?php } elseif (!in_array($advertise->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($advertise->adv->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/photo/") . $advertise->adv->Upload->DbValue ?>" border=0<?php echo $advertise->adv->ViewAttributes() ?>>
<?php } elseif (!in_array($advertise->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($advertise->status->Visible) { // status ?>
	<tr<?php echo $advertise->status->RowAttributes ?>>
		<td class="ewTableHeader">Status</td>
		<td<?php echo $advertise->status->CellAttributes() ?>>
<div<?php echo $advertise->status->ViewAttributes() ?>><?php echo $advertise->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($advertise->Export == "") { ?>
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
class cadvertise_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'advertise';

	// Page Object Name
	var $PageObjName = 'advertise_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $advertise;
		if ($advertise->UseTokenInUrl) $PageUrl .= "t=" . $advertise->TableVar . "&"; // add page token
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
		global $objForm, $advertise;
		if ($advertise->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($advertise->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($advertise->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cadvertise_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["advertise"] = new cadvertise();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'advertise', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $advertise;
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
		global $advertise;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$advertise->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "advertiselist.php"; // Return to list
			}

			// Get action
			$advertise->CurrentAction = "I"; // Display form
			switch ($advertise->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "advertiselist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "advertiselist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$advertise->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $advertise;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$advertise->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$advertise->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $advertise->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$advertise->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$advertise->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$advertise->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $advertise;
		$sFilter = $advertise->KeyFilter();

		// Call Row Selecting event
		$advertise->Row_Selecting($sFilter);

		// Load sql based on filter
		$advertise->CurrentFilter = $sFilter;
		$sSql = $advertise->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$advertise->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $advertise;
		$advertise->id->setDbValue($rs->fields('id'));
		$advertise->adv->Upload->DbValue = $rs->fields('adv');
		$advertise->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $advertise;

		// Call Row_Rendering event
		$advertise->Row_Rendering();

		// Common render codes for all row types
		// id

		$advertise->id->CellCssStyle = "";
		$advertise->id->CellCssClass = "";

		// adv
		$advertise->adv->CellCssStyle = "";
		$advertise->adv->CellCssClass = "";

		// status
		$advertise->status->CellCssStyle = "";
		$advertise->status->CellCssClass = "";
		if ($advertise->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$advertise->id->ViewValue = $advertise->id->CurrentValue;
			$advertise->id->CssStyle = "";
			$advertise->id->CssClass = "";
			$advertise->id->ViewCustomAttributes = "";

			// adv
			if (!is_null($advertise->adv->Upload->DbValue)) {
				$advertise->adv->ViewValue = $advertise->adv->Upload->DbValue;
				$advertise->adv->ImageWidth = 200;
				$advertise->adv->ImageHeight = 0;
				$advertise->adv->ImageAlt = "";
			} else {
				$advertise->adv->ViewValue = "";
			}
			$advertise->adv->CssStyle = "";
			$advertise->adv->CssClass = "";
			$advertise->adv->ViewCustomAttributes = "";

			// status
			if (strval($advertise->status->CurrentValue) <> "") {
				switch ($advertise->status->CurrentValue) {
					case "1":
						$advertise->status->ViewValue = "Active";
						break;
					case "2":
						$advertise->status->ViewValue = "Not Active";
						break;
					default:
						$advertise->status->ViewValue = $advertise->status->CurrentValue;
				}
			} else {
				$advertise->status->ViewValue = NULL;
			}
			$advertise->status->CssStyle = "";
			$advertise->status->CssClass = "";
			$advertise->status->ViewCustomAttributes = "";

			// id
			$advertise->id->HrefValue = "";

			// adv
			$advertise->adv->HrefValue = "";

			// status
			$advertise->status->HrefValue = "";
		}

		// Call Row Rendered event
		$advertise->Row_Rendered();
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
