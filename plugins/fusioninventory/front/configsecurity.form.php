<?php

/**
 * FusionInventory
 *
 * Copyright (C) 2010-2023 by the FusionInventory Development Team.
 *
 * http://www.fusioninventory.org/
 * https://github.com/fusioninventory/fusioninventory-for-glpi
 * http://forge.fusioninventory.org/
 *
 * ------------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of FusionInventory project.
 *
 * FusionInventory is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * FusionInventory is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with FusionInventory. If not, see <http://www.gnu.org/licenses/>.
 *
 * ------------------------------------------------------------------------
 *
 * This file is used to manage the configuration security form.
 *
 * ------------------------------------------------------------------------
 *
 * @package   FusionInventory
 * @author    David Durieux
 * @copyright Copyright (c) 2010-2023 FusionInventory team
 * @license   AGPL License 3.0 or (at your option) any later version
 *            http://www.gnu.org/licenses/agpl-3.0-standalone.html
 * @link      http://www.fusioninventory.org/
 * @link      https://github.com/fusioninventory/fusioninventory-for-glpi
 *
 */

include ("../../../inc/includes.php");

Session::checkRight('plugin_fusioninventory_configsecurity', READ);

$pfConfigSecurity = new PluginFusioninventoryConfigSecurity();
$config = new PluginFusioninventoryConfig();

Html::header(__('FusionInventory', 'fusioninventory'), $_SERVER["PHP_SELF"], "admin",
         "pluginfusioninventorymenu", "configsecurity");

PluginFusioninventoryMenu::displayMenu("mini");


if (isset ($_POST["add"])) {
   Session::checkRight('plugin_fusioninventory_configsecurity', CREATE);
   $new_ID = 0;
   $new_ID = $pfConfigSecurity->add($_POST);
   Html::back();
} else if (isset ($_POST["update"])) {
   Session::checkRight('plugin_fusioninventory_configsecurity', UPDATE);
   $pfConfigSecurity->update($_POST);
   Html::back();
} else if (isset ($_POST["delete"])) {
   Session::checkRight('plugin_fusioninventory_configsecurity', PURGE);
   $pfConfigSecurity->delete($_POST);
   Html::redirect("configsecurity.php");
}

$id = "";
if (isset($_GET["id"])) {
   $id = $_GET["id"];
}

if (strstr($_SERVER['HTTP_REFERER'], "wizard.php")) {
   Html::redirect($_SERVER['HTTP_REFERER']."&id=".$id);
}

$pfConfigSecurity->showForm($id);

Html::footer();

