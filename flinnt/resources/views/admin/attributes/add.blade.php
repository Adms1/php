@extends('admin.layouts.app')

@section('css')
  <!-- iCheck -->
  <link href="{{asset('vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
@endsection

@section('content')
      <div class="">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Add Attribute</h2>
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

                @if ($message = Session::get('response.message'))
                    <div class="alert alert-{{ session('response.status') }} alert-block">
                        <button type="button" class="close" data-dismiss="alert">X</button> 
                            <strong>{{ $message }}</strong>
                    </div>
                @endif

                {!! Form::open(['route'=>'attribute_store', 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'attribute-form']) !!}
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attribute_name">Attribute Name</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('attribute_name', old('attribute_name'), ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter attribute name', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('attribute_name') }}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product_type">Product Type</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      {!! Form::radio('product_type','book', true, ['class' => 'flat']) !!}
                      <label class="form-label" >&nbsp; Book &nbsp;</label>
                      <!-- <label class="form-label">&nbsp; Other &nbsp;</label>
                      {!! Form::radio('product_type','other', null) !!} -->
                    </div>
                  </div> 
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <button class="btn btn-primary" type="button" onclick="window.location='{{route("attribute_list")}}'">Cancel</button>
                      <button class="btn btn-primary reset" type="reset">Reset</button>
                      <button type="submit" class="btn btn-success submit">Submit</button>
                    </div>
                  </div>
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection

@section('script')

    <!-- Parsley -->
    <script src="{{asset('vendors/parsleyjs/dist/parsley.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('vendors/iCheck/icheck.min.js')}}"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        /**** On reset button click clear values ****/
        $("button[type='reset']").on("click", function(event){
          $('input[name="attribute_name"]').attr('value', '');
          $('#attribute-form').parsley().reset();
          $('.text-danger').hide();
        });
      });
    </script>

@endsection