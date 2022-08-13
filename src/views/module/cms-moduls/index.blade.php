<x-starterkit-admin-layout :title="$page_title">
    <div class="container">
        <div class="page-inner">
            <ul class="nav nav-tabs" id="moduleGeneratorTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="step1-tab" data-toggle="tab" href="#step1" role="tab"
                        aria-controls="step1" aria-selected="true">
                        <i class="ms-Icon ms-Icon--Settings"></i>
                        Step 1 - Pengaturan
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="step2-tab" data-toggle="tab" href="#step2" onclick="toStep2()" role="tab"
                        aria-controls="step2" aria-selected="false">
                        <i class="ms-Icon ms-Icon--TableComputed"></i>
                        Step 2 - Tampilan Table
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="step3-tab" data-toggle="tab" href="#step3" role="tab" aria-controls="step3"
                        aria-selected="false">
                        <i class="ms-Icon ms-Icon--FabricFormLibrary"></i>
                        Step 2 - Tampilan Form
                    </a>
                </li>
            </ul>
            <div class="card full-height">
               <form action="{{route('admin.cms-moduls.save')}}" method="post" class="formModules">
                @csrf
                <div class="tab-content" id="moduleGeneratorTabsContent">
                    <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="step1-tab">
                        @include('starterkit::module.cms-moduls.step1')
                    </div>
                    <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="step2-tab">
                        @include('starterkit::module.cms-moduls.step2')
                    </div>
                    <div class="tab-pane fade" id="step3" role="tabpanel" aria-labelledby="step3-tab">
                        @include('starterkit::module.cms-moduls.step3')
                    </div>
                </div>
               </form>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        const listTable = @json($table);
        let baseTableColumns = []
        let lastSelectedTableValue = null;
        let lastSelectedTableValuestep3 = null;
        let refresForm = false;
        $(function () {
            $('.formModules').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) { 
                    e.preventDefault();
                    return false;
                }
            });
            $(document).on('click', '.btn-delete-table-form', function () {
                $(this).parent().parent('tr').remove();
            })
            $(document).on('click', '.suggestion_module li', function () {
                var v = $(this).text();
                $(this).parent('ul').prev('input[type=text]').val(v);
                $(this).parent('ul').remove();
            })
            $(document).on('click', '.input_label_form_table', function () {
                createSuggestion($(this), true);
            })
            
            $(document).on('click', '.input_name_form_table', function () {
                createSuggestion($(this));
            })
            $(document).on('click', '.input_join_form_table', function () {
                createSuggestionListTable($(this));
            })
            $(document).on('click', '.input_join_name_form_table', function () {
                createSuggestionJoinColumTable($(this));
            })

            $(document).mouseup(function (e) {
                var container = $(".suggestion_module");
                if (!container.is(e.target) &&
                    container.has(e.target).length === 0) {
                    container.hide();
                }
            });
        })

        function loadTableColumns(table_name) {
            return $.ajax({
                url: "{{route('admin.cms-moduls.load-columns', ':table_name')}}".replace(':table_name',
                    table_name),
                type: "GET",
            });
        }

        function createSuggestion(el, label = false) {
            el.next('ul').remove();
            var suggestion = '<ul class="suggestion_module">';
            $.each(baseTableColumns, function (i, obj) {
                let val = obj
                if (label) {
                    val = ucworld(val)
                }
                suggestion += "<li>" + val + "</li>";
            });
            suggestion += '</ul>';
            el.after(suggestion)
        }

        function createSuggestionListTable(el) {
            el.next('ul').remove();
            var suggestion = '<ul class="suggestion_module">';
            $.each(listTable, function (i, obj) {
                suggestion += "<li>" + obj.table_name + "</li>";
            });
            suggestion += '</ul>';
            el.after(suggestion)
        }

        function createSuggestionJoinColumTable(el){
            var tableValue = el.parent().parent().find('.input_join_form_table').val()
            if(tableValue){
                loadTableColumns(tableValue).then((resp)=>{
                    el.next('ul').remove();
                    var suggestion = '<ul class="suggestion_module">';
                    $.each(resp.data, function (i, obj) {
                        suggestion += "<li>" + obj + "</li>";
                    });
                    suggestion += '</ul>';
                    el.after(suggestion)
                })
            }
        }
        function ucworld(val) {
            return val.replace('_', ' ').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
                return $1.toUpperCase();
            });
        }

        function goToTab(tab){
            $(`#moduleGeneratorTabs .nav-link[href="${tab}"]`).tab('show');
        }

    </script>
    @endpush

    @push('css')
    <style>
        .input-table {
            min-width: 300px;
        }

    </style>
    @endpush


</x-starterkit-admin-layout>
