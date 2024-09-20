@php
    $isSize = $size === 'lg' ? 'btn-lg' : '';
    $variable = $size === 'sm' ? 'btn-sm' : $isSize;
@endphp

@if ($type === 'button' || $type === 'reset' || $type === 'submit')
<button {{ $attributes }} type="{{ $type }}" class="btn btn-{{ $color }} px-4 @if($icon) d-flex align-items-center gap-2 @endif {{ $variable }} justify-content-center" >
    @if($icon)
    <span class="material-symbols-outlined d-none @if($size === 'sm') fs-5 @endif">{{$icon}}</span>
    @endif
    {{$text}}
</button>
@else
<a href="{{ $href }}" {{ $attributes }} class="btn btn-{{ $color }} px-4 d-flex align-items-center gap-2 @if($icon) d-flex align-items-center gap-2 @endif {{ $variable }} justify-content-center">
    @if($icon)
    <span class="material-symbols-outlined @if($size === 'sm') fs-5 @endif">{{$icon}}</span>
    @endif
    {{$text}}
</a>
@endif