<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('jobPosts')->orderBy('name')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|max:100']);
        Category::create(['name' => $data['name'], 'slug' => Str::slug($data['name'])]);

        return back()->with('success', 'Đã thêm danh mục.');
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate(['name' => 'required|max:100']);
        $category->update(['name' => $data['name'], 'slug' => Str::slug($data['name'])]);

        return back()->with('success', 'Đã sửa danh mục.');
    }

    public function destroy(Category $category)
    {
        if (JobPost::where('category_id', $category->id)->exists()) {
            return back()->withErrors('Danh mục đang có tin tuyển dụng, không thể xóa.');
        }
        $category->delete();

        return back()->with('success', 'Đã xóa danh mục.');
    }
}