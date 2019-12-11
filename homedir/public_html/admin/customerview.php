<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "customerinfo.php" ?>
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
$customer_view = new ccustomer_view();
$Page =& $customer_view;

// Page init processing
$customer_view->Page_Init();

// Page main processing
$customer_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($customer->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var customer_view = new ew_Page("customer_view");

// page properties
customer_view.PageID = "view"; // page ID
var EW_PAGE_ID = customer_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
customer_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
customer_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
customer_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
customer_view.ShowHighlightText = "Show highlight"; 
customer_view.HideHighlightText = "Hide highlight";

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
<div align="center" class="msm_h1">View TABLE: Customer</div>
<p><span class="phpmaker">
<br><br>
<?php if ($customer->Export == "") { ?>
<a href="customerlist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $customer->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $customer->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $customer->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $customer_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($customer->id->Visible) { // id ?>
	<tr<?php echo $customer->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $customer->id->CellAttributes() ?>>
<div<?php echo $customer->id->ViewAttributes() ?>><?php echo $customer->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customer->user_name->Visible) { // user_name ?>
	<tr<?php echo $customer->user_name->RowAttributes ?>>
		<td class="ewTableHeader">User Name</td>
		<td<?php echo $customer->user_name->CellAttributes() ?>>
<div<?php echo $customer->user_name->ViewAttributes() ?>><?php echo $customer->user_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customer->password->Visible) { // password ?>
	<tr<?php echo $customer->password->RowAttributes ?>>
		<td class="ewTableHeader">Password</td>
		<td<?php echo $customer->password->CellAttributes() ?>>
<div<?php echo $customer->password->ViewAttributes() ?>><?php echo $customer->password->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customer->name->Visible) { // name ?>
	<tr<?php echo $customer->name->RowAttributes ?>>
		<td class="ewTableHeader">Name</td>
		<td<?php echo $customer->name->CellAttributes() ?>>
<div<?php echo $customer->name->ViewAttributes() ?>><?php echo $customer->name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customer->email->Visible) { // email ?>
	<tr<?php echo $customer->email->RowAttributes ?>>
		<td class="ewTableHeader">Email</td>
		<td<?php echo $customer->email->CellAttributes() ?>>
<div<?php echo $customer->email->ViewAttributes() ?>><?php echo $customer->email->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customer->phone->Visible) { // phone ?>
	<tr<?php echo $customer->phone->RowAttributes ?>>
		<td class="ewTableHeader">Phone</td>
		<td<?php echo $customer->phone->CellAttributes() ?>>
<div<?php echo $customer->phone->ViewAttributes() ?>><?php echo $customer->phone->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customer->mobile->Visible) { // mobile ?>
	<tr<?php echo $customer->mobile->RowAttributes ?>>
		<td class="ewTableHeader">Mobile</td>
		<td<?php echo $customer->mobile->CellAttributes() ?>>
<div<?php echo $customer->mobile->ViewAttributes() ?>><?php echo $customer->mobile->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customer->country->Visible) { // country ?>
	<tr<?php echo $customer->country->RowAttributes ?>>
		<td class="ewTableHeader">Country</td>
		<td<?php echo $customer->country->CellAttributes() ?>>
<div<?php echo $customer->country->ViewAttributes() ?>><?php echo $customer->country->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customer->address->Visible) { // address ?>
	<tr<?php echo $customer->address->RowAttributes ?>>
		<td class="ewTableHeader">Address</td>
		<td<?php echo $customer->address->CellAttributes() ?>>
<div<?php echo $customer->address->ViewAttributes() ?>><?php echo $customer->address->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customer->date_lastlogin->Visible) { // date_lastlogin ?>
	<tr<?php echo $customer->date_lastlogin->RowAttributes ?>>
		<td class="ewTableHeader">Date Lastlogin</td>
		<td<?php echo $customer->date_lastlogin->CellAttributes() ?>>
<div<?php echo $customer->date_lastlogin->ViewAttributes() ?>><?php echo $customer->date_lastlogin->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customer->date_register->Visible) { // date_register ?>
	<tr<?php echo $customer->date_register->RowAttributes ?>>
		<td class="ewTableHeader">Date Register</td>
		<td<?php echo $customer->date_register->CellAttributes() ?>>
<div<?php echo $customer->date_register->ViewAttributes() ?>><?php echo $customer->date_register->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($customer->status->Visible) { // status ?>
	<tr<?php echo $customer->status->RowAttributes ?>>
		<td class="ewTableHeader">Status</td>
		<td<?php echo $customer->status->CellAttributes() ?>>
<div<?php echo $customer->status->ViewAttributes() ?>><?php echo $customer->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($customer->Export == "") { ?>
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
class ccustomer_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'customer';

	// Page Object Name
	var $PageObjName = 'customer_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $customer;
		if ($customer->UseTokenInUrl) $PageUrl .= "t=" . $customer->TableVar . "&"; // add page token
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
		global $objForm, $customer;
		if ($customer->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($customer->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($customer->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccustomer_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["customer"] = new ccustomer();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'customer', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $customer;
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
		global $customer;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$customer->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "customerlist.php"; // Return to list
			}

			// Get action
			$customer->CurrentAction = "I"; // Display form
			switch ($customer->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "customerlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "customerlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$customer->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $customer;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$customer->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$customer->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $customer->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$customer->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$customer->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$customer->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $customer;
		$sFilter = $customer->KeyFilter();

		// Call Row Selecting event
		$customer->Row_Selecting($sFilter);

		// Load sql based on filter
		$customer->CurrentFilter = $sFilter;
		$sSql = $customer->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$customer->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $customer;
		$customer->id->setDbValue($rs->fields('id'));
		$customer->user_name->setDbValue($rs->fields('user_name'));
		$customer->password->setDbValue($rs->fields('password'));
		$customer->name->setDbValue($rs->fields('name'));
		$customer->email->setDbValue($rs->fields('email'));
		$customer->phone->setDbValue($rs->fields('phone'));
		$customer->mobile->setDbValue($rs->fields('mobile'));
		$customer->country->setDbValue($rs->fields('country'));
		$customer->address->setDbValue($rs->fields('address'));
		$customer->date_lastlogin->setDbValue($rs->fields('date_lastlogin'));
		$customer->date_register->setDbValue($rs->fields('date_register'));
		$customer->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $customer;

		// Call Row_Rendering event
		$customer->Row_Rendering();

		// Common render codes for all row types
		// id

		$customer->id->CellCssStyle = "";
		$customer->id->CellCssClass = "";

		// user_name
		$customer->user_name->CellCssStyle = "";
		$customer->user_name->CellCssClass = "";

		// password
		$customer->password->CellCssStyle = "";
		$customer->password->CellCssClass = "";

		// name
		$customer->name->CellCssStyle = "";
		$customer->name->CellCssClass = "";

		// email
		$customer->email->CellCssStyle = "";
		$customer->email->CellCssClass = "";

		// phone
		$customer->phone->CellCssStyle = "";
		$customer->phone->CellCssClass = "";

		// mobile
		$customer->mobile->CellCssStyle = "";
		$customer->mobile->CellCssClass = "";

		// country
		$customer->country->CellCssStyle = "";
		$customer->country->CellCssClass = "";

		// address
		$customer->address->CellCssStyle = "";
		$customer->address->CellCssClass = "";

		// date_lastlogin
		$customer->date_lastlogin->CellCssStyle = "";
		$customer->date_lastlogin->CellCssClass = "";

		// date_register
		$customer->date_register->CellCssStyle = "";
		$customer->date_register->CellCssClass = "";

		// status
		$customer->status->CellCssStyle = "";
		$customer->status->CellCssClass = "";
		if ($customer->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$customer->id->ViewValue = $customer->id->CurrentValue;
			$customer->id->CssStyle = "";
			$customer->id->CssClass = "";
			$customer->id->ViewCustomAttributes = "";

			// user_name
			$customer->user_name->ViewValue = $customer->user_name->CurrentValue;
			$customer->user_name->CssStyle = "";
			$customer->user_name->CssClass = "";
			$customer->user_name->ViewCustomAttributes = "";

			// password
			$customer->password->ViewValue = $customer->password->CurrentValue;
			$customer->password->CssStyle = "";
			$customer->password->CssClass = "";
			$customer->password->ViewCustomAttributes = "";

			// name
			$customer->name->ViewValue = $customer->name->CurrentValue;
			$customer->name->CssStyle = "";
			$customer->name->CssClass = "";
			$customer->name->ViewCustomAttributes = "";

			// email
			$customer->email->ViewValue = $customer->email->CurrentValue;
			$customer->email->CssStyle = "";
			$customer->email->CssClass = "";
			$customer->email->ViewCustomAttributes = "";

			// phone
			$customer->phone->ViewValue = $customer->phone->CurrentValue;
			$customer->phone->CssStyle = "";
			$customer->phone->CssClass = "";
			$customer->phone->ViewCustomAttributes = "";

			// mobile
			$customer->mobile->ViewValue = $customer->mobile->CurrentValue;
			$customer->mobile->CssStyle = "";
			$customer->mobile->CssClass = "";
			$customer->mobile->ViewCustomAttributes = "";

			// country
			$customer->country->ViewValue = $customer->country->CurrentValue;
			$customer->country->CssStyle = "";
			$customer->country->CssClass = "";
			$customer->country->ViewCustomAttributes = "";

			// address
			$customer->address->ViewValue = $customer->address->CurrentValue;
			$customer->address->CssStyle = "";
			$customer->address->CssClass = "";
			$customer->address->ViewCustomAttributes = "";

			// date_lastlogin
			$customer->date_lastlogin->ViewValue = $customer->date_lastlogin->CurrentValue;
			$customer->date_lastlogin->ViewValue = ew_FormatDateTime($customer->date_lastlogin->ViewValue, 5);
			$customer->date_lastlogin->CssStyle = "";
			$customer->date_lastlogin->CssClass = "";
			$customer->date_lastlogin->ViewCustomAttributes = "";

			// date_register
			$customer->date_register->ViewValue = $customer->date_register->CurrentValue;
			$customer->date_register->ViewValue = ew_FormatDateTime($customer->date_register->ViewValue, 5);
			$customer->date_register->CssStyle = "";
			$customer->date_register->CssClass = "";
			$customer->date_register->ViewCustomAttributes = "";

			// status
			if (strval($customer->status->CurrentValue) <> "") {
				switch ($customer->status->CurrentValue) {
					case "1":
						$customer->status->ViewValue = "Active";
						break;
					case "2":
						$customer->status->ViewValue = "Not Active";
						break;
					default:
						$customer->status->ViewValue = $customer->status->CurrentValue;
				}
			} else {
				$customer->status->ViewValue = NULL;
			}
			$customer->status->CssStyle = "";
			$customer->status->CssClass = "";
			$customer->status->ViewCustomAttributes = "";

			// id
			$customer->id->HrefValue = "";

			// user_name
			$customer->user_name->HrefValue = "";

			// password
			$customer->password->HrefValue = "";

			// name
			$customer->name->HrefValue = "";

			// email
			$customer->email->HrefValue = "";

			// phone
			$customer->phone->HrefValue = "";

			// mobile
			$customer->mobile->HrefValue = "";

			// country
			$customer->country->HrefValue = "";

			// address
			$customer->address->HrefValue = "";

			// date_lastlogin
			$customer->date_lastlogin->HrefValue = "";

			// date_register
			$customer->date_register->HrefValue = "";

			// status
			$customer->status->HrefValue = "";
		}

		// Call Row Rendered event
		$customer->Row_Rendered();
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
