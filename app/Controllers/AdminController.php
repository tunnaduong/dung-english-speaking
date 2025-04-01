<?php

namespace App\Controllers;

use App\Models\InfoEmployee;

class AdminController extends Controller
{
    public $infoEmployee;

    public function __construct()
    {
        $this->infoEmployee = new InfoEmployee();
    }

    public function employees()
    {
        $employees = $this->infoEmployee->join('roles', 'info_employee.role_id = roles.role_id', 'INNER')
            ->get();
        return view('admin.employees', compact('employees'));
    }

    public function addEmployee()
    {
        if (request()->isMethod('post')) {
            $data = request()->post();
            $this->infoEmployee->create($data);
            return redirect('/employees');
        }
        return view('admin.employees--add');
    }

    public function editEmployee($id)
    {
        if (request()->isMethod('post')) {
            $data = request()->post();
            $this->infoEmployee->update($data, $id);
            return redirect('/employees');
        }
        $employee = $this->infoEmployee->find(['id' => $id]);
        return view('admin.employees--edit', compact('employee'));
    }

    public function deleteEmployee($id)
    {
        $this->infoEmployee->delete(['id' => $id]);
        return redirect('/employees');
    }
}
