<?php

namespace App\Http\Controllers;

use App\Models\JobAlert;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobAlertController extends Controller
{
    /**
     * عرض صفحة إنذارات الوظائف
     */
    public function index()
    {
        $alerts = Auth::user()->jobAlerts()->with('user')->latest()->paginate(10);
        return view('job-alerts.index', compact('alerts'));
    }

    /**
     * إنشاء إنذار وظيفة جديد
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'keywords' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|in:full_time,part_time,remote,contract',
            'salary_min' => 'nullable|integer|min:0',
            'salary_max' => 'nullable|integer|min:0',
        ]);

        $alert = Auth::user()->jobAlerts()->create($validated);

        return redirect()->route('job-alerts.index')
            ->with('success', 'تم إنشاء إنذار الوظيفة بنجاح!');
    }

    /**
     * تحديث إنذار وظيفة
     */
    public function update(Request $request, JobAlert $jobAlert)
    {
        $this->authorize('update', $jobAlert);

        $validated = $request->validate([
            'keywords' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|in:full_time,part_time,remote,contract',
            'salary_min' => 'nullable|integer|min:0',
            'salary_max' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $jobAlert->update($validated);

        return redirect()->route('job-alerts.index')
            ->with('success', 'تم تحديث إنذار الوظيفة بنجاح!');
    }

    /**
     * حذف إنذار وظيفة
     */
    public function destroy(JobAlert $jobAlert)
    {
        $this->authorize('delete', $jobAlert);
        
        $jobAlert->delete();

        return redirect()->route('job-alerts.index')
            ->with('success', 'تم حذف إنذار الوظيفة بنجاح!');
    }

    /**
     * فحص الوظائف الجديدة وإرسال إشعارات
     * هذه الدالة تعمل يومياً عبر Task Scheduling
     */
    public function checkAndNotify()
    {
        $alerts = JobAlert::where('is_active', true)->get();
        
        foreach ($alerts as $alert) {
            // البحث عن وظائف جديدة تطابق معايير الإنذار
            $jobs = Job::where('created_at', '>', now()->subDay())
                ->where('title', 'LIKE', '%' . $alert->keywords . '%')
                ->when($alert->location, function ($query, $location) {
                    return $query->where('location', $location);
                })
                ->when($alert->type, function ($query, $type) {
                    return $query->where('type', $type);
                })
                ->when($alert->salary_min, function ($query, $min) {
                    return $query->where('salary_min', '>=', $min);
                })
                ->when($alert->salary_max, function ($query, $max) {
                    return $query->where('salary_max', '<=', $max);
                })
                ->get();

            // إرسال إشعار لكل وظيفة مطابقة
            foreach ($jobs as $job) {
                $alert->user->notify(new \App\Notifications\JobAlertNotification($job));
            }
        }

        return response()->json(['message' => 'تم فحص الإنذارات بنجاح']);
    }
}
