<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "feature_productinfo.php" ?>
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
$feature_product_delete = new cfeature_product_delete();
$Page =& $feature_product_delete;

// Page init processing
$feature_product_delete->Page_Init();

// Page main processing
$feature_product_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var feature_product_delete = new ew_Page("feature_product_delete");

// page properties
feature_product_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = feature_product_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
feature_product_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
feature_product_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
feature_product_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $feature_product_delete->LoadRecordset();
$feature_product_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($feature_product_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$feature_product_delete->Page_Terminate("feature_productlist.php"); // Return to list
}
?>
<div align="center" class="msm_h1">Delete From TABLE: Feature Product</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $feature_product->getReturnUrl() ?>">Go Back</a></span></p>
<?php $feature_product_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="feature_product">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($feature_product_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $feature_product->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">Product Id</td>
		<td valign="top">Sort Order</td>
		<td valign="top">Status</td>
	</tr>
	</thead>
	<tbody>
<?php
$feature_product_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$feature_product_delete->lRecCnt++;

	// Set row properties
	$feature_product->CssClass = "";
	$feature_product->CssStyle = "";
	$feature_product->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$feature_product_delete->LoadRowValues($rs);

	// Render row
	$feature_product_delete->RenderRow();
?>
	<tr<?php echo $feature_product->RowAttributes() ?>>
		<td<?php echo $feature_product->id->CellAttributes() ?>>
<div<?php echo $feature_product->id->ViewAttributes() ?>><?php echo $feature_product->id->ListViewValue() ?></div></td>
		<td<?php echo $feature_product->product_id->CellAttributes() ?>>
<div<?php echo $feature_product->product_id->ViewAttributes() ?>><?php echo $feature_product->product_id->ListViewValue() ?></div></td>
		<td<?php echo $feature_product->sort_order->CellAttributes() ?>>
<div<?php echo $feature_product->sort_order->ViewAttributes() ?>><?php echo $feature_product->sort_order->ListViewValue() ?></div></td>
		<td<?php echo $feature_product->status->CellAttributes() ?>>
<div<?php echo $feature_product->status->ViewAttributes() ?>><?php echo $feature_product->status->ListViewValue() ?></div></td>
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
class cfeature_product_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'feature_product';

	// Page Object Name
	var $PageObjName = 'feature_product_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $feature_product;
		if ($feature_product->UseTokenInUrl) $PageUrl .= "t=" . $feature_product->TableVar . "&"; // add page token
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
		global $objForm, $feature_product;
		if ($feature_product->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($feature_product->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($feature_product->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cfeature_product_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["feature_product"] = new cfeature_product();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'feature_product', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $feature_product;
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
		global $feature_product;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$feature_product->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($feature_product->id->QueryStringValue))
				$this->Page_Terminate("feature_productlist.php"); // Prevent SQL injection, exit
			$sKey .= $feature_product->id->QueryStringValue;
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
			$this->Page_Terminate("feature_productlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("feature_productlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in feature_product class, feature_productinfo.php

		$feature_product->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$feature_product->CurrentAction = $_POST["a_delete"];
		} else {
			$feature_product->CurrentAction = "I"; // Display record
		}
		switch ($feature_product->CurrentAction) {
			case "D": // Delete
				$feature_product->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($feature_product->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $feature_product;
		$DeleteRows = TRUE;
		$sWrkFilter = $feature_product->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in feature_product class, feature_productinfo.php

		$feature_product->CurrentFilter = $sWrkFilter;
		$sSql = $feature_product->SQL();
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
				$DeleteRows = $feature_product->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($feature_product->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($feature_product->CancelMessage <> "") {
				$this->setMessage($feature_product->CancelMessage);
				$feature_product->CancelMessage = "";
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
				$feature_product->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $feature_product;

		// Call Recordset Selecting event
		$feature_product->Recordset_Selecting($feature_product->CurrentFilter);

		// Load list page SQL
		$sSql = $feature_product->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$feature_product->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $feature_product;
		$sFilter = $feature_product->KeyFilter();

		// Call Row Selecting event
		$feature_product->Row_Selecting($sFilter);

		// Load sql based on filter
		$feature_product->CurrentFilter = $sFilter;
		$sSql = $feature_product->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$feature_product->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $feature_product;
		$feature_product->id->setDbValue($rs->fields('id'));
		$feature_product->product_id->setDbValue($rs->fields('product_id'));
		$feature_product->sort_order->setDbValue($rs->fields('sort_order'));
		$feature_product->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $feature_product;

		// Call Row_Rendering event
		$feature_product->Row_Rendering();

		// Common render codes for all row types
		// id

		$feature_product->id->CellCssStyle = "";
		$feature_product->id->CellCssClass = "";

		// product_id
		$feature_product->product_id->CellCssStyle = "";
		$feature_product->product_id->CellCssClass = "";

		// sort_order
		$feature_product->sort_order->CellCssStyle = "";
		$feature_product->sort_order->CellCssClass = "";

		// status
		$feature_product->status->CellCssStyle = "";
		$feature_product->status->CellCssClass = "";
		if ($feature_product->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$feature_product->id->ViewValue = $feature_product->id->CurrentValue;
			$feature_product->id->CssStyle = "";
			$feature_product->id->CssClass = "";
			$feature_product->id->ViewCustomAttributes = "";

			// product_id
			$feature_product->product_id->ViewValue = $feature_product->product_id->CurrentValue;
			$feature_product->product_id->CssStyle = "";
			$feature_product->product_id->CssClass = "";
			$feature_product->product_id->ViewCustomAttributes = "";

			// sort_order
			$feature_product->sort_order->ViewValue = $feature_product->sort_order->CurrentValue;
			$feature_product->sort_order->CssStyle = "";
			$feature_product->sort_order->CssClass = "";
			$feature_product->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($feature_product->status->CurrentValue) <> "") {
				switch ($feature_product->status->CurrentValue) {
					case "1":
						$feature_product->status->ViewValue = "Active";
						break;
					case "2":
						$feature_product->status->ViewValue = "Not Active";
						break;
					default:
						$feature_product->status->ViewValue = $feature_product->status->CurrentValue;
				}
			} else {
				$feature_product->status->ViewValue = NULL;
			}
			$feature_product->status->CssStyle = "";
			$feature_product->status->CssClass = "";
			$feature_product->status->ViewCustomAttributes = "";

			// id
			$feature_product->id->HrefValue = "";

			// product_id
			$feature_product->product_id->HrefValue = "";

			// sort_order
			$feature_product->sort_order->HrefValue = "";

			// status
			$feature_product->status->HrefValue = "";
		}

		// Call Row Rendered event
		$feature_product->Row_Rendered();
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
