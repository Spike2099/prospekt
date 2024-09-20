<div class="card border-0 rounded-bottom shadow border-top-0 rounded-0">
    <div class="d-flex justify-content-between align-items-center gap-2 card-header rounded-0 border-0">
        <div class="d-flex gap-2 align-items-center">
            <i class="material-symbols-outlined text-secondary">{{$icon}}</i> 
            <span>{!! $header !!}</span>                         
        </div>
        @if($verified)
        <div class="d-flex gap-2 align-items-center">
            <span class="material-symbols-outlined text-success">verified</span>
            <small>Подтверждена {{$verified}}</small>
        </div>
        @endif
    </div>
    <div class="card-body d-flex gap-3 flex-column" {{ $attributes }}>
        {{ $slot }}
    </div>
</div>