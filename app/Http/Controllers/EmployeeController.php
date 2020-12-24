<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Employee;
use GuzzleHttp\Client;
use Carbon\Carbon;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get employees
        $employees = Employee::paginate(10);

        return view('employees',compact('employees'));

    }

    //get data from API and store it in database
    public function getData()
    {
        $devCredentials = array(
            "grant_type" => "password",
            "client_id" => "6779ef20e75817b79601",
            "client_secret" => "3e0f85f44b9ffbc87e90acf40d482601",
            "username" => "hiring",
            "password" => "cosmicdev"
        );

        //get token
        $client = new Client();
        $response = $client->request('POST', 'http://technical_test.client.cosmicdevelopment.com/api/token/',[
            'json' => $devCredentials
        ]);
        $getToken = json_decode($response->getBody()->getContents(), true);
        $token = $getToken['data']['access_token'];

        //get data from API
        $client = new Client();
        $response = $client->request('GET', 'http://technical_test.client.cosmicdevelopment.com/api/employee/list/', [
            'headers' => [
                'Access-Token' => $token,
                'Content-Type' => 'application/json',
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        //insert data in Database
        $items = $data['data'];
        foreach($items as $item) {
            $employee = new Employee();
            $employee->employee_id = $item['id'];
            $employee->date_of_birth = $item['date_of_birth'];
            $employee->image = $item['image'];
            $employee->email = $item['email'];
            $employee->first_name = $item['first_name'];
            $employee->last_name = $item['last_name'];
            $employee->title = $item['title'];
            $employee->address = $item['address'];
            $employee->country = $item['country'];
            $employee->bio = $item['bio'];
            $employee->rating = $item['rating'];
            $user = Employee::where('email', '=', $employee->email)->first();
            if ($user === null) {
                // user doesn't exist
                $employee->save();

            }else{
                echo ' postoj kopileto';
            }
        }
    }
}
