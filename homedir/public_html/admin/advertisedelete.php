<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "advertiseinfo.php" ?>
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
$advertise_delete = new cadvertise_delete();
$Page =& $advertise_delete;

// Page init processing
$advertise_delete->Page_Init();

// Page main processing
$advertise_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var advertise_delete = new ew_Page("advertise_delete");

// page properties
advertise_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = advertise_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
advertise_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
advertise_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
advertise_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $advertise_delete->LoadRecordset();
$advertise_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($advertise_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$advertise_delete->Page_Terminate("advertiselist.php"); // Return to list
}
?>
<div align="center" class="msm_h1">Delete From TABLE: Advertise</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $advertise->getReturnUrl() ?>">Go Back</a></span></p>
<?php $advertise_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="advertise">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($advertise_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $advertise->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">Adv</td>
		<td valign="top">Status</td>
	</tr>
	</thead>
	<tbody>
<?php
$advertise_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$advertise_delete->lRecCnt++;

	// Set row properties
	$advertise->CssClass = "";
	$advertise->CssStyle = "";
	$advertise->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$advertise_delete->LoadRowValues($rs);

	// Render row
	$advertise_delete->RenderRow();
?>
	<tr<?php echo $advertise->RowAttributes() ?>>
		<td<?php echo $advertise->id->CellAttributes() ?>>
<div<?php echo $advertise->id->ViewAttributes() ?>><?php echo $advertise->id->ListViewValue() ?></div></td>
		<td<?php echo $advertise->adv->CellAttributes() ?>>
<?php if ($advertise->adv->HrefValue <> "") { ?>
<?php if (!is_null($advertise->adv->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/photo/") . $advertise->adv->Upload->DbValue ?>" border=0<?php echo $advertise->adv->ViewAttributes() ?>>
<?php } elseif (!in_array($advertise->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($advertise->adv->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/photo/") . $advertise->adv->Upload->DbValue ?>" border=0<?php echo $advertise->adv->ViewAttributes() ?>>
<?php } elseif (!in_array($advertise->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $advertise->status->CellAttributes() ?>>
<div<?php echo $advertise->status->ViewAttributes() ?>><?php echo $advertise->status->ListViewValue() ?></div></td>
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
class cadvertise_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'advertise';

	// Page Object Name
	var $PageObjName = 'advertise_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $advertise;
		if ($advertise->UseTokenInUrl) $PageUrl .= "t=" . $advertise->TableVar . "&"; // add page token
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
		global $objForm, $advertise;
		if ($advertise->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($advertise->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($advertise->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cadvertise_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["advertise"] = new cadvertise();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'advertise', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $advertise;
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
		global $advertise;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$advertise->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($advertise->id->QueryStringValue))
				$this->Page_Terminate("advertiselist.php"); // Prevent SQL injection, exit
			$sKey .= $advertise->id->QueryStringValue;
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
			$this->Page_Terminate("advertiselist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("advertiselist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in advertise class, advertiseinfo.php

		$advertise->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$advertise->CurrentAction = $_POST["a_delete"];
		} else {
			$advertise->CurrentAction = "I"; // Display record
		}
		switch ($advertise->CurrentAction) {
			case "D": // Delete
				$advertise->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($advertise->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $advertise;
		$DeleteRows = TRUE;
		$sWrkFilter = $advertise->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in advertise class, advertiseinfo.php

		$advertise->CurrentFilter = $sWrkFilter;
		$sSql = $advertise->SQL();
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
				$DeleteRows = $advertise->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($advertise->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($advertise->CancelMessage <> "") {
				$this->setMessage($advertise->CancelMessage);
				$advertise->CancelMessage = "";
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
				$advertise->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $advertise;

		// Call Recordset Selecting event
		$advertise->Recordset_Selecting($advertise->CurrentFilter);

		// Load list page SQL
		$sSql = $advertise->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$advertise->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $advertise;
		$sFilter = $advertise->KeyFilter();

		// Call Row Selecting event
		$advertise->Row_Selecting($sFilter);

		// Load sql based on filter
		$advertise->CurrentFilter = $sFilter;
		$sSql = $advertise->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$advertise->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $advertise;
		$advertise->id->setDbValue($rs->fields('id'));
		$advertise->adv->Upload->DbValue = $rs->fields('adv');
		$advertise->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $advertise;

		// Call Row_Rendering event
		$advertise->Row_Rendering();

		// Common render codes for all row types
		// id

		$advertise->id->CellCssStyle = "";
		$advertise->id->CellCssClass = "";

		// adv
		$advertise->adv->CellCssStyle = "";
		$advertise->adv->CellCssClass = "";

		// status
		$advertise->status->CellCssStyle = "";
		$advertise->status->CellCssClass = "";
		if ($advertise->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$advertise->id->ViewValue = $advertise->id->CurrentValue;
			$advertise->id->CssStyle = "";
			$advertise->id->CssClass = "";
			$advertise->id->ViewCustomAttributes = "";

			// adv
			if (!is_null($advertise->adv->Upload->DbValue)) {
				$advertise->adv->ViewValue = $advertise->adv->Upload->DbValue;
				$advertise->adv->ImageWidth = 200;
				$advertise->adv->ImageHeight = 0;
				$advertise->adv->ImageAlt = "";
			} else {
				$advertise->adv->ViewValue = "";
			}
			$advertise->adv->CssStyle = "";
			$advertise->adv->CssClass = "";
			$advertise->adv->ViewCustomAttributes = "";

			// status
			if (strval($advertise->status->CurrentValue) <> "") {
				switch ($advertise->status->CurrentValue) {
					case "1":
						$advertise->status->ViewValue = "Active";
						break;
					case "2":
						$advertise->status->ViewValue = "Not Active";
						break;
					default:
						$advertise->status->ViewValue = $advertise->status->CurrentValue;
				}
			} else {
				$advertise->status->ViewValue = NULL;
			}
			$advertise->status->CssStyle = "";
			$advertise->status->CssClass = "";
			$advertise->status->ViewCustomAttributes = "";

			// id
			$advertise->id->HrefValue = "";

			// adv
			$advertise->adv->HrefValue = "";

			// status
			$advertise->status->HrefValue = "";
		}

		// Call Row Rendered event
		$advertise->Row_Rendered();
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
