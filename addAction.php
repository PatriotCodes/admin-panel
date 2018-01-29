<?php
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");

$view = new View(TEMPLATES_PATH."/");
$db = new DB();
$view->display('header.tpl');

$categories = $db->query("SELECT * FROM actioncategory");
?>

<div class="container">
    <form class="form-control mt-4">
    	<div class="form-row">
   	    	<div class="col-md-6 mb-3">
       	    	<input type="text" class="form-control mt-1" id="actionName" placeholder="Название ресурса" required>
        	</div>
        	<div class="col-md-6 mb-3">
      			<input type="text" class="form-control mt-1" id="actionString" placeholder="Путь к исполняемому файлу или гиперссылка" required>
      		</div>
      	</div>
      	<div class="form-row">
      		<div class="col-md-6 mb-3">
      			<input type="text" class="form-control mt-1" id="actionArguments" placeholder="Строка с аргументами (опционально)">
      		</div>
      		<div class="col-md-6 mb-3 mt-1">
      			<select class="custom-select" required>
      	 			<option value="">Выберите группу ресурсов</option>
      	 			<?php foreach($categories as $category) {
      	 				echo '<option value='.$category['categoryID'].'>'.$category['categoryName'].'</option>';
      	 			} ?>
      			</select>
      		</div>
  		</div>
      <div class=text-right>
        <button class="btn btn-primary mt-2 mb-2" type="submit">Добавить</button>
      </div>
  </form>
</div>

<?php $view->display('footer.tpl'); ?>