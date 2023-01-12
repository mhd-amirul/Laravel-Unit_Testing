<?php

namespace Tests\Feature\V2;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppEmployeeTest extends TestCase
{

    use RefreshDatabase;

    public function createEmployee($create = "", $data = [])
    {
        return Employee::factory($create)->create($data);
    }

    public function createNewEmployee($employee, $create = "", $data = [])
    {
        $employee->add(User::factory($create)->create($data));

        return $employee;
    }

    /** @test */
    public function employee_has_a_name()
    {
        $employee = $this->createEmployee(["name" => "Agus"]);

        $this->assertEquals("Agus", $employee->name);
    }

    /** @test */
    public function Employee_can_add_new_employee()
    {
        $employee = $this->createEmployee();

        $employee = $this->createNewEmployee($employee);
        $employee = $this->createNewEmployee($employee);

        $this->assertEquals(2, $employee->count());
    }

    /** @test */
    public function check_maximum_size_employer_has_reached()
    {
        $employee = $this->createEmployee("" , ["size" => 2]);

        $employee = $this->createNewEmployee($employee);
        $employee = $this->createNewEmployee($employee);

        $this->assertEquals(2, $employee->count());

        $this->expectException("Exception");

        $employee = $this->createNewEmployee($employee);
    }

    /** @test */
    public function Employee_can_add_many_new_employee_at_once()
    {
        $employee = $this->createEmployee();

        $employee = $this->createNewEmployee($employee, 2);

        $this->assertEquals(2, $employee->count());
    }

    /** @test */
    public function Employee_can_remove_employee()
    {
        $employee = $this->createEmployee();

        $users = User::factory(2)->create();

        $employee->add($users);

        $employee->remove($users[0]);

        $this->assertEquals(1, $employee->count());
    }

    /** @test */
    public function Employee_can_remove_employee_more_than_one_at_once()
    {
        $employee = $this->createEmployee();

        $users = User::factory(3)->create();

        $employee->add($users);

        $employee->remove($users->slice(0, 2));

        $this->assertEquals(1, $employee->count());
    }

    /** @test */
    public function Employee_can_remove_many_employee_at_once()
    {
        $employee = $this->createEmployee();

        $employee = $this->createNewEmployee($employee, 2);

        $employee->restart();

        $this->assertEquals(0, $employee->count());
    }
}
