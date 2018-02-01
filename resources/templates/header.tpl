<?php
header('Content-Type: text/html; charset=windows-1251'); 
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
  <title>Админ панель</title>
  <meta charset="utf-8">
  <link href="css/global.css" rel="stylesheet" type="text/css">
  <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
</head>
<body>
	<nav class="navbar navbar-dark">
	    <div class="container">
	    	  <a class="navbar-brand" href="<?php echo $config["paths"]["root"];?>/index.php">Админ-панель АСУ-меню</a>
    		<ul class="nav navbar-nav">
          <li class="nav-item <?php isActive($config["paths"]["root"]."/users.php")?>">
              <a class="nav-link" href="<?php echo $config["paths"]["root"];?>/users.php">Пользователи</a>
            </li>
    			<li class="nav-item <?php isActive($config["paths"]["root"]."/actions.php")?>">
        			<a class="nav-link" href="<?php echo $config["paths"]["root"];?>/actions.php">Ресурсы</a>
      			</li>
      			<li class="nav-item <?php isActive($config["paths"]["root"]."/groups.php")?>">
       				<a class="nav-link" href="<?php echo $config["paths"]["root"];?>/groups.php">Группы</a>
      			</li>
      		</ul>
      	</div>
    </nav>

