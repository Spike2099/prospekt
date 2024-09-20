@extends('layout/main')
@section('title', 'Номенклатура')

@section('content')  
<h6 class="text-muted">Всего {!! $decl::positions($list['odata.count']) !!}</h6>
<div class="row">
    <div class="col">
        <div class="card border-0 shadow-sm">
            <div class="table-responsive rounded-top">
                <div class="px-3 py-2">Поиск</div>
                <table class="table align-middle table-edge table-hover table-nowrap mb-0">
                    <thead class="border-bottom border-light bg-light" style="font-size: 14px">
                        <tr>
                            <th class="w-60px ps-3">
                                <div class="text-muted mb-0">#</div>
                            </th> 
                            <th>
                                <a href="javascript: void0;" class="text-muted text-decoration-none d-block" style="width: 210px">
                                    Артикул&#160;
                                    <span class="list-sort"></span>
                                </a>
                            </th>
                            <th>
                                <a href="javascript: void0;" class="text-muted text-decoration-none d-block" style="width: 210px">
                                    Название&#160;
                                    <span class="list-sort"></span>
                                </a>
                            </th>
                            <th>
                                <a href="javascript: void0;" class="text-muted text-decoration-none d-block" style="width: 210px">
                                    Код&#160;
                                    <span class="list-sort"></span>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="list" style="font-size: 14px">
                        @foreach ($list['value'] as $item)
                        <tr>
                            <td>
                                <div class="ms-2">{{$loop->iteration}}</div>
                            </td> 
                            <td>
                                <a href="../admin/nomenclature/gtd/{{$item['Ref_Key']}}" class="text-danger text-decoration-none fw-bold">
                                    {{$item['Артикул']}}
                                </a>
                            </td>
                            <td>
                                <div>
                                    {{$item['Description']}}
                                </div>
                            </td>
                            <td>
                                <div>
                                    {{$item['Code']}}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <pre><?php //var_dump($list['value']);?></pre>
    </div>
</div>
@endsection