@php
   
@endphp


@extends('layout/main')
@section('title', 'MySql DB')

@section('breadcrumbs')
    <div class="d-flex gap-2 mb-2">
        <a href="/dashboard" class="text-muted">Панель</a>
        <span class="text-secondary">/</span>
        <span class="text-muted">База данных</span>
    </div>
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
             <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            
                <div class="container">
                    <h1>Панель управления MYSQL БД</h1>
                    <!--  форма для добавления товаров -->
                   
                       <!--  @csrf -->
                                        
                        <form action="{{ route('addProduct') }}" method="POST">
                            <div class="form-group">
                                <label for="id">Id Склада:</label>
                                <input type="text" class="form-control" id="stock_category_id" name="stock_category_id">
                                
                                <label for="article">Цена:</label>
                                <input type="text" class="form-control" id="article" name="article">
                           
                                <label for="quantity">Количество:</label>
                                <input type="text" class="form-control" id="quantity" name="quantity">
                                
                                <label for="article">Артикул:</label>
                                <input type="text" class="form-control" id="article" name="article">
                          
                                <label for="name">Наименование:</label>
                                <input type="text" class="form-control" id="name" name="name">
                                
                            </div>
                                  @csrf
                            <!--  другие поля, таблицы stock -->
                            <button type="submit" class="btn btn-primary">Добавить Товар</button>
                          
                        </form>

                
                <!--     </form> -->
                    
                    <!--  таблица существующих товаров -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Цена</th>
                                <th>Количество</th>
                                <th>Артикул</th>
                                <th>Наименование</th>
                                <th>ID Склада</th>
                           <!--      <th>Описание</th> -->
                                <!-- Добавьте  заголовки -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->article }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->stock_category_id }}</td>
                              <!--    <td>{{ $product->description }}</td> -->
                                <!-- Отображайте других полей, если необходимо -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection