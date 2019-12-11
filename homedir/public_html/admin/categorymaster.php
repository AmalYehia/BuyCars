<?php

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

// sort_order
$category->sort_order->CellCssStyle = "";
$category->sort_order->CellCssClass = "";

// status
$category->status->CellCssStyle = "";
$category->status->CellCssClass = "";
?>
<p><span class="phpmaker">Master Record: Category<br>
<a href="<?php echo $gsMasterReturnUrl ?>">Back to master page</a></span></p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
	<thead>
		<tr>
			<td class="ewTableHeader">Id</td>
			<td class="ewTableHeader">Parent Id</td>
			<td class="ewTableHeader">Name</td>
			<td class="ewTableHeader">Photo</td>
			<td class="ewTableHeader">Sort Order</td>
			<td class="ewTableHeader">Status</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td<?php echo $category->id->CellAttributes() ?>>
<div<?php echo $category->id->ViewAttributes() ?>><?php echo $category->id->ListViewValue() ?></div></td>
			<td<?php echo $category->parent_id->CellAttributes() ?>>
<div<?php echo $category->parent_id->ViewAttributes() ?>><?php echo $category->parent_id->ListViewValue() ?></div></td>
			<td<?php echo $category->name->CellAttributes() ?>>
<div<?php echo $category->name->ViewAttributes() ?>><?php echo $category->name->ListViewValue() ?></div></td>
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
			<td<?php echo $category->sort_order->CellAttributes() ?>>
<div<?php echo $category->sort_order->ViewAttributes() ?>><?php echo $category->sort_order->ListViewValue() ?></div></td>
			<td<?php echo $category->status->CellAttributes() ?>>
<div<?php echo $category->status->ViewAttributes() ?>><?php echo $category->status->ListViewValue() ?></div></td>
		</tr>
	</tbody>
</table>
</div>
</td></tr></table>
<br>
