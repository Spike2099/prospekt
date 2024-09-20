<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreErrorCodeRequest;
use App\Http\Requests\UpdateErrorCodeRequest;
use App\Models\ErrorCode;
use App\Models\ErrorCodeCategory;

class ErrorCodeController extends Controller
{
    public function showErrorsByCategory($categoryId)
    {
        // Получаем список ошибок по выбранной категории
        $errors = ErrorCode::where('error_codes_category_id', $categoryId)->get();
        // Получаем список всех категорий
        $categories = ErrorCodeCategory::all();

        // Передаем данные в представление
        return view('errorcode', [
            'errorCodes' => $errors,
            'categories' => $categories
        ]);
    }
    
    public function showErrorsByNameCategory($categoryName)
    {
        // Получаем список ошибок по выбранной категории
        $errors = ErrorCode::where('error_code_categories;', $categoryName)->get();
        // Получаем список всех категорий
        $categories = ErrorCodeCategory::all();

        // Передаем данные в представление
        return view('errorcode', [
            'errorCodes' => $errors,
            'categories' => $categories
        ]);
    }

    public function showAllErrors()
    {
        // Передаем данные в представление
        return view('errorcode', [
            'errorCodesCategories' => ErrorCodeCategory::with('errorCodes')->get()
        ]);
    }

    public function showPageErrors($code)
    {
        $errorCode = ErrorCode::where('code', $code)->firstOrFail();
        //вот тут надо ссылаться на отображение кода и описания по идеи
        return view('showerror', compact('errorCode'));
    }
    
    public function dashboardAllErrors()
    {
        return view('dashboard.dashboardErrorcode', [
            'dashboarderrorCodesCategories' => ErrorCodeCategory::with('errorCodes')->get()
        ]);
    } 
    
}
