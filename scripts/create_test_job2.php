<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Job;
use App\Models\Company;
use App\Models\Category;

$c = Company::first();
$cat = Category::first();

if (! $c) {
    echo "Missing company.\n";
    exit(1);
}

$payload = [
    'title' => 'Test Job 2 '.time(),
    'description' => 'Test description',
    'requirements' => 'Req1\nReq2',
    'type' => 'remote',
    'location' => 'Remote',
    'salary' => '1000',
    'company_id' => $c->id,
    'user_id' => $c->user_id ?? 1,
    'slug' => 'test-job-'.time(),
];

$job = Job::create($payload);
if ($job) {
    echo "Created Job id={$job->id} type={$job->type} company_id={$job->company_id}\n";
    exit(0);
}

echo "Failed to create job\n";
exit(1);
