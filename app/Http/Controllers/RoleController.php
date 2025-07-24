<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Services\RoleService;
use Faker\Extension\Extension;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->roleService->getAllRole();

        return Inertia::render('role/index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(RoleRequest $request)
    {
        try {
            $data = $request->validated();
            $this->roleService->createRole($data);

            return redirect()->back();
        } catch (Extension $e) {
            Log::error($e);

            return redirect()->back();
        }
    }


    // RoleController.php
    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            $role = Role::findOrFail($id);
            $role->update($data);

            return response()->json(['message' => 'Cập nhật vai trò thành công.']);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Lỗi khi cập nhật vai trò.'], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $roleId)
    {
        try{
            $role = Role::find($roleId);
            $role->delete();

            return response()->json(['message' => 'Cập nhật vai trò thành công.']);

        } catch (Extension $e) {

            return response()->json(['message' => 'Lỗi khi cập nhật vai trò.'], 500);

        }
    }
}
