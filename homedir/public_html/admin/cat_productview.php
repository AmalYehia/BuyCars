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
$cat_product_view = new ccat_product_view();
$Page =& $cat_product_view;

// Page init processing
$cat_product_view->Page_Init();

// Page main processing
$cat_product_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($cat_product->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var cat_product_view = new ew_Page("cat_product_view");

// page properties
cat_product_view.PageID = "view"; // page ID
var EW_PAGE_ID = cat_product_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
cat_product_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
cat_product_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cat_product_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
cat_product_view.ShowHighlightText = "Show highlight"; 
cat_product_view.HideHighlightText = "Hide highlight";

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
<div align="center" class="msm_h1">View TABLE: Cat Product</div>
<p><span class="phpmaker">
<br><br>
<?php if ($cat_product->Export == "") { ?>
<a href="cat_productlist.php">Back to List</a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $cat_product->AddUrl() ?>">Add</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $cat_product->EditUrl() ?>">Edit</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $cat_product->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php
$sSqlWrk = "`product_id`=" . ew_AdjustSql($cat_product->id->CurrentValue) . "";
$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
$sSqlWrk = str_replace("'", "\'", $sSqlWrk);
?>
<a name="ew_cat_product_cat_p_photo_DetailLink" id="ew_cat_product_cat_p_photo_DetailLink" href="cat_p_photolist.php?<?php echo EW_TABLE_SHOW_MASTER ?>=cat_product&id=<?php echo urlencode(strval($cat_product->id->CurrentValue)) ?>" onmouseover="ew_AjaxShowDetails(this, 'cat_p_photopreview.php?f=<?php echo $sSqlWrk ?>')" onmouseout="ew_AjaxHideDetails(this);">Cat P Photo...</a>
&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php $cat_product_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($cat_product->id->Visible) { // id ?>
	<tr<?php echo $cat_product->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $cat_product->id->CellAttributes() ?>>
<div<?php echo $cat_product->id->ViewAttributes() ?>><?php echo $cat_product->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_product->cat_id->Visible) { // cat_id ?>
	<tr<?php echo $cat_product->cat_id->RowAttributes ?>>
		<td class="ewTableHeader">Cat Id</td>
		<td<?php echo $cat_product->cat_id->CellAttributes() ?>>
<div<?php echo $cat_product->cat_id->ViewAttributes() ?>><?php echo $cat_product->cat_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_product->manufacture_id->Visible) { // manufacture_id ?>
	<tr<?php echo $cat_product->manufacture_id->RowAttributes ?>>
		<td class="ewTableHeader">Manufacture Id</td>
		<td<?php echo $cat_product->manufacture_id->CellAttributes() ?>>
<div<?php echo $cat_product->manufacture_id->ViewAttributes() ?>><?php echo $cat_product->manufacture_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_product->type->Visible) { // type ?>
	<tr<?php echo $cat_product->type->RowAttributes ?>>
		<td class="ewTableHeader">Type</td>
		<td<?php echo $cat_product->type->CellAttributes() ?>>
<div<?php echo $cat_product->type->ViewAttributes() ?>><?php echo $cat_product->type->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_product->name->Visible) { // name ?>
	<tr<?php echo $cat_product->name->RowAttributes ?>>
		<td class="ewTableHeader">Name</td>
		<td<?php echo $cat_product->name->CellAttributes() ?>>
<div<?php echo $cat_product->name->ViewAttributes() ?>><?php echo $cat_product->name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_product->photo->Visible) { // photo ?>
	<tr<?php echo $cat_product->photo->RowAttributes ?>>
		<td class="ewTableHeader">Photo</td>
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
	</tr>
<?php } ?>
<?php if ($cat_product->year->Visible) { // year ?>
	<tr<?php echo $cat_product->year->RowAttributes ?>>
		<td class="ewTableHeader">Year</td>
		<td<?php echo $cat_product->year->CellAttributes() ?>>
<div<?php echo $cat_product->year->ViewAttributes() ?>><?php echo $cat_product->year->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_product->model->Visible) { // model ?>
	<tr<?php echo $cat_product->model->RowAttributes ?>>
		<td class="ewTableHeader">Model</td>
		<td<?php echo $cat_product->model->CellAttributes() ?>>
<div<?php echo $cat_product->model->ViewAttributes() ?>><?php echo $cat_product->model->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_product->price->Visible) { // price ?>
	<tr<?php echo $cat_product->price->RowAttributes ?>>
		<td class="ewTableHeader">Price</td>
		<td<?php echo $cat_product->price->CellAttributes() ?>>
<div<?php echo $cat_product->price->ViewAttributes() ?>><?php echo $cat_product->price->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_product->location->Visible) { // location ?>
	<tr<?php echo $cat_product->location->RowAttributes ?>>
		<td class="ewTableHeader">Location</td>
		<td<?php echo $cat_product->location->CellAttributes() ?>>
<div<?php echo $cat_product->location->ViewAttributes() ?>><?php echo $cat_product->location->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_product->serial_no->Visible) { // serial_no ?>
	<tr<?php echo $cat_product->serial_no->RowAttributes ?>>
		<td class="ewTableHeader">Serial No</td>
		<td<?php echo $cat_product->serial_no->CellAttributes() ?>>
<div<?php echo $cat_product->serial_no->ViewAttributes() ?>><?php echo $cat_product->serial_no->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_product->condition->Visible) { // condition ?>
	<tr<?php echo $cat_product->condition->RowAttributes ?>>
		<td class="ewTableHeader">Condition</td>
		<td<?php echo $cat_product->condition->CellAttributes() ?>>
<div<?php echo $cat_product->condition->ViewAttributes() ?>><?php echo $cat_product->condition->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_product->stock_no->Visible) { // stock_no ?>
	<tr<?php echo $cat_product->stock_no->RowAttributes ?>>
		<td class="ewTableHeader">Stock No</td>
		<td<?php echo $cat_product->stock_no->CellAttributes() ?>>
<div<?php echo $cat_product->stock_no->ViewAttributes() ?>><?php echo $cat_product->stock_no->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_product->horse_power->Visible) { // horse_power ?>
	<tr<?php echo $cat_product->horse_power->RowAttributes ?>>
		<td class="ewTableHeader">Horse Power</td>
		<td<?php echo $cat_product->horse_power->CellAttributes() ?>>
<div<?php echo $cat_product->horse_power->ViewAttributes() ?>><?php echo $cat_product->horse_power->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_product->hour->Visible) { // hour ?>
	<tr<?php echo $cat_product->hour->RowAttributes ?>>
		<td class="ewTableHeader">Hour</td>
		<td<?php echo $cat_product->hour->CellAttributes() ?>>
<div<?php echo $cat_product->hour->ViewAttributes() ?>><?php echo $cat_product->hour->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_product->drive->Visible) { // drive ?>
	<tr<?php echo $cat_product->drive->RowAttributes ?>>
		<td class="ewTableHeader">Drive</td>
		<td<?php echo $cat_product->drive->CellAttributes() ?>>
<div<?php echo $cat_product->drive->ViewAttributes() ?>><?php echo $cat_product->drive->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_product->general_info->Visible) { // general_info ?>
	<tr<?php echo $cat_product->general_info->RowAttributes ?>>
		<td class="ewTableHeader">General Info</td>
		<td<?php echo $cat_product->general_info->CellAttributes() ?>>
<div<?php echo $cat_product->general_info->ViewAttributes() ?>><?php echo $cat_product->general_info->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_product->description->Visible) { // description ?>
	<tr<?php echo $cat_product->description->RowAttributes ?>>
		<td class="ewTableHeader">Description</td>
		<td<?php echo $cat_product->description->CellAttributes() ?>>
<div<?php echo $cat_product->description->ViewAttributes() ?>><?php echo $cat_product->description->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_product->date_update->Visible) { // date_update ?>
	<tr<?php echo $cat_product->date_update->RowAttributes ?>>
		<td class="ewTableHeader">Date Update</td>
		<td<?php echo $cat_product->date_update->CellAttributes() ?>>
<div<?php echo $cat_product->date_update->ViewAttributes() ?>><?php echo $cat_product->date_update->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_product->sort_order->Visible) { // sort_order ?>
	<tr<?php echo $cat_product->sort_order->RowAttributes ?>>
		<td class="ewTableHeader">Sort Order</td>
		<td<?php echo $cat_product->sort_order->CellAttributes() ?>>
<div<?php echo $cat_product->sort_order->ViewAttributes() ?>><?php echo $cat_product->sort_order->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($cat_product->status->Visible) { // status ?>
	<tr<?php echo $cat_product->status->RowAttributes ?>>
		<td class="ewTableHeader">Status</td>
		<td<?php echo $cat_product->status->CellAttributes() ?>>
<div<?php echo $cat_product->status->ViewAttributes() ?>><?php echo $cat_product->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($cat_product->Export == "") { ?>
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
class ccat_product_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'cat_product';

	// Page Object Name
	var $PageObjName = 'cat_product_view';

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
	function ccat_product_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["cat_product"] = new ccat_product();

		// Initialize other table object
		$GLOBALS['category'] = new ccategory();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
		global $cat_product;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$cat_product->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "cat_productlist.php"; // Return to list
			}

			// Get action
			$cat_product->CurrentAction = "I"; // Display form
			switch ($cat_product->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "cat_productlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "cat_productlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$cat_product->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $cat_product;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$cat_product->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$cat_product->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $cat_product->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$cat_product->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$cat_product->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$cat_product->setStartRecordNumber($this->lStartRec);
		}
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

		// general_info
		$cat_product->general_info->CellCssStyle = "";
		$cat_product->general_info->CellCssClass = "";

		// description
		$cat_product->description->CellCssStyle = "";
		$cat_product->description->CellCssClass = "";

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

			// general_info
			$cat_product->general_info->ViewValue = $cat_product->general_info->CurrentValue;
			$cat_product->general_info->CssStyle = "";
			$cat_product->general_info->CssClass = "";
			$cat_product->general_info->ViewCustomAttributes = "";

			// description
			$cat_product->description->ViewValue = $cat_product->description->CurrentValue;
			$cat_product->description->CssStyle = "";
			$cat_product->description->CssClass = "";
			$cat_product->description->ViewCustomAttributes = "";

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

			// general_info
			$cat_product->general_info->HrefValue = "";

			// description
			$cat_product->description->HrefValue = "";

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
