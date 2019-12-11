<?php
define("EW_PAGE_ID", "preview", TRUE);
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "cat_productinfo.php" ?>
<?php include "passwordinfo.php" ?>
<?php include "userfn6.php" ?>
<?php

// Init table objects
$cat_product = new ccat_product();
$password = new cpassword();

// Open connection to the database
$conn = ew_Connect();
$Security = new cAdvancedSecurity();
if (!$Security->IsLoggedIn()) $Security->AutoLogin();
if (!$Security->IsLoggedIn()) {
	echo "You do not have the right permission to view the page";
	exit();
}

// Load filter
$qs = new cQueryString();
$filter = $qs->GetValue("f");
$filter = TEAdecrypt($filter, EW_RANDOM_KEY);
if ($filter == "") $filter = "0=1";

// Load recordset
$rs = $cat_product->LoadRs($filter);
$nTotalRecs = ($rs) ? $rs->RecordCount() : 0;
?>
<link href="karim.css" rel="stylesheet" type="text/css">
<p><span class="phpmaker" style="white-space: nowrap;">TABLE: Cat Product
<?php if ($nTotalRecs > 0) { ?>
(<?php echo $nTotalRecs ?> Records)
<?php } else { ?>
(No records found)
<?php } ?>
</span></p>
<?php if ($nTotalRecs > 0) { ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table id="ewDetailsPreviewTable" name="ewDetailsPreviewTable" cellspacing="0" class="ewTable ewTableSeparate">
	<thead><!-- Table header -->
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
	<tbody><!-- Table body -->
<?php
$nRecCount = 0;
while ($rs && !$rs->EOF) {

	// Init row class and style
	$nRecCount++;
	$cat_product->CssClass = "ewTableRow";
	$cat_product->CssStyle = "";
	$cat_product->LoadListRowValues($rs);

	// Render row
	$cat_product->RowType = EW_ROWTYPE_PREVIEW; // Preview record
	$cat_product->RenderListRow();
?>
	<tr<?php echo $cat_product->RowAttributes() ?>>
		<!-- id -->
		<td<?php echo $cat_product->id->CellAttributes() ?>>
<div<?php echo $cat_product->id->ViewAttributes() ?>><?php echo $cat_product->id->ViewValue ?></div></td>
		<!-- cat_id -->
		<td<?php echo $cat_product->cat_id->CellAttributes() ?>>
<div<?php echo $cat_product->cat_id->ViewAttributes() ?>><?php echo $cat_product->cat_id->ViewValue ?></div></td>
		<!-- manufacture_id -->
		<td<?php echo $cat_product->manufacture_id->CellAttributes() ?>>
<div<?php echo $cat_product->manufacture_id->ViewAttributes() ?>><?php echo $cat_product->manufacture_id->ViewValue ?></div></td>
		<!-- type -->
		<td<?php echo $cat_product->type->CellAttributes() ?>>
<div<?php echo $cat_product->type->ViewAttributes() ?>><?php echo $cat_product->type->ViewValue ?></div></td>
		<!-- name -->
		<td<?php echo $cat_product->name->CellAttributes() ?>>
<div<?php echo $cat_product->name->ViewAttributes() ?>><?php echo $cat_product->name->ViewValue ?></div></td>
		<!-- photo -->
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
		<!-- year -->
		<td<?php echo $cat_product->year->CellAttributes() ?>>
<div<?php echo $cat_product->year->ViewAttributes() ?>><?php echo $cat_product->year->ViewValue ?></div></td>
		<!-- model -->
		<td<?php echo $cat_product->model->CellAttributes() ?>>
<div<?php echo $cat_product->model->ViewAttributes() ?>><?php echo $cat_product->model->ViewValue ?></div></td>
		<!-- price -->
		<td<?php echo $cat_product->price->CellAttributes() ?>>
<div<?php echo $cat_product->price->ViewAttributes() ?>><?php echo $cat_product->price->ViewValue ?></div></td>
		<!-- location -->
		<td<?php echo $cat_product->location->CellAttributes() ?>>
<div<?php echo $cat_product->location->ViewAttributes() ?>><?php echo $cat_product->location->ViewValue ?></div></td>
		<!-- serial_no -->
		<td<?php echo $cat_product->serial_no->CellAttributes() ?>>
<div<?php echo $cat_product->serial_no->ViewAttributes() ?>><?php echo $cat_product->serial_no->ViewValue ?></div></td>
		<!-- condition -->
		<td<?php echo $cat_product->condition->CellAttributes() ?>>
<div<?php echo $cat_product->condition->ViewAttributes() ?>><?php echo $cat_product->condition->ViewValue ?></div></td>
		<!-- stock_no -->
		<td<?php echo $cat_product->stock_no->CellAttributes() ?>>
<div<?php echo $cat_product->stock_no->ViewAttributes() ?>><?php echo $cat_product->stock_no->ViewValue ?></div></td>
		<!-- horse_power -->
		<td<?php echo $cat_product->horse_power->CellAttributes() ?>>
<div<?php echo $cat_product->horse_power->ViewAttributes() ?>><?php echo $cat_product->horse_power->ViewValue ?></div></td>
		<!-- hour -->
		<td<?php echo $cat_product->hour->CellAttributes() ?>>
<div<?php echo $cat_product->hour->ViewAttributes() ?>><?php echo $cat_product->hour->ViewValue ?></div></td>
		<!-- drive -->
		<td<?php echo $cat_product->drive->CellAttributes() ?>>
<div<?php echo $cat_product->drive->ViewAttributes() ?>><?php echo $cat_product->drive->ViewValue ?></div></td>
		<!-- date_update -->
		<td<?php echo $cat_product->date_update->CellAttributes() ?>>
<div<?php echo $cat_product->date_update->ViewAttributes() ?>><?php echo $cat_product->date_update->ViewValue ?></div></td>
		<!-- sort_order -->
		<td<?php echo $cat_product->sort_order->CellAttributes() ?>>
<div<?php echo $cat_product->sort_order->ViewAttributes() ?>><?php echo $cat_product->sort_order->ViewValue ?></div></td>
		<!-- status -->
		<td<?php echo $cat_product->status->CellAttributes() ?>>
<div<?php echo $cat_product->status->ViewAttributes() ?>><?php echo $cat_product->status->ViewValue ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
?>
	</tbody>
</table>
</div>
</td></tr></table>
<?php
if ($rs)
	$rs->Close();
}
$content = ob_get_contents();
ob_end_clean();
echo ew_ConvertToUtf8($content);
?>
