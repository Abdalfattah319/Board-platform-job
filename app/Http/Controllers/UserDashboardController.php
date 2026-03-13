<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Application;
use App\Models\SavedJob;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    // public function index()
    // {
    //     $user = Auth::user();
        
    //     // التأكد من أن المستخدم باحث عمل
    //     if (!$user->is_applicant && !$user->is_employer) {
    //         return redirect()->route('dashboard')->with('error', 'غير مصرح لك بالوصول إلى هذه الصفحة');
    //     }
        
            
    //         // جلب طلبات المستخدم
    //         $applications = Application::where('user_id', $user->id)
    //             ->with(['job.company'])
    //             ->latest()
    //             ->paginate(5);
            
    //         // الإحصائيات الخاصة بالمستخدم
    //         $data = [
    //             'total_applications' => Application::where('user_id', $user->id)->count(),
    //             'pending_applications' => Application::where('user_id', $user->id)->where('status', 'applied')->count(),
    //             'under_review_applications' => Application::where('user_id', $user->id)->where('status', 'under_review')->count(),
    //             'shortlisted_applications' => Application::where('user_id', $user->id)->where('status', 'shortlisted')->count(),
    //             'hired_count' => Application::where('user_id', $user->id)->where('status', 'hired')->count(),
    //             'rejected_count' => Application::where('user_id', $user->id)->where('status', 'rejected')->count(),
    //             'saved_jobs' => SavedJob::where('user_id', $user->id)->count(),
    //         ];
            
    //         // جلب الوظائف المقترحة
    //         $suggestedJobs = Job::where('is_active', true)
    //             ->with('company')
    //             ->latest()
    //             ->take(3)
    //             ->get();
            
    //         return view('user.dashboard', compact('data', 'user', 'applications', 'suggestedJobs'));
    // }
}
