
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="theme-color" content="#ffffff">
    <meta name="color-scheme" content="light">

    <title>@yield('title', 'PaperAnubhav — Har Exam Ka Asli Anubhav')</title>

    <meta name="description"
          content="Explore real government exam experiences, shift reviews, memory-based questions and preparation insights shared by candidates on PaperAnubhav.">

    <meta name="application-name" content="PaperAnubhav">
    <meta property="og:site_name" content="PaperAnubhav">
    <meta property="og:type" content="website">
    <meta property="og:title"
          content="@yield('title', 'PaperAnubhav — Har Exam Ka Asli Anubhav')">
    <meta property="og:description"
          content="Learn from real candidate experiences, compare exam shifts and prepare smarter with PaperAnubhav.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap"
          rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/modern.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tailwind-system.css') }}">

    <script>
        window.tailwind = window.tailwind || {};

        window.tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['DM Sans', 'ui-sans-serif', 'system-ui'],
                        display: ['Manrope', 'DM Sans', 'sans-serif']
                    },
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#172554'
                        }
                    },
                    boxShadow: {
                        soft: '0 12px 35px -18px rgba(15,23,42,.16)'
                    }
                }
            }
        };
    </script>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* =========================================
           PAPERANUBHAV GLOBAL LAYOUT
        ========================================= */

        html {
            min-height: 100%;
            background: #ffffff;
            scroll-behavior: smooth;
        }

        body.examconnect-site {
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            background: #ffffff !important;
            background-image: none !important;
            color: #171717;
            font-family: 'DM Sans', sans-serif;
        }

        .examconnect-site *,
        .examconnect-site *::before,
        .examconnect-site *::after {
            box-sizing: border-box;
        }

        .examconnect-site a {
            text-decoration: none;
        }

        /* Header */

        .ec-header {
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
            background: rgba(255, 255, 255, .97) !important;
            background-image: none !important;
            border-bottom: 1px solid #eeeeee !important;
            box-shadow: none !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .ec-header > div {
            min-height: 72px;
        }

        /* Brand */

        .examconnect-site .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #171717 !important;
            font-family: 'Manrope', sans-serif;
            font-size: 19px;
            font-weight: 800;
            letter-spacing: -.6px;
            white-space: nowrap;
        }

        .examconnect-site .brand-mark {
            display: inline-flex;
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #2563eb !important;
            background-image: none !important;
            color: #ffffff !important;
            font-family: 'Manrope', sans-serif;
            font-size: 21px;
            font-weight: 800;
            line-height: 1;
        }

        .examconnect-site .brand .font-display {
            font-family: 'Manrope', sans-serif;
            font-weight: 800;
        }

        /* Navigation */

        .ec-primary-nav {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 22px;
        }

        .ec-primary-nav > a:not(.button) {
            color: #525252;
            font-size: 13px;
            font-weight: 600;
            transition: color .2s ease;
        }

        .ec-primary-nav > a:not(.button):hover {
            color: #2563eb;
        }

        .ec-primary-nav .button {
            display: inline-flex;
            min-height: 39px;
            align-items: center;
            justify-content: center;
            padding: 0 15px;
            border-radius: 8px;
            background: #2563eb !important;
            color: #ffffff !important;
            font-size: 13px;
            font-weight: 700;
        }

        .ec-primary-nav .button:hover {
            background: #1d4ed8 !important;
        }

        .ec-primary-nav .nav-button {
            padding: 0;
            border: 0;
            background: transparent !important;
            color: #525252;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .ec-primary-nav .nav-button:hover {
            color: #2563eb;
        }

        /* Mobile toggle */

        .ec-menu-toggle {
            display: none;
            width: 42px;
            height: 42px;
            align-items: center;
            justify-content: center;
            border: 1px solid #e5e5e5;
            border-radius: 9px;
            background: #ffffff !important;
            color: #262626;
            cursor: pointer;
        }

        /* Main content */

        .ec-main {
            flex: 1 0 auto;
            width: 100%;
            max-width: 1440px;
            margin: 0 auto;
            background: #ffffff !important;
            background-image: none !important;
        }

        .ec-main > .alert {
            margin-bottom: 20px;
        }

        /* Alerts */

        .examconnect-site .alert {
            padding: 14px 16px;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            background: #ffffff !important;
            color: #262626;
            font-size: 14px;
            line-height: 1.7;
        }

        .examconnect-site .alert.success {
            border-color: #bbf7d0;
            color: #166534;
        }

        .examconnect-site .alert.error {
            border-color: #fecaca;
            color: #991b1b;
        }

        .examconnect-site .alert ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        /* Footer */

        .ec-footer {
            flex-shrink: 0;
            width: 100%;
            margin-top: auto;
            border-top: 1px solid #eeeeee !important;
            background: #ffffff !important;
            background-image: none !important;
            box-shadow: none !important;
        }

        .ec-footer > div {
            padding-top: 34px;
            padding-bottom: 34px;
        }

        .ec-footer .brand {
            margin-bottom: 12px;
        }

        .ec-footer p {
            overflow-wrap: anywhere;
        }

        /* Skip link */

        .ec-skip-link {
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 2000;
            padding: 10px 15px;
            transform: translateY(-150%);
            border-radius: 7px;
            background: #171717;
            color: #ffffff !important;
            font-size: 14px;
            font-weight: 600;
        }

        .ec-skip-link:focus {
            transform: translateY(0);
        }

        /* Keyboard accessibility */

        .examconnect-site a:focus-visible,
        .examconnect-site button:focus-visible {
            outline: 3px solid rgba(37, 99, 235, .4);
            outline-offset: 3px;
        }

        /* Responsive navigation */

        @media (max-width: 767px) {
            .ec-header > div {
                min-height: 66px;
                flex-wrap: wrap;
            }

            .examconnect-site .brand {
                font-size: 18px;
            }

            .examconnect-site .brand-mark {
                width: 36px;
                height: 36px;
                font-size: 20px;
            }

            .ec-menu-toggle {
                display: inline-flex;
            }

            .ec-primary-nav {
                display: none;
                width: 100%;
                flex-direction: column;
                align-items: stretch;
                justify-content: flex-start;
                gap: 0;
                padding: 8px 0 16px;
                border-top: 1px solid #eeeeee;
                background: #ffffff !important;
            }

            .ec-primary-nav.is-open {
                display: flex;
            }

            .ec-primary-nav > a:not(.button) {
                display: flex;
                min-height: 44px;
                align-items: center;
                padding: 10px 2px;
                border-bottom: 1px solid #f5f5f5;
                font-size: 14px;
            }

            .ec-primary-nav > a.button {
                min-height: 44px;
                margin-top: 10px;
            }

            .ec-primary-nav > form {
                display: block;
                padding: 13px 2px;
            }

            .ec-primary-nav .nav-button {
                font-size: 14px;
            }

            .ec-main {
                padding-top: 24px;
                padding-bottom: 24px;
            }

            .ec-footer > div {
                padding-top: 26px;
                padding-bottom: 26px;
            }
        }

        @media (max-width: 380px) {
            .examconnect-site .brand {
                gap: 7px;
                font-size: 16px;
                letter-spacing: -.4px;
            }

            .examconnect-site .brand-mark {
                width: 33px;
                height: 33px;
                border-radius: 8px;
                font-size: 18px;
            }

            .ec-menu-toggle {
                width: 38px;
                height: 38px;
                padding: 8px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            .examconnect-site *,
            .examconnect-site *::before,
            .examconnect-site *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="examconnect-site min-h-screen bg-white font-sans text-slate-800 antialiased">

    <a href="#main-content" class="ec-skip-link">
        Skip to main content
    </a>

    {{-- Header --}}
    <header class="ec-header sticky top-0 z-40 border-b border-slate-200/80 bg-white/95 backdrop-blur">
        <div class="mx-auto flex min-h-[72px] w-full max-w-[1440px] items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">

            {{-- PaperAnubhav Brand --}}
            <a class="brand shrink-0"
               href="{{ route('home') }}"
               aria-label="PaperAnubhav home">

                <span class="brand-mark">P</span>
                <span class="font-display tracking-tight">PaperAnubhav</span>
            </a>

            {{-- Mobile Menu Button --}}
            <button
                id="ec-menu-toggle"
                class="ec-menu-toggle inline-flex items-center justify-center rounded-xl border border-slate-200 p-2.5 text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500 md:hidden"
                type="button"
                aria-expanded="false"
                aria-controls="ec-primary-nav"
                aria-label="Open navigation menu">

                <svg class="h-5 w-5"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     aria-hidden="true">
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Main Navigation --}}
            <nav id="ec-primary-nav"
                 class="ec-primary-nav"
                 aria-label="Main navigation">

                <a href="{{ route('exams.index') }}">
                    Exams
                </a>

                @auth
                    <a href="{{ route('community.index') }}">
                        Community
                    </a>

                    <a href="{{ route('tools.index') }}">
                        Study tools
                    </a>

                    <a href="{{ route('experiences.create') }}">
                        Share experience
                    </a>

                    <a href="{{ route('bookmarks.index') }}">
                        Bookmarks
                    </a>

                    <a href="{{ route('profile.show') }}">
                        My profile
                    </a>

                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}">
                            Admin
                        </a>

                        <a href="{{ route('admin.posts.index') }}">
                            Posts
                        </a>

                        <a href="{{ route('admin.reports.index') }}">
                            Reports
                        </a>

                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.users.index') }}">
                                Users
                            </a>

                            <a href="{{ route('admin.settings') }}">
                                Settings
                            </a>
                        @endif
                    @endif

                    <form method="POST"
                          action="{{ route('logout') }}"
                          class="inline">

                        @csrf

                        <button type="submit" class="nav-button">
                            Log out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}">
                        Log in
                    </a>

                    <a class="button button-small"
                       href="{{ route('register') }}">
                        Join community
                    </a>
                @endauth

            </nav>
        </div>
    </header>

    {{-- Main Content --}}
    <main id="main-content"
          class="ec-main mx-auto min-h-[65vh] w-full max-w-[1440px] px-4 py-6 sm:px-6 sm:py-8 lg:px-8">

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert success"
                 role="status"
                 aria-live="polite">

                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="alert error"
                 role="alert"
                 aria-live="assertive">

                <strong>Please review the following:</strong>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="ec-footer border-t border-slate-200 bg-white">
        <div class="mx-auto grid w-full max-w-[1440px] gap-8 px-4 py-9 sm:px-6 md:grid-cols-[1.4fr_1fr] lg:px-8">

            {{-- Footer Brand --}}
            <div>
                <a class="brand mb-3 inline-flex"
                   href="{{ route('home') }}"
                   aria-label="PaperAnubhav home">

                    <span class="brand-mark">P</span>
                    <span class="font-display">PaperAnubhav</span>
                </a>

                <p class="max-w-xl text-sm leading-6 text-slate-500">
                    A student-first community to share government exam
                    experiences, compare shifts and prepare with insights
                    from fellow candidates.
                </p>

                <p class="mt-3 text-sm font-semibold text-slate-700">
                    Har Exam Ka Asli Anubhav.
                </p>
            </div>

            {{-- Footer Links --}}
            <div class="flex flex-col gap-3 text-sm text-slate-600 md:items-end">

                <div class="flex flex-wrap gap-x-5 gap-y-2">
                    <a class="hover:text-blue-700"
                       href="{{ route('exams.index') }}">
                        Explore exams
                    </a>

                    @auth
                        <a class="hover:text-blue-700"
                           href="{{ route('experiences.create') }}">
                            Share experience
                        </a>
                    @else
                        <a class="hover:text-blue-700"
                           href="{{ route('register') }}">
                            Create account
                        </a>
                    @endauth
                </div>

                <p class="max-w-lg text-left text-xs leading-5 text-slate-500 md:text-right">
                    Community posts are candidate-reported and are not
                    official exam notices or verified question papers.
                    Memory-based questions may be incomplete or inaccurate.
                    Always confirm important details with the relevant
                    examination authority.
                </p>

                <p class="text-xs text-slate-400">
                    © {{ date('Y') }} PaperAnubhav. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    {{-- Mobile Navigation Script --}}
    <script>
        (() => {
            const toggle = document.getElementById('ec-menu-toggle');
            const nav = document.getElementById('ec-primary-nav');

            if (!toggle || !nav) {
                return;
            }

            function closeMenu() {
                nav.classList.remove('is-open');

                toggle.setAttribute('aria-expanded', 'false');
                toggle.setAttribute(
                    'aria-label',
                    'Open navigation menu'
                );
            }

            toggle.addEventListener('click', () => {
                const isOpen =
                    toggle.getAttribute('aria-expanded') === 'true';

                toggle.setAttribute('aria-expanded', String(!isOpen));

                toggle.setAttribute(
                    'aria-label',
                    isOpen
                        ? 'Open navigation menu'
                        : 'Close navigation menu'
                );

                nav.classList.toggle('is-open', !isOpen);
            });

            nav.querySelectorAll('a').forEach((link) => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 768) {
                        closeMenu();
                    }
                });
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth >= 768) {
                    closeMenu();
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    closeMenu();
                }
            });
        })();
    </script>

    @stack('scripts')

</body>
</html>
