@extends('web.layouts.web')
@section('breadcrumbs')
    {{-- <li class="breadcrumb-item"><a class="breadcrumb-link" href="">Kateqoriyalar</a></li> --}}
{{--    <li class="breadcrumb-item" aria-current="">Cari Səhifə</li>--}}
    <li class="nav-breadcrumbs__item nav-breadcrumbs__item--active">
        <a href="{{ route('menuIndex', ['locale' => App::getLocale(),optional($menu['tariff'])->{'slug_' . App::getLocale()}]) }}" class="nav-breadcrumbs__link nav-breadcrumbs__item--active">{!! __('breadcrumbs.tariff') !!}</a>
    </li>
@endsection

@section('title')
    {{$menu['tariff']->{'title_' . App::getLocale()} }}
@endsection

@section('description')
    {{$menu['tariff']->{'description_' . App::getLocale()} }}
@endsection
@section('content')
    <div class="content" id="content">
    <section class="section section-partners">
            <div class="container-lg">
                <h2 class="section-title text-center font-n-b">{{$title->international_delivery}}</h2>
                <div class="owl-carousel owl-partners-2 owlPartners">
                    @foreach($countries as $country)

                            <div class="thumbnail thumbnail-tarifs">
                                <a href="{{ route('menuIndex',['locale' => App::getLocale(),$country->slug]) }}" class="thumbnail-tarifs__link">
                                    <div class="thumbnail-tarifs__img-block">
                                        <img class="thumbnail-tarifs__img img-responsive" src="{{$country->icon}}" alt="Tarif">
                                    </div>
                                    <div class="thumbnail-tarifs__caption text-center">
                                        <h4 class="thumbnail-tarifs__title font-n-b">{{$country->name}}</h4>
                                        <p class="thumbnail-tarifs__desc">
                                            {{$country->cover_description}}
                                        </p>
                                    </div>
                                </a>
                            </div>
                    @endforeach
                </div>
            </div>
            <div class="owl-carousel-navigation">
                @foreach($countries as $index => $country)
                    <button class="owl-carousel-dot" data-index="{{ $index }}"></button>
                @endforeach
            </div>
    

        @if($text->name1!=null && $text->name1!='')

        <section class="section section-tarifs-country">
            <div class="container-lg">
                <div class="media media-tarif-country">
                    <div class="row">
                        <div class="media-tarif-country__body">
                            <h4 class="media-tarif-country__title align-text-custom">A{{$text->name1}}</h4>
                            <p class="media-tarif-country__desc">
                                {{$text->content1}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif


        @if($text->name2!=null && $text->name2!='')

            <section class="section section-tarifs-country">
                <div class="container-lg">
                    <div class="media media-tarif-country">
                        <div class="row">
                            <div class="media-tarif-country__body">
                                <h4 class="media-tarif-country__title align-text-custom">{{$text->name2}}</h4>
                                <p class="media-tarif-country__desc">
                                    {{$text->content2}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif



        <section class="section section-partners">
            <div class="container-lg">
                <h2 class="section-title text-center font-n-b">{{$title->partners}}</h2>
                <div class="owl-carousel owl-partners owlPartners">
                    @foreach($partners as $partner)
                        <div class="owl-partners__item">
                            <div class="thumbnail thumbnail-partners d-flex justify-content-center align-items-center">
                                <div class="thumbnail-partners__img-block text-center">
                                    <img class="thumbnail-partners__img img-responsive-2"
                                         src="{{$partner->icon}}" alt="Partner">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        @if($text->name3!=null && $text->name3!='')
        <section class="section section-tarifs-country">
            <div class="container-lg">
                <div class="media media-tarif-country">
                    <div class="row">
                        <div class="media-tarif-country__body">
                            <h4 class="media-tarif-country__title align-text-custom">{{$text->name3}}</h4>
                            <p class="media-tarif-country__desc">
                                {{$text->content3}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        <section class="section section-calculator">
            <div class="container-lg">
                <form class="form form-calculator" name="formCalculator" id="formCalculator" novalidate="novalidate">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 d-block d-md-none">
                            <h2 class="form-calculator__title font-n-b">{!! __('static.calculator') !!}</h2>
                            <p class="form-calculator__desc">{!! __('static.calculate_text') !!} </p>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form__group">
                                        <label class="form__label" for="calcCountry">{!! __('static.country') !!}</label>
                                        <div class="form__select-wrapper">
                                            <select class="form__select" name="country" id="calcCountry" required>
                                                <option  disabled selected>{!! __('static.select_country1') !!}</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->country_id}}">{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                            <label id="calcCountryErrorMessage" class="form-error-text" for="calcCountry"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form__group">
                                        <label class="form__label" for="calcTransferType">{!! __('static.type2') !!}</label>
                                        <div class="form__select-wrapper">
                                            <select class="form__select" name="type" id="calcTransferType" required>
                                                @foreach($types as $type)
                                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form__group">
                                        <label class="form__label" for="calcWeightType">{!! __('static.unit1') !!}</label>
                                        <div class="form__select-wrapper">
                                            <select class="form__select" name="unit" id="calc_weight_type" required>
                                                <option value="kq">{!! __('static.kq1') !!}</option>
                                                <option value="gr">{!! __('static.gr1') !!}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form__group">
                                        <label class="form__label" for="calcWide">{!! __('static.width1') !!}</label>
                                        <input class="form__input" name="length" type="text" id="calcWide"
                                               placeholder="{!! __('static.width1') !!}" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form__group">
                                        <label class="form__label" for="calcWidth">{!! __('static.lenght1') !!}</label>
                                        <input class="form__input" name="width" type="text" id="calcWidth"
                                               placeholder="{!! __('static.lenght1') !!}" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form__group">
                                        <label class="form__label" for="calcHeight">{!! __('static.hieght1') !!}</label>
                                        <input class="form__input" name="height" type="text" id="calcHeight"
                                               placeholder="{!! __('static.hieght1') !!}" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form__group">
                                        <label class="form__label" for="calcWeght">{!! __('static.weight1') !!}</label>
                                        <input class="form__input" name="weight" type="text" id="calcWeght"
                                               placeholder="{!! __('static.weight1') !!}" required>
                                        <label id="calcWeghtErrorMessage" class="form-error-text" for="calcWeght"></label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="btn btn-yellow form__btn form-calculator__btn font-n-b"
                                                name="formCalculatorSubmit" type="button">{!! __('static.calculate1') !!}</button>
                                    </div>
                                    <p id="amount" class="form-calculator__result text-center font-n-b"> 00.0</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 d-none d-md-block">
                            <p class="form-calculator__title font-n-b">{!! __('static.calculator') !!}</p>
                            <p class="form-calculator__desc">{!! __('static.calculate_text') !!} </p>
                        </div>
                    </div>
                </form>
            </div>
        </section>


    @if(count($blogs)>0)
        <section class="section section-blogs section-margin-top">
            <div class="container-lg">
                <h2 class="section-title text-center font-n-b">{{$title->blogs}}</h2>
                <div class="row">
                    @foreach($blogs as $blog)
                        <div class="col-sm-4">
                            <div class="thumbnail thumbnail-blogs">
                                <a href="{{ route('menuIndex', ['locale' => App::getLocale(), 'slug' => $blog->slug]) }}" class="thumbnail-blogs__link">
                                    <div class="thumbnail-blogs__img-block">
                                        <img class="thumbnail-blogs__img img-responsive" src="{{$blog->icon}}" alt="Blog">
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        @endif
        @if(count($faqs)>0)
        <section class="section section-questions">
            <div class="container-lg">
                <h2 class="section-title text-center font-n-b">{{$title->faqs}}</h2>
                <div class="accordion accordion-questions" id="accordionQuestions">

                    <div class="row">
                        @foreach($faqs as $faq)
                            <div class="col-md-6">
                                <div class="accordion-item accordion-questions__item">
                                    <h2 class="accordion-header accordion-questions__header">
                                        <button class="accordion-button accordion-questions__button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$faq->id}}" aria-expanded="false">
                                            {{$faq->name}}
                                        </button>
                                    </h2>
                                    <div id="collapse{{$faq->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionQuestions{{$faq->id}}">
                                        <div class="accordion-body accordion-questions__body">
                                            {!! $faq->content !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </section>
        @endif

    </div>
@endsection

@section('styles')
    <style>
        .img-responsive-2{
            width: 65%;
        }
         .owl-carousel-dot {
            width: 10px;
            height: 10px;
            margin: 5px;
            border-radius: 50%;
            border: none;
            background-color: grey;
            cursor: pointer;
            transition: background 0.3s;
        }

        @media only screen and (max-width: 767px) {
            .thumbnail-tarifs__img{
                width: 75%;
            }
            .titles-content p{
                width: 90%;
            }
            .thumbnail-tarifs__desc, .thumbnail-works__desc, .thumbnail-cargo__desc{
                width: 85%;
                text-align: center;
                margin: 0 auto;
            }
            .thumbnail-tarifs__img-block{
                text-align: center;
            }
            .owl-carousel-dot {
                width: 8px;
                height: 8px;
                margin: 3px;
            }
        }
        .owl-carousel-dot.active {
            background: #007bff;
        }

        @media only screen and (max-width: 480px) {
            .breadcrumb-nav {
                padding: 8px 10px;
                font-size: 12px;
            }
            .breadcrumb-item {
                font-size: 12px;
            }
            .breadcrumb-link {
                font-size: 12px;
            }
            .owl-carousel-dot {
                width: 8px;
                height: 8px;
                margin: 3px;
            }
            .thumbnail-tarifs__img {
                width: 70%;
            }
            .thumbnail-tarifs__desc {
                width: 90%;
            }
            .owl-carousel-navigation {
                margin-top: 10px;
            }
            .img-responsive{
                height: 75%;
                width: 75%;
            }
            .thumbnail-partners__img{
              width: 100%;
            }
        }

        @media only screen and (max-width: 1024px) {
            .breadcrumb-nav {
                padding: 12px;
            }
            .thumbnail-tarifs__desc {
                width: 80%;
            }
            .thumbnail-tarifs__img {
                width: 80%;
            }
            .owl-carousel-dot {
                width: 10px;
                height: 10px;
            }
            .breadcrumb-item {
                font-size: 14px;
            }
        }
        @media only screen and (max-width: 1440px) {
            .breadcrumb-nav {
                padding: 15px;
            }
            .thumbnail-tarifs__desc {
                width: 70%;
            }
        }
        @media only screen and (min-width: 1441px) {
            .breadcrumb-nav {
                max-width: 1200px;
                margin: 0 auto;
            }
            .thumbnail-tarifs__desc {
                width: 60%;
            }
        }

        .owl-carousel-navigation{
            text-align: center;
        }
        .carousel-button-img{
            color: var(--white3);;
        }
        .carousel-button-color{
            color: grey;
        }
        .breadcrumb-nav {
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .breadcrumb-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .breadcrumb-item {
            font-size: 14px;
            color: #6c757d;
            display: flex;
            align-items: center;
        }

        .breadcrumb-link {
            text-decoration: none;
            color: #007bff;
            font-weight: 500;
            transition: color 0.3s ease-in-out;
        }

        .breadcrumb-link:hover {
            color: #0056b3;
        }

        .breadcrumb-item:not(:last-child)::after {
            content: "›";
            margin-left: 8px;
            color: #6c757d;
            font-weight: bold;
        }

        .breadcrumb-item[aria-current] {
            font-weight: 600;
            color: #343a40;
        }
        @media only screen and (max-width: 767px) {
            .thumbnail-tarifs__img{
                width: 75%;
            }
            .titles-content p{
                width: 90%;
            }
            .thumbnail-tarifs__desc, .thumbnail-works__desc, .thumbnail-cargo__desc{
                width: 90%;
                text-align: center;
                margin: 0 auto;
            }
            .thumbnail-tarifs__img-block{
                text-align: center;
            }
        }

    </style>
@endsection

@section('scripts')
<script>

$(document).ready(function () {
        const owl = $(".owl-partners-2");

        owl.owlCarousel({
            items: 3,
            loop: true,
            margin: 10,
            nav: true,
            dots: false
        });

        const dots = $(".owl-carousel-navigation .owl-carousel-dot");

        dots.eq(0).addClass("active");

        owl.on('changed.owl.carousel', function (event) {
            const currentIndex = event.item.index - event.relatedTarget._clones.length / 2;
            const totalItems = event.item.count;
            let normalizedIndex = (currentIndex % totalItems + totalItems) % totalItems; 

            dots.removeClass("active");

            dots.eq(normalizedIndex).addClass("active");
        });

        dots.click(function () {
            const dotIndex = $(this).data('index');
            owl.trigger('to.owl.carousel', [dotIndex, 300]);
        });
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".form-calculator__btn").click(function(e) {
    
        e.preventDefault();
        var formData = $('#formCalculator').serializeArray();
        $.ajax({
            url: "{{ route('calculate') }}",
            type: "POST",
            data: formData,
            success: function(response) {
                if (response.case === "success") {
                    $("#amount").text(response.amount);
                } else {
                    alert("{{ __('static.calculator_required1') }}");
                }
            },
            error: function() {
            }
        });
    });

</script>


@endsection
