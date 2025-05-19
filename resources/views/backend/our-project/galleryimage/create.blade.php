<!doctype html>
<html lang="en">

<head>
    @include('components.backend.head')
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        /* To keep the project fields aligned nicely */
        .project-group {
            margin-bottom: 0.5rem;
        }

        .project-label {
            font-weight: 600;
        }

        /* Image preview styling */
        #imagePreviewContainer {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .img-preview-wrapper {
            position: relative;
            width: 100px;
            height: 100px;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }

        .img-preview-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .remove-image-btn {
            position: absolute;
            top: 2px;
            right: 2px;
            background: rgba(255, 0, 0, 0.8);
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            cursor: pointer;
            line-height: 18px;
            font-size: 14px;
            text-align: center;
        }
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
                        <h4>Add Gallery Image Details Form</h4>
                    </div>
                    <div class="col-6 text-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('galleryimage-details.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Add Gallery Image Details</li>
                        </ol>
                    </div>
                </div>
            </div>

            <form action="{{ route('galleryimage-details.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
<div class="mb-3">
    <label>Project Name <span class="txt-danger">*</span></label>
    <select name="project_id" class="form-control" required>
        <option value="">Select Project Name</option> <!-- Default option -->

        @foreach($projectid as $cat)
            <option value="{{ $cat->id }}" 
                {{ old('project_id', isset($selectedProjectId) ? $selectedProjectId : '') == $cat->id ? 'selected' : '' }}>
                {{ $cat->project_heading }}
            </option>
        @endforeach
    </select>
</div>

                <div class="mb-3">
                    <label>Heading <span class="text-danger">*</span></label>
                    <input type="text" name="section1_heading" class="form-control" placeholder="Enter main heading" required>
                </div>

                <div class="mb-3">
                    <label>Gallery Images <span class="text-danger">*</span></label>
                    <input id="gallery_images" type="file" name="gallery_images[]" class="form-control" multiple accept=".jpg, .jpeg, .png, .webp" required onchange="previewImages(event)">
                    <small class="text-muted d-block mt-1">Allowed types: jpg, jpeg, png, webp. Max size: 2MB each.</small>

                    <!-- Preview container -->
                    <div id="imagePreviewContainer"></div>
                </div>

                <div class="text-end">
                    <a href="{{ route('galleryimage-details.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>

    @include('components.backend.footer')
    @include('components.backend.main-js')

    <script>
        function previewImages(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('imagePreviewContainer');
            previewContainer.innerHTML = ''; // clear previous previews

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (!file.type.match('image.*')) {
                    continue;
                }

                const reader = new FileReader();
                reader.onload = function (e) {
                    // Create preview wrapper div
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('img-preview-wrapper');

                    // Create image element
                    const img = document.createElement('img');
                    img.src = e.target.result;

                    // Create remove button
                    const btn = document.createElement('button');
                    btn.innerHTML = '&times;';
                    btn.classList.add('remove-image-btn');
                    btn.type = 'button';

                    btn.onclick = function () {
                        removeImage(i);
                    };

                    wrapper.appendChild(img);
                    wrapper.appendChild(btn);
                    previewContainer.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            }
        }

        function removeImage(index) {
            const input = document.getElementById('gallery_images');
            const dt = new DataTransfer();

            const { files } = input;

            for (let i = 0; i < files.length; i++) {
                if (i !== index) {
                    dt.items.add(files[i]); // add all files except the removed one
                }
            }

            input.files = dt.files; // update input files

            // Refresh previews
            const event = new Event('change');
            input.dispatchEvent(event);
        }
    </script>

</body>

</html>
