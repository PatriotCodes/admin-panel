<?php if ($this->isDeletable == '') {
  $this->isDeletable = false;
}?>
<table class="table table-striped table-bordered table-condensed">
    <thead class="thead-dark">
	    <tr>
		<?php echo '<th scope="col">№</th>';
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
            $rows = $db->query("SELECT * FROM $this->tableName $this->likeClause $this->orderClause");
            $desc = false;
            $counter = 0;
            if (isset($_POST['groupOption'])) {
              if ($_POST['groupOption'] != '#') {
                $counter = 0;
              } else if ($_POST['orderOption'] == 'DESC') {
                $counter = count($rows) + 1;
                $desc = true;
              }
            }
            if ($rows) {
              foreach($rows as $row) {
                  if(!$desc) {
                    $counter++;
                  } else {
                    $counter--;
                  }
              	  $id = $row[$this->idName];
              	  echo '<tr>';
                  echo '<td scope="row">'.$counter.'</td>';
              	  foreach ($this->tableColNames as $name) {
              		    echo '<td scope="row">'.$row[$name].'</td>';
                	  }
                	  if ($this->actionPage !== '') {
                		  echo '<td class="">
                  		  <form action="'.$this->actionPage.'" method="get">
                    		  <input name="edit" id="'.$id.'" class="btn btn-info mb-1" value="'.$this->actionName.'" type="submit">
                    		  <input type="hidden" value="'.$id.'" name="idInput"/>';
                          if ($this->isDeletable) {
                    		  echo '<button name="'.$this->tableName.'" id="'.$id.'" class="btn btn-danger deleteRowButton mb-1" value="'.$this->idName.'" type="button">Удалить</button>';
                        }
                  		  echo '</form></td>';
                	    }
                	    echo '</tr>';
              	    }
                  } ?>   
        </tbody>
</table>