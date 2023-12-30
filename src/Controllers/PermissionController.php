<?php

namespace Phpcatcom\Permission\Controllers;
//namespace  App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Phpcatcom\Permission\Models\Permission;
use Phpcatcom\Permission\Models\Role;

//class PermissionController extends BigControllers
class PermissionController extends Controller
{

    public static function generate()
    {

        $routes = Route::getRoutes()->getRoutes();

        foreach ($routes as $route) {

            $in = [];
            $in['action'] =
            $action = $route->getActionname();

//            var_dump($action);
//            var_dump( $route->getName() );
//            var_dump( '' );

            if ($action == "Closure") {
                $action = '';
//                continue;
            }

//            $in['domain'] = $route->getDomain();
//                var_dump($in);

            $permission = Permission::updateOrCreate(
                ['name' => $route->getName()],
                [
                    'action' => $action,
                    'domain' => $route->getDomain(),
//                    'method' => $route->getActionMethod()
                ]
            );

            if (key_exists('role', $route->action)) {
                $roles = $route->action['role'];

                if (is_array($roles)) {
                    foreach ($roles as $role) {
                        $role = Role::firstOrCreate(['name' => $role]);

                        $role->permissions()->syncWithoutDetaching($permission->id);
                    }
                } else {
                    $role = Role::firstOrCreate(['name' => $roles]);

                    $role->permissions()->syncWithoutDetaching($permission->id);
                }
            }
        }
    }

    public static function fresh()
    {
        Permission::query()->delete();
        Role::query()->delete();
    }

//    public static $in = ['menu' => [
//        [
//            'route' => 'phpcatcom.permission.index',
//            'title' => 'Управление',
//            'template' => 'phpcatcom/permission-gui::index'
//        ],
//        [
//            'route' => 'phpcatcom.permission.role.index',
//            'title' => 'Роли',
//            'template' => 'phpcatcom/permission-gui::roles'
//        ],
//        [
//            'route' => 'phpcatcom.permission.places',
//            'title' => 'Места',
//            'template' => 'phpcatcom/permission-gui::places'
//        ],
//        [
//            'route' => 'phpcatcom.permission.setter',
//            'title' => 'Назначение ролей пользователям',
//            'template' => 'phpcatcom/permission-gui::setter'
//        ],
//    ]];
//
//
//    public function showIndex()
//    {
//        return view('phpcatcom/permission-gui::index', self::$in);
//    }
//
//    public function showRoles()
//    {
//        return view('phpcatcom/permission-gui::roles', self::$in);
//    }
//
//    public function showSetter()
//    {
//        return view('phpcatcom/permission-gui::setter', self::$in);
//    }
//
//    public function showPlaces()
//    {
//
//        self::$in['places'] = \PhpCatCom\Models\Permission::all();
//
//        return view('phpcatcom/permission-gui::places', self::$in);
//    }

}
