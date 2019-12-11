<?php

// Menu
define("EW_MENUBAR_VERTICAL_CLASSNAME", "MenuBarVertical", TRUE);
define("EW_MENUBAR_SUBMENU_CLASSNAME", "MenuBarItemSubmenu", TRUE);
define("EW_MENUBAR_RIGHTHOVER_IMAGE", "images/SpryMenuBarRightHover.gif", TRUE);
?>
<?php

/**
 * Menu class
 */

class cMenu {
	var $Id;
	var $IsRoot = FALSE;
	var $NoItem = NULL;
	var $ItemData = array();

	function cMenu($id) {
		$this->Id = $id;
	}

	// Add a menu item
	function AddMenuItem($id, $text, $url, $parentid) {
		$item = new cMenuItem($id, $text, $url, $parentid);
		if (!MenuItem_Adding($item)) return;
		if ($item->ParentId < 0) {
			$this->AddItem($item);
		} else {
			if ($oParentMenu =& $this->FindItem($item->ParentId))
				$oParentMenu->AddItem($item);
		}
	}

	// Add item to internal array
	function AddItem($item) {
		$this->ItemData[] = $item;
	}

	// Find item
	function &FindItem($id) {
		$cnt = count($this->ItemData);
		for ($i = 0; $i < $cnt; $i++) {
			$item =& $this->ItemData[$i];
			if ($item->Id == $id) {
				return $item;
			} elseif (!is_null($item->SubMenu)) {
				if ($subitem =& $item->SubMenu->FindItem($id))
					return $subitem;
			}
		}
		return $this->NoItem;
	}

	// Render the menu
	function Render() {
		echo "<ul";
		if ($this->Id <> "") {
			if (is_numeric($this->Id)) {
				echo " id=\"menu_" . $this->Id . "\"";
			} else {
				echo " id=\"" . $this->Id . "\"";
			}
		}
		if ($this->IsRoot)
			echo " class=\"" . EW_MENUBAR_VERTICAL_CLASSNAME . "\"";
		echo ">\n";
		foreach ($this->ItemData as $item) {
			echo "<li><a";
			if (!is_null($item->SubMenu))
				echo " class=\"" . EW_MENUBAR_SUBMENU_CLASSNAME . "\"";
			if ($item->Url <> "")
				echo " href=\"" . htmlspecialchars(strval($item->Url)) . "\"";
			echo ">" . $item->Text . "</a>\n";
			if (!is_null($item->SubMenu))
				$item->SubMenu->Render();
			echo "</li>\n";
		}
		echo "</ul>\n";
	}
}

// Menu item class
class cMenuItem {
	var $Id;
	var $Text;
	var $Url;
	var $ParentId; 
	var $SubMenu = NULL; // Data type = cMenu

	function cMenuItem($id, $text, $url, $parentid) {
		$this->Id = $id;
		$this->Text = $text;
		$this->Url = $url;
		$this->ParentId = $parentid;
	}

	function AddItem($item) { // Add submenu item
		if (is_null($this->SubMenu))
			$this->SubMenu = new cMenu($this->Id);
		$this->SubMenu->AddItem($item);
	}
}

// MenuItem Adding event
function MenuItem_Adding(&$Item) {

	//var_dump($Item);
	// Return FALSE if menu item not allowed

	return TRUE;
}
?>
<!-- Begin Main Menu -->
<div class="phpmaker">
<?php

// Generate all menu items
$RootMenu = new cMenu("RootMenu");
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(16, "<hr>", "", -1);
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(5, "&brvbar;&brvbar; Contact Us", "contact_uslist.php", -1);
}
$RootMenu->AddMenuItem(18, "<hr>", "", -1);
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(6, "&brvbar;&brvbar; Customer", "customerlist.php", -1);
}
$RootMenu->AddMenuItem(20, "<hr>", "", -1);
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(4, "&brvbar;&brvbar; Category", "categorylist.php?cmd=resetall", -1);
}
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(3, "&brvbar;&brvbar; &brvbar;&brvbar; Cat Product", "cat_productlist.php?cmd=resetall", -1);
}
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(2, "&brvbar;&brvbar; &brvbar;&brvbar; Product  Photo", "cat_p_photolist.php?cmd=resetall", -1);
}
$RootMenu->AddMenuItem(26, "", "", -1);
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(8, "&brvbar;&brvbar; Manufacture", "manufacturelist.php", -1);
}
$RootMenu->AddMenuItem(17, "<hr>", "", -1);
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(7, "&brvbar;&brvbar; Feature Product", "feature_productlist.php", -1);
}
$RootMenu->AddMenuItem(19, "<hr>", "", -1);
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(1, "&brvbar;&brvbar; Advertise", "advertiselist.php", -1);
}
$RootMenu->AddMenuItem(21, "<hr>", "", -1);
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(9, "&brvbar;&brvbar; News", "newslist.php", -1);
}
$RootMenu->AddMenuItem(22, "<hr>", "", -1);
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(12, "&brvbar;&brvbar; Slide", "slidelist.php", -1);
}
$RootMenu->AddMenuItem(14, "<hr>", "", -1);
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(27, "&brvbar;&brvbar; Country", "countrylist.php", -1);
}
$RootMenu->AddMenuItem(29, "<hr>", "", -1);
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(13, "&brvbar;&brvbar; Static Pages", "static_pageslist.php", -1);
}
$RootMenu->AddMenuItem(15, "<hr>", "", -1);
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(10, "&bull; Password", "passwordlist.php", -1);
}
$RootMenu->AddMenuItem(25, "<hr>", "", -1);
if (IsLoggedIn()) {
	$RootMenu->AddMenuItem(0xFFFFFFFF, "Logout", "logout.php", -1);
} elseif (substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php") {
	$RootMenu->AddMenuItem(0xFFFFFFFF, "Login", "login.php", -1);
}
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
<script type="text/javascript">
<!--
var RootMenu = new Spry.Widget.MenuBar("RootMenu", {imgRight: "<?php echo EW_MENUBAR_RIGHTHOVER_IMAGE ?>"}); // Main menu 

//-->
</script>
