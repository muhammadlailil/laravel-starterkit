<x-starterkit-admin-layout :title="$page_title" :pagetype="$page_type">
    <div class="container">
        <div class="page-inner">

            <form autocomplate="off" enctype="multipart/form-data" class="formInput" action="{{route('admin.update-profile')}}" method="post">
                @csrf
                <div class="card full-height">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                               <b>Profile</b>
                            </div>
                        </div>
                    </div>

                    <div class="card-body ">
                        <div class="body" style="padding:10px">                            
                            <x-starterkit::input.foto name="profile" label="Profile" value="{{asset(auth_user()->profile)}}"></x-starterkit::input.foto>
                            <x-starterkit::input.text name="name" label="Nama">{{auth_user()->name}}</x-starterkit::input.text>
                            <x-starterkit::input.email name="email" label="Email">{{auth_user()->email}}</x-starterkit::input.email>
                            <x-starterkit::input.password name="password" label="Password">edit</x-starterkit::input.password>

                        </div>
                    </div>

                     <div class="card-footer" style="padding:20px">
                        <div class="pagination-table">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                     <input class="btn-save btn-sm btn" type="submit" value="Update">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-starterkit-admin-layout>
