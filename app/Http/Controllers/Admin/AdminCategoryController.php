<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventCategory;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
  public function index()
  {
    $categories = EventCategory::all();
    return view('admin.categories.index', compact('categories'));
  }

  public function store(Request $request)
  {
    $request->validate(['name' => 'required|string|max:50|unique:event_categories']);
    EventCategory::create(['name' => $request->name]);
    return back()->with('success', 'Category created.');
  }

  public function destroy(EventCategory $category)
  {
    $category->delete();
    return back()->with('success', 'Category deleted.');
  }
}
