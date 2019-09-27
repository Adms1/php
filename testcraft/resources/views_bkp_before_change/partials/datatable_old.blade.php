<table id="casino-table" class="table-bordered dt-responsive display" style="width:100%">
    <thead>
        <tr role="row" class="table-bg">
            <th>@lang('admin.questions.fields.id')</th>
            <th>@lang('admin.questions.fields.name')</th>
            <th>@lang('admin.questions.fields.mark')</th>
        </tr>
    </thead>
</table>

<!-- @push('scripts')
    <script>
        $(document).ready(function() {

            // DataTable
            var table = $('#casino-table').DataTable({
                serverSide: true,
                processing: true,
                responsive: true,
                ajax: "{{ route('datatable_question_data') }}",
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
    </script>
@endpush
 -->