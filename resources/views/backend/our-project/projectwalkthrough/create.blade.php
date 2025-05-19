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
        .form-label.required::after {
            content: " *";
            color: red;
        }
        /* No hiding of remove button */
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
                    <h4>Add Walk Through Details Form</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('projectwalkthrough-details.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Walk Through Details</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Walk Through Details Form</h4>
                        <p class="mt-1">Fill out your details and submit the form.</p>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('projectwalkthrough-details.store') }}" method="POST" enctype="multipart/form-data">
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
                                <label class="form-label required">Background Image</label>
                                <input type="file" name="background_image" class="form-control" required>
                            </div>

                            <div class="mb-3">
    <label class="form-label required">Video URL</label>
    <input type="url" name="video_url" class="form-control" placeholder="Enter video URL (e.g. https://...)" required>
</div>


                            <hr>
                            <h4>Headings & PDFs</h4>

                            <table class="table" id="dynamicTable">
                                <thead>
                                    <tr>
                                        <th>Heading</th>
                                        <th>PDF</th>
                                        <th>
                                                <button type="button" class="btn btn-sm btn-primary addRow">Add</button>
                                            </th>                                    
                                        </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" name="headings[]" class="form-control" required></td>
                                        <td><input type="file" name="pdfs[]" class="form-control" accept="application/pdf" required></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger removeRow">Remove</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            <br><br>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('projectwalkthrough-details.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.backend.footer')
@include('components.backend.main-js')

<script>
    // Add new row with Remove button
    $(document).on('click', '.addRow', function () {
        $('#dynamicTable tbody').append(`
            <tr>
                <td><input type="text" name="headings[]" class="form-control" required></td>
                <td><input type="file" name="pdfs[]" class="form-control" accept="application/pdf" required></td>
                <td><button type="button" class="btn btn-sm btn-danger removeRow">Remove</button></td>
            </tr>
        `);
    });

    // Remove row on clicking Remove button
    $(document).on('click', '.removeRow', function () {
        $(this).closest('tr').remove();
    });
</script>

</body>
</html>
