<!doctype html>
<html lang="en">

<head>
    @include('components.backend.head')
</head>

<body>

@include('components.backend.header')
@include('components.backend.sidebar')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-6">
                    <h4>Sustainability Details List</h4>
                </div>
                <div class="col-6 text-end">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('growth-sustainability-details.index') }}">
                                <svg class="stroke-icon" width="18" height="18">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Sustainability Details</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Data Table Card -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0">All Entries</h5>
                            <a href="{{ route('growth-sustainability-details.create') }}" class="btn btn-primary px-4 radius-30">
                                + Add Sustainability Details
                            </a>
                        </div>

                        <div class="table-responsive custom-scrollbar">
                            <table class="table table-bordered display" id="basic-1">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Sustainability Title</th>
                                        <th>Sustainability Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($descriptions as $index => $description)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $description->sustainability_title }}</td>
                                            <td>{{ Str::limit(strip_tags($description->sustainability_description), 100) }}</td>
                                            <td>
                                                <a href="{{ route('growth-sustainability-details.edit', $description->id) }}"
                                                   class="btn btn-sm btn-primary mb-1">
                                                    Edit
                                                </a>

                                                <form action="{{ route('growth-sustainability-details.destroy', $description->id) }}"
                                                      method="POST"
                                                      style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this item?');">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No data available.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Data Table Card -->
    </div>
</div>

@include('components.backend.footer')
@include('components.backend.main-js')

</body>

</html>
