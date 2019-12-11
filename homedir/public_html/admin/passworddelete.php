<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
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
$password_delete = new cpassword_delete();
$Page =& $password_delete;

// Page init processing
$password_delete->Page_Init();

// Page main processing
$password_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var password_delete = new ew_Page("password_delete");

// page properties
password_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = password_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
password_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
password_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
password_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $password_delete->LoadRecordset();
$password_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($password_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$password_delete->Page_Terminate("passwordlist.php"); // Return to list
}
?>
<div align="center" class="msm_h1">Delete From TABLE: Password</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $password->getReturnUrl() ?>">Go Back</a></span></p>
<?php $password_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="password">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($password_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $password->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">User Name</td>
		<td valign="top">Password</td>
	</tr>
	</thead>
	<tbody>
<?php
$password_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$password_delete->lRecCnt++;

	// Set row properties
	$password->CssClass = "";
	$password->CssStyle = "";
	$password->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$password_delete->LoadRowValues($rs);

	// Render row
	$password_delete->RenderRow();
?>
	<tr<?php echo $password->RowAttributes() ?>>
		<td<?php echo $password->id->CellAttributes() ?>>
<div<?php echo $password->id->ViewAttributes() ?>><?php echo $password->id->ListViewValue() ?></div></td>
		<td<?php echo $password->user_name->CellAttributes() ?>>
<div<?php echo $password->user_name->ViewAttributes() ?>><?php echo $password->user_name->ListViewValue() ?></div></td>
		<td<?php echo $password->password->CellAttributes() ?>>
<div<?php echo $password->password->ViewAttributes() ?>><?php echo $password->password->ListViewValue() ?></div></td>
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
class cpassword_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'password';

	// Page Object Name
	var $PageObjName = 'password_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $password;
		if ($password->UseTokenInUrl) $PageUrl .= "t=" . $password->TableVar . "&"; // add page token
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
		global $objForm, $password;
		if ($password->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($password->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($password->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cpassword_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["password"] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'password', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $password;
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
		global $password;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$password->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($password->id->QueryStringValue))
				$this->Page_Terminate("passwordlist.php"); // Prevent SQL injection, exit
			$sKey .= $password->id->QueryStringValue;
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
			$this->Page_Terminate("passwordlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("passwordlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in password class, passwordinfo.php

		$password->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$password->CurrentAction = $_POST["a_delete"];
		} else {
			$password->CurrentAction = "I"; // Display record
		}
		switch ($password->CurrentAction) {
			case "D": // Delete
				$password->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($password->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $password;
		$DeleteRows = TRUE;
		$sWrkFilter = $password->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in password class, passwordinfo.php

		$password->CurrentFilter = $sWrkFilter;
		$sSql = $password->SQL();
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
				$DeleteRows = $password->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($password->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($password->CancelMessage <> "") {
				$this->setMessage($password->CancelMessage);
				$password->CancelMessage = "";
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
				$password->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $password;

		// Call Recordset Selecting event
		$password->Recordset_Selecting($password->CurrentFilter);

		// Load list page SQL
		$sSql = $password->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$password->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $password;
		$sFilter = $password->KeyFilter();

		// Call Row Selecting event
		$password->Row_Selecting($sFilter);

		// Load sql based on filter
		$password->CurrentFilter = $sFilter;
		$sSql = $password->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$password->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $password;
		$password->id->setDbValue($rs->fields('id'));
		$password->user_name->setDbValue($rs->fields('user_name'));
		$password->password->setDbValue($rs->fields('password'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $password;

		// Call Row_Rendering event
		$password->Row_Rendering();

		// Common render codes for all row types
		// id

		$password->id->CellCssStyle = "";
		$password->id->CellCssClass = "";

		// user_name
		$password->user_name->CellCssStyle = "";
		$password->user_name->CellCssClass = "";

		// password
		$password->password->CellCssStyle = "";
		$password->password->CellCssClass = "";
		if ($password->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$password->id->ViewValue = $password->id->CurrentValue;
			$password->id->CssStyle = "";
			$password->id->CssClass = "";
			$password->id->ViewCustomAttributes = "";

			// user_name
			$password->user_name->ViewValue = $password->user_name->CurrentValue;
			$password->user_name->CssStyle = "";
			$password->user_name->CssClass = "";
			$password->user_name->ViewCustomAttributes = "";

			// password
			$password->password->ViewValue = $password->password->CurrentValue;
			$password->password->CssStyle = "";
			$password->password->CssClass = "";
			$password->password->ViewCustomAttributes = "";

			// id
			$password->id->HrefValue = "";

			// user_name
			$password->user_name->HrefValue = "";

			// password
			$password->password->HrefValue = "";
		}

		// Call Row Rendered event
		$password->Row_Rendered();
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
