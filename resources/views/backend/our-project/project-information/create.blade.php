<!doctype html>
<html lang="en">
<head>
    @include('components.backend.head')
    <style>
        .preview-img {
            max-height: 100px;
            margin-top: 10px;
            border: 1px solid #ccc;
            padding: 4px;
            border-radius: 4px;
        }
        .delete-img {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            border-radius: 50%;
            cursor: pointer;
            padding: 2px 6px;
        }
        .position-relative { display: inline-block; margin-right: 10px; }
        .form-label.required::after {
            content: " *";
            color: red;
        }
    </style>
</head>
<body>

@include('components.backend.header')
@include('components.backend.sidebar')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Add Project Information Form</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('projectinformation-details.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Project Information</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Project Information Form</h4>
                        <p class="mt-1">Fill out your details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('projectinformation-details.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Banner Section -->
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">Banner Information</div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="banner_image" class="form-label required">Banner Images</label>
                                        <input type="file" class="form-control" placeholder="Choose Multiple Image" id="banner_image" name="banner_image[]" multiple required>
                                        <div id="preview-container" class="d-flex flex-wrap gap-2 mt-2"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label required">Banner Heading</label>
                                        <input type="text" class="form-control" name="banner_heading" placeholder="Enter banner heading" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label required">Banner Description</label>
                                        <textarea class="form-control" name="banner_description" rows="4" placeholder="Enter banner description" required></textarea>
                                    </div>
                                </div>
                            </div>
<!-- Project Category -->
    <div class="mb-3 col-xxl-4 col-sm-12">
        <label class="form-label" for="category_id">Project Category <span class="txt-danger">*</span></label>
        <select name="category_id" id="category_id" class="form-control" required>
            <option value="">Select Category</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->project_heading}}</option>
            @endforeach
        </select>
    </div>
                            <!-- Description Section -->
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">Description Section</div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="description_image" class="form-label required">Description Image</label>
                                        <input type="file" class="form-control" id="description_image" name="description_image" required>
                                        <img id="description-preview" class="preview-img d-block" style="display: none;">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label required">Description</label>
                                        <textarea class="form-control" name="description" id="summernote" rows="4" placeholder="Enter project description" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- More Content Section -->
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">Additional Information </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="heading" class="form-label required">Additional Heading</label>
                                        <input type="text" class="form-control" name="heading" placeholder="Enter additional heading" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="more_description" class="form-label required">Additional Description</label>
                                        <textarea class="form-control" name="more_description" id="summernote1" rows="4" placeholder="Enter additional description" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="more_image" class="form-label required">More Image</label>
                                        <input type="file" class="form-control" id="more_image" name="more_image" required>
                                        <img id="more-preview" class="preview-img d-block" style="display: none;">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('projectinformation-details.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div> <!-- card-body -->
            </div>
        </div>
    </div>
</div>

@include('components.backend.footer')
@include('components.backend.main-js')

<script>
    const bannerInput = document.getElementById('banner_image');
    const previewContainer = document.getElementById('preview-container');

    bannerInput.addEventListener('change', function () {
        previewContainer.innerHTML = '';
        Array.from(this.files).forEach((file) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const wrapper = document.createElement('div');
                wrapper.className = 'position-relative';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'rounded border';
                img.style = "width: 100px; height: 100px; object-fit: cover;";

                const removeBtn = document.createElement('span');
                removeBtn.innerHTML = '&times;';
                removeBtn.className = 'delete-img';
                removeBtn.onclick = () => wrapper.remove();

                wrapper.appendChild(img);
                wrapper.appendChild(removeBtn);
                previewContainer.appendChild(wrapper);
            };
            reader.readAsDataURL(file);
        });
    });

    // Single image preview
    document.getElementById('description_image').addEventListener('change', function () {
        const preview = document.getElementById('description-preview');
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('more_image').addEventListener('change', function () {
        const preview = document.getElementById('more-preview');
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
<script>
  $(document).ready(function() {
    $('#summernote1').summernote({
      height: 200, // Adjust height as needed
      focus: true   // Focus the editor when initialized
    });
  });
</script>
</body>
</html>
