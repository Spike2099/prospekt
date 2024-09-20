<div id="header" class="d-flex justify-content-between align-items-start flex-column bg-white d-print-none position-relative shadow-sm">
    <div class="w-100">
        <a 
            href="/dashboard" 
            class="d-flex justify-content-center align-items-center gap-2 text-decoration-none logo text-center px-3 py-3"
            :class="[!isOpen ? 'justify-content-center w-100' : '']"
        >
            <img src="{{ asset('img/dark-logo.png') }}" alt="{{ config('app.name') }}" />
            <template v-if="isOpen">
                <h5 class="text-dark m-0"><span class="fw-bold">Prospekt</span> Parts</h5>
            </template>
        </a>
        
        @if($deal::status() === '1')
        <div id="inner-content">
            @role('admin')
            
            @foreach($adminmenu as $item)
                    <x-menu id="1" header="{{$item['header']}}" :list="$item['list']" />
                @endforeach  
            @endrole
            
            @foreach($menu as $item)
                <x-menu id="2" header="{{$item['header']}}" :list="$item['list']" />
            @endforeach
        </div>
        
        @elseif($deal::status() === '2')
            <div id="inner-content">
                @role('customer')
                    @foreach($usermenu as $item)
                        <x-menu id="2" header="{{$item['header']}}" :list="$item['list']" />
                    @endforeach  
                @endrole
            </div>
        
        @else
            @foreach($stop as $item)
                <x-menu id="3" header="{{$item['header']}}" :list="$item['list']" />
            @endforeach
        @endif
    </div>
    
    <?php /*
    <div>
        <div class="list-group-item d-flex gap-2 align-items-center bg-primary px-3 py-1 mt-4">
            <span class="badge bg-success"> 
                <span class="material-symbols-outlined fs-6">emoji_transportation</span>
            </span>
            <a href="#" class="text-decoration-none d-flex">
                <small class="text-white" v-if="isOpen" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;width: 170px">
                    @if($user->customer->company)
                        {{$user->customer->company}}
                    @else
                        Нет данных
                    @endif
                </small>                    
            </a>
        </div>        
        <div class="list-group-item d-flex gap-2 align-items-center bg-primary px-3 py-1 mb-4">
            <span class="badge bg-success"> 
                <span class="material-symbols-outlined fs-6">join_left</span>
            </span>
            <a href="#" class="text-decoration-none d-flex">
                <small class="text-white" v-if="isOpen">Цена</small>                    
            </a>
        </div> 
    </div>
    */ ?>

</div>