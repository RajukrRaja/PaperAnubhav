<?php $__env->startSection('title','PaperAnubhav — Learn from candidate experiences'); ?>

<?php $__env->startSection('content'); ?>

<div class="paperanubhav-page">

<style>

  /* ==========================================================================

     1. RESET & BASE

     ========================================================================== */

  .paperanubhav-page, .paperanubhav-page *, .paperanubhav-page *::before, .paperanubhav-page *::after {

    margin: 0;

    padding: 0;

    box-sizing: border-box;

    -webkit-tap-highlight-color: transparent;

  }

  html {

    scroll-behavior: smooth;

    -webkit-text-size-adjust: 100%;

    text-size-adjust: 100%;

    font-size: 16px;

  }

  .paperanubhav-page {

    font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;

    background: #f8fafc;

    color: #0f172a;

    line-height: 1.55;

    -webkit-font-smoothing: antialiased;

    -moz-osx-font-smoothing: grayscale;

    overflow-x: hidden;

  }

  .paperanubhav-page img, .paperanubhav-page svg { max-width: 100%; height: auto; display: block; }

  .paperanubhav-page input, .paperanubhav-page button, .paperanubhav-page textarea, .paperanubhav-page select { font: inherit; color: inherit; }

  .paperanubhav-page button { cursor: pointer; border: none; background: none; }

  .paperanubhav-page a { color: inherit; text-decoration: none; }

  .paperanubhav-page ul, .paperanubhav-page ol { list-style: none; }

  /* ==========================================================================

     2. VARIABLES

     ========================================================================== */

  .paperanubhav-page {

    --color-surface: #ffffff;

    --color-text: #0f172a;

    --color-text-muted: #64748b;

    --color-text-soft: #475569;

    --color-border: #e2e8f0;

    --color-border-soft: #f1f5f9;

    --color-primary: #3b82f6;

    --color-primary-dark: #2563eb;

    --color-primary-light: #dbeafe;

    --color-dark: #0f172a;

    --color-dark-soft: #1e293b;

    --color-success: #22c55e;

    --radius-sm: 12px;

    --radius-md: 16px;

    --radius-lg: 20px;

    --radius-xl: 28px;

    --radius-pill: 60px;

    --shadow-md: 0 8px 20px -8px rgba(15, 23, 42, 0.1);

    --shadow-lg: 0 16px 32px -12px rgba(15, 23, 42, 0.14);

    --shadow-xl: 0 25px 50px -12px rgba(15, 23, 42, 0.18);

    --max-width: 1200px;

    --gutter: clamp(1rem, 0.5rem + 2vw, 1.5rem);

    --transition-base: 0.25s ease;

    --transition-slow: 0.4s cubic-bezier(0.4, 0, 0.2, 1);

  }

  /* ==========================================================================

     3. TYPOGRAPHY & UTILITIES

     ========================================================================== */

  .eyebrow {

    font-size: clamp(0.7rem, 0.65rem + 0.25vw, 0.78rem);

    font-weight: 600;

    letter-spacing: 0.06em;

    text-transform: uppercase;

    color: var(--color-primary);

    margin-bottom: 0.75rem;

    line-height: 1.4;

  }

  h1, h2, h3, h4 {

    font-weight: 700;

    letter-spacing: -0.02em;

    line-height: 1.2;

    color: var(--color-text);

  }

  h1 { font-size: clamp(1.9rem, 1.5rem + 2.4vw, 3rem); }

  h2 { font-size: clamp(1.5rem, 1.2rem + 1.6vw, 2.15rem); }

  h3 { font-size: clamp(1.05rem, 0.98rem + 0.4vw, 1.25rem); }

  p { color: var(--color-text-soft); }

  .text-link {

    color: var(--color-primary);

    font-weight: 500;

    text-decoration: none;

    transition: color 0.18s ease;

    white-space: nowrap;

  }

  .text-link:hover {

    color: var(--color-primary-dark);

    text-decoration: underline;

  }

  /* ==========================================================================

     4. BUTTONS

     ========================================================================== */

  .button {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 0.5rem;

    padding: clamp(0.7rem, 0.6rem + 0.5vw, 0.85rem) clamp(1.25rem, 1rem + 1vw, 1.75rem);

    border-radius: var(--radius-pill);

    font-weight: 600;

    font-size: clamp(0.88rem, 0.84rem + 0.2vw, 0.95rem);

    text-decoration: none;

    transition: all var(--transition-base);

    border: 1px solid transparent;

    cursor: pointer;

    line-height: 1.3;

    white-space: nowrap;

    user-select: none;

    background: var(--color-dark);

    color: #ffffff;

    box-shadow: var(--shadow-md);

  }

  .button:hover {

    background: var(--color-dark-soft);

    transform: translateY(-2px);

    box-shadow: var(--shadow-lg);

  }

  .button:active { transform: translateY(0); }

  .button-ghost {

    background: transparent;

    color: var(--color-text);

    border: 1px solid #cbd5e1;

    box-shadow: none;

  }

  .button-ghost:hover {

    background: #f1f5f9;

    border-color: #94a3b8;

    box-shadow: none;

  }

  .button-light {

    background: #ffffff;

    color: var(--color-text);

    box-shadow: var(--shadow-md);

  }

  .button-light:hover {

    background: #f8fafc;

    transform: translateY(-2px);

    box-shadow: var(--shadow-lg);

  }

  /* ==========================================================================

     5. HERO (girl image on right)

     ========================================================================== */

  .hero {

    position: relative;

    width: 100%;

    padding: clamp(2.5rem, 2rem + 4vw, 5rem) var(--gutter);

    background:

      radial-gradient(circle at 12% 20%, rgba(219, 234, 254, 0.6), transparent 45%),

      radial-gradient(circle at 88% 80%, rgba(226, 232, 240, 0.6), transparent 45%),

      linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);

    overflow: hidden;

  }

  .hero::before {

    content: '';

    position: absolute;

    inset: 0;

    background-image: radial-gradient(rgba(15, 23, 42, 0.035) 1px, transparent 1px);

    background-size: 28px 28px;

    pointer-events: none;

    opacity: 0.9;

  }

  .hero-grid {

    position: relative;

    z-index: 1;

    max-width: var(--max-width);

    margin: 0 auto;

    display: grid;

    grid-template-columns: 1.1fr 0.9fr;

    gap: clamp(2rem, 1.5rem + 3vw, 4rem);

    align-items: center;

  }

  .hero-content h1 span { color: var(--color-primary); }

  .hero-copy {

    font-size: clamp(0.98rem, 0.92rem + 0.3vw, 1.12rem);

    max-width: 620px;

    margin-top: 1rem;

    line-height: 1.7;

  }

  .hero-actions {

    display: flex;

    flex-wrap: wrap;

    gap: 0.75rem;

    margin-top: 1.75rem;

  }

  .hero-image {

    position: relative;

    border-radius: var(--radius-xl);

    overflow: hidden;

    box-shadow: var(--shadow-xl);

    aspect-ratio: 4 / 5;

    background: #e2e8f0;

  }

  .hero-image img {

    width: 100%;

    height: 100%;

    object-fit: cover;

    transition: transform 0.6s ease;

  }

  .hero-image:hover img { transform: scale(1.05); }

  .hero-image::after {

    content: '';

    position: absolute;

    inset: 0;

    background: linear-gradient(180deg, transparent 60%, rgba(15, 23, 42, 0.15));

    pointer-events: none;

  }

  /* ---------- TRUST NOTE ---------- */

  .trust-note {

    display: flex;

    align-items: center;

    flex-wrap: wrap;

    gap: 0.5rem;

    font-size: clamp(0.78rem, 0.75rem + 0.15vw, 0.88rem);

    color: var(--color-text-muted);

    margin-top: 1.25rem;

  }

  .trust-note .dot {

    width: 7px;

    height: 7px;

    background: var(--color-success);

    border-radius: 50%;

    display: inline-block;

    flex-shrink: 0;

    box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.18);

    animation: pulse-dot 2s ease-in-out infinite;

  }

  @keyframes pulse-dot {

    0%, 100% { box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.18); }

    50%      { box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.08); }

  }

  /* ==========================================================================

     6. STATS BAR

     ========================================================================== */

  .stats-bar {

    width: 100%;

    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);

    color: #ffffff;

    padding: clamp(2rem, 1.5rem + 2vw, 3.5rem) var(--gutter);

    position: relative;

    overflow: hidden;

  }

  .stats-inner {

    position: relative;

    z-index: 1;

    max-width: var(--max-width);

    margin: 0 auto;

    display: grid;

    grid-template-columns: repeat(4, 1fr);

    gap: clamp(1.25rem, 1rem + 1vw, 2rem);

    text-align: center;

  }

  .stat-item {

    padding: 0.5rem;

    border-right: 1px solid rgba(148, 163, 184, 0.15);

  }

  .stat-item:last-child { border-right: none; }

  .stat-value {

    font-size: clamp(1.6rem, 1.3rem + 1.4vw, 2.25rem);

    font-weight: 700;

    color: #60a5fa;

    letter-spacing: -0.02em;

    line-height: 1.1;

    margin-bottom: 0.4rem;

  }

  .stat-label {

    font-size: clamp(0.8rem, 0.78rem + 0.15vw, 0.92rem);

    color: #cbd5e1;

    font-weight: 500;

  }

  /* ==========================================================================

     7. SECTION HEAD

     ========================================================================== */

  .section-head {

    width: 100%;

    max-width: var(--max-width);

    margin: clamp(2.5rem, 2rem + 2vw, 4rem) auto clamp(1.25rem, 1rem + 1vw, 2rem);

    padding: 0 var(--gutter);

    display: flex;

    justify-content: space-between;

    align-items: flex-end;

    flex-wrap: wrap;

    gap: 1rem;

  }

  .section-head h2 { margin: 0; }

  /* ==========================================================================

     8. FEATURE GRID

     ========================================================================== */

  .feature-grid {

    width: 100%;

    max-width: var(--max-width);

    margin: 0 auto clamp(2.5rem, 2rem + 2vw, 4rem);

    padding: 0 var(--gutter);

    display: grid;

    grid-template-columns: repeat(3, 1fr);

    gap: clamp(1rem, 0.8rem + 1vw, 1.5rem);

  }

  .feature-card {

    background: var(--color-surface);

    border: 1px solid var(--color-border);

    border-radius: var(--radius-lg);

    padding: clamp(1.5rem, 1.25rem + 1.25vw, 2.25rem);

    position: relative;

    overflow: hidden;

    transition: transform var(--transition-base), box-shadow var(--transition-base), border-color var(--transition-base);

  }

  .feature-card::before {

    content: '';

    position: absolute;

    top: 0;

    left: 0;

    width: 100%;

    height: 3px;

    background: linear-gradient(90deg, var(--color-primary), #60a5fa);

    transform: scaleX(0);

    transform-origin: left;

    transition: transform var(--transition-slow);

  }

  .feature-card:hover {

    transform: translateY(-6px);

    box-shadow: var(--shadow-lg);

    border-color: #cbd5e1;

  }

  .feature-card:hover::before { transform: scaleX(1); }

  .feature-icon {

    width: clamp(2.25rem, 2rem + 1vw, 2.75rem);

    height: clamp(2.25rem, 2rem + 1vw, 2.75rem);

    background: var(--color-primary-light);

    color: #1d4ed8;

    border-radius: var(--radius-sm);

    display: flex;

    align-items: center;

    justify-content: center;

    font-weight: 700;

    font-size: clamp(0.78rem, 0.72rem + 0.25vw, 0.92rem);

    margin-bottom: 1.25rem;

    transition: transform var(--transition-base), background var(--transition-base);

  }

  .feature-card:hover .feature-icon {

    transform: scale(1.08) rotate(-4deg);

    background: #bfdbfe;

  }

  .feature-card h3 { margin-bottom: 0.6rem; }

  .feature-card p {

    color: var(--color-text-muted);

    font-size: clamp(0.88rem, 0.85rem + 0.2vw, 0.96rem);

    line-height: 1.65;

  }

  /* ==========================================================================

     9. STEPS GRID

     ========================================================================== */

  .steps-grid {

    width: 100%;

    max-width: var(--max-width);

    margin: 0 auto clamp(2.5rem, 2rem + 2vw, 4rem);

    padding: 0 var(--gutter);

    display: grid;

    grid-template-columns: repeat(3, 1fr);

    gap: clamp(1rem, 0.8rem + 1vw, 1.5rem);

  }

  .step-card {

    background: var(--color-surface);

    border: 1px solid var(--color-border);

    border-radius: var(--radius-lg);

    padding: clamp(1.5rem, 1.25rem + 1.25vw, 2rem);

    transition: transform var(--transition-base), box-shadow var(--transition-base);

  }

  .step-card:hover {

    transform: translateY(-4px);

    box-shadow: var(--shadow-lg);

  }

  .step-number {

    width: clamp(2.25rem, 2rem + 0.75vw, 2.65rem);

    height: clamp(2.25rem, 2rem + 0.75vw, 2.65rem);

    border-radius: 50%;

    background: linear-gradient(135deg, var(--color-primary), #60a5fa);

    color: #ffffff;

    font-weight: 700;

    font-size: clamp(0.95rem, 0.9rem + 0.2vw, 1.1rem);

    display: flex;

    align-items: center;

    justify-content: center;

    margin-bottom: 1.15rem;

    box-shadow: 0 8px 16px -6px rgba(59, 130, 246, 0.45);

  }

  .step-card h3 { margin-bottom: 0.55rem; }

  .step-card p {

    color: var(--color-text-muted);

    font-size: clamp(0.88rem, 0.85rem + 0.2vw, 0.95rem);

    line-height: 1.65;

  }

  /* ==========================================================================

     10. TESTIMONIAL GRID

     ========================================================================== */

  .testimonial-grid {

    width: 100%;

    max-width: var(--max-width);

    margin: 0 auto clamp(2.5rem, 2rem + 2vw, 4rem);

    padding: 0 var(--gutter);

    display: grid;

    grid-template-columns: repeat(3, 1fr);

    gap: clamp(1rem, 0.8rem + 1vw, 1.5rem);

  }

  .testimonial-card {

    background: var(--color-surface);

    border: 1px solid var(--color-border);

    border-radius: var(--radius-lg);

    padding: clamp(1.4rem, 1.2rem + 1vw, 1.9rem);

    display: flex;

    flex-direction: column;

    gap: 1.25rem;

    position: relative;

    transition: transform var(--transition-base), box-shadow var(--transition-base);

  }

  .testimonial-card::before {

    content: '"';

    position: absolute;

    top: 0.5rem;

    right: 1.25rem;

    font-size: 4rem;

    font-family: Georgia, serif;

    color: var(--color-primary-light);

    line-height: 1;

    opacity: 0.7;

    pointer-events: none;

  }

  .testimonial-card:hover {

    transform: translateY(-4px);

    box-shadow: var(--shadow-lg);

  }

  .testimonial-quote {

    color: #334155;

    font-size: clamp(0.88rem, 0.85rem + 0.2vw, 0.95rem);

    line-height: 1.7;

    font-style: italic;

    position: relative;

    z-index: 1;

  }

  .testimonial-author {

    display: flex;

    align-items: center;

    gap: 0.85rem;

    margin-top: auto;

    padding-top: 1rem;

    border-top: 1px solid var(--color-border-soft);

  }

  .author-avatar {

    width: clamp(2.5rem, 2.25rem + 0.75vw, 2.85rem);

    height: clamp(2.5rem, 2.25rem + 0.75vw, 2.85rem);

    border-radius: 50%;

    background: linear-gradient(135deg, var(--color-primary-light), #bfdbfe);

    color: #1d4ed8;

    font-weight: 700;

    font-size: clamp(0.85rem, 0.8rem + 0.2vw, 0.95rem);

    display: flex;

    align-items: center;

    justify-content: center;

    flex-shrink: 0;

  }

  .author-name {

    font-weight: 600;

    font-size: clamp(0.85rem, 0.82rem + 0.15vw, 0.95rem);

    color: var(--color-text);

  }

  .author-role {

    font-size: clamp(0.75rem, 0.72rem + 0.15vw, 0.82rem);

    color: var(--color-text-muted);

  }

  /* ==========================================================================

     11. CTA SECTION

     ========================================================================== */

  .cta {

    width: 100%;

    background:

      radial-gradient(circle at 20% 30%, rgba(59, 130, 246, 0.25), transparent 55%),

      radial-gradient(circle at 80% 70%, rgba(96, 165, 250, 0.18), transparent 55%),

      linear-gradient(135deg, #0f172a 0%, #1e293b 100%);

    color: #ffffff;

    padding: clamp(2.5rem, 2rem + 3vw, 4.5rem) var(--gutter);

    display: flex;

    align-items: center;

    justify-content: space-between;

    flex-wrap: wrap;

    gap: 1.75rem;

    position: relative;

    overflow: hidden;

  }

  .cta::before {

    content: '';

    position: absolute;

    inset: 0;

    background-image: radial-gradient(rgba(255, 255, 255, 0.06) 1px, transparent 1px);

    background-size: 30px 30px;

    pointer-events: none;

  }

  .cta > div,

  .cta > a {

    position: relative;

    z-index: 1;

  }

  .cta > div {

    max-width: 640px;

    margin-left: auto;

    padding-left: var(--gutter);

    flex: 1 1 320px;

  }

  .cta h2 {

    color: #ffffff;

    margin-bottom: 0.75rem;

    letter-spacing: -0.025em;

  }

  .cta p {

    color: #cbd5e1;

    font-size: clamp(0.92rem, 0.88rem + 0.25vw, 1.05rem);

    line-height: 1.65;

  }

  .cta > a {

    margin-right: auto;

    padding-right: var(--gutter);

    flex-shrink: 0;

  }

  /* ==========================================================================

     12. RESPONSIVE — TABLETS

     ========================================================================== */

  @media (max-width: 900px) {

    .hero-grid { grid-template-columns: 1fr; gap: 2.5rem; }

    .hero-image {

      aspect-ratio: 16 / 10;

      max-width: 520px;

      margin: 0 auto;

      width: 100%;

    }

    .stats-inner {

      grid-template-columns: repeat(2, 1fr);

      gap: 1.75rem;

    }

    .stat-item {

      border-right: none;

      border-bottom: 1px solid rgba(148, 163, 184, 0.12);

      padding-bottom: 1.5rem;

    }

    .stat-item:nth-last-child(-n+2) {

      border-bottom: none;

      padding-bottom: 0.5rem;

    }

    .feature-grid,

    .steps-grid,

    .testimonial-grid {

      grid-template-columns: 1fr;

      gap: 1.25rem;

    }

    .cta {

      flex-direction: column;

      align-items: flex-start;

      text-align: left;

    }

    .cta > div { margin-left: 0; padding-left: 0; }

    .cta > a { margin-right: 0; padding-right: 0; }

    .section-head {

      flex-direction: column;

      align-items: flex-start;

      gap: 0.75rem;

    }

  }

  /* ==========================================================================

     13. RESPONSIVE — LARGE PHONES

     ========================================================================== */

  @media (max-width: 640px) {

    :root {

      --gutter: 1rem;

      --radius-lg: 16px;

      --radius-xl: 20px;

    }

    .hero { padding-top: 2rem; }

    .hero-actions {

      flex-direction: column;

      align-items: stretch;

    }

    .hero-actions .button {

      width: 100%;

      justify-content: center;

    }

    .stats-inner { gap: 1.25rem; }

    .section-head { margin-top: 2.5rem; }

  }

  /* ==========================================================================

     14. RESPONSIVE — SMALL PHONES

     ========================================================================== */

  @media (max-width: 420px) {

    html { font-size: 15px; }

    .hero { padding-top: 1.75rem; }

    .hero h1 { font-size: 1.6rem; }

    .hero-copy { font-size: 0.92rem; }

    .hero-image { aspect-ratio: 4 / 3; }

    .stats-inner { grid-template-columns: 1fr; gap: 1.25rem; }

    .stat-item {

      border-bottom: 1px solid rgba(148, 163, 184, 0.12);

      padding-bottom: 1.1rem;

    }

    .stat-item:last-child {

      border-bottom: none;

      padding-bottom: 0.5rem;

    }

    .feature-card,

    .step-card,

    .testimonial-card {

      padding: 1.25rem 1.1rem;

    }

    .step-number {

      width: 2.25rem;

      height: 2.25rem;

      font-size: 0.95rem;

    }

    .cta { padding: 2.25rem 1rem; }

    .cta h2 { font-size: 1.35rem; }

  }

  /* ==========================================================================

     15. VERY SMALL

     ========================================================================== */

  @media (max-width: 320px) {

    html { font-size: 14px; }

    .button { padding: 0.7rem 1.1rem; font-size: 0.85rem; }

    .hero h1 { font-size: 1.45rem; }

  }

  /* ==========================================================================

     16. LANDSCAPE PHONE

     ========================================================================== */

  @media (max-height: 600px) and (orientation: landscape) {

    .hero { padding-top: 1.75rem; padding-bottom: 1.75rem; }

    .stats-bar { padding: 1.75rem 0; }

  }

  /* ==========================================================================

     17. ACCESSIBILITY — REDUCED MOTION

     ========================================================================== */

  @media (prefers-reduced-motion: reduce) {

    *, *::before, *::after {

      animation-duration: 0.01ms !important;

      animation-iteration-count: 1 !important;

      transition-duration: 0.01ms !important;

      scroll-behavior: auto !important;

    }

    .trust-note .dot { animation: none; }

  }

  /* ==========================================================================

     18. PRINT

     ========================================================================== */

  @media print {

    .stats-bar, .cta, .testimonial-grid { display: none; }

    body { background: #ffffff; }

    .hero::before { display: none; }

  }

  /* RESPONSIVE AND LAYOUT FIXES */

  .paperanubhav-page {

    width: 100%;

    max-width: 100%;

    margin: 0;

    overflow-x: clip;

  }

  .paperanubhav-page .hero,

  .paperanubhav-page .stats-bar,

  .paperanubhav-page .cta {

    width: 100%;

    max-width: none;

  }

  .paperanubhav-page .hero-grid,

  .paperanubhav-page .stats-inner,

  .paperanubhav-page .feature-grid,

  .paperanubhav-page .steps-grid,

  .paperanubhav-page .testimonial-grid {

    min-width: 0;

  }

  .paperanubhav-page .hero-grid > *,

  .paperanubhav-page .feature-card,

  .paperanubhav-page .step-card,

  .paperanubhav-page .testimonial-card {

    min-width: 0;

  }

  .paperanubhav-page h1,

  .paperanubhav-page h2,

  .paperanubhav-page h3,

  .paperanubhav-page p {

    overflow-wrap: anywhere;

  }

  .paperanubhav-page .hero-image {

    width: 100%;

    min-width: 0;

  }

  .paperanubhav-page .hero-image img {

    width: 100%;

    height: 100%;

    object-fit: cover;

  }

  @media (min-width: 901px) {

    .paperanubhav-page .feature-grid,

    .paperanubhav-page .steps-grid,

    .paperanubhav-page .testimonial-grid {

      grid-template-columns: repeat(3, minmax(0, 1fr));

    }

  }

  @media (max-width: 900px) {

    .paperanubhav-page .hero-grid {

      grid-template-columns: minmax(0, 1fr);

    }

    .paperanubhav-page .hero-image {

      max-width: 560px;

      margin: 0 auto;

      aspect-ratio: 16 / 10;

    }

    .paperanubhav-page .feature-grid,

    .paperanubhav-page .steps-grid,

    .paperanubhav-page .testimonial-grid {

      grid-template-columns: repeat(2, minmax(0, 1fr));

    }

    .paperanubhav-page .cta {

      flex-direction: column;

      align-items: flex-start;

      text-align: left;

    }

    .paperanubhav-page .cta > div {

      margin-left: 0;

      padding-left: 0;

    }

    .paperanubhav-page .cta > a {

      margin-right: 0;

      padding-right: 0;

    }

  }

  @media (max-width: 640px) {

    .paperanubhav-page .hero {

      padding: 2rem 1rem;

    }

    .paperanubhav-page .hero-grid {

      gap: 1.5rem;

    }

    .paperanubhav-page .hero-actions {

      flex-direction: column;

      align-items: stretch;

    }

    .paperanubhav-page .hero-actions .button {

      width: 100%;

      white-space: normal;

      text-align: center;

    }

    .paperanubhav-page .feature-grid,

    .paperanubhav-page .steps-grid,

    .paperanubhav-page .testimonial-grid {

      grid-template-columns: minmax(0, 1fr);

    }

    .paperanubhav-page .section-head,

    .paperanubhav-page .feature-grid,

    .paperanubhav-page .steps-grid,

    .paperanubhav-page .testimonial-grid {

      padding-left: 1rem;

      padding-right: 1rem;

    }

    .paperanubhav-page .hero-image {

      max-width: 100%;

      aspect-ratio: 4 / 3;

    }

    .paperanubhav-page .cta {

      padding: 2rem 1rem;

    }

    .paperanubhav-page .cta > div {

      flex: 1 1 100%;

      max-width: 100%;

    }

  }

  @media (max-width: 420px) {

    .paperanubhav-page .stats-inner {

      grid-template-columns: repeat(2, minmax(0, 1fr));

      gap: 1rem;

    }

    .paperanubhav-page .stat-item {

      padding: .5rem .25rem 1rem;

    }

    .paperanubhav-page .stat-value {

      font-size: 1.45rem;

    }

    .paperanubhav-page .stat-label {

      font-size: .78rem;

    }

  }

  @media (max-width: 320px) {

    .paperanubhav-page .stats-inner {

      grid-template-columns: minmax(0, 1fr);

    }

  }

  /* =====================================================================

     FULL-WIDTH LAYOUT + OPEN EDITORIAL SECTIONS (NO CARD UI)

     ===================================================================== */

  .paperanubhav-page {

    width: 100%;

    max-width: none;

    min-height: 100vh;

    overflow-x: clip;

  }

  .paperanubhav-page .hero,

  .paperanubhav-page .stats-bar,

  .paperanubhav-page .cta,

  .paperanubhav-page .examconnect-footer {

    width: 100%;

  }

  .paperanubhav-page .hero-grid,

  .paperanubhav-page .stats-inner,

  .paperanubhav-page .section-head,

  .paperanubhav-page .feature-grid,

  .paperanubhav-page .steps-grid,

  .paperanubhav-page .testimonial-grid,

  .paperanubhav-page .cta-inner,

  .paperanubhav-page .footer-inner {

    width: 100%;

    max-width: none;

    margin-left: 0;

    margin-right: 0;

  }

  .paperanubhav-page .hero-grid {

    grid-template-columns: minmax(0, 1.1fr) minmax(280px, .9fr);

    gap: clamp(2rem, 4vw, 5rem);

    padding-inline: clamp(1.25rem, 4vw, 4.5rem);

  }

  .paperanubhav-page .hero {

    min-height: min(720px, calc(100vh - 70px));

    display: flex;

    align-items: center;

    padding: clamp(3rem, 6vw, 6rem) 0;

  }

  .paperanubhav-page .hero-content { min-width: 0; }

  .paperanubhav-page .hero-content h1 { max-width: 900px; font-size: clamp(2.4rem, 4.6vw, 5.2rem); }

  .paperanubhav-page .hero-copy { max-width: 760px; font-size: clamp(1rem, 1.2vw, 1.2rem); }

  .paperanubhav-page .hero-image {

    width: 100%;

    max-height: 620px;

    aspect-ratio: 5 / 4;

    border-radius: 8px;

    box-shadow: none;

  }

  .paperanubhav-page .stats-inner {

    grid-template-columns: repeat(4, minmax(0, 1fr));

    padding-inline: clamp(1.25rem, 4vw, 4.5rem);

    gap: 0;

  }

  .paperanubhav-page .section-head {

    padding-inline: clamp(1.25rem, 4vw, 4.5rem);

    margin-top: clamp(3rem, 6vw, 6rem);

    margin-bottom: clamp(1.5rem, 3vw, 2.5rem);

  }

  .paperanubhav-page .feature-grid,

  .paperanubhav-page .steps-grid,

  .paperanubhav-page .testimonial-grid {

    padding-inline: clamp(1.25rem, 4vw, 4.5rem);

    gap: 0;

  }

  .paperanubhav-page .feature-grid,

  .paperanubhav-page .steps-grid,

  .paperanubhav-page .testimonial-grid {

    grid-template-columns: repeat(3, minmax(0, 1fr));

    align-items: stretch;

  }

  .paperanubhav-page .feature-card,

  .paperanubhav-page .step-card,

  .paperanubhav-page .testimonial-card {

    background: transparent;

    border: 0;

    border-radius: 0;

    box-shadow: none;

    transform: none;

    padding: clamp(1.5rem, 2.5vw, 3rem) clamp(1rem, 2vw, 2rem);

    overflow: visible;

    min-width: 0;

  }

  .paperanubhav-page .feature-card + .feature-card,

  .paperanubhav-page .step-card + .step-card,

  .paperanubhav-page .testimonial-card + .testimonial-card {

    border-left: 1px solid var(--color-border);

  }

  .paperanubhav-page .feature-card::before,

  .paperanubhav-page .testimonial-card::before { display: none; }

  .paperanubhav-page .feature-card:hover,

  .paperanubhav-page .step-card:hover,

  .paperanubhav-page .testimonial-card:hover {

    transform: none;

    box-shadow: none;

    border-color: var(--color-border);

  }

  .paperanubhav-page .feature-icon {

    border-radius: 4px;

    box-shadow: none;

  }

  .paperanubhav-page .testimonial-card { gap: 1.25rem; }

  .paperanubhav-page .testimonial-author { margin-top: auto; }

  .paperanubhav-page .cta {

    padding: clamp(3rem, 6vw, 6rem) clamp(1.25rem, 4vw, 4.5rem);

  }

  .paperanubhav-page .cta > div { margin-left: 0; padding-left: 0; max-width: 900px; }

  .paperanubhav-page .cta > a { margin-right: 0; padding-right: 0; }

  .paperanubhav-page .examconnect-footer {

    background: #080f1e;

    color: #e2e8f0;

    padding: clamp(2.5rem, 5vw, 4.5rem) clamp(1.25rem, 4vw, 4.5rem) 1.25rem;

  }

  .paperanubhav-page .footer-inner {

    display: grid;

    grid-template-columns: minmax(240px, 1.5fr) repeat(3, minmax(140px, 1fr));

    gap: clamp(2rem, 4vw, 5rem);

    padding-bottom: 2.5rem;

  }

  .paperanubhav-page .footer-brand h2 {

    color: #fff;

    font-size: 1.5rem;

    margin-bottom: .8rem;

    letter-spacing: -.03em;

  }

  .paperanubhav-page .footer-brand p {

    color: #94a3b8;

    max-width: 440px;

    line-height: 1.8;

  }

  .paperanubhav-page .footer-column h3 {

    color: #fff;

    font-size: .95rem;

    margin-bottom: 1rem;

    letter-spacing: 0;

  }

  .paperanubhav-page .footer-links { display: grid; gap: .75rem; }

  .paperanubhav-page .footer-links a {

    color: #94a3b8;

    font-size: .92rem;

    transition: color .2s ease;

    overflow-wrap: anywhere;

  }

  .paperanubhav-page .footer-links a:hover { color: #93c5fd; }

  .paperanubhav-page .footer-bottom {

    border-top: 1px solid rgba(148,163,184,.18);

    padding-top: 1.25rem;

    display: flex;

    align-items: center;

    justify-content: space-between;

    flex-wrap: wrap;

    gap: .75rem 1.5rem;

    color: #94a3b8;

    font-size: .85rem;

  }

  .paperanubhav-page .footer-bottom p { color: #94a3b8; }

  .paperanubhav-page .footer-bottom-links { display: flex; flex-wrap: wrap; gap: 1rem; }

  .paperanubhav-page .footer-bottom-links a:hover { color: #fff; }

  @media (max-width: 900px) {

    .paperanubhav-page .hero { min-height: auto; }

    .paperanubhav-page .hero-grid { grid-template-columns: 1fr; padding-inline: var(--gutter); }

    .paperanubhav-page .hero-image { max-width: 100%; max-height: 460px; aspect-ratio: 16 / 9; }

    .paperanubhav-page .feature-grid,

    .paperanubhav-page .steps-grid,

    .paperanubhav-page .testimonial-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }

    .paperanubhav-page .feature-card:nth-child(odd),

    .paperanubhav-page .step-card:nth-child(odd),

    .paperanubhav-page .testimonial-card:nth-child(odd) { border-left: 0; }

    .paperanubhav-page .feature-card:nth-child(n+3),

    .paperanubhav-page .step-card:nth-child(n+3),

    .paperanubhav-page .testimonial-card:nth-child(n+3) { border-top: 1px solid var(--color-border); }

    .paperanubhav-page .footer-inner { grid-template-columns: repeat(2, minmax(0, 1fr)); }

  }

  @media (max-width: 600px) {

    .paperanubhav-page .hero { padding-block: 2.5rem; }

    .paperanubhav-page .hero-content h1 { font-size: clamp(2rem, 9vw, 3rem); }

    .paperanubhav-page .hero-actions { flex-direction: column; align-items: stretch; }

    .paperanubhav-page .hero-actions .button { width: 100%; white-space: normal; }

    .paperanubhav-page .stats-inner { grid-template-columns: repeat(2, minmax(0, 1fr)); row-gap: 1.5rem; }

    .paperanubhav-page .stat-item { border-right: 0; padding: .75rem .35rem; }

    .paperanubhav-page .stat-item:nth-child(odd) { border-right: 1px solid rgba(148,163,184,.15); }

    .paperanubhav-page .stat-item:nth-last-child(-n+2) { border-bottom: 0; }

    .paperanubhav-page .section-head { align-items: flex-start; }

    .paperanubhav-page .feature-grid,

    .paperanubhav-page .steps-grid,

    .paperanubhav-page .testimonial-grid { grid-template-columns: 1fr; }

    .paperanubhav-page .feature-card,

    .paperanubhav-page .step-card,

    .paperanubhav-page .testimonial-card { padding: 1.5rem 0; border-left: 0 !important; }

    .paperanubhav-page .feature-card + .feature-card,

    .paperanubhav-page .step-card + .step-card,

    .paperanubhav-page .testimonial-card + .testimonial-card { border-top: 1px solid var(--color-border); }

    .paperanubhav-page .footer-inner { grid-template-columns: 1fr 1fr; gap: 2rem 1.25rem; }

    .paperanubhav-page .footer-brand { grid-column: 1 / -1; }

    .paperanubhav-page .footer-bottom { align-items: flex-start; flex-direction: column; }

  }

  @media (max-width: 360px) {

    .paperanubhav-page .footer-inner { grid-template-columns: 1fr; }

    .paperanubhav-page .footer-brand { grid-column: auto; }

  }

  /* FINAL OVERRIDES: full-bleed page + isolate styles from layouts.app */

  .paperanubhav-page {

    width: 100vw !important;

    max-width: none !important;

    position: relative !important;

    left: 50% !important;

    margin-left: -50vw !important;

    margin-right: 0 !important;

    overflow: clip;

    isolation: isolate;

  }

  .paperanubhav-page,

  .paperanubhav-page * {

    box-sizing: border-box !important;

  }

  .paperanubhav-page .hero,

  .paperanubhav-page .stats-bar,

  .paperanubhav-page .cta,

  .paperanubhav-page .examconnect-footer {

    width: 100% !important;

    max-width: none !important;

    margin-left: 0 !important;

    margin-right: 0 !important;

    border-radius: 0;

  }

  .paperanubhav-page .hero-grid,

  .paperanubhav-page .stats-inner,

  .paperanubhav-page .footer-inner,

  .paperanubhav-page .footer-bottom {

    width: 100%;

    max-width: 1440px;

    margin-left: auto;

    margin-right: auto;

  }

  .paperanubhav-page .section-head,

  .paperanubhav-page .feature-grid,

  .paperanubhav-page .steps-grid,

  .paperanubhav-page .testimonial-grid {

    width: 100% !important;

    max-width: 1440px !important;

    margin-left: auto !important;

    margin-right: auto !important;

  }

  .paperanubhav-page .button,

  .paperanubhav-page a.button,

  .paperanubhav-page a.button:visited {

    display: inline-flex !important;

    align-items: center;

    justify-content: center;

    min-height: 44px;

    opacity: 1 !important;

    visibility: visible !important;

    text-indent: 0 !important;

    font-size: .95rem !important;

    font-weight: 700 !important;

    line-height: 1.35 !important;

    text-decoration: none !important;

    color: #fff !important;

    background: #0f172a !important;

    border: 1px solid transparent !important;

    padding: .8rem 1.35rem !important;

    box-shadow: 0 8px 20px -8px rgba(15,23,42,.25) !important;

  }

  .paperanubhav-page a.button.button-ghost,

  .paperanubhav-page a.button.button-ghost:visited {

    color: #0f172a !important;

    background: #fff !important;

    border-color: #cbd5e1 !important;

    box-shadow: none !important;

  }

  .paperanubhav-page a.button.button-light,

  .paperanubhav-page a.button.button-light:visited {

    color: #0f172a !important;

    background: #fff !important;

    border-color: #fff !important;

  }

  .paperanubhav-page .cta > a.button { flex: 0 0 auto; }

  .paperanubhav-page .examconnect-footer { display: block !important; }

  .paperanubhav-page .footer-column h3 { margin: 0 0 .85rem; }

  .paperanubhav-page .footer-links a { display: inline-block; }

  @media (max-width: 768px) {

    .paperanubhav-page { left: 50% !important; margin-left: -50vw !important; }

    .paperanubhav-page .hero-grid { grid-template-columns: minmax(0, 1fr) !important; }

    .paperanubhav-page .hero-content h1 { overflow-wrap: anywhere; }

    .paperanubhav-page .cta { align-items: flex-start; }

    .paperanubhav-page .cta > a.button { width: 100%; }

  }


  /* Interactive India globe */
  .paperanubhav-page .india-globe-panel,
  .paperanubhav-page .india-globe-panel:hover {
    border: 0 !important;
    outline: 0 !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    background: transparent !important;
    background-image: none !important;
    padding: 0 !important;
  }

  .paperanubhav-page .india-globe-panel::before,
  .paperanubhav-page .india-globe-panel::after {
    content: none !important;
    display: none !important;
  }

  .paperanubhav-page .india-globe-panel {
    position: relative;
    background-color: transparent !important;
    width: 100%;
    max-width: none;
    min-height: 480px;
    aspect-ratio: 1 / 1;
    overflow: hidden;
    isolation: isolate;
    border: 0;
    border-radius: 0;
    background: transparent !important;
    box-shadow: none;
  }

  .paperanubhav-page .india-globe-panel::before {
    content: none !important;
    display: none !important;
  }

  .paperanubhav-page #india-globe-3d {
    position: relative;
    display: block;
    width: 100%;
    height: 100%;
    min-height: 480px;
    cursor: grab;
    touch-action: pan-y;
    outline: none;
  }

  .paperanubhav-page #india-globe-3d:active { cursor: grabbing; }
  .paperanubhav-page #india-globe-3d:focus-visible {
    outline: 2px solid #93c5fd;
    outline-offset: -5px;
  }
  .paperanubhav-page #india-globe-3d { background: transparent !important; }
  .paperanubhav-page #india-globe-3d canvas { display:block; width:100%; height:100%; background: transparent !important; }

  .paperanubhav-page .globe-topline {
    position: absolute;
    top: 22px;
    left: 22px;
    right: 22px;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 9px;
    color: #bfdbfe;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .14em;
  }

  .paperanubhav-page .globe-live-dot {
    width: 7px;
    height: 7px;
    flex: 0 0 7px;
    border-radius: 50%;
    background: #34d399;
    box-shadow: 0 0 0 4px rgba(52, 211, 153, .12), 0 0 14px rgba(52, 211, 153, .8);
    animation: pa-globe-pulse 1.8s ease-in-out infinite;
  }

  .paperanubhav-page .globe-live-label {
    margin-left: auto;
    color: #64748b;
    font-size: 9px;
    letter-spacing: .1em;
  }

  .paperanubhav-page .globe-hint {
    position: absolute;
    left: 50%;
    bottom: 100px;
    z-index: 2;
    width: max-content;
    max-width: calc(100% - 32px);
    transform: translateX(-50%);
    color: #94a3b8;
    text-align: center;
    font-size: 11px;
    letter-spacing: .02em;
    pointer-events: none;
  }

  .paperanubhav-page .globe-city-readout {
    position: absolute;
    left: 22px;
    bottom: 22px;
    z-index: 2;
    display: flex;
    flex-direction: column;
    gap: 3px;
    padding-left: 12px;
    border-left: 2px solid #60a5fa;
    pointer-events: none;
  }

  .paperanubhav-page .globe-readout-kicker {
    color: #64748b;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: .13em;
  }

  .paperanubhav-page .globe-city-readout strong {
    color: #f8fafc;
    font-family: 'Manrope', sans-serif;
    font-size: 21px;
    font-weight: 800;
    line-height: 1.25;
  }

  .paperanubhav-page .globe-city-readout > span:last-child {
    color: #94a3b8;
    font-size: 11px;
  }

  .paperanubhav-page .globe-legend {
    position: absolute;
    right: 20px;
    bottom: 24px;
    z-index: 2;
    display: grid;
    gap: 8px;
    color: #94a3b8;
    font-size: 10px;
    pointer-events: none;
  }

  .paperanubhav-page .globe-legend span {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 7px;
  }

  .paperanubhav-page .legend-dot {
    display: inline-block;
    width: 6px;
    height: 6px;
    border-radius: 50%;
  }

  .paperanubhav-page .legend-dot-city {
    background: #60a5fa;
    box-shadow: 0 0 8px #60a5fa;
  }

  .paperanubhav-page .legend-dot-orbit {
    background: #34d399;
    box-shadow: 0 0 8px #34d399;
  }

  @keyframes pa-globe-pulse {
    0%, 100% { box-shadow: 0 0 0 4px rgba(52, 211, 153, .12), 0 0 14px rgba(52, 211, 153, .8); }
    50% { box-shadow: 0 0 0 7px rgba(52, 211, 153, .04), 0 0 19px rgba(52, 211, 153, .65); }
  }

  @media (max-width: 900px) {
    .paperanubhav-page .india-globe-panel {
      min-height: 420px;
      max-width: 650px;
      margin-inline: auto;
      aspect-ratio: 1 / 1;
    }
    .paperanubhav-page #india-globe-3d { min-height: 420px; }
  }

  @media (max-width: 480px) {
    .paperanubhav-page .india-globe-panel {
      min-height: 350px;
      border-radius: 20px;
    }
    .paperanubhav-page #india-globe-3d { min-height: 350px; }
    .paperanubhav-page .globe-topline { top: 16px; left: 15px; right: 15px; font-size: 8px; }
    .paperanubhav-page .globe-live-label { font-size: 7px; }
    .paperanubhav-page .globe-city-readout { left: 15px; bottom: 16px; }
    .paperanubhav-page .globe-city-readout strong { font-size: 17px; }
    .paperanubhav-page .globe-legend { right: 14px; bottom: 18px; font-size: 8px; }
    .paperanubhav-page .globe-hint { bottom: 82px; font-size: 9px; }
  }

  @media (prefers-reduced-motion: reduce) {
    .paperanubhav-page .globe-live-dot { animation: none; }
  }


</style>



<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">



<section class="hero" data-aos="fade-up">

  <div class="hero-grid">

    <div class="hero-content">

      <div class="eyebrow">A community for every exam journey</div>

      <h1>Real exam experiences.<br><span>Better preparation.</span></h1>

      <p class="hero-copy">Read candidate-reported shift reviews, compare difficulty, share what you experienced, and help the next student prepare with more confidence.</p>

      <div class="hero-actions">

        <a class="button" href="<?php echo e(route('exams.index')); ?>">Explore exams <span>→</span></a>

        <a class="button button-ghost" href="<?php echo e(route('register')); ?>">Share your experience</a>

      </div>

      <div class="trust-note">

        <span class="dot"></span> Transparent labels · Community moderation · Candidate-first

      </div>

    </div>

    <div class="india-globe-panel" data-aos="fade-left" data-aos-delay="200" aria-label="Real 3D Earth globe with illustrative Indian city hubs and animated connections">
      <div id="india-globe-3d" tabindex="0" role="application" aria-label="Real 3D Earth globe. Drag to rotate, scroll to zoom, and select glowing Indian city markers."></div>

    </div>

  </div>

</section>



<section class="stats-bar" data-aos="fade-up">

  <div class="stats-inner">

    <div class="stat-item" data-aos="zoom-in" data-aos-delay="0">

      <div class="stat-value">12,000+</div>

      <div class="stat-label">Candidate reviews</div>

    </div>

    <div class="stat-item" data-aos="zoom-in" data-aos-delay="100">

      <div class="stat-value">340+</div>

      <div class="stat-label">Exams covered</div>

    </div>

    <div class="stat-item" data-aos="zoom-in" data-aos-delay="200">

      <div class="stat-value">98%</div>

      <div class="stat-label">Helpful ratings</div>

    </div>

    <div class="stat-item" data-aos="zoom-in" data-aos-delay="300">

      <div class="stat-value">24/7</div>

      <div class="stat-label">Community active</div>

    </div>

  </div>

</section>



<section class="section-head" data-aos="fade-up">

  <div>

    <div class="eyebrow">Explore the community</div>

    <h2>What candidates are talking about</h2>

  </div>

  <a class="text-link" href="<?php echo e(route('exams.index')); ?>">Browse all exams →</a>

</section>

<div class="feature-grid">

  <article class="feature-card" data-aos="fade-up" data-aos-delay="0">

    <div class="feature-icon">01</div>

    <h3>Shift-wise reviews</h3>

    <p>Read difficulty ratings, subject breakdowns and exam-day observations from candidates.</p>

  </article>

  <article class="feature-card" data-aos="fade-up" data-aos-delay="100">

    <div class="feature-icon">02</div>

    <h3>Remembered questions</h3>

    <p>Share memory-based questions with clear labels when an answer has not been verified.</p>

  </article>

  <article class="feature-card" data-aos="fade-up" data-aos-delay="200">

    <div class="feature-icon">03</div>

    <h3>Help the next aspirant</h3>

    <p>Discuss preparation strategies, resources, time management and lessons learned.</p>

  </article>

</div>



<section class="section-head" data-aos="fade-up">

  <div>

    <div class="eyebrow">How it works</div>

    <h2>Three steps to better preparation</h2>

  </div>

</section>

<div class="steps-grid">

  <div class="step-card" data-aos="fade-up" data-aos-delay="0">

    <div class="step-number">1</div>

    <h3>Create your account</h3>

    <p>Sign up in seconds and join a community built for exam aspirants like you.</p>

  </div>

  <div class="step-card" data-aos="fade-up" data-aos-delay="100">

    <div class="step-number">2</div>

    <h3>Read real experiences</h3>

    <p>Explore shift-wise reviews, difficulty ratings, and remembered questions.</p>

  </div>

  <div class="step-card" data-aos="fade-up" data-aos-delay="200">

    <div class="step-number">3</div>

    <h3>Share what you know</h3>

    <p>Contribute your experience and help the next aspirant prepare with confidence.</p>

  </div>

</div>



<section class="section-head" data-aos="fade-up">

  <div>

    <div class="eyebrow">Community voices</div>

    <h2>Trusted by aspirants across India</h2>

  </div>

</section>

<div class="testimonial-grid">

  <article class="testimonial-card" data-aos="fade-up" data-aos-delay="0">

    <p class="testimonial-quote">"The shift-wise reviews helped me understand exactly what to expect. I walked into my exam far more confident."</p>

    <div class="testimonial-author">

      <div class="author-avatar">AK</div>

      <div>

        <div class="author-name">Aarav Kumar</div>

        <div class="author-role">SSC CGL Aspirant</div>

      </div>

    </div>

  </article>

  <article class="testimonial-card" data-aos="fade-up" data-aos-delay="100">

    <p class="testimonial-quote">"Being able to read real candidate experiences — not just coaching material — changed how I prepared."</p>

    <div class="testimonial-author">

      <div class="author-avatar">PS</div>

      <div>

        <div class="author-name">Priya Sharma</div>

        <div class="author-role">Banking Aspirant</div>

      </div>

    </div>

  </article>

  <article class="testimonial-card" data-aos="fade-up" data-aos-delay="200">

    <p class="testimonial-quote">"I shared my shift experience and got messages from juniors thanking me. That feeling is unmatched."</p>

    <div class="testimonial-author">

      <div class="author-avatar">RM</div>

      <div>

        <div class="author-name">Rohit Mehta</div>

        <div class="author-role">Railways Aspirant</div>

      </div>

    </div>

  </article>

</div>



<section class="cta" data-aos="fade-up">

  <div>

    <h2>Your experience could help someone.</h2>

    <p>Share what you remember. Be honest about uncertainty. Help build a more useful exam community.</p>

  </div>

  <a class="button button-light" href="<?php echo e(route('register')); ?>">Join PaperAnubhav</a>

</section>



<footer class="examconnect-footer" data-aos="fade-up">

  <div class="footer-inner">

    <div class="footer-brand">

      <h2>PaperAnubhav<span style="color:#60a5fa">.</span></h2>

      <p>A community built around real exam experiences. Learn from candidate-reported reviews, share what you know, and help the next aspirant prepare with confidence.</p>

    </div>

    <div class="footer-column">

      <h3>Explore</h3>

      <ul class="footer-links">

        <li><a href="<?php echo e(route('exams.index')); ?>">Browse exams</a></li>

        <li><a href="<?php echo e(route('exams.index')); ?>">Candidate reviews</a></li>

        <li><a href="<?php echo e(route('exams.index')); ?>">Shift-wise experiences</a></li>

      </ul>

    </div>

    <div class="footer-column">

      <h3>Community</h3>

      <ul class="footer-links">

        <li><a href="<?php echo e(route('register')); ?>">Join PaperAnubhav</a></li>

        <li><a href="<?php echo e(route('login')); ?>">Sign in</a></li>

        <li><a href="<?php echo e(route('register')); ?>">Share an experience</a></li>

      </ul>

    </div>

    <div class="footer-column">

      <h3>Our principles</h3>

      <ul class="footer-links">

        <li><a href="<?php echo e(route('exams.index')); ?>">Candidate-first content</a></li>

        <li><a href="<?php echo e(route('exams.index')); ?>">Clear uncertainty labels</a></li>

        <li><a href="<?php echo e(route('exams.index')); ?>">Community moderation</a></li>

      </ul>

    </div>

  </div>

  <div class="footer-bottom">

    <p>&copy; <?php echo e(date('Y')); ?> PaperAnubhav. Built for every exam journey.</p>

    <div class="footer-bottom-links">

      <a href="<?php echo e(route('exams.index')); ?>">Explore exams</a>

      <a href="<?php echo e(route('register')); ?>">Join the community</a>

    </div>

  </div>

</footer>


<script src="https://unpkg.com/globe.gl@2.45.0/dist/globe.gl.min.js"></script>
<script>
(() => {
  const host = document.getElementById('india-globe-3d');
  if (!host || typeof Globe === 'undefined') {
    if (host) host.innerHTML = '<p style="padding:24px;color:#dbeafe">The 3D globe could not load. Please check your internet connection and allow the globe.gl CDN.</p>';
    return;
  }

  const nameEl = document.getElementById('globe-city-name');
  const regionEl = document.getElementById('globe-city-region');
  const hintEl = document.getElementById('globe-hint');
  const cities = [
    { name:'Srinagar', region:'Northern India', lat:34.08, lng:74.80 },
    { name:'Chandigarh', region:'Northern India', lat:30.73, lng:76.78 },
    { name:'New Delhi', region:'Northern India', lat:28.61, lng:77.21 },
    { name:'Jaipur', region:'Western India', lat:26.91, lng:75.79 },
    { name:'Lucknow', region:'Northern India', lat:26.85, lng:80.95 },
    { name:'Patna', region:'Eastern India', lat:25.61, lng:85.14 },
    { name:'Ahmedabad', region:'Western India', lat:23.02, lng:72.57 },
    { name:'Bhopal', region:'Central India', lat:23.26, lng:77.41 },
    { name:'Kolkata', region:'Eastern India', lat:22.57, lng:88.36 },
    { name:'Mumbai', region:'Western India', lat:19.08, lng:72.88 },
    { name:'Hyderabad', region:'Southern India', lat:17.39, lng:78.49 },
    { name:'Pune', region:'Western India', lat:18.52, lng:73.86 },
    { name:'Guwahati', region:'North-East India', lat:26.14, lng:91.74 },
    { name:'Bengaluru', region:'Southern India', lat:12.97, lng:77.59 },
    { name:'Chennai', region:'Southern India', lat:13.08, lng:80.27 },
    { name:'Kochi', region:'Southern India', lat:9.93, lng:76.27 }
  ];

  const byName = Object.fromEntries(cities.map(c => [c.name, c]));
  const center = byName['New Delhi'];
  const arcs = cities.filter(c => c.name !== center.name).map((c, i) => ({
    startLat: center.lat, startLng: center.lng,
    endLat: c.lat, endLng: c.lng,
    color: i % 2 ? ['#60a5fa', '#22d3ee'] : ['#34d399', '#60a5fa'],
    city: c.name
  }));
  const rings = cities.map((c, i) => ({ lat:c.lat, lng:c.lng, maxR:2.2, propagationSpeed: i % 2 ? 1.4 : 1.0, repeatPeriod: 1500 + (i % 5) * 220, city:c.name }));

  const globe = Globe({
    animateIn: true,
    waitForGlobeReady: true,
    rendererConfig: { antialias:true, alpha:true, powerPreference:'high-performance' }
  })(host)
    .width(host.clientWidth || 640)
    .height(host.clientHeight || 480)
    .backgroundColor('rgba(0,0,0,0)')
    .globeImageUrl('https://unpkg.com/three-globe@2.41.12/example/img/earth-blue-marble.jpg')
    .bumpImageUrl('https://unpkg.com/three-globe@2.41.12/example/img/earth-topology.png')
    .showAtmosphere(true)
    .atmosphereColor('#60a5fa')
    .atmosphereAltitude(0.18)
    .pointsData(cities)
    .pointLat('lat')
    .pointLng('lng')
    .pointColor(() => '#34d399')
    .pointAltitude(0.018)
    .pointRadius(0.24)
    .pointResolution(12)
    .pointsMerge(false)
    .pointLabel(d => `<div style="padding:7px 10px;background:#07152b;color:#fff;border:1px solid #60a5fa;border-radius:8px;font:600 12px system-ui">${d.name}<div style="font-size:10px;color:#93c5fd;margin-top:2px">${d.region}</div></div>`)
    .arcsData(arcs)
    .arcStartLat('startLat')
    .arcStartLng('startLng')
    .arcEndLat('endLat')
    .arcEndLng('endLng')
    .arcColor('color')
    .arcAltitude(0.20)
    .arcStroke(0.55)
    .arcDashLength(0.42)
    .arcDashGap(0.22)
    .arcDashInitialGap(() => Math.random())
    .arcDashAnimateTime(2200)
    .ringsData(rings)
    .ringLat('lat')
    .ringLng('lng')
    .ringColor(() => t => `rgba(52,211,153,${1-t})`)
    .ringMaxRadius('maxR')
    .ringPropagationSpeed('propagationSpeed')
    .ringRepeatPeriod('repeatPeriod')
    .onPointClick(point => {
      if (nameEl) nameEl.textContent = point.name;
      if (regionEl) regionEl.textContent = point.region + ' · Illustrative city hub';
      if (hintEl) hintEl.textContent = 'Drag to rotate · Scroll to zoom · Select another city';
      globe.pointOfView({ lat:point.lat, lng:point.lng, altitude:1.65 }, 900);
    });

  globe.controls().autoRotate = true;
  globe.controls().autoRotateSpeed = 0.7;
  globe.controls().enableDamping = true;
  globe.controls().dampingFactor = 0.08;
  globe.controls().minDistance = 120;
  globe.controls().maxDistance = 420;
  globe.pointOfView({ lat:22, lng:78, altitude:2.15 }, 0);

  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    globe.controls().autoRotate = false;
    globe.arcsTransitionDuration(0);
  }

  const resizeGlobe = () => {
    if (!host.isConnected) return;
    globe.width(Math.max(280, host.clientWidth));
    globe.height(Math.max(320, host.clientHeight));
  };
  if ('ResizeObserver' in window) new ResizeObserver(resizeGlobe).observe(host);
  else window.addEventListener('resize', resizeGlobe);

  host.addEventListener('keydown', e => {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      const current = nameEl ? nameEl.textContent : 'New Delhi';
      const i = cities.findIndex(c => c.name === current);
      const next = cities[(i + 1) % cities.length];
      if (nameEl) nameEl.textContent = next.name;
      if (regionEl) regionEl.textContent = next.region + ' · Illustrative city hub';
      globe.pointOfView({ lat:next.lat, lng:next.lng, altitude:1.65 }, 900);
    }
  });
})();
</script>



<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>

  AOS.init({

    duration: 800,

    once: true,

    offset: 40,

    easing: 'ease-out-cubic',

    disable: function () {

      return window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    }

  });

  let resizeTimer;

  window.addEventListener('resize', function () {

    clearTimeout(resizeTimer);

    resizeTimer = setTimeout(function () { AOS.refresh(); }, 200);

  });

</script>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ExamConnect\resources\views/welcome.blade.php ENDPATH**/ ?>