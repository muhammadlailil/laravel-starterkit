<x-starterkit-admin-layout :title="$page_title">
    <div class="container">
        <div class="page-inner">
            <a href="{{route('admin.cms-users.index')}}" class="ic-back-to-list">
                <i class="ms-Icon ms-Icon--SkypeCircleArrow"></i>
                Kembali ke List
            </a>
            <div class="card full-height">
                <div class="card-header">
                    <b>Tambah</b>
                </div>
                <form action="{{route('admin.cms-users.save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="card-body">
                        <div class="col-sm-6 p-0">
                            <x-starterkit::input.foto name="foto" label="Foto" value="{{($data->profile!='')?asset($data->profile):null}}"></x-starterkit::input.foto>
                            <x-starterkit::input.text name="name" label="Name">{{$data->name}}</x-starterkit::input.text>
                            <x-starterkit::input.email name="email" label="Email">{{$data->email}}</x-starterkit::input.email>
                            <x-starterkit::input.password name="password" label="Password">{{$data->password}}</x-starterkit::input.password>
                            <x-starterkit::input.select name="role" label="Role" class="sumo_select">
                                <option value="">Pilih Role</option>
                                @foreach($privileges as $row)
                                <option {{($data->cms_privileges_id==$row->id)?'selected':''}} value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </x-starterkit::input.select>
                            <div class="form-group form-show-validation row">
                                <label for="status" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 label-form"
                                    style="margin-top: 3px !important;">Status
                                </label>
                                <div class="col-lg-8 col-md-9 col-sm-8">
                                    <div class="custom-control custom-radio">
                                        <input required="required" type="radio" id="activeStatus" name="status"
                                            value="active" class="custom-control-input"
                                            {{($data->status=='active')?'checked':''}}>
                                        <label for="activeStatus" class="custom-control-label">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input required="required" type="radio" id="NonactiveStatus" name="status"
                                            value="non_active" class="custom-control-input"
                                            {{($data->status=='non_active')?'checked':''}}>
                                        <label for="NonactiveStatus" class="custom-control-label">Non Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="col-sm-6 row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <a href="{{route('admin.cms-users.index')}}" class="btn btn-grey mr-3">Batal</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-starterkit-admin-layout>
