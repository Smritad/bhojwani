<?php
namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use App\Models\TestimonialsDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialsDetailsController extends Controller
{
    public function index()
    {
        $testimonials = TestimonialsDetails::all();
        return view('backend.home-page.testimonials-details.index', compact('testimonials'));
    }

    public function create()
    {
        return view('backend.home-page.testimonials-details.create');
    }

    public function store(Request $request)
    {
        foreach ($request->testimonials as $testimonial) {
            TestimonialsDetails::create([
                'title' => $testimonial['title'],
                'description' => $testimonial['description'],
                'person_name' => $testimonial['person_name'],
                'designation' => $testimonial['designation'],
                'rating' => $testimonial['rating'],
                'token_name' => $testimonial['token_name'],
                'created_by' => Auth::id(),
            ]);
        }

        return redirect()->route('testimonials-details.index')->with('message', 'Testimonials added successfully!');
    }

    public function edit($id)
    {
        $testimonial = TestimonialsDetails::findOrFail($id);
        return view('backend.home-page.testimonials-details.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = TestimonialsDetails::findOrFail($id);

        $testimonial->update([
            'title' => $request->title,
            'description' => $request->description,
            'person_name' => $request->person_name,
            'designation' => $request->designation,
            'rating' => $request->rating,
            'token_name' => $request->token_name,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('testimonials-details.index')->with('message', 'Testimonial updated successfully!');
    }

    public function destroy($id)
    {
        $testimonial = TestimonialsDetails::findOrFail($id);
        $testimonial->update(['deleted_by' => Auth::id()]);
        $testimonial->delete();

        return redirect()->route('testimonials-details.index')->with('message', 'Testimonial deleted successfully!');
    }
}
