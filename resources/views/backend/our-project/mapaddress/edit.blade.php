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
                    <h4>{{ isset($mapAddress) ? 'Edit Address Details' : 'Add Address Details' }}</h4>
                </div>
                <div class="col-6 text-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('mapaddress-details.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ isset($mapAddress) ? 'Edit' : 'Add' }} Address</li>
                    </ol>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ isset($mapAddress) ? route('mapaddress-details.update', $mapAddress->id) : route('mapaddress-details.store') }}">
            @csrf
            @if(isset($mapAddress))
                @method('PUT')
            @endif

            <div class="row">
                @php
                    $fields = [
                        'heading', 'map_url', 'site_title', 'site_address'
                    ];
                @endphp
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
                @foreach ($fields as $field)
                    <div class="col-md-6 mb-3">
                        <label for="{{ $field }}">{{ ucwords(str_replace('_', ' ', $field)) }} <span class="text-danger">*</span></label>
                        <input type="text" name="{{ $field }}" class="form-control" value="{{ old($field, $mapAddress->$field ?? '') }}" required>
                    </div>
                @endforeach
            </div>

            <div class="text-end">
                <a href="{{ route('mapaddress-details.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">{{ isset($mapAddress) ? 'Update' : 'Submit' }}</button>
            </div>
        </form>
    </div>
</div>

@include('components.backend.footer')
@include('components.backend.main-js')

</body>
</html>
