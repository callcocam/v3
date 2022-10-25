<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Kits\Models\Auth\Acl\Tactics;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Tall\Kits\Models\Auth\Acl\Contracts\Role;
use Tall\Kits\Models\Auth\Acl\Facades\Acl;

class GivePermissionTo
{
    /**
     * @var array
     */
    protected $permissions;

    /**
     * Create a new GivePermissionTo instance.
     *
     * @param  array  $permissions
     */
    public function __construct(...$permissions)
    {
        $this->permissions = Arr::flatten($permissions);
    }

    /**
     * Give the permissions to the given user or role.
     *
     * @param  Role|User  $roleOrUser
     */
    public function to($roleOrUser)
    {
        if ($roleOrUser instanceof Model) {
            $instance = $roleOrUser;
        } else {
            $instance = Acl::role()->where('slug', $roleOrUser)->firstOrFail();
        }

        $instance->givePermissionTo($this->permissions);
    }
}
