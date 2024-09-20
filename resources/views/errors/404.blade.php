@extends('layout/error', [
    'title' => "Ошибка",
    'errorCode' => '404',
    'text' => 'Нет такой страницы, или страница удалена.',
])
@section('title', 'Ошибка')