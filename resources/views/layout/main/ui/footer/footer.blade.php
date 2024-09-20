<footer id="contact" class="d-print-none bg-dark text-white" itemscope itemtype="http://schema.org/WPFooter">
    <meta itemprop="copyrightYear" content="<?=date('Y');?>">
    <meta itemprop="copyrightHolder" content="Проспект Транс">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3 text-center text-lg-start">
                <a href="/" class="d-flex justify-content-lg-start justify-content-center align-items-center gap-3 logo-footer" style="text-decoration: none">
                    <img src="/img/logotype/light-logo.png" class="rounded" alt="Prospekt Parts" style="width: 60px" />
                    <span class="text-white fs-4 logo">
                        {!!$names::company('Prospekt Parts')!!}
                    </span> 
                </a>
                <p class="mt-lg-4 mt-5 text text-justify text-lg-start px-4 px-lg-0">
                    <small>
                        <b>Интернет-магазин "Prospekt Parts"</b> -Предлагаем вашему вниманию широкий выбор оригинальных запасных частей для автомобилей. Всегда в наличии продукция от ведущих мировых производителей. Наши специалисты помогут вам подобрать необходимые комплектующие, предоставят профессиональную консультацию и ответят на все интересующие вопросы. Мы гарантируем высокое качество продукции и оперативную доставку. Заказывайте оригинальные запасные части у нас и будьте уверены в надёжности вашего автомобиля!                                  
                    </small>
                </p>
            </div>
            <div class="col-12 col-md-3">
                <div class="ps-4 ps-lg-5 pt-lg-0 pt-5">
                    <h4 class="mb-4">Продукты</h4> 
                    <ul class="d-grid gap-3 list-unstyled">
                        <li><a href="/products/mercedes-benz">Грузовые запчасти</a></li>
                        <li><a href="/developers">Разработчикам</a></li>
                        <li><a href="/shipper">Поставщикам</a></li>
                        <li><a href="/partner">Партнерам</a></li>
                        <li><a href="/customers">Клиентам</a></li>
                        <li>
<a href="https://webmaster.yandex.ru/siteinfo/?site=https://prospekt-parts.com/"><img width="88" height="31" alt="" border="0" src="https://yandex.ru/cycounter?https://prospekt-parts.com/&theme=light&lang=ru"/></a></li>
                    </ul>                            
                </div>
                
                
                
            </div>
            <div class="col-12 col-md-3">
                <div class="ps-4 ps-lg-0 pt-lg-0 pt-5">
                    <h4 class="mb-4">Условия сотрудничества</h4> 
                    <ul class="d-grid gap-3 list-unstyled">
                        <li><a href="/doc/guaranty">Условия гарантии</a></li>
                        <li><a href="/doc/return-policy">Правила возврата</a></li>
                        <li><a href="/doc/responsibility">Отказ от ответственности</a></li>
                        <li><a href="/doc/privatepolice">Политика конфиденциальности</a></li>
                        <li><a href="/doc/license">Пользовательское соглашение</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="ps-4 ps-lg-0 pt-lg-0 pt-5">
                    <h4 class="mb-4">Контакты</h4> 
                    <ul class="d-grid gap-3 list-unstyled" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                        <li class="d-flex align-items-center gap-2">
                            <x-icon-location size="30px" color="#999"/>
                            <a href="https://yandex.ru/maps/-/CCUCFDAwwA" target="_blank">
                                <span itemprop="postalCode" style="font-size: 14px">141006</span>, 
                                <span itemprop="addressRegion">Московская обл</span>,
                                <span itemprop="addressLocality">г Мытищи</span>, 
                                <span itemprop="streetAddress" style="font-size: 14px">проезд 4536, стр 10</span>
                            </a>
                        </li>
                        <li class="d-flex align-items-center gap-2" style="font-size: 14px">
                            <x-icon-call size="22px" color="#999"/>
                            {!! $contact::getPhone(config('app.phone'), [], true) !!}
                        </li>
                        <li class="d-flex align-items-center gap-2" style="font-size: 14px">
                            <x-icon-mark-as-unread size="22px" color="#999"/>
                            {!! $contact::getEmail(config('app.email'), [], true) !!}
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <x-icon-alarm size="22px" color="#999"/>
                            Время работы:
                        </li>
                        <li itemscope itemtype="http://schema.org/LocalBusiness">
                            <time itemprop="openingHours" datetime="Mo-Fr, 09:00-19:00">
                                <b>Понедельник-Пятница, 09:00 - 19:00</b>
                            </time>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 pt-5">
                <hr />
            </div>
            <div class="col-12">
                <div class="d-flex align-items-center flex-wrap flex-lg-nowrap justify-lg-content-between">
                    <div class="text-center text-lg-start">
                        © <?=date('Y');?> <b>{{ config('app.name') }}</b>. Все права защищены.<br />
                        <small class="text-secondary">
                            Сайт не является публичной офертой
                            согласно положениям статьи 437 ГК РФ
                        </small>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-4"></div>
                        <div class="col-12 col-lg-8 text-center text-lg-end mt-lg-0 mt-4 mb-5 mb-lg-0">
                            <small>
                                Мы используем cookies для сбора обезличенных персональных данных. 
                                Они помогают настраивать рекламу и анализировать трафик. Оставаясь 
                                на сайте, вы соглашаетесь на сбор таких данных.
                            </small>                                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>