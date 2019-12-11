<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "contact_usinfo.php" ?>
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
$contact_us_view = new ccontact_us_view();
$Page =& $contact_us_view;

// Page init processing
$contact_us_view->Page_Init();

// Page main processing
$contact_us_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($contact_us->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var contact_us_view = new ew_Page("contact_us_view");

// page properties
contact_us_view.PageID = "view"; // page ID
var EW_PAGE_ID = contact_us_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
contact_us_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
contact_us_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
contact_us_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
contact_us_view.ShowHighlightText = "Show highlight"; 
contact_us_view.HideHighlightText = "Hide highlight";

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
<div align="center" class="msm_h1">View TABLE: Contact Us</div>
<p><span class="phpmaker">
<br><br>
<?php if ($contact_us->Export == "") { ?>
<a href="contact_uslist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $contact_us->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $contact_us->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $contact_us_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($contact_us->id->Visible) { // id ?>
	<tr<?php echo $contact_us->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $contact_us->id->CellAttributes() ?>>
<div<?php echo $contact_us->id->ViewAttributes() ?>><?php echo $contact_us->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($contact_us->name->Visible) { // name ?>
	<tr<?php echo $contact_us->name->RowAttributes ?>>
		<td class="ewTableHeader">Name</td>
		<td<?php echo $contact_us->name->CellAttributes() ?>>
<div<?php echo $contact_us->name->ViewAttributes() ?>><?php echo $contact_us->name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($contact_us->email->Visible) { // email ?>
	<tr<?php echo $contact_us->email->RowAttributes ?>>
		<td class="ewTableHeader">Email</td>
		<td<?php echo $contact_us->email->CellAttributes() ?>>
<div<?php echo $contact_us->email->ViewAttributes() ?>><?php echo $contact_us->email->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($contact_us->phone->Visible) { // phone ?>
	<tr<?php echo $contact_us->phone->RowAttributes ?>>
		<td class="ewTableHeader">Phone</td>
		<td<?php echo $contact_us->phone->CellAttributes() ?>>
<div<?php echo $contact_us->phone->ViewAttributes() ?>><?php echo $contact_us->phone->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($contact_us->subject->Visible) { // subject ?>
	<tr<?php echo $contact_us->subject->RowAttributes ?>>
		<td class="ewTableHeader">Subject</td>
		<td<?php echo $contact_us->subject->CellAttributes() ?>>
<div<?php echo $contact_us->subject->ViewAttributes() ?>><?php echo $contact_us->subject->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($contact_us->message->Visible) { // message ?>
	<tr<?php echo $contact_us->message->RowAttributes ?>>
		<td class="ewTableHeader">Message</td>
		<td<?php echo $contact_us->message->CellAttributes() ?>>
<div<?php echo $contact_us->message->ViewAttributes() ?>><?php echo $contact_us->message->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($contact_us->receive_date->Visible) { // receive_date ?>
	<tr<?php echo $contact_us->receive_date->RowAttributes ?>>
		<td class="ewTableHeader">Receive Date</td>
		<td<?php echo $contact_us->receive_date->CellAttributes() ?>>
<div<?php echo $contact_us->receive_date->ViewAttributes() ?>><?php echo $contact_us->receive_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($contact_us->Export == "") { ?>
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
class ccontact_us_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'contact_us';

	// Page Object Name
	var $PageObjName = 'contact_us_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $contact_us;
		if ($contact_us->UseTokenInUrl) $PageUrl .= "t=" . $contact_us->TableVar . "&"; // add page token
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
		global $objForm, $contact_us;
		if ($contact_us->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($contact_us->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($contact_us->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccontact_us_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["contact_us"] = new ccontact_us();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'contact_us', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $contact_us;
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
		global $contact_us;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$contact_us->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "contact_uslist.php"; // Return to list
			}

			// Get action
			$contact_us->CurrentAction = "I"; // Display form
			switch ($contact_us->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "contact_uslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "contact_uslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$contact_us->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $contact_us;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$contact_us->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$contact_us->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $contact_us->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$contact_us->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$contact_us->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$contact_us->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $contact_us;
		$sFilter = $contact_us->KeyFilter();

		// Call Row Selecting event
		$contact_us->Row_Selecting($sFilter);

		// Load sql based on filter
		$contact_us->CurrentFilter = $sFilter;
		$sSql = $contact_us->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$contact_us->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $contact_us;
		$contact_us->id->setDbValue($rs->fields('id'));
		$contact_us->name->setDbValue($rs->fields('name'));
		$contact_us->email->setDbValue($rs->fields('email'));
		$contact_us->phone->setDbValue($rs->fields('phone'));
		$contact_us->subject->setDbValue($rs->fields('subject'));
		$contact_us->message->setDbValue($rs->fields('message'));
		$contact_us->receive_date->setDbValue($rs->fields('receive_date'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $contact_us;

		// Call Row_Rendering event
		$contact_us->Row_Rendering();

		// Common render codes for all row types
		// id

		$contact_us->id->CellCssStyle = "";
		$contact_us->id->CellCssClass = "";

		// name
		$contact_us->name->CellCssStyle = "";
		$contact_us->name->CellCssClass = "";

		// email
		$contact_us->email->CellCssStyle = "";
		$contact_us->email->CellCssClass = "";

		// phone
		$contact_us->phone->CellCssStyle = "";
		$contact_us->phone->CellCssClass = "";

		// subject
		$contact_us->subject->CellCssStyle = "";
		$contact_us->subject->CellCssClass = "";

		// message
		$contact_us->message->CellCssStyle = "";
		$contact_us->message->CellCssClass = "";

		// receive_date
		$contact_us->receive_date->CellCssStyle = "";
		$contact_us->receive_date->CellCssClass = "";
		if ($contact_us->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$contact_us->id->ViewValue = $contact_us->id->CurrentValue;
			$contact_us->id->CssStyle = "";
			$contact_us->id->CssClass = "";
			$contact_us->id->ViewCustomAttributes = "";

			// name
			$contact_us->name->ViewValue = $contact_us->name->CurrentValue;
			$contact_us->name->CssStyle = "";
			$contact_us->name->CssClass = "";
			$contact_us->name->ViewCustomAttributes = "";

			// email
			$contact_us->email->ViewValue = $contact_us->email->CurrentValue;
			$contact_us->email->CssStyle = "";
			$contact_us->email->CssClass = "";
			$contact_us->email->ViewCustomAttributes = "";

			// phone
			$contact_us->phone->ViewValue = $contact_us->phone->CurrentValue;
			$contact_us->phone->CssStyle = "";
			$contact_us->phone->CssClass = "";
			$contact_us->phone->ViewCustomAttributes = "";

			// subject
			$contact_us->subject->ViewValue = $contact_us->subject->CurrentValue;
			$contact_us->subject->CssStyle = "";
			$contact_us->subject->CssClass = "";
			$contact_us->subject->ViewCustomAttributes = "";

			// message
			$contact_us->message->ViewValue = $contact_us->message->CurrentValue;
			$contact_us->message->CssStyle = "";
			$contact_us->message->CssClass = "";
			$contact_us->message->ViewCustomAttributes = "";

			// receive_date
			$contact_us->receive_date->ViewValue = $contact_us->receive_date->CurrentValue;
			$contact_us->receive_date->ViewValue = ew_FormatDateTime($contact_us->receive_date->ViewValue, 5);
			$contact_us->receive_date->CssStyle = "";
			$contact_us->receive_date->CssClass = "";
			$contact_us->receive_date->ViewCustomAttributes = "";

			// id
			$contact_us->id->HrefValue = "";

			// name
			$contact_us->name->HrefValue = "";

			// email
			$contact_us->email->HrefValue = "";

			// phone
			$contact_us->phone->HrefValue = "";

			// subject
			$contact_us->subject->HrefValue = "";

			// message
			$contact_us->message->HrefValue = "";

			// receive_date
			$contact_us->receive_date->HrefValue = "";
		}

		// Call Row Rendered event
		$contact_us->Row_Rendered();
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
