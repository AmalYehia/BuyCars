<?php
define("EW_PAGE_ID", "preview", TRUE);
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "cat_p_photoinfo.php" ?>
<?php include "passwordinfo.php" ?>
<?php include "userfn6.php" ?>
<?php

// Init table objects
$cat_p_photo = new ccat_p_photo();
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
$rs = $cat_p_photo->LoadRs($filter);
$nTotalRecs = ($rs) ? $rs->RecordCount() : 0;
?>
<link href="karim.css" rel="stylesheet" type="text/css">
<p><span class="phpmaker" style="white-space: nowrap;">TABLE: Cat P Photo
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
			<td valign="top">Product Id</td>
			<td valign="top">Photo</td>
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
	$cat_p_photo->CssClass = "ewTableRow";
	$cat_p_photo->CssStyle = "";
	$cat_p_photo->LoadListRowValues($rs);

	// Render row
	$cat_p_photo->RowType = EW_ROWTYPE_PREVIEW; // Preview record
	$cat_p_photo->RenderListRow();
?>
	<tr<?php echo $cat_p_photo->RowAttributes() ?>>
		<!-- id -->
		<td<?php echo $cat_p_photo->id->CellAttributes() ?>>
<div<?php echo $cat_p_photo->id->ViewAttributes() ?>><?php echo $cat_p_photo->id->ViewValue ?></div></td>
		<!-- product_id -->
		<td<?php echo $cat_p_photo->product_id->CellAttributes() ?>>
<div<?php echo $cat_p_photo->product_id->ViewAttributes() ?>><?php echo $cat_p_photo->product_id->ViewValue ?></div></td>
		<!-- photo -->
		<td<?php echo $cat_p_photo->photo->CellAttributes() ?>>
<?php if ($cat_p_photo->photo->HrefValue <> "") { ?>
<?php if (!is_null($cat_p_photo->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $cat_p_photo->photo->Upload->DbValue ?>" border=0<?php echo $cat_p_photo->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($cat_p_photo->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!is_null($cat_p_photo->photo->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, "../upload/image/") . $cat_p_photo->photo->Upload->DbValue ?>" border=0<?php echo $cat_p_photo->photo->ViewAttributes() ?>>
<?php } elseif (!in_array($cat_p_photo->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
		<!-- sort_order -->
		<td<?php echo $cat_p_photo->sort_order->CellAttributes() ?>>
<div<?php echo $cat_p_photo->sort_order->ViewAttributes() ?>><?php echo $cat_p_photo->sort_order->ViewValue ?></div></td>
		<!-- status -->
		<td<?php echo $cat_p_photo->status->CellAttributes() ?>>
<div<?php echo $cat_p_photo->status->ViewAttributes() ?>><?php echo $cat_p_photo->status->ViewValue ?></div></td>
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
