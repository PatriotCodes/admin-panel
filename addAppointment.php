<?php
session_start();
require_once("./resources/config.php");
require_once(LIBRARY_PATH."/view.class.php");
require_once(LIBRARY_PATH."/db.class.php");

$view = new View(TEMPLATES_PATH."/");
$db = new DB();
$view->display('header.tpl');
$success = false;

$categories = $db->query("SELECT * FROM actioncategory");
$resOptions = array();

if(isset($_POST['userID'])) {
  $_SESSION['userID'] = $_POST['userID'];
  $tmpSelect = $db->query("SELECT username FROM worker WHERE workerID = '$_SESSION[userID]'");
  $username = $tmpSelect[0]['username'];
}

if (isset($_GET['idReq'])) {
  $tmpCat = $db->query("SELECT * FROM actioncategory WHERE categoryID = '$_GET[idReq]'");
  $setCat = $tmpCat[0];
  $idReq = $_GET['idReq'];
} else {
  $setCat = $categories[0];
  $idReq = $categories[0]['categoryID'];
}

if (isset($_POST['resourceOptions']) && isset($_POST['fromDate'])) {
  foreach ($_POST['resourceOptions'] as $actID) {
    $db->query("INSERT INTO appointment (workerID, actionID, fromDate, toDate) VALUES ('$_SESSION[userID]','$actID','$_POST[fromDate]','$_POST[toDate]');");
  }
}

$resources = $db->query("SELECT * from workaction WHERE categoryID = '$idReq'");
?>

<div class="container">
  <h4 class="mt-4">Добавление ресурса пользователю <strong><?php echo $username?></strong></h4>
    <form class="form-control mt-4" method="post">
    	<div class="form-row">
   	    	<div class="col-md-6">
       	    	<select name="groupOption" class="custom-select"  onchange="ChangeResOptions(this.value);" required>
                <?php 
                if (count($categories) > 0) {
                  echo '<option class="changeResOptions" value='.$setCat['categoryID'].'>'.$setCat['categoryName'].'</option>';
                foreach($categories as $category) {
                    if ($category != $setCat) {
                      echo '<option value='.$category['categoryID'].'>'.$category['categoryName'].'</option>';
                    }
                  }
                }?>
              </select>
        	</div>
          <label class="mt-2">От:</label>
        	<div class="col-md-5">
            <div class="form-group">
              <input type="date" class="form-control" name="fromDate" id="from">
            </div>
      		</div>
      	</div>
      	<div class="form-row">
      		<div class="col-md-6">
      			<select multiple name="resourceOptions[]" class="custom-select" id="resourceOptions" required>
              <?php foreach($resources as $resource) {
                echo '<option value='.$resource['actionID'].'>'.$resource['actionName'].'</option>';
              }?>
              </select>
      		</div>
          <label class="mt-2">До:</label>
      		<div class="col-md-5">
      			<div class="form-group">
              <input type="date" class="form-control" name="toDate" id="to">
            </div>
      		</div>
  		</div>
      <?php if($success) {
          echo '<div class="form-row"><div class="col-md-8">
            <div class="alert alert-success mb-2">
            Ресурсы были успешно добавлены пользователю!
          </div></div><div class="col-md-4">';
          } ?>
      <div class=text-right>
        <button class="btn btn-primary mb-2" type="submit">Добавить</button>
      </div>
    </form>
    </div>
</div>

<?php $view->display('footer.tpl'); ?>