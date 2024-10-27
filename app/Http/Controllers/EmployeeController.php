<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // search user where role_id is not 1
        $employees = User::where('role_id', '!=', 1)->paginate(10);

        return view('dashboard.employee.index', [
            'nav' => 'Pegawai',
            'employees' => $employees
        ]);
    }
}
