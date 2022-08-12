<thead>
    <tr>
        @if(!isset($btn_bulk) || $btn_bulk)
        <td class="first">
            @if(canDelete())
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="checkall">
                <label class="custom-control-label" for="checkall">&nbsp;</label>
            </div>
            @endif
        </td>
        @endif
        @foreach($columns as $c)
        <td>
            @if(request('sortby')==$c->name && request('sorting')=='desc')
            <a href="{{Starterkit::urlFilterColumn($c->name,'asc')}}" title="Click to sort ascending">
                {{$c->label}}
                <span class="ms-Icon order ms-Icon--SortLinesAscending"></span>
            </a>
            @elseif(request('sortby')==$c->name && request('sorting')=='asc')
            <a href="{{Starterkit::urlFilterColumn($c->name,'desc')}}" title="Click to sort ascending">
                {{$c->label}}
                <span class="ms-Icon order ms-Icon--SortLines"></span>
            </a>
            @else
            <a href="{{Starterkit::urlFilterColumn($c->name,'asc')}}" title="Click to sort ascending">
                {{$c->label}}
                <span class="ms-Icon order ms-Icon--SwitcherStartEnd"></span>
            </a>
            @endif
        </td>
        @endforeach
        @if(!isset($table_action))
        <td class="text-right">
            AKSI
        </td>
        @endif
    </tr>
</thead>
