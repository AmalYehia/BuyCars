<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "cat_p_photoinfo.php" ?>
<?php include "cat_productinfo.php" ?>
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
$cat_p_photo_delete = new ccat_p_photo_delete();
$Page =& $cat_p_photo_delete;

// Page init processing
$cat_p_photo_delete->Page_Init();

// Page main processing
$cat_p_photo_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var cat_p_photo_delete = new ew_Page("cat_p_photo_delete");

// page properties
cat_p_photo_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = cat_p_photo_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
cat_p_photo_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
cat_p_photo_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cat_p_photo_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $cat_p_photo_delete->LoadRecordset();
$cat_p_photo_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($cat_p_photo_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$cat_p_photo_delete->Page_Terminate("cat_p_photolist.php"); // Return to list
}
?>
<div align="center" class="msm_h1">Delete From TABLE: Cat P Photo</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $cat_p_photo->getReturnUrl() ?>">Go Back</a></span></p>
<?php $cat_p_photo_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="cat_p_photo">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($cat_p_photo_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $cat_p_photo->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">Product Id</td>
		<td valign="top">Photo</td>
		<td valign="top">Sort Order</td>
		<td valign="top">Status</td>
	</tr>
	</thead>
	<tbody>
<?php
$cat_p_photo_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$cat_p_photo_delete->lRecCnt++;

	// Set row properties
	$cat_p_photo->CssClass = "";
	$cat_p_photo->CssStyle = "";
	$cat_p_photo->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$cat_p_photo_delete->LoadRowValues($rs);

	// Render row
	$cat_p_photo_delete->RenderRow();
?>
	<tr<?php echo $cat_p_photo->RowAttributes() ?>>
		<td<?php echo $cat_p_photo->id->CellAttributes() ?>>
<div<?php echo $cat_p_photo->id->ViewAttributes() ?>><?php echo $cat_p_photo->id->ListViewValue() ?></div></td>
		<td<?php echo $cat_p_photo->product_id->CellAttributes() ?>>
<div<?php echo $cat_p_photo->product_id->ViewAttributes() ?>><?php echo $cat_p_photo->product_id->ListViewValue() ?></div></td>
		<td<?php echo $cat_p_photo->photo->CellAttributes() ?>>
<?php if ($cat_p_photo->photo->HrefValue <> "") { ?>
<?php if (!is_null($cat_p_photo->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $cat_p_photo->photo->Upload->DbValue ?>" border=0<?php echo $cat_p_photo->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($cat_p_photo->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($cat_p_photo->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $cat_p_photo->photo->Upload->DbValue ?>" border=0<?php echo $cat_p_photo->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($cat_p_photo->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $cat_p_photo->sort_order->CellAttributes() ?>>
<div<?php echo $cat_p_photo->sort_order->ViewAttributes() ?>><?php echo $cat_p_photo->sort_order->ListViewValue() ?></div></td>
		<td<?php echo $cat_p_photo->status->CellAttributes() ?>>
<div<?php echo $cat_p_photo->status->ViewAttributes() ?>><?php echo $cat_p_photo->status->ListViewValue() ?></div></td>
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
class ccat_p_photo_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'cat_p_photo';

	// Page Object Name
	var $PageObjName = 'cat_p_photo_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $cat_p_photo;
		if ($cat_p_photo->UseTokenInUrl) $PageUrl .= "t=" . $cat_p_photo->TableVar . "&"; // add page token
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
		global $objForm, $cat_p_photo;
		if ($cat_p_photo->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($cat_p_photo->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($cat_p_photo->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccat_p_photo_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["cat_p_photo"] = new ccat_p_photo();

		// Initialize other table object
		$GLOBALS['cat_product'] = new ccat_product();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cat_p_photo', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $cat_p_photo;
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
		global $cat_p_photo;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$cat_p_photo->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($cat_p_photo->id->QueryStringValue))
				$this->Page_Terminate("cat_p_photolist.php"); // Prevent SQL injection, exit
			$sKey .= $cat_p_photo->id->QueryStringValue;
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
			$this->Page_Terminate("cat_p_photolist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("cat_p_photolist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in cat_p_photo class, cat_p_photoinfo.php

		$cat_p_photo->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$cat_p_photo->CurrentAction = $_POST["a_delete"];
		} else {
			$cat_p_photo->CurrentAction = "I"; // Display record
		}
		switch ($cat_p_photo->CurrentAction) {
			case "D": // Delete
				$cat_p_photo->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($cat_p_photo->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $cat_p_photo;
		$DeleteRows = TRUE;
		$sWrkFilter = $cat_p_photo->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in cat_p_photo class, cat_p_photoinfo.php

		$cat_p_photo->CurrentFilter = $sWrkFilter;
		$sSql = $cat_p_photo->SQL();
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
				$DeleteRows = $cat_p_photo->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($cat_p_photo->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($cat_p_photo->CancelMessage <> "") {
				$this->setMessage($cat_p_photo->CancelMessage);
				$cat_p_photo->CancelMessage = "";
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
				$cat_p_photo->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $cat_p_photo;

		// Call Recordset Selecting event
		$cat_p_photo->Recordset_Selecting($cat_p_photo->CurrentFilter);

		// Load list page SQL
		$sSql = $cat_p_photo->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$cat_p_photo->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $cat_p_photo;
		$sFilter = $cat_p_photo->KeyFilter();

		// Call Row Selecting event
		$cat_p_photo->Row_Selecting($sFilter);

		// Load sql based on filter
		$cat_p_photo->CurrentFilter = $sFilter;
		$sSql = $cat_p_photo->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$cat_p_photo->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $cat_p_photo;
		$cat_p_photo->id->setDbValue($rs->fields('id'));
		$cat_p_photo->product_id->setDbValue($rs->fields('product_id'));
		$cat_p_photo->photo->Upload->DbValue = $rs->fields('photo');
		$cat_p_photo->sort_order->setDbValue($rs->fields('sort_order'));
		$cat_p_photo->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $cat_p_photo;

		// Call Row_Rendering event
		$cat_p_photo->Row_Rendering();

		// Common render codes for all row types
		// id

		$cat_p_photo->id->CellCssStyle = "";
		$cat_p_photo->id->CellCssClass = "";

		// product_id
		$cat_p_photo->product_id->CellCssStyle = "";
		$cat_p_photo->product_id->CellCssClass = "";

		// photo
		$cat_p_photo->photo->CellCssStyle = "";
		$cat_p_photo->photo->CellCssClass = "";

		// sort_order
		$cat_p_photo->sort_order->CellCssStyle = "";
		$cat_p_photo->sort_order->CellCssClass = "";

		// status
		$cat_p_photo->status->CellCssStyle = "";
		$cat_p_photo->status->CellCssClass = "";
		if ($cat_p_photo->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$cat_p_photo->id->ViewValue = $cat_p_photo->id->CurrentValue;
			$cat_p_photo->id->CssStyle = "";
			$cat_p_photo->id->CssClass = "";
			$cat_p_photo->id->ViewCustomAttributes = "";

			// product_id
			if (strval($cat_p_photo->product_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name` FROM `cat_product` WHERE `id` = " . ew_AdjustSql($cat_p_photo->product_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$cat_p_photo->product_id->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$cat_p_photo->product_id->ViewValue = $cat_p_photo->product_id->CurrentValue;
				}
			} else {
				$cat_p_photo->product_id->ViewValue = NULL;
			}
			$cat_p_photo->product_id->CssStyle = "";
			$cat_p_photo->product_id->CssClass = "";
			$cat_p_photo->product_id->ViewCustomAttributes = "";

			// photo
			if (!is_null($cat_p_photo->photo->Upload->DbValue)) {
				$cat_p_photo->photo->ViewValue = $cat_p_photo->photo->Upload->DbValue;
				$cat_p_photo->photo->ImageWidth = 120;
				$cat_p_photo->photo->ImageHeight = 0;
				$cat_p_photo->photo->ImageAlt = "";
			} else {
				$cat_p_photo->photo->ViewValue = "";
			}
			$cat_p_photo->photo->CssStyle = "";
			$cat_p_photo->photo->CssClass = "";
			$cat_p_photo->photo->ViewCustomAttributes = "";

			// sort_order
			$cat_p_photo->sort_order->ViewValue = $cat_p_photo->sort_order->CurrentValue;
			$cat_p_photo->sort_order->CssStyle = "";
			$cat_p_photo->sort_order->CssClass = "";
			$cat_p_photo->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($cat_p_photo->status->CurrentValue) <> "") {
				switch ($cat_p_photo->status->CurrentValue) {
					case "1":
						$cat_p_photo->status->ViewValue = "Active";
						break;
					case "2":
						$cat_p_photo->status->ViewValue = "Not Active";
						break;
					default:
						$cat_p_photo->status->ViewValue = $cat_p_photo->status->CurrentValue;
				}
			} else {
				$cat_p_photo->status->ViewValue = NULL;
			}
			$cat_p_photo->status->CssStyle = "";
			$cat_p_photo->status->CssClass = "";
			$cat_p_photo->status->ViewCustomAttributes = "";

			// id
			$cat_p_photo->id->HrefValue = "";

			// product_id
			$cat_p_photo->product_id->HrefValue = "";

			// photo
			$cat_p_photo->photo->HrefValue = "";

			// sort_order
			$cat_p_photo->sort_order->HrefValue = "";

			// status
			$cat_p_photo->status->HrefValue = "";
		}

		// Call Row Rendered event
		$cat_p_photo->Row_Rendered();
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
