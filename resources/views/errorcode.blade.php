@extends('layout/index', [
    'title' => 'Наше производство | Проспект Партс',
    'keywords' => 'сервис, service, компания, автосервис, мерседес бенц, актрос',
    'description' => 'Коды ошибок Mercedes-Benz.',
    'image' => 'https://prospekt-parts.com/img/5464765787695.jpg'
])

@section('title', ' Коды ошибок Mercedes-Benz')

@section('content')
<div class="w-100" style="background-image: url(/img/actroscode.jpg); background-position: center -313px; background-attachment: fixed; background-size: cover; height: 250px; text-shadow: 1px 2px 3px #000">
    <div class="d-flex align-items-center justify-content-center h-100" style="background-color: rgb(0 0 0 / 62%)">
        <h2 class="text-white pt-5 mb-0">Описание Ошибок Системы</h2>
    </div>
</div>

<section class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2 text">
                <!-- Ваш текущий контент -->

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
                @foreach($errorCodesCategories as $category)
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
@endsection
