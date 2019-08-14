@extends('admin.layouts.app')

@section('content')
      <div class="">
        <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Vendor List<small>list</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                    <div class="col-md-6 col-sm-6 col-xs-12"></div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button class="btn btn-info float-right" onclick="window.location='{{ route("vendors") }}'">Add Vendor</button>
                    </div>
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                    <thead>
                      <tr class="headings">
                        <th>Vendor name</th>
                        <th>Phone Number</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Registration Date</th>
                        <th>GST Number</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><a href='{{ route("vendors") }}' class="tabel_link">Tiger</a></td>
                        <td>9087687988</td>
                        <td>Ahmedabad</td>
                        <td>Gujarat</td>
                        <td>2018/08/28</td>
                        <td>320800</td>
                        <td>Active</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Approve </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Reject </a></td>
                        </tr>
                      </tr>
                      <tr>
                        <td><a href='{{ route("vendors") }}' class="tabel_link">Garrett</a></td>
                        <td>9087687988</td>
                        <td>Ahmedabad</td>
                        <td>Gujarat</td>
                        <td>2018/08/28</td>
                        <td>170750</td>
                        <td>Active</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Approve </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Reject </a></td>
                        </tr>
                      </tr>
                      <tr>
                        <td><a href='{{ route("vendors") }}' class="tabel_link">Ashton</a></td>
                        <td>9087687988</td>
                        <td>Ahmedabad</td>
                        <td>Gujarat</td>
                        <td>2018/08/28</td>
                        <td>86000</td>
                        <td>Pending</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Approve </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Reject </a></td>
                        </tr>
                      </tr>
                      <tr>
                        <td><a href='{{ route("vendors") }}' class="tabel_link">Cedric</a></td>
                        <td>9087687988</td>
                        <td>Ahmedabad</td>
                        <td>Gujarat</td>
                        <td>2018/08/28</td>
                        <td>433060</td>
                        <td>Pending</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Approve </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Reject </a></td>
                        </tr>
                      </tr>
                      <tr>
                        <td><a href='{{ route("vendors") }}' class="tabel_link">Airi</a></td>
                        <td>9087687988</td>
                        <td>Ahmedabad</td>
                        <td>Gujarat</td>
                        <td>2018/08/28</td>
                        <td>162700</td>
                        <td>Reject</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Approve </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Reject </a></td>
                        </tr>
                      </tr>
                      <tr>
                        <td><a href='{{ route("vendors") }}' class="tabel_link">Brielle</a></td>
                        <td>9087687988</td>
                        <td>Ahmedabad</td>
                        <td>Gujarat</td>
                        <td>2018/08/28</td>
                        <td>372000</td>
                        <td>Reject</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Approve </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Reject </a></td>
                        </tr>
                      </tr>
                      <tr>
                        <td><a href='{{ route("vendors") }}' class="tabel_link">Herrod</a></td>
                        <td>9087687988</td>
                        <td>Ahmedabad</td>
                        <td>Gujarat</td>
                        <td>2018/08/28</td>
                        <td>137500</td>
                        <td>Active</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Approve </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Reject </a></td>
                        </tr>
                      </tr>
                      <tr>
                        <td><a href='{{ route("vendors") }}' class="tabel_link">Rhona</a></td>
                        <td>9087687988</td>
                        <td>Ahmedabad</td>
                        <td>Gujarat</td>
                        <td>2018/08/28</td>
                        <td>327900</td>
                        <td>Active</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Approve </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Reject </a></td>
                        </tr>
                      </tr>
                      <tr>
                        <td><a href='{{ route("vendors") }}' class="tabel_link">Colleen</a></td>
                        <td>9087687988</td>
                        <td>Ahmedabad</td>
                        <td>Gujarat</td>
                        <td>2018/08/28</td>
                        <td>205500</td>
                        <td>Active</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Approve </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Reject </a></td>
                        </tr>
                      </tr>
                      <tr>
                        <td><a href='{{ route("vendors") }}' class="tabel_link">Sonya</a></td>
                        <td>9087687988</td>
                        <td>Ahmedabad</td>
                        <td>Gujarat</td>
                        <td>2018/08/28</td>
                        <td>103600</td>
                        <td>Active</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Approve </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Reject </a></td>
                        </tr>
                      </tr>
                      <tr>
                        <td><a href='{{ route("vendors") }}' class="tabel_link">Sonya</a></td>
                        <td>9087687988</td>
                        <td>Ahmedabad</td>
                        <td>Gujarat</td>
                        <td>2018/08/28</td>
                        <td>103600</td>
                        <td>Active</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Approve </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Reject </a></td>
                        </tr>
                      </tr>
                      <tr>
                        <td><a href='{{ route("vendors") }}' class="tabel_link">Sonya</a></td>
                        <td>9087687988</td>
                        <td>Ahmedabad</td>
                        <td>Gujarat</td>
                        <td>2018/08/28</td>
                        <td>103600</td>
                        <td>Active</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Approve </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Reject </a></td>
                        </tr>
                      </tr>
                      <tr>
                        <td><a href='{{ route("vendors") }}' class="tabel_link">Sonya</a></td>
                        <td>9087687988</td>
                        <td>Ahmedabad</td>
                        <td>Gujarat</td>
                        <td>2018/08/28</td>
                        <td>103600</td>
                        <td>Active</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Approve </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Reject </a></td>
                        </tr>
                      </tr>
                      <tr>
                        <td><a href='{{ route("vendors") }}' class="tabel_link">Sonya</a></td>
                        <td>9087687988</td>
                        <td>Ahmedabad</td>
                        <td>Gujarat</td>
                        <td>2018/08/28</td>
                        <td>103600</td>
                        <td>Active</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Approve </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Reject </a></td>
                        </tr>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection