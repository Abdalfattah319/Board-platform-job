<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Job;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_view_jobs_page()
    {
        $response = $this->get('/jobs');
        
        $response->assertStatus(200);
        $response->assertSee('الوظائف');
    }

    /** @test */
    public function it_can_create_a_job_as_employer()
    {
        $user = User::factory()->create(['role' => 'employer']);
        $company = Company::factory()->create(['user_id' => $user->id]);
        
        $jobData = [
            'title' => 'Software Developer',
            'description' => 'We are looking for a skilled developer...',
            'requirements' => 'PHP, Laravel, MySQL',
            'type' => 'full_time',
            'location' => 'Remote',
            'company_id' => $company->id,
        ];

        $response = $this->actingAs($user)
            ->post('/jobs', $jobData);

        $response->assertRedirect('/jobs');
        $this->assertDatabaseHas('jobs', $jobData);
    }

    /** @test */
    public function it_cannot_create_a_job_as_applicant()
    {
        $user = User::factory()->create(['role' => 'applicant']);
        
        $jobData = [
            'title' => 'Software Developer',
            'description' => 'Test description',
        ];

        $response = $this->actingAs($user)
            ->post('/jobs', $jobData);

        $response->assertStatus(403); // Forbidden
    }

    /** @test */
    public function it_cannot_create_a_job_as_guest()
    {
        $jobData = [
            'title' => 'Software Developer',
            'description' => 'Test description',
        ];

        $response = $this->post('/jobs', $jobData);

        $response->assertRedirect('/login');
    }

    /** @test */
    public function it_can_view_single_job()
    {
        $job = Job::factory()->create(['is_active' => true]);
        
        $response = $this->get("/jobs/{$job->slug}");
        
        $response->assertStatus(200);
        $response->assertSee($job->title);
        $response->assertSee($job->description);
    }

    /** @test */
    public function it_can_filter_jobs_by_type()
    {
        Job::factory()->create(['type' => 'full_time', 'is_active' => true]);
        Job::factory()->create(['type' => 'part_time', 'is_active' => true]);
        
        $response = $this->get('/jobs?type=full_time');
        
        $response->assertStatus(200);
        $response->assertSee('full_time');
    }

    /** @test */
    public function it_can_search_jobs()
    {
        Job::factory()->create(['title' => 'Senior Laravel Developer', 'is_active' => true]);
        Job::factory()->create(['title' => 'Frontend Developer', 'is_active' => true]);
        
        $response = $this->get('/jobs?search=Laravel');
        
        $response->assertStatus(200);
        $response->assertSee('Senior Laravel Developer');
        $response->assertDontSee('Frontend Developer');
    }

    /** @test */
    public function it_can_update_own_job()
    {
        $employer = User::factory()->create(['role' => 'employer']);
        $company = Company::factory()->create(['user_id' => $employer->id]);
        $job = Job::factory()->create([
            'user_id' => $employer->id,
            'company_id' => $company->id,
            'title' => 'Original Title'
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
    public function it_cannot_update_others_job()
    {
        $employer1 = User::factory()->create(['role' => 'employer']);
        $employer2 = User::factory()->create(['role' => 'employer']);
        $job = Job::factory()->create([
            'user_id' => $employer1->id,
            'title' => 'Original Title'
        ]);

        $updateData = [
            'title' => 'Updated Title',
        ];

        $response = $this->actingAs($employer2)
            ->patch("/jobs/{$job->id}", $updateData);

        $response->assertStatus(403); // Forbidden
    }

    /** @test */
    public function it_can_delete_own_job()
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
    public function it_cannot_delete_others_job()
    {
        $employer1 = User::factory()->create(['role' => 'employer']);
        $employer2 = User::factory()->create(['role' => 'employer']);
        $job = Job::factory()->create([
            'user_id' => $employer1->id,
        ]);

        $response = $this->actingAs($employer2)
            ->delete("/jobs/{$job->id}");

        $response->assertStatus(403); // Forbidden
    }

    /** @test */
    public function admin_can_manage_any_job()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $employer = User::factory()->create(['role' => 'employer']);
        $job = Job::factory()->create([
            'user_id' => $employer->id,
            'title' => 'Original Title'
        ]);

        $updateData = [
            'title' => 'Admin Updated Title',
        ];

        $response = $this->actingAs($admin)
            ->patch("/jobs/{$job->id}", $updateData);

        $response->assertRedirect('/jobs');
        $this->assertDatabaseHas('jobs', [
            'id' => $job->id,
            'title' => 'Admin Updated Title',
        ]);
    }

    /** @test */
    public function it_shows_only_active_jobs()
    {
        Job::factory()->create(['is_active' => false, 'title' => 'Inactive Job']);
        Job::factory()->create(['is_active' => true, 'title' => 'Active Job']);
        
        $response = $this->get('/jobs');
        
        $response->assertStatus(200);
        $response->assertSee('Active Job');
        $response->assertDontSee('Inactive Job');
    }
}
