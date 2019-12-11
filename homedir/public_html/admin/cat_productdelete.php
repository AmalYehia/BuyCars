<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "cat_productinfo.php" ?>
<?php include "categoryinfo.php" ?>
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
$cat_product_delete = new ccat_product_delete();
$Page =& $cat_product_delete;

// Page init processing
$cat_product_delete->Page_Init();

// Page main processing
$cat_product_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var cat_product_delete = new ew_Page("cat_product_delete");

// page properties
cat_product_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = cat_product_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
cat_product_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
cat_product_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cat_product_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
cat_product_delete.ShowHighlightText = "Show highlight"; 
cat_product_delete.HideHighlightText = "Hide highlight";

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
$rs = $cat_product_delete->LoadRecordset();
$cat_product_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($cat_product_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$cat_product_delete->Page_Terminate("cat_productlist.php"); // Return to list
}
?>
<div align="center" class="msm_h1">Delete From TABLE: Cat Product</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $cat_product->getReturnUrl() ?>">Go Back</a></span></p>
<?php $cat_product_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="cat_product">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($cat_product_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $cat_product->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">Cat Id</td>
		<td valign="top">Manufacture Id</td>
		<td valign="top">Type</td>
		<td valign="top">Name</td>
		<td valign="top">Photo</td>
		<td valign="top">Year</td>
		<td valign="top">Model</td>
		<td valign="top">Price</td>
		<td valign="top">Location</td>
		<td valign="top">Serial No</td>
		<td valign="top">Condition</td>
		<td valign="top">Stock No</td>
		<td valign="top">Horse Power</td>
		<td valign="top">Hour</td>
		<td valign="top">Drive</td>
		<td valign="top">Date Update</td>
		<td valign="top">Sort Order</td>
		<td valign="top">Status</td>
	</tr>
	</thead>
	<tbody>
<?php
$cat_product_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$cat_product_delete->lRecCnt++;

	// Set row properties
	$cat_product->CssClass = "";
	$cat_product->CssStyle = "";
	$cat_product->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$cat_product_delete->LoadRowValues($rs);

	// Render row
	$cat_product_delete->RenderRow();
?>
	<tr<?php echo $cat_product->RowAttributes() ?>>
		<td<?php echo $cat_product->id->CellAttributes() ?>>
<div<?php echo $cat_product->id->ViewAttributes() ?>><?php echo $cat_product->id->ListViewValue() ?></div></td>
		<td<?php echo $cat_product->cat_id->CellAttributes() ?>>
<div<?php echo $cat_product->cat_id->ViewAttributes() ?>><?php echo $cat_product->cat_id->ListViewValue() ?></div></td>
		<td<?php echo $cat_product->manufacture_id->CellAttributes() ?>>
<div<?php echo $cat_product->manufacture_id->ViewAttributes() ?>><?php echo $cat_product->manufacture_id->ListViewValue() ?></div></td>
		<td<?php echo $cat_product->type->CellAttributes() ?>>
<div<?php echo $cat_product->type->ViewAttributes() ?>><?php echo $cat_product->type->ListViewValue() ?></div></td>
		<td<?php echo $cat_product->name->CellAttributes() ?>>
<div<?php echo $cat_product->name->ViewAttributes() ?>><?php echo $cat_product->name->ListViewValue() ?></div></td>
		<td<?php echo $cat_product->photo->CellAttributes() ?>>
<?php if ($cat_product->photo->HrefValue <> "") { ?>
<?php if (!is_null($cat_product->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $cat_product->photo->Upload->DbValue ?>" border=0<?php echo $cat_product->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($cat_product->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($cat_product->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $cat_product->photo->Upload->DbValue ?>" border=0<?php echo $cat_product->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($cat_product->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $cat_product->year->CellAttributes() ?>>
<div<?php echo $cat_product->year->ViewAttributes() ?>><?php echo $cat_product->year->ListViewValue() ?></div></td>
		<td<?php echo $cat_product->model->CellAttributes() ?>>
<div<?php echo $cat_product->model->ViewAttributes() ?>><?php echo $cat_product->model->ListViewValue() ?></div></td>
		<td<?php echo $cat_product->price->CellAttributes() ?>>
<div<?php echo $cat_product->price->ViewAttributes() ?>><?php echo $cat_product->price->ListViewValue() ?></div></td>
		<td<?php echo $cat_product->location->CellAttributes() ?>>
<div<?php echo $cat_product->location->ViewAttributes() ?>><?php echo $cat_product->location->ListViewValue() ?></div></td>
		<td<?php echo $cat_product->serial_no->CellAttributes() ?>>
<div<?php echo $cat_product->serial_no->ViewAttributes() ?>><?php echo $cat_product->serial_no->ListViewValue() ?></div></td>
		<td<?php echo $cat_product->condition->CellAttributes() ?>>
<div<?php echo $cat_product->condition->ViewAttributes() ?>><?php echo $cat_product->condition->ListViewValue() ?></div></td>
		<td<?php echo $cat_product->stock_no->CellAttributes() ?>>
<div<?php echo $cat_product->stock_no->ViewAttributes() ?>><?php echo $cat_product->stock_no->ListViewValue() ?></div></td>
		<td<?php echo $cat_product->horse_power->CellAttributes() ?>>
<div<?php echo $cat_product->horse_power->ViewAttributes() ?>><?php echo $cat_product->horse_power->ListViewValue() ?></div></td>
		<td<?php echo $cat_product->hour->CellAttributes() ?>>
<div<?php echo $cat_product->hour->ViewAttributes() ?>><?php echo $cat_product->hour->ListViewValue() ?></div></td>
		<td<?php echo $cat_product->drive->CellAttributes() ?>>
<div<?php echo $cat_product->drive->ViewAttributes() ?>><?php echo $cat_product->drive->ListViewValue() ?></div></td>
		<td<?php echo $cat_product->date_update->CellAttributes() ?>>
<div<?php echo $cat_product->date_update->ViewAttributes() ?>><?php echo $cat_product->date_update->ListViewValue() ?></div></td>
		<td<?php echo $cat_product->sort_order->CellAttributes() ?>>
<div<?php echo $cat_product->sort_order->ViewAttributes() ?>><?php echo $cat_product->sort_order->ListViewValue() ?></div></td>
		<td<?php echo $cat_product->status->CellAttributes() ?>>
<div<?php echo $cat_product->status->ViewAttributes() ?>><?php echo $cat_product->status->ListViewValue() ?></div></td>
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
class ccat_product_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'cat_product';

	// Page Object Name
	var $PageObjName = 'cat_product_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $cat_product;
		if ($cat_product->UseTokenInUrl) $PageUrl .= "t=" . $cat_product->TableVar . "&"; // add page token
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
		global $objForm, $cat_product;
		if ($cat_product->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($cat_product->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($cat_product->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccat_product_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["cat_product"] = new ccat_product();

		// Initialize other table object
		$GLOBALS['category'] = new ccategory();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cat_product', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $cat_product;
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
		global $cat_product;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$cat_product->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($cat_product->id->QueryStringValue))
				$this->Page_Terminate("cat_productlist.php"); // Prevent SQL injection, exit
			$sKey .= $cat_product->id->QueryStringValue;
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
			$this->Page_Terminate("cat_productlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("cat_productlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in cat_product class, cat_productinfo.php

		$cat_product->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$cat_product->CurrentAction = $_POST["a_delete"];
		} else {
			$cat_product->CurrentAction = "I"; // Display record
		}
		switch ($cat_product->CurrentAction) {
			case "D": // Delete
				$cat_product->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($cat_product->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $cat_product;
		$DeleteRows = TRUE;
		$sWrkFilter = $cat_product->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in cat_product class, cat_productinfo.php

		$cat_product->CurrentFilter = $sWrkFilter;
		$sSql = $cat_product->SQL();
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
				$DeleteRows = $cat_product->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($cat_product->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($cat_product->CancelMessage <> "") {
				$this->setMessage($cat_product->CancelMessage);
				$cat_product->CancelMessage = "";
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
				$cat_product->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $cat_product;

		// Call Recordset Selecting event
		$cat_product->Recordset_Selecting($cat_product->CurrentFilter);

		// Load list page SQL
		$sSql = $cat_product->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$cat_product->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $cat_product;
		$sFilter = $cat_product->KeyFilter();

		// Call Row Selecting event
		$cat_product->Row_Selecting($sFilter);

		// Load sql based on filter
		$cat_product->CurrentFilter = $sFilter;
		$sSql = $cat_product->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$cat_product->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $cat_product;
		$cat_product->id->setDbValue($rs->fields('id'));
		$cat_product->cat_id->setDbValue($rs->fields('cat_id'));
		$cat_product->manufacture_id->setDbValue($rs->fields('manufacture_id'));
		$cat_product->type->setDbValue($rs->fields('type'));
		$cat_product->name->setDbValue($rs->fields('name'));
		$cat_product->photo->Upload->DbValue = $rs->fields('photo');
		$cat_product->year->setDbValue($rs->fields('year'));
		$cat_product->model->setDbValue($rs->fields('model'));
		$cat_product->price->setDbValue($rs->fields('price'));
		$cat_product->location->setDbValue($rs->fields('location'));
		$cat_product->serial_no->setDbValue($rs->fields('serial_no'));
		$cat_product->condition->setDbValue($rs->fields('condition'));
		$cat_product->stock_no->setDbValue($rs->fields('stock_no'));
		$cat_product->horse_power->setDbValue($rs->fields('horse_power'));
		$cat_product->hour->setDbValue($rs->fields('hour'));
		$cat_product->drive->setDbValue($rs->fields('drive'));
		$cat_product->general_info->setDbValue($rs->fields('general_info'));
		$cat_product->description->setDbValue($rs->fields('description'));
		$cat_product->date_update->setDbValue($rs->fields('date_update'));
		$cat_product->sort_order->setDbValue($rs->fields('sort_order'));
		$cat_product->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $cat_product;

		// Call Row_Rendering event
		$cat_product->Row_Rendering();

		// Common render codes for all row types
		// id

		$cat_product->id->CellCssStyle = "";
		$cat_product->id->CellCssClass = "";

		// cat_id
		$cat_product->cat_id->CellCssStyle = "";
		$cat_product->cat_id->CellCssClass = "";

		// manufacture_id
		$cat_product->manufacture_id->CellCssStyle = "";
		$cat_product->manufacture_id->CellCssClass = "";

		// type
		$cat_product->type->CellCssStyle = "";
		$cat_product->type->CellCssClass = "";

		// name
		$cat_product->name->CellCssStyle = "";
		$cat_product->name->CellCssClass = "";

		// photo
		$cat_product->photo->CellCssStyle = "";
		$cat_product->photo->CellCssClass = "";

		// year
		$cat_product->year->CellCssStyle = "";
		$cat_product->year->CellCssClass = "";

		// model
		$cat_product->model->CellCssStyle = "";
		$cat_product->model->CellCssClass = "";

		// price
		$cat_product->price->CellCssStyle = "";
		$cat_product->price->CellCssClass = "";

		// location
		$cat_product->location->CellCssStyle = "";
		$cat_product->location->CellCssClass = "";

		// serial_no
		$cat_product->serial_no->CellCssStyle = "";
		$cat_product->serial_no->CellCssClass = "";

		// condition
		$cat_product->condition->CellCssStyle = "";
		$cat_product->condition->CellCssClass = "";

		// stock_no
		$cat_product->stock_no->CellCssStyle = "";
		$cat_product->stock_no->CellCssClass = "";

		// horse_power
		$cat_product->horse_power->CellCssStyle = "";
		$cat_product->horse_power->CellCssClass = "";

		// hour
		$cat_product->hour->CellCssStyle = "";
		$cat_product->hour->CellCssClass = "";

		// drive
		$cat_product->drive->CellCssStyle = "";
		$cat_product->drive->CellCssClass = "";

		// date_update
		$cat_product->date_update->CellCssStyle = "";
		$cat_product->date_update->CellCssClass = "";

		// sort_order
		$cat_product->sort_order->CellCssStyle = "";
		$cat_product->sort_order->CellCssClass = "";

		// status
		$cat_product->status->CellCssStyle = "";
		$cat_product->status->CellCssClass = "";
		if ($cat_product->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$cat_product->id->ViewValue = $cat_product->id->CurrentValue;
			$cat_product->id->CssStyle = "";
			$cat_product->id->CssClass = "";
			$cat_product->id->ViewCustomAttributes = "";

			// cat_id
			if (strval($cat_product->cat_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name` FROM `category` WHERE `id` = " . ew_AdjustSql($cat_product->cat_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$cat_product->cat_id->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$cat_product->cat_id->ViewValue = $cat_product->cat_id->CurrentValue;
				}
			} else {
				$cat_product->cat_id->ViewValue = NULL;
			}
			$cat_product->cat_id->CssStyle = "";
			$cat_product->cat_id->CssClass = "";
			$cat_product->cat_id->ViewCustomAttributes = "";

			// manufacture_id
			if (strval($cat_product->manufacture_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name` FROM `manufacture` WHERE `id` = " . ew_AdjustSql($cat_product->manufacture_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$cat_product->manufacture_id->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$cat_product->manufacture_id->ViewValue = $cat_product->manufacture_id->CurrentValue;
				}
			} else {
				$cat_product->manufacture_id->ViewValue = NULL;
			}
			$cat_product->manufacture_id->CssStyle = "";
			$cat_product->manufacture_id->CssClass = "";
			$cat_product->manufacture_id->ViewCustomAttributes = "";

			// type
			if (strval($cat_product->type->CurrentValue) <> "") {
				switch ($cat_product->type->CurrentValue) {
					case "1":
						$cat_product->type->ViewValue = "Machine";
						break;
					case "2":
						$cat_product->type->ViewValue = "parts";
						break;
					default:
						$cat_product->type->ViewValue = $cat_product->type->CurrentValue;
				}
			} else {
				$cat_product->type->ViewValue = NULL;
			}
			$cat_product->type->CssStyle = "";
			$cat_product->type->CssClass = "";
			$cat_product->type->ViewCustomAttributes = "";

			// name
			$cat_product->name->ViewValue = $cat_product->name->CurrentValue;
			$cat_product->name->CssStyle = "";
			$cat_product->name->CssClass = "";
			$cat_product->name->ViewCustomAttributes = "";

			// photo
			if (!is_null($cat_product->photo->Upload->DbValue)) {
				$cat_product->photo->ViewValue = $cat_product->photo->Upload->DbValue;
				$cat_product->photo->ImageWidth = 120;
				$cat_product->photo->ImageHeight = 0;
				$cat_product->photo->ImageAlt = "";
			} else {
				$cat_product->photo->ViewValue = "";
			}
			$cat_product->photo->CssStyle = "";
			$cat_product->photo->CssClass = "";
			$cat_product->photo->ViewCustomAttributes = "";

			// year
			$cat_product->year->ViewValue = $cat_product->year->CurrentValue;
			$cat_product->year->CssStyle = "";
			$cat_product->year->CssClass = "";
			$cat_product->year->ViewCustomAttributes = "";

			// model
			$cat_product->model->ViewValue = $cat_product->model->CurrentValue;
			$cat_product->model->CssStyle = "";
			$cat_product->model->CssClass = "";
			$cat_product->model->ViewCustomAttributes = "";

			// price
			$cat_product->price->ViewValue = $cat_product->price->CurrentValue;
			$cat_product->price->CssStyle = "";
			$cat_product->price->CssClass = "";
			$cat_product->price->ViewCustomAttributes = "";

			// location
			$cat_product->location->ViewValue = $cat_product->location->CurrentValue;
			$cat_product->location->CssStyle = "";
			$cat_product->location->CssClass = "";
			$cat_product->location->ViewCustomAttributes = "";

			// serial_no
			$cat_product->serial_no->ViewValue = $cat_product->serial_no->CurrentValue;
			$cat_product->serial_no->CssStyle = "";
			$cat_product->serial_no->CssClass = "";
			$cat_product->serial_no->ViewCustomAttributes = "";

			// condition
			if (strval($cat_product->condition->CurrentValue) <> "") {
				switch ($cat_product->condition->CurrentValue) {
					case "1":
						$cat_product->condition->ViewValue = "Used";
						break;
					case "2":
						$cat_product->condition->ViewValue = "Un Used";
						break;
					default:
						$cat_product->condition->ViewValue = $cat_product->condition->CurrentValue;
				}
			} else {
				$cat_product->condition->ViewValue = NULL;
			}
			$cat_product->condition->CssStyle = "";
			$cat_product->condition->CssClass = "";
			$cat_product->condition->ViewCustomAttributes = "";

			// stock_no
			$cat_product->stock_no->ViewValue = $cat_product->stock_no->CurrentValue;
			$cat_product->stock_no->CssStyle = "";
			$cat_product->stock_no->CssClass = "";
			$cat_product->stock_no->ViewCustomAttributes = "";

			// horse_power
			$cat_product->horse_power->ViewValue = $cat_product->horse_power->CurrentValue;
			$cat_product->horse_power->CssStyle = "";
			$cat_product->horse_power->CssClass = "";
			$cat_product->horse_power->ViewCustomAttributes = "";

			// hour
			$cat_product->hour->ViewValue = $cat_product->hour->CurrentValue;
			$cat_product->hour->CssStyle = "";
			$cat_product->hour->CssClass = "";
			$cat_product->hour->ViewCustomAttributes = "";

			// drive
			$cat_product->drive->ViewValue = $cat_product->drive->CurrentValue;
			$cat_product->drive->CssStyle = "";
			$cat_product->drive->CssClass = "";
			$cat_product->drive->ViewCustomAttributes = "";

			// date_update
			$cat_product->date_update->ViewValue = $cat_product->date_update->CurrentValue;
			$cat_product->date_update->ViewValue = ew_FormatDateTime($cat_product->date_update->ViewValue, 5);
			$cat_product->date_update->CssStyle = "";
			$cat_product->date_update->CssClass = "";
			$cat_product->date_update->ViewCustomAttributes = "";

			// sort_order
			$cat_product->sort_order->ViewValue = $cat_product->sort_order->CurrentValue;
			$cat_product->sort_order->CssStyle = "";
			$cat_product->sort_order->CssClass = "";
			$cat_product->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($cat_product->status->CurrentValue) <> "") {
				switch ($cat_product->status->CurrentValue) {
					case "1":
						$cat_product->status->ViewValue = "Active";
						break;
					case "2":
						$cat_product->status->ViewValue = "Not Active";
						break;
					default:
						$cat_product->status->ViewValue = $cat_product->status->CurrentValue;
				}
			} else {
				$cat_product->status->ViewValue = NULL;
			}
			$cat_product->status->CssStyle = "";
			$cat_product->status->CssClass = "";
			$cat_product->status->ViewCustomAttributes = "";

			// id
			$cat_product->id->HrefValue = "";

			// cat_id
			$cat_product->cat_id->HrefValue = "";

			// manufacture_id
			$cat_product->manufacture_id->HrefValue = "";

			// type
			$cat_product->type->HrefValue = "";

			// name
			$cat_product->name->HrefValue = "";

			// photo
			$cat_product->photo->HrefValue = "";

			// year
			$cat_product->year->HrefValue = "";

			// model
			$cat_product->model->HrefValue = "";

			// price
			$cat_product->price->HrefValue = "";

			// location
			$cat_product->location->HrefValue = "";

			// serial_no
			$cat_product->serial_no->HrefValue = "";

			// condition
			$cat_product->condition->HrefValue = "";

			// stock_no
			$cat_product->stock_no->HrefValue = "";

			// horse_power
			$cat_product->horse_power->HrefValue = "";

			// hour
			$cat_product->hour->HrefValue = "";

			// drive
			$cat_product->drive->HrefValue = "";

			// date_update
			$cat_product->date_update->HrefValue = "";

			// sort_order
			$cat_product->sort_order->HrefValue = "";

			// status
			$cat_product->status->HrefValue = "";
		}

		// Call Row Rendered event
		$cat_product->Row_Rendered();
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
