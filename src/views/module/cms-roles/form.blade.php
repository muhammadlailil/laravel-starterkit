<x-starterkit-admin-layout :title="$page_title">
    <div class="container">
        <div class="page-inner">
            <a href="{{route('admin.cms-roles.index')}}" class="ic-back-to-list">
                <i class="ms-Icon ms-Icon--SkypeCircleArrow"></i>
                Kembali ke List
            </a>
            <div class="card full-height">
                <div class="card-header">
                    <b>Tambah</b>
                </div>
                <form action="{{route('admin.cms-roles.save')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="card-body">
                        <div class="col-sm-6 p-0">
                            <x-starterkit::input.text name="name" label="Name">{{$data->name}}</x-starterkit::input.text>
                            <x-starterkit::input.select name="is_superadmin" label="Superadmin" class="sumo_select">
                                <option value="0">No</option>
                                <option {{($data->is_superadmin)?'selected':''}} value="1">Yes</option>
                            </x-starterkit::input.select>
                        </div>
                        <br>
                        <div id="privileges_configuration">
                            <label for="name" class="label-form">Akses Modul</label>
                            <table class="table table-table mt-2">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Menu</th>
                                        <th></th>
                                        <th class="text-center">View</th>
                                        <th class="text-center">Create</th>
                                        <th class="text-center">Update</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                    <tr class="info">
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th class="text-center"><input title="Check all vertical" type="checkbox"
                                                id="is_visible"></th>
                                        <th class="text-center"><input title="Check all vertical" type="checkbox"
                                                id="is_create"></th>
                                        <th class="text-center"><input title="Check all vertical" type="checkbox"
                                                id="is_edit"></th>
                                        <th class="text-center"><input title="Check all vertical" type="checkbox"
                                                id="is_delete"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($moduls as $row)
                                    <tr>
                                        <td><b>{{ $loop->iteration }}</b></td>
                                        <td><b>{{$row->name}}</b></td>
                                        <td class="text-center">
                                            <input type="checkbox" title="Check All Horizontal"
                                                class="select_horizontal">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" class="is_visible"
                                                name="privileges[{{$row->id}}][view]" {{($row->can_view)?'checked':''}}
                                                value="1">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" class="is_create"
                                                name="privileges[{{$row->id}}][add]" {{($row->can_add)?'checked':''}}
                                                value="1">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" class="is_edit" name="privileges[{{$row->id}}][edit]"
                                                {{($row->can_edit)?'checked':''}} value="1">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" class="is_delete"
                                                name="privileges[{{$row->id}}][delete]"
                                                {{($row->can_delete)?'checked':''}} value="1">
                                        </td>
                                    </tr>
                                    @foreach($row->sub_menu as $sub)
                                    <tr>
                                        <td></td>
                                        <td>{{$sub->name}}</td>
                                        <td class="text-center">
                                            <input type="checkbox" title="Check All Horizontal"
                                                class="select_horizontal">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" class="is_visible"
                                                name="privileges[{{$sub->id}}][view]" {{($sub->can_view)?'checked':''}}
                                                value="1">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" class="is_create"
                                                name="privileges[{{$sub->id}}][add]" {{($sub->can_add)?'checked':''}}
                                                value="1">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" class="is_edit" name="privileges[{{$sub->id}}][edit]"
                                                {{($sub->can_edit)?'checked':''}} value="1">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" class="is_delete"
                                                name="privileges[{{$sub->id}}][delete]"
                                                {{($sub->can_delete)?'checked':''}} value="1">
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm btn-block">Submit</button>
                                <!-- <button type="submit" class="btn btn-browse-file btn-sm">Batal</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
    <style>
        table tr th {
            background-color: #dddddd8f;
        }

        table tr th,
        table tr td {
            height: 35px !important;
        }

    </style>
    <script>
        $(function () {
            var is_admin = '{{($data->is_superadmin)?1:0}}';
            is_admin = parseInt(is_admin);
            if (is_admin === 1) {
                $('#privileges_configuration').hide();
            }
            $('select#is_superadmin').on('change', function () {
                var n = $(this).val();
                if (n === '1') {
                    $('#privileges_configuration').hide();
                } else {
                    $('#privileges_configuration').show();
                }
            })

            $("#is_visible").click(function () {
                var is_ch = $(this).prop('checked');
                $(".is_visible").prop("checked", is_ch);
            })
            $("#is_create").click(function () {
                var is_ch = $(this).prop('checked');
                $(".is_create").prop("checked", is_ch);
            })
            $("#is_edit").click(function () {
                var is_ch = $(this).is(':checked');
                $(".is_edit").prop("checked", is_ch);
            })
            $("#is_delete").click(function () {
                var is_ch = $(this).is(':checked');
                $(".is_delete").prop("checked", is_ch);
            })
            $(".select_horizontal").click(function () {
                var p = $(this).parents('tr');
                var is_ch = $(this).is(':checked');
                p.find("input[type=checkbox]").prop("checked", is_ch);
            })
        })

    </script>
    @endpush
</x-starterkit-admin-layout>
