<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "customerinfo.php" ?>
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
$customer_delete = new ccustomer_delete();
$Page =& $customer_delete;

// Page init processing
$customer_delete->Page_Init();

// Page main processing
$customer_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var customer_delete = new ew_Page("customer_delete");

// page properties
customer_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = customer_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
customer_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
customer_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
customer_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
customer_delete.ShowHighlightText = "Show highlight"; 
customer_delete.HideHighlightText = "Hide highlight";

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
$rs = $customer_delete->LoadRecordset();
$customer_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($customer_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$customer_delete->Page_Terminate("customerlist.php"); // Return to list
}
?>
<div align="center" class="msm_h1">Delete From TABLE: Customer</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $customer->getReturnUrl() ?>">Go Back</a></span></p>
<?php $customer_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="customer">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($customer_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $customer->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">User Name</td>
		<td valign="top">Password</td>
		<td valign="top">Name</td>
		<td valign="top">Email</td>
		<td valign="top">Mobile</td>
		<td valign="top">Country</td>
		<td valign="top">Date Lastlogin</td>
		<td valign="top">Date Register</td>
		<td valign="top">Status</td>
	</tr>
	</thead>
	<tbody>
<?php
$customer_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$customer_delete->lRecCnt++;

	// Set row properties
	$customer->CssClass = "";
	$customer->CssStyle = "";
	$customer->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$customer_delete->LoadRowValues($rs);

	// Render row
	$customer_delete->RenderRow();
?>
	<tr<?php echo $customer->RowAttributes() ?>>
		<td<?php echo $customer->id->CellAttributes() ?>>
<div<?php echo $customer->id->ViewAttributes() ?>><?php echo $customer->id->ListViewValue() ?></div></td>
		<td<?php echo $customer->user_name->CellAttributes() ?>>
<div<?php echo $customer->user_name->ViewAttributes() ?>><?php echo $customer->user_name->ListViewValue() ?></div></td>
		<td<?php echo $customer->password->CellAttributes() ?>>
<div<?php echo $customer->password->ViewAttributes() ?>><?php echo $customer->password->ListViewValue() ?></div></td>
		<td<?php echo $customer->name->CellAttributes() ?>>
<div<?php echo $customer->name->ViewAttributes() ?>><?php echo $customer->name->ListViewValue() ?></div></td>
		<td<?php echo $customer->email->CellAttributes() ?>>
<div<?php echo $customer->email->ViewAttributes() ?>><?php echo $customer->email->ListViewValue() ?></div></td>
		<td<?php echo $customer->mobile->CellAttributes() ?>>
<div<?php echo $customer->mobile->ViewAttributes() ?>><?php echo $customer->mobile->ListViewValue() ?></div></td>
		<td<?php echo $customer->country->CellAttributes() ?>>
<div<?php echo $customer->country->ViewAttributes() ?>><?php echo $customer->country->ListViewValue() ?></div></td>
		<td<?php echo $customer->date_lastlogin->CellAttributes() ?>>
<div<?php echo $customer->date_lastlogin->ViewAttributes() ?>><?php echo $customer->date_lastlogin->ListViewValue() ?></div></td>
		<td<?php echo $customer->date_register->CellAttributes() ?>>
<div<?php echo $customer->date_register->ViewAttributes() ?>><?php echo $customer->date_register->ListViewValue() ?></div></td>
		<td<?php echo $customer->status->CellAttributes() ?>>
<div<?php echo $customer->status->ViewAttributes() ?>><?php echo $customer->status->ListViewValue() ?></div></td>
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
class ccustomer_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'customer';

	// Page Object Name
	var $PageObjName = 'customer_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $customer;
		if ($customer->UseTokenInUrl) $PageUrl .= "t=" . $customer->TableVar . "&"; // add page token
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
		global $objForm, $customer;
		if ($customer->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($customer->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($customer->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ccustomer_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["customer"] = new ccustomer();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'customer', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $customer;
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
		global $customer;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$customer->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($customer->id->QueryStringValue))
				$this->Page_Terminate("customerlist.php"); // Prevent SQL injection, exit
			$sKey .= $customer->id->QueryStringValue;
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
			$this->Page_Terminate("customerlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("customerlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in customer class, customerinfo.php

		$customer->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$customer->CurrentAction = $_POST["a_delete"];
		} else {
			$customer->CurrentAction = "I"; // Display record
		}
		switch ($customer->CurrentAction) {
			case "D": // Delete
				$customer->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($customer->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $customer;
		$DeleteRows = TRUE;
		$sWrkFilter = $customer->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in customer class, customerinfo.php

		$customer->CurrentFilter = $sWrkFilter;
		$sSql = $customer->SQL();
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
				$DeleteRows = $customer->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($customer->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($customer->CancelMessage <> "") {
				$this->setMessage($customer->CancelMessage);
				$customer->CancelMessage = "";
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
				$customer->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $customer;

		// Call Recordset Selecting event
		$customer->Recordset_Selecting($customer->CurrentFilter);

		// Load list page SQL
		$sSql = $customer->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$customer->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $customer;
		$sFilter = $customer->KeyFilter();

		// Call Row Selecting event
		$customer->Row_Selecting($sFilter);

		// Load sql based on filter
		$customer->CurrentFilter = $sFilter;
		$sSql = $customer->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$customer->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $customer;
		$customer->id->setDbValue($rs->fields('id'));
		$customer->user_name->setDbValue($rs->fields('user_name'));
		$customer->password->setDbValue($rs->fields('password'));
		$customer->name->setDbValue($rs->fields('name'));
		$customer->email->setDbValue($rs->fields('email'));
		$customer->phone->setDbValue($rs->fields('phone'));
		$customer->mobile->setDbValue($rs->fields('mobile'));
		$customer->country->setDbValue($rs->fields('country'));
		$customer->address->setDbValue($rs->fields('address'));
		$customer->date_lastlogin->setDbValue($rs->fields('date_lastlogin'));
		$customer->date_register->setDbValue($rs->fields('date_register'));
		$customer->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $customer;

		// Call Row_Rendering event
		$customer->Row_Rendering();

		// Common render codes for all row types
		// id

		$customer->id->CellCssStyle = "";
		$customer->id->CellCssClass = "";

		// user_name
		$customer->user_name->CellCssStyle = "";
		$customer->user_name->CellCssClass = "";

		// password
		$customer->password->CellCssStyle = "";
		$customer->password->CellCssClass = "";

		// name
		$customer->name->CellCssStyle = "";
		$customer->name->CellCssClass = "";

		// email
		$customer->email->CellCssStyle = "";
		$customer->email->CellCssClass = "";

		// mobile
		$customer->mobile->CellCssStyle = "";
		$customer->mobile->CellCssClass = "";

		// country
		$customer->country->CellCssStyle = "";
		$customer->country->CellCssClass = "";

		// date_lastlogin
		$customer->date_lastlogin->CellCssStyle = "";
		$customer->date_lastlogin->CellCssClass = "";

		// date_register
		$customer->date_register->CellCssStyle = "";
		$customer->date_register->CellCssClass = "";

		// status
		$customer->status->CellCssStyle = "";
		$customer->status->CellCssClass = "";
		if ($customer->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$customer->id->ViewValue = $customer->id->CurrentValue;
			$customer->id->CssStyle = "";
			$customer->id->CssClass = "";
			$customer->id->ViewCustomAttributes = "";

			// user_name
			$customer->user_name->ViewValue = $customer->user_name->CurrentValue;
			$customer->user_name->CssStyle = "";
			$customer->user_name->CssClass = "";
			$customer->user_name->ViewCustomAttributes = "";

			// password
			$customer->password->ViewValue = $customer->password->CurrentValue;
			$customer->password->CssStyle = "";
			$customer->password->CssClass = "";
			$customer->password->ViewCustomAttributes = "";

			// name
			$customer->name->ViewValue = $customer->name->CurrentValue;
			$customer->name->CssStyle = "";
			$customer->name->CssClass = "";
			$customer->name->ViewCustomAttributes = "";

			// email
			$customer->email->ViewValue = $customer->email->CurrentValue;
			$customer->email->CssStyle = "";
			$customer->email->CssClass = "";
			$customer->email->ViewCustomAttributes = "";

			// phone
			$customer->phone->ViewValue = $customer->phone->CurrentValue;
			$customer->phone->CssStyle = "";
			$customer->phone->CssClass = "";
			$customer->phone->ViewCustomAttributes = "";

			// mobile
			$customer->mobile->ViewValue = $customer->mobile->CurrentValue;
			$customer->mobile->CssStyle = "";
			$customer->mobile->CssClass = "";
			$customer->mobile->ViewCustomAttributes = "";

			// country
			$customer->country->ViewValue = $customer->country->CurrentValue;
			$customer->country->CssStyle = "";
			$customer->country->CssClass = "";
			$customer->country->ViewCustomAttributes = "";

			// date_lastlogin
			$customer->date_lastlogin->ViewValue = $customer->date_lastlogin->CurrentValue;
			$customer->date_lastlogin->ViewValue = ew_FormatDateTime($customer->date_lastlogin->ViewValue, 5);
			$customer->date_lastlogin->CssStyle = "";
			$customer->date_lastlogin->CssClass = "";
			$customer->date_lastlogin->ViewCustomAttributes = "";

			// date_register
			$customer->date_register->ViewValue = $customer->date_register->CurrentValue;
			$customer->date_register->ViewValue = ew_FormatDateTime($customer->date_register->ViewValue, 5);
			$customer->date_register->CssStyle = "";
			$customer->date_register->CssClass = "";
			$customer->date_register->ViewCustomAttributes = "";

			// status
			if (strval($customer->status->CurrentValue) <> "") {
				switch ($customer->status->CurrentValue) {
					case "1":
						$customer->status->ViewValue = "Active";
						break;
					case "2":
						$customer->status->ViewValue = "Not Active";
						break;
					default:
						$customer->status->ViewValue = $customer->status->CurrentValue;
				}
			} else {
				$customer->status->ViewValue = NULL;
			}
			$customer->status->CssStyle = "";
			$customer->status->CssClass = "";
			$customer->status->ViewCustomAttributes = "";

			// id
			$customer->id->HrefValue = "";

			// user_name
			$customer->user_name->HrefValue = "";

			// password
			$customer->password->HrefValue = "";

			// name
			$customer->name->HrefValue = "";

			// email
			$customer->email->HrefValue = "";

			// mobile
			$customer->mobile->HrefValue = "";

			// country
			$customer->country->HrefValue = "";

			// date_lastlogin
			$customer->date_lastlogin->HrefValue = "";

			// date_register
			$customer->date_register->HrefValue = "";

			// status
			$customer->status->HrefValue = "";
		}

		// Call Row Rendered event
		$customer->Row_Rendered();
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
