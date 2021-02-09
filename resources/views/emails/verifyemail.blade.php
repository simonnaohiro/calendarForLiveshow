@component('mail::message')

@if (!empty($user->name))
    {{ $user->name }} さん
@endif

** 以下の認証リンクをクリックしてください。 **

@component('mail::button', ['url' => $url])
メールアドレスを確認する
@endcomponent

---

※もしこのメールに覚えが無い場合は破棄してください。

---

@if (!empty($url))
###### 「メールアドレスを確認する」ボタンをクリックできない場合は、下記のURLをコピーしてWebブラウザに貼り付けてください。
###### {{ $url }}
@endif

@endcomponent