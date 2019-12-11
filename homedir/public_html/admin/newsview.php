<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "newsinfo.php" ?>
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
$news_view = new cnews_view();
$Page =& $news_view;

// Page init processing
$news_view->Page_Init();

// Page main processing
$news_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($news->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var news_view = new ew_Page("news_view");

// page properties
news_view.PageID = "view"; // page ID
var EW_PAGE_ID = news_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
news_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
news_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
news_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
news_view.ShowHighlightText = "Show highlight"; 
news_view.HideHighlightText = "Hide highlight";

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
<div align="center" class="msm_h1">View TABLE: News</div>
<p><span class="phpmaker">
<br><br>
<?php if ($news->Export == "") { ?>
<a href="newslist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $news->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $news->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $news->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $news_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($news->id->Visible) { // id ?>
	<tr<?php echo $news->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $news->id->CellAttributes() ?>>
<div<?php echo $news->id->ViewAttributes() ?>><?php echo $news->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($news->header->Visible) { // header ?>
	<tr<?php echo $news->header->RowAttributes ?>>
		<td class="ewTableHeader">Header</td>
		<td<?php echo $news->header->CellAttributes() ?>>
<div<?php echo $news->header->ViewAttributes() ?>><?php echo $news->header->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($news->photo->Visible) { // photo ?>
	<tr<?php echo $news->photo->RowAttributes ?>>
		<td class="ewTableHeader">Photo</td>
		<td<?php echo $news->photo->CellAttributes() ?>>
<?php if ($news->photo->HrefValue <> "") { ?>
<?php if (!is_null($news->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $news->photo->Upload->DbValue ?>" border=0<?php echo $news->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($news->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($news->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $news->photo->Upload->DbValue ?>" border=0<?php echo $news->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($news->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($news->short_desc->Visible) { // short_desc ?>
	<tr<?php echo $news->short_desc->RowAttributes ?>>
		<td class="ewTableHeader">Short Desc</td>
		<td<?php echo $news->short_desc->CellAttributes() ?>>
<div<?php echo $news->short_desc->ViewAttributes() ?>><?php echo $news->short_desc->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($news->full_desc->Visible) { // full_desc ?>
	<tr<?php echo $news->full_desc->RowAttributes ?>>
		<td class="ewTableHeader">Full Desc</td>
		<td<?php echo $news->full_desc->CellAttributes() ?>>
<div<?php echo $news->full_desc->ViewAttributes() ?>><?php echo $news->full_desc->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($news->insert_date->Visible) { // insert_date ?>
	<tr<?php echo $news->insert_date->RowAttributes ?>>
		<td class="ewTableHeader">Insert Date</td>
		<td<?php echo $news->insert_date->CellAttributes() ?>>
<div<?php echo $news->insert_date->ViewAttributes() ?>><?php echo $news->insert_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($news->status->Visible) { // status ?>
	<tr<?php echo $news->status->RowAttributes ?>>
		<td class="ewTableHeader">Status</td>
		<td<?php echo $news->status->CellAttributes() ?>>
<div<?php echo $news->status->ViewAttributes() ?>><?php echo $news->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($news->Export == "") { ?>
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
class cnews_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'news';

	// Page Object Name
	var $PageObjName = 'news_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $news;
		if ($news->UseTokenInUrl) $PageUrl .= "t=" . $news->TableVar . "&"; // add page token
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
		global $objForm, $news;
		if ($news->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($news->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($news->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cnews_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["news"] = new cnews();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'news', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $news;
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
		global $news;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$news->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "newslist.php"; // Return to list
			}

			// Get action
			$news->CurrentAction = "I"; // Display form
			switch ($news->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "newslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "newslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$news->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $news;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$news->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$news->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $news->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$news->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$news->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$news->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $news;
		$sFilter = $news->KeyFilter();

		// Call Row Selecting event
		$news->Row_Selecting($sFilter);

		// Load sql based on filter
		$news->CurrentFilter = $sFilter;
		$sSql = $news->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$news->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $news;
		$news->id->setDbValue($rs->fields('id'));
		$news->header->setDbValue($rs->fields('header'));
		$news->photo->Upload->DbValue = $rs->fields('photo');
		$news->short_desc->setDbValue($rs->fields('short_desc'));
		$news->full_desc->setDbValue($rs->fields('full_desc'));
		$news->insert_date->setDbValue($rs->fields('insert_date'));
		$news->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $news;

		// Call Row_Rendering event
		$news->Row_Rendering();

		// Common render codes for all row types
		// id

		$news->id->CellCssStyle = "";
		$news->id->CellCssClass = "";

		// header
		$news->header->CellCssStyle = "";
		$news->header->CellCssClass = "";

		// photo
		$news->photo->CellCssStyle = "";
		$news->photo->CellCssClass = "";

		// short_desc
		$news->short_desc->CellCssStyle = "";
		$news->short_desc->CellCssClass = "";

		// full_desc
		$news->full_desc->CellCssStyle = "";
		$news->full_desc->CellCssClass = "";

		// insert_date
		$news->insert_date->CellCssStyle = "";
		$news->insert_date->CellCssClass = "";

		// status
		$news->status->CellCssStyle = "";
		$news->status->CellCssClass = "";
		if ($news->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$news->id->ViewValue = $news->id->CurrentValue;
			$news->id->CssStyle = "";
			$news->id->CssClass = "";
			$news->id->ViewCustomAttributes = "";

			// header
			$news->header->ViewValue = $news->header->CurrentValue;
			$news->header->CssStyle = "";
			$news->header->CssClass = "";
			$news->header->ViewCustomAttributes = "";

			// photo
			if (!is_null($news->photo->Upload->DbValue)) {
				$news->photo->ViewValue = $news->photo->Upload->DbValue;
				$news->photo->ImageWidth = 100;
				$news->photo->ImageHeight = 0;
				$news->photo->ImageAlt = "";
			} else {
				$news->photo->ViewValue = "";
			}
			$news->photo->CssStyle = "";
			$news->photo->CssClass = "";
			$news->photo->ViewCustomAttributes = "";

			// short_desc
			$news->short_desc->ViewValue = $news->short_desc->CurrentValue;
			$news->short_desc->CssStyle = "";
			$news->short_desc->CssClass = "";
			$news->short_desc->ViewCustomAttributes = "";

			// full_desc
			$news->full_desc->ViewValue = $news->full_desc->CurrentValue;
			$news->full_desc->CssStyle = "";
			$news->full_desc->CssClass = "";
			$news->full_desc->ViewCustomAttributes = "";

			// insert_date
			$news->insert_date->ViewValue = $news->insert_date->CurrentValue;
			$news->insert_date->ViewValue = ew_FormatDateTime($news->insert_date->ViewValue, 5);
			$news->insert_date->CssStyle = "";
			$news->insert_date->CssClass = "";
			$news->insert_date->ViewCustomAttributes = "";

			// status
			if (strval($news->status->CurrentValue) <> "") {
				switch ($news->status->CurrentValue) {
					case "1":
						$news->status->ViewValue = "Active";
						break;
					case "2":
						$news->status->ViewValue = "Not Active";
						break;
					default:
						$news->status->ViewValue = $news->status->CurrentValue;
				}
			} else {
				$news->status->ViewValue = NULL;
			}
			$news->status->CssStyle = "";
			$news->status->CssClass = "";
			$news->status->ViewCustomAttributes = "";

			// id
			$news->id->HrefValue = "";

			// header
			$news->header->HrefValue = "";

			// photo
			$news->photo->HrefValue = "";

			// short_desc
			$news->short_desc->HrefValue = "";

			// full_desc
			$news->full_desc->HrefValue = "";

			// insert_date
			$news->insert_date->HrefValue = "";

			// status
			$news->status->HrefValue = "";
		}

		// Call Row Rendered event
		$news->Row_Rendered();
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
