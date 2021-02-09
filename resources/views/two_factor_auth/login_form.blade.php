<html>

<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>ログイン</title>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'calendarForLive') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('ユーザー登録') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('ログアウト') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
<!--  ヘッダーここまで-->

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{__('ログイン')}}</div>
                        <div class="card-body">
                            <div id="app" class="p-3">
                                <div class="alert alert-info" v-if="message" v-text="message"></div>
                        
                                <!-- １段階目のログインフォーム -->
                                <div v-if="step==1">
                                    <h3>
                                        @if (isset($message))
                                            {{ $message }}
                                        @endif
                                    </h3>
                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" v-model="email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>
                                        <div class="col-md-6">
                                            <input type="password" class="form-control" v-model="password">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="button" class="btn btn-primary" @click="firstAuth">送信する</button>
                                        </div>

                                        @if (Route::has('password.request'))
                                        <div class="col-md-8 offset-md-4">
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('パスワードを忘れた方はこちら') }}
                                            </a>
                                        </div>
                                        @endif
                                    </div>

                                </div>
                        
                                <!-- ２段階目・ログインフォーム -->
                                <div v-if="step==2">
                                    ２段階認証のパスワードをメールアドレスに登録しました。（有効時間：10分間）
                                    <hr>
                                    <div class="form-group">
                                        <label>２段階パスワード</label>
                                        <input type="text" class="form-control" v-model="token">
                                    </div>
                                    <button type="button" class="btn btn-primary" @click="secondAuth">ログイン</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
    <script>

        new Vue({
            el: '#app',
            data: {
                step: 1,
                email: '',
                password: '',
                token: '',
                userId: -1,
                message: ''
            },
            methods: {
                firstAuth() {

                    this.message = '';

                    const url = '/ajax/two_factor_auth/first_auth';
                    const params = {
                        email: this.email,
                        password: this.password
                    };
                    axios.post(url, params)
                        .then(response => {

                            const result = response.data.result;

                            if(result) {

                                this.userId = response.data.user_id;
                                this.step = 2;

                            } else {

                                this.message = 'ログイン情報が間違っています。';

                            }

                        });

                },
                secondAuth() {

                    const url = '/ajax/two_factor_auth/second_auth';
                    const params = {
                        user_id: this.userId,
                        tfa_token: this.token
                    };

                    axios.post(url, params)
                        .then(response => {

                            const result = response.data.result;

                            if(result) {

                                // ２段階認証成功
                                location.href = '/home';

                            } else {

                                this.message = '２段階パスワードが正しくありません。';
                                this.token = '';

                            }

                        });

                }
            }
        });

    </script>
</body>
</html>