<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display active examinations.
     *
     * Supports:
     * - Normal examination listing
     * - Search by exam name
     * - Filter by category slug
     * - AJAX real-time search
     * - AJAX pagination
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q', ''));
        $category = $request->query('category');

        $query = Exam::query()
            ->with('category')
            ->where('status', 'active')
            ->withCount([
                'experiences' => function ($experienceQuery) {
                    $experienceQuery->published();
                },
            ]);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($search !== '') {
            $query->where(function ($searchQuery) use ($search) {
                $searchQuery->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($categoryQuery) use ($search) {
                        $categoryQuery->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Category Filter
        |--------------------------------------------------------------------------
        */

        if (filled($category)) {
            $query->whereHas('category', function ($categoryQuery) use ($category) {
                $categoryQuery->where('slug', $category);
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $exams = $query
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | AJAX Response
        |--------------------------------------------------------------------------
        |
        | Returns the results partial as HTML inside JSON.
        | The frontend can update results without a page reload.
        |
        */

        if ($request->ajax() || $request->query('ajax') === '1') {
            return response()->json([
                'html' => view(
                    'exams.partials.results',
                    compact('exams')
                )->render(),

                'count' => $exams->total(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Standard Page Response
        |--------------------------------------------------------------------------
        */

        return view('exams.index', compact('exams'));
    }

    /**
     * Display a single active examination and its published experiences.
     */
    public function show(Exam $exam)
    {
        abort_unless($exam->status === 'active', 404);

        $experiences = $exam->experiences()
            ->published()
            ->with('user')
            ->withCount([
                'likes',
                'allComments',
            ])
            ->latest('published_at')
            ->paginate(10);

        return view('exams.show', compact('exam', 'experiences'));
    }
}
