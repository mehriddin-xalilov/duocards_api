<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    /**
     * Display a listing of permissions grouped by resource
     */
    public function index(Request $request)
    {
        Gate::authorize('permissions.view');

        $permissions = Permission::all();

        // Group permissions by resource
        $grouped = $permissions->groupBy(function ($permission) {
            return explode('.', $permission->name)[0];
        })->map(function ($group, $resource) {
            return [
                'resource' => $resource,
                'permissions' => $group->map(function ($permission) {
                    return [
                        'id' => $permission->id,
                        'name' => $permission->name,
                        'action' => explode('.', $permission->name)[1] ?? null,
                    ];
                })->values()
            ];
        })->values();

        return okResponse([
            'all' => $permissions,
            'grouped' => $grouped
        ]);
    }

    /**
     * Display the specified permission
     */
    public function show($id)
    {
        Gate::authorize('permissions.view');

        $permission = Permission::with('roles')->findOrFail($id);

        return okResponse($permission);
    }
}
