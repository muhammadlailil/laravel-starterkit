<x-starterkit-admin-layout :title="$page_title">
    <div class="container">
        <div class="page-inner">
            <div class="card full-height">
                @include('starterkit::partials.table.header')
                <div class="card-body table-responsive pd-0">
                    <form action="{{route('admin.cms-roles.bulk-delete')}}" method="post" id="form_bulk_action">
                        @method('delete')
                        @csrf
                        <table class="table table-table">
                            @include('starterkit::partials.table.columns')
                            <tbody>
                                @foreach($data as $i => $row)
                                <tr>
                                    <th>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input checkboxTable"
                                                value="{{$row->id}}" name="id_selected[]" id="customCheck{{$i}}">
                                            <label class="custom-control-label" for="customCheck{{$i}}">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>{{$row->description}}</th>
                                    <th>{{($row->is_read)?'Yes':'No'}}</th>
                                    <th class="text-right action_table">
                                        <a href="{{route('admin.cms-notification.read',$row->id)}}"
                                            class="action btn btn-primary">
                                            Detail
                                        </a>
                                    </th>
                                </tr>
                                @endforeach
                                @if($data->total()==0)
                                <tr>
                                    <th class="text-center" colspan="5">Tidak ada data</th>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </form>
                </div>
                @include('starterkit::partials.table.paginate')
            </div>
        </div>
    </div>

    <form action="{{route('admin.cms-roles.delete',':id')}}" method="post" class="delete_form">
        @method('delete')
        @csrf
    </form>
</x-starterkit-admin-layout>
