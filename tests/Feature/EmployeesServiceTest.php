<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Services\EmployeesService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
Class EmployeesServiceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var EmployeesService
     */
    private $employeesService;

    protected function setUp()
    {

        parent::setUp();

        $this->EmployeesService = app(EmployeesService::class);

    }

    /** @test */
    public function test_a_user_can_view_all_employees()
    {
        $response = $this->get('/');
        $response->assertSee('200');
    }

    /** @test */
    public function test_FetchingData()
    {

        $results = $this->EmployeesService->getData();
        self::assertCount(3,$results);

    }


}