@extends('layout/main')
@section('title', 'Счета')

@section('content')
<h6 class="text-muted">Всего {{$decl::orders($model['meta']['size'])}}</h6>
<div class="row mt-2">
    <div class="col-md-12">
        <div class="card bg-white border-0 shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between bg-white border-0">
                <form>
                    <div class="input-group input-group-merge input-group-flush">
                        <div class="input-group-prepend input-group-text bg-white border-end-0 border-light ps-2 pe-0">
                            <span class="material-symbols-outlined text-secondary fs-5">search</span>
                        </div> 
                        <input type="search" placeholder="Поиск счетов..." class="form-control border-light border-start-0" />
                    </div>
                </form>
                <div>...</div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover m-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col"><small class="ps-3 text-muted">#</small></td>
                            <th scope="col"><small class="text-muted ms-3">№ Счёта</small></th>
                            <th scope="col"><small class="text-muted">Контрагент</small></th>
                            <th scope="col"><small class="text-muted">Сумма</small></th>
                            <th scope="col"><small class="text-muted">Оплачено</small></th>
                            <th scope="col"><small class="text-muted">Статус</small></th>
                            <th scope="col" style="width: 190px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($model['rows'] as $item)
                        <tr class="align-middle">
                            <td class="ps-3 d-flex align-items-center" style="height: 48px">
                                <input type="checkbox" name="check"  class="form-check-input mt-0" />
                            </td>
                            <td>
                                <a href="/dashboard/payment/order/{{$item['id']}}" class="ms-3 text-decoration-none fw-bold text-dark">
                                    #{{$item['name']}}
                                </a>
                            </td>
                            <td>
                                {{$item['agent']['name']}}
                            </td>
                            <td>
                                <small>
                                    {!!$currency::summa($item['sum'])!!}
                                </small>
                            </td>
                            <td>
                                <small>
                                    {!!$currency::summa($item['payedSum'])!!}
                                </small>
                            </td>
                            <td>
                                <x-badge color="{{$item['state']['color']}}" text="{{$item['state']['name']}}" />
                            </td>
                            <td>
                                <x-button 
                                    type="a" 
                                    size="sm" 
                                    color="dark"
                                    href="/dashboard/doc/{{$item['id']}}/{{$item['name']}}.pdf"
                                    text="Скачать в PDF" 
                                    icon="download" 
                                />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>                    
                </table>
            </div>
            @if (isset($model['meta']['nextHref']) || $offset > 0)
                <div class="card-footer border-top-0 bg-white d-flex align-items-center justify-content-between">
                    <div>
                        <select id="selectOffset" class="form-select" onchange="selectOffset()">
                            @foreach ([15, 25, 50, 100] as $key)
                                <option value="/dashboard/accounts/{{$key}}/0" @if($key == $limit) selected @endif >
                                    {{$key}}
                                </option>
                            @endforeach
                        </select>                        
                    </div>

                    <nav>
                        <ul class="pagination m-0">
                            @if (isset($model['meta']['previousHref']))
                                <?php 
                                    $url_previous = parse_url($model['meta']['previousHref'], PHP_URL_QUERY);
                                    parse_str($url_previous, $previous);
                                ?>
                                <li class="page-item">
                                    <a class="page-link" href="/dashboard/accounts/{{$previous['limit']}}/{{$previous['offset']}}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span> Назад
                                    </a>
                                </li>  
                            @else
                                <li class="page-item disabled">
                                    <a class="page-link" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span> Назад
                                    </a>
                                </li>                                
                            @endif

                            @if (isset($model['meta']['nextHref']))
                                <?php 
                                    $url_next = parse_url($model['meta']['nextHref'], PHP_URL_QUERY);
                                    parse_str($url_next, $next);
                                ?>
                                <li class="page-item">
                                    <a class="page-link" href="/dashboard/accounts/{{$next['limit']}}/{{$next['offset']}}" aria-label="Next">
                                        Далее <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>                                
                            @else
                                  
                            @endif

                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection