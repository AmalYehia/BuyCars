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
$manfactuerer_delete = new cmanfactuerer_delete();
$Page =& $manfactuerer_delete;

// Page init processing
$manfactuerer_delete->Page_Init();

// Page main processing
$manfactuerer_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var manfactuerer_delete = new ew_Page("manfactuerer_delete");

// page properties
manfactuerer_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = manfactuerer_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
manfactuerer_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
manfactuerer_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
manfactuerer_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $manfactuerer_delete->LoadRecordset();
$manfactuerer_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($manfactuerer_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$manfactuerer_delete->Page_Terminate("manfactuererlist.php"); // Return to list
}
?>
<div align="center" class="msm_h1">Delete From TABLE: Manfactuerer</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $manfactuerer->getReturnUrl() ?>">Go Back</a></span></p>
<?php $manfactuerer_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="manfactuerer">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($manfactuerer_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $manfactuerer->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">Name</td>
		<td valign="top">Logo</td>
		<td valign="top">Sort Order</td>
		<td valign="top">Status</td>
	</tr>
	</thead>
	<tbody>
<?php
$manfactuerer_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$manfactuerer_delete->lRecCnt++;

	// Set row properties
	$manfactuerer->CssClass = "";
	$manfactuerer->CssStyle = "";
	$manfactuerer->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$manfactuerer_delete->LoadRowValues($rs);

	// Render row
	$manfactuerer_delete->RenderRow();
?>
	<tr<?php echo $manfactuerer->RowAttributes() ?>>
		<td<?php echo $manfactuerer->id->CellAttributes() ?>>
<div<?php echo $manfactuerer->id->ViewAttributes() ?>><?php echo $manfactuerer->id->ListViewValue() ?></div></td>
		<td<?php echo $manfactuerer->name->CellAttributes() ?>>
<div<?php echo $manfactuerer->name->ViewAttributes() ?>><?php echo $manfactuerer->name->ListViewValue() ?></div></td>
		<td<?php echo $manfactuerer->logo->CellAttributes() ?>>
<?php if ($manfactuerer->logo->HrefValue <> "") { ?>
<?php if (!is_null($manfactuerer->logo->Upload->DbValue)) { ?>
<a href="<?php echo $manfactuerer->logo->HrefValue ?>"><?php echo $manfactuerer->logo->ListViewValue() ?></a>
<?php } elseif (!in_array($manfactuerer->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($manfactuerer->logo->Upload->DbValue)) { ?>
<?php echo $manfactuerer->logo->ListViewValue() ?>
<?php } elseif (!in_array($manfactuerer->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $manfactuerer->sort_order->CellAttributes() ?>>
<div<?php echo $manfactuerer->sort_order->ViewAttributes() ?>><?php echo $manfactuerer->sort_order->ListViewValue() ?></div></td>
		<td<?php echo $manfactuerer->status->CellAttributes() ?>>
<div<?php echo $manfactuerer->status->ViewAttributes() ?>><?php echo $manfactuerer->status->ListViewValue() ?></div></td>
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
class cmanfactuerer_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'manfactuerer';

	// Page Object Name
	var $PageObjName = 'manfactuerer_delete';

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
	function cmanfactuerer_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["manfactuerer"] = new cmanfactuerer();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $manfactuerer;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$manfactuerer->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($manfactuerer->id->QueryStringValue))
				$this->Page_Terminate("manfactuererlist.php"); // Prevent SQL injection, exit
			$sKey .= $manfactuerer->id->QueryStringValue;
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
			$this->Page_Terminate("manfactuererlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("manfactuererlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in manfactuerer class, manfactuererinfo.php

		$manfactuerer->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$manfactuerer->CurrentAction = $_POST["a_delete"];
		} else {
			$manfactuerer->CurrentAction = "I"; // Display record
		}
		switch ($manfactuerer->CurrentAction) {
			case "D": // Delete
				$manfactuerer->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($manfactuerer->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $manfactuerer;
		$DeleteRows = TRUE;
		$sWrkFilter = $manfactuerer->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in manfactuerer class, manfactuererinfo.php

		$manfactuerer->CurrentFilter = $sWrkFilter;
		$sSql = $manfactuerer->SQL();
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
				$DeleteRows = $manfactuerer->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($manfactuerer->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($manfactuerer->CancelMessage <> "") {
				$this->setMessage($manfactuerer->CancelMessage);
				$manfactuerer->CancelMessage = "";
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
				$manfactuerer->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $manfactuerer;

		// Call Recordset Selecting event
		$manfactuerer->Recordset_Selecting($manfactuerer->CurrentFilter);

		// Load list page SQL
		$sSql = $manfactuerer->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$manfactuerer->Recordset_Selected($rs);
		return $rs;
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
