<?php if ($this->isDeletable == '') {
  $this->isDeletable = false;
}?>
<table class="table table-striped table-bordered table-condensed">
    <thead class="thead-dark">
	    <tr>
		<?php
      foreach($this->options as $name) {
    		echo '<th scope="col">'.$name.'</th>';
		} 
		if ($this->actionPage !== '') {
			echo '<th scope="col"></th>';
		}
		?>			
		</tr>
	</thead>
    <tbody>
        <?php
        	$db = new DB();
            if ($this->rows) {
              foreach($this->rows as $row) {
              	  $id = $row[$this->idName];
              	  echo '<tr ';
                  if ($this->focusID != '') {
                    if ($this->focusID == $row['actionID']) { 
                      echo 'class="bg-warning" id="focus"';
                    } 
                  }
                  // for appointment table only
                  if ($this->tableName == 'appointment') {
                    if ($row['toDate'] != '') {
                      $dbDate = $row['toDate'];
                      if ((strtotime($dbDate) < time())) {
                        echo 'class="table-danger"';
                      }
                    }
                  }
                  echo '>';
              	  foreach ($this->tableColNames as $name) {
                    if ($row[$name] != '') {
              		      echo '<td scope="row">'.$row[$name].'</td>';
                      } else {
                        echo '<td scope="row"></td>';
                      }
                	  }
                	  if ($this->actionPage !== '') {
                		  echo '<td class="">';
                        if ($this->tableName == 'appointment') {
                          echo '<form action="./actions.php" method="get">
                          <input name="edit" id="'.$row['actionID'].'" class="btn btn-info mb-1" value="Просмотреть ресурс" type="submit">
                          <input type="hidden" value="'.$row['actionID'].'" name="idAppointment"/>
                          </form>';
                        }
                  		  echo '<form action="'.$this->actionPage.'" method="get"><input name="edit" id="'.$id.'" class="btn btn-info mb-1" value="'.$this->actionName.'" type="submit"/>';
                          if ($this->hiddenVars != '') {
                            foreach($this->hiddenVars as $h => $hVal) {
                              echo '<input type="hidden" value="'.$row[$hVal].'" name="'.$h.'"/>';
                            }
                          }
                          // for appointment table only
                          if ($this->tableName == 'appointment') {
                            echo '<input type="hidden" name="destinationID" value="';
                            echo $_GET['idInput'];
                            echo '"/>';
                          }
                    		  echo '<input type="hidden" value="'.$id.'" name="idInput"/>';
                          if ($this->isDeletable) {
                            $check = false;
                            if ($this->alertMes != '') {
                              $check = $this->alertMes;
                            }
                            if ($check) {
                              echo '<button name="'.$this->tableName.'" id="'.$id.'" class="btn btn-danger deleteRowButtonCheck mb-1 ml-1"  value="'.$this->idName.'" type="button">Удалить</button>';
                              } else {
                    		      echo '<button name="'.$this->tableName.'" id="'.$id.'" class="btn btn-danger deleteRowButton mb-1 ml-1"  value="'.$this->idName.'" type="button">Удалить</button>';
                              }
                          } 
                  		    echo '</form></td>';
                	     }
                	     echo '</tr>';
              	     }
                    } ?>   
        </tbody>
</table>