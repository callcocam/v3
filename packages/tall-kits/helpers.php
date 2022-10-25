<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
use Illuminate\Support\{Str};
use Symfony\Component\Finder\Finder;

if (!function_exists('flash')) {
    
    function flash($mssage,$type="success"){

    }
}

if (!function_exists('field')) {
    
    function field($label,$name=null){
       return \Tall\Kits\Core\Form\Field::make($label,$name);
    }
}

if (!function_exists('avatar')) {
    
    function avatar($label,$name=null,$alias=null){
       return \Tall\Kits\Core\Form\Field::avatar($label,$name,$alias);
    }
}

if (!function_exists('email')) {
    
    function email($label,$name="email"){
       return \Tall\Kits\Core\Form\Field::email($label,$name);
    }
}

if (!function_exists('password')) {
    
    function password($label,$name="password"){
       return \Tall\Kits\Core\Form\Field::password($label,$name);
    }
}

if (!function_exists('phone')) {
    
    function phone($label,$name="password"){
       return \Tall\Kits\Core\Form\Field::phone($label,$name);
    }
}

if (!function_exists('color')) {
    
    function color($label,$name=null){
       return \Tall\Kits\Core\Form\Field::color($label,$name);
    }
}

if (!function_exists('cover')) {
    
    function cover($label,$name=null){
       return \Tall\Kits\Core\Form\Field::cover($label,$name);
    }
}

if (!function_exists('textarea')) {
    
    function textarea($label,$name=null){
       return \Tall\Kits\Core\Form\Field::textarea($label,$name);
    }
}

if (!function_exists('file')) {
    
    function file($label, $name = null, $file = 'file'){
       return \Tall\Kits\Core\Form\Field::file($label,$name, $file);
    }
}

if (!function_exists('checkbox')) {
    
    function checkbox($label, $name = null, $options=[]){
       return \Tall\Kits\Core\Form\Field::checkbox($label,$name, $options);
    }
}

if (!function_exists('radio')) {
    
    function radio($label, $name = null, $options=[]){
       return \Tall\Kits\Core\Form\Field::radio($label,$name, $options);
    }
}

if (!function_exists('select')) {
    
    function select($label, $name = null, $options=[]){
       return \Tall\Kits\Core\Form\Field::select($label,$name, $options);
    }
}

if (!function_exists('form')) {
    
    function form($name, $fields){
        if($field = data_get($fields, $name)){
            $field->hiddenIf(false);
            return $field;
        }
        return null;
    }
}


if (!function_exists('column')) {
    
    function column($name, $columns){
        if($column = $columns->firstWhere('name', $name)){
            $column->visible = false;
            return $column;
        }
        return null;
    }
}

if (!function_exists('load_table_components')) {
    function load_table_components($search="")
    {
        if(is_dir(resource_path('views/vendor/tall/kits/components/table/views')))
        {
            $path=resource_path('views/vendor/tall/kits/components/table/views');
        }
        else{
            $path= __DIR__ . '/resources/views/components/table/views';
        }
        $files =collect([]);
        foreach ((new \Symfony\Component\Finder\Finder)->in($path)->files()->name(sprintf('%s*.blade.php', $search)) as $component) {   
            $file = Str::beforeLast( $component->getFilename(), ".blade");
            $files[$file] = $file;
        }    
        return $files->sortKeys()->toarray();
    }
}

if (!function_exists('configureDynamicRoute')) {
   
    /**
     * Configure the routes for the application.
     *
     * @return void
     */
   function configureDynamicRoute($path,$search="app", $ns = "\\App")
    {
           
        foreach ((new Finder)->in($path) as $component) {                   
            $componentPath = $component->getRealPath();        
            $namespace = Str::after($componentPath, 'public_html');
            $namespace = Str::after($namespace, $search);
            $namespace = Str::replace(['/', '.php'], ['\\', ''], $namespace);
            $component = $ns . $namespace;           
            if (class_exists($component)) {
                if (method_exists($component, 'route')) {                
                    $comp =  app($component);
                    $comp ->route();
                }
            }
        }
    }
}



if (!function_exists('date_carbom_format')) {

    function date_carbom_format($date, $format = "d/m/Y H:i:s")
    {
      
        $date = explode(" ", str_replace(["-", "/", ":"], " ", $date));
 
        if (!isset($date[0])) {
            $date[0] = null;
        }
        if (!isset($date[1])) {
            $date[1] = null;
        }
        if (!isset($date[2])) {
            $date[2] = null;
        }
        if (!isset($date[3])) {
            $date[3] = null;
        }
        if (!isset($date[4])) {
            $date[4] = null;
        }
        if (!isset($date[5])) {
            $date[5] = null;
        }
        list($y, $m, $d, $h, $i, $s) = $date;

        //$carbon = \Carbon\Carbon::now();
        $carbon = \Illuminate\Support\Facades\Date::now();
        $carbon->locale('pt');
        if (strlen($date[0]) == 4) {
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toDateTimeLocalString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toDayDateTimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toLongDateString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toFullDateString().PHP_EOL;
            //
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toShortTimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toMediumTimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toLongTimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toFullTimeString().PHP_EOL;
            //
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toShortDatetimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toMediumDatetimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toLongDatetimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toFullDatetimeString().PHP_EOL;
            return $carbon->create($y, $m, $d, $h, $i, $s);
        }
        if ($y && $m && $d) {
            return $carbon->create($d, $m, $y, $h, $i, $s);
        }
        return $carbon->create(null, null, null, null, null, null);
    }
}