@extends('web.layouts.web')
@section('content')
    <div class="content" id="content">
        <section class="section section-main">
            <div class="container-lg">
                <div class="owl-carousel owl-main owlMain">
                    @foreach($carousels as $carousel)
                    <div class="owl-main__item">
                        <div class="media media-slider center-block">
                            <div class="row justify-content-center align-items-center">
                                <div class="col">
                                    <div class="media-slider__left">
                                        <h1 class="media-slider__title font-n-b">{{$carousel->name_az}}</h1>
                                        <p class="media-slider__desc">A{{$carousel->content_az}}</p>
                                        <a href="#" class="btn btn-yellow media-slider__link font-n-b">Ətraflı</a>
                                    </div>
                                </div>
                                <div class="col d-none d-sm-block">
                                    <div class="media-slider__right">
                                        <img class="media-slider__img img-responsive"
                                             src="{{$carousel->icon}}" alt="Slider">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endforeach
                </div>
            </div>
        </section>
        <section class="section section-works">
            <div class="container-lg">
                <h2 class="section-title text-center font-n-b">Aser Cargo Express necə işləyir?</h2>
                <div class="row">
                    @foreach($works as $work)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="thumbnail thumbnail-works">
                            <div class="thumbnail-works__img-block">
                                <img class="thumbnail-works__img img-responsive"
                                     src="{{$work->icon}}" alt="Work">
                            </div>
                            <div class="thumbnail-works__caption text-center">
                                <h4 class="thumbnail-works__title font-n-b">{{$work->name_az}}</h4>
                                <p class="thumbnail-works__desc">{{$work->content_azphp}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section class="section section-works-video">
            <div class="container-lg">
                <div class="media media-works">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-6">
                            <div class="media-works__left">
                                <iframe class="media-works__iframe" width="100%" height="320"
                                        src="https://www.youtube.com/embed/sq_Ubu0by9k"
                                        allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="media-works__right">
                                <p class="media-works__title">
                                    Dünyanın müxtəlif yerlərindən, xüsusilə Amerika, İngiltərə, İspaniya və
                                    Almaniyadan daşınmalar həyata keçiririk. Bu ölkələrdən göndərdiyiniz bağlamaları
                                    ən qısa zamanda və təhlükəsiz şəkildə ünvana çatdırırıq.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-tarifs">
            <div class="container-lg">
                <h2 class="section-title text-center font-n-b">Xaricdən sifarişlərin sərfəli çatdıırlması</h2>
                <div class="row">
                    @foreach($countries as $country)
                        <div class="col-md-3 col-sm-6">
                            <div class="thumbnail thumbnail-tarifs">
                                <a href="
{{--                                {{ route('show_tariffs', ['locale' => App::getLocale(), 'country_id' => $country->id]) }}--}}
                                " class="thumbnail-tarifs__link">
                                    <div class="thumbnail-tarifs__img-block">
                                        <img class="thumbnail-tarifs__img img-responsive" src="{{$country->icon}}" alt="Tarif">
                                    </div>
                                    <div class="thumbnail-tarifs__caption text-center">
                                        <h4 class="thumbnail-tarifs__title font-n-b">{{$country->name_az}}</h4>
                                        <p class="thumbnail-tarifs__desc">
                                            {{$country->content_az}}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section class="section section-offers">
            <div class="container-lg">
                <h2 class="section-title text-center font-n-b">Yük daşıma</h2>
                <div class="row">
                    @foreach($deliveries as $deliverie)
                    <div class="col-md-3 col-sm-6">
                        <div class="thumbnail thumbnail-cargo">
                            <a href="{{$deliverie->icon}} " class="thumbnail-cargo__link">
                                <div class="thumbnail-cargo__img-block">
                                    <img class="thumbnail-cargo__img img-responsive" src="{{$deliverie->icon}}" alt="Cargo">
                                </div>
                                <div class="thumbnail-cargo__caption text-center">
                                    <h4 class="thumbnail-cargo__title font-n-b">{{$deliverie->name_az}}</h4>
                                    <p class="thumbnail-cargo__desc">
                                       {{$deliverie->content_az}}
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section class="section section-services">
            <div class="container-lg">
                <h1 class="section-title text-center font-n-b">Digər xidmətlər</h1>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="thumbnail thumbnail-services">
                            <a href="#" class="thumbnail-services__link">
                                <div class="thumbnail-services__img-block">
                                    <img class="thumbnail-services__img img-responsive" src="/web/images/content/service-1.png" alt="Service">
                                </div>
                                <div class="thumbnail-services__caption">
                                    <h6 class="thumbnail-services__title text-center font-n-b">Anbar xidməti</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="thumbnail thumbnail-services">
                            <a href="#" class="thumbnail-services__link">
                                <div class="thumbnail-services__img-block">
                                    <img class="thumbnail-services__img img-responsive" src="/web/images/content/service-2.png" alt="Service">
                                </div>
                                <div class="thumbnail-services__caption">
                                    <h6 class="thumbnail-services__title text-center font-n-b">Ünvanda təhvil alma xidməti</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="thumbnail thumbnail-services">
                            <a href="#" class="thumbnail-services__link">
                                <div class="thumbnail-services__img-block">
                                    <img class="thumbnail-services__img img-responsive" src="/web/images/content/service-3.png" alt="Service">
                                </div>
                                <div class="thumbnail-services__caption">
                                    <h6 class="thumbnail-services__title text-center font-n-b">E-ticarət əməliyyatları</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="thumbnail thumbnail-services">
                            <a href="#" class="thumbnail-services__link">
                                <div class="thumbnail-services__img-block">
                                    <img class="thumbnail-services__img img-responsive" src="/web/images/content/service-4.png" alt="Service">
                                </div>
                                <div class="thumbnail-services__caption">
                                    <h6 class="thumbnail-services__title text-center font-n-b">Kargomat</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="thumbnail thumbnail-services">
                            <a href="#" class="thumbnail-services__link">
                                <div class="thumbnail-services__img-block">
                                    <img class="thumbnail-services__img img-responsive" src="/web/images/content/service-5.png" alt="Service">
                                </div>
                                <div class="thumbnail-services__caption">
                                    <h6 class="thumbnail-services__title text-center font-n-b">Kuryer</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="thumbnail thumbnail-services">
                            <a href="#" class="thumbnail-services__link">
                                <div class="thumbnail-services__img-block">
                                    <img class="thumbnail-services__img img-responsive" src="/web/images/content/service-6.png" alt="Service">
                                </div>
                                <div class="thumbnail-services__caption">
                                    <h6 class="thumbnail-services__title text-center font-n-b">Etibarnamə</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-tarifs-country">
            <div class="container-lg">
                <div class="media media-tarif-country">
                    <div class="row">
                        <div class="media-tarif-country__body">
                            <h4 class="media-tarif-country__title font-n-b">{{$text->name_az}}</h4>
                            <p class="media-tarif-country__desc">
                               {{$text->content_az}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-partners">
            <div class="container-lg">
                <h2 class="section-title text-center font-n-b">Əməkdaşlarımız</h2>
                <div class="owl-carousel owl-partners owlPartners">
                    <div class="owl-partners__item">
                        <div class="thumbnail thumbnail-partners d-flex justify-content-center align-items-center">
                            <div class="thumbnail-partners__img-block">
                                <img class="thumbnail-partners__img img-responsive"
                                     src="/web/images/content/partner-1.png" alt="Partner">
                            </div>
                        </div>
                    </div>
                    <div class="owl-partners__item">
                        <div class="thumbnail thumbnail-partners d-flex justify-content-center align-items-center">
                            <div class="thumbnail-partners__img-block">
                                <img class="thumbnail-partners__img img-responsive"
                                     src="/web/images/content/partner-2.png" alt="Partner">
                            </div>
                        </div>
                    </div>
                    <div class="owl-partners__item">
                        <div class="thumbnail thumbnail-partners d-flex justify-content-center align-items-center">
                            <div class="thumbnail-partners__img-block">
                                <img class="thumbnail-partners__img img-responsive"
                                     src="/web/images/content/partner-3.png" alt="Partner">
                            </div>
                        </div>
                    </div>
                    <div class="owl-partners__item">
                        <div class="thumbnail thumbnail-partners d-flex justify-content-center align-items-center">
                            <div class="thumbnail-partners__img-block">
                                <img class="thumbnail-partners__img img-responsive"
                                     src="/web/images/content/partner-4.png" alt="Partner">
                            </div>
                        </div>
                    </div>
                    <div class="owl-partners__item">
                        <div class="thumbnail thumbnail-partners d-flex justify-content-center align-items-center">
                            <div class="thumbnail-partners__img-block">
                                <img class="thumbnail-partners__img img-responsive"
                                     src="/web/images/content/partner-4.png" alt="Partner">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-calculator">
            <div class="container-lg">
                <form class="form form-calculator" name="formCalculator" id="formCalculator"
                      novalidate="novalidate">
                    <div class="row">
                        <div class="col-md-12 d-block d-md-none">
                            <h1 class="form-calculator__title font-n-b">{!! __('static.calculator') !!}</h1>
                            <p class="form-calculator__desc">{!! __('static.calculate_text') !!}</p>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form__group">
                                        <label class="form__label" for="calcCountry">{!! __('static.country') !!}</label>
                                        <div class="form__select-wrapper">
                                            <select class="form__select" name="country" id="calcCountry" required>
                                                <option value="null" disabled selected>Ölkə seçin</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->name}} - {!! __('static.baku') !!}</option>
                                                @endforeach
                                            </select>
                                            <label id="calcCountryErrorMessage" class="form-error-text" for="calcCountry"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form__group">
                                        <label class="form__label" for="calcTransferType">{!! __('static.type') !!}</label>
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
                                        <label class="form__label" for="calcWeightType">{!! __('static.unit') !!}</label>
                                        <div class="form__select-wrapper">
                                            <select class="form__select" name="unit" id="calc_weight_type" required>
                                                <option value="kq">kg</option>
                                                <option value="gm">g</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form__group">
                                        <label class="form__label" for="calcWide">En</label>
                                        <input class="form__input" name="length" type="text" id="calcWide"
                                               placeholder="En (sm)" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form__group">
                                        <label class="form__label" for="calcWidth">Uzunluq</label>
                                        <input class="form__input" name="width" type="text" id="calcWidth"
                                               placeholder="Uzunluq (sm)" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form__group">
                                        <label class="form__label" for="calcHeight">Hündürlük</label>
                                        <input class="form__input" name="height" type="text" id="calcHeight"
                                               placeholder="Hündürlük" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form__group">
                                        <label class="form__label" for="calcWeght">Çəki</label>
                                        <input class="form__input" name="weight" type="text" id="calcWeght"
                                               placeholder="Çəki" required>
                                        <label id="calcWeghtErrorMessage" class="form-error-text" for="calcWeght"></label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="btn btn-yellow form__btn form-calculator__btn font-n-b"
                                                name="formCalculatorSubmit" type="submit">Hesabla</button>
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
        <section class="section section-blogs">
            <div class="container-lg">
                <h1 class="section-title text-center font-n-b">Bloqlar</h1>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="thumbnail thumbnail-blogs">
                            <a href="#" class="thumbnail-blogs__link">
                                <div class="thumbnail-blogs__img-block">
                                    <img class="thumbnail-blogs__img img-responsive" src="/web/images/content/blog-1.png" alt="Blog">
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="thumbnail thumbnail-blogs">
                            <a href="#" class="thumbnail-blogs__link">
                                <div class="thumbnail-blogs__img-block">
                                    <img class="thumbnail-blogs__img img-responsive" src="/web/images/content/blog-1.png" alt="Blog">
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="thumbnail thumbnail-blogs">
                            <a href="#" class="thumbnail-blogs__link">
                                <div class="thumbnail-blogs__img-block">
                                    <img class="thumbnail-blogs__img img-responsive" src="/web/images/content/blog-1.png" alt="Blog">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section-questions">
            <div class="container-lg">
                <h1 class="section-title text-center font-n-b">Suallar və cavablar</h1>
                <div class="accordion accordion-questions" id="accordionQuestions">

                    <div class="row">
                        @foreach($faqs->chunk(6) as $faqChunk)
                            <div class="col-md-6">
                                @foreach($faqChunk as $faq)
                                    <div class="accordion-item accordion-questions__item">
                                        <h2 class="accordion-header accordion-questions__header">
                                            <button class="accordion-button accordion-questions__button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$faq->id}}" aria-expanded="false">
                                                {{$faq->name_az}}
                                            </button>
                                        </h2>
                                        <div id="collapse{{$faq->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionQuestions{{$faq->id}}">
                                            <div class="accordion-body accordion-questions__body">
                                                {!! $faq->content_az !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
@section('styles')
    <style>
        .media-tarif-country__title{
            text-align: center;
        }
        .thumbnail-services__img{
            border-radius: 10px;
            height: 320px;
        }
    </style>
@endsection