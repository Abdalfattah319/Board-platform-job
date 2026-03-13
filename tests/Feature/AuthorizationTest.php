<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Job;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function employer_can_create_job()
    {
        $employer = User::factory()->create(['role' => 'employer']);
        
        $this->actingAs($employer)
            ->get('/jobs/create')
            ->assertStatus(200);
    }

    /** @test */
    public function admin_can_create_job()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        $this->actingAs($admin)
            ->get('/jobs/create')
            ->assertStatus(200);
    }

    /** @test */
    public function applicant_cannot_create_job()
    {
        $applicant = User::factory()->create(['role' => 'applicant']);
        
        $this->actingAs($applicant)
            ->get('/jobs/create')
            ->assertStatus(403);
    }

    /** @test */
    public function guest_cannot_create_job()
    {
        $this->get('/jobs/create')
            ->assertRedirect('/login');
    }

    /** @test */
    public function job_owner_can_update_job()
    {
        $employer = User::factory()->create(['role' => 'employer']);
        $company = Company::factory()->create(['user_id' => $employer->id]);
        $job = Job::factory()->create([
            'user_id' => $employer->id,
            'company_id' => $company->id,
        ]);

        $this->actingAs($employer)
            ->get("/jobs/{$job->id}/edit")
            ->assertStatus(200);
    }

    /** @test */
    public function job_owner_can_delete_job()
    {
        $employer = User::factory()->create(['role' => 'employer']);
        $company = Company::factory()->create(['user_id' => $employer->id]);
        $job = Job::factory()->create([
            'user_id' => $employer->id,
            'company_id' => $company->id,
        ]);

        $this->actingAs($employer)
            ->delete("/jobs/{$job->id}")
            ->assertRedirect('/jobs');
    }

    /** @test */
    public function non_owner_cannot_update_job()
    {
        $employer1 = User::factory()->create(['role' => 'employer']);
        $employer2 = User::factory()->create(['role' => 'employer']);
        $job = Job::factory()->create([
            'user_id' => $employer1->id,
        ]);

        $this->actingAs($employer2)
            ->get("/jobs/{$job->id}/edit")
            ->assertStatus(403);
    }

    /** @test */
    public function non_owner_cannot_delete_job()
    {
        $employer1 = User::factory()->create(['role' => 'employer']);
        $employer2 = User::factory()->create(['role' => 'employer']);
        $job = Job::factory()->create([
            'user_id' => $employer1->id,
        ]);

        $this->actingAs($employer2)
            ->delete("/jobs/{$job->id}")
            ->assertStatus(403);
    }

    /** @test */
    public function admin_can_manage_any_job()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $employer = User::factory()->create(['role' => 'employer']);
        $job = Job::factory()->create([
            'user_id' => $employer->id,
        ]);

        // Admin can edit any job
        $this->actingAs($admin)
            ->get("/jobs/{$job->id}/edit")
            ->assertStatus(200);

        // Admin can delete any job
        $this->actingAs($admin)
            ->delete("/jobs/{$job->id}")
            ->assertRedirect('/jobs');
    }

    /** @test */
    public function applicant_cannot_manage_jobs()
    {
        $applicant = User::factory()->create(['role' => 'applicant']);
        $employer = User::factory()->create(['role' => 'employer']);
        $job = Job::factory()->create([
            'user_id' => $employer->id,
        ]);

        // Applicant cannot edit jobs
        $this->actingAs($applicant)
            ->get("/jobs/{$job->id}/edit")
            ->assertStatus(403);

        // Applicant cannot delete jobs
        $this->actingAs($applicant)
            ->delete("/jobs/{$job->id}")
            ->assertStatus(403);
    }
}
