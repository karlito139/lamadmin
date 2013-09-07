<?
//set the garbage coloctor timeout for our session
ini_set('session.gc_maxlifetime', 3600*24*7);
session_start();

include_once("include/configObject.php");
include_once("include/createConfig.php");


$config = new Configuration();

?>

<html>
    <head>

    </head>
    <link rel="stylesheet" href="include/jquery-ui.css">
    <link rel="stylesheet" href="include/style.css">
    <script type="text/javascript" src="include/jquery-2.0.3.min.js"></script>
    <script src="include/jquery-ui.js"></script>
    <body>
        <div id="sideBar">
            Users : <br>
            <?  //list the users on the system
                $module = $config->getModule("user");
                foreach($module->getInstances() as $instance){

                    echo "<div class=\"user\">".$instance->getName()."</div><br>";
                }
            ?>
            <br><br>
            System : <br>
            <?
                foreach($config->getAvalableModules() as $module){
                    if(!preg_match("/".$module->getName()."/", "user")){
                        foreach($module->getInstances() as $instance){
                            echo "<div class=\"mainModule\">".$instance->getName()."</div><br>";
                        }
                    }
                }
                
            ?>
        </div>
    
        <div id="mainPannel">
            <ul id="tabs">
                <li><a href="#welkome">Welkome</a></li>
            </ul>
            <div id="forms">
        
                <div id="welkome">
                        <p>
                            Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.
                    </p>
                </div>
            </div>
        </div>    
    </body>
    
    <script type="text/javascript">


        var activeModule = "";
        var activeSubModule = "";
        
        //this function is called at te opening of the page
        $(function() {
            $("#mainPannel").tabs({
                
                beforeActivate: function(event, ui){
                    
                    tabName = ui.newTab.attr('id').substr(1);
                    activeSubModule = tabName;
                    
                    var data = {
                        moduleName: activeModule,
                        subModuleName: tabName,
                    }
                
                    request = $.ajax({
                        url: "/ajax/getFormSubModule.php",
                        type: "POST",
                        data: data
                    });
                    
                    request.done(function(response, textStatus, jqXHR){
                    
                        //alert(response);
                        $("#forms #"+tabName).remove();
                        $("#forms").append("<div id=\""+tabName+"\">"+response+"</div>");
                    });
                    
                    request.fail(function(jqXHR, textStatus, errorThrown){
                    
                        alert("error when getting the list of the submodule");
                    });
                    
                    request.always(function(){});
                }
            
            });
        });
        
        
        
    </script>

</html>