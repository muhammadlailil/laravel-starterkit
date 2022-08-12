<div class="card-header">
    <div class="pull-right">
        <button class="btn btn-sm btn-primary" onclick="addMoreTable()" type="button">Tambah Baru</button>
    </div>
    <b>Tampilan Table</b>
</div>
<div class="table-responsive">
    <table class="table table-table">
        <thead>
            <tr>
                <td>Label</td>
                <td>Name</td>
                <td>Join (Opsional)</td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<div class="card-footer">
    <button type="button" class="btn btn-sm btn-grey mr-3" onclick="goToTab('#step1')">
        << Back 
    </button> 
    <button type="button" class="btn btn-primary btn-sm" onclick="toStep3()">
            Next >>
    </button>
</div>

@push('js')
<script>
    function addMoreTable() {
        $('#step2 .table-table tbody').append(`<tr>
        <th>
            <input type="text" class="form-control input-table input_label_form_table" name="table_label[]">
        </th>
        <th>
            <input type="text" class="form-control input-table input_name_form_table" name="table_name[]">
        </th>
        <th>
            <input type="text" class="form-control input-table input_name_form_table" name="table_join[]">
        </th>
        <th>
            <input type="text" class="form-control input-table" name="table_join_relation[]">
        </th>
        <th>
            <button class="btn btn-danger btn-sm btn-delete-table-form" type="button">Hapus</button>
        </th> 
    </tr>`)
    }

    function toStep2() {
        if ($('#module_table').val() && $('#module_name').val() && $('#module_path').val() && $(
                '#module_controller').val() && $('#module_icon').val()) {
            let tableValue = $('#module_table').val();
            if (tableValue !== lastSelectedTableValue) {
                loadTableColumns(tableValue).then((resp) => {
                    baseTableColumns = resp.data
                    var baseTable = '';
                    $.each(baseTableColumns, function (i, obj) {
                        if (!['id', 'created_at', 'updated_at'].includes(obj)) {
                            baseTable += `<tr>
                                <th>
                                    <input type="text" class="form-control input-table input_label_form_table" value="${ucworld(obj)}" name="table_label[]">
                                </th>
                                <th>
                                    <input type="text" class="form-control input-table input_name_form_table" value="${obj}" name="table_name[]">
                                </th>
                                <th>
                                    <input type="text" class="form-control input-table input_join_form_table" name="table_join[]">
                                </th>
                                <th>
                                    <input type="text" class="form-control input-table input_join_name_form_table" name="table_join_relation[]">
                                </th>
                                <th>
                                    <button class="btn btn-danger btn-sm btn-delete-table-form"  type="button">Hapus</button>
                                </th>
                            </tr>`
                        }
                    });
                    baseTable += `<tr>
                        <th>
                            <input type="text" class="form-control input-table input_label_form_table" name="table_label[]">
                        </th>
                        <th>
                            <input type="text" class="form-control input-table input_name_form_table" name="table_name[]">
                        </th>
                        <th>
                            <input type="text" class="form-control input-table input_join_form_table" name="table_join[]">
                        </th>
                        <th>
                            <input type="text" class="form-control input-table input_join_name_form_table" name="table_join_relation[]">
                        </th>
                        <th>
                            <button class="btn btn-danger btn-sm btn-delete-table-form"  type="button">Hapus</button>
                        </th>
                    </tr>`
                    $('#step2 .table-table tbody').html(baseTable)
                });

            }
            lastSelectedTableValue = $('#module_table').val();
            if(baseTableColumns){
                goToTab('#step2');
            }
        }
    }

</script>
@endpush
