<!DOCTYPE html>
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
                    <h4>Add Sky High Luxury Details Form</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('skyhighluxury-details.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Sky High Luxury Details</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Sky High Luxury Details Form</h4>
                        <p class="mt-1">Fill out your details and submit the form.</p>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('skyhighluxury-details.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Section 1: Sky High Luxury Details -->
                             
                            <div class="card mb-4">
                                <div class="card-header"><strong>Section 1: Sky High Luxury Details</strong></div>

                                <div class="card-body">
                                    <!-- Category -->
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
                                        <label class="form-label required">Heading</label>
                                        <input type="text" name="heading" class="form-control" required placeholder="Enter heading for the luxury details">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required">Description</label>
                                        <textarea name="description" id="summernote" class="form-control" rows="4" required placeholder="Enter a detailed description of the luxury"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 2: Titles & SVGs -->
                            <div class="card mb-4">
                                <div class="card-header"><strong>Section 2: Titles & SVGs</strong></div>
                                <div class="card-body">
                                    <table class="table table-bordered" id="dynamicTable">
                                        <thead>
                                            <tr>
                                                <th>SVG Image<span class="txt-danger">*</span></th>
                                                <th>Preview<span class="txt-danger">*</span></th>
                                                <th>Title<span class="txt-danger">*</span></th>
                                                <th>Action<span class="txt-danger">*</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="file" name="sections[0][svg]" accept=".svg" class="form-control svg-input" data-id="0" required>
                                                </td>
                                                <td>
                                                    <div id="preview-0"></div>
                                                </td>
                                                <td>
                                                    <input type="text" name="sections[0][title]" class="form-control" required placeholder="Enter title for this section">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary addRow">Add More</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('skyhighluxury-details.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </div>
    </div>
@include('components.backend.footer')
@include('components.backend.main-js')

<script>
    let row = 1;

    $(document).on('click', '.addRow', function () {
        let html = `<tr>
            <td>
                <input type="file" name="sections[${row}][svg]" accept=".svg" class="form-control svg-input" data-id="${row}" required>
            </td>
            <td>
                <div id="preview-${row}"></div>
            </td>
            <td>
                <input type="text" name="sections[${row}][title]" class="form-control" required placeholder="Enter title for this section">
            </td>
            <td>
                <button type="button" class="btn btn-danger removeRow">Remove</button>
            </td>
        </tr>`;
        $('#dynamicTable tbody').append(html);
        row++;
    });

    $(document).on('click', '.removeRow', function () {
        $(this).closest('tr').remove();
    });

    // SVG preview
    $(document).on('change', '.svg-input', function () {
        const file = this.files[0];
        const rowId = $(this).data('id');
        const previewContainer = $(`#preview-${rowId}`);
        previewContainer.html('');

        if (file && file.type === 'image/svg+xml') {
            const reader = new FileReader();
            reader.onload = function (e) {
                const svg = document.createElement('img');
                svg.src = e.target.result;
                svg.style.maxHeight = '60px';
                svg.style.maxWidth = '100px';
                svg.style.marginTop = '5px';
                previewContainer.append(svg);
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.html('<p class="text-danger">Invalid SVG file.</p>');
        }
    });
</script>

</body>
</html>