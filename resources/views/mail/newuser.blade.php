<div style="background:#ddd;padding:20px 40px;">
    <div style="background:#fff;padding:20px 40px;border-radius:7px;box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)">
        <p>
            <img src="https://prospekt-parts.com/img/color_logo.png" style="width: 150px" alt="Проспект Транс" />
        </p>
        <h2>Здравствуйте</h2> 
        <p>Вы получили данное письмо, потому что зарегистрировались на сайте {{ config('app.url') }}</p>
        <br />
        <p><strong>Логин:</strong> <br />{{ $login }}</p>
        <p><strong>Ваш временный пароль:</strong> <br />{{ $password }}</p>
        <p style="color: red">ОБЯЗАТЕЛЬНО ПОМЕНЯЙТЕ ПАРОЛЬ ПОСЛЕ ВХОДА !</p>
        <hr/>
        <p>
            <small style="color: #999">
                © {{ date('Y') }} - {{ config('app.name') }}. @lang('Все права защищены.')
            </small>
        </p>
    </div>
</div>