<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use App\Models\Application; // Fixed: Changed from lowercase 'application' to proper class name 'Application'
use App\Models\Payment;
use App\Models\SavedJob;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller // Fixed: Class name corrected from 'DashbordController' to 'DashboardController'
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = Auth::user();
        if ($user->is_admin) 
        {
        
        
            $applications = Application::with(['user','job'])->latest()->paginate(5);

            $data = [
                'total_user' => User::count(),
                'total_application' => Application::count(), // Fixed: Updated to use proper class name
                'total_revenue' => Payment::where('status', 'completed')->sum('amount'),
                'under_review'=>   Application::where('status','under_review')->count(), // Fixed: Updated to use proper class name
                'user' => $user,
                'applications' => $applications
            ];

            return view('dashboard', compact('data','user','applications'));        
        }elseif($user->is_employer){
                
    //     // جلب وظائف الشركة
        $companyJobs = Job::where('user_id', $user->id)->pluck('id');
        
        // جلب طلبات التوظيف على وظائف الشركة
        $applications = Application::whereIn('job_id', $companyJobs)
            ->with(['user', 'job'])
            ->latest()
            ->paginate(5);
        
        // الإحصائيات الخاصة بالشركة
        $data = [
            'total_jobs' => Job::where('user_id', $user->id)->count(),
            'total_applications' => Application::whereIn('job_id', $companyJobs)->count(),
            'total_revenue' => Payment::where('status', 'completed')->sum('amount'),
            'hired_count' => Application::whereIn('job_id', $companyJobs)->where('status', 'hired')->count(),
            'under_review_count' => Application::whereIn('job_id', $companyJobs)->where('status', 'under_review')->count(),
            'rejected_count' => Application::whereIn('job_id', $companyJobs)->where('status', 'rejected')->count(),
        ];
        
        return view('company.dashboard', compact('data', 'user', 'applications'));
    

        }elseif($user->is_applicant){
                    
            // جلب طلبات المستخدم
            $applications = Application::where('user_id', $user->id)
                ->with(['job.company'])
                ->latest()
                ->paginate(5);
            
            // الإحصائيات الخاصة بالمستخدم
            $data = [
                'total_applications' => Application::where('user_id', $user->id)->count(),
                'pending_applications' => Application::where('user_id', $user->id)->where('status', 'applied')->count(),
                'under_review_applications' => Application::where('user_id', $user->id)->where('status', 'under_review')->count(),
                'shortlisted_applications' => Application::where('user_id', $user->id)->where('status', 'shortlisted')->count(),
                'hired_count' => Application::where('user_id', $user->id)->where('status', 'hired')->count(),
                'rejected_count' => Application::where('user_id', $user->id)->where('status', 'rejected')->count(),
                'saved_jobs' => SavedJob::where('user_id', $user->id)->count(),
            ];
            
            // جلب الوظائف المقترحة
            $suggestedJobs = Job::where('is_active', true)
                ->with('company')
                ->latest()
                ->take(3)
                ->get();
            
            // التأكد من أن البيانات موجودة
            if($suggestedJobs->isEmpty()) {
                $suggestedJobs = collect([]);
            }
            
            return view('user.dashboard', compact('data', 'user', 'applications', 'suggestedJobs'));
    
        }else{
            return redirect()->route('login')->with('error', 'غير مصرح لك بالوصول إلى هذه الصفحة');
        }
    }

    // public function index()
    // {
    //     $user = Auth::user();
    //     $users=User::with('isEmployer');
        
        
        
    //     if ($users) {
    //         // Dashboard صاحب الشركة
    //         $jobs = Job::where('user_id', $user->id)->pluck('id');
    //         $applications = Application::whereIn('job_id', $jobs)->with(['user', 'job'])->latest()->paginate(5);
            
    //         $data = [
    //             'total_jobs' => Job::where('user_id', $user->id)->count(),
    //             'total_applications' => Application::whereIn('job_id', $jobs)->count(),
    //             'total_revenue' => Payment::where('status', 'completed')->sum('amount'),
    //             'hired_count' => Application::whereIn('job_id', $jobs)->where('status', 'hired')->count(),
    //         ];
            
    //     } else {
    //         // Dashboard الباحث عن عمل
    //         $applications = Application::where('user_id', $user->id)->with(['job.company'])->latest()->paginate(5);
            
    //         $data = [
    //             'total_applications' => Application::where('user_id', $user->id)->count(),
    //             'pending_applications' => Application::where('user_id', $user->id)->where('status', 'applied')->count(),
    //             'hired_count' => Application::where('user_id', $user->id)->where('status', 'hired')->count(),
    //             'saved_jobs' => SavedJob::where('user_id', $user->id)->count(),
    //         ];
    //     }
        
    //     return view('dashboard', compact('data', 'user', 'applications'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
