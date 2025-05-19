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
                                            <a href="{{ route('projectwalkthrough-details.index') }}">Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Project Walk Through Details</li>
                                    </ol>
                                </nav>
                                <a href="{{ route('projectwalkthrough-details.create') }}" class="btn btn-primary px-5 radius-30">+ Project Walk ThroughDetails</a>
                            </div>

                            <div class="table-responsive custom-scrollbar">
                                <table class="display" id="basic-1">
                                 <thead>
        <tr>
          <th>#</th><th>Background</th>
          <th>Video</th>
          <!--  <th>Headings</th> -->
          <!-- <th>PDFs</th> --> 
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      @foreach($walkthroughs as $index => $walk)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>
            @if($walk->background_image)
              <img src="{{ asset('uploads/projectwalkthrough/'.$walk->background_image) }}" width="80">
            @endif
          </td>
          <td>
            @if(Str::startsWith($walk->video,'http'))
              <a href="{{ $walk->video }}" target="_blank">YouTube</a>
            @else
              <video width="80" controls>
                <source src="{{ asset('uploads/projectwalkthrough/'.$walk->video) }}">
              </video>
            @endif
          </td>
          <!-- <td> -->
            <!-- @foreach(explode(',', $walk->headings) as $h) <span class="d-block">{{ $h }}</span> @endforeach -->
          <!-- </td> -->
          <!-- <td> -->
            <!-- @foreach(explode(',', $walk->pdfs) as $pdf) -->
              <!-- <a href="{{ asset('uploads/projectwalkthrough/'.$pdf) }}" target="_blank">PDF</a><br> -->
            <!-- @endforeach -->
          <!-- </td> -->
          <td>
            <a href="{{ route('projectwalkthrough-details.edit',$walk->id) }}" class="btn btn-sm btn-primary">Edit</a>
            <form action="{{ route('projectwalkthrough-details.destroy',$walk->id) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
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
