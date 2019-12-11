<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "static_pagesinfo.php" ?>
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
$static_pages_view = new cstatic_pages_view();
$Page =& $static_pages_view;

// Page init processing
$static_pages_view->Page_Init();

// Page main processing
$static_pages_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($static_pages->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var static_pages_view = new ew_Page("static_pages_view");

// page properties
static_pages_view.PageID = "view"; // page ID
var EW_PAGE_ID = static_pages_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
static_pages_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
static_pages_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
static_pages_view.ValidateRequired = false; // no JavaScript validation
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
<div align="center" class="msm_h1">View TABLE: Static Pages</div>
<p><span class="phpmaker">
<br><br>
<?php if ($static_pages->Export == "") { ?>
<a href="static_pageslist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $static_pages->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $static_pages_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($static_pages->id->Visible) { // id ?>
	<tr<?php echo $static_pages->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $static_pages->id->CellAttributes() ?>>
<div<?php echo $static_pages->id->ViewAttributes() ?>><?php echo $static_pages->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($static_pages->header->Visible) { // header ?>
	<tr<?php echo $static_pages->header->RowAttributes ?>>
		<td class="ewTableHeader">Header</td>
		<td<?php echo $static_pages->header->CellAttributes() ?>>
<div<?php echo $static_pages->header->ViewAttributes() ?>><?php echo $static_pages->header->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($static_pages->description->Visible) { // description ?>
	<tr<?php echo $static_pages->description->RowAttributes ?>>
		<td class="ewTableHeader">Description</td>
		<td<?php echo $static_pages->description->CellAttributes() ?>>
<div<?php echo $static_pages->description->ViewAttributes() ?>><?php echo $static_pages->description->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($static_pages->Export == "") { ?>
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
class cstatic_pages_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'static_pages';

	// Page Object Name
	var $PageObjName = 'static_pages_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $static_pages;
		if ($static_pages->UseTokenInUrl) $PageUrl .= "t=" . $static_pages->TableVar . "&"; // add page token
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
		global $objForm, $static_pages;
		if ($static_pages->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($static_pages->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($static_pages->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cstatic_pages_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["static_pages"] = new cstatic_pages();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'static_pages', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $static_pages;
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
		global $static_pages;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$static_pages->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "static_pageslist.php"; // Return to list
			}

			// Get action
			$static_pages->CurrentAction = "I"; // Display form
			switch ($static_pages->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "static_pageslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "static_pageslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$static_pages->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $static_pages;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$static_pages->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$static_pages->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $static_pages->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$static_pages->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$static_pages->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$static_pages->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $static_pages;
		$sFilter = $static_pages->KeyFilter();

		// Call Row Selecting event
		$static_pages->Row_Selecting($sFilter);

		// Load sql based on filter
		$static_pages->CurrentFilter = $sFilter;
		$sSql = $static_pages->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$static_pages->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $static_pages;
		$static_pages->id->setDbValue($rs->fields('id'));
		$static_pages->header->setDbValue($rs->fields('header'));
		$static_pages->description->setDbValue($rs->fields('description'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $static_pages;

		// Call Row_Rendering event
		$static_pages->Row_Rendering();

		// Common render codes for all row types
		// id

		$static_pages->id->CellCssStyle = "";
		$static_pages->id->CellCssClass = "";

		// header
		$static_pages->header->CellCssStyle = "";
		$static_pages->header->CellCssClass = "";

		// description
		$static_pages->description->CellCssStyle = "";
		$static_pages->description->CellCssClass = "";
		if ($static_pages->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$static_pages->id->ViewValue = $static_pages->id->CurrentValue;
			$static_pages->id->CssStyle = "";
			$static_pages->id->CssClass = "";
			$static_pages->id->ViewCustomAttributes = "";

			// header
			$static_pages->header->ViewValue = $static_pages->header->CurrentValue;
			$static_pages->header->CssStyle = "";
			$static_pages->header->CssClass = "";
			$static_pages->header->ViewCustomAttributes = "";

			// description
			$static_pages->description->ViewValue = $static_pages->description->CurrentValue;
			$static_pages->description->CssStyle = "";
			$static_pages->description->CssClass = "";
			$static_pages->description->ViewCustomAttributes = "";

			// id
			$static_pages->id->HrefValue = "";

			// header
			$static_pages->header->HrefValue = "";

			// description
			$static_pages->description->HrefValue = "";
		}

		// Call Row Rendered event
		$static_pages->Row_Rendered();
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
