<div class="card-header">
    <div class="row">
        <div class="col-sm-4">
            <div class="bulk-action pull-left">
                @if(canDelete())
                    @if(!isset($btn_bulk) || $btn_bulk)
                        <button type="button" class="btn btn-default btn-sm btn-action-selected" data-toggle="dropdown"
                            aria-expanded="false">
                            Bulk Action &nbsp; <span
                                class="caret ms-Icon ms-Icon--ChevronDownMed caret-custom-important"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-bulk">
                            <li>
                                <a href="javascript:void(0)" onclick="bulkDeleteSelected()" class="dropdown-item">
                                    Hapus Terpilih
                                </a>
                            </li>
                        </ul>
                    @endif
                @endif
                @if(isset($button))
                @foreach($button as $i=> $addbutton)
                    <a href="{{$addbutton->href}}" class="{{$addbutton->class}} btn-sm">
                        {{$addbutton->text}}
                        <span class="{{$addbutton->icon}}"></span> 
                    </a>
                @endforeach
                @endif
            </div>
            <div class="filter-action">
                @if(isset($btn_filter) && $btn_filter)
                <a href="javascript:;" class="btn btn-default btn-sm">
                    <span class="caret ms-Icon ms-Icon--Filter caret-custom-important"></span> Filter
                </a>
                @endif
                @if(isset($btn_import) && $btn_import)
                <a href="javascript:;" class="btn btn-default btn-sm" onclick="$('#modalImportData').modal('toggle')">
                    <span class="caret ms-Icon ms-Icon--Upload caret-custom-important"></span> Import
                </a>
                @endif
            </div>
        </div>
        <div class="col-sm-8 text-right">
            @if(canAdd())
                @if(!isset($btn_add) || $btn_add)
                <a href="{{request()->url()}}/add" class="btn btn-primary btn-sm btnAddNew">
                    <span class="ms-Icon ms-Icon--Add mr-2"></span>
                    Buat Data Baru
                </a>
                @endif
            @endif
            <form action="" class="d-inline">
                {!!inputParams(['search']) !!}
                <div class="form-search-table">
                    <div class="form-group has-feedback pd-0 form-group-search-table">
                        <input type="text" class="form-control" id="inputSearchTable" placeholder="Search ..."
                            title="Enter to search .." name="search" value="{{request('search')}}" />
                        <button class="ms-Icon ms-Icon--Search form-control-feedback"></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
