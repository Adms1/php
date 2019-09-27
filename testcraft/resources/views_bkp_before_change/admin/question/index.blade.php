@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('admin.questions.title')</h3>
    <div class="col-md-12 m-b-10">
        <a href="{{ route('questions.create') }}" class="btn btn-success f-right">@lang('admin.ca_add_new')</a>
    </div>

    <div class="col-md-12 panel panel-default p-0">
        <div class="panel-heading">
            @lang('admin.ca_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($questions) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr class="thead-color">
                        <!-- <th>@lang('admin.questions.fields.title')</th> -->
                        <th>@lang('admin.questions.fields.type')</th>
                        <th>@lang('admin.questions.fields.difficulty-level')</th>
                        <th>@lang('admin.ca_status')</th>
                        <th class="no-sort">@lang('admin.ca_action')</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($questions) > 0)
                        @foreach ($questions as $question)
                            <tr data-entry-id="{{ $question->QuestionID }}">
                                <!-- <td field-key='QuestionText'>{!! $question->QuestionText !!}</td> -->
                                <td field-key='QuestionTypeName'>
                                    {!! $question->questionType->QuestionTypeName !!}</td>
                                <td field-key='DLName'>
                                    {!! $question->difficultyLevel->DLName !!}</td>
                                <td field-key='IsActive'>
                                    <span class="badge btn-{{ ($question->IsActive == 1) ? 'success' : 'danger'}}">
                                        {{ ($question->IsActive == 1) ? 'Active' : 'In-Active'}}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('questions.edit',[$question->QuestionID]) }}" class="btn btn-sm btn-info">@lang('admin.ca_edit')</a>
                                    <a data-toggle="modal" data-qID="{{$question->QuestionID}}" data-target="#viewQuestion" href="#" class="btn btn-sm btn-info">@lang('admin.ca_view')</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('admin.ca_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!--view question Modal -->
    <div class="modal fade" id="viewQuestion" role="dialog">
        <div class="modal-dialog">
            
            <div class="modal-content">
                <div class="modal-header thead-color">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="que_header"></h4>
                </div>
                <div class="modal-body">
                    <b>Question</b>
                    <p id="que_name"></p>
                    <b>Hint</b>
                    <p id="que_hint"></p>
                    <b>Explaination</b>
                    <p id="que_explaination"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // show question detail
        $('#viewQuestion').on('show.bs.modal', function(e) {
            var qid = $(e.relatedTarget).data('qid');
            //var tqid = $(e.relatedTarget).data('tqid');
            // $(this).find('.yes-delete-question').attr('onclick', 'deleteQuestion('+testid+','+tqid+')');

            $("#ajax_loader").css("display", "block");
            $.ajax({
                url:"{{route('question_ajaxget')}}",
                type: "POST",
                data:{'QuestionID':qid},
                success: function(data) {
                    $("#ajax_loader").css("display", "none");
                    //console.log(data);
                    if (data.success) {
                        // console.log(data.question.question_type);
                        // console.log(data.question.questionType.QuestionTypeName);
                        // console.log(data.question.hint.HintText);
                        $('#que_header').html(data.question.question_type.QuestionTypeName);
                        $('#que_name').html(data.question.QuestionText);
                        if (typeof(data.question.hint) != "undefined" && data.question.hint !== null) {
                            $('#que_hint').html(data.question.hint.HintText);
                        }
                        if (typeof(data.question.explaination) != "undefined" && data.question.explaination !== null) {
                            $('#que_explaination').html(data.question.explaination.ExplainationText);
                        }
                    }
                    //$('#testModel').modal('hide');
                }
            });
        });
    });
</script>
@stop