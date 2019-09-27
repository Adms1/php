@extends('layouts.app')

@section('content')
    <div class="col-md-6 m-b-10">
        @if ($test_package->IsCompetetive == 0) 
            <h3>{{$test_package->board->BoardName ." > ". $test_package->standard->StandardName ." > ". $test_package->subject->SubjectName}}</h3>
        @else
            <h3>{{$test_package->course->CourseName}}</h3>
        @endif
    </div>
    <div class="col-md-6 m-b-10">
        <a href="{{ route('testPackages.index') }}" class="btn btn-info m-t-20 f-right">@lang('admin.test_packages.title')</a>
    </div>
    <div class="col-md-12 panel panel-default p-0">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6">
                    <p>
                        {!! Form::label('TestPackageName', trans('admin.test_packages.fields.name').':', ['class' => 'control-label']) !!}
                        {!! $test_package->TestPackageName!!}
                    </p>
                    <p>
                        {!! Form::label('IsCompetetive ', trans('admin.test_packages.fields.type').':') !!}
                        {!! ($test_package->IsCompetetive == 0) ? trans('admin.ca_academic') : trans('admin.ca_competitive') !!}
                    </p>
                    <p>
                        {!! Form::label('QuestionFrom ', trans('admin.ca_que_from').':') !!}
                        {!! ($test_package->IsCompetetive == 1) ? trans('admin.ca_tc_bank') : trans('admin.ca_your_bank') !!}
                    </p>
                    <p>
                        {!! Form::label('IsAutoTestCreation ', trans('admin.ca_que_selection').':') !!}
                        {!! ($test_package->IsAutoTestCreation == 1) ? trans('admin.ca_auto') : trans('admin.ca_manual') !!}
                    </p>
                    <p>
                        {!! Form::label('IsActive', trans('admin.test_packages.fields.is-active').':', ['class' => 'control-label']) !!}
                        {{ ($test_package->StatusID == 9) ? 'Published' : 'UnPublished' }}
                    </p>
                </div>
                <div class="col-xs-6 ta-center">
                    @if ($test_package->Icon)
                    <img class="img-view" src="{{URL::asset('/'.$test_package->Icon)}}"/>
                    @endif
                </div>
            </div>
            @if (Auth::guard('admin')->check())
            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('TestPackageSalePriceTCD', trans('admin.test_packages.fields.sale-price-tcd').':', ['class' => 'control-label']) !!}
                    <i class="fa fa-inr fa-1"></i>{!! $test_package->TestPackageSalePriceTCD !!}
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('TestPackageListPriceTCD', trans('admin.test_packages.fields.list-price-tcd'), ['class' => 'control-label']) !!}
                    <i class="fa fa-inr fa-1"></i>{!! $test_package->TestPackageListPriceTCD !!}
                </div>
            </div>
            @endif
            <div class="row">
                @if ($test_package->IsCompetetive == 1) 
                    <div class="col-xs-4 form-group competitive">
                        {!! Form::label('CourseID', trans('admin.course_subjects.fields.course-name').':', ['class' => 'control-label']) !!}
                        {!! $test_package->course->CourseName !!}
                    </div>
                @else
                    <div class="col-xs-4 form-group academic">
                        {!! Form::label('BoardID', trans('admin.board_standard_subjects.fields.board-name').':', ['class' => 'control-label']) !!}
                        {!! $test_package->board->BoardName !!}
                    </div>
                    <div class="col-xs-4 form-group academic">
                        {!! Form::label('StandardID', trans('admin.board_standard_subjects.fields.standard-name').':', ['class' => 'control-label']) !!}
                        {!! $test_package->standard->StandardName !!}
                    </div>
                    <div class="col-xs-4 form-group academic">
                        {!! Form::label('SubjectID', trans('admin.board_standard_subjects.fields.subject-name').':', ['class' => 'control-label']) !!}
                        {!! $test_package->subject->SubjectName !!}
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('TestPackageSalePrice', trans('admin.test_packages.fields.sale-price').':', ['class' => 'control-label']) !!}
                    <i class="fa fa-inr fa-1"></i>{!! $test_package->TestPackageSalePrice !!}
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('TestPackageListPrice', trans('admin.test_packages.fields.list-price').':', ['class' => 'control-label']) !!}
                    <i class="fa fa-inr fa-1"></i>{!! $test_package->TestPackageListPrice !!}
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('NumberOfTest', trans('admin.test_packages.fields.number').':', ['class' => 'control-label']) !!}
                    {!! $test_package->NumberOfTest !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('TestPackageDescription', trans('admin.test_packages.fields.description').':', ['class' => 'control-label']) !!}
                    {!! $test_package->TestPackageDescription !!}
                </div>
            </div>
            @if (count($test_package->tests)> 0) 
            <div class="width-100 f-left m-t-5">
                <table id="tabel_tp_detail" class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action" cellspacing="0" width="100%">
                    <thead>
                        <tr class="thead-color">
                            <th class="width-5">{{trans('admin.ca_serial_number')}}</th>
                            <th class="width-25">{{trans('admin.tests.fields.name')}}</th>
                            <th class="width-10">{{trans('admin.tests.fields.marks')}}</th>
                            <th class="width-10">{{trans('admin.tests.fields.duration')}}</th>
                            <th class="width-10">{{trans('admin.tests.fields.question')}}</th>
                            <th class="width-15">{{trans('admin.tests.fields.difficulty-level')}}</th>
                            <th class="width-25">{{trans('admin.ca_action')}}</th>
                        </tr>
                    </thead>
                    <tbody class="tp_detail row_position" id="test-table">
                        @php
                            $a = 0;
                        @endphp
                        @foreach ($test_package->tests as $test)
                        <tr class="mul_div">
                            <td>
                                {{++$a}}
                            </td>
                            <td>
                                {{$test->TestName}}
                            </td>
                            <td>
                                {{$test->TestMarks}}
                            </td>
                            <td>
                                {{$test->TestDuration}}
                            </td>
                            <td>
                                {{$test->NumberofQuestion}}
                            </td>
                            <td>
                                {{$test->difficultyLevel->DLName}}
                            </td>
                            <td width="10%">
                                <div class="dropdown">
                                    <div class="more-action dropdown-toggle" data-toggle="dropdown"></div>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#" data-toggle="modal" data-testID="{{$test->TestPackageTestID}}" data-target="#viewTest">{{trans('admin.ca_print')}}</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            <!--delete test Modal -->
            <div class="modal fade" id="viewTest" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header thead-color">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="test_name"></h4>
                        </div>
                        <div class="modal-body table-scroll" id="question-view">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
<script type="text/javascript">

    $(document).ready(function() {
        /**** ajax setup ****/
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // ON delete assigned click set value in confirmation box
        $('#viewTest').on('show.bs.modal', function(e) {
            var testid = $(e.relatedTarget).data('testid');
            $("#ajax_loader").css("display", "block");
            //$(this).find('.delete-test').attr('onclick', 'deleteTest('+testid+','+packageid+')');
            $.ajax({
                url:"{{route('test_ajax_view')}}",
                type: "POST",
                data:{'TestPackageTestID':testid},
                success: function(data) {
                    $("#ajax_loader").css("display", "none");
                    $('#test_name').html(data.test_name);
                    $('#question-view').html(data.list);
                    //$('#testModel').modal('hide');
                }
            });
        });
    });
</script>
@stop
