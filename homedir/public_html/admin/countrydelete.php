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
$country_delete = new ccountry_delete();
$Page =& $country_delete;

// Page init processing
$country_delete->Page_Init();

// Page main processing
$country_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var country_delete = new ew_Page("country_delete");

// page properties
country_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = country_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
country_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
country_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
country_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $country_delete->LoadRecordset();
$country_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($country_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$country_delete->Page_Terminate("countrylist.php"); // Return to list
}
?>
<div align="center" class="msm_h1">Delete From TABLE: Country</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $country->getReturnUrl() ?>">Go Back</a></span></p>
<?php $country_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="country">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($country_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $country->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">Name</td>
		<td valign="top">Status</td>
	</tr>
	</thead>
	<tbody>
<?php
$country_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$country_delete->lRecCnt++;

	// Set row properties
	$country->CssClass = "";
	$country->CssStyle = "";
	$country->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$country_delete->LoadRowValues($rs);

	// Render row
	$country_delete->RenderRow();
?>
	<tr<?php echo $country->RowAttributes() ?>>
		<td<?php echo $country->id->CellAttributes() ?>>
<div<?php echo $country->id->ViewAttributes() ?>><?php echo $country->id->ListViewValue() ?></div></td>
		<td<?php echo $country->name->CellAttributes() ?>>
<div<?php echo $country->name->ViewAttributes() ?>><?php echo $country->name->ListViewValue() ?></div></td>
		<td<?php echo $country->status->CellAttributes() ?>>
<div<?php echo $country->status->ViewAttributes() ?>><?php echo $country->status->ListViewValue() ?></div></td>
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
class ccountry_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'country';

	// Page Object Name
	var $PageObjName = 'country_delete';

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
	function ccountry_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["country"] = new ccountry();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $country;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$country->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($country->id->QueryStringValue))
				$this->Page_Terminate("countrylist.php"); // Prevent SQL injection, exit
			$sKey .= $country->id->QueryStringValue;
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
			$this->Page_Terminate("countrylist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("countrylist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in country class, countryinfo.php

		$country->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$country->CurrentAction = $_POST["a_delete"];
		} else {
			$country->CurrentAction = "I"; // Display record
		}
		switch ($country->CurrentAction) {
			case "D": // Delete
				$country->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($country->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $country;
		$DeleteRows = TRUE;
		$sWrkFilter = $country->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in country class, countryinfo.php

		$country->CurrentFilter = $sWrkFilter;
		$sSql = $country->SQL();
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
				$DeleteRows = $country->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($country->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($country->CancelMessage <> "") {
				$this->setMessage($country->CancelMessage);
				$country->CancelMessage = "";
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
				$country->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $country;

		// Call Recordset Selecting event
		$country->Recordset_Selecting($country->CurrentFilter);

		// Load list page SQL
		$sSql = $country->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$country->Recordset_Selected($rs);
		return $rs;
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
