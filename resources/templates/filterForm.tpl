<div class="container">
  <form class="form-control mt-4" method="get">
  		<div class="form-group row mb-0">
        <div class="form-group col-4">
      		<input type="text" class="form-control mt-2" name="search" placeholder="Поиск" <?php
            if (isset($_GET['search'])) {
              echo 'value = "'.$_GET['search'].'"';
            }
          ?>>
        </div>
        <label class="mt-3" for="inputPassword4">Сортировать по:</label>
        <div class="form-group col">
        <select name="groupOption" class="custom-select mt-2" required>
              <?php 
                for($index = 0; $index < count($this->options); $index++) {
                  echo '<option value='.$this->tableColNames[$index].' ';
                  if (isset($_GET['groupOption'])) {
                      if ($_GET['groupOption'] == $this->tableColNames[$index]) {
                        echo 'selected';
                      }
                  }
                  echo '>'.$this->options[$index].'</option>'; } ?>
        </select>
        </div>
        <label class="mt-3" for="inputPassword4">Упорядочить по:</label>
        <div class="form-group col">
          <select name="orderOption" class="custom-select mt-2" required>
              <option value="ASC" <?php if(isset($_GET['orderOption'])) {
                if ($_GET['orderOption'] == "ASC") { echo 'selected'; } }
                ?> >По возрастанию</option>
              <option value="DESC" <?php if (isset($_GET['orderOption'])) {
                if ($_GET['orderOption'] == "DESC") { echo 'selected'; } }
                ?> >По убыванию</option>
          </select>
        </div>
      </div>
      <div class="form-group row mb-0">
          <div class="form-group col-sm-12">
            <div class="text-right">
              <button class="btn btn-primary mb-0" type="submit">Применить</button>
            </div>
          </div>
      </div>
  </form>
</div>