<?php 
session_start();
include "./resources/config.php";
require_once(LIBRARY_PATH."/db.class.php");

function isActive($href) {
  if ("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" == $href) {
    echo "active";
  }
}

?>
<!DOCTYPE html> 
<html lang="en-US">
<head>
  <title>админ-панель</title>
  <meta charset="utf-8">
  <link href="css/global.css" rel="stylesheet" type="text/css">
</head>
<body>
	<nav class="navbar navbar-dark">
	    <div class="container">
	    	  <a class="navbar-brand" href="<?php echo $config["paths"]["root"];?>/index.php">Админ-панель АСУ-меню</a>
    		<ul class="nav navbar-nav">
    			<li class="nav-item <?php isActive($config["paths"]["root"]."/actions.php")?>">
        			<a class="nav-link" href="<?php echo $config["paths"]["root"];?>/actions.php">Ресурсы</a>
      			</li>
      			<li class="nav-item <?php isActive($config["paths"]["root"]."/groups.php")?>">
       				<a class="nav-link" href="<?php echo $config["paths"]["root"];?>/groups.php">Группы</a>
      			</li>
      		</ul>
      	</div>
    </nav>

