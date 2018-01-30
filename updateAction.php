<?php
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");

$view = new View(TEMPLATES_PATH."/");
$db = new DB();
$view->display('header.tpl');

$categories = $db->query("SELECT * FROM actioncategory");
$action = $db->query("SELECT * FROM workAction WHERE actionID = '$_GET[idInput]'");

if (isset($_POST['actionName']) && isset($_POST['path'])) {
  $success = $db->query("UPDATE workAction SET actionName = N'$_POST[actionName]', actionString=N'$_POST[path]', actionArguments=N'$_POST[args]', categoryID = $_POST[groupOption] WHERE actionID = '$_GET[idInput]';");
} else {
  $success = false;
}
if ($success) { 
  header("refresh:2;url=./groups.php"); 
}
?>

<div class="container">
    <form class="form-control mt-4" method="post">
    	<div class="form-row">
   	    	<div class="col-md-6 mb-3">
       	    	<input type="text" class="form-control mt-1" id="actionName" name="actionName" value="<?php echo $action['actionName'] ?>" placeholder="Название ресурса" required>
        	</div>
        	<div class="col-md-6 mb-3">
      			<input type="text" class="form-control mt-1" id="actionString" name="path" value="<?php echo $action['actionString'] ?>" placeholder="Путь к исполняемому файлу или гиперссылка" required>
      		</div>
      	</div>
      	<div class="form-row">
      		<div class="col-md-6 mb-3">
      			<input type="text" class="form-control mt-1" id="actionArguments" name="args" value="<?php echo $action['actionArguments'] ?>" placeholder="Строка с аргументами (опционально)">
      		</div>
      		<div class="col-md-6 mb-3 mt-1">
      			<select name="groupOption" class="custom-select" required>
      	 			<option value="">Выберите группу ресурсов</option>
      	 			<?php foreach($categories as $category) {
      	 				echo '<option value='.$category['categoryID'].'>'.$category['categoryName'].'</option>';
      	 			}?>
      			</select>
      		</div>
  		</div>
      <?php if($success) {
          echo '<div class="form-row"><div class="col-md-8">
            <div class="alert alert-success mb-2">
            Данные успешно обновлены! Вы будете автоматически возвращены на страницу <a href="./actions.php" class="alert-link">ресурсов</a>.</div></div><div class="col-md-4">';
          } ?>
      <div class=text-right>
        <button class="btn btn-primary mt-2 mb-2" type="submit">Сохранить</button>
      </div>
    </div>
  </form>
</div>

<?php $view->display('footer.tpl'); ?>