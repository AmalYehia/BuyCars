<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "manfactuererinfo.php" ?>
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
$manfactuerer_view = new cmanfactuerer_view();
$Page =& $manfactuerer_view;

// Page init processing
$manfactuerer_view->Page_Init();

// Page main processing
$manfactuerer_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($manfactuerer->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var manfactuerer_view = new ew_Page("manfactuerer_view");

// page properties
manfactuerer_view.PageID = "view"; // page ID
var EW_PAGE_ID = manfactuerer_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
manfactuerer_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
manfactuerer_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
manfactuerer_view.ValidateRequired = false; // no JavaScript validation
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
<div align="center" class="msm_h1">View TABLE: Manfactuerer</div>
<p><span class="phpmaker">
<br><br>
<?php if ($manfactuerer->Export == "") { ?>
<a href="manfactuererlist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $manfactuerer->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $manfactuerer->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $manfactuerer->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $manfactuerer_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($manfactuerer->id->Visible) { // id ?>
	<tr<?php echo $manfactuerer->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $manfactuerer->id->CellAttributes() ?>>
<div<?php echo $manfactuerer->id->ViewAttributes() ?>><?php echo $manfactuerer->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($manfactuerer->name->Visible) { // name ?>
	<tr<?php echo $manfactuerer->name->RowAttributes ?>>
		<td class="ewTableHeader">Name</td>
		<td<?php echo $manfactuerer->name->CellAttributes() ?>>
<div<?php echo $manfactuerer->name->ViewAttributes() ?>><?php echo $manfactuerer->name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($manfactuerer->logo->Visible) { // logo ?>
	<tr<?php echo $manfactuerer->logo->RowAttributes ?>>
		<td class="ewTableHeader">Logo</td>
		<td<?php echo $manfactuerer->logo->CellAttributes() ?>>
<?php if ($manfactuerer->logo->HrefValue <> "") { ?>
<?php if (!is_null($manfactuerer->logo->Upload->DbValue)) { ?>
<a href="<?php echo $manfactuerer->logo->HrefValue ?>"><?php echo $manfactuerer->logo->ViewValue ?></a>
<?php } elseif (!in_array($manfactuerer->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($manfactuerer->logo->Upload->DbValue)) { ?>
<?php echo $manfactuerer->logo->ViewValue ?>
<?php } elseif (!in_array($manfactuerer->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($manfactuerer->sort_order->Visible) { // sort_order ?>
	<tr<?php echo $manfactuerer->sort_order->RowAttributes ?>>
		<td class="ewTableHeader">Sort Order</td>
		<td<?php echo $manfactuerer->sort_order->CellAttributes() ?>>
<div<?php echo $manfactuerer->sort_order->ViewAttributes() ?>><?php echo $manfactuerer->sort_order->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($manfactuerer->status->Visible) { // status ?>
	<tr<?php echo $manfactuerer->status->RowAttributes ?>>
		<td class="ewTableHeader">Status</td>
		<td<?php echo $manfactuerer->status->CellAttributes() ?>>
<div<?php echo $manfactuerer->status->ViewAttributes() ?>><?php echo $manfactuerer->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($manfactuerer->Export == "") { ?>
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
class cmanfactuerer_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'manfactuerer';

	// Page Object Name
	var $PageObjName = 'manfactuerer_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $manfactuerer;
		if ($manfactuerer->UseTokenInUrl) $PageUrl .= "t=" . $manfactuerer->TableVar . "&"; // add page token
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
		global $objForm, $manfactuerer;
		if ($manfactuerer->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($manfactuerer->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($manfactuerer->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmanfactuerer_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["manfactuerer"] = new cmanfactuerer();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'manfactuerer', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $manfactuerer;
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
		global $manfactuerer;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$manfactuerer->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "manfactuererlist.php"; // Return to list
			}

			// Get action
			$manfactuerer->CurrentAction = "I"; // Display form
			switch ($manfactuerer->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "manfactuererlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "manfactuererlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$manfactuerer->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $manfactuerer;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$manfactuerer->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$manfactuerer->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $manfactuerer->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$manfactuerer->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$manfactuerer->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$manfactuerer->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $manfactuerer;
		$sFilter = $manfactuerer->KeyFilter();

		// Call Row Selecting event
		$manfactuerer->Row_Selecting($sFilter);

		// Load sql based on filter
		$manfactuerer->CurrentFilter = $sFilter;
		$sSql = $manfactuerer->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$manfactuerer->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $manfactuerer;
		$manfactuerer->id->setDbValue($rs->fields('id'));
		$manfactuerer->name->setDbValue($rs->fields('name'));
		$manfactuerer->logo->Upload->DbValue = $rs->fields('logo');
		$manfactuerer->sort_order->setDbValue($rs->fields('sort_order'));
		$manfactuerer->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $manfactuerer;

		// Call Row_Rendering event
		$manfactuerer->Row_Rendering();

		// Common render codes for all row types
		// id

		$manfactuerer->id->CellCssStyle = "";
		$manfactuerer->id->CellCssClass = "";

		// name
		$manfactuerer->name->CellCssStyle = "";
		$manfactuerer->name->CellCssClass = "";

		// logo
		$manfactuerer->logo->CellCssStyle = "";
		$manfactuerer->logo->CellCssClass = "";

		// sort_order
		$manfactuerer->sort_order->CellCssStyle = "";
		$manfactuerer->sort_order->CellCssClass = "";

		// status
		$manfactuerer->status->CellCssStyle = "";
		$manfactuerer->status->CellCssClass = "";
		if ($manfactuerer->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$manfactuerer->id->ViewValue = $manfactuerer->id->CurrentValue;
			$manfactuerer->id->CssStyle = "";
			$manfactuerer->id->CssClass = "";
			$manfactuerer->id->ViewCustomAttributes = "";

			// name
			$manfactuerer->name->ViewValue = $manfactuerer->name->CurrentValue;
			$manfactuerer->name->CssStyle = "";
			$manfactuerer->name->CssClass = "";
			$manfactuerer->name->ViewCustomAttributes = "";

			// logo
			if (!is_null($manfactuerer->logo->Upload->DbValue)) {
				$manfactuerer->logo->ViewValue = $manfactuerer->logo->Upload->DbValue;
			} else {
				$manfactuerer->logo->ViewValue = "";
			}
			$manfactuerer->logo->CssStyle = "";
			$manfactuerer->logo->CssClass = "";
			$manfactuerer->logo->ViewCustomAttributes = "";

			// sort_order
			$manfactuerer->sort_order->ViewValue = $manfactuerer->sort_order->CurrentValue;
			$manfactuerer->sort_order->CssStyle = "";
			$manfactuerer->sort_order->CssClass = "";
			$manfactuerer->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($manfactuerer->status->CurrentValue) <> "") {
				switch ($manfactuerer->status->CurrentValue) {
					case "1":
						$manfactuerer->status->ViewValue = "Active";
						break;
					case "2":
						$manfactuerer->status->ViewValue = "Not Active";
						break;
					default:
						$manfactuerer->status->ViewValue = $manfactuerer->status->CurrentValue;
				}
			} else {
				$manfactuerer->status->ViewValue = NULL;
			}
			$manfactuerer->status->CssStyle = "";
			$manfactuerer->status->CssClass = "";
			$manfactuerer->status->ViewCustomAttributes = "";

			// id
			$manfactuerer->id->HrefValue = "";

			// name
			$manfactuerer->name->HrefValue = "";

			// logo
			if (!is_null($manfactuerer->logo->Upload->DbValue)) {
				$manfactuerer->logo->HrefValue = ew_UploadPathEx(FALSE, "../upload/photo/") . ((!empty($manfactuerer->logo->ViewValue)) ? $manfactuerer->logo->ViewValue : $manfactuerer->logo->CurrentValue);
				if ($manfactuerer->Export <> "") $manfactuerer->logo->HrefValue = ew_ConvertFullUrl($manfactuerer->logo->HrefValue);
			} else {
				$manfactuerer->logo->HrefValue = "";
			}

			// sort_order
			$manfactuerer->sort_order->HrefValue = "";

			// status
			$manfactuerer->status->HrefValue = "";
		}

		// Call Row Rendered event
		$manfactuerer->Row_Rendered();
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
