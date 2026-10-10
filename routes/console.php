<?php
use Illuminate\Support\Facades\Artisan;
Artisan::command('examconnect:about', function () { $this->info('ExamConnect — candidate-reported exam experience community'); });
