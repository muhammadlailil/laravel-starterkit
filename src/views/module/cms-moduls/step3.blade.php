<div class="card-header">
    <div class="pull-right">
        <button class="btn btn-sm btn-primary" type="button" onclick="addMoreForm()">Tambah Baru</button>
    </div>
    <b>Tampilan Form</b>
</div>
<div class="table-responsive">
    <table class="table table-table">
        <thead>
            <tr>
                <td>Label</td>
                <td>Name</td>
                <td>Type</td>
                <td>Validation</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
           
        </tbody>
    </table>
</div>
<div class="card-footer">
    <button type="button" class="btn btn-sm btn-grey mr-3" onclick="goToTab('#step2')">
        << Back 
    </button>
    <button type="submit" class="btn btn-primary btn-sm">
            Simpan Modul
    </button>
</div>

@push('js')
<script>
    function toStep3() {
        let tableValue = $('#module_table').val();
        if (tableValue !== lastSelectedTableValuestep3) {
            var baseTable = '';
            $.each(baseTableColumns, function (i, obj) {
                if (!['id', 'created_at', 'updated_at'].includes(obj)) {
                    baseTable += `<tr>
                        <th>
                            <input type="text" class="form-control input-table input_label_form_table" value="${ucworld(obj)}" name="form_label[]">
                        </th>
                        <th>
                            <input type="text" class="form-control input-table input_name_form_table" value="${obj}" name="form_name[]">
                        </th>
                        <th>
                            <select id="" class="form-control input-table" name="form_type[]">
                                <option>text</option>
                                <option>file</option>
                                <option>foto</option>
                                <option>email</option>
                                <option>number</option>
                                <option>password</option>
                                <option>checkbox</option>
                                <option>date</option>
                                <option>datetime</option>
                                <option>googlemaps</option>
                                <option>hidden</option>
                                <option>money</option>
                                <option>radio</option>
                                <option>select</option>
                                <option>selectsearch</option>
                                <option>textarea</option>
                                <option>time</option>
                                <option>wysiwyg</option>
                            </select>
                        </th>
                        <th>
                            <input type="text" class="form-control input-table" value="required" name="form_validation[]">
                        </th>
                        <th>
                            <button class="btn btn-danger btn-sm" type="button">Hapus</button>
                        </th>
                    </tr>`
                }
            });
            baseTable += ` <tr>
                        <th>
                            <input type="text" class="form-control input-table input_label_form_table" name="form_label[]">
                        </th>
                        <th>
                            <input type="text" class="form-control input-table input_name_form_table" name="form_name[]">
                        </th>
                        <th>
                            <select id="" class="form-control input-table" name="form_type[]">
                                <option>text</option>
                                <option>file</option>
                                <option>foto</option>
                                <option>email</option>
                                <option>number</option>
                                <option>password</option>
                                <option>checkbox</option>
                                <option>date</option>
                                <option>datetime</option>
                                <option>googlemaps</option>
                                <option>hidden</option>
                                <option>money</option>
                                <option>radio</option>
                                <option>select</option>
                                <option>selectsearch</option>
                                <option>textarea</option>
                                <option>time</option>
                                <option>wysiwyg</option>
                            </select>
                        </th>
                        <th>
                            <input type="text" class="form-control input-table" value="required" name="form_validation[]">
                        </th>
                        <th>
                            <button class="btn btn-danger btn-sm"  type="button">Hapus</button>
                        </th>
                    </tr>`
            $('#step3 .table-table tbody').html(baseTable)
        }
        lastSelectedTableValuestep3 = tableValue;
        goToTab('#step3');
    }

    
    function addMoreForm() {
        $('#step3 .table-table tbody').append(` <tr>
                        <th>
                            <input type="text" class="form-control input-table input_label_form_table" name="form_label[]">
                        </th>
                        <th>
                            <input type="text" class="form-control input-table input_name_form_table" name="form_name[]">
                        </th>
                        <th>
                            <select id="" class="form-control input-table" name="form_type[]">
                                <option>text</option>
                                <option>file</option>
                                <option>foto</option>
                                <option>email</option>
                                <option>number</option>
                                <option>password</option>
                                <option>checkbox</option>
                                <option>date</option>
                                <option>datetime</option>
                                <option>googlemaps</option>
                                <option>hidden</option>
                                <option>money</option>
                                <option>radio</option>
                                <option>select</option>
                                <option>selectsearch</option>
                                <option>textarea</option>
                                <option>time</option>
                                <option>wysiwyg</option>
                            </select>
                        </th>
                        <th>
                            <input type="text" class="form-control input-table" value="required" name="form_validation[]">
                        </th>
                        <th>
                            <button class="btn btn-danger btn-sm"  type="button">Hapus</button>
                        </th>
                    </tr>`)
    }

</script>
@endpush
