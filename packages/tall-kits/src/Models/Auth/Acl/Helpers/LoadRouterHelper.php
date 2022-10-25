<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Kits\Models\Auth\Acl\Helpers;


use App\Models\Group;
use App\Models\Permission;

class LoadRouterHelper
{

    /**
     * @var array
     */
    private $ignore = ['auth', 'store', 'remove-file', 'auto-route', 'translate', 'profile', 'roles', 'permissions'];

    /**
     * @var array
     */
    private $required = ['admin','app'];


    public static function make()
    {

        $make = new static();

        return $make->load();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    private function load()
    {

        //$this->permission->slug_fixed = true;

        $options = [];

        foreach (\Route::getRoutes() as $route) {

            if (isset($route->action['as'])) :

                $data = explode(".", $route->action['as']);

                if ($this->getIgnore($data)) :

                    if ($this->getRequired($data)) :

                        if (!in_array($route->action['as'], $options)) {
                            array_push($options, $route->action['as']);
                        }

                    endif;

                endif;

            endif;
        }
        return $options;
    }


    private function getIgnore($value)
    {

        $result = true;

        foreach ($this->ignore as $item) {

            if (in_array($item, $value)) {

                $result = false;
            }
        }

        return $result;
    }


    private function getRequired($value)
    {

        $result = false;

        foreach ($this->required as $item) {

            if (in_array($item, $value)) {

                $result = true;
            }
        }

        return $result;
    }

    public static function save(){

        $permissions = self::make();

        foreach ($permissions as $permission) {

            if(!Permission::query()->where('slug', $permission)->count()){
                $explode = explode(".", $permission);
                $last = array_shift ($explode);
                $name = str_replace(".", " ", \Illuminate\Support\Str::title($permission));
                $group = null;
                $groups = Group::query()->where('slug', $last)->first();
                if($groups) $group = $groups->id;
                Permission::factory()->create([
                    'name' => $name,
                    'slug' => $permission,
                    'group_id' => $group,
                    'description' => $name
                ]);
            }
        }
    }
}
