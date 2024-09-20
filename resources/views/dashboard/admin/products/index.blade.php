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
                    <!-- Форма для добавления товаров -->
                    <form action="{{ route('products.store') }}" method="POST">
                        <div class="form-group">
                            <label for="stock_category_id">Id Склада:</label>
                            <select class="form-control" id="stock_category_id" name="stock_category_id">
                                <option value="1">MERCEDES-BENZ СКЛАД 2</option>
                                <option value="2">DONG-FENG</option>
                                <option value="3">Запчасти Оригиналы</option>
                            </select>
                            <label for="price">Цена:</label>
                            <input type="text" class="form-control" id="price" name="price">
                            <label for="quantity">Количество:</label>
                            <input type="text" class="form-control" id="quantity" name="quantity">
                            <label for="article">Артикул:</label>
                            <input type="text" class="form-control" id="article" name="article">
                            <label for="name">Наименование:</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        @csrf
                        <!-- Другие поля, таблицы stock -->
                        <div>
                            <button type="submit" class="btn btn-primary">Оприходовать Товар</button>
                            <button type="button" class="btn btn-danger">Удалить выбранный товар</button>
                        </div>
                    </form>
                    <div class="mt-4">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                    <!-- Таблица существующих товаров -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th>Артикул</th>
                            <th>Наименование</th>
                            <th>ID Склада</th>
                            <th>Выбор товара</th>
                            <th>Удалить</th> <!-- Добавлен заголовок для кнопки удаления -->
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
                                <!-- Добавление чекбокса и кнопки удаления -->
                                <td><input type="checkbox" name="selected" value="{{ $product->id }}"></td>
                                <td>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div >
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection