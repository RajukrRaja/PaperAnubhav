
@extends('layouts.app')

@section('title', $experience->title . ' · ExamConnect')

@section('content')
@php
    $exam = $experience->exam;
    $author = $experience->user;
    $isAnonymous = (bool) ($experience->anonymous_author ?? false);

    $authorName = $isAnonymous
        ? 'Anonymous candidate'
        : ($author?->name ?? 'Community member');

    $authorInitial = strtoupper(substr($authorName, 0, 1));

    $rememberedQuestions = $experience->rememberedQuestions ?? collect();
    $comments = $experience->comments ?? collect();

    $likesCount = (int) ($experience->likes_count ?? 0);
    $commentsCount = (int) ($experience->all_comments_count ?? $comments->count());
    $difficulty = $experience->difficulty;

    $sections = [
        'time_management' => 'Time management',
        'unexpected_topics' => 'Unexpected topics',
        'exam_day_notes' => 'Exam-day notes',
        'preparation_strategy' => 'Preparation strategy',
        'recommended_resources' => 'Recommended resources',
        'mistakes_to_avoid' => 'Mistakes to avoid',
        'advice' => 'Advice for future candidates',
    ];

    $avatarPath = $author?->avatar_path;

    $avatarUrl = $avatarPath
        ? (str_starts_with($avatarPath, 'http')
            ? $avatarPath
            : asset('storage/' . ltrim(
                preg_replace('#^(public/|storage/)#', '', $avatarPath),
                '/'
            )))
        : null;
@endphp

<div class="min-h-screen bg-white text-slate-800">
    <main class="mx-auto w-full max-w-5xl px-4 py-7 sm:px-8 sm:py-10 lg:px-10">

        {{-- Exam information --}}
        <header class="border-b border-slate-200 pb-8">
            <div class="mb-5 flex flex-wrap items-center gap-x-3 gap-y-2 text-sm">
                @if($exam)
                    <a href="{{ route('exams.show', $exam) }}"
                       class="font-semibold text-indigo-700 hover:text-indigo-900 hover:underline">
                        {{ $exam->name }}
                    </a>
                    <span class="text-slate-300" aria-hidden="true">/</span>
                @endif

                <span class="font-semibold text-amber-700">
                    Candidate-reported
                </span>

                @if($experience->exam_date)
                    <time class="text-slate-500">
                        {{ $experience->exam_date->format('d M Y') }}
                    </time>
                @endif
            </div>

            <h1 class="break-words text-3xl font-extrabold leading-tight tracking-tight text-slate-950 sm:text-4xl lg:text-5xl">
                {{ $experience->title }}
            </h1>

            @if($experience->summary)
                <p class="mt-5 max-w-4xl text-base leading-8 text-slate-600 sm:text-lg">
                    {{ $experience->summary }}
                </p>
            @endif

            {{-- Author details --}}
            <div class="mt-7 flex flex-wrap items-center gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center overflow-hidden rounded-full bg-indigo-50 text-lg font-bold text-indigo-700">
                    @if(!$isAnonymous && $avatarUrl)
                        <img
                            src="{{ $avatarUrl }}"
                            alt="{{ $authorName }}"
                            class="h-full w-full object-cover"
                            onerror="this.style.display='none';"
                        >
                    @else
                        {{ $authorInitial }}
                    @endif
                </div>

                <div class="min-w-0 flex-1">
                    <p class="break-words font-bold text-slate-900">
                        {{ $authorName }}
                    </p>

                    <div class="mt-1 flex flex-wrap items-center gap-x-2 gap-y-1 text-sm text-slate-500">
                        <span>{{ $experience->shift ?: 'Shift not specified' }}</span>
                        <span aria-hidden="true">·</span>

                        <span>
                            {{ $difficulty ? 'Difficulty ' . $difficulty . '/5' : 'Difficulty not rated' }}
                        </span>

                        @if($experience->exam_year)
                            <span aria-hidden="true">·</span>
                            <span>{{ $experience->exam_year }}</span>
                        @endif

                        @if($experience->center_region)
                            <span aria-hidden="true">·</span>
                            <span>{{ $experience->center_region }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </header>

        {{-- Main experience content --}}
        <section class="py-8 sm:py-10">
            <h2 class="mb-4 text-2xl font-bold tracking-tight text-slate-950">
                Exam experience
            </h2>

            @if(filled($experience->body))
                <div class="break-words whitespace-pre-line text-base leading-8 text-slate-700 [overflow-wrap:anywhere]">
                    {{ $experience->body }}
                </div>
            @else
                <p class="text-slate-500">
                    No detailed experience has been provided.
                </p>
            @endif
        </section>

        {{-- Additional details without cards --}}
        @foreach($sections as $field => $heading)
            @if(filled($experience->$field))
                <section class="border-t border-slate-200 py-7 sm:py-8">
                    <h2 class="mb-3 text-xl font-bold text-slate-950 sm:text-2xl">
                        {{ $heading }}
                    </h2>

                    <div class="break-words whitespace-pre-line leading-8 text-slate-600 [overflow-wrap:anywhere]">
                        {{ $experience->$field }}
                    </div>
                </section>
            @endif
        @endforeach

        {{-- Remembered questions --}}
        @if($rememberedQuestions->isNotEmpty())
            <section class="border-t border-slate-200 py-8 sm:py-10">
                <h2 class="text-2xl font-extrabold tracking-tight text-slate-950">
                    Remembered questions
                </h2>

                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Questions reported by candidates. Answers may require independent verification.
                </p>

                <ol class="mt-5 divide-y divide-slate-200">
                    @foreach($rememberedQuestions as $index => $question)
                        <li class="py-6">
                            <div class="flex items-start gap-4">
                                <span class="shrink-0 pt-0.5 font-bold text-indigo-700">
                                    {{ $index + 1 }}.
                                </span>

                                <div class="min-w-0 flex-1">
                                    @if(filled($question->subject ?? null))
                                        <p class="mb-2 text-xs font-bold uppercase tracking-wider text-indigo-700">
                                            {{ $question->subject }}
                                        </p>
                                    @endif

                                    <h3 class="break-words font-semibold leading-7 text-slate-900">
                                        {{ $question->question ?? 'Question text unavailable' }}
                                    </h3>

                                    @if(filled($question->answer ?? null))
                                        <div class="mt-3">
                                            <p class="text-sm font-bold text-emerald-800">
                                                Answer
                                            </p>
                                            <p class="mt-1 break-words leading-7 text-slate-700">
                                                {{ $question->answer }}
                                            </p>
                                        </div>
                                    @endif

                                    @if(filled($question->explanation ?? null))
                                        <div class="mt-3">
                                            <p class="text-sm font-bold text-slate-700">
                                                Explanation
                                            </p>
                                            <p class="mt-1 break-words leading-7 text-slate-600">
                                                {{ $question->explanation }}
                                            </p>
                                        </div>
                                    @endif

                                    @if($question->answer_uncertain ?? false)
                                        <p class="mt-3 text-sm font-semibold text-amber-700">
                                            Answer uncertain
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ol>
            </section>
        @endif

        {{-- Like, bookmark and report actions --}}
        @auth
            <section class="border-t border-slate-200 py-6">
                <div class="flex flex-wrap items-center gap-3">

                    <form method="POST"
                          action="{{ route('experiences.like', $experience) }}">
                        @csrf
                        <button type="submit"
                                class="inline-flex min-h-11 items-center gap-2 rounded-lg px-4 py-2.5 font-semibold text-slate-700 transition hover:bg-rose-50 hover:text-rose-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <svg class="h-5 w-5" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor"
                                 stroke-width="1.8" aria-hidden="true">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                            </svg>
                            Like ({{ $likesCount }})
                        </button>
                    </form>

                    <form method="POST"
                          action="{{ route('experiences.bookmark', $experience) }}">
                        @csrf
                        <button type="submit"
                                class="inline-flex min-h-11 items-center gap-2 rounded-lg px-4 py-2.5 font-semibold text-slate-700 transition hover:bg-indigo-50 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <svg class="h-5 w-5" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor"
                                 stroke-width="1.8" aria-hidden="true">
                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                            </svg>
                            Bookmark
                        </button>
                    </form>

                    @if(auth()->id() !== $experience->user_id)
                        <details class="relative">
                            <summary class="inline-flex min-h-11 cursor-pointer list-none items-center rounded-lg px-4 py-2.5 font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                Report experience
                            </summary>

                            <div class="mt-3 w-full max-w-sm sm:absolute sm:right-0 sm:z-20 sm:w-80 sm:bg-white sm:shadow-lg">
                                <div class="border-y border-slate-200 py-5 sm:border sm:p-5">
                                    <h3 class="mb-4 font-bold text-slate-900">
                                        Report this experience
                                    </h3>

                                    <form method="POST"
                                          action="{{ route('experiences.report', $experience) }}">
                                        @csrf

                                        <div class="mb-4">
                                            <label for="report_reason"
                                                   class="mb-2 block text-sm font-semibold text-slate-700">
                                                Reason *
                                            </label>

                                            <select id="report_reason"
                                                    name="reason"
                                                    required
                                                    class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200">
                                                <option value="">Choose a reason</option>
                                                <option value="misinformation">Potential misinformation</option>
                                                <option value="spam">Spam</option>
                                                <option value="duplicate">Duplicate post</option>
                                                <option value="abuse">Abusive content</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>

                                        <div class="mb-4">
                                            <label for="report_details"
                                                   class="mb-2 block text-sm font-semibold text-slate-700">
                                                Details (optional)
                                            </label>

                                            <textarea id="report_details"
                                                      name="details"
                                                      rows="3"
                                                      maxlength="1500"
                                                      class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200"></textarea>
                                        </div>

                                        <button type="submit"
                                                class="w-full rounded-lg bg-rose-600 px-4 py-3 text-sm font-bold text-white hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500">
                                            Submit report
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </details>
                    @endif

                </div>
            </section>

            {{-- Discussion --}}
            <section id="discussion" class="border-t border-slate-200 py-8 sm:py-10">
                <h2 class="text-2xl font-extrabold tracking-tight text-slate-950">
                    Discussion
                    <span class="text-base font-medium text-slate-500">
                        ({{ $commentsCount }})
                    </span>
                </h2>

                <form method="POST"
                      action="{{ route('experiences.comments.store', $experience) }}"
                      class="mt-6">
                    @csrf

                    <div class="mb-4">
                        <label for="comment_body"
                               class="mb-2 block text-sm font-semibold text-slate-800">
                            Add a comment
                        </label>

                        <textarea id="comment_body"
                                  name="body"
                                  rows="4"
                                  required
                                  minlength="2"
                                  maxlength="3000"
                                  placeholder="Share helpful insights with other candidates..."
                                  class="w-full resize-y rounded-lg border border-slate-300 bg-white px-4 py-3 leading-7 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">{{ old('body') }}</textarea>

                        @error('body')
                            <p class="mt-2 text-sm text-rose-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="inline-flex min-h-11 items-center justify-center rounded-lg bg-indigo-600 px-5 py-3 font-bold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Post comment
                    </button>
                </form>

                {{-- Comments without cards --}}
                <div class="mt-8 divide-y divide-slate-200">
                    @forelse($comments as $comment)
                        @php
                            $commentUserName = $comment->user?->name
                                ?? 'Community member';

                            $replies = $comment->replies ?? collect();
                        @endphp

                        <article class="py-6">
                            <div class="flex min-w-0 items-start gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-slate-100 font-bold text-slate-700">
                                    {{ strtoupper(substr($commentUserName, 0, 1)) }}
                                </div>

                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
                                        <strong class="break-words text-sm text-slate-900">
                                            {{ $commentUserName }}
                                        </strong>

                                        <time class="text-xs text-slate-500">
                                            {{ $comment->created_at?->diffForHumans() ?? '' }}
                                        </time>
                                    </div>

                                    <p class="mt-3 break-words whitespace-pre-line leading-7 text-slate-700 [overflow-wrap:anywhere]">{{ $comment->body }}</p>

                                    {{-- Replies --}}
                                    @if($replies->isNotEmpty())
                                        <div class="ml-2 mt-5 border-l-2 border-slate-200 pl-4 sm:ml-4 sm:pl-5">
                                            @foreach($replies as $reply)
                                                @php
                                                    $replyUserName = $reply->user?->name
                                                        ?? 'Community member';
                                                @endphp

                                                <div class="mb-5 last:mb-0">
                                                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
                                                        <strong class="text-sm text-slate-900">
                                                            {{ $replyUserName }}
                                                        </strong>

                                                        <time class="text-xs text-slate-500">
                                                            {{ $reply->created_at?->diffForHumans() ?? '' }}
                                                        </time>
                                                    </div>

                                                    <p class="mt-2 break-words whitespace-pre-line text-sm leading-7 text-slate-600 [overflow-wrap:anywhere]">{{ $reply->body }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @empty
                        <p class="py-8 text-sm leading-7 text-slate-500">
                            No comments yet. Be the first to share your thoughts.
                        </p>
                    @endforelse
                </div>
            </section>

        @else
            {{-- Guest prompt --}}
            <section id="discussion" class="border-t border-slate-200 py-8 sm:py-10">
                <h2 class="text-2xl font-extrabold text-slate-950">
                    Join the discussion
                </h2>

                <p class="mt-3 max-w-2xl leading-7 text-slate-600">
                    Log in or create an account to comment, like, bookmark experiences and connect with fellow candidates.
                </p>

                <div class="mt-5 flex flex-wrap gap-5">
                    <a href="{{ route('login') }}"
                       class="font-bold text-indigo-700 hover:underline">
                        Log in
                    </a>

                    <a href="{{ route('register') }}"
                       class="font-bold text-indigo-700 hover:underline">
                        Create account
                    </a>
                </div>
            </section>
        @endauth

        {{-- Disclaimer --}}
        <footer class="border-t border-slate-200 py-6">
            <p class="text-xs leading-6 text-slate-500">
                This experience is candidate-reported and is not an official exam notice or verified question paper.
                Confirm important information with the relevant exam authority.
            </p>
        </footer>

    </main>
</div>
@endsection
