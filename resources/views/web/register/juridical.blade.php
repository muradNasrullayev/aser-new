@extends('web.layouts.web')
@section('styles')
    <style>
        .col-sm-6 {
            width: 50%;
            float: left;
        }

        .form__group {
            margin-bottom: 15px;
        }

        .input-container {
            position: relative;
        }

        .form-checkbox {
            margin-right: 15px;
            cursor: pointer;
        }

        .form-checkbox__input {
            margin-right: 5px;
        }

        .form-checkbox__span {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 1px solid #ccc;
            border-radius: 50%;
            margin-right: 10px;
            vertical-align: middle;
            cursor: pointer;
        }

        .form-checkbox.d-flex.align-items-center {
            display: flex;
            align-items: center;
        }

        .invalid-feedback {
            color: red;
            font-size: 12px;
            display: block;
        }

        @keyframes blink {
            0% {
                color: var(--yellow);
            }
            50% {
                color: black;
            }
            100% {
                color: var(--yellow);
            }
        }

        .is-invalid {
            border-color: red;
        }
        .invalid-feedback {
            color: red;
            font-size: 0.875rem;
            display: block;
        }
    </style>
@endsection
@section('content')
    @if (session('case'))
        <div class="alert alert-{{ session('case') }}" style="height: 4rem;">
            <strong>{{ session('title') }}</strong> {{ session('content') }}
        </div>
    @endif

    <div class="content" id="content">
        <section class="section section-registration d-flex justify-content-center align-items-center">
            <div class="container-lg">
                <form class="form form-registration center-block" name="formRegistrationJuridical" id="formRegistrationJuridical" method="post" action="{{route("register", ['locale' => App::getLocale()])}}" novalidate="novalidate">
                    @csrf
                    <input class="form__input" name="is_legality" value="1" type="hidden">
                    <h1 class="form-registration__title text-center font-n-b">{!! __('static.welcome') !!}</h1>
                    <p class="form-registration__title-2 text-center font-n-b">{!! __('static.registerForm') !!}</p>
                    <div class="form-registration__btn-types d-flex justify-content-center align-items-center">
                        <div class="col">
                            <a href="{{route("register", ['locale' => App::getLocale(), 'type' => 'physical'])}}" class="btn btn-trns-yellow btn-block form-registration__btn-type font-n-b">{!! __('static.physic') !!}</a>
                        </div>
                        <div class="col">
                            <a href="{{route("register", ['locale' => App::getLocale(), 'type' => 'juridical'])}}" class="btn btn-trns-yellow btn-block btn-trns-yellow--active form-registration__btn-type form-registration__btn-type--pos-rel-left font-n-b">{!! __('static.jurdical') !!}</a>
                        </div>
                    </div>
                    <div class="form-registration__content form-registration__content--1">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form__group">
                                    <label class="form__label" for="userVoen">{!! __('static.voen') !!}</label>
                                    <input class="form__input @error('voen') is-invalid @enderror" name="voen" type="text" id="userVoen" placeholder="{!! __('static.voenPh') !!}" value="{{ old('voen') }}" required>
                                    @error('voen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form__group">
                                    <label class="form__label" for="userCompanyName">{!! __('static.company_name') !!}  </label>
                                    <input class="form__input @error('company_name') is-invalid @enderror" name="company_name" type="text" id="userCompanyName" placeholder="{!! __('static.companyPH') !!}" value="{{ old('company_name') }}" required>
                                    @error('company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form__group">
                                    <label class="form__label" for="userName">{!! __('auth.Name') !!}</label>
                                    <input class="form__input @error('name') is-invalid @enderror" name="name" type="text" id="userName" placeholder="{!! __('static.namePH') !!}" value="{{ old('name') }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form__group">
                                    <label class="form__label" for="userSurname">{!! __('auth.Surname') !!}</label>
                                    <input class="form__input @error('surname') is-invalid @enderror" name="surname" type="text" id="userSurname" placeholder="{!! __('static.surnamePH') !!}" value="{{ old('surname') }}" required>
                                    @error('surname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">

                            <div class="form__group">
                                    <label class="form__label" for="userEmail">{!! __('auth.Email') !!}</label>
                                    <input class="form__input {{ session('errorType') == 'email' ? 'is-invalid' : '' }}"
                                           name="email"
                                           value="{{ session('errorType') == 'email' ? '' : old('email') }}"
                                           type="email"
                                           id="userEmail"
                                           placeholder="{!! __('static.emailPhLogin') !!}"
                                           required>
                                    <div class="invalid-feedback">
                                        @if (session('errorType') == 'email')
                                            <strong> {{__('register.email_exists')}} </strong>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">

                            <div class="form__group">
                                    <label class="form__label" for="phone">{!! __('auth.Phone') !!}</label>
                                    <div class="d-flex gap-2">
                                        <span class="form-control d-flex align-items-center justify-content-center"
                                              style="width: 70px;">+994</span>


                                        <select id="prefix" name="prefix" class="form-control" style="width: 50px;">
                                            <option value="" disabled selected>--</option>
                                            <option value="" disabled selected>--</option>
                                            <option value="10">10</option>
                                            <option value="50">50</option>
                                            <option value="51">51</option>
                                            <option value="55">55</option>
                                            <option value="70">70</option>
                                            <option value="77">77</option>
                                            <option value="99">99</option>
                                            <option value="60">60</option>
                                        </select>

                                        <input
                                                class="form__input"
                                                type="text"
                                                id="phoneSuffix"
                                                name="phone_suffix"
                                                maxlength="9"
                                                placeholder="xxx-xx-xx"
                                                required
                                                value="{{ session('errorType') == 'number' ? '' : old('phone_suffix') }}"
                                                style="flex: 1;"
                                        />
                                    </div>

                                    <div class="invalid-feedback">
                                        @if (session('errorType') == 'number')
                                            <strong>{{__('register.phone_exists')}}</strong>
                                        @elseif(session('errorType') == 'number2')
                                            <strong>{{ session('content') }}</strong>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form__group">
                                    <label class="form__label" for="userSex">{!! __('auth.City') !!}</label>
                                    <div class="form__select-wrapper">
                                        <select class="form__select @error('city') is-invalid @enderror" name="city" id="city" required>
                                            <option value="">{!! __('static.choose') !!}</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->name}}" {{ old('city') == $city->name ? 'selected' : '' }}>{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form__group">
                                    <label class="form__label" for="userAddress">{!! __('auth.Address') !!}</label>
                                    <input class="form__input @error('address1') is-invalid @enderror" name="address1" type="text" id="userAddress" placeholder="{!! __('static.addressPhReg') !!}" value="{{ old('address1') }}" required>
                                    @error('address1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form__group">
                                    <label class="form__label" for="userBranch">{!! __('auth.branch') !!}</label>
                                    <div class="form__select-wrapper">
                                        <select class="form__select @error('branch_id') is-invalid @enderror" name="branch_id" id="userBranch" required>
                                            <option value="0" disabled selected>{!! __('auth.branch') !!}</option>
                                            @foreach($branchs as $branch)
                                                <option value="{{$branch->id}}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>{{$branch->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('branch_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form__group">
                                    <label class="form__label" for="userSex">{!! __('auth.Language') !!}</label>
                                    <div class="form__select-wrapper">
                                        <select class="form__select @error('language') is-invalid @enderror" name="language" id="language" required>
                                            <option value="AZ" {{ old('language') == 'AZ' ? 'selected' : '' }}>AZ</option>
                                            <option value="EN" {{ old('language') == 'EN' ? 'selected' : '' }}>EN</option>
                                            <option value="RU" {{ old('language') == 'RU' ? 'selected' : '' }}>RU</option>
                                        </select>
                                    </div>
                                    @error('language')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form__group">
                                    <label class="form__label" for="userPassword">{!! __('auth.Password') !!}</label>
                                    <div class="input-container" style="position: relative;">
                                        <input class="form__input @error('password') is-invalid @enderror" name="password" value="{{ old('password')}}" type="password" id="userPassword" placeholder="{!! __('static.passwordReg') !!}" required style="padding-right: 30px;">
                                        <span class="eye-icon" id="togglePassword1" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; font-size: 18px;">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form__group">
                                    <label class="form__label" for="userPassword2">Təkrar şifrə</label>
                                    <div class="input-container" style="position: relative;">
                                        <input class="form__input @error('user_password2') is-invalid @enderror" name="user_password2" value="{{ old('user_password2')}}" type="password" id="userPassword2" placeholder="{!! __('static.confirmPasswordReg') !!}" required style="padding-right: 30px;">
                                        <span class="eye-icon" id="togglePassword2" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; font-size: 18px;">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                    @error('user_password2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form__group">
                                    <div class="input-container" style="position: relative;">
                                        <label class="form-checkbox d-flex align-items-center" style="margin-right: 15px;">
                                            <input class="form-checkbox__input" type="radio" name="verification" value="sms" id="smsVerification">
                                            <span style="width: 23px"  class="form-checkbox__span"></span> {!! __('static.sms') !!}
                                        </label>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form__group">

                                    <div class="input-container" style="position: relative;">
                                        <label class="form-checkbox d-flex align-items-center">
                                            <input class="form-checkbox__input" type="radio" name="emailReg" value="email" id="emailVerification">
                                            <span style="width: 23px"  class="form-checkbox__span"></span> {!! __('static.emailPhLogin') !!}
                                        </label>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form__group">
                                    <label class="form-checkbox d-flex justify-content-start align-items-center" style="width: 200%;" for="userAgree">
                                        <input class="form-checkbox__input" name="agreement" type="checkbox" id="userAgree" >
                                        <span class="form-checkbox__span" style="border-radius: 50px;width: 35px"></span>
                                        <a href="https://asercargo.az/uploads/static/terms2.pdf"  target="_blank">
                                            <span class="form-checkbox__text" style="animation: blink 1s infinite;">{!! __('auth.agreement') !!}</span>
                                        </a>
                                        <div class="invalid-feedback"></div>
                                    </label>
                                    @error('agreement')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-yellow btn-block form__btn form-registration__btn-action form-registration__btn-action--submit font-n-b" name="formRegistrationPhysicalSubmit" type="submit">{!! __('static.register') !!}</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script>
        // Şifrə göster/gizle işlemleri
        document.getElementById('togglePassword1').addEventListener('click', function() {
            const passwordField = document.getElementById('userPassword');
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;


            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });

        document.getElementById('togglePassword2').addEventListener('click', function() {
            const passwordField = document.getElementById('userPassword2');
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;


            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    </script>

{{--    <script>--}}
{{--        document.addEventListener('DOMContentLoaded', function() {--}}
{{--            const phoneInput = document.getElementById('phone');--}}
{{--            const mask = '0__-___-__-__';--}}

{{--            phoneInput.value = mask;--}}
{{--            phoneInput.setAttribute('placeholder', mask);--}}

{{--            function setCursorToNextUnderscore(input) {--}}
{{--                const pos = input.value.indexOf('_');--}}
{{--                input.setSelectionRange(pos, pos);--}}
{{--            }--}}

{{--            phoneInput.addEventListener('focus', () => {--}}
{{--                setCursorToNextUnderscore(phoneInput);--}}
{{--            });--}}

{{--            phoneInput.addEventListener('click', () => {--}}
{{--                setCursorToNextUnderscore(phoneInput);--}}
{{--            });--}}

{{--            phoneInput.addEventListener('keydown', function(e) {--}}
{{--                const cursor = this.selectionStart;--}}

{{--                if ((e.key === 'Backspace' || e.key === 'Delete') && cursor === 0) {--}}
{{--                    e.preventDefault();--}}
{{--                    return;--}}
{{--                }--}}

{{--                if (/\d/.test(e.key)) {--}}
{{--                    e.preventDefault();--}}

{{--                    const chars = this.value.split('');--}}
{{--                    let pos = this.selectionStart;--}}

{{--                    while (pos < chars.length) {--}}
{{--                        if (chars[pos] === '_') {--}}
{{--                            chars[pos] = e.key;--}}
{{--                            break;--}}
{{--                        }--}}
{{--                        pos++;--}}
{{--                    }--}}

{{--                    this.value = chars.join('');--}}
{{--                    setCursorToNextUnderscore(this);--}}
{{--                }--}}

{{--                if (e.key === 'Backspace') {--}}
{{--                    e.preventDefault();--}}

{{--                    const chars = this.value.split('');--}}
{{--                    let pos = this.selectionStart - 1;--}}

{{--                    while (pos >= 0) {--}}
{{--                        if (chars[pos] !== '-' && pos !== 0) {--}}
{{--                            chars[pos] = '_';--}}
{{--                            break;--}}
{{--                        }--}}
{{--                        pos--;--}}
{{--                    }--}}

{{--                    this.value = chars.join('');--}}
{{--                    this.setSelectionRange(pos >= 0 ? pos : 1, pos >= 0 ? pos : 1);--}}
{{--                }--}}
{{--            });--}}

{{--            phoneInput.addEventListener('input', function(e) {--}}
{{--                if (this.value.length !== mask.length) {--}}
{{--                    this.value = mask;--}}
{{--                    setCursorToNextUnderscore(this);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

    <input id="phoneSuffix" type="tel" maxlength="9" />

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const phoneSuffix = document.getElementById('phoneSuffix');
            const mask = '___-__-__';
            const ua = navigator.userAgent.toLowerCase();
            const isiOS = /iphone|ipad|ipod/.test(ua);
            const isAndroid = /android/.test(ua);

            phoneSuffix.value = mask;

            function setCursorToNextUnderscore(input) {
                const pos = input.value.indexOf('_');
                if (pos !== -1) {
                    requestAnimationFrame(() => input.setSelectionRange(pos, pos));
                }
            }

            function formatInput(value, inputChar) {
                const chars = value.split('');
                let pos = -1;
                for (let i = 0; i < chars.length; i++) {
                    if (chars[i] === '_') {
                        chars[i] = inputChar;
                        pos = i + 1;
                        break;
                    }
                }
                return { value: chars.join(''), pos };
            }

            function handleBackspace(value, cursorPos) {
                const chars = value.split('');
                for (let i = cursorPos - 1; i >= 0; i--) {
                    if (chars[i] !== '-') {
                        chars[i] = '_';
                        return { value: chars.join(''), pos: i };
                    }
                }
                return { value, pos: cursorPos };
            }

            phoneSuffix.addEventListener('focus', () => setCursorToNextUnderscore(phoneSuffix));
            phoneSuffix.addEventListener('click', () => setCursorToNextUnderscore(phoneSuffix));

            if (isAndroid) {
                // Android üçün beforeinput əsaslı kod
                phoneSuffix.addEventListener('beforeinput', function (e) {
                    const isDigit = /^\d$/.test(e.data);
                    if (isDigit) {
                        e.preventDefault();
                        const result = formatInput(this.value, e.data);
                        this.value = result.value;
                        if (result.pos !== -1) {
                            requestAnimationFrame(() => this.setSelectionRange(result.pos, result.pos));
                        }
                    } else if (e.inputType === 'deleteContentBackward') {
                        e.preventDefault();
                        const result = handleBackspace(this.value, this.selectionStart);
                        this.value = result.value;
                        requestAnimationFrame(() => this.setSelectionRange(result.pos, result.pos));
                    }
                });
            } else if (isiOS) {
                // iOS üçün keydown əsaslı kod
                phoneSuffix.addEventListener('keydown', function (e) {
                    if (/\d/.test(e.key)) {
                        e.preventDefault();
                        const result = formatInput(this.value, e.key);
                        this.value = result.value;
                        setCursorToNextUnderscore(this);
                    }

                    if (e.key === 'Backspace') {
                        e.preventDefault();
                        const result = handleBackspace(this.value, this.selectionStart);
                        this.value = result.value;
                        this.setSelectionRange(result.pos, result.pos);
                    }
                });
            } else {
                phoneSuffix.addEventListener('keydown', function (e) {
                    if (/\d/.test(e.key)) {
                        e.preventDefault();
                        const result = formatInput(this.value, e.key);
                        this.value = result.value;
                        setCursorToNextUnderscore(this);
                    }

                    if (e.key === 'Backspace') {
                        e.preventDefault();
                        const result = handleBackspace(this.value, this.selectionStart);
                        this.value = result.value;
                        this.setSelectionRange(result.pos, result.pos);
                    }
                });
            }

            phoneSuffix.addEventListener('input', function () {
                if (this.value.length !== mask.length) {
                    this.value = mask;
                    setCursorToNextUnderscore(this);
                }
            });
        });
    </script>
@endsection
