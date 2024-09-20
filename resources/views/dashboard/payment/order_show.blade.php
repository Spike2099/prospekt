@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Детали заказа #{{ $order->order_id }}</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Контрагент:</strong> {{ $order->customer->company ?? 'Не указан' }}</p>
            <p><strong>Артикул:</strong> {{ $order->article }}</p>
            <p><strong>Наименование товара:</strong> {{ $order->name }}</p>
            <p><strong>Количество:</strong> {{ $order->quantity }}</p>
            <p><strong>Цена:</strong> {{ number_format($order->price, 2, '.', ' ') }} руб.</p>
        </div>
    </div>
    <a href="{{ route('dashboard.payment.reports') }}" class="btn btn-primary mt-3">Назад к списку заказов</a>
</div>
@endsection
