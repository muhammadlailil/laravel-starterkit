<div class="card-footer card-footer-table">
    <div class="pagination-table">
        <div class="row">
            <div class="col-sm-6">
                <div class="pagination-btn  pull-left">
                    @php
                        $page = intval(request('page'));
                        $page = ($page==0)?1:$page;
                        $prev = $page - 1;
                        $next = $page + 1;
                        $page = ($page)?$page:1;
                        $prevLink = request()->url().'?page='. $prev .'&'.url_parameter('page');
                        $nexLink = request()->url().'?page='. $next .'&'.url_parameter('page');
                        if($page==$data->lastPage()){
                            $nexLink = 'javascript:;';
                        }
                        if($page==1){
                            $prevLink = 'javascript:;';
                        }
                    @endphp
                    <a href="{{$prevLink}}" class="previous paginate-link {{($page==1)?'disabled':''}}">
                        <span class="ms-Icon ms-Icon--ChevronLeftSmall"></span>
                    </a>
                    <a href="{{$nexLink}}" class="next paginate-link {{($page==$data->lastPage())?'disabled':''}}">
                        <span class="ms-Icon ms-Icon--ChevronRightSmall"></span>
                    </a>
                </div>
                <span class="indicator-page">
                    Page
                    <input type="number" class="input-change-page-paginate" value="{{$page}}" />
                    of {{$data->lastPage()}}
                </span>
            </div>
            <div class="col-sm-6 text-right">
                <form action="" id="form-filter-table" class="d-inline">
                    {!!inputParams(['limit']) !!}
                    <div class="filter-row">
                        <select name="limit" id="limitTable"
                            onchange="$('#form-filter-table').submit()"
                            class="form-control input-sm range-list-table custom-select">
                            <option {{(request('limit')=='5')?'selected':''}} value="5">5</option>
                            <option {{(request('limit')=='10' || !request('limit'))?'selected':''}} value="10">10</option>
                            <option {{(request('limit')=='20')?'selected':''}} value="20">20</option>
                            <option {{(request('limit')=='25')?'selected':''}} value="25">25</option>
                            <option {{(request('limit')=='50')?'selected':''}} value="50">50</option>
                            <option {{(request('limit')=='100')?'selected':''}} value="100">100</option>
                            <option {{(request('limit')=='200')?'selected':''}} value="200">200</option>
                        </select>
                        <span>
                            Jumlah <br>Baris
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
