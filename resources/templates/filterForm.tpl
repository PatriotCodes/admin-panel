<div class="container">
  <form class="form-control mt-4" method="post">
  		<div class="form-group row mb-0">
        <div class="form-group col-4">
      		<input type="text" class="form-control mt-2" name="search" placeholder="�����">
        </div>
        <label class="mt-3" for="inputPassword4">����������� ��:</label>
        <div class="form-group col">
        <select name="groupOption" class="custom-select mt-2" required>
              <?php foreach($this->options as $option) {
                echo '<option value='.$option.'>'.$option.'</option>';
              }?>
        </select>
        </div>
        <label class="mt-3" for="inputPassword4">����������� ��:</label>
        <div class="form-group col">
          <select name="orderOption" class="custom-select mt-2" required>
              <option value="ASC">�� �����������</option>
              <option value="DESC">�� ��������</option>
          </select>
        </div>
      </div>
      <div class="form-group row mb-0">
          <div class="form-group col-sm-12">
            <div class="text-right">
              <button class="btn btn-primary mb-0" type="submit">���������</button>
            </div>
          </div>
      </div>
  </form>
</div>