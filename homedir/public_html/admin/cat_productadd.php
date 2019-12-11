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
$cat_product_add = new ccat_product_add();
$Page =& $cat_product_add;

// Page init processing
$cat_product_add->Page_Init();

// Page main processing
$cat_product_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var cat_product_add = new ew_Page("cat_product_add");

// page properties
cat_product_add.PageID = "add"; // page ID
var EW_PAGE_ID = cat_product_add.PageID; // for backward compatibility

// extend page with ValidateForm function
cat_product_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_cat_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Cat Id");
		elm = fobj.elements["x" + infix + "_type"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Type");
		elm = fobj.elements["x" + infix + "_photo"];
		aelm = fobj.elements["a" + infix + "_photo"];
		var chk_photo = (aelm && aelm[0])?(aelm[2].checked):true;
		if (elm && chk_photo && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Photo");
		elm = fobj.elements["x" + infix + "_photo"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, "File type is not allowed.");
		elm = fobj.elements["x" + infix + "_date_update"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Date Update");
		elm = fobj.elements["x" + infix + "_date_update"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "Incorrect date, format = yyyy/mm/dd - Date Update");
		elm = fobj.elements["x" + infix + "_sort_order"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - Sort Order");
		elm = fobj.elements["x" + infix + "_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Status");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
cat_product_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
cat_product_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
cat_product_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
cat_product_add.ShowHighlightText = "Show highlight"; 
cat_product_add.HideHighlightText = "Hide highlight";

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script type="text/javascript" src="fckeditor/fckeditor.js"></script>
<script type="text/javascript">
<!--
_width_multiplier = 16;
_height_multiplier = 60;
var ew_DHTMLEditors = [];

// update value from editor to textarea
function ew_UpdateTextArea() {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {			
			var inst;			
			for (inst in FCKeditorAPI.__Instances)
				FCKeditorAPI.__Instances[inst].UpdateLinkedField();
	}
}

// update value from textarea to editor
function ew_UpdateDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {
		var inst = FCKeditorAPI.GetInstance(name);		
		if (inst)
			inst.SetHTML(inst.LinkedField.value)
	}
}

// focus editor
function ew_FocusDHTMLEditor(name) {
	if (typeof ew_DHTMLEditors != 'undefined' && typeof FCKeditorAPI != 'undefined') {
		var inst = FCKeditorAPI.GetInstance(name);	
		if (inst && inst.EditorWindow) {
			inst.EditorWindow.focus();
		}
	}
}

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<div align="center" class="msm_h1">Add to TABLE: Cat Product</div>
<p><span class="phpmaker"><br><br>
<a href="<?php echo $cat_product->getReturnUrl() ?>">Go Back</a></span></p>
<?php $cat_product_add->ShowMessage() ?>
<form name="fcat_productadd" id="fcat_productadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data">
<p>
<input type="hidden" name="t" id="t" value="cat_product">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($cat_product->cat_id->Visible) { // cat_id ?>
	<tr<?php echo $cat_product->cat_id->RowAttributes ?>>
		<td class="ewTableHeader">Cat Id<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $cat_product->cat_id->CellAttributes() ?>><span id="el_cat_id">
<?php if ($cat_product->cat_id->getSessionValue() <> "") { ?>
<div<?php echo $cat_product->cat_id->ViewAttributes() ?>><?php echo $cat_product->cat_id->ViewValue ?></div>
<input type="hidden" id="x_cat_id" name="x_cat_id" value="<?php echo ew_HtmlEncode($cat_product->cat_id->CurrentValue) ?>">
<?php } else { ?>
<select id="x_cat_id" name="x_cat_id"<?php echo $cat_product->cat_id->EditAttributes() ?>>
<?php
if (is_array($cat_product->cat_id->EditValue)) {
	$arwrk = $cat_product->cat_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($cat_product->cat_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php } ?>
</span><?php echo $cat_product->cat_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_product->manufacture_id->Visible) { // manufacture_id ?>
	<tr<?php echo $cat_product->manufacture_id->RowAttributes ?>>
		<td class="ewTableHeader">Manufacture Id<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $cat_product->manufacture_id->CellAttributes() ?>><span id="el_manufacture_id">
<select id="x_manufacture_id" name="x_manufacture_id"<?php echo $cat_product->manufacture_id->EditAttributes() ?>>
<?php
if (is_array($cat_product->manufacture_id->EditValue)) {
	$arwrk = $cat_product->manufacture_id->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($cat_product->manufacture_id->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $cat_product->manufacture_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_product->type->Visible) { // type ?>
	<tr<?php echo $cat_product->type->RowAttributes ?>>
		<td class="ewTableHeader">Type<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $cat_product->type->CellAttributes() ?>><span id="el_type">
<div id="tp_x_type" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_type" id="x_type" value="{value}"<?php echo $cat_product->type->EditAttributes() ?>></div>
<div id="dsl_x_type" repeatcolumn="5">
<?php
$arwrk = $cat_product->type->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($cat_product->type->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_type" id="x_type" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $cat_product->type->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $cat_product->type->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_product->name->Visible) { // name ?>
	<tr<?php echo $cat_product->name->RowAttributes ?>>
		<td class="ewTableHeader">Name<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $cat_product->name->CellAttributes() ?>><span id="el_name">
<input type="text" name="x_name" id="x_name" size="30" maxlength="200" value="<?php echo $cat_product->name->EditValue ?>"<?php echo $cat_product->name->EditAttributes() ?>>
</span><?php echo $cat_product->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_product->photo->Visible) { // photo ?>
	<tr<?php echo $cat_product->photo->RowAttributes ?>>
		<td class="ewTableHeader">Photo<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $cat_product->photo->CellAttributes() ?>><span id="el_photo">
<input type="file" name="x_photo" id="x_photo" size="30"<?php echo $cat_product->photo->EditAttributes() ?>>
</div>
</span><?php echo $cat_product->photo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_product->year->Visible) { // year ?>
	<tr<?php echo $cat_product->year->RowAttributes ?>>
		<td class="ewTableHeader">Year</td>
		<td<?php echo $cat_product->year->CellAttributes() ?>><span id="el_year">
<input type="text" name="x_year" id="x_year" size="30" maxlength="100" value="<?php echo $cat_product->year->EditValue ?>"<?php echo $cat_product->year->EditAttributes() ?>>
</span><?php echo $cat_product->year->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_product->model->Visible) { // model ?>
	<tr<?php echo $cat_product->model->RowAttributes ?>>
		<td class="ewTableHeader">Model</td>
		<td<?php echo $cat_product->model->CellAttributes() ?>><span id="el_model">
<input type="text" name="x_model" id="x_model" size="30" maxlength="100" value="<?php echo $cat_product->model->EditValue ?>"<?php echo $cat_product->model->EditAttributes() ?>>
</span><?php echo $cat_product->model->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_product->price->Visible) { // price ?>
	<tr<?php echo $cat_product->price->RowAttributes ?>>
		<td class="ewTableHeader">Price</td>
		<td<?php echo $cat_product->price->CellAttributes() ?>><span id="el_price">
<input type="text" name="x_price" id="x_price" size="30" maxlength="100" value="<?php echo $cat_product->price->EditValue ?>"<?php echo $cat_product->price->EditAttributes() ?>>
</span><?php echo $cat_product->price->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_product->location->Visible) { // location ?>
	<tr<?php echo $cat_product->location->RowAttributes ?>>
		<td class="ewTableHeader">Location</td>
		<td<?php echo $cat_product->location->CellAttributes() ?>><span id="el_location">
<input type="text" name="x_location" id="x_location" size="30" maxlength="100" value="<?php echo $cat_product->location->EditValue ?>"<?php echo $cat_product->location->EditAttributes() ?>>
</span><?php echo $cat_product->location->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_product->serial_no->Visible) { // serial_no ?>
	<tr<?php echo $cat_product->serial_no->RowAttributes ?>>
		<td class="ewTableHeader">Serial No</td>
		<td<?php echo $cat_product->serial_no->CellAttributes() ?>><span id="el_serial_no">
<input type="text" name="x_serial_no" id="x_serial_no" size="30" maxlength="100" value="<?php echo $cat_product->serial_no->EditValue ?>"<?php echo $cat_product->serial_no->EditAttributes() ?>>
</span><?php echo $cat_product->serial_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_product->condition->Visible) { // condition ?>
	<tr<?php echo $cat_product->condition->RowAttributes ?>>
		<td class="ewTableHeader">Condition</td>
		<td<?php echo $cat_product->condition->CellAttributes() ?>><span id="el_condition">
<div id="tp_x_condition" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_condition" id="x_condition" value="{value}"<?php echo $cat_product->condition->EditAttributes() ?>></div>
<div id="dsl_x_condition" repeatcolumn="5">
<?php
$arwrk = $cat_product->condition->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($cat_product->condition->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_condition" id="x_condition" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $cat_product->condition->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $cat_product->condition->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_product->stock_no->Visible) { // stock_no ?>
	<tr<?php echo $cat_product->stock_no->RowAttributes ?>>
		<td class="ewTableHeader">Stock No</td>
		<td<?php echo $cat_product->stock_no->CellAttributes() ?>><span id="el_stock_no">
<input type="text" name="x_stock_no" id="x_stock_no" size="30" maxlength="100" value="<?php echo $cat_product->stock_no->EditValue ?>"<?php echo $cat_product->stock_no->EditAttributes() ?>>
</span><?php echo $cat_product->stock_no->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_product->horse_power->Visible) { // horse_power ?>
	<tr<?php echo $cat_product->horse_power->RowAttributes ?>>
		<td class="ewTableHeader">Horse Power</td>
		<td<?php echo $cat_product->horse_power->CellAttributes() ?>><span id="el_horse_power">
<input type="text" name="x_horse_power" id="x_horse_power" size="30" maxlength="100" value="<?php echo $cat_product->horse_power->EditValue ?>"<?php echo $cat_product->horse_power->EditAttributes() ?>>
</span><?php echo $cat_product->horse_power->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_product->hour->Visible) { // hour ?>
	<tr<?php echo $cat_product->hour->RowAttributes ?>>
		<td class="ewTableHeader">Hour</td>
		<td<?php echo $cat_product->hour->CellAttributes() ?>><span id="el_hour">
<input type="text" name="x_hour" id="x_hour" size="30" maxlength="100" value="<?php echo $cat_product->hour->EditValue ?>"<?php echo $cat_product->hour->EditAttributes() ?>>
</span><?php echo $cat_product->hour->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_product->drive->Visible) { // drive ?>
	<tr<?php echo $cat_product->drive->RowAttributes ?>>
		<td class="ewTableHeader">Drive</td>
		<td<?php echo $cat_product->drive->CellAttributes() ?>><span id="el_drive">
<input type="text" name="x_drive" id="x_drive" size="30" maxlength="100" value="<?php echo $cat_product->drive->EditValue ?>"<?php echo $cat_product->drive->EditAttributes() ?>>
</span><?php echo $cat_product->drive->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_product->general_info->Visible) { // general_info ?>
	<tr<?php echo $cat_product->general_info->RowAttributes ?>>
		<td class="ewTableHeader">General Info</td>
		<td<?php echo $cat_product->general_info->CellAttributes() ?>><span id="el_general_info">
<textarea name="x_general_info" id="x_general_info" cols="45" rows="5"<?php echo $cat_product->general_info->EditAttributes() ?>><?php echo $cat_product->general_info->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_general_info", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_general_info', 45*_width_multiplier, 5*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span><?php echo $cat_product->general_info->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_product->description->Visible) { // description ?>
	<tr<?php echo $cat_product->description->RowAttributes ?>>
		<td class="ewTableHeader">Description</td>
		<td<?php echo $cat_product->description->CellAttributes() ?>><span id="el_description">
<textarea name="x_description" id="x_description" cols="45" rows="5"<?php echo $cat_product->description->EditAttributes() ?>><?php echo $cat_product->description->EditValue ?></textarea>
<script type="text/javascript">
<!--
ew_DHTMLEditors.push(new ew_DHTMLEditor("x_description", function() {
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor('x_description', 45*_width_multiplier, 5*_height_multiplier);
	oFCKeditor.BasePath = sBasePath;
	oFCKeditor.ReplaceTextarea();
	this.active = true;
}));
-->
</script>
</span><?php echo $cat_product->description->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_product->date_update->Visible) { // date_update ?>
	<tr<?php echo $cat_product->date_update->RowAttributes ?>>
		<td class="ewTableHeader">Date Update<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $cat_product->date_update->CellAttributes() ?>><span id="el_date_update">
<input type="text" name="x_date_update" id="x_date_update" value="<?php echo $cat_product->date_update->EditValue ?>"<?php echo $cat_product->date_update->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_date_update" name="cal_x_date_update" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_date_update", // ID of the input field
	ifFormat : "%Y/%m/%d", // the date format
	button : "cal_x_date_update" // ID of the button
});
</script>
</span><?php echo $cat_product->date_update->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_product->sort_order->Visible) { // sort_order ?>
	<tr<?php echo $cat_product->sort_order->RowAttributes ?>>
		<td class="ewTableHeader">Sort Order</td>
		<td<?php echo $cat_product->sort_order->CellAttributes() ?>><span id="el_sort_order">
<input type="text" name="x_sort_order" id="x_sort_order" size="30" value="<?php echo $cat_product->sort_order->EditValue ?>"<?php echo $cat_product->sort_order->EditAttributes() ?>>
</span><?php echo $cat_product->sort_order->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($cat_product->status->Visible) { // status ?>
	<tr<?php echo $cat_product->status->RowAttributes ?>>
		<td class="ewTableHeader">Status<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $cat_product->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><input type="radio" name="x_status" id="x_status" value="{value}"<?php echo $cat_product->status->EditAttributes() ?>></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $cat_product->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($cat_product->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $cat_product->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $cat_product->status->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="button" name="btnAction" id="btnAction" value="    Add    " onclick="ew_SubmitForm(cat_product_add, this.form);">
</form>
<script type="text/javascript">
<!--
ew_CreateEditor();  // Create DHTML editor(s)

//-->
</script>
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
class ccat_product_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'cat_product';

	// Page Object Name
	var $PageObjName = 'cat_product_add';

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
	function ccat_product_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["cat_product"] = new ccat_product();

		// Initialize other table object
		$GLOBALS['category'] = new ccategory();

		// Initialize other table object
		$GLOBALS['password'] = new cpassword();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $x_ewPriv = 0;

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $cat_product;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $cat_product->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $cat_product->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$cat_product->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $cat_product->CurrentAction = "C"; // Copy Record
		  } else {
		    $cat_product->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($cat_product->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No records found"); // No record found
		      $this->Page_Terminate("cat_productlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$cat_product->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Add succeeded"); // Set up success message
					$sReturnUrl = $cat_product->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$cat_product->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $cat_product;

		// Get upload data
			if ($cat_product->photo->Upload->UploadFile()) {

				// No action required
			} else {
				echo $cat_product->photo->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $cat_product;
		$cat_product->photo->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $cat_product;
		$cat_product->cat_id->setFormValue($objForm->GetValue("x_cat_id"));
		$cat_product->manufacture_id->setFormValue($objForm->GetValue("x_manufacture_id"));
		$cat_product->type->setFormValue($objForm->GetValue("x_type"));
		$cat_product->name->setFormValue($objForm->GetValue("x_name"));
		$cat_product->year->setFormValue($objForm->GetValue("x_year"));
		$cat_product->model->setFormValue($objForm->GetValue("x_model"));
		$cat_product->price->setFormValue($objForm->GetValue("x_price"));
		$cat_product->location->setFormValue($objForm->GetValue("x_location"));
		$cat_product->serial_no->setFormValue($objForm->GetValue("x_serial_no"));
		$cat_product->condition->setFormValue($objForm->GetValue("x_condition"));
		$cat_product->stock_no->setFormValue($objForm->GetValue("x_stock_no"));
		$cat_product->horse_power->setFormValue($objForm->GetValue("x_horse_power"));
		$cat_product->hour->setFormValue($objForm->GetValue("x_hour"));
		$cat_product->drive->setFormValue($objForm->GetValue("x_drive"));
		$cat_product->general_info->setFormValue($objForm->GetValue("x_general_info"));
		$cat_product->description->setFormValue($objForm->GetValue("x_description"));
		$cat_product->date_update->setFormValue($objForm->GetValue("x_date_update"));
		$cat_product->date_update->CurrentValue = ew_UnFormatDateTime($cat_product->date_update->CurrentValue, 5);
		$cat_product->sort_order->setFormValue($objForm->GetValue("x_sort_order"));
		$cat_product->status->setFormValue($objForm->GetValue("x_status"));
		$cat_product->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $cat_product;
		$cat_product->id->CurrentValue = $cat_product->id->FormValue;
		$cat_product->cat_id->CurrentValue = $cat_product->cat_id->FormValue;
		$cat_product->manufacture_id->CurrentValue = $cat_product->manufacture_id->FormValue;
		$cat_product->type->CurrentValue = $cat_product->type->FormValue;
		$cat_product->name->CurrentValue = $cat_product->name->FormValue;
		$cat_product->year->CurrentValue = $cat_product->year->FormValue;
		$cat_product->model->CurrentValue = $cat_product->model->FormValue;
		$cat_product->price->CurrentValue = $cat_product->price->FormValue;
		$cat_product->location->CurrentValue = $cat_product->location->FormValue;
		$cat_product->serial_no->CurrentValue = $cat_product->serial_no->FormValue;
		$cat_product->condition->CurrentValue = $cat_product->condition->FormValue;
		$cat_product->stock_no->CurrentValue = $cat_product->stock_no->FormValue;
		$cat_product->horse_power->CurrentValue = $cat_product->horse_power->FormValue;
		$cat_product->hour->CurrentValue = $cat_product->hour->FormValue;
		$cat_product->drive->CurrentValue = $cat_product->drive->FormValue;
		$cat_product->general_info->CurrentValue = $cat_product->general_info->FormValue;
		$cat_product->description->CurrentValue = $cat_product->description->FormValue;
		$cat_product->date_update->CurrentValue = $cat_product->date_update->FormValue;
		$cat_product->date_update->CurrentValue = ew_UnFormatDateTime($cat_product->date_update->CurrentValue, 5);
		$cat_product->sort_order->CurrentValue = $cat_product->sort_order->FormValue;
		$cat_product->status->CurrentValue = $cat_product->status->FormValue;
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
		} elseif ($cat_product->RowType == EW_ROWTYPE_ADD) { // Add row

			// cat_id
			$cat_product->cat_id->EditCustomAttributes = "";
			if ($cat_product->cat_id->getSessionValue() <> "") {
				$cat_product->cat_id->CurrentValue = $cat_product->cat_id->getSessionValue();
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
			} else {
			$sSqlWrk = "SELECT `id`, `name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `category`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$cat_product->cat_id->EditValue = $arwrk;
			}

			// manufacture_id
			$cat_product->manufacture_id->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id`, `name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `manufacture`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$cat_product->manufacture_id->EditValue = $arwrk;

			// type
			$cat_product->type->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Machine");
			$arwrk[] = array("2", "parts");
			$cat_product->type->EditValue = $arwrk;

			// name
			$cat_product->name->EditCustomAttributes = "";
			$cat_product->name->EditValue = ew_HtmlEncode($cat_product->name->CurrentValue);

			// photo
			$cat_product->photo->EditCustomAttributes = "";
			if (!is_null($cat_product->photo->Upload->DbValue)) {
				$cat_product->photo->EditValue = $cat_product->photo->Upload->DbValue;
				$cat_product->photo->ImageWidth = 120;
				$cat_product->photo->ImageHeight = 0;
				$cat_product->photo->ImageAlt = "";
			} else {
				$cat_product->photo->EditValue = "";
			}

			// year
			$cat_product->year->EditCustomAttributes = "";
			$cat_product->year->EditValue = ew_HtmlEncode($cat_product->year->CurrentValue);

			// model
			$cat_product->model->EditCustomAttributes = "";
			$cat_product->model->EditValue = ew_HtmlEncode($cat_product->model->CurrentValue);

			// price
			$cat_product->price->EditCustomAttributes = "";
			$cat_product->price->EditValue = ew_HtmlEncode($cat_product->price->CurrentValue);

			// location
			$cat_product->location->EditCustomAttributes = "";
			$cat_product->location->EditValue = ew_HtmlEncode($cat_product->location->CurrentValue);

			// serial_no
			$cat_product->serial_no->EditCustomAttributes = "";
			$cat_product->serial_no->EditValue = ew_HtmlEncode($cat_product->serial_no->CurrentValue);

			// condition
			$cat_product->condition->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Used");
			$arwrk[] = array("2", "Un Used");
			$cat_product->condition->EditValue = $arwrk;

			// stock_no
			$cat_product->stock_no->EditCustomAttributes = "";
			$cat_product->stock_no->EditValue = ew_HtmlEncode($cat_product->stock_no->CurrentValue);

			// horse_power
			$cat_product->horse_power->EditCustomAttributes = "";
			$cat_product->horse_power->EditValue = ew_HtmlEncode($cat_product->horse_power->CurrentValue);

			// hour
			$cat_product->hour->EditCustomAttributes = "";
			$cat_product->hour->EditValue = ew_HtmlEncode($cat_product->hour->CurrentValue);

			// drive
			$cat_product->drive->EditCustomAttributes = "";
			$cat_product->drive->EditValue = ew_HtmlEncode($cat_product->drive->CurrentValue);

			// general_info
			$cat_product->general_info->EditCustomAttributes = "";
			$cat_product->general_info->EditValue = ew_HtmlEncode($cat_product->general_info->CurrentValue);

			// description
			$cat_product->description->EditCustomAttributes = "";
			$cat_product->description->EditValue = ew_HtmlEncode($cat_product->description->CurrentValue);

			// date_update
			$cat_product->date_update->EditCustomAttributes = "";
			$cat_product->date_update->EditValue = ew_HtmlEncode(ew_FormatDateTime($cat_product->date_update->CurrentValue, 5));

			// sort_order
			$cat_product->sort_order->EditCustomAttributes = "";
			$cat_product->sort_order->EditValue = ew_HtmlEncode($cat_product->sort_order->CurrentValue);

			// status
			$cat_product->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Active");
			$arwrk[] = array("2", "Not Active");
			$cat_product->status->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$cat_product->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $cat_product;

		// Initialize
		$gsFormError = "";
		if (!ew_CheckFileType($cat_product->photo->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "File type is not allowed.";
		}
		if ($cat_product->photo->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0) {
			if ($cat_product->photo->Upload->FileSize > EW_MAX_FILE_SIZE)
				$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, "Max. file size (%s bytes) exceeded.");
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($cat_product->cat_id->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Cat Id";
		}
		if ($cat_product->type->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Type";
		}
		if (is_null($cat_product->photo->Upload->Value)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Photo";
		}
		if ($cat_product->date_update->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Date Update";
		}
		if (!ew_CheckDate($cat_product->date_update->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect date, format = yyyy/mm/dd - Date Update";
		}
		if (!ew_CheckInteger($cat_product->sort_order->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Sort Order";
		}
		if ($cat_product->status->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Status";
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $cat_product;
		$rsnew = array();

		// Field cat_id
		$cat_product->cat_id->SetDbValueDef($cat_product->cat_id->CurrentValue, 0);
		$rsnew['cat_id'] =& $cat_product->cat_id->DbValue;

		// Field manufacture_id
		$cat_product->manufacture_id->SetDbValueDef($cat_product->manufacture_id->CurrentValue, 0);
		$rsnew['manufacture_id'] =& $cat_product->manufacture_id->DbValue;

		// Field type
		$cat_product->type->SetDbValueDef($cat_product->type->CurrentValue, 0);
		$rsnew['type'] =& $cat_product->type->DbValue;

		// Field name
		$cat_product->name->SetDbValueDef($cat_product->name->CurrentValue, "");
		$rsnew['name'] =& $cat_product->name->DbValue;

		// Field photo
		$cat_product->photo->Upload->SaveToSession(); // Save file value to Session
		if (is_null($cat_product->photo->Upload->Value)) {
			$rsnew['photo'] = NULL;
		} else {
			$rsnew['photo'] = ew_UploadFileNameEx(ew_UploadPathEx(True, "../upload/image/"), $cat_product->photo->Upload->FileName);
		}

		// Field year
		$cat_product->year->SetDbValueDef($cat_product->year->CurrentValue, NULL);
		$rsnew['year'] =& $cat_product->year->DbValue;

		// Field model
		$cat_product->model->SetDbValueDef($cat_product->model->CurrentValue, NULL);
		$rsnew['model'] =& $cat_product->model->DbValue;

		// Field price
		$cat_product->price->SetDbValueDef($cat_product->price->CurrentValue, NULL);
		$rsnew['price'] =& $cat_product->price->DbValue;

		// Field location
		$cat_product->location->SetDbValueDef($cat_product->location->CurrentValue, NULL);
		$rsnew['location'] =& $cat_product->location->DbValue;

		// Field serial_no
		$cat_product->serial_no->SetDbValueDef($cat_product->serial_no->CurrentValue, NULL);
		$rsnew['serial_no'] =& $cat_product->serial_no->DbValue;

		// Field condition
		$cat_product->condition->SetDbValueDef($cat_product->condition->CurrentValue, NULL);
		$rsnew['condition'] =& $cat_product->condition->DbValue;

		// Field stock_no
		$cat_product->stock_no->SetDbValueDef($cat_product->stock_no->CurrentValue, NULL);
		$rsnew['stock_no'] =& $cat_product->stock_no->DbValue;

		// Field horse_power
		$cat_product->horse_power->SetDbValueDef($cat_product->horse_power->CurrentValue, NULL);
		$rsnew['horse_power'] =& $cat_product->horse_power->DbValue;

		// Field hour
		$cat_product->hour->SetDbValueDef($cat_product->hour->CurrentValue, NULL);
		$rsnew['hour'] =& $cat_product->hour->DbValue;

		// Field drive
		$cat_product->drive->SetDbValueDef($cat_product->drive->CurrentValue, NULL);
		$rsnew['drive'] =& $cat_product->drive->DbValue;

		// Field general_info
		$cat_product->general_info->SetDbValueDef($cat_product->general_info->CurrentValue, NULL);
		$rsnew['general_info'] =& $cat_product->general_info->DbValue;

		// Field description
		$cat_product->description->SetDbValueDef($cat_product->description->CurrentValue, NULL);
		$rsnew['description'] =& $cat_product->description->DbValue;

		// Field date_update
		$cat_product->date_update->SetDbValueDef(ew_UnFormatDateTime($cat_product->date_update->CurrentValue, 5), ew_CurrentDate());
		$rsnew['date_update'] =& $cat_product->date_update->DbValue;

		// Field sort_order
		$cat_product->sort_order->SetDbValueDef($cat_product->sort_order->CurrentValue, NULL);
		$rsnew['sort_order'] =& $cat_product->sort_order->DbValue;

		// Field status
		$cat_product->status->SetDbValueDef($cat_product->status->CurrentValue, 0);
		$rsnew['status'] =& $cat_product->status->DbValue;

		// Call Row Inserting event
		$bInsertRow = $cat_product->Row_Inserting($rsnew);
		if ($bInsertRow) {

			// Field photo
			if (!is_null($cat_product->photo->Upload->Value)) {
				$cat_product->photo->Upload->SaveToFile("../upload/image/", $rsnew['photo'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($cat_product->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($cat_product->CancelMessage <> "") {
				$this->setMessage($cat_product->CancelMessage);
				$cat_product->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$cat_product->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $cat_product->id->DbValue;

			// Call Row Inserted event
			$cat_product->Row_Inserted($rsnew);
		}

		// Field photo
		$cat_product->photo->Upload->RemoveFromSession(); // Remove file value from Session
		return $AddRow;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
