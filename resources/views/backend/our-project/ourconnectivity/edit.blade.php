<!doctype html>
<html lang="en">
<head>
    @include('components.backend.head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .table td, .table th { vertical-align: middle; }
        .img-preview { max-width: 60px; max-height: 60px; object-fit: contain; }
        .section2-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
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
                    <h4>Edit Project Connectivity Details</h4>
                </div>
                <div class="col-6 text-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('ourconnectivity-details.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Project Connectivity Details</li>
                    </ol>
                </div>
            </div>
        </div>

        <form action="{{ route('ourconnectivity-details.update', $connectivityDetail->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Section 1 -->
            <div class="mb-3">
                <label>Project</label>
                <select name="project_id" class="form-control" required>
                    @foreach($projectid as $proj)
                        <option value="{{ $proj->id }}" {{ $proj->id == $connectivityDetail->project_id ? 'selected' : '' }}>
                            {{ $proj->project_heading }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Section 1 Heading</label>
                <input type="text" name="section1_heading" value="{{ $connectivityDetail->section1_heading }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Section 1 Description</label>
                <textarea name="section1_description" class="form-control" required>{{ $connectivityDetail->section1_description }}</textarea>
            </div>

            <!-- Section 2 -->
            <div class="section2-header">
                <h5>Section 2 Details</h5>
                <button type="button" onclick="addRow()" class="btn btn-sm btn-primary">+ Add Row</button>
            </div>
<br>
            <div class="table-responsive">
                <table class="table table-bordered align-middle" id="section2-table">
                    <thead class="table-light">
                        <tr>
                            <th>Heading</th>
                            <th>Image</th>
                            <th>Preview</th>
                            <th>Project Titles (comma separated)</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($section2['headings'] as $index => $heading)
                            <tr id="row-{{ $index }}">
                                <td>
                                    <input type="text" name="section2_headings[]" value="{{ $heading }}" class="form-control" required>
                                </td>
                                <td>
                                    <input type="file" name="section2_svgs[{{ $index }}]" accept=".svg,.jpg,.png,.webp" class="form-control">
                                    <input type="hidden" name="section2_existing_svgs[{{ $index }}]" value="{{ $section2['svgs'][$index] }}">
                                </td>
                                <td>
                                    @if($section2['svgs'][$index])
                                        <img src="{{ asset('uploads/connectivity/' . $section2['svgs'][$index]) }}" alt="preview" class="img-preview">
                                    @endif
                                </td>
                                <td>
                                    <input type="text" name="section2_project_titles[{{ $index }}][]" value="{{ implode(',', $section2['titles'][$index]) }}" class="form-control" required>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger" onclick="removeRow({{ $index }})"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
<br>
          <div class="col-12 text-end">
            <a href="{{ route('ourconnectivity-details.index') }}" class="btn btn-secondary">Cancel</a> 
                           <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

@include('components.backend.footer')
@include('components.backend.main-js')

<script>
    let rowCount = {{ count($section2['headings']) }};

    function addRow() {
        const table = document.querySelector('#section2-table tbody');
        const row = document.createElement('tr');
        row.id = `row-${rowCount}`;
        row.innerHTML = `
            <td><input type="text" name="section2_headings[]" class="form-control" required></td>
            <td>
                <input type="file" name="section2_svgs[${rowCount}]" accept=".svg,.jpg,.png,.webp" class="form-control">
                <input type="hidden" name="section2_existing_svgs[${rowCount}]" value="">
            </td>
            <td></td>
            <td><input type="text" name="section2_project_titles[${rowCount}][]" class="form-control" required></td>
            <td class="text-center"><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(${rowCount})"><i class="fa fa-trash"></i></button></td>
        `;
        table.appendChild(row);
        rowCount++;
    }

    function removeRow(index) {
        const row = document.getElementById(`row-${index}`);
        if (row) row.remove();
    }
</script>
</body>
</html>
