@extends('admin.layouts.app')

@section('content')
      <div class="">
        <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Product List<small>list</small></h2>
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
                      <button class="btn btn-info float-right" onclick="window.location='{{ route("products") }}'">Add Product</button>
                    </div>
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                    <thead>
                      <tr class="headings">
                        <th>Publisher Name</th>
                        <th>Product Name</th>>
                        <th>ISBN</th>
                        <th>Series</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><a href='{{ route("products") }}' class="tabel_link">Tiger</a></td>
                        <td>Product 1</td>
                        <td>ASDS121</td>
                        <td>98234993</td>
                        <td>23</td>
                        <td>234234</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a>
                        </td>
                      </tr>
                      <tr>
                        <td><a href='{{ route("products") }}' class="tabel_link">Garrett</a></td>
                        <td>Product 2</td>
                        <td>ASDS1232</td>
                        <td>9823499323</td>
                        <td>43</td>
                        <td>23423</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a></td>
                        </tr>
                      <tr>
                        <td><a href='{{ route("products") }}' class="tabel_link">Ashton</a></td>
                        <td>Product 3</td>
                        <td>ASDS121232</td>
                        <td>9823493453</td>
                        <td>23</td>
                        <td>43232</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a></td>
                        </tr>
                      <tr>
                        <td><a href='{{ route("products") }}' class="tabel_link">Cedric</a></td>
                        <td>Product 4</td>
                        <td>ASDS1232</td>
                        <td>9823499334</td>
                        <td>45</td>
                        <td>2344</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a></td>
                        </tr>
                      <tr>
                        <td><a href='{{ route("products") }}' class="tabel_link">Airi</a></td>
                        <td>Product 5</td>
                        <td>ASDS121745</td>
                        <td>98234993342</td>
                        <td>56</td>
                        <td>123223</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a></td>
                        </tr>
                      <tr>
                        <td><a href='{{ route("products") }}' class="tabel_link">Brielle</a></td>
                        <td>Product 11</td>
                        <td>ASDS121878</td>
                        <td>9823499343</td>
                        <td>78</td>
                        <td>6543</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a></td>
                        </tr>
                      <tr>
                        <td><a href='{{ route("products") }}' class="tabel_link">Herrod</a></td>
                        <td>Product 12</td>
                        <td>ASDS121987</td>
                        <td>98234993342</td>
                        <td>45</td>
                        <td>65334</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a></td>
                        </tr>
                      <tr>
                        <td><a href='{{ route("products") }}' class="tabel_link">Rhona</a></td>
                        <td>Product 14</td>
                        <td>ASDS1219767</td>
                        <td>98234993343</td>
                        <td>34</td>
                        <td>23463</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a></td>
                        </tr>
                      <tr>
                        <td><a href='{{ route("products") }}' class="tabel_link">Colleen</a></td>
                        <td>Product 121</td>
                        <td>ASDS121768</td>
                        <td>98234993334</td>
                        <td>56</td>
                        <td>65334</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a></td>
                        </tr>
                      <tr>
                        <td><a href='{{ route("products") }}' class="tabel_link">Sonya</a></td>
                        <td>Product 23</td>
                        <td>ASDS12189</td>
                        <td>98234993334</td>
                        <td>23</td>
                        <td>12343</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a></td>
                        </tr>
                      <tr>
                        <td><a href='{{ route("products") }}' class="tabel_link">Sonya</a></td>
                        <td>Product 21</td>
                        <td>ASDS121987</td>
                        <td>9823499333</td>
                        <td>56</td>
                        <td>34632</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a></td>
                        </tr>
                      <tr>
                        <td><a href='{{ route("products") }}' class="tabel_link">Sonya</a></td>
                        <td>Product 32</td>
                        <td>ASDS1210986</td>
                        <td>98234993444</td>
                        <td>45</td>
                        <td>2435</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a></td>
                        </tr>
                      <tr>
                        <td><a href='{{ route("products") }}' class="tabel_link">Sonya</a></td>
                        <td>Product 43</td>
                        <td>ASDS121754</td>
                        <td>98234993342</td>
                        <td>34</td>
                        <td>45232</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a></td>
                        </tr>
                      <tr>
                        <td><a href='{{ route("products") }}' class="tabel_link">Sonya</a></td>
                        <td>Product 53</td>
                        <td>ASDS121987</td>
                        <td>9823499334</td>
                        <td>26</td>
                        <td>352355</td>
                        <td>
                          <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit </a>
                          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a></td>
                        </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection