<div class="card-header">
    <b>Pengaturan</b>
</div>
<div class="card-body">
    <div class="col-sm-7 p-0">
        <x-starterkit::input.select label="Table" name="module_table" class="sumo_select">
            <option value="">Select Table</option>
            <option value="cms_users">cms_users</option>
            <option value="cms_notification">cms_notification</option>
            @foreach($table as $row)
            <option value="{{$row->table_name}}">{{$row->table_name}}</option>
            @endforeach
        </x-starterkit::input.select>
        <x-starterkit::input.text label="Module Name" name="module_name">
        </x-starterkit::input.text>
        <x-starterkit::input.text label="Module Path" name="module_path">
        </x-starterkit::input.text>
        <x-starterkit::input.text label="Controller Name" name="module_controller">
        </x-starterkit::input.text>
        <x-starterkit::input.text label="Module Icon" name="module_icon">
        </x-starterkit::input.text>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <span clas="help-text">List icon <a href="https://uifabricicons.azurewebsites.net/"
                        target="_blank">here</a></span>
            </div>
        </div>

    </div>

    <!-- <br><br>
    <div class="config">
        <b>Pengaturan Akses</b>
        <div class="row" style="margin: 0px">
            <div class="col-sm-3">
                <div class="row">
                    <div class="col-sm-12 pd-0">
                        <div class="form-group">
                            <label>Show Button Add</label><br>
                            <label class="radio-inline">
                                <input checked="" type="radio" name="button_add" value="true"> TRUE
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="button_add" value="false"> FALSE
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-12 pd-0">
                        <div class="form-group">
                            <label>Show Button Table Action</label><br>
                            <label class="radio-inline">
                                <input checked="" type="radio" name="button_table_action" value="true"> TRUE
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="button_table_action" value="false"> FALSE
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-12 pd-0">
                        <div class="form-group">
                            <label>Show Bulk Action Button</label><br>
                            <label class="radio-inline">
                                <input checked="" type="radio" name="button_bulk_action" value="true"> TRUE
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="button_bulk_action" value="false"> FALSE
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="row">
                    <div class="col-sm-12 pd-0">
                        <div class="form-group">
                            <label>Show Button Filter</label><br>
                            <label class="radio-inline">
                                <input type="radio" name="button_filter" value="true"> TRUE
                            </label>
                            <label class="radio-inline">
                                <input checked="" type="radio" name="button_filter" value="false"> FALSE
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-12 pd-0">
                        <div class="form-group">
                            <label>Show Button Import</label><br>
                            <label class="radio-inline">
                                <input type="radio" name="button_import" value="true"> TRUE
                            </label>
                            <label class="radio-inline">
                                <input checked="" type="radio" name="button_import" value="false"> FALSE
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-12 pd-0">
                        <div class="form-group">
                            <label>Show Button Export</label><br>
                            <label class="radio-inline">
                                <input type="radio" name="button_export" value="true"> TRUE
                            </label>
                            <label class="radio-inline">
                                <input checked="" type="radio" name="button_export" value="false"> FALSE
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>
<div class="card-footer">
    <div class="col-sm-7 row">
        <div class="col-sm-3"></div>
        <div class="col-sm-9">
            <button type="button" class="btn btn-sm btn-grey mr-3">
                << Back</button> <button type="button" class="btn btn-primary btn-sm" onclick="toStep2()">Next >>
            </button>
        </div>
    </div>
</div>
