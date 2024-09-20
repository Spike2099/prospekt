@php
@endphp


@extends('layout/main')
@section('title', 'Оприходования')

@section('breadcrumbs')
    <div class="d-flex gap-2 mb-2">
        <a href="/dashboard" class="text-muted">Панель</a>
        <span class="text-secondary">/</span>
        <a href="dashboard/admin/receipts" class="text-muted">Оприходования</a>
    </div>
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="mb-3">
        <a href="" method="GET" type="submit" class="btn btn-success">Сохранить</a>
<!--         <a href="" method="GET" type="submit" class="btn btn-outline-secondary">Закрыть</a>
<a href="" method="GET" type="submit" class="btn btn-outline-secondary">Печать</a> -->
    </div>
    <div class="col-12 col-lg-10">
        <div class="row">
            <form action="{{ route('receipts.store') }}" method="POST">
                <div class="mb-3 row">
                    <label for="documentNumber" class="col-sm-2 col-form-label">Оприходование №</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="documentNumber">
                    </div>
                    
                <label for="isIncoming" class="col-sm-2 col-form-label">от</label>
                    <div class="col-sm-3">
                        <input type="datetime-local" class="form-control" id="isIncoming" value="2024-06-14T19:02">
                    </div>
                </div>

                <div class="container mt-5">
                    <!-- <form action="{{ route('receipts.store') }}" method="POST"> -->
                     <div class="form-group">
                        <div class="mb-3 row">
                            <label for="stock_category_id" class="col-sm-2 col-form-label">Склад</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="stock_category_id" name="stock_category_id">
                                    <option value="1">MERCEDES-BENZ СКЛАД 2</option>
                                    <option value="2">DONG-FENG</option>
                                    <option value="3">Запчасти Оригиналы</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3 row">
                            <label for="date" class="col-sm-2 col-form-label">Дата</label>
                        <!--<div class="col-sm-6">
                            <input type="datetime-local" class="form-control" id="date" name="creation_date" value="2024-06-14T19:02">
                        </div> -->
                        </div>
                        
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Главная</a>
                            </li>
                        </ul>
                        
                        <table class="table table-hover mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID оприход</th>
                                    <th scope="col">Наименование</th>
                                    <th scope="col">Артикул</th>
                                    <th scope="col">Кол-во</th>
                                    <th scope="col">Цена</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                            <td>#</td>
                            
                        <td><input type="text" class="form-control" id="receipt_id" name="receipt_id" placeholder="Id оприход."></td>
           
                                <td><input type="text" class="form-control" id="name" name="name" placeholder="Наименование"></td>
                                
                                <td><input type="text" class="form-control" id="article" name="article" placeholder="Артикул"></td>
                                
                                <td><input type="text" class="form-control" id="quantity" name="quantity" placeholder="Кол-во"></td>
                                
                                <td><input type="text" class="form-control" id="price" name="price" placeholder="Цена"></td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                        </div> 
                           @csrf
                           
                        <div>
                            <button type="submit" class="btn btn-primary">Оприходовать Товар</button>
                        </div>
                    </form>
                </div>


                <div class="form-group">
                    <label for="comment">Комментарий</label>
                    <textarea class="form-control" id="comment" rows="3"></textarea>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        <strong>Итого:</strong> Кол-во: 1
                    </div>
                    <div>
                        <strong>0,00</strong>
                    </div>
                </div>
       <!--      </form> -->
        </div>
    </div>
@endsection