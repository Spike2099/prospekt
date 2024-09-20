<ul class="list-group list-group-flush">
    @foreach($list as $li)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <small>{{ $li->name }}</small> 
        <span class="badge bg-light text-danger rounded-pill">{{ $li->data }}</span>
    </li>
    @endforeach
</ul>