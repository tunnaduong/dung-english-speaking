<?php

namespace App\Controllers;

use App\Models\Roles;
use App\Models\Employee;
use App\Models\Schedule;
use App\Models\InfoEmployee;

class AdminController extends Controller
{
    public $infoEmployee;
    public $roles;
    public $employee;
    public $schedule;

    public function __construct()
    {
        $this->infoEmployee = new InfoEmployee();
        $this->roles = new Roles();
        $this->employee = new Employee();
        $this->schedule = new Schedule();
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
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'gender' => 'required',
                'personal_id' => 'required|min:8|max:12',
                'DoB' => 'required',
                'address' => 'required',
                'phone' => 'required|min:10|max:11',
                'role_id' => 'required',
            ];

            if (!request()->validate($rules, $_POST)) {
                return back();
            }

            $data = request()->post();

            $data['status'] = 'Working';

            $email = $data['email'];

            // Remove the 'email' field from the $data array
            unset($data['email']);
            unset($data['address']);

            $uid = $this->infoEmployee->create($data);
            $this->employee->create([
                'user_id' => $uid,
                'email' => $email,
                'password' => '123',
            ]);
            return redirect('/employees');
        }
        $roles = $this->roles->all();
        return view('admin.employees--add', compact('roles'));
    }

    public function editEmployee($id)
    {
        if (request()->isMethod('post')) {
            $data = request()->post();
            $email = $data['email'];
            unset($data['email']);
            unset($data['address']);
            $this->employee->update(['email' => $email], ['user_id' => $id]);
            $this->infoEmployee->update($data, ['id' => $id]);
            return redirect('/employees');
        }
        $employee = $this->infoEmployee->find(['id' => $id]);
        $emp = $this->employee->find(['user_id' => $id]);
        $roles = $this->roles->all();
        return view('admin.employees--edit', compact('employee', 'emp', 'id', 'roles'));
    }

    public function deleteEmployee($id)
    {
        $this->infoEmployee->delete(['id' => $id]);
        return redirect('/employees');
    }

    public function schoolShift()
    {
        $shifts = $this->schedule->all();
        return view('admin.school-shift', compact('shifts'));
    }

    public function addSchoolShift()
    {
        if (request()->isMethod('post')) {
            $data = request()->post();
            $rules = [
                'start_time' => 'required',
                'end_time' => 'required',
            ];
            if (!request()->validate($rules, $data)) {
                return back();
            }
            $data['day_of_week'] = "";
            $this->schedule->create($data);
            return redirect('/school-shift');
        }
        return view('admin.school-shift--add');
    }

    public function editSchoolShift($id)
    {
        if (request()->isMethod('post')) {
            $data = request()->post();
            $rules = [
                'start_time' => 'required',
                'end_time' => 'required',
            ];
            if (!request()->validate($rules, $data)) {
                return back();
            }
            $this->schedule->update($data, ['id' => $id]);
            return redirect('/school-shift');
        }
        $shift = $this->schedule->find(['id' => $id]);
        return view('admin.school-shift--edit', compact('shift'));
    }

    public function deleteSchoolShift($id)
    {
        $this->schedule->delete(['id' => $id]);
        return redirect('/school-shift');
    }
}
