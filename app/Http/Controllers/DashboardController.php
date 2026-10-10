<?php
namespace App\Http\Controllers; use App\Models\Experience; use App\Models\Exam; use Illuminate\Http\Request;
class DashboardController extends Controller { public function index(Request $request){$experiences=Experience::published()->with(['exam','user'])->withCount(['likes','allComments'])->latest('published_at')->paginate(10);$exams=Exam::where('status','active')->withCount(['experiences'=>fn($q)=>$q->published()])->orderBy('name')->limit(8)->get();return view('dashboard',compact('experiences','exams'));} }
