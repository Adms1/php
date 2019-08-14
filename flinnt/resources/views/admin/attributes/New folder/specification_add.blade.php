@extends('admin.layouts.app')

@section('content')
      <div class="">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Add Specification Attribute</h2>
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
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">X</button> 
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                {!! Form::open(['route'=>'spe_store', 'class' =>'form-horizontal form-label-left', 'data-parsley-validate', 'id'=>'product-form']) !!}
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attribute_type">Specification Type 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('attribute_value', 'Brand', ['class'=>'form-control col-md-7 col-xs-12', 'placeholder'=>'Enter Value', 'required'=>'required']) !!}
                        <span class="text-danger">{{ $errors->first('attribute_value') }}</span>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <button type="submit" class="btn btn-success">Edit</button>
                    </div>
                  </div>
                {!! Form::close() !!}
                <button type="button" style="float: right;" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                  <thead class="row_position">
                    <tr>
                      <th style="width: 50%">Name</th>
                      <th style="width: 20%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Apple</td>
                      <td>
                        <a class="btn btn-success btn-xs add" style="display: none;"><i class="fa fa-save"></i> Add </a>
                        <a class="btn btn-info btn-xs edit"><i class="fa fa-check"></i> Edit </a>
                        <a class="btn btn-danger btn-xs delete"><i class="fa fa-close"></i> Delete </a>
                      </td>
                    </tr>
                    <tr>
                      <td>Dell</td>
                      <td>
                        <a class="btn btn-success btn-xs add" style="display: none;"><i class="fa fa-save"></i> Add </a>
                        <a class="btn btn-info btn-xs edit"><i class="fa fa-check"></i> Edit </a>
                        <a class="btn btn-danger btn-xs delete"><i class="fa fa-close"></i> Delete </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>

@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
      var actions = $("table td:last-child").html();
      // Append table with add row form on add new button click
      $(".add-new").click(function(){
      $(this).attr("disabled", "disabled");
        var index = $("table tbody tr:last-child").index();
        var row = '<tr>' +
              '<td><input type="text" class="form-control" name="name" id="name"></td>' +
              '<td>' + actions + '</td>' +
          '</tr>';
        $("table").append(row);   
        $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
      });
    // Add row on add button click
    $(document).on("click", ".add", function(){
      var empty = false;
      var input = $(this).parents("tr").find('input[type="text"],input[type="number"]');
          input.each(function(){
            if(!$(this).val()){
              $(this).addClass("parsley-error");
              empty = true;
            } else{
              $(this).removeClass("parsley-error");
            }
          });
          $(this).parents("tr").find(".parsley-error").first().focus();
          if(!empty){
            input.each(function(){
              $(this).parent("td").html($(this).val());
            });     
            $(this).parents("tr").find(".add, .edit").toggle();
            $(".add-new").removeAttr("disabled");
          }   
    });

    // Edit row on edit button click
    $(document).on("click", ".edit", function(){    
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
          $(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
        });   
        $(this).parents("tr").find(".add, .edit").toggle();
        $(".add-new").attr("disabled", "disabled");
    });
    
    // Delete row on delete button click
    $(document).on("click", ".delete", function(){
        $(this).parents("tr").remove();
        $(".add-new").removeAttr("disabled");
    });
  });
</script>
@endsection