@php
        @endphp


@extends('layout/main')
@section('title', 'Списания')

@section('breadcrumbs')
    <div class="d-flex gap-2 mb-2">
        <a href="/dashboard" class="text-muted">Панель</a>
        <span class="text-secondary">/</span>
        <a href="dashboard/admin/receipts" class="text-muted">Списания</a>
    </div>
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="mb-3">
        <button type="submit" class="btn btn-success" id="submit-btn">Сохранить</button>
        <a href="{{route('receipts.index')}}" class="btn btn-outline-secondary">Закрыть</a>
        <a href="" method="GET" type="submit" class="btn btn-outline-secondary">Печать</a>
    </div>
    <div class="col-12 col-lg-10">
        <div class="row">
            <form>
                <div class="mb-3 row">
                    <label for="documentNumber" class="col-sm-2 col-form-label">Списание №</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="documentNumber" readonly>
                    </div>
                    <label for="date" class="col-sm-2 col-form-label">от</label>
                    <div class="col-sm-3">
                        <input type="datetime-local" class="form-control" id="date" value="{{ now()->tz('Europe/Moscow')->format('Y-m-d\TH:i') }}">
                    </div>
                    {{--                    <div class="col-sm-3">--}}
                    {{--                        <div class="form-check">--}}
                    {{--                            <input class="form-check-input" type="checkbox" id="processed">--}}
                    {{--                            <label class="form-check-label" for="processed">--}}
                    {{--                                Проведено--}}
                    {{--                            </label>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>

                <div class="mb-3 row">
                    <label for="category" class="col-sm-2 col-form-label">Склад</label>
                    <select id="category" class="form-select">
                        <option value="" disabled selected>Выберите склад...</option>
                        @foreach ($categories['stock'] as $cat)
                            <option value="{{$cat['id']}}">{{$cat['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <input id="type" type="hidden" value="0">
                </div>

                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Главная</a>
                    </li>
                </ul>

                <table class="table table-hover mt-3" id="selected-products">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Наименование</th>
                        <th scope="col">Кол-во</th>
                        <th scope="col">Остаток</th>
                        <th scope="col">Цена</th>
                        <th scope="col">Удалить</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--                        <tr>--}}
                    {{--                            <th scope="row">1</th>--}}
                    {{--                            <td class="editable">A5410110271 БОЛТ М14</td>--}}
                    {{--                            <td class="editable">1 шт</td>--}}
                    {{--                            <td class="editable">1</td>--}}
                    {{--                            <td class="editable">0</td>--}}
                    {{--                        </tr>--}}
                    </tbody>
                </table>
                <div>
                    <input type="text" id="search" placeholder="Поиск по артикулу">
                    <select id="results" size="5" class="form-select" style="display: none;"></select>
                </div>

                <div class="form-group mt-3">
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
            </form>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editableCells = document.querySelectorAll('.editable');

            editableCells.forEach(cell => {
                cell.addEventListener('mouseenter', function () {
                    const originalText = cell.innerText;
                    cell.innerHTML = `<input type="text" class="form-control" value="${originalText}">`;
                    const input = cell.querySelector('input');
                    input.focus();

                    input.addEventListener('blur', function () {
                        cell.innerText = input.value || originalText;
                    });

                    input.addEventListener('keydown', function (e) {
                        if (e.key === 'Enter') {
                            cell.innerText = input.value || originalText;
                        } else if (e.key === 'Escape') {
                            cell.innerText = originalText;
                        }
                    });
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('category');
            const dateInput = document.getElementById('date');
            const searchInput = document.getElementById('search');
            const resultsSelect = document.getElementById('results');
            const selectedProductsTable = document.getElementById('selected-products').querySelector('tbody');
            const submitBtn = document.getElementById('submit-btn');

            searchInput.addEventListener('input', function () {
                const query = searchInput.value;
                const category = categorySelect.value;

                if (query.length > 2 && category) {
                    fetch(`{{route('receipts.search')}}?article=${query}&category=${category}`)
                        .then(response => response.json())
                        .then(data => {
                            resultsSelect.innerHTML = '';
                            if (data.length > 0) {
                                data.forEach(product => {
                                    const option = document.createElement('option');
                                    option.value = JSON.stringify(product);
                                    option.textContent = product.article + ' ' + product.name + ' - кол-во ' + product.quantity;
                                    resultsSelect.appendChild(option);
                                    resultsSelect.style.display = "block";
                                });
                            } else {
                                const option = document.createElement('option');
                                option.textContent = 'Артикул не найден';
                                option.disabled = true;
                                resultsSelect.appendChild(option);
                                resultsSelect.style.display = "block";
                            }
                        });
                } else {
                    resultsSelect.innerHTML = '';
                    if (!category){
                        const option = document.createElement('option');
                        option.textContent = 'Выберите катгорию для оприходования';
                        option.disabled = true;
                        resultsSelect.appendChild(option);
                        resultsSelect.style.display = "block";
                    } else {
                        resultsSelect.style.display = "none";
                    }
                }
            });

            resultsSelect.addEventListener('change', function () {
                const selectedOption = resultsSelect.options[resultsSelect.selectedIndex];
                if (selectedOption.value) {
                    const product = JSON.parse(selectedOption.value);
                    addProductToTable(product);
                    resultsSelect.innerHTML = '';
                    searchInput.value = '';
                    resultsSelect.style.display = "none";
                }
            });

            function addProductToTable(product) {
                const index = selectedProductsTable.rows.length + 1;
                const row = document.createElement('tr');
                row.innerHTML = `
                  <td>${index}</td>
                  <td>${product.article + ' ' + product.name}</td>
                  <td><input type="number" min="1" value="1"></td>
                  <td>${product.quantity || 0}</td>
                  <td>${product.price || 0}</td>
                  <td style="display:none;">${product.id}</td>
                  <td style="display:none;">${product.article}</td>
                  <td><button class="delete-btn">Удалить</button></td>
                `;
                selectedProductsTable.appendChild(row);
                row.querySelector('.delete-btn').addEventListener('click', () => {
                    row.remove();
                    updateTableIndexes();
                });
            }

            function updateTableIndexes() {
                Array.from(selectedProductsTable.rows).forEach((row, index) => {
                    row.cells[0].textContent = index + 1;
                });
            }

            submitBtn.addEventListener('click', function() {
                const products = Array.from(selectedProductsTable.rows).map(row => {
                    const cells = row.cells;
                    return {
                        id: cells[5].textContent,
                        article: cells[6].textContent,
                        name: cells[1].textContent,
                        quantity: cells[2].querySelector('input').value,
                        // quantity: cells[3].textContent,
                        price: cells[4].textContent
                    };
                });

                const category = categorySelect.value;
                const date = dateInput.value;
                const type = document.getElementById('type').value;

                fetch('{{route('receipts.store')}}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ category, date, products, type })
                })
                    .then(response => response.json())
                    .then(data => {
                        alert('Документ сохранён');
                        window.location.href = "{{route('receipts.index')}}";
                    })
                    .catch(error => {
                        console.error('Ошибка:', error);
                    });
            });
        });
    </script>

@endsection