<?php
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");

$view = new View(TEMPLATES_PATH."/");
$db = new DB();
$view->display('header.tpl');

$categories = $db->query("SELECT * FROM actioncategory");

if (isset($_POST['actionName']) && isset($_POST['path']) && isset($_POST['args'])) {
  $success = $db->query("INSERT INTO workaction (actionName, actionString, actionArguments, categoryID
) VALUES (N'$_POST[actionName]',N'$_POST[path]',N'$_POST[args]','$_POST[groupOption]');");
} else {
  $success = false;
}
?>

<div class="container">
    <form class="form-control mt-4" method="post">
    	<div class="form-row">
   	    	<div class="col-md-6 mb-3">
       	    	<input type="text" class="form-control mt-1" id="actionName" name="actionName" placeholder="�������� �������" required>
        	</div>
        	<div class="col-md-6 mb-3">
      			<input type="text" class="form-control mt-1" id="actionString" name="path" placeholder="���� � �������������� ����� ��� �����������" required>
      		</div>
      	</div>
      	<div class="form-row">
      		<div class="col-md-6 mb-3">
      			<input type="text" class="form-control mt-1" id="actionArguments" name="args" placeholder="������ � ����������� (�����������)">
      		</div>
      		<div class="col-md-6 mb-3 mt-1">
      			<select name="groupOption" class="custom-select" required>
      	 			<option value="">�������� ������ ��������</option>
              <?php foreach($categories as $category) {
                echo '<option value='.$category['categoryID'].'>'.$category['categoryName'].'</option>';
              }?>
      			</select>
      		</div>
  		</div>
      <?php if($success) {
          echo '<div class="form-row"><div class="col-md-8">
            <div class="alert alert-success mb-2">
            ������ ��� ������� ��������!
          </div></div><div class="col-md-4">';
          } ?>
      <div class=text-right>
        <button class="btn btn-primary mt-2 mb-2" type="submit">��������</button>
      </div>
    </form>
    </div>
</div>

<?php $view->display('footer.tpl'); ?>