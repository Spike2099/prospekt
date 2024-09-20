@if($color === '40931')
<span class="badge bg-soft-info text-info d-print-none">
    <span class="legend-indicator bg-info"></span>
    {{$text}}
</span>
@elseif($color === '34617')
<span class="badge bg-soft-success text-success d-print-none">
    <span class="legend-indicator bg-success"></span>
    {{$text}}
</span>
@elseif($color === 'danger')
<span class="badge bg-soft-danger text-danger d-print-none">
    <span class="legend-indicator bg-danger"></span>
    {{$text}}
</span>
@else
<span class="badge d-print-none" style="background: #<?=dechex($color);?>30; color: #<?=dechex($color);?>">
    <span class="legend-indicator" style="background: #<?=dechex($color);?>"></span>
    {{$text}}
</span>
@endif