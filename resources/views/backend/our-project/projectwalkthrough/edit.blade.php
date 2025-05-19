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
                        <h4>Edit Walk Through Details</h4>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('skyhighluxury-details.index') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Walk Through Details</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> Details Walk Through</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('projectwalkthrough-details.update', $walkthrough->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
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
                                {{-- Background image --}}
                                <div class="mb-3">
                                    <label class="form-label">Current Background</label><br>
                                    @if($walkthrough->background_image)
                                        <img src="{{ asset('uploads/projectwalkthrough/'.$walkthrough->background_image) }}" class="preview-img" alt="Background Image">
                                    @endif
                                    <input type="file" name="background_image" class="form-control mt-2" accept="image/*">
                                </div>

                                {{-- Video (file or YouTube URL) --}}
                                <div class="mb-3">
                                    <label class="form-label">Current Video</label><br>
                                    @if(Str::startsWith($walkthrough->video, 'http'))
                                        <a href="{{ $walkthrough->video }}" target="_blank">{{ $walkthrough->video }}</a>
                                    @else
                                        <video width="150" controls>
                                            <source src="{{ asset('uploads/projectwalkthrough/'.$walkthrough->video) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @endif
                                    <input type="file" name="video" class="form-control mt-2" accept="video/*">
                                    <small class="text-muted">—or— paste YouTube URL</small>
                                    <input type="text" name="video_url" class="form-control mt-1" placeholder="https://youtu.be/..." value="{{ Str::startsWith($walkthrough->video,'http') ? $walkthrough->video : '' }}">
                                </div>

                                {{-- Headings & PDFs --}}
                                <h5>Headings & PDFs</h5>
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
                                        @php
                                            $headings = explode(',', $walkthrough->headings);
                                            $pdfs = explode(',', $walkthrough->pdfs);
                                        @endphp
                                        @foreach($headings as $i => $head)
                                            <tr>
                                                <td>
                                                    <input type="text" name="headings[]" class="form-control" value="{{ $head }}">
                                                </td>
                                                <td>
                                                    @php $pdf = $pdfs[$i] ?? null; @endphp
                                                    @if($pdf)
                                                        <a href="{{ asset('uploads/projectwalkthrough/'.$pdf) }}" target="_blank">Current PDF</a><br>
                                                    @endif
                                                    <input type="file" name="pdfs[{{ $i }}]" class="form-control mt-2" accept="application/pdf">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger removeRow">Remove</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
<br>
<br>
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('projectwalkthrough-details.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div> <!-- card-body -->
                    </div> <!-- card -->
                </div> <!-- col-md-12 -->
            </div> <!-- row -->

        </div> <!-- container-fluid -->
    </div> <!-- page-body -->

    @include('components.backend.footer')
    @include('components.backend.main-js')

    <script>
        $(document).on('click', '.addRow', function() {
            $('#dynamicTable tbody').append(`
                <tr>
                    <td><input type="text" name="headings[]" class="form-control"></td>
                    <td><input type="file" name="pdfs[]" class="form-control" accept="application/pdf"></td>
                    <td><button type="button" class="btn btn-sm btn-danger removeRow">Remove</button></td>
                </tr>
            `);
        });

        $(document).on('click', '.removeRow', function() {
            $(this).closest('tr').remove();
        });
    </script>
</body>
</html>
