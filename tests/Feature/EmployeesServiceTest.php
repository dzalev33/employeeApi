<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Services\EmployeesService;


Class EmployeesServiceTest extends TestCase
{

    /**
     * @var EmployeesService
     */
    private $employeesService;

    protected function setUp()
    {

        parent::setUp();

        $this->EmployeesService = app(EmployeesService::class);

    }

    /* @test */
    public function test_FetchingData()
    {

        $results = $this->EmployeesService->getData();
//        $this->assertCount(10,$results);

    }


}