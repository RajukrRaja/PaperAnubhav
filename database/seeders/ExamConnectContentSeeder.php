<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\Exam;
use App\Models\ExamCategory;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ExamConnectContentSeeder extends Seeder
{
    public function run(): void
    {
        $categoryNames = ['Railway', 'SSC', 'Banking', 'UPSC', 'State PSC', 'Teaching', 'Defence', 'Police', 'Engineering Entrance', 'Medical Entrance', 'University', 'Professional Certification'];
        $categories = [];
        foreach ($categoryNames as $name) {
            $categories[$name] = ExamCategory::updateOrCreate(['slug' => Str::slug($name)], ['name' => $name]);
        }

        $exams = [
            ['RRB Technician Grade I Signal','Railway','Railway Recruitment Boards','https://www.rrbcdg.gov.in/'],
            ['RRB Technician Grade III','Railway','Railway Recruitment Boards','https://www.rrbcdg.gov.in/'],
            ['RRB NTPC','Railway','Railway Recruitment Boards','https://www.rrbcdg.gov.in/'],
            ['RRB Group D','Railway','Railway Recruitment Boards','https://www.rrbcdg.gov.in/'],
            ['RRB ALP','Railway','Railway Recruitment Boards','https://www.rrbcdg.gov.in/'],
            ['SSC CGL','SSC','Staff Selection Commission','https://ssc.gov.in/'],
            ['SSC CHSL','SSC','Staff Selection Commission','https://ssc.gov.in/'],
            ['SSC MTS','SSC','Staff Selection Commission','https://ssc.gov.in/'],
            ['SSC GD Constable','SSC','Staff Selection Commission','https://ssc.gov.in/'],
            ['SSC CPO','SSC','Staff Selection Commission','https://ssc.gov.in/'],
            ['IBPS PO','Banking','Institute of Banking Personnel Selection','https://www.ibps.in/'],
            ['IBPS Clerk','Banking','Institute of Banking Personnel Selection','https://www.ibps.in/'],
            ['SBI PO','Banking','State Bank of India','https://sbi.co.in/'],
            ['SBI Clerk','Banking','State Bank of India','https://sbi.co.in/'],
            ['UPSC Civil Services','UPSC','Union Public Service Commission','https://upsc.gov.in/'],
            ['BPSC Combined Competitive Exam','State PSC','Bihar Public Service Commission','https://bpsc.bihar.gov.in/'],
            ['BPSC TRE','Teaching','Bihar Public Service Commission','https://bpsc.bihar.gov.in/'],
            ['CTET','Teaching','Central Board of Secondary Education','https://ctet.nic.in/'],
            ['KVS Recruitment','Teaching','Kendriya Vidyalaya Sangathan','https://kvsangathan.nic.in/'],
            ['NDA & NA','Defence','Union Public Service Commission','https://upsc.gov.in/'],
            ['AFCAT','Defence','Indian Air Force','https://afcat.cdac.in/'],
            ['Bihar Police Constable','Police','Central Selection Board of Constable, Bihar','https://csbc.bihar.gov.in/'],
            ['JEE Main','Engineering Entrance','National Testing Agency','https://jeemain.nta.nic.in/'],
            ['NEET UG','Medical Entrance','National Testing Agency','https://neet.nta.nic.in/'],
            ['CUET UG','University','National Testing Agency','https://cuet.nta.nic.in/'],
        ];
        foreach ($exams as [$name, $category, $authority, $url]) {
            Exam::updateOrCreate(['slug' => Str::slug($name)], [
                'name' => $name,
                'exam_category_id' => $categories[$category]->id,
                'description' => 'Find candidate-reported experiences, preparation discussions and community insights. Check the conducting authority website for official notifications, dates, eligibility and results.',
                'conducting_authority' => $authority,
                'official_url' => $url,
                'status' => 'active',
                'meta_title' => $name . ' exam experiences and preparation',
                'meta_description' => 'Explore candidate-reported ' . $name . ' exam experiences, preparation discussions and shift reviews. Official details should be confirmed with the conducting authority.',
            ]);
        }

        foreach (['Maths','Reasoning','General Science','General Awareness','English','Computer Awareness','Exam Strategy','Memory Based Questions','Preparation Tips'] as $tagName) {
            Tag::updateOrCreate(['slug' => Str::slug($tagName)], ['name' => $tagName]);
        }

        $communities = [
            ['RRB Exams','rrb-exams','Discuss RRB NTPC, Group D, ALP and Technician exams. Share preparation ideas and candidate-reported experiences.','Railway'],
            ['SSC & Government Exams','ssc-government-exams','Preparation, exam updates and candidate experiences for SSC and other government exams.','Government'],
            ['Bihar Exams','bihar-exams','Discuss BPSC, BPSC TRE, Bihar Police and other Bihar recruitment exams.','State Exams'],
            ['Teaching Exams','teaching-exams','A community for CTET, state TET, teacher recruitment and teaching eligibility exams.','Teaching'],
            ['Interview & Career','interview-career','Share interview experiences, job-search advice and career questions.','Career'],
            ['Study Accountability','study-accountability','Set goals, discuss study routines and encourage one another.','Preparation'],
        ];
        foreach ($communities as [$name, $slug, $description, $category]) {
            Community::updateOrCreate(['slug' => $slug], compact('name','description','category') + ['is_active' => true]);
        }

        $settings = [
            'site_name' => ['ExamConnect', 'text'],
            'community_guidelines' => ['Share honest candidate experiences. Do not present rumours as official notices or leaked papers.', 'text'],
            'allow_candidate_reports' => ['1', 'boolean'],
        ];
        foreach ($settings as $key => [$value, $type]) {
            DB::table('site_settings')->updateOrInsert(['key' => $key], ['value' => $value, 'type' => $type, 'updated_at' => now(), 'created_at' => now()]);
        }
    }
}
