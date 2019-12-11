<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
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
$category_delete = new ccategory_delete();
$Page =& $category_delete;

// Page init processing
$category_delete->Page_Init();

// Page main processing
$category_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var category_delete = new ew_Page("category_delete");

// page properties
category_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = category_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
category_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
category_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
category_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $category_delete->LoadRecordset();
$category_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($category_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$category_delete->Page_Terminate("categorylist.php"); // Return to list
}
?>
<div align="center" class="msm_h1">Delete From TABLE: Category</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $category->getReturnUrl() ?>">Go Back</a></span></p>
<?php $category_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="category">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($category_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $category->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">Parent Id</td>
		<td valign="top">Name</td>
		<td valign="top">Photo</td>
		<td valign="top">Sort Order</td>
		<td valign="top">Status</td>
	</tr>
	</thead>
	<tbody>
<?php
$category_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$category_delete->lRecCnt++;

	// Set row properties
	$category->CssClass = "";
	$category->CssStyle = "";
	$category->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$category_delete->LoadRowValues($rs);

	// Render row
	$category_delete->RenderRow();
?>
	<tr<?php echo $category->RowAttributes() ?>>
		<td<?php echo $category->id->CellAttributes() ?>>
<div<?php echo $category->id->ViewAttributes() ?>><?php echo $category->id->ListViewValue() ?></div></td>
		<td<?php echo $category->parent_id->CellAttributes() ?>>
<div<?php echo $category->parent_id->ViewAttributes() ?>><?php echo $category->parent_id->ListViewValue() ?></div></td>
		<td<?php echo $category->name->CellAttributes() ?>>
<div<?php echo $category->name->ViewAttributes() ?>><?php echo $category->name->ListViewValue() ?></div></td>
		<td<?php echo $category->photo->CellAttributes() ?>>
<?php if ($category->photo->HrefValue <> "") { ?>
<?php if (!is_null($category->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $category->photo->Upload->DbValue ?>" border=0<?php echo $category->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($category->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($category->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $category->photo->Upload->DbValue ?>" border=0<?php echo $category->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($category->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $category->sort_order->CellAttributes() ?>>
<div<?php echo $category->sort_order->ViewAttributes() ?>><?php echo $category->sort_order->ListViewValue() ?></div></td>
		<td<?php echo $category->status->CellAttributes() ?>>
<div<?php echo $category->status->ViewAttributes() ?>><?php echo $category->status->ListViewValue() ?></div></td>
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
class ccategory_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'category';

	// Page Object Name
	var $PageObjName = 'category_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $category;
		if ($category->UseTokenInUrl) $PageUrl .= "t=" . $category->TableVar . "&"; // add page token
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
		global $objForm, $category;
		if ($category->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($category->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($category->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccategory_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["category"] = new ccategory();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'category', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $category;
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
		global $category;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$category->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($category->id->QueryStringValue))
				$this->Page_Terminate("categorylist.php"); // Prevent SQL injection, exit
			$sKey .= $category->id->QueryStringValue;
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
			$this->Page_Terminate("categorylist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("categorylist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in category class, categoryinfo.php

		$category->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$category->CurrentAction = $_POST["a_delete"];
		} else {
			$category->CurrentAction = "I"; // Display record
		}
		switch ($category->CurrentAction) {
			case "D": // Delete
				$category->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($category->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $category;
		$DeleteRows = TRUE;
		$sWrkFilter = $category->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in category class, categoryinfo.php

		$category->CurrentFilter = $sWrkFilter;
		$sSql = $category->SQL();
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
				$DeleteRows = $category->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($category->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($category->CancelMessage <> "") {
				$this->setMessage($category->CancelMessage);
				$category->CancelMessage = "";
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
				$category->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $category;

		// Call Recordset Selecting event
		$category->Recordset_Selecting($category->CurrentFilter);

		// Load list page SQL
		$sSql = $category->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$category->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $category;
		$sFilter = $category->KeyFilter();

		// Call Row Selecting event
		$category->Row_Selecting($sFilter);

		// Load sql based on filter
		$category->CurrentFilter = $sFilter;
		$sSql = $category->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$category->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $category;
		$category->id->setDbValue($rs->fields('id'));
		$category->parent_id->setDbValue($rs->fields('parent_id'));
		$category->name->setDbValue($rs->fields('name'));
		$category->photo->Upload->DbValue = $rs->fields('photo');
		$category->description->setDbValue($rs->fields('description'));
		$category->sort_order->setDbValue($rs->fields('sort_order'));
		$category->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $category;

		// Call Row_Rendering event
		$category->Row_Rendering();

		// Common render codes for all row types
		// id

		$category->id->CellCssStyle = "";
		$category->id->CellCssClass = "";

		// parent_id
		$category->parent_id->CellCssStyle = "";
		$category->parent_id->CellCssClass = "";

		// name
		$category->name->CellCssStyle = "";
		$category->name->CellCssClass = "";

		// photo
		$category->photo->CellCssStyle = "";
		$category->photo->CellCssClass = "";

		// sort_order
		$category->sort_order->CellCssStyle = "";
		$category->sort_order->CellCssClass = "";

		// status
		$category->status->CellCssStyle = "";
		$category->status->CellCssClass = "";
		if ($category->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$category->id->ViewValue = $category->id->CurrentValue;
			$category->id->CssStyle = "";
			$category->id->CssClass = "";
			$category->id->ViewCustomAttributes = "";

			// parent_id
			if (strval($category->parent_id->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `name` FROM `category` WHERE `id` = " . ew_AdjustSql($category->parent_id->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$category->parent_id->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$category->parent_id->ViewValue = $category->parent_id->CurrentValue;
				}
			} else {
				$category->parent_id->ViewValue = NULL;
			}
			$category->parent_id->CssStyle = "";
			$category->parent_id->CssClass = "";
			$category->parent_id->ViewCustomAttributes = "";

			// name
			$category->name->ViewValue = $category->name->CurrentValue;
			$category->name->CssStyle = "";
			$category->name->CssClass = "";
			$category->name->ViewCustomAttributes = "";

			// photo
			if (!is_null($category->photo->Upload->DbValue)) {
				$category->photo->ViewValue = $category->photo->Upload->DbValue;
				$category->photo->ImageWidth = 100;
				$category->photo->ImageHeight = 0;
				$category->photo->ImageAlt = "";
			} else {
				$category->photo->ViewValue = "";
			}
			$category->photo->CssStyle = "";
			$category->photo->CssClass = "";
			$category->photo->ViewCustomAttributes = "";

			// sort_order
			$category->sort_order->ViewValue = $category->sort_order->CurrentValue;
			$category->sort_order->CssStyle = "";
			$category->sort_order->CssClass = "";
			$category->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($category->status->CurrentValue) <> "") {
				switch ($category->status->CurrentValue) {
					case "1":
						$category->status->ViewValue = "Active";
						break;
					case "2":
						$category->status->ViewValue = "Not Active";
						break;
					default:
						$category->status->ViewValue = $category->status->CurrentValue;
				}
			} else {
				$category->status->ViewValue = NULL;
			}
			$category->status->CssStyle = "";
			$category->status->CssClass = "";
			$category->status->ViewCustomAttributes = "";

			// id
			$category->id->HrefValue = "";

			// parent_id
			$category->parent_id->HrefValue = "";

			// name
			$category->name->HrefValue = "";

			// photo
			$category->photo->HrefValue = "";

			// sort_order
			$category->sort_order->HrefValue = "";

			// status
			$category->status->HrefValue = "";
		}

		// Call Row Rendered event
		$category->Row_Rendered();
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
