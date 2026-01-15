<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;
use App\Helpers\Traits\QueryBuilderTrait;

class RoleController extends Controller
{
    use QueryBuilderTrait;

    protected mixed $modelClass = Role::class;

    /**
     * Display a listing of roles
     */
    public function index(Request $request)
    {
        Gate::authorize('roles.view');

        $query = $this->defaultQuery($request);
        $query->with('permissions');

        return $this->withPagination($query, $request);
    }

    /**
     * Store a newly created role
     */
    public function store(Request $request)
    {
        Gate::authorize('roles.create');

        $request->validate([
            'name' => 'required|string|unique:roles,name|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role = Role::create(['name' => $request->name, 'guard_name' => 'api']);

        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }

        $role->load('permissions');

        return okResponse($role, 201);
    }

    /**
     * Display the specified role
     */
    public function show($id)
    {
        Gate::authorize('roles.view');

        $role = Role::with('permissions')->findOrFail($id);

        return okResponse($role);
    }

    /**
     * Update the specified role
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('roles.update');

        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role->update(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        $role->load('permissions');

        return okResponse($role);
    }

    /**
     * Remove the specified role
     */
    public function destroy($id)
    {
        Gate::authorize('roles.delete');

        $role = Role::findOrFail($id);

        // Prevent deleting admin role
        if ($role->name === 'admin') {
            return errorResponse(message: 'Cannot delete admin role', status: 403);
        }

        $role->delete();

        return okResponse(['message' => 'Role deleted successfully']);
    }
}
