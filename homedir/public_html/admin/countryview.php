<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "countryinfo.php" ?>
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
$country_view = new ccountry_view();
$Page =& $country_view;

// Page init processing
$country_view->Page_Init();

// Page main processing
$country_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($country->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var country_view = new ew_Page("country_view");

// page properties
country_view.PageID = "view"; // page ID
var EW_PAGE_ID = country_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
country_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
country_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
country_view.ValidateRequired = false; // no JavaScript validation
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
<div align="center" class="msm_h1">View TABLE: Country</div>
<p><span class="phpmaker">
<br><br>
<?php if ($country->Export == "") { ?>
<a href="countrylist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $country->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $country->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $country->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $country_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($country->id->Visible) { // id ?>
	<tr<?php echo $country->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $country->id->CellAttributes() ?>>
<div<?php echo $country->id->ViewAttributes() ?>><?php echo $country->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($country->name->Visible) { // name ?>
	<tr<?php echo $country->name->RowAttributes ?>>
		<td class="ewTableHeader">Name</td>
		<td<?php echo $country->name->CellAttributes() ?>>
<div<?php echo $country->name->ViewAttributes() ?>><?php echo $country->name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($country->status->Visible) { // status ?>
	<tr<?php echo $country->status->RowAttributes ?>>
		<td class="ewTableHeader">Status</td>
		<td<?php echo $country->status->CellAttributes() ?>>
<div<?php echo $country->status->ViewAttributes() ?>><?php echo $country->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($country->Export == "") { ?>
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
class ccountry_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'country';

	// Page Object Name
	var $PageObjName = 'country_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $country;
		if ($country->UseTokenInUrl) $PageUrl .= "t=" . $country->TableVar . "&"; // add page token
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
		global $objForm, $country;
		if ($country->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($country->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($country->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccountry_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["country"] = new ccountry();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'country', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $country;
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
		global $country;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$country->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "countrylist.php"; // Return to list
			}

			// Get action
			$country->CurrentAction = "I"; // Display form
			switch ($country->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "countrylist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "countrylist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$country->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $country;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$country->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$country->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $country->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$country->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$country->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$country->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $country;
		$sFilter = $country->KeyFilter();

		// Call Row Selecting event
		$country->Row_Selecting($sFilter);

		// Load sql based on filter
		$country->CurrentFilter = $sFilter;
		$sSql = $country->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$country->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $country;
		$country->id->setDbValue($rs->fields('id'));
		$country->name->setDbValue($rs->fields('name'));
		$country->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $country;

		// Call Row_Rendering event
		$country->Row_Rendering();

		// Common render codes for all row types
		// id

		$country->id->CellCssStyle = "";
		$country->id->CellCssClass = "";

		// name
		$country->name->CellCssStyle = "";
		$country->name->CellCssClass = "";

		// status
		$country->status->CellCssStyle = "";
		$country->status->CellCssClass = "";
		if ($country->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$country->id->ViewValue = $country->id->CurrentValue;
			$country->id->CssStyle = "";
			$country->id->CssClass = "";
			$country->id->ViewCustomAttributes = "";

			// name
			$country->name->ViewValue = $country->name->CurrentValue;
			$country->name->CssStyle = "";
			$country->name->CssClass = "";
			$country->name->ViewCustomAttributes = "";

			// status
			if (strval($country->status->CurrentValue) <> "") {
				switch ($country->status->CurrentValue) {
					case "1":
						$country->status->ViewValue = "Active";
						break;
					case "2":
						$country->status->ViewValue = "Not Active";
						break;
					default:
						$country->status->ViewValue = $country->status->CurrentValue;
				}
			} else {
				$country->status->ViewValue = NULL;
			}
			$country->status->CssStyle = "";
			$country->status->CssClass = "";
			$country->status->ViewCustomAttributes = "";

			// id
			$country->id->HrefValue = "";

			// name
			$country->name->HrefValue = "";

			// status
			$country->status->HrefValue = "";
		}

		// Call Row Rendered event
		$country->Row_Rendered();
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
