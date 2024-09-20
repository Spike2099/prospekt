@php
    $company = $user->customer->company;
@endphp
@if(isset($company))
    @if(iconv_strlen($company) > 20)
    <div 
        class="company-name"
        style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis" 
        title="{{$company}}" data-bs-toggle="tooltip"
    >
        {{$company}}
    </div>   
    @else
    <div>{{$company}}</div> 
    @endif
@else
    <div>Нет данных</div>
@endif