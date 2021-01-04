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
    public function __construct(EmployeesClient $client){

        $this->client = $client;

    }

    public function getToken(){

        $devCredentials = array(
            "grant_type" => "password",
            "client_id" => "6779ef20e75817b79601",
            "client_secret" => "3e0f85f44b9ffbc87e90acf40d482601",
            "username" => "hiring",
            "password" => "cosmicdev"
        );

        //get token

        $response = $this->client->request('POST', 'api/token/',[
            'json' => $devCredentials
        ]);
        $getToken = json_decode($response->getBody()->getContents(), true);
        $token = $getToken['data']['access_token'];
        return $token;
    }

    //get data from API and store it in database
    public function getData()
    {
       $token = $this->getToken();

        //get data from API

        $response = $this->client->request('GET', 'api/employee/list/', [
            'headers' => [
                'Access-Token' => $token,
                'Content-Type' => 'application/json',
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
        $timestamp = Carbon::now()->toDateTimeString();

        $prepared = collect($data['data'])->map(function($item) use ($timestamp) {
            $employee = new Employee();
            $employee->employee_id = $item['id'] ;
            $item['created_at'] = $timestamp;
            $item['updated_at'] = $timestamp;
            return $item;
        });


        //insert in database
        Employee::insert($prepared->toArray());


    }

}