@extends('web.layouts.web')
@section('content')
    <section class="section section-rules">
        <div class="container-lg terms"  >
            <h1 class="section-title text-center font-n-b">Şərtlər və qaydalar</h1>
            <p class="section__desc">MALLARIN DAŞINMASI XİDMƏTİNƏ DAİR ŞƏRTLƏR TOPLUSU:</p>
            <ol class="nav nav-rules">
                <li class="nav-rules__item">ASER şəxsi istifadə və kuryer yüklərinin Azərbaycana daşınmasını həyata keçirir.
                    Hazırda şəxsi istifadə limiti Azərbaycanda bir təqvim ayı ərzində 300 (USD) (çatdırılma haqqı
                    daxil olmaqla) ABŞ dolları təşkil edir. Daşıyıcı bütün sifarişlərin daşımasını həyata keçirərkən
                    yalnız 300 ABŞ dollarınadək sifariş olduqda gömrük sənədləşmələrini öz üzərinə götürür. Dəyəri
                    daha yüksək məbləğdə sifarişlərin gömrük rüsumu Smart Customs mobil tətbiqində ödənildikdən
                    sonra yola çıxacaqdır. Əgər sifarişçinin malı Smart Customsda gömrük bəyannamənisini yanlış
                    yazdığı üçün və ya kommersiya məqsədli olduğu üçün saxlanırlarsa, bütün məsuliyyəti müştəri
                    daşıyaraq gömrük sənədləşməsi sifarişçinin özü tərəfindən olunur.
                </li>
                <li class="nav-rules__item">Şəxsi istifadə limitinə daxil olan məhsulların kommersiya
                    məqsədli olmadığı və məhz şəxsi istifadə üçün olduğu əsaslandırıla bilməlidir.
                    Fiziki şəxs şəxsi istifadə limitini keçdikdə və ya yükünün kommersiya məqsədli olduğu
                    qənəati yarandıqda həmin yük gömrük orqanı tərəfindən gömrük rüsumuna və əlavə dəyər
                    vergisinə tabe edilir. Ətraflı məlumat üçün aşağıdakı linkə daxil ola bilərsiniz:
                    https://c2b.customs.gov.az/Tnved_public.aspx
                </li>
                <li class="nav-rules__item">Sifarişçinin yükü gömrük orqanı tərəfindən saxlandıqda “Daşıyıcı”
                    bu barədə sifarişçiyə məlumat verir. Sifarişçi gömrükdə saxlanmış bağlamasını özü götürmək
                    istədikdə, “Daşıyıcı”ya bağlamanın daşınma haqqını ödəyir. “Daşıyıcı” isə öz növbəsində
                    sifarişçiyə bağlamanı təhvil alması üçün aviaqaimə təqdim edir. Sifarişçi bu qaimə əsasında
                    bağlamasını Hava Nəqliyyatında Baş Gömrük İdarəsində rəsmiləşdirir və Bakı Karqo Terminalında
                    saxlama xərclərini ödəyərək yükünü təhvil alır.
                </li>
                <li class="nav-rules__item">Sifariş edilən malların sığortalanması “Daşıyıcı” tərəfindən həyata
                    keçirilmir və buna görə şirkət heç bir məsuliyyət daşımır. Bağlama "Daşıyıcı"nın xarici
                    anbarında təhvil alınana qədər olan bütün müraciətlər yalnız satıcı mağazaya ünvanlanmalıdır.
                </li>
                <li class="nav-rules__item">“Sifarişçi” xarici anbara məhsul sifariş edərkən ünvanı ASER saytında
                    olduğu kimi yazmalıdır, ünvan sonunda olan ID kod və qeydiyyatdan keçmiş şəxsin ad və soyadı
                    düzgün olmadıqda bağlama naməlumlara düşə bilər, yanlış ünvan yazılmış bağlamalara görə
                    “Daşıyıcı” heç bir məsuliyyət daşımır.
                </li>
                <li class="nav-rules__item">
                    Sifariş əsasında daşınan bağlamadakı əşyanın qüsurlu olmasına, məhsulun ölçüsünün, rənginin,
                    çeşidinin və s. səhv gəlməsinə görə “Daşıyıcı” heç bir məsuliyyət daşımır. Bu kimi hallarda
                    sifarişçi problemin aradan qaldırması üçün iradını ancaq satıcı mağazaya bildirə bilər.
                </li>
                <li class="nav-rules__item">
                    ABŞ, KANADA, ALMANİYA VƏ İNGİLTƏRƏ dən ölçüsü 100sm-dən böyük olan bağlamaların daşınma haqqı həm həcm həm də fiziki çəki əsasında hesablanır və alınan göstəricilərdən böyük olanı daşınma haqqının hesablanması üçün əsas çəki kimi qəbul edilir.
                    TÜRKİYƏ dən isə ölçüsü 60sm-dən böyük olan bağlamaların daşınma haqqı həm həcm həm də fiziki çəki əsasında hesablanır və alınan göstəricilərdən böyük olanı daşınma haqqının hesablanması üçün əsas çəki kimi qəbul edilir.
                    Həcmindən asılı olmayaraq, salafan torbalarda çatdırılan bağlamaların daşınma haqqı yalnız FİZİKİ ÇƏKİ əsasında hesablanır.
                </li>
            </ol>
        </div>
    </section>
@endsection

@section('styles')
    <style>
        .terms{
            margin-top : 100px;
        }#header{
             margin-bottom: 15px;
         }

        @media (max-width: 768px) {
            .terms {
                margin-top: 0;
            }
            .section-rules{
                padding-top: 100px;
            }
        }

    </style>

@endsection