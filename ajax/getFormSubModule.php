<?
include_once("../include/configObject.php");
include_once("../include/createConfig.php");

//TODO : don't regenerate the config, use the one witch is registred in the session variables
$config = new Configuration();

$module = $config->getModule($_POST['moduleName']);


//we have two type of requests : general for the mainModule configuration, and subModule for the config of the submodule or the instances
if($_POST['subModuleName'] == "general"){	//we need to generate the config of the mainModule


	//TODO : we consider that a module is loaded only once, it may be false, need to check that in the config file
	$instance = $module->getInstances()[0];

	$response = "salut il y a : ".count($module->getArguments())." arguments.<br>";    
	$response .= "<form class=\"instanceForm\" onsubmit=\"return false;\" method=\"post\">";

	foreach($module->getArguments() as $argument){
        
        $response .= $argument." : <input type=\"text\" name=\"".$argument."\" value=\"".$instance->getArgument($argument)."\"><br>";
	}
	$response .= "<input type=\"submit\" value=\"Save\">";
	$response .= "</form>";


}else{		//we need to generate the config of the submodule or it's instances

	$subModule = $module->getSubModule($_POST['subModuleName']);


	$response = "<select name=\"select".$_POST['subModuleName']."\" class=\"instanceSelector\" size=\"10\">";

	foreach($subModule->getInstances() as $instance){

		$response .= "<option>".$instance->getName()."</option>";
	}
	$response .= "<option>Add new</option>";
	$response .= "</select>";
}


echo $response;


?>
