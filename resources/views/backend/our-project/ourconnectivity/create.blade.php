<!doctype html>
<html lang="en">
<head>
    @include('components.backend.head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .img-preview {
            width: 60px;
            height: 60px;
            object-fit: contain;
            border: 1px solid #ddd;
        }
        .section2-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2rem;
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
                        <h4>Add Project Connectivity Details Form</h4>
                    </div>
                    <div class="col-6 text-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('ourconnectivity-details.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Add Project Connectivity Details</li>
                        </ol>
                    </div>
                </div>
            </div>

            <form action="{{ route('ourconnectivity-details.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Section 1 -->
                <div class="mb-3">
                    <label>Project <span class="text-danger">*</span></label>
                    <select name="project_id" class="form-control" required>
                        <option value="">Choose Project Name</option> <!-- Default option -->
                        @foreach($projectid as $proj)
                            <option value="{{ $proj->id }}">{{ $proj->project_heading }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Section 1 Heading <span class="text-danger">*</span></label>
                    <input type="text" name="section1_heading" class="form-control" placeholder="Enter Section 1 Heading" required>
                </div>

                <div class="mb-3">
                    <label>Section 1 Description <span class="text-danger">*</span></label>
                    <textarea name="section1_description" class="form-control" placeholder="Enter Section 1 Description" required></textarea>
                </div>

                <!-- Section 2 -->
                <div class="section2-header">
                    <h5>Section 2 Details</h5>
                    <button type="button" onclick="addRow()" class="btn btn-sm btn-primary">+ Add Row</button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle mt-3" id="section2-table">
                        <thead class="table-light">
                            <tr>
                                <th>Heading <span class="text-danger">*</span></th>
                                <th>Upload Image <span class="text-danger">*</span></th>
                                <th>Preview</th>
                                <th>Project Titles (comma separated) <span class="text-danger">*</span></th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="row-0">
                                <td><input type="text" name="section2_headings[]" class="form-control" placeholder="Enter Section Heading" required></td>
                                <td>
                                    <input type="file" name="section2_svgs[]" accept=".svg,.jpg,.png,.webp" class="form-control image-input" onchange="previewImage(this, 0)" required>
                                </td>
                                <td class="text-center">
                                    <img src="" id="preview-0" class="img-preview" style="display: none;">
                                </td>
                                <td>
                                    <input type="text" name="section2_project_titles[0][]" class="form-control" placeholder="Enter Project Titles" required>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(0)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-12 text-end">
                    <a href="{{ route('ourconnectivity-details.index') }}" class="btn btn-secondary">Cancel</a> 
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    @include('components.backend.footer')
    @include('components.backend.main-js')

    <script>
        let rowCount = 1;

        function addRow() {
            const table = document.querySelector('#section2-table tbody');
            const index = rowCount;
            const row = document.createElement('tr');
            row.id = `row-${index}`;
            row.innerHTML = `
                <td><input type="text" name="section2_headings[]" class="form-control" placeholder="Enter Section Heading" required></td>
                <td>
                    <input type="file" name="section2_svgs[]" accept=".svg,.jpg,.png,.webp" class="form-control image-input" onchange="previewImage(this, ${index})" required>
                </td>
                <td class="text-center">
                    <img src="" id="preview-${index}" class="img-preview" style="display: none;">
                </td>
                <td><input type="text" name="section2_project_titles[${index}][]" class="form-control" placeholder="Enter Project Titles" required></td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(${index})"><i class="fa fa-trash"></i></button>
                </td>
            `;
            table.appendChild(row);
            rowCount++;
        }

        function removeRow(index) {
            const row = document.getElementById(`row-${index}`);
            if (row) row.remove();
        }

        function previewImage(input, index) {
            const file = input.files[0];
            const preview = document.getElementById(`preview-${index}`);
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
</body>
</html>
