@echo off
setlocal
if not exist artisan (
  echo Run this script from the ExamConnect project root.
  exit /b 1
)
php artisan view:clear
if errorlevel 1 exit /b 1
php artisan optimize:clear
if errorlevel 1 exit /b 1
php artisan view:cache
if errorlevel 1 (
  echo A Blade template still has a compilation error. Read the error path above.
  exit /b 1
)
echo Blade templates compiled successfully.
