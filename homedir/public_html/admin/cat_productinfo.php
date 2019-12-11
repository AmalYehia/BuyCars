<?php

// PHPMaker 6 configuration for Table cat_product
$cat_product = NULL; // Initialize table object

// Define table class
class ccat_product {

	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $id;
	var $cat_id;
	var $manufacture_id;
	var $type;
	var $name;
	var $photo;
	var $year;
	var $model;
	var $price;
	var $location;
	var $serial_no;
	var $condition;
	var $stock_no;
	var $horse_power;
	var $hour;
	var $drive;
	var $general_info;
	var $description;
	var $date_update;
	var $sort_order;
	var $status;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var	$ExportAll = EW_EXPORT_ALL;
	var $SendEmail; // Send Email
	var $TableCustomInnerHtml; // Custom Inner Html

	function ccat_product() {
		$this->TableVar = "cat_product";
		$this->TableName = "cat_product";
		$this->SelectLimit = TRUE;
		$this->id = new cField('cat_product', 'x_id', 'id', "`id`", 19, -1, FALSE);
		$this->fields['id'] =& $this->id;
		$this->cat_id = new cField('cat_product', 'x_cat_id', 'cat_id', "`cat_id`", 3, -1, FALSE);
		$this->fields['cat_id'] =& $this->cat_id;
		$this->manufacture_id = new cField('cat_product', 'x_manufacture_id', 'manufacture_id', "`manufacture_id`", 3, -1, FALSE);
		$this->fields['manufacture_id'] =& $this->manufacture_id;
		$this->type = new cField('cat_product', 'x_type', 'type', "`type`", 16, -1, FALSE);
		$this->fields['type'] =& $this->type;
		$this->name = new cField('cat_product', 'x_name', 'name', "`name`", 200, -1, FALSE);
		$this->fields['name'] =& $this->name;
		$this->photo = new cField('cat_product', 'x_photo', 'photo', "`photo`", 200, -1, TRUE);
		$this->fields['photo'] =& $this->photo;
		$this->year = new cField('cat_product', 'x_year', 'year', "`year`", 200, -1, FALSE);
		$this->fields['year'] =& $this->year;
		$this->model = new cField('cat_product', 'x_model', 'model', "`model`", 200, -1, FALSE);
		$this->fields['model'] =& $this->model;
		$this->price = new cField('cat_product', 'x_price', 'price', "`price`", 200, -1, FALSE);
		$this->fields['price'] =& $this->price;
		$this->location = new cField('cat_product', 'x_location', 'location', "`location`", 200, -1, FALSE);
		$this->fields['location'] =& $this->location;
		$this->serial_no = new cField('cat_product', 'x_serial_no', 'serial_no', "`serial_no`", 200, -1, FALSE);
		$this->fields['serial_no'] =& $this->serial_no;
		$this->condition = new cField('cat_product', 'x_condition', 'condition', "`condition`", 16, -1, FALSE);
		$this->fields['condition'] =& $this->condition;
		$this->stock_no = new cField('cat_product', 'x_stock_no', 'stock_no', "`stock_no`", 200, -1, FALSE);
		$this->fields['stock_no'] =& $this->stock_no;
		$this->horse_power = new cField('cat_product', 'x_horse_power', 'horse_power', "`horse_power`", 200, -1, FALSE);
		$this->fields['horse_power'] =& $this->horse_power;
		$this->hour = new cField('cat_product', 'x_hour', 'hour', "`hour`", 200, -1, FALSE);
		$this->fields['hour'] =& $this->hour;
		$this->drive = new cField('cat_product', 'x_drive', 'drive', "`drive`", 200, -1, FALSE);
		$this->fields['drive'] =& $this->drive;
		$this->general_info = new cField('cat_product', 'x_general_info', 'general_info', "`general_info`", 201, -1, FALSE);
		$this->fields['general_info'] =& $this->general_info;
		$this->description = new cField('cat_product', 'x_description', 'description', "`description`", 201, -1, FALSE);
		$this->fields['description'] =& $this->description;
		$this->date_update = new cField('cat_product', 'x_date_update', 'date_update', "`date_update`", 133, 5, FALSE);
		$this->fields['date_update'] =& $this->date_update;
		$this->sort_order = new cField('cat_product', 'x_sort_order', 'sort_order', "`sort_order`", 3, -1, FALSE);
		$this->fields['sort_order'] =& $this->sort_order;
		$this->status = new cField('cat_product', 'x_status', 'status', "`status`", 3, -1, FALSE);
		$this->fields['status'] =& $this->status;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search Highlight Name
	function HighlightName() {
		return "cat_product_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search Keyword
	function getBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic Search Type
	function getBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search where clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE Clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session Key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Current master table name
	function getCurrentMasterTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE];
	}

	function setCurrentMasterTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE] = $v;
	}

	// Session master where clause
	function getMasterFilter() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_FILTER];
	}

	function setMasterFilter($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_FILTER] = $v;
	}

	// Session detail where clause
	function getDetailFilter() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_FILTER];
	}

	function setDetailFilter($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_FILTER] = $v;
	}

	// Master filter
	function SqlMasterFilter_category() {
		return "`id`=@id@";
	}

	// Detail filter
	function SqlDetailFilter_category() {
		return "`cat_id`=@cat_id@";
	}

	// Table level SQL
	function SqlSelect() { // Select
		return "SELECT * FROM `cat_product`";
	}

	function SqlWhere() { // Where
		return "";
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	// SQL variables
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Return table sql with list page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		if ($this->CurrentFilter <> "") {
			if ($sFilter <> "") $sFilter = "($sFilter) AND ";
			$sFilter .= "(" . $this->CurrentFilter . ")";
		}
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Return record count
	function SelectRecordCount() {
		global $conn;
		$cnt = -1;
		$sFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		if ($this->SelectLimit) {
			$sSelect = $this->SelectSQL();
			if (strtoupper(substr($sSelect, 0, 13)) == "SELECT * FROM") {
				$sSelect = "SELECT COUNT(*) FROM" . substr($sSelect, 13);
				if ($rs = $conn->Execute($sSelect)) {
					if (!$rs->EOF)
						$cnt = $rs->fields[0];
					$rs->Close();
				}
			}
		}
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $sFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= (is_null($value) ? "NULL" : ew_QuotedValue($value, $this->fields[$name]->FldDataType)) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `cat_product` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE `cat_product` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=" .
					(is_null($value) ? "NULL" : ew_QuotedValue($value, $this->fields[$name]->FldDataType)) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `cat_product` WHERE ";
		$SQL .= EW_DB_QUOTE_START . 'id' . EW_DB_QUOTE_END . '=' .	ew_QuotedValue($rs['id'], $this->id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter for table
	function SqlKeyFilter() {
		return "`id` = @id@";
	}

	// Return Key filter for table
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id@", ew_AdjustSql($this->id->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return url
	function getReturnUrl() {

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] <> "") {
			return $_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL];
		} else {
			return "cat_productlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// View url
	function ViewUrl() {
		return $this->KeyUrl("cat_productview.php", $this->UrlParm());
	}

	// Add url
	function AddUrl() {
		$AddUrl = "cat_productadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit url
	function EditUrl() {
		return $this->KeyUrl("cat_productedit.php", $this->UrlParm());
	}

	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("cat_productadd.php", $this->UrlParm());
	}

	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("cat_productdelete.php", $this->UrlParm());
	}

	// Key url
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id->CurrentValue)) {
			$sUrl .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:alert('Invalid Record! Key is null');";
		}
		return $sUrl;
	}

	// Sort Url
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			($fld->FldType == 205)) { // Unsortable data type
			return "";
		} else {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		}
	}

	// URL parm
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=cat_product" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Function LoadRs
	// - Load rows based on filter
	function LoadRs($sFilter) {
		global $conn;

		// Set up filter (Sql Where Clause) and get Return Sql
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		return $conn->Execute($sSql);
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->id->setDbValue($rs->fields('id'));
		$this->cat_id->setDbValue($rs->fields('cat_id'));
		$this->manufacture_id->setDbValue($rs->fields('manufacture_id'));
		$this->type->setDbValue($rs->fields('type'));
		$this->name->setDbValue($rs->fields('name'));
		$this->photo->Upload->DbValue = $rs->fields('photo');
		$this->year->setDbValue($rs->fields('year'));
		$this->model->setDbValue($rs->fields('model'));
		$this->price->setDbValue($rs->fields('price'));
		$this->location->setDbValue($rs->fields('location'));
		$this->serial_no->setDbValue($rs->fields('serial_no'));
		$this->condition->setDbValue($rs->fields('condition'));
		$this->stock_no->setDbValue($rs->fields('stock_no'));
		$this->horse_power->setDbValue($rs->fields('horse_power'));
		$this->hour->setDbValue($rs->fields('hour'));
		$this->drive->setDbValue($rs->fields('drive'));
		$this->general_info->setDbValue($rs->fields('general_info'));
		$this->description->setDbValue($rs->fields('description'));
		$this->date_update->setDbValue($rs->fields('date_update'));
		$this->sort_order->setDbValue($rs->fields('sort_order'));
		$this->status->setDbValue($rs->fields('status'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->CssStyle = "";
		$this->id->CssClass = "";
		$this->id->ViewCustomAttributes = "";

		// cat_id
		if (strval($this->cat_id->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `name` FROM `category` WHERE `id` = " . ew_AdjustSql($this->cat_id->CurrentValue) . "";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->cat_id->ViewValue = $rswrk->fields('name');
				$rswrk->Close();
			} else {
				$this->cat_id->ViewValue = $this->cat_id->CurrentValue;
			}
		} else {
			$this->cat_id->ViewValue = NULL;
		}
		$this->cat_id->CssStyle = "";
		$this->cat_id->CssClass = "";
		$this->cat_id->ViewCustomAttributes = "";

		// manufacture_id
		if (strval($this->manufacture_id->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `name` FROM `manufacture` WHERE `id` = " . ew_AdjustSql($this->manufacture_id->CurrentValue) . "";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->manufacture_id->ViewValue = $rswrk->fields('name');
				$rswrk->Close();
			} else {
				$this->manufacture_id->ViewValue = $this->manufacture_id->CurrentValue;
			}
		} else {
			$this->manufacture_id->ViewValue = NULL;
		}
		$this->manufacture_id->CssStyle = "";
		$this->manufacture_id->CssClass = "";
		$this->manufacture_id->ViewCustomAttributes = "";

		// type
		if (strval($this->type->CurrentValue) <> "") {
			switch ($this->type->CurrentValue) {
				case "1":
					$this->type->ViewValue = "Machine";
					break;
				case "2":
					$this->type->ViewValue = "parts";
					break;
				default:
					$this->type->ViewValue = $this->type->CurrentValue;
			}
		} else {
			$this->type->ViewValue = NULL;
		}
		$this->type->CssStyle = "";
		$this->type->CssClass = "";
		$this->type->ViewCustomAttributes = "";

		// name
		$this->name->ViewValue = $this->name->CurrentValue;
		$this->name->CssStyle = "";
		$this->name->CssClass = "";
		$this->name->ViewCustomAttributes = "";

		// photo
		if (!is_null($this->photo->Upload->DbValue)) {
			$this->photo->ViewValue = $this->photo->Upload->DbValue;
			$this->photo->ImageWidth = 120;
			$this->photo->ImageHeight = 0;
			$this->photo->ImageAlt = "";
		} else {
			$this->photo->ViewValue = "";
		}
		$this->photo->CssStyle = "";
		$this->photo->CssClass = "";
		$this->photo->ViewCustomAttributes = "";

		// year
		$this->year->ViewValue = $this->year->CurrentValue;
		$this->year->CssStyle = "";
		$this->year->CssClass = "";
		$this->year->ViewCustomAttributes = "";

		// model
		$this->model->ViewValue = $this->model->CurrentValue;
		$this->model->CssStyle = "";
		$this->model->CssClass = "";
		$this->model->ViewCustomAttributes = "";

		// price
		$this->price->ViewValue = $this->price->CurrentValue;
		$this->price->CssStyle = "";
		$this->price->CssClass = "";
		$this->price->ViewCustomAttributes = "";

		// location
		$this->location->ViewValue = $this->location->CurrentValue;
		$this->location->CssStyle = "";
		$this->location->CssClass = "";
		$this->location->ViewCustomAttributes = "";

		// serial_no
		$this->serial_no->ViewValue = $this->serial_no->CurrentValue;
		$this->serial_no->CssStyle = "";
		$this->serial_no->CssClass = "";
		$this->serial_no->ViewCustomAttributes = "";

		// condition
		if (strval($this->condition->CurrentValue) <> "") {
			switch ($this->condition->CurrentValue) {
				case "1":
					$this->condition->ViewValue = "Used";
					break;
				case "2":
					$this->condition->ViewValue = "Un Used";
					break;
				default:
					$this->condition->ViewValue = $this->condition->CurrentValue;
			}
		} else {
			$this->condition->ViewValue = NULL;
		}
		$this->condition->CssStyle = "";
		$this->condition->CssClass = "";
		$this->condition->ViewCustomAttributes = "";

		// stock_no
		$this->stock_no->ViewValue = $this->stock_no->CurrentValue;
		$this->stock_no->CssStyle = "";
		$this->stock_no->CssClass = "";
		$this->stock_no->ViewCustomAttributes = "";

		// horse_power
		$this->horse_power->ViewValue = $this->horse_power->CurrentValue;
		$this->horse_power->CssStyle = "";
		$this->horse_power->CssClass = "";
		$this->horse_power->ViewCustomAttributes = "";

		// hour
		$this->hour->ViewValue = $this->hour->CurrentValue;
		$this->hour->CssStyle = "";
		$this->hour->CssClass = "";
		$this->hour->ViewCustomAttributes = "";

		// drive
		$this->drive->ViewValue = $this->drive->CurrentValue;
		$this->drive->CssStyle = "";
		$this->drive->CssClass = "";
		$this->drive->ViewCustomAttributes = "";

		// date_update
		$this->date_update->ViewValue = $this->date_update->CurrentValue;
		$this->date_update->ViewValue = ew_FormatDateTime($this->date_update->ViewValue, 5);
		$this->date_update->CssStyle = "";
		$this->date_update->CssClass = "";
		$this->date_update->ViewCustomAttributes = "";

		// sort_order
		$this->sort_order->ViewValue = $this->sort_order->CurrentValue;
		$this->sort_order->CssStyle = "";
		$this->sort_order->CssClass = "";
		$this->sort_order->ViewCustomAttributes = "";

		// status
		if (strval($this->status->CurrentValue) <> "") {
			switch ($this->status->CurrentValue) {
				case "1":
					$this->status->ViewValue = "Active";
					break;
				case "2":
					$this->status->ViewValue = "Not Active";
					break;
				default:
					$this->status->ViewValue = $this->status->CurrentValue;
			}
		} else {
			$this->status->ViewValue = NULL;
		}
		$this->status->CssStyle = "";
		$this->status->CssClass = "";
		$this->status->ViewCustomAttributes = "";

		// id
		$this->id->HrefValue = "";

		// cat_id
		$this->cat_id->HrefValue = "";

		// manufacture_id
		$this->manufacture_id->HrefValue = "";

		// type
		$this->type->HrefValue = "";

		// name
		$this->name->HrefValue = "";

		// photo
		$this->photo->HrefValue = "";

		// year
		$this->year->HrefValue = "";

		// model
		$this->model->HrefValue = "";

		// price
		$this->price->HrefValue = "";

		// location
		$this->location->HrefValue = "";

		// serial_no
		$this->serial_no->HrefValue = "";

		// condition
		$this->condition->HrefValue = "";

		// stock_no
		$this->stock_no->HrefValue = "";

		// horse_power
		$this->horse_power->HrefValue = "";

		// hour
		$this->hour->HrefValue = "";

		// drive
		$this->drive->HrefValue = "";

		// date_update
		$this->date_update->HrefValue = "";

		// sort_order
		$this->sort_order->HrefValue = "";

		// status
		$this->status->HrefValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $CurrentAction; // Current action
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message
	var $RowType; // Row Type
	var $CssClass; // Css class
	var $CssStyle; // Css style
	var $RowClientEvents; // Row client events

	// Row Attribute
	function RowAttributes() {
		$sAtt = "";
		if (trim($this->CssStyle) <> "") {
			$sAtt .= " style=\"" . trim($this->CssStyle) . "\"";
		}
		if (trim($this->CssClass) <> "") {
			$sAtt .= " class=\"" . trim($this->CssClass) . "\"";
		}
		if ($this->Export == "") {
			if (trim($this->RowClientEvents) <> "") {
				$sAtt .= " " . trim($this->RowClientEvents);
			}
		}
		return $sAtt;
	}

	// Field objects
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Row Inserting event
	function Row_Inserting(&$rs) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted(&$rs) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating(&$rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated(&$rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>
