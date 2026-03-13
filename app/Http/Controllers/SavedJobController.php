<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedJob;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Job;

class SavedJobController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // $savedJobs = $user->savedJobs;
        $savedJobs = SavedJob::where('user_id', auth()->id())->paginate(10);
        return view('saved-jobs.index', compact('savedJobs'));
    }

    // public function store(SavedJob $savedJobs,job $job)
    // {
    //     $user=auth()->id();
        
    //     $validat= $request->validate([
    //         'job_id' =>['nullable','int','exists:topics,id'],
    //     ]);
    //     $validat['job_id']=$job;
    //     $validat['user_id']=$user;

    //     if($savedJobs->job_id==$job && $savedJobs->user_id==$user)
    //     {
    //         $savedJobs->create($validat);

    //     }

    // }
    // public function store(Request $request)
    // {
    //     $userId = auth()->id();

    //     $validated = $request->validate([
    //         'job_id' => ['required', 'integer', 'exists:jobs,id'],
    //     ]);

    //     // التحقق إذا كانت الوظيفة محفوظة مسبقًا
    //     $existingSavedJob = SavedJob::where('user_id', $userId)
    //                                ->where('job_id', $validated['job_id'])
    //                                ->first();

        
    //         // حفظ الوظيفة
    //         SavedJob::create([
    //             'user_id' => $userId,
    //             'job_id'  => $validated['job_id'],
    //         ]);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'تم حفظ الوظيفة بنجاح',
    //             'action' => 'saved'
    //         ]);
        
    // }

    public function store(Request $request)
{
    $userId = auth()->id();

    $validated = $request->validate([
        'job_id' => ['required', 'integer', 'exists:jobs,id'],
    ]);

    // التحقق إذا كانت الوظيفة محفوظة مسبقًا
    $existingSavedJob = SavedJob::where('user_id', $userId)
                                ->where('job_id', $validated['job_id'])
                                ->first();

    if ($existingSavedJob) {
        return response()->json([
            'success' => false,
            'message' => 'هذه الوظيفة محفوظة مسبقًا',
            'action'  => 'exists'
        ]);
    }

    // حفظ الوظيفة
    SavedJob::create([
        'user_id' => $userId,
        'job_id'  => $validated['job_id'],
    ]);

    return response()->json([
        'success' => true,
        'message' => 'تم حفظ الوظيفة بنجاح',
        'action'  => 'saved'
    ]);
}
    public function destroy($id)
    {
        $userId = auth()->id();
        
        $savedJob = SavedJob::where('user_id', $userId)
                           ->where('id', $id)
                           ->first();
        
        if (!$savedJob) {
            return response()->json([
                'success' => false,
                'message' => 'الوظيفة غير موجودة'
            ], 404);
        }
        
        $savedJob->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'تم إلغاء حفظ الوظيفة بنجاح',
            'action'  => 'unsaved'
        ]);
    }

    public function destroyByJob($jobId)
    {
        $userId = auth()->id();
        
        $savedJob = SavedJob::where('user_id', $userId)
                           ->where('job_id', $jobId)
                           ->first();
        
        if (!$savedJob) {
            return response()->json([
                'success' => false,
                'message' => 'الوظيفة غير محفوظة'
            ], 404);
        }
        
        $savedJob->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'تم إلغاء حفظ الوظيفة بنجاح',
            'action'  => 'unsaved'
        ]);
    }
    //
}
