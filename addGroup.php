<?php
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");

$view = new View(TEMPLATES_PATH."/");
$view->display('header.tpl');

?>

<div class="container">
  <form class="form-control mt-4">
      <input type="text" class="form-control mt-1" id="validationDefault01" placeholder="Название группы" required>
      <div class=text-right>
        <button class="btn btn-primary mt-2 mb-2" type="submit">Добавить</button>
      </div>
  </form>
</div>

<?php $view->display('footer.tpl'); ?>