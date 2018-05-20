
      <!-- content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-6">
                  <h4 class="card-title">
                    <i class="nc-icon nc-layers-3"></i> Product List
                  </h4>
                  </div>
                  <div class="col-md-6">
                  <a href="{{ url('admin/products/create')}}">
                    <button class="btn btn-primary btn-fill float-right">
                      <i class="fa fa-plus"></i>
                    </button>
                  </a>
                  </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                      <form action="#">
                        <div class="row">
                          <div class="col-md-4 pr-1">
                            <div class="form-group">
                              <label>Product Name</label>
                              <input type="text" class="form-control" placeholder="product name" name="productName">
                            </div>
                          </div>
                          <div class="col-md-4 pr-1">
                            <div class="form-group">
                              <label>Price</label>
                              <input type="text" class="form-control" placeholder="price" name="price">
                            </div>
                          </div>
                          <div class="col-md-4 pl-1">
                            <div class="form-group">
                              <label>Quantity</label>
                              <input type="text" class="form-control" placeholder="quantity" name="quantity">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4 pr-1">
                            <div class="form-group">
                              <label>Status</label>
                              <select class="form-control" id="status">
                                <option value="select status"></option>
                                <option>available</option>
                                <option>not available</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4"></div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <button type="submit" class="btn btn-primary btn-fill float-right">
                                <i class="nc-icon nc-zoom-split"></i> Filter</button>
                            </div>
                          </div>
                        </div>

                      </form>
                    </div>
                  </div>

                  <!-- table -->
                  <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>base price</th>
                <th>sale price</th>
                <th>category</th>
                <th>brand</th>
                <th>availability</th>
                <th>quantity</th>
                <th>Photo</th>
                <th>Action</th>
              </tr>
        </thead>
    </table>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
