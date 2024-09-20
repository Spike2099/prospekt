@extends('layout/main')
@section('title', 'Товары')

@section('breadcrumbs')
    <div class="d-flex gap-2 mb-2">
        <a href="/dashboard" class="text-muted">Панель</a>
        <span class="text-secondary">/</span>
        <span class="text-muted">Товары</span>
    </div>
@endsection


@section('content')
 <div class="col-12 col-lg-6">
        <div class="row">
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-header">Выгрузка складов Актуальных Цен и Аналогов</div>
                    <div class="card-body">
                        <form action="{{ route('stockexport') }}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-primary">Выгрузить в Excel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection