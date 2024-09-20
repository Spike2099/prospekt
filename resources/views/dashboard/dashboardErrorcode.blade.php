@extends('layout/main')
@section('title', 'Коды ошибок')

@section('breadcrumbs')
    <div class="d-flex gap-2 mb-2">
        <a href="/dashboard" class="text-muted">Панель</a>
        <span class="text-secondary">/</span>
        <span class="text-muted">Товары</span>
    </div>
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!--  <div class="col-12 col-lg-6">
        <div class="row">
            <div class="col-lg-12"> d-flex justify-content-center -->
                        <!--     <section class="bg-white"> -->
                <div class="container ">
                    <div class="row">
                        <div class="col-12 col-lg-8 offset-lg-2 text">
                            <!-- текущий контент -->
                            <h2 class="fw-bold text-center mb-4">Коды Ошибок Mercedes-Benz<img src="/img/about/offer.png" style="width: 80px" alt="offer" /></h2>
                            <hr class="bar" />
                           <div class="search-form">
                            <input type="text" v-model="searchText" placeholder="Введите код ошибки">
                            <button @click="searchError">Найти</button>
                        </div>
                        
                        <!-- Flex контейнер для ячеек -->
                        <div class="flex-container">
                            <!-- Ячейки -->
                            <!-- Ячейки МР1 и МР2, отображаются всегда, поэтому не нужно условие v-if -->
                            @foreach($dashboarderrorCodesCategories as $category)
                                <div class="cell-error">
                                    {{$category->description}}
                                </div>
                                <table class="error-table">
                                    <thead>
                                        <tr>
                                            <th>Код ошибки</th>
                                            <th>Описание ошибки</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($category->errorCodes as $code)
                                            <tr>
                                                <td><a href="{{ route('errorcode.showerror', $code->code) }}">{{ $code->code }}</a></td>
                                                <td>{{ $code->description }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                    <br>
                                @endforeach
                            </div>
                            <!-- <div v-else class="no-errors">Нет данных об ошибках</div> -->
                        </div>
                    </div>
                </div>
            </section>

   <!--          </div>
           </div>
       </div> -->
@endsection