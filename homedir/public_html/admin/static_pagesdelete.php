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
$static_pages_delete = new cstatic_pages_delete();
$Page =& $static_pages_delete;

// Page init processing
$static_pages_delete->Page_Init();

// Page main processing
$static_pages_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var static_pages_delete = new ew_Page("static_pages_delete");

// page properties
static_pages_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = static_pages_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
static_pages_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
static_pages_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
static_pages_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php

// Load records for display
$rs = $static_pages_delete->LoadRecordset();
$static_pages_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($static_pages_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$static_pages_delete->Page_Terminate("static_pageslist.php"); // Return to list
}
?>
<div align="center" class="msm_h1">Delete From TABLE: Static Pages</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $static_pages->getReturnUrl() ?>">Go Back</a></span></p>
<?php $static_pages_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="static_pages">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($static_pages_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $static_pages->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">Header</td>
	</tr>
	</thead>
	<tbody>
<?php
$static_pages_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$static_pages_delete->lRecCnt++;

	// Set row properties
	$static_pages->CssClass = "";
	$static_pages->CssStyle = "";
	$static_pages->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$static_pages_delete->LoadRowValues($rs);

	// Render row
	$static_pages_delete->RenderRow();
?>
	<tr<?php echo $static_pages->RowAttributes() ?>>
		<td<?php echo $static_pages->id->CellAttributes() ?>>
<div<?php echo $static_pages->id->ViewAttributes() ?>><?php echo $static_pages->id->ListViewValue() ?></div></td>
		<td<?php echo $static_pages->header->CellAttributes() ?>>
<div<?php echo $static_pages->header->ViewAttributes() ?>><?php echo $static_pages->header->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="Confirm Delete">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php

//
// Page Class
//
class cstatic_pages_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'static_pages';

	// Page Object Name
	var $PageObjName = 'static_pages_delete';

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
	function cstatic_pages_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["static_pages"] = new cstatic_pages();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $static_pages;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$static_pages->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($static_pages->id->QueryStringValue))
				$this->Page_Terminate("static_pageslist.php"); // Prevent SQL injection, exit
			$sKey .= $static_pages->id->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("static_pageslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("static_pageslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in static_pages class, static_pagesinfo.php

		$static_pages->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$static_pages->CurrentAction = $_POST["a_delete"];
		} else {
			$static_pages->CurrentAction = "I"; // Display record
		}
		switch ($static_pages->CurrentAction) {
			case "D": // Delete
				$static_pages->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($static_pages->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $static_pages;
		$DeleteRows = TRUE;
		$sWrkFilter = $static_pages->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in static_pages class, static_pagesinfo.php

		$static_pages->CurrentFilter = $sWrkFilter;
		$sSql = $static_pages->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage("No records found"); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs) $rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $static_pages->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($static_pages->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($static_pages->CancelMessage <> "") {
				$this->setMessage($static_pages->CancelMessage);
				$static_pages->CancelMessage = "";
			} else {
				$this->setMessage("Delete cancelled");
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call recordset deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$static_pages->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $static_pages;

		// Call Recordset Selecting event
		$static_pages->Recordset_Selecting($static_pages->CurrentFilter);

		// Load list page SQL
		$sSql = $static_pages->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$static_pages->Recordset_Selected($rs);
		return $rs;
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

			// id
			$static_pages->id->HrefValue = "";

			// header
			$static_pages->header->HrefValue = "";
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
