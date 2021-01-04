<?php

namespace App\Http\Controllers;
use App\Services\EmployeesService;
use App\Http\Requests;

class EmployeeController extends Controller
{

    protected $employeesService;

    public function __construct(EmployeesService $employeesService)
    {
        $this->employeesService = $employeesService;
    }

    public function index()
    {
        return $this->employeesService->insertData();
    }
}

