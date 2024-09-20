<div style="background:#ddd;padding:20px 40px;">
    <div style="background:#fff;padding:20px 40px;border-radius:7px;box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)">
        <p>
            <img src="https://prospekt-parts.com/img/color_logo.png" style="width: 150px" alt="Проспект Транс" />
        </p>
        <h2>Здравствуйте</h2> 
        <h4>Ваш заказ №{{$name}} получен</h4>
        <p>Сообщите его менеджеру, когда вам позвонят.</p>
        <p>Благодарим за выбор нашего сервиса.</p>
        <p>На этот адрес мы пришлём вам счёт.</p>
        <p>По всем вопросам, обращайтесь к нашему менеджеру.</p>
        <br />
        <strong>(Сергей) +7 (901) 733-18-66</strong>
        <p><a href="{{config('app.url')}}/order/{{$id}}">Детали заказа</a></p>
        <?php /*
            Ваш шестизначный код для подтверждения 
            <br /><b>{{$pin}}</b>        
        */ ?>
        <hr/>
        <p>
            <small style="color: #999">
                © {{ date('Y') }} - {{ config('app.name') }}. @lang('Все права защищены.')
            </small>
        </p>
    </div>
</div>