<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "serviceinfo.php" ?>
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
$service_delete = new cservice_delete();
$Page =& $service_delete;

// Page init processing
$service_delete->Page_Init();

// Page main processing
$service_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var service_delete = new ew_Page("service_delete");

// page properties
service_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = service_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
service_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
service_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
service_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $service_delete->LoadRecordset();
$service_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($service_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$service_delete->Page_Terminate("servicelist.php"); // Return to list
}
?>
<div align="center" class="msm_h1">Delete From TABLE: Service</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $service->getReturnUrl() ?>">Go Back</a></span></p>
<?php $service_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="service">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($service_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $service->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">Photo</td>
		<td valign="top">Header</td>
		<td valign="top">Sort Order</td>
		<td valign="top">Status</td>
	</tr>
	</thead>
	<tbody>
<?php
$service_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$service_delete->lRecCnt++;

	// Set row properties
	$service->CssClass = "";
	$service->CssStyle = "";
	$service->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$service_delete->LoadRowValues($rs);

	// Render row
	$service_delete->RenderRow();
?>
	<tr<?php echo $service->RowAttributes() ?>>
		<td<?php echo $service->id->CellAttributes() ?>>
<div<?php echo $service->id->ViewAttributes() ?>><?php echo $service->id->ListViewValue() ?></div></td>
		<td<?php echo $service->photo->CellAttributes() ?>>
<?php if ($service->photo->HrefValue <> "") { ?>
<?php if (!is_null($service->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../image/") . $service->photo->Upload->DbValue ?>" border=0<?php echo $service->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($service->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($service->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../image/") . $service->photo->Upload->DbValue ?>" border=0<?php echo $service->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($service->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $service->header->CellAttributes() ?>>
<div<?php echo $service->header->ViewAttributes() ?>><?php echo $service->header->ListViewValue() ?></div></td>
		<td<?php echo $service->sort_order->CellAttributes() ?>>
<div<?php echo $service->sort_order->ViewAttributes() ?>><?php echo $service->sort_order->ListViewValue() ?></div></td>
		<td<?php echo $service->status->CellAttributes() ?>>
<div<?php echo $service->status->ViewAttributes() ?>><?php echo $service->status->ListViewValue() ?></div></td>
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
class cservice_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'service';

	// Page Object Name
	var $PageObjName = 'service_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $service;
		if ($service->UseTokenInUrl) $PageUrl .= "t=" . $service->TableVar . "&"; // add page token
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
		global $objForm, $service;
		if ($service->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($service->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($service->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cservice_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["service"] = new cservice();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'service', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $service;
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
		global $service;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$service->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($service->id->QueryStringValue))
				$this->Page_Terminate("servicelist.php"); // Prevent SQL injection, exit
			$sKey .= $service->id->QueryStringValue;
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
			$this->Page_Terminate("servicelist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("servicelist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in service class, serviceinfo.php

		$service->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$service->CurrentAction = $_POST["a_delete"];
		} else {
			$service->CurrentAction = "I"; // Display record
		}
		switch ($service->CurrentAction) {
			case "D": // Delete
				$service->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($service->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $service;
		$DeleteRows = TRUE;
		$sWrkFilter = $service->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in service class, serviceinfo.php

		$service->CurrentFilter = $sWrkFilter;
		$sSql = $service->SQL();
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
				$DeleteRows = $service->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($service->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($service->CancelMessage <> "") {
				$this->setMessage($service->CancelMessage);
				$service->CancelMessage = "";
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
				$service->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $service;

		// Call Recordset Selecting event
		$service->Recordset_Selecting($service->CurrentFilter);

		// Load list page SQL
		$sSql = $service->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$service->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $service;
		$sFilter = $service->KeyFilter();

		// Call Row Selecting event
		$service->Row_Selecting($sFilter);

		// Load sql based on filter
		$service->CurrentFilter = $sFilter;
		$sSql = $service->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$service->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $service;
		$service->id->setDbValue($rs->fields('id'));
		$service->photo->Upload->DbValue = $rs->fields('photo');
		$service->header->setDbValue($rs->fields('header'));
		$service->short_desc->setDbValue($rs->fields('short_desc'));
		$service->full_desc->setDbValue($rs->fields('full_desc'));
		$service->sort_order->setDbValue($rs->fields('sort_order'));
		$service->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $service;

		// Call Row_Rendering event
		$service->Row_Rendering();

		// Common render codes for all row types
		// id

		$service->id->CellCssStyle = "";
		$service->id->CellCssClass = "";

		// photo
		$service->photo->CellCssStyle = "";
		$service->photo->CellCssClass = "";

		// header
		$service->header->CellCssStyle = "";
		$service->header->CellCssClass = "";

		// sort_order
		$service->sort_order->CellCssStyle = "";
		$service->sort_order->CellCssClass = "";

		// status
		$service->status->CellCssStyle = "";
		$service->status->CellCssClass = "";
		if ($service->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$service->id->ViewValue = $service->id->CurrentValue;
			$service->id->CssStyle = "";
			$service->id->CssClass = "";
			$service->id->ViewCustomAttributes = "";

			// photo
			if (!is_null($service->photo->Upload->DbValue)) {
				$service->photo->ViewValue = $service->photo->Upload->DbValue;
				$service->photo->ImageWidth = 100;
				$service->photo->ImageHeight = 0;
				$service->photo->ImageAlt = "";
			} else {
				$service->photo->ViewValue = "";
			}
			$service->photo->CssStyle = "";
			$service->photo->CssClass = "";
			$service->photo->ViewCustomAttributes = "";

			// header
			$service->header->ViewValue = $service->header->CurrentValue;
			$service->header->CssStyle = "";
			$service->header->CssClass = "";
			$service->header->ViewCustomAttributes = "";

			// sort_order
			$service->sort_order->ViewValue = $service->sort_order->CurrentValue;
			$service->sort_order->CssStyle = "";
			$service->sort_order->CssClass = "";
			$service->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($service->status->CurrentValue) <> "") {
				switch ($service->status->CurrentValue) {
					case "1":
						$service->status->ViewValue = "Active";
						break;
					case "2":
						$service->status->ViewValue = "Not Active";
						break;
					default:
						$service->status->ViewValue = $service->status->CurrentValue;
				}
			} else {
				$service->status->ViewValue = NULL;
			}
			$service->status->CssStyle = "";
			$service->status->CssClass = "";
			$service->status->ViewCustomAttributes = "";

			// id
			$service->id->HrefValue = "";

			// photo
			$service->photo->HrefValue = "";

			// header
			$service->header->HrefValue = "";

			// sort_order
			$service->sort_order->HrefValue = "";

			// status
			$service->status->HrefValue = "";
		}

		// Call Row Rendered event
		$service->Row_Rendered();
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
