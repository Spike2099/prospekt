<div class="card shadow-sm border-0 mt-4">
    <button class="cp card-header rounded bg-white py-3 border-0 d-flex align-items-center justify-content-between" data-bs-toggle="collapse" data-bs-target="#{{$category}}">
        <div class="d-flex align-items-center gap-2">
            <i class="material-symbols-outlined text-danger">{{$icon}}</i> 
            <strong>{{$header}}</strong>             
        </div>
        <div>
            <span class="d-flex align-items-center material-symbols-outlined text-secondary">expand_more</span>
        </div>
    </button>
    <div class="collapse" id="{{$category}}">
        <div class="card-body border-top">
            <ul>
                <li><a href="#">Some placeholder content for</a></li>
                <li><a href="#">the collapse component.</a></li>
                <li><a href="#">This panel is hidden by defaul</a></li>
                <li><a href="#">but revealed when</a></li>
                <li><a href="#">the user activates the</a></li>
            </ul>
        </div>
    </div>
</div>