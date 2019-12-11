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
$contact_us_delete = new ccontact_us_delete();
$Page =& $contact_us_delete;

// Page init processing
$contact_us_delete->Page_Init();

// Page main processing
$contact_us_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var contact_us_delete = new ew_Page("contact_us_delete");

// page properties
contact_us_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = contact_us_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
contact_us_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
contact_us_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
contact_us_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
contact_us_delete.ShowHighlightText = "Show highlight"; 
contact_us_delete.HideHighlightText = "Hide highlight";

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
$rs = $contact_us_delete->LoadRecordset();
$contact_us_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($contact_us_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$contact_us_delete->Page_Terminate("contact_uslist.php"); // Return to list
}
?>
<div align="center" class="msm_h1">Delete From TABLE: Contact Us</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $contact_us->getReturnUrl() ?>">Go Back</a></span></p>
<?php $contact_us_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="contact_us">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($contact_us_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $contact_us->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">Name</td>
		<td valign="top">Email</td>
		<td valign="top">Phone</td>
		<td valign="top">Subject</td>
		<td valign="top">Receive Date</td>
	</tr>
	</thead>
	<tbody>
<?php
$contact_us_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$contact_us_delete->lRecCnt++;

	// Set row properties
	$contact_us->CssClass = "";
	$contact_us->CssStyle = "";
	$contact_us->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$contact_us_delete->LoadRowValues($rs);

	// Render row
	$contact_us_delete->RenderRow();
?>
	<tr<?php echo $contact_us->RowAttributes() ?>>
		<td<?php echo $contact_us->id->CellAttributes() ?>>
<div<?php echo $contact_us->id->ViewAttributes() ?>><?php echo $contact_us->id->ListViewValue() ?></div></td>
		<td<?php echo $contact_us->name->CellAttributes() ?>>
<div<?php echo $contact_us->name->ViewAttributes() ?>><?php echo $contact_us->name->ListViewValue() ?></div></td>
		<td<?php echo $contact_us->email->CellAttributes() ?>>
<div<?php echo $contact_us->email->ViewAttributes() ?>><?php echo $contact_us->email->ListViewValue() ?></div></td>
		<td<?php echo $contact_us->phone->CellAttributes() ?>>
<div<?php echo $contact_us->phone->ViewAttributes() ?>><?php echo $contact_us->phone->ListViewValue() ?></div></td>
		<td<?php echo $contact_us->subject->CellAttributes() ?>>
<div<?php echo $contact_us->subject->ViewAttributes() ?>><?php echo $contact_us->subject->ListViewValue() ?></div></td>
		<td<?php echo $contact_us->receive_date->CellAttributes() ?>>
<div<?php echo $contact_us->receive_date->ViewAttributes() ?>><?php echo $contact_us->receive_date->ListViewValue() ?></div></td>
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
class ccontact_us_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'contact_us';

	// Page Object Name
	var $PageObjName = 'contact_us_delete';

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
	function ccontact_us_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["contact_us"] = new ccontact_us();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $contact_us;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$contact_us->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($contact_us->id->QueryStringValue))
				$this->Page_Terminate("contact_uslist.php"); // Prevent SQL injection, exit
			$sKey .= $contact_us->id->QueryStringValue;
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
			$this->Page_Terminate("contact_uslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("contact_uslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in contact_us class, contact_usinfo.php

		$contact_us->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$contact_us->CurrentAction = $_POST["a_delete"];
		} else {
			$contact_us->CurrentAction = "I"; // Display record
		}
		switch ($contact_us->CurrentAction) {
			case "D": // Delete
				$contact_us->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($contact_us->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $contact_us;
		$DeleteRows = TRUE;
		$sWrkFilter = $contact_us->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in contact_us class, contact_usinfo.php

		$contact_us->CurrentFilter = $sWrkFilter;
		$sSql = $contact_us->SQL();
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
				$DeleteRows = $contact_us->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($contact_us->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($contact_us->CancelMessage <> "") {
				$this->setMessage($contact_us->CancelMessage);
				$contact_us->CancelMessage = "";
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
				$contact_us->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $contact_us;

		// Call Recordset Selecting event
		$contact_us->Recordset_Selecting($contact_us->CurrentFilter);

		// Load list page SQL
		$sSql = $contact_us->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$contact_us->Recordset_Selected($rs);
		return $rs;
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
