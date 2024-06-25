<?php

namespace App\Http\Controllers\Profiles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ProfilesController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return response()->json(['data' => $roles]);
    }

    public function store(Request $request)
    {
        if (strpos($request->name, 'administrator') !== false || strpos($request->name, 'default') !== false) {
            throw new \Exception('There was an error. It is not possible to manipulate information related to administrator or default roles, nor assign new profiles named as administrators or default users in the system');
        }

        $data = $request->only(['name']);
        $permissions = $request->permissions;

        try {
            $role = Role::create($data);
            $role->givePermissionTo($permissions); // permissions
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'There was a problem registering the profile.',
                'success' => false,
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ], 500);
        }

        return response()->json(['data' => $role]);
    }

    public function show($id)
    {
        throw new \Exception('invalid route');
    }


    public function update(Request $request, $id)
    {
        if (strpos($request->name, 'administrator') !== false || strpos($request->name, 'default') !== false) {
            throw new \Exception('There was an error. It is not possible to manipulate information related to administrator or default roles, nor assign new profiles named as administrators or default users in the system');
        }

        $role = Role::findOrFail($id);
        $data = $request->only(['name']);
        $permissions = $request->permissions;

        try {

            foreach ($role->permissions as $permission) {
                $role->revokePermissionTo($permission->name);
            }

            $role->update($data);
            $role->givePermissionTo($permissions);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'There was a problem update the profile.',
                'success' => false,
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ], 500);
        }

        return response()->json(['data' => $role]);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        if (strpos($role->name, 'Administrator') !== false || strpos($role->name, 'User') !== false) {
            throw new \Exception('There was an error. It is not possible to manipulate information related to administrator or default roles, nor assign new profiles named as administrators or default users in the system');
        }

        try {
            // Deleting
            $role->delete();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'There was a problem destroy the profile.',
                'success' => false,
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ], 500);
        }
        
        return response()->json(['vacancy successfully deleted']);
    }
}
