@extends('layout/error', [
    'title' => "Ошибка",
    'errorCode' => '500',
    'text' => 'Сервер не отвечает. Пожалуйста, <a href="https://yandex.ru/business/widget/request/company/8347363005" target="_blank">напишите нам</a>, чтобы мы могли вам помочь.',
])
@section('title', 'Ошибка')