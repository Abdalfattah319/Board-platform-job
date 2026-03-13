<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Company;
use App\Models\Category;
use App\Models\user;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Requests\JobRequest;
use Illuminate\Support\Facades\Gate;


class JobController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['index', 'show']);
    // }

    public function index()
    {
        // جلب جميع الوظائف النشطة للعامة
        $jobs = Job::with(['company', 'applications'])
            ->where('is_active', true)
            ->latest()
            ->filter(request(['search', 'type', 'location']))
            ->paginate(5)
            ->withQueryString();

        // الوظائف الخاصة بالناشر الحالي (إذا كان مسجل دخول)
        $myJobs = $this->getPublisherJobs();
        
        // جلب الوظائف المحفوظة للمستخدم الحالي (إذا كان مسجل دخول)
        $savedJobIds = [];
        if (auth()->check()) {
            $savedJobIds = auth()->user()->savedJobs()->pluck('job_id')->toArray();
        }

        return view('jobs.index', compact('jobs', 'myJobs', 'savedJobIds'));
    }

    public function create()
    {
        
        $user=auth::user();

        if($user->is_admin || $user->is_employer)
        {
            $companies = Company::where('user_id', auth()->id())->get();
             return view('jobs.create', compact('companies'));
        }
        abort(404);
    }

    public function store(JobRequest $request)
    {
        // if(!Gate::allows('create.job')){
        //     abort(404);
        // }
        $validated = $request->validated();
        $validated['requirements'] = 'this is not found';
        $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();
        
        // صاحب العمل هو الأساس - يمكنه إنشاء وظيفة مباشرة
        $validated['user_id'] = auth()->id();
        
        // الشركة اختيارية - إذا كان لديه شركة
        $userCompany = auth()->user()->companies()->first();
        $validated['company_id'] = $userCompany ? $userCompany->id : 1;

        $job = Job::create($validated);

        return redirect()->route('jobs.index', $job->slug)
            ->with('success', 'تم إضافة الوظيفة بنجاح');
    }

    public function saveJob(Request $request, Job $job)
    {
        // التحقق من تسجيل الدخول
        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'يجب تسجيل الدخول أولاً']);
        }

        // التحقق من حفظ الوظيفة مسبقاً
        $existingSave = auth()->user()->savedJobs()->where('job_id', $job->id)->first();
        
        if ($existingSave) {
            return response()->json(['success' => false, 'message' => 'هذه الوظيفة محفوظة بالفعل']);
        }

        // حفظ الوظيفة
        auth()->user()->savedJobs()->create(['job_id' => $job->id]);

        return response()->json(['success' => true, 'message' => 'تم حفظ الوظيفة بنجاح']);
    }

    public function toggleStatus(Request $request, Job $job)
    {
        // Check if user owns the job
        if ($job->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'غير مصرح لك بتعديل هذه الوظيفة'], 403);
        }

        $action = $request->input('action');
        
        if ($action === 'activate') {
            $job->is_active = true;
            $message = 'تم تفعيل الوظيفة بنجاح';
        } elseif ($action === 'deactivate') {
            $job->is_active = false;
            $message = 'تم إيقاف الوظيفة بنجاح';
        } else {
            return response()->json(['success' => false, 'message' => 'إجراء غير صالح'], 400);
        }

        $job->save();

        return response()->json([
            'success' => true, 
            'message' => $message,
            'is_active' => $job->is_active
        ]);
    }

   

    public function show(Job $job)
    {
        $job->load('company');
        return view('jobs.show', compact('job'));
    }
   

    public function edit(Job $job)
    {
        // if(!Gate::allows('update.job')){
        //     abort(403);
        // }
        // $this->authorize('update', $job);
        $user=auth::user();
        if($user->is_admin || $user->is_employer)
        {
             $companies = Company::where('user_id', auth()->id())->get();
        return view('jobs.edit', compact('job', 'companies'));
   
        }
        abort(404);

    }

    public function update(JobRequest $request, Job $job)
    {
        // if(!Gate::allows('update.job')){
        //     abort(403);
        // }
        // $this->authorize('update', $job);
        $validated =$request->validated();
        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();
        $job->update($validated);
        return redirect()->route('jobs.show', $job->slug)
            ->with('success', 'تم تحديث الوظيفة بنجاح');
    }

    public function destroy(Job $job)
    {
        // if(Gate::allows('delete.job')){
        //     abort(403);
        // }
        // $this->authorize('delete', $job);


        $job->delete();

        return redirect()->route('jobs.index')
            ->with('success', 'تم حذف الوظيفة بنجاح');
    }

    public function getCompanyLogoAttribute()
    {
        return $this->company?->logo_url
            ?? 'https://ui-avatars.com/api/?name=' . urlencode($this->company?->name ?? 'Company');
    }

    /**
     * الحصول على الوظائف الخاصة بالناشر الحالي
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getPublisherJobs()
{
    // إذا لم يكن المستخدم مسجّل دخول
    if (!Auth::check()) {
        return collect(); // إرجاع Collection فارغة
    }

    // جلب وظائف المستخدم الحالي
    return Job::where('user_id', Auth::id())
        ->with('company')   // تحميل علاقة الشركة
        ->latest()          // الترتيب من الأحدث للأقدم
        ->get();            // تنفيذ الاستعلام
}


}
