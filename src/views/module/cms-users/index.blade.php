<x-starterkit-admin-layout :title="$page_title">
    <div class="container">
        <div class="page-inner">
            <div class="card full-height">
                @include('starterkit::partials.table.header')
                <div class="card-body table-responsive pd-0">
                    <form action="{{route('admin.cms-users.bulk-delete')}}" method="post" id="form_bulk_action">
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
                                    <th>
                                        <div class="image__table">
                                            <div class="image" style="background-image:url({{asset($row->profile)}})">
                                            </div>
                                            <span>{{$row->name}}</span>
                                        </div>
                                    </th>
                                    <th>{{$row->email}}</th>
                                    <th>{{$row->role}}</th>
                                    <th>{{($row->status=='active')?'Active':'Non Active'}}</th>
                                    <th class="text-right action_table">
                                        <a href="{{route('admin.cms-users.edit',$row->id)}}"
                                            class="action btn btn-primary">
                                            Edit
                                        </a>
                                        <a href="javascript:;" data-id="{{$row->id}}"
                                            class="action btn btn-danger btn_action__delete">
                                            Delete
                                        </a>
                                    </th>
                                </tr>
                                @endforeach
                                @if($data->total()==0)
                                <tr>
                                    <th class="text-center" colspan="6">Tidak ada data</th>
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

    <form action="{{route('admin.cms-users.delete',':id')}}" method="post" class="delete_form">
        @method('delete')
        @csrf
    </form>
</x-starterkit-admin-layout>
