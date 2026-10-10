<?php $__env->startSection('title', 'Exam Directory · ExamConnect'); ?>

<?php $__env->startSection('content'); ?>
<div class="exam-directory">

    
    <header class="directory-header">
        <div class="directory-eyebrow">
            <span class="eyebrow-line"></span>
            EXAMINATION DIRECTORY
        </div>

        <h1>Find your <span>examination.</span></h1>

        <p class="directory-description">
            Explore examinations, discover real candidate experiences,
            and prepare with insights from students who have already appeared.
        </p>
    </header>

    
    <form method="GET"
          action="<?php echo e(route('exams.index')); ?>"
          class="directory-search"
          id="examSearchForm"
          role="search">

        <div class="search-input-wrap">
            <svg viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.8"
                 aria-hidden="true">
                <circle cx="11" cy="11" r="7"></circle>
                <path d="m16 16 4 4"></path>
            </svg>

            <label for="examSearchInput" class="sr-only">
                Search examinations
            </label>

            <input
                type="search"
                id="examSearchInput"
                name="q"
                value="<?php echo e(request('q')); ?>"
                placeholder="Search exam name, category or keyword..."
                autocomplete="off"
                aria-label="Search examinations"
            >

            <span id="searchStatus"
                  class="search-status"
                  aria-live="polite"></span>

            <button type="button"
                    id="clearExamSearch"
                    class="clear-search"
                    aria-label="Clear search"
                    hidden>
                Clear
            </button>
        </div>

        <button type="submit" class="search-submit">
            <span>Search</span>
            <svg viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2"
                 aria-hidden="true">
                <path d="M5 12h14"></path>
                <path d="m12 5 7 7-7 7"></path>
            </svg>
        </button>
    </form>

    
    <div id="examResults" aria-live="polite">
        <?php echo $__env->make('exams.partials.results', ['exams' => $exams], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    
    <footer class="directory-footer">
        <span class="footer-indicator"></span>
        <p>
            ExamConnect shares candidate-reported experiences to help students
            prepare. Always verify official notifications, dates and results
            through the relevant examination authority.
        </p>
    </footer>

</div>

<style>
/* ==========================================
   EXAMCONNECT DIRECTORY
   Scoped styles - no global CSS conflicts
========================================== */

.exam-directory {
    width: 100%;
    max-width: 1440px;
    margin: 0 auto;
    padding: 42px clamp(16px, 4vw, 64px) 36px;
    background: #ffffff !important;
    background-image: none !important;
    color: #171717;
    box-sizing: border-box;

    --ed-text: #171717;
    --ed-muted: #737373;
    --ed-border: #e5e5e5;
    --ed-primary: #2563eb;
    --ed-primary-hover: #1d4ed8;
}

.exam-directory *,
.exam-directory *::before,
.exam-directory *::after {
    box-sizing: border-box;
}

.exam-directory .sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
}

.exam-directory a {
    color: inherit;
    text-decoration: none;
}

.exam-directory button,
.exam-directory input {
    font-family: inherit;
}

/* Header */

.exam-directory .directory-header {
    max-width: 850px;
    margin: 0 0 32px;
    background: #fff !important;
    background-image: none !important;
}

.exam-directory .directory-eyebrow {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 17px;
    color: #525252;
    font-size: 11px;
    font-weight: 750;
    letter-spacing: 1.8px;
}

.exam-directory .eyebrow-line {
    width: 25px;
    height: 2px;
    flex-shrink: 0;
    background: var(--ed-primary);
}

.exam-directory .directory-header h1 {
    margin: 0;
    padding: 0;
    color: var(--ed-text);
    background: transparent !important;
    font-size: clamp(34px, 5vw, 58px);
    font-weight: 750;
    line-height: 1.12;
    letter-spacing: -2px;
    overflow-wrap: anywhere;
}

.exam-directory .directory-header h1 span {
    color: var(--ed-primary);
    background: transparent !important;
}

.exam-directory .directory-description {
    max-width: 650px;
    margin: 17px 0 0;
    color: var(--ed-muted);
    font-size: 15px;
    line-height: 1.8;
}

/* Search form */

.exam-directory .directory-search {
    display: flex;
    align-items: stretch;
    gap: 12px;
    width: 100%;
    margin: 0 0 32px;
    padding: 0;
    border: 0;
    border-radius: 0;
    background: #fff !important;
    background-image: none !important;
    box-shadow: none !important;
}

.exam-directory .search-input-wrap {
    display: flex;
    flex: 1;
    min-width: 0;
    min-height: 56px;
    align-items: center;
    gap: 12px;
    padding: 0 15px;
    border: 1px solid #d4d4d4;
    border-radius: 8px;
    background: #fff !important;
    background-image: none !important;
    box-shadow: none !important;
    transition: border-color .2s ease;
}

.exam-directory .search-input-wrap:focus-within {
    border-color: var(--ed-primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, .09) !important;
}

.exam-directory .search-input-wrap > svg {
    width: 21px;
    height: 21px;
    flex-shrink: 0;
    color: #737373;
}

.exam-directory .search-input-wrap input {
    display: block;
    flex: 1;
    width: 100%;
    min-width: 0;
    height: 52px;
    margin: 0;
    padding: 0;
    border: 0 !important;
    outline: 0 !important;
    border-radius: 0 !important;
    background: transparent !important;
    background-image: none !important;
    color: #171717;
    font-size: 14px;
    box-shadow: none !important;
}

.exam-directory .search-input-wrap input::placeholder {
    color: #a3a3a3;
    opacity: 1;
}

.exam-directory .search-input-wrap input:focus {
    outline: none !important;
    border: 0 !important;
    box-shadow: none !important;
}

.exam-directory .search-submit {
    display: inline-flex;
    min-height: 56px;
    flex-shrink: 0;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 0 23px;
    border: 1px solid var(--ed-primary);
    border-radius: 8px;
    background: var(--ed-primary) !important;
    background-image: none !important;
    color: #fff !important;
    font-size: 14px;
    font-weight: 650;
    cursor: pointer;
    box-shadow: none !important;
    transition: background-color .2s ease;
}

.exam-directory .search-submit:hover {
    background: var(--ed-primary-hover) !important;
}

.exam-directory .search-submit svg {
    width: 17px;
    height: 17px;
}

.exam-directory .clear-search {
    flex-shrink: 0;
    padding: 5px 0 5px 7px;
    border: 0;
    background: transparent !important;
    color: var(--ed-primary);
    font-size: 12px;
    font-weight: 650;
    cursor: pointer;
}

.exam-directory .clear-search[hidden] {
    display: none !important;
}

.exam-directory .search-status {
    flex-shrink: 0;
    color: #737373;
    font-size: 11px;
    white-space: nowrap;
}

.exam-directory .search-status:empty {
    display: none;
}

/* Results wrapper: no background, images or cards */

.exam-directory #examResults {
    width: 100%;
    min-width: 0;
    background: #fff !important;
    background-image: none !important;
    box-shadow: none !important;
}

.exam-directory #examResults[aria-busy="true"] {
    opacity: .55;
    pointer-events: none;
}

/* Toolbar */

.exam-directory .directory-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 18px 0;
    border-top: 1px solid var(--ed-border);
    border-bottom: 1px solid var(--ed-border);
    background: #fff !important;
    background-image: none !important;
    box-shadow: none !important;
}

.exam-directory .directory-toolbar > div:first-child {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 12px;
}

.exam-directory .toolbar-label {
    color: var(--ed-text);
    font-size: 11px;
    font-weight: 750;
    letter-spacing: 1.2px;
}

.exam-directory .toolbar-detail {
    color: var(--ed-muted);
    font-size: 12px;
}

.exam-directory .result-count {
    flex-shrink: 0;
    color: var(--ed-muted);
    font-size: 12px;
    font-variant-numeric: tabular-nums;
}

/* Exam rows - no cards */

.exam-directory .exam-list {
    width: 100%;
    margin: 0;
    padding: 0;
    background: #fff !important;
    background-image: none !important;
}

.exam-directory .exam-row {
    display: grid;
    grid-template-columns: 52px minmax(0, 1fr) auto;
    align-items: start;
    gap: 21px;
    width: 100%;
    margin: 0;
    padding: 28px 4px;
    border: 0;
    border-bottom: 1px solid var(--ed-border);
    border-radius: 0 !important;
    background: #fff !important;
    background-image: none !important;
    box-shadow: none !important;
    transition: border-color .2s ease;
}

.exam-directory .exam-row:hover {
    background: #fff !important;
    background-image: none !important;
    box-shadow: none !important;
}

.exam-directory .exam-symbol {
    display: flex;
    width: 52px;
    height: 52px;
    align-items: center;
    justify-content: center;
    border: 1px solid #dbeafe;
    border-radius: 9px;
    background: #eff6ff !important;
    background-image: none !important;
    color: var(--ed-primary);
    font-size: 21px;
    font-weight: 750;
}

.exam-directory .exam-information {
    min-width: 0;
    background: #fff !important;
    background-image: none !important;
}

.exam-directory .exam-meta {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 9px;
    margin-bottom: 8px;
}

.exam-directory .exam-category {
    color: var(--ed-primary);
    font-size: 12px;
    font-weight: 700;
}

.exam-directory .exam-name {
    margin: 0;
    padding: 0;
    color: var(--ed-text);
    background: transparent !important;
    font-size: clamp(19px, 2.1vw, 24px);
    font-weight: 700;
    line-height: 1.4;
    overflow-wrap: anywhere;
}

.exam-directory .exam-name a {
    color: var(--ed-text);
    background: transparent !important;
    transition: color .2s ease;
}

.exam-directory .exam-name a:hover {
    color: var(--ed-primary);
}

.exam-directory .exam-description {
    max-width: 800px;
    margin: 9px 0 14px;
    padding: 0;
    color: #666;
    background: transparent !important;
    font-size: 13px;
    line-height: 1.8;
    overflow-wrap: anywhere;
}

.exam-directory .exam-bottom-meta {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 14px;
}

.exam-directory .experience-count {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--ed-muted);
    font-size: 12px;
}

.exam-directory .experience-count strong {
    color: var(--ed-text);
    font-weight: 750;
}

.exam-directory .exam-action {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding-top: 25px;
    background: #fff !important;
}

.exam-directory .explore-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    color: var(--ed-primary) !important;
    background: transparent !important;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
}

.exam-directory .explore-link:hover {
    text-decoration: underline;
}

/* Empty state */

.exam-directory .directory-empty {
    padding: 65px 15px;
    background: #fff !important;
    background-image: none !important;
    text-align: center;
}

.exam-directory .directory-empty h2 {
    margin: 0 0 10px;
    color: var(--ed-text);
    background: transparent !important;
    font-size: 23px;
    font-weight: 700;
}

.exam-directory .directory-empty p {
    margin: 0;
    color: var(--ed-muted);
    font-size: 14px;
    line-height: 1.8;
}

/* Pagination */

.exam-directory .directory-pagination {
    display: flex;
    justify-content: center;
    padding: 28px 0;
    overflow-x: auto;
    background: #fff !important;
    background-image: none !important;
    box-shadow: none !important;
}

.exam-directory .directory-pagination nav {
    max-width: 100%;
}

.exam-directory .directory-pagination svg {
    width: 18px;
    height: 18px;
}

/* Footer */

.exam-directory .directory-footer {
    display: flex;
    align-items: flex-start;
    gap: 11px;
    margin-top: 10px;
    padding: 22px 0 0;
    border-top: 1px solid var(--ed-border);
    background: #fff !important;
    background-image: none !important;
}

.exam-directory .footer-indicator {
    width: 7px;
    height: 7px;
    flex-shrink: 0;
    margin-top: 7px;
    border-radius: 50%;
    background: #a3a3a3;
}

.exam-directory .directory-footer p {
    max-width: 900px;
    margin: 0;
    color: var(--ed-muted);
    font-size: 12px;
    line-height: 1.8;
}

/* Focus accessibility */

.exam-directory a:focus-visible,
.exam-directory button:focus-visible {
    outline: 3px solid rgba(37, 99, 235, .35);
    outline-offset: 3px;
}

/* Responsive */

@media (max-width: 760px) {
    .exam-directory {
        padding: 30px 20px;
    }

    .exam-directory .directory-header h1 {
        letter-spacing: -1.3px;
    }

    .exam-directory .directory-description {
        font-size: 14px;
    }

    .exam-directory .exam-row {
        grid-template-columns: 44px minmax(0, 1fr);
        gap: 14px;
        padding: 23px 2px;
    }

    .exam-directory .exam-symbol {
        width: 44px;
        height: 44px;
        font-size: 18px;
    }

    .exam-directory .exam-name {
        font-size: 19px;
    }

    .exam-directory .exam-action {
        grid-column: 2;
        justify-content: flex-start;
        padding-top: 0;
    }

    .exam-directory .directory-toolbar > div:first-child {
        align-items: flex-start;
        flex-direction: column;
        gap: 5px;
    }
}

@media (max-width: 440px) {
    .exam-directory {
        padding: 24px 15px;
    }

    .exam-directory .directory-header h1 {
        font-size: 35px;
    }

    .exam-directory .directory-search {
        flex-direction: column;
        gap: 10px;
    }

    .exam-directory .search-submit {
        width: 100%;
        min-height: 48px;
    }

    .exam-directory .search-input-wrap {
        gap: 8px;
        padding: 0 10px;
    }

    .exam-directory .search-input-wrap input {
        font-size: 13px;
    }

    .exam-directory .search-status {
        font-size: 10px;
    }

    .exam-directory .directory-toolbar {
        align-items: flex-start;
        gap: 8px;
    }

    .exam-directory .toolbar-detail {
        font-size: 11px;
    }

    .exam-directory .result-count {
        font-size: 11px;
    }
}

@media (prefers-reduced-motion: reduce) {
    .exam-directory *,
    .exam-directory *::before,
    .exam-directory *::after {
        transition: none !important;
        animation: none !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('examSearchForm');
    const input = document.getElementById('examSearchInput');
    const results = document.getElementById('examResults');
    const status = document.getElementById('searchStatus');
    const clearButton = document.getElementById('clearExamSearch');

    if (!form || !input || !results || !status || !clearButton) {
        return;
    }

    let debounceTimer = null;
    let activeController = null;
    let requestId = 0;

    function updateClearButton() {
        clearButton.hidden = input.value.length === 0;
    }

    function buildSearchUrl(query, pageUrl = null) {
        const url = new URL(pageUrl || form.action, window.location.origin);

        if (query.trim()) {
            url.searchParams.set('q', query.trim());
        } else {
            url.searchParams.delete('q');
        }

        url.searchParams.delete('page');
        url.searchParams.set('ajax', '1');

        return url;
    }

    async function loadResults(url, updateBrowserUrl = true) {
        const thisRequest = ++requestId;

        if (activeController) {
            activeController.abort();
        }

        activeController = new AbortController();

        status.textContent = 'Searching...';
        results.setAttribute('aria-busy', 'true');

        try {
            const response = await fetch(url.toString(), {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                signal: activeController.signal
            });

            if (!response.ok) {
                throw new Error('Search request failed: ' + response.status);
            }

            const data = await response.json();

            if (thisRequest !== requestId) return;

            if (typeof data.html !== 'string') {
                throw new Error('Invalid search response');
            }

            results.innerHTML = data.html;

            status.textContent =
                data.count + (data.count === 1 ? ' result' : ' results');

            if (updateBrowserUrl) {
                const browserUrl = new URL(window.location.href);

                if (input.value.trim()) {
                    browserUrl.searchParams.set('q', input.value.trim());
                } else {
                    browserUrl.searchParams.delete('q');
                }

                browserUrl.searchParams.delete('page');
                window.history.replaceState({}, '', browserUrl);
            }
        } catch (error) {
            if (error.name !== 'AbortError' && thisRequest === requestId) {
                status.textContent = 'Unable to search. Please try again.';
            }
        } finally {
            if (thisRequest === requestId) {
                results.removeAttribute('aria-busy');
            }
        }
    }

    function performSearch() {
        const url = buildSearchUrl(input.value);
        loadResults(url);
    }

    input.addEventListener('input', function () {
        updateClearButton();
        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(function () {
            performSearch();
        }, 300);
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        clearTimeout(debounceTimer);
        performSearch();
    });

    clearButton.addEventListener('click', function () {
        input.value = '';
        updateClearButton();
        clearTimeout(debounceTimer);
        input.focus();
        performSearch();
    });

    // AJAX pagination without reloading the page.
    results.addEventListener('click', function (event) {
        const link = event.target.closest('.pagination a, nav[role="navigation"] a');

        if (!link) return;

        const url = new URL(link.href, window.location.origin);

        if (url.origin !== window.location.origin) return;

        event.preventDefault();

        url.searchParams.set('ajax', '1');

        loadResults(url, false);

        const browserUrl = new URL(link.href, window.location.origin);
        window.history.replaceState({}, '', browserUrl);
    });

    // Support browser back/forward navigation.
    window.addEventListener('popstate', function () {
        const currentUrl = new URL(window.location.href);
        input.value = currentUrl.searchParams.get('q') || '';
        updateClearButton();

        const url = buildSearchUrl(input.value, currentUrl.toString());

        loadResults(url, false);
    });

    updateClearButton();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ExamConnect\resources\views/exams/index.blade.php ENDPATH**/ ?>