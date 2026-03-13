<?php

namespace Tests\Unit;

use App\Models\Job;
use App\Models\User;
use App\Models\Company;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JobModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function job_belongs_to_user()
    {
        $user = User::factory()->create();
        $job = Job::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $job->user);
        $this->assertEquals($user->id, $job->user->id);
    }

    /** @test */
    public function job_belongs_to_company()
    {
        $company = Company::factory()->create();
        $job = Job::factory()->create(['company_id' => $company->id]);

        $this->assertInstanceOf(Company::class, $job->company);
        $this->assertEquals($company->id, $job->company->id);
    }

    /** @test */
    public function job_has_many_applications()
    {
        $job = Job::factory()->create();
        $applications = $job->applications();

        $this->assertNotNull($applications);
    }

    /** @test */
    public function job_uses_slug_as_route_key()
    {
        $job = Job::factory()->create(['slug' => 'test-job-slug']);

        $this->assertEquals('slug', $job->getRouteKeyName());
    }

    /** @test */
    public function job_scope_active_returns_only_active_jobs()
    {
        Job::factory()->create(['is_active' => false]);
        Job::factory()->create(['is_active' => true]);

        $activeJobs = Job::active()->get();

        $this->assertCount(1, $activeJobs);
        $this->assertTrue($activeJobs->first()->is_active);
    }

    /** @test */
    public function job_scope_filter_works_correctly()
    {
        Job::factory()->create([
            'title' => 'Laravel Developer',
            'description' => 'Looking for Laravel expert',
            'type' => 'full_time',
            'location' => 'Riyadh'
        ]);

        $filteredJobs = Job::filter(['search' => 'Laravel'])->get();

        $this->assertCount(1, $filteredJobs);
        $this->assertStringContains('Laravel', $filteredJobs->first()->title);
    }

    /** @test */
    public function job_get_type_arabic_returns_correct_translation()
    {
        $job = Job::factory()->create(['type' => 'full_time']);
        $this->assertEquals('دوام كامل', $job->getTypeArabicAttribute());

        $job = Job::factory()->create(['type' => 'part_time']);
        $this->assertEquals('دوام جزئي', $job->getTypeArabicAttribute());

        $job = Job::factory()->create(['type' => 'remote']);
        $this->assertEquals('عن بعد', $job->getTypeArabicAttribute());

        $job = Job::factory()->create(['type' => 'contract']);
        $this->assertEquals('عقد', $job->getTypeArabicAttribute());
    }

    /** @test */
    public function job_similar_jobs_returns_correct_results()
    {
        $job = Job::factory()->create([
            'type' => 'full_time',
            'location' => 'Riyadh'
        ]);

        Job::factory()->create([
            'type' => 'part_time',
            'location' => 'Jeddah'
        ]);

        Job::factory()->create([
            'type' => 'full_time',
            'location' => 'Riyadh'
        ]);

        $similarJobs = $job->similarJobs(3);

        $this->assertLessThanOrEqual(3, $similarJobs->count());
        foreach ($similarJobs as $similarJob) {
            $this->assertNotEquals($job->id, $similarJob->id);
        }
    }
}
