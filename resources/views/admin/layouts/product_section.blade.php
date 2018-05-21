
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
                  <div class="col-md-6 mb-5">
                  <a href="{{ url('admin/products/create')}}">
                    <button class="btn btn-primary btn-fill float-right">
                      <i class="fa fa-plus"></i>
                    </button>
                  </a>
                  </div>
                  </div>
                </div>
                  <!-- table -->
                  <table class="table table-bordered  mt-5" id="users-table">
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
