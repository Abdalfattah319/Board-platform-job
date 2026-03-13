<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Job;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_displays_jobs_page()
    {
        Job::factory()->count(5);

        $response = $this->get('/jobs');

        $response->assertStatus(200);
        $response->assertViewIs('jobs.index');
    }

    /** @test */
    public function create_displays_create_form_for_authorized_users()
    {
        $employer = User::factory()->create(['role' => 'employer']);
        $admin = User::factory()->create(['role' => 'admin']);

        // Test employer access
        $response = $this->actingAs($employer)->get('/jobs/create');
        $response->assertStatus(200);
        $response->assertViewIs('jobs.create');

        // Test admin access
        $response = $this->actingAs($admin)->get('/jobs/create');
        $response->assertStatus(200);
        $response->assertViewIs('jobs.create');
    }

    /** @test */
    public function create_redirects_unauthorized_users()
    {
        $applicant = User::factory()->create(['role' => 'applicant']);

        $response = $this->actingAs($applicant)->get('/jobs/create');
        $response->assertStatus(403);
    }

    /** @test */
    public function store_creates_job_for_authorized_users()
    {
        $employer = User::factory()->create(['role' => 'employer']);
        $company = Company::factory()->create(['user_id' => $employer->id]);

        $jobData = [
            'title' => 'Software Developer',
            'description' => 'We are looking for a skilled developer...',
            'requirements' => 'PHP, Laravel, MySQL',
            'type' => 'full_time',
            'location' => 'Remote',
            'salary_min' => 5000,
            'salary_max' => 10000,
            'company_id' => $company->id,
        ];

        $response = $this->actingAs($employer)
            ->post('/jobs', $jobData);

        $response->assertRedirect('/jobs');
        $this->assertDatabaseHas('jobs', [
            'title' => 'Software Developer',
            'user_id' => $employer->id,
        ]);
    }

    /** @test */
    public function store_fails_for_unauthorized_users()
    {
        $applicant = User::factory()->create(['role' => 'applicant']);

        $jobData = [
            'title' => 'Software Developer',
            'description' => 'Test description',
        ];

        $response = $this->actingAs($applicant)
            ->post('/jobs', $jobData);

        $response->assertStatus(403);
    }

    /** @test */
    public function show_displays_job_details()
    {
        $job = Job::factory()->create(['is_active' => true]);

        $response = $this->get("/jobs/{$job->slug}");

        $response->assertStatus(200);
        $response->assertViewIs('jobs.show');
        $response->assertViewHas('job');
    }

    /** @test */
    public function show_returns_404_for_nonexistent_job()
    {
        $response = $this->get('/jobs/nonexistent-job');

        $response->assertStatus(404);
    }

    /** @test */
    public function edit_displays_edit_form_for_job_owner()
    {
        $employer = User::factory()->create(['role' => 'employer']);
        $company = Company::factory()->create(['user_id' => $employer->id]);
        $job = Job::factory()->create([
            'user_id' => $employer->id,
            'company_id' => $company->id,
        ]);

        $response = $this->actingAs($employer)
            ->get("/jobs/{$job->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('jobs.edit');
        $response->assertViewHas('job');
    }

    /** @test */
    public function edit_returns_403_for_non_owner()
    {
        $employer1 = User::factory()->create(['role' => 'employer']);
        $employer2 = User::factory()->create(['role' => 'employer']);
        $job = Job::factory()->create(['user_id' => $employer1->id]);

        $response = $this->actingAs($employer2)
            ->get("/jobs/{$job->id}/edit");

        $response->assertStatus(403);
    }

    /** @test */
    public function update_modifies_job_for_owner()
    {
        $employer = User::factory()->create(['role' => 'employer']);
        $company = Company::factory()->create(['user_id' => $employer->id]);
        $job = Job::factory()->create([
            'user_id' => $employer->id,
            'company_id' => $company->id,
            'title' => 'Original Title',
        ]);

        $updateData = [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
        ];

        $response = $this->actingAs($employer)
            ->patch("/jobs/{$job->id}", $updateData);

        $response->assertRedirect('/jobs');
        $this->assertDatabaseHas('jobs', [
            'id' => $job->id,
            'title' => 'Updated Title',
        ]);
    }

    /** @test */
    public function update_fails_for_non_owner()
    {
        $employer1 = User::factory()->create(['role' => 'employer']);
        $employer2 = User::factory()->create(['role' => 'employer']);
        $job = Job::factory()->create(['user_id' => $employer1->id]);

        $updateData = [
            'title' => 'Updated Title',
        ];

        $response = $this->actingAs($employer2)
            ->patch("/jobs/{$job->id}", $updateData);

        $response->assertStatus(403);
    }

    /** @test */
    public function delete_removes_job_for_owner()
    {
        $employer = User::factory()->create(['role' => 'employer']);
        $company = Company::factory()->create(['user_id' => $employer->id]);
        $job = Job::factory()->create([
            'user_id' => $employer->id,
            'company_id' => $company->id,
        ]);

        $response = $this->actingAs($employer)
            ->delete("/jobs/{$job->id}");

        $response->assertRedirect('/jobs');
        $this->assertDatabaseMissing('jobs', [
            'id' => $job->id,
        ]);
    }

    /** @test */
    public function delete_fails_for_non_owner()
    {
        $employer1 = User::factory()->create(['role' => 'employer']);
        $employer2 = User::factory()->create(['role' => 'employer']);
        $job = Job::factory()->create(['user_id' => $employer1->id]);

        $response = $this->actingAs($employer2)
            ->delete("/jobs/{$job->id}");

        $response->assertStatus(403);
    }

    /** @test */
    public function admin_can_manage_any_job()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $employer = User::factory()->create(['role' => 'employer']);
        $job = Job::factory()->create(['user_id' => $employer->id]);

        // Admin can edit
        $response = $this->actingAs($admin)
            ->get("/jobs/{$job->id}/edit");
        $response->assertStatus(200);

        // Admin can update
        $updateData = ['title' => 'Admin Updated'];
        $response = $this->actingAs($admin)
            ->patch("/jobs/{$job->id}", $updateData);
        $response->assertRedirect('/jobs');

        // Admin can delete
        $response = $this->actingAs($admin)
            ->delete("/jobs/{$job->id}");
        $response->assertRedirect('/jobs');
    }
}
