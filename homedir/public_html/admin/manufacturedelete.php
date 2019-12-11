<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "manufactureinfo.php" ?>
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
$manufacture_delete = new cmanufacture_delete();
$Page =& $manufacture_delete;

// Page init processing
$manufacture_delete->Page_Init();

// Page main processing
$manufacture_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var manufacture_delete = new ew_Page("manufacture_delete");

// page properties
manufacture_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = manufacture_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
manufacture_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
manufacture_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
manufacture_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $manufacture_delete->LoadRecordset();
$manufacture_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($manufacture_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$manufacture_delete->Page_Terminate("manufacturelist.php"); // Return to list
}
?>
<div align="center" class="msm_h1">Delete From TABLE: Manufacture</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $manufacture->getReturnUrl() ?>">Go Back</a></span></p>
<?php $manufacture_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="manufacture">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($manufacture_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $manufacture->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">Name</td>
		<td valign="top">Logo</td>
		<td valign="top">Web Site</td>
		<td valign="top">Sort Order</td>
		<td valign="top">Status</td>
	</tr>
	</thead>
	<tbody>
<?php
$manufacture_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$manufacture_delete->lRecCnt++;

	// Set row properties
	$manufacture->CssClass = "";
	$manufacture->CssStyle = "";
	$manufacture->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$manufacture_delete->LoadRowValues($rs);

	// Render row
	$manufacture_delete->RenderRow();
?>
	<tr<?php echo $manufacture->RowAttributes() ?>>
		<td<?php echo $manufacture->id->CellAttributes() ?>>
<div<?php echo $manufacture->id->ViewAttributes() ?>><?php echo $manufacture->id->ListViewValue() ?></div></td>
		<td<?php echo $manufacture->name->CellAttributes() ?>>
<div<?php echo $manufacture->name->ViewAttributes() ?>><?php echo $manufacture->name->ListViewValue() ?></div></td>
		<td<?php echo $manufacture->logo->CellAttributes() ?>>
<?php if ($manufacture->logo->HrefValue <> "") { ?>
<?php if (!is_null($manufacture->logo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $manufacture->logo->Upload->DbValue ?>" border=0<?php echo $manufacture->logo->ViewAttributes() ?>>
<?php } elseif (!in_array($manufacture->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($manufacture->logo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $manufacture->logo->Upload->DbValue ?>" border=0<?php echo $manufacture->logo->ViewAttributes() ?>>
<?php } elseif (!in_array($manufacture->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $manufacture->web_site->CellAttributes() ?>>
<div<?php echo $manufacture->web_site->ViewAttributes() ?>><?php echo $manufacture->web_site->ListViewValue() ?></div></td>
		<td<?php echo $manufacture->sort_order->CellAttributes() ?>>
<div<?php echo $manufacture->sort_order->ViewAttributes() ?>><?php echo $manufacture->sort_order->ListViewValue() ?></div></td>
		<td<?php echo $manufacture->status->CellAttributes() ?>>
<div<?php echo $manufacture->status->ViewAttributes() ?>><?php echo $manufacture->status->ListViewValue() ?></div></td>
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
class cmanufacture_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'manufacture';

	// Page Object Name
	var $PageObjName = 'manufacture_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $manufacture;
		if ($manufacture->UseTokenInUrl) $PageUrl .= "t=" . $manufacture->TableVar . "&"; // add page token
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
		global $objForm, $manufacture;
		if ($manufacture->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($manufacture->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($manufacture->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmanufacture_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["manufacture"] = new cmanufacture();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'manufacture', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $manufacture;
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
		global $manufacture;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$manufacture->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($manufacture->id->QueryStringValue))
				$this->Page_Terminate("manufacturelist.php"); // Prevent SQL injection, exit
			$sKey .= $manufacture->id->QueryStringValue;
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
			$this->Page_Terminate("manufacturelist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("manufacturelist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in manufacture class, manufactureinfo.php

		$manufacture->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$manufacture->CurrentAction = $_POST["a_delete"];
		} else {
			$manufacture->CurrentAction = "I"; // Display record
		}
		switch ($manufacture->CurrentAction) {
			case "D": // Delete
				$manufacture->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($manufacture->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $manufacture;
		$DeleteRows = TRUE;
		$sWrkFilter = $manufacture->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in manufacture class, manufactureinfo.php

		$manufacture->CurrentFilter = $sWrkFilter;
		$sSql = $manufacture->SQL();
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
				$DeleteRows = $manufacture->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($manufacture->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($manufacture->CancelMessage <> "") {
				$this->setMessage($manufacture->CancelMessage);
				$manufacture->CancelMessage = "";
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
				$manufacture->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $manufacture;

		// Call Recordset Selecting event
		$manufacture->Recordset_Selecting($manufacture->CurrentFilter);

		// Load list page SQL
		$sSql = $manufacture->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$manufacture->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $manufacture;
		$sFilter = $manufacture->KeyFilter();

		// Call Row Selecting event
		$manufacture->Row_Selecting($sFilter);

		// Load sql based on filter
		$manufacture->CurrentFilter = $sFilter;
		$sSql = $manufacture->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$manufacture->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $manufacture;
		$manufacture->id->setDbValue($rs->fields('id'));
		$manufacture->name->setDbValue($rs->fields('name'));
		$manufacture->logo->Upload->DbValue = $rs->fields('logo');
		$manufacture->web_site->setDbValue($rs->fields('web_site'));
		$manufacture->sort_order->setDbValue($rs->fields('sort_order'));
		$manufacture->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $manufacture;

		// Call Row_Rendering event
		$manufacture->Row_Rendering();

		// Common render codes for all row types
		// id

		$manufacture->id->CellCssStyle = "";
		$manufacture->id->CellCssClass = "";

		// name
		$manufacture->name->CellCssStyle = "";
		$manufacture->name->CellCssClass = "";

		// logo
		$manufacture->logo->CellCssStyle = "";
		$manufacture->logo->CellCssClass = "";

		// web_site
		$manufacture->web_site->CellCssStyle = "";
		$manufacture->web_site->CellCssClass = "";

		// sort_order
		$manufacture->sort_order->CellCssStyle = "";
		$manufacture->sort_order->CellCssClass = "";

		// status
		$manufacture->status->CellCssStyle = "";
		$manufacture->status->CellCssClass = "";
		if ($manufacture->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$manufacture->id->ViewValue = $manufacture->id->CurrentValue;
			$manufacture->id->CssStyle = "";
			$manufacture->id->CssClass = "";
			$manufacture->id->ViewCustomAttributes = "";

			// name
			$manufacture->name->ViewValue = $manufacture->name->CurrentValue;
			$manufacture->name->CssStyle = "";
			$manufacture->name->CssClass = "";
			$manufacture->name->ViewCustomAttributes = "";

			// logo
			if (!is_null($manufacture->logo->Upload->DbValue)) {
				$manufacture->logo->ViewValue = $manufacture->logo->Upload->DbValue;
				$manufacture->logo->ImageWidth = 100;
				$manufacture->logo->ImageHeight = 0;
				$manufacture->logo->ImageAlt = "";
			} else {
				$manufacture->logo->ViewValue = "";
			}
			$manufacture->logo->CssStyle = "";
			$manufacture->logo->CssClass = "";
			$manufacture->logo->ViewCustomAttributes = "";

			// web_site
			$manufacture->web_site->ViewValue = $manufacture->web_site->CurrentValue;
			$manufacture->web_site->CssStyle = "";
			$manufacture->web_site->CssClass = "";
			$manufacture->web_site->ViewCustomAttributes = "";

			// sort_order
			$manufacture->sort_order->ViewValue = $manufacture->sort_order->CurrentValue;
			$manufacture->sort_order->CssStyle = "";
			$manufacture->sort_order->CssClass = "";
			$manufacture->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($manufacture->status->CurrentValue) <> "") {
				switch ($manufacture->status->CurrentValue) {
					case "1":
						$manufacture->status->ViewValue = "Active";
						break;
					case "2":
						$manufacture->status->ViewValue = "Not Active";
						break;
					default:
						$manufacture->status->ViewValue = $manufacture->status->CurrentValue;
				}
			} else {
				$manufacture->status->ViewValue = NULL;
			}
			$manufacture->status->CssStyle = "";
			$manufacture->status->CssClass = "";
			$manufacture->status->ViewCustomAttributes = "";

			// id
			$manufacture->id->HrefValue = "";

			// name
			$manufacture->name->HrefValue = "";

			// logo
			$manufacture->logo->HrefValue = "";

			// web_site
			$manufacture->web_site->HrefValue = "";

			// sort_order
			$manufacture->sort_order->HrefValue = "";

			// status
			$manufacture->status->HrefValue = "";
		}

		// Call Row Rendered event
		$manufacture->Row_Rendered();
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
