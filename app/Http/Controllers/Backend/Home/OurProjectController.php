<?php

namespace App\Http\Controllers\Backend\Home;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\OurProjectCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class OurProjectController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        // Fetch all project categories
        $categories = OurProjectCategory::all();

        // Return the view with categories data
        return view('backend.our-project.mastercategory-project.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('backend.our-project.mastercategory-project.create');
    }

    /**
     * Store a newly created category in the database.
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        // Generate slug from category name
        $slug = Str::slug($request->category_name, '-');

        // Store the new category with the slug and created_by
        OurProjectCategory::create([
            'category_name' => $request->category_name,
            'slug' => $slug, // Store the slug in the database
            'created_by' => Auth::id(), // Store the ID of the user creating the category
        ]);

        // Redirect back with success message
        return redirect()->route('ourprojectcategory-details.index')->with('message', 'Product Category added successfully!');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit($id)
    {
        // Find the category by ID
        $category = OurProjectCategory::findOrFail($id);

        // Return the edit view with category data
        return view('backend.our-project.mastercategory-project.edit', compact('category'));
    }

    /**
     * Update the specified category in the database.
     */
    public function update(Request $request, $id)
    {
        // Validate incoming data
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        // Generate slug from category name
        $slug = Str::slug($request->category_name, '-');

        // Find the category by ID
        $category = OurProjectCategory::findOrFail($id);

        // Update the category with new name, slug, and updated_by
        $category->update([
            'category_name' => $request->category_name,
            'slug' => $slug,
            'updated_by' => Auth::id(), // Store the ID of the user updating the category
        ]);

        // Redirect back with success message
        return redirect()->route('ourprojectcategory-details.index')->with('message', 'Product Category updated successfully!');
    }

    /**
     * Mark the specified category as deleted (soft delete).
     */
    public function destroy($id)
    {
        // Find the category by ID
        $category = OurProjectCategory::findOrFail($id);

        // Update the category to mark it as deleted with deleted_by and deleted_at
        $category->update([
            'deleted_by' => Auth::id(), // Store the ID of the user deleting the category
            'deleted_at' => Carbon::now(), // Store the current timestamp as deleted_at
        ]);

        // Return redirect with success message
        return redirect()->route('ourprojectcategory-details.index')
            ->with('message', 'Product Category marked as deleted successfully!');
    }
}
