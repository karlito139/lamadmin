<?
/*
Copyright (c) 2013 Clement Roblot


This file is part of puppadmin.

puppadmin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

puppadmin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Generateur de photo d'identite. If not, see <http://www.gnu.org/licenses/>.
*/

include_once("../include/configObject.php");
include_once("../include/createConfig.php");

//TODO : don't regenerate the config, use the one witch is registred in the session variables
$config = new Configuration();


$module = $config->getModule($_POST['moduleName']);
$subModule = $module->getSubModule($_POST['subModuleName']);

foreach($subModule->getInstances() as $instance){

	$response .= $instance->getName().",";
}

$response = substr($response, 0, -1);

echo $response;

?>