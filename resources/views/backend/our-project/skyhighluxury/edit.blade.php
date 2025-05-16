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
        .position-relative {
            display: inline-block;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    @include('components.backend.header')
    @include('components.backend.sidebar')

    <div class="page-body">
        <div class="container-fluid">

            <!-- Page Title -->
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>Edit Sky High Luxury Details</h4>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('skyhighluxury-details.index') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Sky High Luxury Details</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Sky High Luxury Details Form</h4>
                        </div>
                        <div class="card-body">

                            <!-- Form Start -->
                            <form action="{{ route('skyhighluxury-details.update', $luxury->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Section 1: Heading & Description -->
                                <div class="card mb-4">
                                    <div class="card-header"><strong>Section 1: Sky High Luxury Details</strong></div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Heading</label>
                                            <input type="text" name="heading" class="form-control" value="{{ old('heading', $luxury->heading) }}" required placeholder="Enter section heading">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" id="summernote" class="form-control" rows="4" required placeholder="Enter section description">{{ old('description', $luxury->description) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section 2: SVG Images & Titles -->
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <strong>Section 2: Titles & SVGs</strong>
                                        <button type="button" class="btn btn-primary btn-sm addRow">+ Add More</button>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered" id="dynamicTable">
                                            <thead>
                                                <tr>
                                                    <th>SVG Image</th>
                                                    <th>Preview</th>
                                                    <th>Title</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $svgImages = explode(',', $luxury->svg_images);
                                                    $titles = explode(',', $luxury->titles);
                                                @endphp

                                                @foreach($svgImages as $index => $svg)
                                                    <tr>
                                                        <td>
                                                            <input type="file" name="sections[{{ $index }}][svg]" accept=".svg" class="form-control svg-input" data-id="{{ $index }}">
                                                        </td>
                                                        <td>
                                                            <div id="preview-{{ $index }}">
                                                                <img src="{{ asset('uploads/skyhighluxury/' . $svg) }}" class="preview-img" />
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="sections[{{ $index }}][title]" class="form-control" value="{{ $titles[$index] }}" required placeholder="Enter title">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm removeRow">Remove</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('skyhighluxury-details.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>

                            </form>
                            <!-- Form End -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.backend.footer')
    @include('components.backend.main-js')

    <!-- JS for dynamic rows and preview -->
    <script>
        let row = {{ count($svgImages) }};

        $(document).on('click', '.addRow', function () {
            const newRow = `
                <tr>
                    <td>
                        <input type="file" name="sections[${row}][svg]" accept=".svg" class="form-control svg-input" data-id="${row}">
                    </td>
                    <td>
                        <div id="preview-${row}"></div>
                    </td>
                    <td>
                        <input type="text" name="sections[${row}][title]" class="form-control" required placeholder="Enter title">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm removeRow">Remove</button>
                    </td>
                </tr>`;
            $('#dynamicTable tbody').append(newRow);
            row++;
        });

        $(document).on('click', '.removeRow', function () {
            $(this).closest('tr').remove();
        });

        $(document).on('change', '.svg-input', function () {
            const file = this.files[0];
            const rowId = $(this).data('id');
            const previewContainer = $(`#preview-${rowId}`);
            previewContainer.html('');

            if (file && file.type === 'image/svg+xml') {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('preview-img');
                    previewContainer.append(img);
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.html('<p class="text-danger">Invalid SVG file.</p>');
            }
        });
    </script>

</body>
</html>
