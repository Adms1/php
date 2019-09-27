{!! Form::hidden('TestSectionQuestionTypeID', $data['TestSectionQuestionTypeID'], ['class' => 'form-control']) !!}
{!! Form::hidden('TestPackageTestID', $data['TestPackageTestID'], ['class' => 'form-control']) !!}
<table id="casino-table" class="table table-striped table-bordered dt-responsive display" style="width:100%">
    <thead>
        <tr role="row" class="table-bg">
            <th class="no-sort">@lang('admin.ca_serial_number')</th>
            <th class="no-sort"></th>
            <th>@lang('admin.questions.fields.name')</th>
            <th>@lang('admin.questions.fields.mark')</th>
            <th class="no-sort">@lang('admin.ca_action')</th>
        </tr>
    </thead>
</table>