<div>
    <select id="selectOffsetButtom" class="form-select" onchange="selectOffsetButtom()">
        @foreach ([10, 15, 25, 50, 100] as $key)
            <option value="/dashboard/catalog/category/8854033a-48ad-11ed-0a80-0c87007f4175/{{$key}}/0" @if($key == $limit) selected @endif >
                {{$key}}
            </option>
        @endforeach
    </select>                        
</div>