<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "slideinfo.php" ?>
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
$slide_delete = new cslide_delete();
$Page =& $slide_delete;

// Page init processing
$slide_delete->Page_Init();

// Page main processing
$slide_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var slide_delete = new ew_Page("slide_delete");

// page properties
slide_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = slide_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
slide_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
slide_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
slide_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $slide_delete->LoadRecordset();
$slide_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($slide_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$slide_delete->Page_Terminate("slidelist.php"); // Return to list
}
?>
<div align="center" class="msm_h1">Delete From TABLE: Slide</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $slide->getReturnUrl() ?>">Go Back</a></span></p>
<?php $slide_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="slide">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($slide_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $slide->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">Slide Photo</td>
		<td valign="top">Sort Order</td>
		<td valign="top">Status</td>
	</tr>
	</thead>
	<tbody>
<?php
$slide_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$slide_delete->lRecCnt++;

	// Set row properties
	$slide->CssClass = "";
	$slide->CssStyle = "";
	$slide->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$slide_delete->LoadRowValues($rs);

	// Render row
	$slide_delete->RenderRow();
?>
	<tr<?php echo $slide->RowAttributes() ?>>
		<td<?php echo $slide->id->CellAttributes() ?>>
<div<?php echo $slide->id->ViewAttributes() ?>><?php echo $slide->id->ListViewValue() ?></div></td>
		<td<?php echo $slide->slide_photo->CellAttributes() ?>>
<?php if ($slide->slide_photo->HrefValue <> "") { ?>
<?php if (!is_null($slide->slide_photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/photo/") . $slide->slide_photo->Upload->DbValue ?>" border=0<?php echo $slide->slide_photo->ViewAttributes() ?>>
<?php } elseif (!in_array($slide->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($slide->slide_photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/photo/") . $slide->slide_photo->Upload->DbValue ?>" border=0<?php echo $slide->slide_photo->ViewAttributes() ?>>
<?php } elseif (!in_array($slide->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<td<?php echo $slide->sort_order->CellAttributes() ?>>
<div<?php echo $slide->sort_order->ViewAttributes() ?>><?php echo $slide->sort_order->ListViewValue() ?></div></td>
		<td<?php echo $slide->status->CellAttributes() ?>>
<div<?php echo $slide->status->ViewAttributes() ?>><?php echo $slide->status->ListViewValue() ?></div></td>
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
class cslide_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'slide';

	// Page Object Name
	var $PageObjName = 'slide_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $slide;
		if ($slide->UseTokenInUrl) $PageUrl .= "t=" . $slide->TableVar . "&"; // add page token
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
		global $objForm, $slide;
		if ($slide->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($slide->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($slide->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cslide_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["slide"] = new cslide();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'slide', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $slide;
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
		global $slide;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$slide->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($slide->id->QueryStringValue))
				$this->Page_Terminate("slidelist.php"); // Prevent SQL injection, exit
			$sKey .= $slide->id->QueryStringValue;
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
			$this->Page_Terminate("slidelist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("slidelist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in slide class, slideinfo.php

		$slide->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$slide->CurrentAction = $_POST["a_delete"];
		} else {
			$slide->CurrentAction = "I"; // Display record
		}
		switch ($slide->CurrentAction) {
			case "D": // Delete
				$slide->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($slide->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $slide;
		$DeleteRows = TRUE;
		$sWrkFilter = $slide->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in slide class, slideinfo.php

		$slide->CurrentFilter = $sWrkFilter;
		$sSql = $slide->SQL();
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
				$DeleteRows = $slide->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($slide->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($slide->CancelMessage <> "") {
				$this->setMessage($slide->CancelMessage);
				$slide->CancelMessage = "";
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
				$slide->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $slide;

		// Call Recordset Selecting event
		$slide->Recordset_Selecting($slide->CurrentFilter);

		// Load list page SQL
		$sSql = $slide->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$slide->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $slide;
		$sFilter = $slide->KeyFilter();

		// Call Row Selecting event
		$slide->Row_Selecting($sFilter);

		// Load sql based on filter
		$slide->CurrentFilter = $sFilter;
		$sSql = $slide->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$slide->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $slide;
		$slide->id->setDbValue($rs->fields('id'));
		$slide->slide_photo->Upload->DbValue = $rs->fields('slide_photo');
		$slide->sort_order->setDbValue($rs->fields('sort_order'));
		$slide->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $slide;

		// Call Row_Rendering event
		$slide->Row_Rendering();

		// Common render codes for all row types
		// id

		$slide->id->CellCssStyle = "";
		$slide->id->CellCssClass = "";

		// slide_photo
		$slide->slide_photo->CellCssStyle = "";
		$slide->slide_photo->CellCssClass = "";

		// sort_order
		$slide->sort_order->CellCssStyle = "";
		$slide->sort_order->CellCssClass = "";

		// status
		$slide->status->CellCssStyle = "";
		$slide->status->CellCssClass = "";
		if ($slide->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$slide->id->ViewValue = $slide->id->CurrentValue;
			$slide->id->CssStyle = "";
			$slide->id->CssClass = "";
			$slide->id->ViewCustomAttributes = "";

			// slide_photo
			if (!is_null($slide->slide_photo->Upload->DbValue)) {
				$slide->slide_photo->ViewValue = $slide->slide_photo->Upload->DbValue;
				$slide->slide_photo->ImageWidth = 100;
				$slide->slide_photo->ImageHeight = 0;
				$slide->slide_photo->ImageAlt = "";
			} else {
				$slide->slide_photo->ViewValue = "";
			}
			$slide->slide_photo->CssStyle = "";
			$slide->slide_photo->CssClass = "";
			$slide->slide_photo->ViewCustomAttributes = "";

			// sort_order
			$slide->sort_order->ViewValue = $slide->sort_order->CurrentValue;
			$slide->sort_order->CssStyle = "";
			$slide->sort_order->CssClass = "";
			$slide->sort_order->ViewCustomAttributes = "";

			// status
			if (strval($slide->status->CurrentValue) <> "") {
				switch ($slide->status->CurrentValue) {
					case "1":
						$slide->status->ViewValue = "Active";
						break;
					case "2":
						$slide->status->ViewValue = "Not Active";
						break;
					default:
						$slide->status->ViewValue = $slide->status->CurrentValue;
				}
			} else {
				$slide->status->ViewValue = NULL;
			}
			$slide->status->CssStyle = "";
			$slide->status->CssClass = "";
			$slide->status->ViewCustomAttributes = "";

			// id
			$slide->id->HrefValue = "";

			// slide_photo
			$slide->slide_photo->HrefValue = "";

			// sort_order
			$slide->sort_order->HrefValue = "";

			// status
			$slide->status->HrefValue = "";
		}

		// Call Row Rendered event
		$slide->Row_Rendered();
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
