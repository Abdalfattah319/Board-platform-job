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

if (! $c || ! $cat) {
    echo "Missing company or category. Company: ".($c? $c->id : 'null')." Category: ".($cat? $cat->id : 'null')."\n";
    exit(1);
}

$payload = [
    'title' => 'Test Job '.time(),
    'description' => 'Test description',
    'requirements' => 'Requirement 1\nRequirement 2',
    'type' => 'remote', // using enum key
    'location' => 'Remote',
    'salary_min' => 100,
    'companie_id' => $c->id,
    'categorie_id' => $cat->id,
];

$job = Job::create($payload);
if ($job) {
    echo "Created Job id={$job->id} type={$job->type} companie_id={$job->companie_id}\n";
    exit(0);
}

echo "Failed to create job\n";
exit(1);
