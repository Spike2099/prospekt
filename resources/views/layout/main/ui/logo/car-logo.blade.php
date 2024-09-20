<div class="d-flex align-items-center gap-2">
    <div>
        @if ($stock['id'] === '254c7d33-15ba-11ee-0a80-09a00027e0da')
            <img 
                src="/img/partner/Gearax/gearax.png" 
                alt="Gearax" 
                style="background: #efeded;border-radius: 50em;width: 37px; height: 37px"
            />
        @elseif ($stock['id'] === 'a2a12edf-1642-11ee-0a80-13ab00041ab9')
            <img 
                src="/img/partner/GMS/gms.png" 
                alt="GMS"
                style="background: #efeded;border-radius: 50em;width: 37px; height: 37px"
            />
        @elseif ($stock['id'] === '81cf7449-727a-11ee-0a80-130600173515')    
             <img 
                src="/img/partner/GMS/PHB.png" 
                alt="PHB"
                style="background: #efeded;border-radius: 50em;width: 37px; height: 37px"
            />
        @elseif ($stock['id'] === 'd295833c-8399-11ee-0a80-0fb9000b7477')    
             <img 
                src="/img/partner/GMS/PHB.png" 
                alt="PHB"
                style="background: #efeded;border-radius: 50em;width: 37px; height: 37px"
            />
        @elseif ($stock['id'] === '6f6ad146-794c-11ee-0a80-0290001d2dad')    
             <img 
                src="/img/partner/GMS/sunex_final.png" 
                alt="PHB"
                style="background: #efeded;border-radius: 50em;width: 37px; height: 37px"
            />
        @else
           <!--  <img src="/img/mercedes-benz.png" alt="Mercedes-Benz" style="width: 37px;height: 37px"> -->
        @endif
    </div>
    <div class="lh-sm">
        <small class="text-muted d-block w-100">
            {{$item['article']}}                                            
        </small>
<strong class="text-secondary">
    @if ($stock['id'] === 'a2a12edf-1642-11ee-0a80-13ab00041ab9')
        {{$stock['name']}}
    @elseif ($stock['id'] === '254c7d33-15ba-11ee-0a80-09a00027e0da')
        {{$stock['name']}}
    @elseif ($stock['id'] === '81cf7449-727a-11ee-0a80-130600173515')
        POWERHUB 
    @elseif ($stock['id'] === 'd295833c-8399-11ee-0a80-0fb9000b7477')
        POWERHUB
    @elseif ($stock['id'] === 'ef56740b-77e0-11ee-0a80-0cfa001004ff')
        MVS
    @elseif ($stock['id'] === '6f6ad146-794c-11ee-0a80-0290001d2dad')
        SUNEX
    @elseif ($stock['id'] === 'c07653f3-5d3d-11ee-0a80-0418001257ed')
        SuotePower
    @elseif ($stock['id'] === 'e0cb6ca7-7a53-11ee-0a80-02dc001281c2')
        DONGFA  
    @else
        Mercedes-Benz
    @endif
</strong>
    </div>
</div>