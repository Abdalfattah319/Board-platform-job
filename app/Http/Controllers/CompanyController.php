<?php

namespace App\Http\Controllers;
use App\Models\jobs;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies= Company::with('jobs')->latest()->paginate(9)->withQueryString();
        return view('companies.index',compact('companies'));
    }
    public function show(Company $company)
    {
        $company->load('jobs.user');
        
        return view('companies.show', compact('company'));
    }
    
    public function create(jobs $job)
    {
        return view('companies.create',compact('job'));
    }

     public function search(Request $request)
    {
        $query = $request->input('search');

        // البحث في اسم السلعة أو الوصف
        $company = Company::with('jobs')
                    ->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%")
                    ->latest()
                    ->paginate(12);

        return view('companies.index', compact('company', 'query'));
    }
    //
}
