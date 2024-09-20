@php
@endphp


@extends('layout/main')
@section('title', 'Учёт Складов')

@section('breadcrumbs')
    <div class="d-flex gap-2 mb-2">
        <a href="/dashboard" class="text-muted">Панель</a>
        <span class="text-secondary">/</span>
        <span class="text-muted">Учёт Складов</span>
    </div>
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="col-12 col-lg-6">
        <div class="row">
            <div class="col-lg-12">
                <div class="container">
                    <form action="{{ route('receipts.create') }}" method="GET">
                        <button type="submit" class="btn btn-primary">Оприходование +</button>
                    </form>
                    
                    <form action="{{ route('receipts.losspage') }}" method="GET">
                        <button type="submit" class="btn btn-primary">Списания +</button>
                    </form>
                    
                    <div class="mt-4">
                        {{ $receipts->links('pagination::bootstrap-5') }}
                    </div>
                    
                    <!-- Таблица существующих товаров -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Время</th>
                            <th>Склад</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($receipts as $receipt)
                            <tr>
                                <td>{{ $receipt->id }}</td>
                                <td>{{ $receipt->creation_date }}</td>
                                <td>{{ $receipt->stock_category_id }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div>
            {{ $receipts->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection