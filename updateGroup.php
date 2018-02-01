<?php
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");

$view = new View(TEMPLATES_PATH."/");
$db = new DB();
$view->display('header.tpl');
$categoryName = $db->query("SELECT categoryName FROM actioncategory WHERE categoryID = '$_GET[idInput]'");

if (isset($_POST['categoryName'])) {
	$success = $db->query("UPDATE actionCategory SET categoryName = N'$_POST[categoryName]' WHERE categoryID = '$_GET[idInput]'");
} else {
	$success = false;
}
if ($success) { 
  header("refresh:2;url=./groups.php"); 
}
?>

<div class="container">
  <form class="form-control mt-4" method="post">
  		<div class="form-row mb-3">
      		<input type="text" class="form-control mt-2" name="categoryName" placeholder="Название" 
          value="<?php echo $categoryName[0]['categoryName'] ?>" required>
      	</div>
      		<?php if($success) {
      		echo '<div class="form-row"><div class="col-md-8">
      			<div class="alert alert-success mb-2">
  					Данные успешно обновлены! Вы будете автоматически возвращены на странницу <a href="./groups.php" class="alert-link">групп</a>.</div></div><div class="col-md-4">';
      		} ?>
      		    <div class=text-right>
        			<button class="btn btn-primary mt-2 mb-1" type="submit">Сохранить</button>
      			</div>
      		</div>
	    </div>
  </form>
</div>

<?php $view->display('footer.tpl'); ?>