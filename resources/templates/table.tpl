<table class="table table-striped table-bordered table-condensed">
    <thead class="thead-dark">
	    <tr>
		<?php foreach($this->options as $name) {
    		echo '<th scope="col">'.$name.'</th>';
		}
		echo '<th scope="col"></th>';
		?>			
		</tr>
	</thead>
    <tbody>
        <?php
        	$db = new DB();
            $rows = $db->query("SELECT * FROM $this->tableName");
            foreach($rows as $row) {
              	$id = $this->tableColNames[0];
              	echo '<tr>';
              	foreach ($this->tableColNames as $name) {
              		echo '<td scope="row">'.$row[$name].'</td>';
                	}
                	echo '<td class="">
                  	<form action="'.$this->action.'" method="get">
                    	<input name="edit" id="'.$id.'" class="btn btn-info mb-1" value="Изменить" type="submit">
                    	<input type="hidden" value="'.$id.'" name="idInput"/>
                    	<button name="actioncategory" id="'.$id.'" class="btn btn-danger deleteRowButton mb-1" value="categoryID" type="button">Удалить</button>
                  	</form>
                	</td>';
                	echo '</tr>';
              	} ?>   
        </tbody>
</table>