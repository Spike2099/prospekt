
@if($link === 'divider')
<li class="dropdown-divider"></li>
@else
<li>
    <a href="{{ $href }}" class="dropdown-item d-flex align-items-center gap-2" @if($target === 'target') target="_blank" @endif>
        @if($icon !== '')
        <span class="material-symbols-outlined fs-6 text-secondary">{{$icon}}</span> 
        @endif
        {{$link}}
    </a>    
</li>
@endif