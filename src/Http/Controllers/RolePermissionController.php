<?php

namespace Ajifatur\FaturCMS\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Ajifatur\FaturCMS\Models\Permission;
use Ajifatur\FaturCMS\Models\Role;
use Ajifatur\FaturCMS\Models\RolePermission;

class RolePermissionController extends Controller
{
    /**
     * Menampilkan data role permission
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check Access
        has_access(generate_method(__METHOD__), Auth::user()->role);

		// Get data permission
		$permissions = Permission::all();

        // Get data role
        $roles = Role::all();
        
        // View
        return view('faturcms::admin.role-permission.index', [
            'permissions' => $permissions,
            'roles' => $roles,
        ]);
    }

    /**
     * Mengupdate role permission
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Mengupdate role permission
        $role_permission = RolePermission::where('id_permission','=',$request->permission)->where('id_role','=',$request->role)->first();
        $role_permission->access = $request->access;
        $role_permission->save();
        
        echo 'Berhasil mengupdate hak akses!';
    }
}