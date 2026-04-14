<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class UserCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount(['books' => function($query) {
            $query->where('status', 'aktif');
        }])
        ->where('is_active', true)
        ->orderBy('nama')
        ->get();

        return view('user.category.index', compact('categories'));
    }
}
