<x-starterkit-admin-layout :title="$page_title">
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <b>Sorting module</b>
                            <span id="menu-saved-info"></span>
                        </div>
                        <div class="card-body">
                            @if(count($data))
                            <ul class='draggable-menu draggable-menu-active'>
                                @foreach($data as $row)
                                <li data-id="{{$row->id}}" data-name="{{$row->name}}">
                                    <div class=''>
                                        @if($row->icon!='-')
                                        <i class="ms-Icon ms-Icon--{{$row->icon}} mr-2"></i>
                                        @endif
                                        <span>{{$row->name}}</span>
                                        <span class='pull-right'>
                                            <a class='fa fa-pen' title='Edit'
                                                href="{{url('edit/'.$row->id)}}"></a>&nbsp;&nbsp;
                                            <a title='Delete' class='fa fa-trash' onclick=""
                                                href='javascript:void(0)'></a></span>
                                        <br />
                                        </em>
                                    </div>
                                    <ul>
                                        @if(count($row->subMenu))
                                        @foreach($row->subMenu as $sub)
                                        <li data-id="{{$sub->id}}" data-name="{{$sub->name}}">
                                            <div>
                                                <span>{{$sub->name}}</span>
                                                <span class='pull-right'>
                                                    <a class='fa fa-pen' title='Edit'
                                                        href="{{url('edit/'.$sub->id)}}"></a>&nbsp;&nbsp;
                                                    <a title="Delete" class='fa fa-trash' href='javascript:void(0)'></a>
                                                </span>
                                                <br />
                                            </div>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <div align="center">Active menu is empty, please add new menu</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <form action="{{route('admin.cms-menus.save')}}" method="post">
                            @csrf
                            <div class="card-header">
                                <b>Add module</b>
                            </div>
                            <div class="card-body">
                                <x-starterkit::input.text label="Module Name" name="module_name">
                                </x-starterkit::input.text>
                                <x-starterkit::input.text label="Module Path" name="module_path">
                                </x-starterkit::input.text>
                                <x-starterkit::input.text label="Module Controller" name="module_controller">
                                </x-starterkit::input.text>
                                <x-starterkit::input.select label="Module Table" name="module_table" class="sumo_select">
                                    <option value="">Select Table</option>
                                    @foreach($table as $row)
                                        <option value="{{$row->table_name}}">{{$row->table_name}}</option>
                                    @endforeach
                                </x-starterkit::input.select>
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
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('css')
    <style type="text/css">
        body.dragging,
        body.dragging * {
            cursor: move !important;
        }

        .dragged {
            position: absolute;
            opacity: 0.7;
            z-index: 2000;
        }

        .draggable-menu {
            padding: 0 0 0 0;
            margin: 0 0 0 0;
        }

        .draggable-menu li ul {
            margin-top: 6px;
        }

        .draggable-menu li div {
            padding: 11px 11px;
            border: 1px solid #cccccc;
            background: #eeeeee;
            cursor: move;
        }

        .draggable-menu li .is-dashboard {
            background: #fff6e0;
        }

        .draggable-menu li .icon-is-dashboard {
            color: #ffb600;
        }

        .draggable-menu li {
            list-style-type: none;
            margin-bottom: 4px;
            min-height: 35px;
        }

        .draggable-menu li.placeholder {
            position: relative;
            border: 1px dashed #b7042c;
            background: #ffffff;
            /** More li styles **/
        }

        .draggable-menu li.placeholder:before {
            position: absolute;
            /** Define arrowhead **/
        }

    </style>
    @endpush
    @push('js')
    <script>
        $(function () {
            var id_cms_privileges = '1';
            var sortactive = $(".draggable-menu").sortable({
                group: '.draggable-menu',
                delay: 200,
                isValidTarget: function ($item, container) {
                    var depth = 1, // Start with a depth of one (the element itself)
                        maxDepth = 2,
                        children = $item.find('ul').first().find('li');

                    // Add the amount of parents to the depth
                    depth += container.el.parents('ul').length;

                    // Increment the depth for each time a child
                    while (children.length) {
                        depth++;
                        children = children.find('ul').first().find('li');
                    }

                    return depth <= maxDepth;
                },
                onDrop: function ($item, container, _super) {

                    if ($item.parents('ul').hasClass('draggable-menu-active')) {
                        var isActive = 1;
                        var data = $('.draggable-menu-active').sortable("serialize").get();
                        var jsonString = JSON.stringify(data, null, ' ');
                    } else {
                        var isActive = 0;
                        var data = $('.draggable-menu-inactive').sortable("serialize").get();
                        var jsonString = JSON.stringify(data, null, ' ');
                        $('#inactive_text').remove();
                    }

                    $.post(`{{route('admin.cms-menus.save-sorting')}}`, {
                        menus: jsonString,
                        isActive: isActive,
                        _token: '{{csrf_token()}}'
                    }, function (resp) {
                        $('#menu-saved-info').fadeIn('fast').delay(1000).fadeOut('fast')
                            .html(resp.message);
                    });

                    _super($item, container);
                }
            });


        });

    </script>
    @endpush

</x-starterkit-admin-layout>
