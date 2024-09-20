@extends('layout/error', [
    'title' => "Ошибка",
    'errorCode' => '400',
    'text' => 'Плохой запрос. Либо отсутствует токен.',
])
@section('title', 'Ошибка')