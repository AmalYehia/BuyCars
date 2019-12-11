<?php
define("EW_PAGE_ID", "preview", TRUE);
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

// Init table objects
$category = new ccategory();
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
$rs = $category->LoadRs($filter);
$nTotalRecs = ($rs) ? $rs->RecordCount() : 0;
?>
<link href="karim.css" rel="stylesheet" type="text/css">
<p><span class="phpmaker" style="white-space: nowrap;">TABLE: Category
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
			<td valign="top">Parent Id</td>
			<td valign="top">Name</td>
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
	$category->CssClass = "ewTableRow";
	$category->CssStyle = "";
	$category->LoadListRowValues($rs);

	// Render row
	$category->RowType = EW_ROWTYPE_PREVIEW; // Preview record
	$category->RenderListRow();
?>
	<tr<?php echo $category->RowAttributes() ?>>
		<!-- id -->
		<td<?php echo $category->id->CellAttributes() ?>>
<div<?php echo $category->id->ViewAttributes() ?>><?php echo $category->id->ViewValue ?></div></td>
		<!-- parent_id -->
		<td<?php echo $category->parent_id->CellAttributes() ?>>
<div<?php echo $category->parent_id->ViewAttributes() ?>><?php echo $category->parent_id->ViewValue ?></div></td>
		<!-- name -->
		<td<?php echo $category->name->CellAttributes() ?>>
<div<?php echo $category->name->ViewAttributes() ?>><?php echo $category->name->ViewValue ?></div></td>
		<!-- photo -->
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
		<!-- sort_order -->
		<td<?php echo $category->sort_order->CellAttributes() ?>>
<div<?php echo $category->sort_order->ViewAttributes() ?>><?php echo $category->sort_order->ViewValue ?></div></td>
		<!-- status -->
		<td<?php echo $category->status->CellAttributes() ?>>
<div<?php echo $category->status->ViewAttributes() ?>><?php echo $category->status->ViewValue ?></div></td>
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
