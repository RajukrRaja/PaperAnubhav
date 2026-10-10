<?php
/**
 * Lightweight offline check for common Blade control-directive mismatches.
 * Run with: php scripts/verify-blade-templates.php
 * This is not a replacement for compiling views with Laravel installed.
 */
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views';
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root));
$openers = [
    'if' => 'endif', 'auth' => 'endauth', 'guest' => 'endguest',
    'foreach' => 'endforeach', 'forelse' => 'endforelse', 'for' => 'endfor',
    'while' => 'endwhile', 'isset' => 'endisset', 'unless' => 'endunless',
    'push' => 'endpush', 'prepend' => 'endprepend',
    'once' => 'endonce', 'error' => 'enderror',
];
$closers = array_flip($openers);
$failed = false;
foreach ($files as $file) {
    if (!$file->isFile() || !str_ends_with($file->getFilename(), '.blade.php')) continue;
    if ($file->getFilename() === '.blade.php') {
        fwrite(STDERR, "Invalid Blade filename: {$file->getPathname()}\nExpected a named template such as show.blade.php.\n");
        $failed = true;
        continue;
    }
    $source = file_get_contents($file->getPathname());
    preg_match_all('/(?<!@)@([A-Za-z_][A-Za-z0-9_]*)\b/', $source, $matches);
    $stack = [];
    foreach ($matches[1] as $directive) {
        if (isset($openers[$directive])) {
            $stack[] = [$directive, $openers[$directive]];
        } elseif (isset($closers[$directive])) {
            if (!$stack) {
                fwrite(STDERR, "{$file->getPathname()}: unmatched @{$directive}\n");
                $failed = true;
                continue;
            }
            [$opening, $expected] = end($stack);
            if ($expected !== $directive) {
                fwrite(STDERR, "{$file->getPathname()}: @{$directive} found while @{$expected} was expected (opened by @{$opening})\n");
                $failed = true;
            } else {
                array_pop($stack);
            }
        }
    }
    if ($stack) {
        foreach (array_reverse($stack) as [$opening, $expected]) {
            fwrite(STDERR, "{$file->getPathname()}: @{$opening} has no matching @{$expected}\n");
            $failed = true;
        }
    }
}
if ($failed) exit(1);
echo "Blade directive scan passed. Install Composer dependencies and run php artisan view:cache for Laravel's real compiler check.\n";
