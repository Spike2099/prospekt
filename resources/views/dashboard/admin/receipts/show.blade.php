@php
@endphp


@extends('layouts.dashboard')
@section('title', 'Оприходованные товара со склада')

@section('breadcrumbs')
    <div class="d-flex gap-2 mb-2">
        <a href="/dashboard" class="text-muted">Панель</a>
        <span class="text-secondary">/</span>
        <a href="dashboard/admin/receipts" class="text-muted">Оприходованный склад</a>
    </div>
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <div class="container">
        <h1>Receipt #{{ $receipt->id }}</h1>
        <p>Склад: {{ $receipt->category->name }}</p>
        <p>Дата создания: {{ $receipt->creation_date }}</p>
        <h2>Items</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Article</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Склад</th>
                </tr>
            </thead>
            <tbody>
                @foreach($receipt->items as $item)
                    <tr>
                        <td>{{ $item->article }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->stock->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection