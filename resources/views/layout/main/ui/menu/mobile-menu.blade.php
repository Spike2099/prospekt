<div class="fixed-bottom" style="z-index: 20">
    <div class="d-flex d-lg-none align-items-center justify-content-center bg-white shadow p-3 gap-5">
        <div>
            <a href="#" class="d-flex flex-column align-items-center text-decoration-none text-dark" data-bs-toggle="modal" data-bs-target="#searchForm">
                <x-icon-search size="24px" color="#310062" />
                <span>Поиск</span>
            </a>
        </div>
        <div>
            @guest
            <a href="/signin" class="d-flex flex-column align-items-center text-decoration-none text-dark">
                <x-icon-login size="24px" color="#310062" />
                <span>Войти</span>
            </a>
            @endguest
            @auth
            <a href="/dashboard" class="d-flex flex-column align-items-center text-decoration-none text-dark">
                <x-icon-person size="24px" color="#310062" />
                <span>Профиль</span>
            </a>
            @endauth
        </div>
        <div>
            @guest
                <template v-if="card.length > 0">
                    <a href="/card" class="d-flex flex-column align-items-center text-decoration-none text-dark position-relative">
                        <x-icon-shopping-cart size="24px" color="#310062" />
                        <span>Корзина</span>
                        <small class="position-absolute translate-middle badge rounded-pill bg-danger text" style="right: -12px">
                            @{{card.length}}
                        </small>
                    </a>
                </template>
                <template v-else>
                    <div class="d-flex flex-column align-items-center text-decoration-none text-dark" data-bs-toggle="tooltip" title="Ваша корзина пуста">
                        <x-icon-shopping-cart size="24px" color="#310062" />
                        <span>Корзина</span>
                    </div>
                </template>
            @endguest

            @auth
                <template v-if="card.length > 0">
                    <a href="/dashboard/card" class="d-flex flex-column align-items-center text-decoration-none text-dark position-relative">
                        <x-icon-shopping-cart size="24px" color="#310062" />
                        <span>Корзина</span>
                        <small class="position-absolute translate-middle badge rounded-pill bg-danger text" style="right: -12px">
                            @{{card.length}}
                        </small>
                    </a>
                </template>
                <template v-else>
                    <div class="d-flex flex-column align-items-center text-decoration-none text-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ваша корзина пуста">
                        <x-icon-shopping-cart size="24px" color="#310062" />
                        <span>Корзина</span>
                    </div>
                </template>
            @endauth
        </div>
    </div>
</div>