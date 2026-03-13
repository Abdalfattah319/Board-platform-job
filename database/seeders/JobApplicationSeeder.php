<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class JobApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('ar_SA');
        
        $jobs = Job::all();
        $users = User::all();
        
        if ($users->count() < 5) {
            // Create some users if we don't have enough
            User::factory(10)->create();
            $users = User::all();
        }
        
        $statuses = ['pending', 'under_review', 'shortlisted', 'interviewed', 'offered', 'hired', 'rejected'];
        
        foreach ($jobs as $job) {
            // Each job will have 0-10 applications
            $applicationCount = rand(0, 10);
            
            // Get random users who haven't applied to this job yet
            $applicants = $users->random(min($applicationCount, $users->count()));
            
            foreach ($applicants as $applicant) {
                $status = $faker->randomElement($statuses);
                $appliedAt = $faker->dateTimeBetween($job->created_at, 'now');
                
                $application = JobApplication::create([
                    'job_id' => $job->id,
                    'user_id' => $applicant->id,
                    'resume_path' => 'resumes/sample-resume.pdf', // You need to have a sample resume in storage/app/public/resumes/
                    'cover_letter' => $this->generateCoverLetter($faker, $applicant, $job),
                    'status' => $status,
                    'applied_at' => $appliedAt,
                    'created_at' => $appliedAt,
                    'updated_at' => $appliedAt,
                ]);
                
                // Update application status history
                if ($status !== 'pending') {
                    $this->updateApplicationStatus($application, $status, $appliedAt);
                }
            }
        }
    }
    
    private function generateCoverLetter($faker, $user, $job): string
    {
        $name = $user->name;
        $jobTitle = $job->title;
        $companyName = $job->company->name;
        
        $coverLetter = "<p>السيد/ة مدير الموارد البشرية،</p>";
        $coverLetter .= "<p>تحية طيبة وبعد،</p>";
        $coverLetter .= "<p>أنا {$name}، أتقدم بطلب التقدم لشغل وظيفة <strong>{$jobTitle}</strong> المعلن عنها مؤخرًا في شركة {$companyName}.</p>";
        $coverLetter .= "<p>بعد الاطلاع على متطلبات الوظيفة، أعتقد أن لدي المؤهلات والخبرات المناسبة لهذا المنصب. لدي خبرة تزيد عن {$faker->numberBetween(1, 10)} سنوات في مجال ذي صلة، وأتمتع بمهارات قوية في {$faker->randomElement(['إدارة المشاريع', 'التطوير البرمجي', 'التسويق الرقمي', 'المبيعات', 'خدمة العملاء'])}.</p>";
        $coverLetter .= "<p>أعتقد أن خبرتي في {$faker->jobTitle} في {$faker->company} ستكون ذات قيمة مضافة لفريقكم. خلال فترة عملي السابقة، تمكنت من {$faker->randomElement([
            'زيادة المبيعات بنسبة 30% خلال 6 أشهر',
            'قيادة فريق مكون من 10 أفراد بنجاح',
            'تطوير استراتيجيات تسويقية ناجحة',
            'تحسين كفاءة العمليات بنسبة 40%',
            'إدارة مشاريع بقيمة تتجاوز مليون $'
        ])}.</p>";
        $coverLetter .= "<p>أنا متحمس للانضمام إلى فريق {$companyName} والمساهمة في نجاح الشركة. أنا واثق من أن مهاراتي وخبراتي تجعلني مرشحًا قويًا لهذه الوظيفة.</p>";
        $coverLetter .= "<p>أنا أتطلع إلى مناقشة كيف يمكنني المساهمة في فريقكم. شكرًا لوقتكم وتفهمكم.</p>";
        $coverLetter .= "<p>وتفضلوا بقبول فائق الاحترام،<br>{$name}</p>";
        
        return $coverLetter;
    }
    
    private function updateApplicationStatus($application, $status, $appliedAt): void
    {
        $statusHistory = [
            [
                'status' => 'pending',
                'changed_at' => $appliedAt,
                'notes' => 'تم تقديم الطلب'
            ]
        ];
        
        $statusOrder = [
            'pending' => 1,
            'under_review' => 2,
            'shortlisted' => 3,
            'interviewed' => 4,
            'offered' => 5,
            'hired' => 6,
            'rejected' => 6
        ];
        
        $currentStatusOrder = $statusOrder[$status];
        $currentDate = clone $appliedAt;
        
        // Add all status changes up to the current status
        foreach ($statusOrder as $statusKey => $order) {
            if ($order > 1 && $order <= $currentStatusOrder) {
                // Add some time between status changes (1-7 days)
                $currentDate = (clone $currentDate)->addDays(rand(1, 7));
                
                $statusHistory[] = [
                    'status' => $statusKey,
                    'changed_at' => $currentDate,
                    'notes' => $this->getStatusNote($statusKey)
                ];
            }
        }
        
        $application->update([
            'status_history' => json_encode($statusHistory),
            'updated_at' => $currentDate
        ]);
    }
    
    private function getStatusNote($status): string
    {
        $notes = [
            'under_review' => 'جاري مراجعة الطلب',
            'shortlisted' => 'تم اختيارك للقائمة المختصرة',
            'interviewed' => 'تم إجراء المقابلة',
            'offered' => 'تم تقديم عرض العمل',
            'hired' => 'تم التوظيف بنجاح',
            'rejected' => 'تم رفض الطلب'
        ];
        
        return $notes[$status] ?? 'تم تحديث حالة الطلب';
    }
}
