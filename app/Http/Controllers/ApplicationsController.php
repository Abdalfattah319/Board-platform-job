<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApplicationsController extends Controller
{
    public function index(Job $job = null)
    {
        $query = Application::with(['job.company', 'user']);
        
        // إذا كان هناك معرف وظيفة، نركز على طلبات هذه الوظيفة
        if ($job) {
            $query->where('job_id', $job->id);
        } else {
            // عرض جميع التقديمات للمستخدم الحالي
            if (auth()->user()->role === 'admin') {
                // Admin يرى كل شيء
                // لا يوجد filter
            } elseif (auth()->user()->is_company) {
                // Employer يرى تقديمات وظائفه فقط
                $query->whereHas('job', function($q) {
                    $q->where('user_id', auth()->id());
                });
            } else {
                // Applicant يرى تقديماته فقط
                $query->where('user_id', auth()->id());
            }
        }
        
        $applications = $query->latest()->paginate(10);
        
        return view('applications.index', compact('applications', 'job'));
    }
    
    public function create(Job $job, User $user, Application $Applications)
    {
        return view('applications.create',compact('job','user','Applications'));
    }
   
    public function store(Request $request, Job $job)
   {
        $validated = $request->validate([
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);
        
        $validated['user_id'] = auth()->id();
        $validated['job_id'] = $job->id;
        $validated['status'] = 'applied';
        
        if ($request->hasFile('resume')) {
            $path = $request->file('resume')->store('resumes', 'public');
            $validated['resume'] = $path;
        }
        
        Application::create($validated);
            return redirect()
            ->route('jobs.show', $job)
            ->with('success', 'تم التقديم بنجاح');
    }
    public function updateStatus(Request $request, Application $application, $status)
    {
        // التحقق من أن الحالة صالحة
        $validStatuses = ['applied', 'under_review', 'shortlisted', 'rejected', 'hired'];
        
        if (!in_array($status, $validStatuses)) {
            return back()->with('error', 'حالة غير صالحة');
        }

        $application->update([
            'status' => $status
        ]);

        return back()->with('success', 'تم تحديث حالة الطلب');
    }

    
    public function show(Job $job, Application $application)
    {
        // التحقق من الصلاحيات
        if (auth()->user()->role !== 'admin' && 
            auth()->user()->id !== $application->user_id && 
            auth()->user()->id !== $job->user_id) {
            return back()->with('error', 'غير مصرح لك بعرض هذا التقديم');
        }
        
        return view('applications.show', compact('application'));
    }
    public function edit()
    {

    }
    public function update(Request $request, Job $job, Application $application)
    {
        $status = $request->input('status');
        
        // التحقق من أن الحالة صالحة
        $validStatuses = ['accepted', 'rejected', 'applied', 'pending'];
        
        if (!in_array($status, $validStatuses)) {
            return back()->with('error', 'حالة غير صالحة');
        }

        // التحقق من الصلاحيات
        if (auth()->user()->role !== 'admin' && auth()->user()->id !== $job->user_id) {
            return back()->with('error', 'غير مصرح لك بتعديل هذا التقديم');
        }

        $application->update([
            'status' => $status
        ]);

        return back()->with('success', 'تم تحديث حالة الطلب');
    }
    public function destroy(Job $job, Application $application)
    {
        // التحقق من الصلاحيات
        if (auth()->user()->role !== 'admin' && auth()->user()->id !== $job->user_id) {
            return back()->with('error', 'غير مصرح لك بحذف هذا التقديم');
        }

        $application->delete();

        return redirect()->route('jobs.applications.index', $job)->with('success', 'تم حذف التقديم بنجاح');
    }
    //
}
