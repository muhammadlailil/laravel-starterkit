<?php
namespace laililmahfud\starterkit\request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use laililmahfud\starterkit\helpers\Starterkit;
use laililmahfud\starterkit\models\CmsModuls;

class CmsModulsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    public function save()
    {
        $this->validate([
            'module_name' => 'required',
            'module_path' => 'required',
            'module_icon' => 'required',
        ]);
        $this->generateModule();

        CmsModuls::create([
            'name' => $this->module_name,
            'path' => $this->module_path,
            'icon' => $this->module_icon,
            'sorting' => 1,
            'table' => $this->module_table,
            'controller' => $this->module_controller,
            'route_prefix' => strtolower(str_replace([" ", "_"], ["-", "-"], $this->module_table)),
            'type' => 'module'
        ]);
        
        session()->put('admin_moduls', Starterkit::listModulePrivilege(auth_user()->cms_privileges_id,auth_user()->is_superadmin));
    }

    public function generateModule()
    {
        $table_name = $this->module_table;
        $describeTable = DB::select("DESCRIBE {$this->module_table}");
        $modelName = str_replace(' ', '', ucwords(str_replace(["-", "_"], [" ", " "], $table_name)));
        $tableColumns = Starterkit::getAllColumName($describeTable);
        $viewFile = str_replace(['_', ' '], '-', $this->module_path);
        

        $modelPath = app_path('Models');
        $controllerPath = app_path('Http/Controllers/Admin');
        $requestPath = app_path('Http/Requests/Admin');
        $viewPath = resource_path("views/module/admin/{$viewFile}");
        if (!file_exists($modelPath)) {
            @mkdir($modelPath, 0755);
        }
        if (!file_exists($controllerPath)) {
            @mkdir($controllerPath, 0755);
        }
        if (!file_exists($requestPath)) {
            if (!file_exists(app_path('Http/Requests'))) {
                @mkdir(app_path('Http/Requests'), 0755);
            }
            @mkdir($requestPath, 0755);
        }
        if (!file_exists($viewPath)) {
            if (!file_exists(resource_path('views/module'))) {
                @mkdir(resource_path('views/module'), 0755);
            }
            if (!file_exists(resource_path('views/module/admin'))) {
                @mkdir(resource_path('views/module/admin'), 0755);
            }
            @mkdir($viewPath, 0755);
        }

        $modelTemplate = file_get_contents(__DIR__ . '/../stubs/model.blade.php.stub');
        $requestTemplate = file_get_contents(__DIR__ . '/../stubs/request.blade.php.stub');
        $controllerTemplate = file_get_contents(__DIR__ . '/../stubs/controller.blade.php.stub');
        $dataTableTemplate = file_get_contents(__DIR__ . '/../stubs/table.blade.php.stub');
        $formDataTemplate = file_get_contents(__DIR__ . '/../stubs/form.blade.php.stub');

        $defaultQuery = self::createDefaultQuery($modelName);
        $requestColumn = "[";
        $requestValidate = "".'$validation'."= [";
        $requestFormData = "".'$formData'."= [";
        $tableData = "";
        $formData = "";
        foreach ($this->table_name as $i=> $col) {
            if($col){
                $requestColumn .= "\r\n\t\t\t\t\t\t".'(object) ["label"=>"'.$this->table_label[$i].'", "name"=>"'.$this->module_table.'.'.$this->form_name[$i].'"],'."";
                $colValue = ($this->table_join[$i])?$this->table_join[$i].'_'.$this->table_join_relation[$i]:$col;
                $tableData .= '<th>{{$row->' . $colValue . '}}</th>'."\r\n";
            }
        }
        foreach ($this->form_name as $x=> $form) {
            if($form){
                $requestValidate .= "\r\n\t\t\t\t\t\t".'"'.$this->form_name[$x].'" => "'.$this->form_validation[$x].'",'."";
                $requestFormData .= "\r\n\t\t\t\t\t\t".'"'.$this->form_name[$x].'" => $this->'.$this->form_name[$x].','."";
                $formData .= "\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t".'<x-starterkit::input.'.$this->form_type[$x].' name="' . $form . '" label="' . $this->form_label[$x] . '">{{$data->' . $form . '}}</x-starterkit::input.'.$this->form_type[$x].'>'."";
            }
        }
        $requestValidate .= "\r\n\t\t\t\t".'];';
        $requestFormData .= "\r\n\t\t\t\t".'];';
        $requestColumn .= "\r\n\t\t\t\t".'];';

        //assign all variable to model template
        $modelTemplate = str_replace('[modelName]', $modelName, $modelTemplate);
        $modelTemplate = str_replace('[tableName]', $table_name, $modelTemplate);
        $modelTemplate = str_replace('[columTable]', json_encode($tableColumns), $modelTemplate);

        //assign all variable to request template
        $requestTemplate = str_replace('[modelName]', $modelName, $requestTemplate);
        $requestTemplate = str_replace('[requestColumns]',$requestColumn, $requestTemplate);
        $requestTemplate = str_replace('[requestValidate]', $requestValidate, $requestTemplate);
        $requestTemplate = str_replace('[requestFormData]', $requestFormData, $requestTemplate);
        $requestTemplate = str_replace('[defaultQuery]', $defaultQuery, $requestTemplate);
        
        //assign all variable to controller template
        $routePrefix = strtolower(str_replace([" ", "_"], ["-", "-"], $table_name));
        $controllerTemplate = str_replace('[controllerName]', $this->module_controller, $controllerTemplate);
        $controllerTemplate = str_replace('[modelName]', $modelName, $controllerTemplate);
        $controllerTemplate = str_replace('[pageTitle]', $this->module_name, $controllerTemplate);
        $controllerTemplate = str_replace('[routePrefix]', $routePrefix, $controllerTemplate);
        $controllerTemplate = str_replace('[button_table_action]', $this->button_table_action, $controllerTemplate);
        $controllerTemplate = str_replace('[button_bulk_action]', $this->button_bulk_action, $controllerTemplate);
        $controllerTemplate = str_replace('[button_add]', $this->button_add, $controllerTemplate);
        $controllerTemplate = str_replace('[button_filter]', $this->button_filter, $controllerTemplate);
        $controllerTemplate = str_replace('[button_import]', $this->button_import, $controllerTemplate);
        $controllerTemplate = str_replace('[button_export]', $this->button_export, $controllerTemplate);

        // assign all variable to table template
        $dataTableTemplate = str_replace('[routePrefix]', $routePrefix, $dataTableTemplate);
        $dataTableTemplate = str_replace('[tableData]', $tableData, $dataTableTemplate);

        // assign all variable to form template
        $formDataTemplate = str_replace('[routePrefix]', $routePrefix, $formDataTemplate);
        $formDataTemplate = str_replace('[formData]', $formData, $formDataTemplate);

        //create model
        if (!file_exists($modelPath . '/' . $modelName . '.php')) {
            file_put_contents($modelPath . '/' . $modelName . '.php', $modelTemplate);
        }
        //create request
        if (!file_exists($requestPath . '/' . $modelName . 'Request.php')) {
            file_put_contents($requestPath . '/' . $modelName . 'Request.php', $requestTemplate);
        }
        //create controller
        if (!file_exists($controllerPath . '/' . $this->module_controller . '.php')) {
            file_put_contents($controllerPath . '/' . $this->module_controller . '.php', $controllerTemplate);
        }
        // create index view
        if (!file_exists($viewPath . '/index.blade.php')) {
            file_put_contents($viewPath . '/index.blade.php', $dataTableTemplate);
        }
        // create form view
        if (!file_exists($viewPath . '/form.blade.php')) {
            file_put_contents($viewPath . '/form.blade.php', $formDataTemplate);
        }
    }
    
    public function createDefaultQuery($modelName){
        $selectField = '"'.$this->module_table.'.*"';
       
        $filterQuery = '';
        foreach ($this->table_name as $i=> $col) {
            if($col){
                if($i==0){
                    $filterQuery .= '$q->where("'.$this->module_table.'.'.$col.'", "like", "%" . $search . "%")';
                }else{
                    $filterQuery .= ''."\r\n\t\t\t\t\t\t\t\t\t".'->orWhere("'.$this->module_table.'.'.$col.'", "like", "%" . $search . "%")';
                }
                if($i==count($this->table_name)-1){
                  
                }
            }
        }
        $joinQuery = null;//'join("cms_privileges as r", "cms_users.cms_privileges_id", "r.id")';
        foreach($this->table_join as $y => $join){
            if($join){
                if($joinQuery){
                    $joinQuery .= "->";
                }
                $joinQuery.= 'join("'.$join.'", "'.$this->module_table.'.'.$join.'_id", "'.$join.'.id")'."\r\n";
                $selectField .= ',"'.$join.'.'.$this->table_join_relation[$y].' as '.$join.'_'.$this->table_join_relation[$y].'"';
                $filterQuery .= ''."\r\n\t\t\t\t\t\t\t\t\t".'->orWhere("'.$join.'.'.$this->table_join_relation[$y].'", "like", "%" . $search . "%")';
            }
        }
        if($filterQuery){
            $filterQuery .= ";";
        }
        $whereCondition = ($joinQuery)?'->':'';
        $whereCondition .= 'where(function ($q) use ($search) {
                '.$filterQuery.'                
            })';
        $selectList = ''."\r\n\t\t\t\t\t\t".'->select('.$selectField.')';
        $allQuery = $joinQuery.$whereCondition.$selectList;

        $defaultQuery = "".$modelName.'::'.$allQuery."";
        return $defaultQuery;
    }

//     public function tes(){
//         $prefix = 'unit';
//         $path = 'unit';
//         $controller = "AdminUnitController";
//         $routeWeb = file_get_contents(base_path('routes/web.php'));
//         $appendRoute = "Route::group(['prefix' => s_config('admin_path'), 'as' => 'admin.', 'middleware' => ['web',\Laililmahfud\Starterkit\Middleware\AdminMiddleware::class]], function () {
//     Route::group(['prefix' => '".$path."', 'as' => '".$prefix."', 'controller' => '\App\Http\Controllers\Admin\\".$controller."'], function () {
//         Route::get('/', 'index')->name('index');
//         Route::get('/add', 'add')->name('add');
//         Route::get('/edit/{id}', 'edit')->name('edit');
//         Route::post('/save', 'save')->name('save');
//         Route::delete('/delete/{id}', 'delete')->name('delete');
//         Route::delete('/bulk-delete', 'bulkdelete')->name('bulk-delete');
//     });

//     // [newAdminRoute]
// });";
//         $controllerTemplate = str_replace('// [newAdminRoute]', $appendRoute, $routeWeb);
//         file_put_contents(base_path("routes/web.php"), $controllerTemplate);
//         dd($routeWeb);
//     }
}
