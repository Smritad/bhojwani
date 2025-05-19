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
                        <h4>Add Map Address Form</h4>
                    </div>
                    <div class="col-6 text-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('mapaddress-details.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Add Map Address Details</li>
                        </ol>
                    </div>
                </div>
            </div>

           <form action="{{ route('mapaddress-details.store') }}" method="POST">
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
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="heading">Heading <span class="text-danger">*</span></label>
                <input type="text" name="heading" placeholder="Enter Heading" class="form-control" required value="{{ old('heading') }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="map_url">Map URL <span class="text-danger">*</span></label>
                <input type="text" name="map_url" class="form-control" placeholder="Enter Map Url" required value="{{ old('map_url') }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="site_title">Site Address <span class="text-danger">*</span></label>
                <input type="text" name="site_title" class="form-control" placeholder="Enter Site Adrress" required value="{{ old('site_title') }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="site_address">Coporate Address <span class="text-danger">*</span></label>
                <input type="text" name="site_address" class="form-control" placeholder="Enter Coporate Adrress" required value="{{ old('site_address') }}">
            </div>


            
        </div>

        <div class="text-end">
            <a href="{{ route('mapaddress-details.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

        </div>
    </div>

    @include('components.backend.footer')
    @include('components.backend.main-js')

   

</body>

</html>
