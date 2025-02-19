<?php

namespace App\Http\Controllers;

use App\Faq;
use App\Faq2;
use App\ServiceText;
use App\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class OurServicesController extends Controller
{
    public function index() {
        try {
            $faqs = Faq::query()->where('page',3)->select([
                'id',
                DB::raw("question_" . App::getLocale() . " as name"),
                DB::raw("answer_" . App::getLocale() . " as content")
            ])
                ->get();



            $text=ServiceText::query()
                ->select([
                    DB::raw("name_" . App::getLocale() . " as name"),
                    DB::raw("content_" . App::getLocale() . " as content")
                ])->first();
            $fields = [
                'how_it_work', 'international_delivery', 'corporative_logistics', 'services',
                'partners', 'blogs', 'feedback', 'faqs', 'contacts', 'tracking_search'
            ];

            $title = Title::query()
                ->select(array_map(function($field) {
                    return DB::raw("{$field}_" . App::getLocale() . " as {$field}");
                }, $fields))
                ->first();
            return view("web.services.index", compact("faqs", "text",'title'));
        } catch (\Exception $exception) {
            return view("front.error");
        }
    }
    
    public function branches(){
        try {
            $branches = DB::table('filial')->where('is_active', 1)->get();
            return view("web.services.branches", compact('branches'));
        }catch (\Exception $exception){
            return view("front.error");
        }
    }
    
    public function cargomat(){
        try {
            return view("web.services.cargomat");
        }catch (\Exception $exception){
            return view("front.error");
        }
    }
}
