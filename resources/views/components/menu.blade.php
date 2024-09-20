@php
    if($_SERVER['REQUEST_URI'] === '/dashboard') {
        list($home, $section) = explode('/', $_SERVER['REQUEST_URI']);
        $currenturl = $home.'/'.$section;        
    } else {
        list($home, $section, $info) = explode('/', $_SERVER['REQUEST_URI']);
        $currenturl = $home.'/'.$section.'/'.$info;
    }
@endphp
<div class="accordion" id="content">
    <li 
        style="font-size:12px"
        class="list-group-item disabled bg-white text-secondary mt-3 px-3 py-2" 
        :class="{'text-center' : !isOpen}"
    >
        <template v-if="isOpen">{{$header}}</template>
        <template v-else>-</template>
    </li>
    @foreach($list as $i)
        @if($i['list'])
        <div class="accordion-item border-0">
            <h2 class="accordion-header border-top border-light" id="heading{{ $loop->iteration}}{{$id}}" v-on:click="toggleSubMenu">
                <a 
                    href="/dashboard/{{ $i['slug'] }}"
                    class="d-flex gap-2 py-2 px-3 bg-white text-dark tooltips shadow-none rounded-0 text-decoration-none cp border-start border-4 
                    @if($currenturl === '/dashboard/'.$i['slug']) border-danger @else border-white @endif" 
                    :class="[isOpen ? 'accordion-button' : 'justify-content-center']" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapse{{$loop->iteration}}{{$id}}"
                >
                    <i class="material-symbols-outlined text-secondary">{{ $i['icon'] }}</i>
                    <span v-if="isOpen">{{ $i['name'] }}</span>
                    <span v-else class="tooltiptext">{{ $i['name'] }}</span> 
                </a>
            </h2>
            <div 
                id="collapse{{$loop->iteration}}{{$id}}" 
                class="accordion-collapse collapse @if($currenturl === '/dashboard/'.$i['slug']) show @endif" 
                aria-labelledby="heading{{$loop->iteration}}{{$id}}" 
                data-bs-parent="#content"
            >
                <div class="accordion-body bg-light pe-0 py-0 border-end border-white">
                    <ul id="submenu" class="border-start border-muted list-group list-group-flush bg-transparent ms-2">
                        @foreach($i['list'] as $d)
                            @if($d['name'] !== 'divider')
                                <a 
                                    href="{{ '/dashboard/'.$d['href'] }}" 
                                    class="list-group-item bg-light @if('/dashboard/'.$d['href'] === $_SERVER['REQUEST_URI']) fw-bold @endif" 
                                    style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;width: 215px"
                                    title="{{$d['name']}}"
                                >
                                    {{$d['name']}}
                                </a>
                            @endif
                        @endforeach 
                    </ul>
                </div>
            </div>
        </div>
        @else
        <div class="border-top border-light">
            <a 
                href="{{ '/dashboard/'.$i['slug'] }}"  
                class="d-flex align-items-center text-decoration-none bg-white text-dark tooltips border-start border-4
                @if($_SERVER['REQUEST_URI'] === '/dashboard/'.$i['slug']) border-danger @else border-white @endif"
                :class="[isOpen ? 'justify-content-between' : 'justify-content-center']"
            >
                <span class="d-flex gap-2 px-3 py-2">
                    <i class="material-symbols-outlined text-secondary">{{ $i['icon'] }}</i>
                    <span v-if="isOpen">{{ $i['name'] }}</span>   
                    <span v-else class="tooltiptext">{{ $i['name'] }}</span>             
                </span>
                @if($i['count'])
                    @if($i['name'] === 'Корзина')
                        <span class="badge bg-danger rounded-pill me-2" v-if="card.length" :class="[!isOpen ? 'label-menu' : '']">
                            @{{card.length}}
                        </span>
                    @elseif($i['name'] === 'Предзаказы')
                        <span class="badge bg-danger rounded-pill me-2" v-if="preorder.length" :class="[!isOpen ? 'label-menu' : '']"> 
                            @{{preorder.length}}
                        </span>
                    @else
                    <span class="badge bg-danger rounded-pill me-2" :class="[!isOpen ? 'label-menu' : '']">
                        {{ $i['count'] }}
                    </span>
                    @endif
                @endif
            </a>            
        </div>
        @endif
    @endforeach    
</div>