<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\Department;
use App\Models\Dependent;
use App\Models\Employee;
use App\Models\Job;
use App\Models\Location;
use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class EmployeeDatabaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_hr_schema_and_eloquent_relationships_are_available(): void
    {
        foreach (['regions', 'countries', 'locations', 'departments', 'jobs', 'employees', 'dependents'] as $table) {
            $this->assertTrue(Schema::hasTable($table));
        }

        foreach (['users', 'password_reset_tokens', 'sessions', 'cache', 'cache_locks', 'queue_jobs', 'job_batches', 'failed_jobs'] as $table) {
            $this->assertTrue(Schema::hasTable($table));
        }

        $region = Region::create(['region_name' => 'Americas']);
        $country = Country::create([
            'country_id' => 'US',
            'country_name' => 'United States',
            'region_id' => $region->region_id,
        ]);
        $location = Location::create([
            'city' => 'Seattle',
            'country_id' => $country->country_id,
        ]);
        $department = Department::create([
            'department_name' => 'Engineering',
            'location_id' => $location->location_id,
        ]);
        $job = Job::create([
            'job_title' => 'Developer',
            'min_salary' => 50000,
            'max_salary' => 100000,
        ]);
        $manager = Employee::create([
            'last_name' => 'Manager',
            'email' => 'manager@example.test',
            'hire_date' => '2025-01-01',
            'salary' => 90000,
            'job_id' => $job->job_id,
            'department_id' => $department->department_id,
        ]);
        $employee = Employee::create([
            'last_name' => 'Employee',
            'email' => 'employee@example.test',
            'hire_date' => '2025-02-01',
            'salary' => 70000,
            'manager_id' => $manager->employee_id,
            'department_id' => $department->department_id,
        ]);
        $dependent = Dependent::create([
            'first_name' => 'Alex',
            'last_name' => 'Employee',
            'relationship' => 'Child',
            'employee_id' => $employee->employee_id,
        ]);

        $this->assertTrue($employee->manager->is($manager));
        $this->assertTrue($manager->reports->contains($employee));
        $this->assertTrue($employee->department->is($department));
        $this->assertTrue($employee->dependents->contains($dependent));
        $this->assertTrue($department->location->is($location));
        $this->assertTrue($location->country->is($country));
        $this->assertTrue($country->region->is($region));
        $this->assertTrue($job->employees->contains($manager));
    }
}
