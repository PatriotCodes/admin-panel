<div class="container">
  <form class="form-control mt-4" method="post">
  		<div class="form-group row mb-0">
        <div class="form-group col-4">
      		<input type="text" class="form-control mt-2" name="search" placeholder="Поиск">
        </div>
        <label class="mt-3" for="inputPassword4">Сортировать по:</label>
        <div class="form-group col">
        <select name="groupOption" class="custom-select mt-2" required>
              <?php foreach($this->options as $option) {
                echo '<option value='.$option.'>'.$option.'</option>';
              }?>
        </select>
        </div>
        <label class="mt-3" for="inputPassword4">Упорядочить по:</label>
        <div class="form-group col">
          <select name="orderOption" class="custom-select mt-2" required>
              <option value="ASC">По возрастанию</option>
              <option value="DESC">По убыванию</option>
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