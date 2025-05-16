<!doctype html>
<html lang="en">

<head>
    @include('components.backend.head')
</head>

<body>
    @include('components.backend.header')

    <!--start sidebar wrapper-->  
    @include('components.backend.sidebar')
    <!--end sidebar wrapper-->

    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <!-- Add any title here if necessary -->
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">
                                    <svg class="stroke-icon">
                                        <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                    </svg>
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <nav aria-label="breadcrumb" role="navigation">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('skyhighluxury-details.index') }}">Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Project Amenities Details</li>
                                    </ol>
                                </nav>
                                <a href="{{ route('skyhighluxury-details.create') }}" class="btn btn-primary px-5 radius-30">+ Add Project Amenities Details</a>
                            </div>

                            <div class="table-responsive custom-scrollbar">
                                <table class="display" id="basic-1">
                                   <thead>
            <tr>
                <th>Heading</th>
                <th>Description</th>
                <th>SVGs</th>
                <th>Titles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($luxuries as $item)
                <tr>
                    <td>{{ $item->heading }}</td>
                    <td>{{ $item->description }}</td>
                    <td>
                        @foreach(explode(',', $item->svg_images) as $img)
                            <img src="{{ asset('uploads/skyhighluxury/' . $img) }}" style="height: 40px;">
                        @endforeach
                    </td>
                    <td>
                        <ul>
                            @foreach(explode(',', $item->titles) as $title)
                                <li>{{ $title }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <a href="{{ route('skyhighluxury-details.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form method="POST" action="{{ route('skyhighluxury-details.destroy', $item->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration Ends-->
            </div>
        </div>
        <!-- Container-fluid ends-->
    </div>

    <!-- Footer start-->
    @include('components.backend.footer')
    <!-- Footer end-->

    @include('components.backend.main-js')

</body>

</html>
