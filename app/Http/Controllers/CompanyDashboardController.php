<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Application;
use App\Models\Payment;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class CompanyDashboardController extends Controller
{
    // public function index()
    // {
    //     $user = Auth::user();
        
    //     // التأكد من أن المستخدم صاحب شركة
    //     if (!$user->is_employer && !$user->is_applicant) {
    //         return redirect()->route('dashboard.index')->with('error', 'غير مصرح لك بالوصول إلى هذه الصفحة');
    //     }
        
    //     // جلب وظائف الشركة
    //     $companyJobs = Job::where('user_id', $user->id)->pluck('id');
        
    //     // جلب طلبات التوظيف على وظائف الشركة
    //     $applications = Application::whereIn('job_id', $companyJobs)
    //         ->with(['user', 'job'])
    //         ->latest()
    //         ->paginate(5);
        
    //     // الإحصائيات الخاصة بالشركة
    //     $data = [
    //         'total_jobs' => Job::where('user_id', $user->id)->count(),
    //         'total_applications' => Application::whereIn('job_id', $companyJobs)->count(),
    //         'total_revenue' => Payment::where('status', 'completed')->sum('amount'),
    //         'hired_count' => Application::whereIn('job_id', $companyJobs)->where('status', 'hired')->count(),
    //         'under_review_count' => Application::whereIn('job_id', $companyJobs)->where('status', 'under_review')->count(),
    //         'rejected_count' => Application::whereIn('job_id', $companyJobs)->where('status', 'rejected')->count(),
    //     ];
        
    //     return view('company.dashboard', compact('data', 'user', 'applications'));
    // }
}
