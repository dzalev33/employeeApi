<?php

namespace App\Services;

use App\Employee;
use Carbon\Carbon;
use App\Http\Clients\EmployeesClient;


class EmployeesService {

    /**
     * EmployeesService constructor.
     * @var EmployeesClient
     */
    private $client;
    public function __construct(EmployeesClient $client)
    {
        $this->client = $client;
    }

    //get token
    public function getToken()
    {
        $devCredentials = config('employees');
        $response = $this->client->request('POST', 'api/token/',[
            'json' => $devCredentials
        ]);
        $getToken = json_decode($response->getBody()->getContents(), true);
        $token = $getToken['data']['access_token'];
        return $token;
    }

    //get data from API
    public function getData()
    {
       $token = $this->getToken();
        $response = $this->client->request('GET', 'api/employee/list/', [
            'headers' => [
                'Access-Token' => $token,
                'Content-Type' => 'application/json',
            ],
        ]);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data;
    }

    //prepare collection
    public function preparedData()
    {
        $data = $this->getData();
        $timestamp = Carbon::now()->toDateTimeString();
        $prepared = collect($data['data'])->map(function($item) use ($timestamp) {
            $employee = new Employee();
            $employee->employee_id = $item['id'] ;
            $item['created_at'] = $timestamp;
            $item['updated_at'] = $timestamp;
            return $item;
        });

        return $prepared;
    }

    //check if data exists in database
    public function checkIfDataExistsInDatabase(){
        $data = $this->getData();
        $prepared = collect($data['data'])->map(function($item){
            $employee = new Employee();
            $employee->employee_id = $item['id'] ;
            return $item['id'];
        });

        if (Employee::where('id', '=', $prepared)->exists()) {
           return true;
        }else{
            return false;
        }
    }

    //insert data in database
    public function insertData()
    {
        $prepared =  $this->preparedData();
        if (!$this->checkIfDataExistsInDatabase()){
            Employee::insert($prepared->toArray());
        }
    }

    //get data from database
    public function getDataFromDatabase()
    {
             $this->insertData();
             return Employee::all();
    }
}