<?php

namespace App\Support\Definers\ViewComposerDefiners;

use App\Models\Department;
use App\Models\Permission;
use App\Models\Role;
use App\Support\Helpers\ModelHelper;
use App\Support\Traits\Misc\DefinesViewComposer;

class GlobalViewComposersDefiner
{
    use DefinesViewComposer;

    public static function defineAll()
    {
        self::definePaginationLimitComposer();
        self::defineRolesComposer();
    }

    private static function definePaginationLimitComposer()
    {
        self::defineViewComposer('components.filter.partials.pagination-limit-input', [
            'paginationLimitOptions' => ModelHelper::getPaginationLimitOptions(),
        ]);
    }

    private static function defineRolesComposer()
    {
        self::defineViewComposer('roles.partials.filter', [
            'roles' => Role::orderByName()->get(),
            'departments' => Department::orderByName()->get(),
            'permissions' => Permission::orderByName()->get(),
        ]);
    }
}
