@extends('layout/main')
@section('title', 'Сообщения')

@section('content')
<h6 class="text-muted">Пока оповещений нет</h6>
<ul class="list-group list-group-flush mt-4 d-grid gap-2">
    <li class="list-group-item d-flex justify-content-between align-items-center rounded shadow-sm border-0">
        <small class="d-flex align-items-center gap-3" style="width: 320px;">
            <span class="material-symbols-outlined text-warning fs-1">warning</span> 
            <a href="http://prospektrans.host/dashboard/product/details/42919327-5064-11ed-0a80-05bf003d0d2b" class="d-flex align-items-center text-muted text-decoration-none">
                <div class="d-flex justify-content-start flex-column">
                    <span>Внимание</span> 
                    <p class="fw-bold text-dark m-0">Просрочен счёт на оплату!</p>
                </div>
            </a>
        </small>
        <div class="position-relative" style="width: 180px;">
            40 000,00
            &nbsp;₽
        </div>
        <div style="width: 100px;"><span class="badge bg-soft-danger text-danger"><span class="legend-indicator bg-danger"></span>Не оплачено</span></div>
        <div class="btn-group"><button class="btn text-danger rounded material-symbols-outlined">delete</button></div>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center rounded shadow-sm border-0">
        <small class="d-flex align-items-center gap-3" style="width: 320px;">
            <span class="material-symbols-outlined text-danger fs-1">production_quantity_limits</span> 
            <a href="http://prospektrans.host/dashboard/product/details/42919327-5064-11ed-0a80-05bf003d0d2b" class="d-flex align-items-center text-muted text-decoration-none">
                <div class="d-flex justify-content-start flex-column">
                    <span>Корзина</span> 
                    <p class="fw-bold text-dark m-0">Операция не завершена</p>
                </div>
            </a>
        </small>
        <div class="position-relative" style="width: 180px;">
            150 000,00
            &nbsp;₽
        </div>
        <div style="width: 100px;"><span class="badge bg-soft-danger text-danger"><span class="legend-indicator bg-danger"></span>Не оплачено</span></div>
        <div class="btn-group"><button class="btn text-danger rounded material-symbols-outlined">delete</button></div>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center rounded shadow-sm border-0">
        <small class="d-flex align-items-center gap-3" style="width: 320px;">
            <span class="material-symbols-outlined text-muted fs-1">mark_email_unread</span> 
            <a href="http://prospektrans.host/dashboard/product/details/42919327-5064-11ed-0a80-05bf003d0d2b" class="d-flex align-items-center text-muted text-decoration-none">
                <div class="d-flex justify-content-start flex-column">
                    <span>Ответ от менеджера</span> 
                    <p class="fw-bold text-dark m-0">Запрос по счёту №00008</p>
                </div>
            </a>
        </small>
        <div class="position-relative" style="width: 180px;">
            35 980,00
            &nbsp;₽
        </div>
        <div style="width: 100px;"><span class="badge bg-soft-warning text-warning"><span class="legend-indicator bg-warning"></span>Ожидает</span></div>
        <div class="btn-group"><button class="btn text-danger rounded material-symbols-outlined">delete</button></div>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center rounded shadow-sm border-0">
        <small class="d-flex align-items-center gap-3" style="width: 320px;">
            <span class="material-symbols-outlined text-muted fs-1">mark_email_unread</span> 
            <a href="http://prospektrans.host/dashboard/product/details/42919327-5064-11ed-0a80-05bf003d0d2b" class="d-flex align-items-center text-muted text-decoration-none">
                <div class="d-flex justify-content-start flex-column">
                    <span>Ответ от менеджера</span> 
                    <p class="fw-bold text-dark m-0">Запрос по договору №00001</p>
                </div>
            </a>
        </small>
        <div class="position-relative" style="width: 180px;">-- . --</div>
        <div style="width: 100px;"><span class="badge bg-soft-warning text-warning"><span class="legend-indicator bg-warning"></span>Ожидает</span></div>
        <div class="btn-group"><button class="btn text-danger rounded material-symbols-outlined">delete</button></div>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center rounded shadow-sm border-0">
        <small class="d-flex align-items-center gap-3" style="width: 320px;">
            <span class="material-symbols-outlined text-muted fs-1">quick_reference</span> 
            <a href="http://prospektrans.host/dashboard/product/details/42919327-5064-11ed-0a80-05bf003d0d2b" class="d-flex align-items-center text-muted text-decoration-none">
                <div class="d-flex justify-content-start flex-column">
                    <span>Статус договора</span> 
                    <p class="fw-bold text-dark m-0">Договор в 2х экземплярах получен</p>
                </div>
            </a>
        </small>
        <div class="position-relative" style="width: 180px;">-- . --</div>
        <div style="width: 100px;"><span class="badge bg-soft-info text-info"><span class="legend-indicator bg-info"></span>На подписании</span></div>
        <div class="btn-group"><button class="btn text-danger rounded material-symbols-outlined">delete</button></div>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center rounded shadow-sm border-0">
        <small class="d-flex align-items-center gap-3" style="width: 320px;">
            <span class="material-symbols-outlined text-muted fs-1">bus_alert</span> 
            <a href="http://prospektrans.host/dashboard/product/details/42919327-5064-11ed-0a80-05bf003d0d2b" class="d-flex align-items-center text-muted text-decoration-none">
                <div class="d-flex justify-content-start flex-column">
                    <span>Доставка</span> 
                    <p class="fw-bold text-dark m-0">Товар отправлен на адрес</p>
                </div>
            </a>
        </small>
        <div class="position-relative" style="width: 180px;">-- . --</div>
        <div style="width: 100px;"><span class="badge bg-soft-info text-info"><span class="legend-indicator bg-info"></span>В пути</span></div>
        <div class="btn-group"><button class="btn text-danger rounded material-symbols-outlined">delete</button></div>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center rounded shadow-sm border-0">
        <small class="d-flex align-items-center gap-3" style="width: 320px;">
            <span class="material-symbols-outlined text-muted fs-1">bus_alert</span> 
            <a href="http://prospektrans.host/dashboard/product/details/42919327-5064-11ed-0a80-05bf003d0d2b" class="d-flex align-items-center text-muted text-decoration-none">
                <div class="d-flex justify-content-start flex-column">
                    <span>Доставка</span> 
                    <p class="fw-bold text-dark m-0">Товар прибыл на адрес</p>
                </div>
            </a>
        </small>
        <div class="position-relative" style="width: 180px;">-- . --</div>
        <div style="width: 100px;"><span class="badge bg-soft-success text-success"><span class="legend-indicator bg-success"></span>Доставлено</span></div>
        <div class="btn-group"><button class="btn text-danger rounded material-symbols-outlined">delete</button></div>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center rounded shadow-sm border-0">
        <small class="d-flex align-items-center gap-3" style="width: 320px;">
            <span class="material-symbols-outlined text-danger fs-1">quick_reference</span> 
            <a href="http://prospektrans.host/dashboard/product/details/42919327-5064-11ed-0a80-05bf003d0d2b" class="d-flex align-items-center text-muted text-decoration-none">
                <div class="d-flex justify-content-start flex-column">
                    <span>Статус договора</span> 
                    <p class="fw-bold text-dark m-0">Договор расторгнут</p>
                </div>
            </a>
        </small>
        <div class="position-relative" style="width: 180px;">-- . --</div>
        <div style="width: 100px;"><span class="badge bg-soft-danger text-danger"><span class="legend-indicator bg-danger"></span>В доступе отказано</span></div>
        <div class="btn-group"><button class="btn text-danger rounded material-symbols-outlined">delete</button></div>
    </li>
</ul>
@endsection