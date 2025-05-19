<!doctype html>
<html lang="en">
<head>
    @include('components.backend.head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .project-group { margin-bottom: 0.5rem; }
        .project-label { font-weight: 600; }
    </style>
</head>
<body>
@include('components.backend.header')
@include('components.backend.sidebar')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-6">
                    <h4>Edit Gallery Image</h4>
                </div>
                <div class="col-6 text-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('galleryimage-details.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Gallery Image</li>
                    </ol>
                </div>
            </div>
        </div>



    <form action="{{ route('galleryimage-details.update', $galleryImage->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
<!-- Category -->
    <div class="mb-3">
    <label>project Name<span class="txt-danger">*</span></label>
    <select name="project_id" class="form-control" required>
        @foreach($projectid as $cat)
            <option value="{{ $cat->id }}" {{ $cat->project_id == $cat->id ? 'selected' : '' }}>
                {{ $cat->project_heading }}
            </option>
        @endforeach
    </select>
</div>
        <div class="mb-3">
            <label>Heading</label>
            <input type="text" name="section1_heading" class="form-control" value="{{ $galleryImage->section1_heading }}" required>
        </div>

       <div class="mb-3">
    <label>Existing Images</label><br>
    @foreach($images as $img)
        <div class="d-inline-block position-relative me-2 mb-2" style="width: 70px; height: 70px;">
            <img src="{{ asset('uploads/gallery/' . $img) }}" height="60" style="border:1px solid #ccc; border-radius:4px;" />
            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 p-0" 
                style="width: 20px; height: 20px; line-height: 18px; font-size: 14px; border-radius: 50%;"
                onclick="removeImage(this)">
                &times;
            </button>
            <input type="hidden" name="existing_images[]" value="{{ $img }}">
        </div>
    @endforeach
</div>

        <div class="mb-3">
            <label>Add More Images</label>
            <input type="file" name="gallery_images[]" multiple class="form-control">
        </div>
       <div class="col-12 text-end">

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('galleryimage-details.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

    </div>
</div>

@include('components.backend.footer')
@include('components.backend.main-js')

<script>
function removeImage(btn) {
    // Find the parent div containing the image and hidden input
    const container = btn.parentElement;

    // Remove the container div from DOM
    container.remove();
}
</script>

</body>
</html>
