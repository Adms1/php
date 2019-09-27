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

<!-- <script>
    $(document).ready(function() {

        // DataTable
        delete $.ajaxSettings.headers["X-CSRF-TOKEN"];
        $('#casino-table').DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            ajax: {
                'headers': {
                    'X-Requested-With':'*', 
                    'Content-Type' : '*',
                    'X-Token-Auth' : '*',
                    'Authorization' : '*'
                },
                'type': 'POST',
                'url': "{{ route('datatable_question_data') }}",
                // 'data': {
                //    formName: 'afscpMcn',
                //    action: 'search',
                //    // etc..
                // },
            },
            columns: [
                { name: 'QuestionID' },
                { name: 'QuestionText' },
                { name: 'Marks' },
            ],
            "rowCallback": function (nRow, aData, iDisplayIndex) {
                 var oSettings = this.fnSettings ();
                 $("td:first", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
                 return nRow;
            },
        });
    });
</script> -->