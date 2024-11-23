<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function show($id)
    {
    $category = Category::findOrFail($id);
    $videos = Video::where('id', $id)->get(); // Assuming you have a 'videos' relationship defined in the Category model

    return view('category.show', compact('category', 'videos'));
    }


    /**
     * Show all categories for the dropdown.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
    
        // Fetch all categories
        $categories = Category::all();

        // Pass the categories to the view
        return view('home', compact('categories'));
    }

    
    /**
     * Filter videos by category.
     *
     * @param  int  $categoryId
     * @return \Illuminate\View\View
     */
    public function filterByCategory($categoryId)
    {
        // Find the category by ID
        $category = Category::findOrFail($categoryId);

        // Assuming 'tags' is a column on the 'videos' table, you can filter by tags
        $videos = Video::where('tags', 'like', '%' . $category->name . '%')->get();

        // Pass the videos and category to the view
        return view('video.index', compact('videos', 'category'));
    }
}
