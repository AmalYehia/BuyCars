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
$category_view = new ccategory_view();
$Page =& $category_view;

// Page init processing
$category_view->Page_Init();

// Page main processing
$category_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($category->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var category_view = new ew_Page("category_view");

// page properties
category_view.PageID = "view"; // page ID
var EW_PAGE_ID = category_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
category_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
category_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
category_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<style>

	/* styles for details panel */
	.yui-overlay { position:absolute;background:#fff;border:2px solid orange;padding:4px;margin:10px; }
	.yui-overlay .hd { border:1px solid red;padding:5px; }
	.yui-overlay .bd { border:0px solid green;padding:5px; }
	.yui-overlay .ft { border:1px solid blue;padding:5px; }
</style>
<div id="ewDetailsDiv" name="ewDetailsDivDiv" style="visibility:hidden"></div>
<script language="JavaScript" type="text/javascript">
<!--

// YUI container
var ewDetailsDiv;
var ew_AjaxDetailsTimer = null;

// init details div
function ew_InitDetailsDiv() {
	ewDetailsDiv = new YAHOO.widget.Overlay("ewDetailsDiv", { context:null, visible:false} );
	ewDetailsDiv.beforeMoveEvent.subscribe(ew_EnforceConstraints, ewDetailsDiv, true);
	ewDetailsDiv.render();
}

// init details div on window.load
YAHOO.util.Event.addListener(window, "load", ew_InitDetailsDiv);

// show results in details div
var ew_AjaxHandleSuccess = function(o) {
	if (ewDetailsDiv && o.responseText !== undefined) {
		ewDetailsDiv.cfg.applyConfig({context:[o.argument.id,o.argument.elcorner,o.argument.ctxcorner], visible:false}, true);
		ewDetailsDiv.setBody(o.responseText);
		ewDetailsDiv.render();
		ew_SetupTable(document.getElementById("ewDetailsPreviewTable"));
		ewDetailsDiv.show();
	}
}

// show error in details div
var ew_AjaxHandleFailure = function(o) {
	if (ewDetailsDiv && o.responseText != "") {
		ewDetailsDiv.cfg.applyConfig({context:[o.argument.id,o.argument.elcorner,o.argument.ctxcorner], visible:false, constraintoviewport:true}, true);
		ewDetailsDiv.setBody(o.responseText);
		ewDetailsDiv.render();
		ewDetailsDiv.show();
	}
}

// show details div
function ew_AjaxShowDetails(obj, url) {
	if (ew_AjaxDetailsTimer)
		clearTimeout(ew_AjaxDetailsTimer);
	ew_AjaxDetailsTimer = setTimeout(function() { YAHOO.util.Connect.asyncRequest('GET', url, {success: ew_AjaxHandleSuccess , failure: ew_AjaxHandleFailure, argument:{id: obj.id, elcorner: "tl", ctxcorner: "tr"}}) }, 200);
}

// hide details div
function ew_AjaxHideDetails(obj) {
	if (ew_AjaxDetailsTimer)
		clearTimeout(ew_AjaxDetailsTimer);
	if (ewDetailsDiv)
		ewDetailsDiv.hide();
}

// move details div
ew_EnforceConstraints = function(type, args, obj) {
	var pos = args[0];
	var x = pos[0];
	var y = pos[1];
	var offsetHeight = this.element.offsetHeight;
	var offsetWidth = this.element.offsetWidth;
	var viewPortWidth = YAHOO.util.Dom.getViewportWidth();
	var viewPortHeight = YAHOO.util.Dom.getViewportHeight();
	var scrollX = document.documentElement.scrollLeft || document.body.scrollLeft;
	var scrollY = document.documentElement.scrollTop || document.body.scrollTop;
	var topConstraint = scrollY + 10;
	var leftConstraint = scrollX + 10;
	var bottomConstraint = scrollY + viewPortHeight - offsetHeight - 10;
	var rightConstraint = scrollX + viewPortWidth - offsetWidth - 10;

// if (x < leftConstraint) {
// x = leftConstraint;
// } else if (x > rightConstraint) {
// x = rightConstraint;
// }

	if (y < topConstraint) {
		y = topConstraint;
	} else if (y > bottomConstraint) {
		y = (bottomConstraint < topConstraint) ? topConstraint : bottomConstraint;
	}

// this.cfg.setProperty("x", x, true);
	this.cfg.setProperty("y", y, true);
	this.cfg.setProperty("xy", [x,y], true);
};

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<div align="center" class="msm_h1">View TABLE: Category</div>
<p><span class="phpmaker">
<br><br>
<?php if ($category->Export == "") { ?>
<a href="categorylist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $category->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $category->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $category->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php
$sSqlWrk = "`parent_id`=" . ew_AdjustSql($category->id->CurrentValue) . "";
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
$sSqlWrk = str_replace("'", "\'", $sSqlWrk);
?>
<a name="ew_category_category_DetailLink" id="ew_category_category_DetailLink" href="categorylist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=category&id=<?php echo urlencode(strval($category->id->CurrentValue)) ?>" onmouseover="ew_AjaxShowDetails(this, 'categorypreview.php?f=<?php echo $sSqlWrk ?>')" onmouseout="ew_AjaxHideDetails(this);">Category...</a>
&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php
$sSqlWrk = "`cat_id`=" . ew_AdjustSql($category->id->CurrentValue) . "";
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
$sSqlWrk = str_replace("'", "\'", $sSqlWrk);
?>
<a name="ew_category_cat_product_DetailLink" id="ew_category_cat_product_DetailLink" href="cat_productlist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=category&id=<?php echo urlencode(strval($category->id->CurrentValue)) ?>" onmouseover="ew_AjaxShowDetails(this, 'cat_productpreview.php?f=<?php echo $sSqlWrk ?>')" onmouseout="ew_AjaxHideDetails(this);">Cat Product...</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $category_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($category->id->Visible) { // id ?>
	<tr<?php echo $category->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $category->id->CellAttributes() ?>>
<div<?php echo $category->id->ViewAttributes() ?>><?php echo $category->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($category->parent_id->Visible) { // parent_id ?>
	<tr<?php echo $category->parent_id->RowAttributes ?>>
		<td class="ewTableHeader">Parent Id</td>
		<td<?php echo $category->parent_id->CellAttributes() ?>>
<div<?php echo $category->parent_id->ViewAttributes() ?>><?php echo $category->parent_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($category->name->Visible) { // name ?>
	<tr<?php echo $category->name->RowAttributes ?>>
		<td class="ewTableHeader">Name</td>
		<td<?php echo $category->name->CellAttributes() ?>>
<div<?php echo $category->name->ViewAttributes() ?>><?php echo $category->name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($category->photo->Visible) { // photo ?>
	<tr<?php echo $category->photo->RowAttributes ?>>
		<td class="ewTableHeader">Photo</td>
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
	</tr>
<?php } ?>
<?php if ($category->description->Visible) { // description ?>
	<tr<?php echo $category->description->RowAttributes ?>>
		<td class="ewTableHeader">Description</td>
		<td<?php echo $category->description->CellAttributes() ?>>
<div<?php echo $category->description->ViewAttributes() ?>><?php echo $category->description->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($category->sort_order->Visible) { // sort_order ?>
	<tr<?php echo $category->sort_order->RowAttributes ?>>
		<td class="ewTableHeader">Sort Order</td>
		<td<?php echo $category->sort_order->CellAttributes() ?>>
<div<?php echo $category->sort_order->ViewAttributes() ?>><?php echo $category->sort_order->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($category->status->Visible) { // status ?>
	<tr<?php echo $category->status->RowAttributes ?>>
		<td class="ewTableHeader">Status</td>
		<td<?php echo $category->status->CellAttributes() ?>>
<div<?php echo $category->status->ViewAttributes() ?>><?php echo $category->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($category->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php

//
// Page Class
//
class ccategory_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'category';

	// Page Object Name
	var $PageObjName = 'category_view';

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
	function ccategory_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["category"] = new ccategory();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
	var $lDisplayRecs; // Number of display records
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs;
	var $lRecRange;
	var $lRecCnt;

	//
	// Page main processing
	//
	function Page_Main() {
		global $category;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$category->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "categorylist.php"; // Return to list
			}

			// Get action
			$category->CurrentAction = "I"; // Display form
			switch ($category->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "categorylist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "categorylist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$category->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $category;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$category->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$category->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $category->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$category->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$category->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$category->setStartRecordNumber($this->lStartRec);
		}
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

		// description
		$category->description->CellCssStyle = "";
		$category->description->CellCssClass = "";

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

			// description
			$category->description->ViewValue = $category->description->CurrentValue;
			$category->description->CssStyle = "";
			$category->description->CssClass = "";
			$category->description->ViewCustomAttributes = "";

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

			// description
			$category->description->HrefValue = "";

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
