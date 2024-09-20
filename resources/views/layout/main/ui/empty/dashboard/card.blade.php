@if(isset($item['article']))
<div class="col-12 col-lg-4">
    <div class="card card-data border-0 shadow-sm order">
        @include('layout.main.ui.card.card-admin-image')
        <div class="card-body">
            <h5 class="card-title fs-5 mb-3" style="height: 48px">
                <a href="/dashboard/product/details/{{$item['id']}}" class="text-dark fw-bold text-decoration-none">
                    {{$item['name']}}
                </a>
            </h5>
            @include('layout.main.ui.quantity.quantity-admin')
            <div class="d-flex align-items-center justify-content-between">
                @include('layout.main.ui.card.card-admin-article')
                @include('layout.main.ui.button.card-admin-button')
            </div>
        </div>
    </div>
</div>
@endif