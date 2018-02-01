<?php if ($this->isDeletable == '') {
  $this->isDeletable = false;
}?>
<table class="table table-striped table-bordered table-condensed">
    <thead class="thead-dark">
	    <tr>
		<?php foreach($this->options as $name) {
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
            $rows = $db->query("SELECT * FROM $this->tableName");
            if ($rows) {
              foreach($rows as $row) {
              	  $id = $row[$this->tableColNames[0]];
              	  echo '<tr>';
              	  foreach ($this->tableColNames as $name) {
              		  echo '<td scope="row">'.$row[$name].'</td>';
                	  }
                	  if ($this->actionPage !== '') {
                		  echo '<td class="">
                  		  <form action="'.$this->actionPage.'" method="get">
                    		  <input name="edit" id="'.$id.'" class="btn btn-info mb-1" value="'.$this->actionName.'" type="submit">
                    		  <input type="hidden" value="'.$id.'" name="idInput"/>';
                          if ($this->isDeletable) {
                    		  echo '<button name="actioncategory" id="'.$id.'" class="btn btn-danger deleteRowButton mb-1" value="categoryID" type="button">Удалить</button>';
                        }
                  		  echo '</form></td>';
                	    }
                	    echo '</tr>';
              	    }
                  } ?>   
        </tbody>
</table>