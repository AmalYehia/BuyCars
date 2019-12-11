<?php

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

// date_update
$cat_product->date_update->CellCssStyle = "";
$cat_product->date_update->CellCssClass = "";

// sort_order
$cat_product->sort_order->CellCssStyle = "";
$cat_product->sort_order->CellCssClass = "";

// status
$cat_product->status->CellCssStyle = "";
$cat_product->status->CellCssClass = "";
?>
<p><span class="phpmaker">Master Record: Cat Product<br>
<a href="<?php echo $gsMasterReturnUrl ?>">Back to master page</a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader">Id</td>
			<td class="ewTableHeader">Cat Id</td>
			<td class="ewTableHeader">Manufacture Id</td>
			<td class="ewTableHeader">Type</td>
			<td class="ewTableHeader">Name</td>
			<td class="ewTableHeader">Photo</td>
			<td class="ewTableHeader">Year</td>
			<td class="ewTableHeader">Model</td>
			<td class="ewTableHeader">Price</td>
			<td class="ewTableHeader">Location</td>
			<td class="ewTableHeader">Serial No</td>
			<td class="ewTableHeader">Condition</td>
			<td class="ewTableHeader">Stock No</td>
			<td class="ewTableHeader">Horse Power</td>
			<td class="ewTableHeader">Hour</td>
			<td class="ewTableHeader">Drive</td>
			<td class="ewTableHeader">Date Update</td>
			<td class="ewTableHeader">Sort Order</td>
			<td class="ewTableHeader">Status</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $cat_product->id->CellAttributes() ?>>
<div<?php echo $cat_product->id->ViewAttributes() ?>><?php echo $cat_product->id->ListViewValue() ?></div></td>
			<td<?php echo $cat_product->cat_id->CellAttributes() ?>>
<div<?php echo $cat_product->cat_id->ViewAttributes() ?>><?php echo $cat_product->cat_id->ListViewValue() ?></div></td>
			<td<?php echo $cat_product->manufacture_id->CellAttributes() ?>>
<div<?php echo $cat_product->manufacture_id->ViewAttributes() ?>><?php echo $cat_product->manufacture_id->ListViewValue() ?></div></td>
			<td<?php echo $cat_product->type->CellAttributes() ?>>
<div<?php echo $cat_product->type->ViewAttributes() ?>><?php echo $cat_product->type->ListViewValue() ?></div></td>
			<td<?php echo $cat_product->name->CellAttributes() ?>>
<div<?php echo $cat_product->name->ViewAttributes() ?>><?php echo $cat_product->name->ListViewValue() ?></div></td>
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
			<td<?php echo $cat_product->year->CellAttributes() ?>>
<div<?php echo $cat_product->year->ViewAttributes() ?>><?php echo $cat_product->year->ListViewValue() ?></div></td>
			<td<?php echo $cat_product->model->CellAttributes() ?>>
<div<?php echo $cat_product->model->ViewAttributes() ?>><?php echo $cat_product->model->ListViewValue() ?></div></td>
			<td<?php echo $cat_product->price->CellAttributes() ?>>
<div<?php echo $cat_product->price->ViewAttributes() ?>><?php echo $cat_product->price->ListViewValue() ?></div></td>
			<td<?php echo $cat_product->location->CellAttributes() ?>>
<div<?php echo $cat_product->location->ViewAttributes() ?>><?php echo $cat_product->location->ListViewValue() ?></div></td>
			<td<?php echo $cat_product->serial_no->CellAttributes() ?>>
<div<?php echo $cat_product->serial_no->ViewAttributes() ?>><?php echo $cat_product->serial_no->ListViewValue() ?></div></td>
			<td<?php echo $cat_product->condition->CellAttributes() ?>>
<div<?php echo $cat_product->condition->ViewAttributes() ?>><?php echo $cat_product->condition->ListViewValue() ?></div></td>
			<td<?php echo $cat_product->stock_no->CellAttributes() ?>>
<div<?php echo $cat_product->stock_no->ViewAttributes() ?>><?php echo $cat_product->stock_no->ListViewValue() ?></div></td>
			<td<?php echo $cat_product->horse_power->CellAttributes() ?>>
<div<?php echo $cat_product->horse_power->ViewAttributes() ?>><?php echo $cat_product->horse_power->ListViewValue() ?></div></td>
			<td<?php echo $cat_product->hour->CellAttributes() ?>>
<div<?php echo $cat_product->hour->ViewAttributes() ?>><?php echo $cat_product->hour->ListViewValue() ?></div></td>
			<td<?php echo $cat_product->drive->CellAttributes() ?>>
<div<?php echo $cat_product->drive->ViewAttributes() ?>><?php echo $cat_product->drive->ListViewValue() ?></div></td>
			<td<?php echo $cat_product->date_update->CellAttributes() ?>>
<div<?php echo $cat_product->date_update->ViewAttributes() ?>><?php echo $cat_product->date_update->ListViewValue() ?></div></td>
			<td<?php echo $cat_product->sort_order->CellAttributes() ?>>
<div<?php echo $cat_product->sort_order->ViewAttributes() ?>><?php echo $cat_product->sort_order->ListViewValue() ?></div></td>
			<td<?php echo $cat_product->status->CellAttributes() ?>>
<div<?php echo $cat_product->status->ViewAttributes() ?>><?php echo $cat_product->status->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
