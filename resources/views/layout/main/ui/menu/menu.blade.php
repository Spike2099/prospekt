{{-- if ($_SERVER['REQUEST_URI'] === '/')
<ul class="navbar-nav mx-auto mb-2 mb-lg-0">
    <li class="nav-item">
        <a class="nav-link" href="/about">
            О компании
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#bestsellers">
            Хиты продаж
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/products/mersedes-benz">
            Запасные части
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#brand">
            Бренды
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#advantages">
            Преимущества
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/contact">
            Контакты
        </a>
    </li>
</ul>                        
else
endif --}}

<ul class="navbar-nav mx-auto mb-2 mb-lg-0 mt-4 mt-lg-0 text-center">
    
    <li class="nav-item">
        <a class="nav-link<?=($_SERVER['REQUEST_URI'] === '/about') ? ' active' : '';?>" href="/about">
            О компании
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link<?=($_SERVER['REQUEST_URI'] === '/production') ? ' active' : '';?>" href="/production">
            Производство
        </a>
    </li>
    
    
<!--    <li class="nav-item">
     <a class="nav-link<?=($_SERVER['REQUEST_URI'] === '/products/mercedes-benz') ? ' active' : '';?>" href="/products/mercedes-benz">
         Запасные части
     </a>
      <ul class="dropdown-menu">
 <li><a href="#">AYKU КОЛЕНВАЛЫ</a></li>
 <li><a href="#">GMS Водяные насосы</a></li>
 <li><a href="#">MVS Маховики</a></li>
 <li><a href="#">POWERHUB</a></li>
 <li><a href="#">SUNEX клапана ДВС</a></li>
 <li><a href="#">TURBO SuotePower</a></li>
 <li><a href="#">MERCEDES-BENZ</a></li>
 <li><a href="#">Запасные части СКЛАД 2</a></li>
</ul> 
 </li> -->
    <div class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Запасные части
    </a>
    <ul class="dropdown-menu" aria-labelledby="productsDropdown"> 
        <li><a class="dropdown-item" href="/products/mercedes-benz">MERCEDES-BENZ</a></li>
        <li><a class="dropdown-item" href="/stockMercedesBenz">MERCEDES-BENZ Склад 2</a></li>
         <li><a class="dropdown-item" href="/MercedesBenzNew">MERCEDES-BENZ Новый Склад</a></li>
        <li><a class="dropdown-item" href="/OilStock">MERCEDES-BENZ Масло Мотороное</a></li>
        <li><a class="dropdown-item" href="/turkishStock">MERCEDES-BENZ Склад Турция</a></li>
        <li><a class="dropdown-item" href="/TrSale">MERCEDES-BENZ Турция под заказ</a></li>
        <li><a class="dropdown-item" href="/dongfengParts">DONG-FENG</a></li>
        <li><a class="dropdown-item" href="/stock/81cf7449-727a-11ee-0a80-130600173515">POWERHUB</a></li>
        <li><a class="dropdown-item" href="/stock/d295833c-8399-11ee-0a80-0fb9000b7477">POWERHUB фильтры</a></li>
    <!--<li><a class="dropdown-item" href="/stock/e3295a56-770c-11ee-0a80-096e0020d4ec">AYKU КОЛЕНВАЛЫ</a></li> -->
        <li><a class="dropdown-item" href="/stock/a2a12edf-1642-11ee-0a80-13ab00041ab9">GMS Водяные насосы</a></li>
        <li><a class="dropdown-item" href="/stock/ef56740b-77e0-11ee-0a80-0cfa001004ff">MVS Маховики</a></li>
        <li><a class="dropdown-item" href="/stock/6f6ad146-794c-11ee-0a80-0290001d2dad">SUNEX клапана ДВС</a></li>
        <li><a class="dropdown-item" href="/stock/c07653f3-5d3d-11ee-0a80-0418001257ed">TURBO SuotePower</a></li>
        <li><a class="dropdown-item" href="/stock/e0cb6ca7-7a53-11ee-0a80-02dc001281c2">DONGFA Коленвалы</a></li>
                <li><a class="dropdown-item" href="/stock/3880dce6-9da5-11ee-0a80-084c0025ddf8">PROXMANN</a></li>
<!--         <li><a class="dropdown-item" href="stock/3880dce6-9da5-11ee-0a80-084c0025ddf8">PROXMANN</a></li> -->
    <!-- <li><a class="dropdown-item" href="/stock/416a3aff-0f66-11ee-0a80-0d9c00124798">ЗАПАСНЫЕ части СКЛАД 2</a></li> -->
        
    </ul>
</div>

    
    
    {{-- <li class="nav-item">
        <a class="nav-link<?php // =($_SERVER['REQUEST_URI'] === '/customers') ? ' active' : '';?>" href="/customers">
            Клиентам
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link<?php // =($_SERVER['REQUEST_URI'] === '/doc') ? ' active' : '';?>" href="/doc">
            Документы
        </a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link<?=($_SERVER['REQUEST_URI'] === '/contact') ? ' active' : '';?>" href="/contact">
            Контакты
        </a>
    </li>
    
<!--     <li class="nav-item">
  <a href="https://www.youtube.com/channel/UC2TKwHpX4HAFbPwaxIqNDXw" target="_blank" class="btn btn-outline-danger">

    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="20" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
      <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408z"></path>
    </svg>
    <span class="visually-hidden">Button</span>
  </a>
</li>    -->


<li class="nav-item">
<a href="https://wa.me/79017331866" target="_blank"  class="btn btn-success">
                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="20" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
  <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"></path>
</svg>
                  <span class="visually-hidden">Button</span>
                </a>         
</li> 
    
    <li class="nav-item-phone">
        {!! $contact::getPhone(config('app.phone'), ['nav-link', 'fw-bold']) !!}
    </li>
    
</ul> 

<style>

ul.navbar-nav {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
}

ul.navbar-nav li {
    position: relative;
    transition: transform 0.2s ease-in;
}

ul.navbar-nav li a {
    text-decoration: none;
    color: #333; /* Чуть темнее черного */
    padding: 10px 20px;
    display: inline-block;
    transition: color 0.2s ease-in;
}

ul.navbar-nav li a:hover {
    color: #3ca0e7;
}

ul.navbar-nav .dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background: white;
    min-width: 150px;
    box-shadow: 0px 3px 5px -1px #ccc;
    opacity: 0;
    transform: translateY(-10px);
    transition: opacity 0.2s ease-in, transform 0.2s ease-in;
}

ul.navbar-nav li:hover .dropdown-menu {
    display: block;
    opacity: 1;
    transform: translateY(0);
}

ul.navbar-nav .dropdown-menu li {
    margin: 0;
    padding: 0;
    transition: background-color 0.2s ease-in;
}

ul.navbar-nav .dropdown-menu li a {
    display: block;
    padding: 10px 20px;
    text-decoration: none;
    color: #333;
}

ul.navbar-nav .dropdown-menu li a:hover {
    color: #3ca0e7;
    background-color: #f0f0f0; /* Чуть светлее фона */
}

/* Добавим анимацию для улучшения визуального стиля */
ul.navbar-nav li:hover {
    transform: translateY(-5px);
}

.dropdown-menu {
    max-height: 650px; /* Установите желаемую максимальную высоту списка */
    overflow-y: auto; /* Добавляем вертикальную прокрутку при необходимости */
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var dropdownToggle = document.querySelector('.nav-item.dropdown');
    var dropdownMenu = dropdownToggle.querySelector('.dropdown-menu');
    var dropdownTitle = dropdownToggle.querySelector('.dropdown-toggle');

    // Для десктопной версии
    dropdownToggle.addEventListener('mouseenter', function () {
        dropdownMenu.style.display = 'block';
    });

    dropdownToggle.addEventListener('mouseleave', function () {
        dropdownMenu.style.display = 'none';
    });

    // Для мобильной версии
    dropdownTitle.addEventListener('click', function (event) {
        // Проверяем, является ли текущий экран мобильным
        if (window.innerWidth < 768) {
            // Отменяем стандартное действие перехода по ссылке
            event.preventDefault();
            
            // Переключаем состояние отображения меню
            if (dropdownMenu.style.display === 'block') {
                dropdownMenu.style.display = 'none';
            } else {
                dropdownMenu.style.display = 'block';
            }
        }
        // Предотвращаем всплытие события, чтобы оно не передавалось родительским элементам
        event.stopPropagation();
    });

    // Закрытие меню при клике вне его области
    document.addEventListener('click', function (event) {
        if (!dropdownToggle.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
});

</script>


