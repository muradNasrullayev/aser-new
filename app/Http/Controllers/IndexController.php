<?php

namespace App\Http\Controllers;

use App\{Blog,
    Carousel,
    ContractDetail,
    Country,
    Faq,
    HomePageText,
    HowWork,
    Partner,
    Service,
    TariffType,
    Title,
    Seller,
    İnternationalDelivery,
    CorporativeLogistic};
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Instruction;
use Illuminate\Support\Facades\{App,DB,Validator};

class IndexController extends HomeController
{
    public function index()
    {
        try {
            $blogs = Blog::query()->orderBy('id', 'desc')->limit(3)->select([
                'id','icon',
                DB::raw("name_" . App::getLocale() . " as name"),
                DB::raw("slug_" . App::getLocale() . " as slug")
            ])
                ->get();

            $services = Service::query()->select([
                'id','icon',
                DB::raw("name_" . App::getLocale() . " as name"),
                DB::raw("content_" . App::getLocale() . " as content"),
                DB::raw("slug_" . App::getLocale() . " as slug")
            ])
                ->get();

            $instructions = Instruction::all();
            $partners = Partner::all();

            $countries = Country::where('url_permission', 1)->select('name_' . App::getLocale(), 'id', 'screen_image')->orderBy('id')->get();


            $countries =İnternationalDelivery::query()
                ->select([
                    'id','icon','rank',
                    DB::raw("name_" . App::getLocale() . " as name"),
                    DB::raw("content_" . App::getLocale() . " as content"),
                    DB::raw("slug_" . App::getLocale() . " as slug")
                ])
                ->orderBy('rank', 'asc')
                ->get();

            $types = TariffType::all();

            $faqs = Faq::query()
                ->select([
                    'id',
                    DB::raw("question_" . App::getLocale() . " as name"),
                    DB::raw("answer_" . App::getLocale() . " as content")
                ])
                ->whereNull('page')
                ->get();

            $works = HowWork::query()
                ->select([
                    'id','icon',
                    DB::raw("name_" . App::getLocale() . " as name"),
                    DB::raw("content_" . App::getLocale() . " as content")
                ])
                ->get();

            $deliveries =CorporativeLogistic::query()
                ->select([
                    'id','icon','rank',
                    DB::raw("name_" . App::getLocale() . " as name"),
                    DB::raw("content_" . App::getLocale() . " as content"),
                    DB::raw("slug_" . App::getLocale() . " as slug")
                ])
                ->orderBy('rank', 'asc')
                ->get();


            $text = HomePageText::query()
                ->select([
                    'id',
                    DB::raw("name_" . App::getLocale() . " as name"),
                    DB::raw("content_" . App::getLocale() . " as content")
                ])->first();


            $carousels= Carousel::query()
                ->select([
                    'id','icon',"link",'rank',
                    DB::raw("name_" . App::getLocale() . " as name"),
                    DB::raw("content_" . App::getLocale() . " as content")
                ])
                ->orderBy('rank', 'asc')
                ->get();

            $fields = [
                'how_it_work', 'international_delivery', 'corporative_logistics', 'services',
                'partners', 'blogs', 'feedback', 'faqs', 'contacts', 'tracking_search','video'
            ];

            $title = Title::query()
                ->select(array_merge(
                    [DB::raw('id')],
                    array_map(function($field) {
                        return DB::raw("{$field}_" . App::getLocale() . " as {$field}");
                    }, $fields)
                ))
                ->first();

            $contents = Title::query()
                ->where('id',2)
                ->select(array_merge(
                    [DB::raw('id')],
                    array_map(function($field) {
                        return DB::raw("{$field}_" . App::getLocale() . " as {$field}");
                    }, $fields)
                ))
                ->first();
//            $tariffs=İnternationalDelivery::query()
//                ->select([
//                    'id',
//                    DB::raw("name_" . App::getLocale() . " as name"),
//                ])
//                ->get();
//            ;
//            $logistics[]=CorporativeLogistic::all();
//            return  $tariffs;

            
            return view('web.home.index')->with([
                'instructions' => $instructions,
                'partners' => $partners,
                'countries' => $countries,
                'types' => $types,
                'faqs' => $faqs,
                'carousels' => $carousels,
                'works' => $works,
                'deliveries' => $deliveries,
                'text' => $text,
                'title' => $title,
                'blogs' => $blogs,
                'contents' => $contents,
                'services'=>$services,
            ]);

            // return view('home')->with([
            //     //'instructions' => $instructions,
            //     //'sellers' => $sellers,
            //     //'countries' => $countries,
            //     //'types' => $types
            // ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
            return view("front.error");
        }
    }

    public function promo_code()
    {
        return view('web.promo-code.index');
    }

    public function terms_and_conditions(){
        return view('web.terms-and-conditions.index');
    }

    public function show_transport(){
        return view('web.transport.index');
    }

    public function calculate_amount(Request $request) {
        $validator = Validator::make($request->all(), [
            'country' => ['required', 'integer'],
            'type' => ['required', 'integer'],
            'unit' => ['required', 'string', 'max:3'],
            'weight' => ['required'],
            'width' => ['nullable'],
            'height' => ['nullable'],
            'length' => ['nullable'],
        ]);
        if ($validator->fails()) {
            return response(['case' => 'warning', 'title' => 'Warning!', 'type' => 'validation', 'content' => $validator->errors()->toArray()]);
        }
        try {
            $country_id = $request->country;
            $type = $request->type;
            $unit = $request->unit;
            $weight = $request->weight;
            $width = $request->width;
            $height = $request->height;
            $length = $request->length;
            $volume_weight = ($width * $length * $height) / 6000;

            if ($unit == 'gm') {
                $weight = $weight / 1000;
            }

            $date = Carbon::today();
            $tariffs = ContractDetail::leftJoin('contract as c', 'contract_detail.contract_id', '=', 'c.id')
                ->leftJoin('currency', 'contract_detail.currency_id', '=', 'currency.id')
                ->where(['contract_detail.country_id'=>$country_id, 'c.default_option'=>1, 'c.is_active'=>1, 'contract_detail.is_active'=>1, 'contract_detail.type_id'=>$type])
                ->whereDate('c.start_date', '<=', $date)->whereDate('c.end_date', '>=', $date)
                ->whereDate('contract_detail.start_date', '<=', $date)->whereDate('contract_detail.end_date', '>=', $date)
                ->select('contract_detail.from_weight', 'contract_detail.to_weight', 'contract_detail.weight_control as volume_control', 'contract_detail.rate', 'contract_detail.charge', 'currency.icon')
                ->get();

            $chargeable_weight = $weight;
            foreach ($tariffs as $tariff) {
                if ($tariff->volume_control == 1) {
                    if ($length > 0 && $width > 0 && $height > 0) {
                        if ($volume_weight > $weight) {
                            $chargeable_weight = $volume_weight;
                        } else {
                            $chargeable_weight = $weight;
                        }
                    } else {
                        $chargeable_weight = $weight;
                    }
                } else {
                    $chargeable_weight = $weight;
                }
                if (($chargeable_weight >= $tariff->from_weight) && ($chargeable_weight <= $tariff->to_weight)) {
                    $amount = $tariff->charge + ($chargeable_weight * $tariff->rate);
                    $amount = sprintf('%0.2f', $amount);
                    $currency_icon = $tariff->icon;
                    return response(['case' => 'success', 'amount' => $currency_icon . $amount]);
                }
            }

            return response(['case' => 'warning', 'title' => 'Oops!', 'content' => 'Uyğun tarif tapılmadı!']);
        } catch (\Exception $exception) {
            return response(['case' => 'error', 'title' => 'Error!', 'content' => 'Sorry, something went wrong!']);
        }
    }

    public function calculate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country' => ['required', 'integer'],
            'type' => ['required', 'integer'],
            'unit' => ['required', 'string', 'max:3'],
            'weight' => ['required'],
            'width' => ['nullable'],
            'height' => ['nullable'],
            'length' => ['nullable'],
        ]);
        if ($validator->fails()) {
            return response(['case' => 'warning', 'title' => 'Warning!', 'type' => 'validation', 'content' => 'Ölkə və çəki mütləq daxil edilməlidir']);
        }
//        return $request;
        try {
            if ($request->country==1) {
                $country_id = 7;
            }elseif ($request->country==2) {
                $country_id = 2;
            }elseif ($request->country==3) {
                $country_id = 9;
            }elseif ($request->country==4) {
                $country_id = 12;
            }

//            $country_id = $request->country;
            $type = $request->type;
            $unit = $request->unit;
            $weight = $request->weight;
            $width = $request->width;
            $height = $request->height;
            $length = $request->length;
            $volume_weight = ($width * $length * $height) / 6000;

            if ($unit == 'gr') {
                $weight = $weight / 1000;
            }

            $date = Carbon::today();
            $tariffs = ContractDetail::leftJoin('contract as c', 'contract_detail.contract_id', '=', 'c.id')
                ->leftJoin('currency', 'contract_detail.currency_id', '=', 'currency.id')
                ->where(['contract_detail.country_id'=>$country_id, 'c.default_option'=>1, 'c.is_active'=>1, 'contract_detail.is_active'=>1, 'contract_detail.type_id'=>$type])
                ->whereDate('c.start_date', '<=', $date)->whereDate('c.end_date', '>=', $date)
                ->whereDate('contract_detail.start_date', '<=', $date)->whereDate('contract_detail.end_date', '>=', $date)
                ->select('contract_detail.from_weight', 'contract_detail.to_weight', 'contract_detail.weight_control as volume_control', 'contract_detail.rate', 'contract_detail.charge', 'currency.icon')
                ->get();

            $chargeable_weight = $weight;
            foreach ($tariffs as $tariff) {
                if ($tariff->volume_control == 1) {
                    if ($length > 0 && $width > 0 && $height > 0) {
                        if ($volume_weight > $weight) {
                            $chargeable_weight = $volume_weight;
                        } else {
                            $chargeable_weight = $weight;
                        }
                    } else {
                        $chargeable_weight = $weight;
                    }
                } else {
                    $chargeable_weight = $weight;
                }
                if (($chargeable_weight >= $tariff->from_weight) && ($chargeable_weight <= $tariff->to_weight)) {
                    $amount = $tariff->charge + ($chargeable_weight * $tariff->rate);
                    $amount = sprintf('%0.2f', $amount);
                    $currency_icon = $tariff->icon;
                    return response(['case' => 'success', 'amount' => $currency_icon . $amount]);
                }
            }

            return response(['case' => 'warning', 'title' => 'Oops!', 'content' => 'Uyğun tarif tapılmadı!']);
        } catch (\Exception $exception) {
            return response(['case' => 'error', 'title' => 'Error!', 'content' => 'Sorry, something went wrong!']);
        }
    }
}
