<!doctype html>
<html lang="en">
    
<head>
    @include('components.backend.head')
</head>
	   
		@include('components.backend.header')

	    <!--start sidebar wrapper-->	
	    @include('components.backend.sidebar')
	   <!--end sidebar wrapper-->

    
     <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
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
											<a href="{{ route('ourproject-details.index') }}">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">Project Details</li>
									</ol>
								</nav>

								<a href="{{ route('ourproject-details.create') }}" class="btn btn-primary px-5 radius-30">+ Add Project Category Details</a>
							</div>


                    <div class="table-responsive custom-scrollbar">
                    <table class="display" id="basic-1">
                     
    <thead>
        <tr>
            <th>#</th>
            <th>Banner</th>
            <th>Category</th>
            <th>Project Heading</th>
            <th>Title</th>
            <th>Location</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $key => $project)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td><img src="{{ asset('uploads/project/' . $project->banner_image) }}" width="80"></td>
                <td>{{ $project->category->category_name ?? '' }}</td>
                <td>{{ $project->project_heading }}</td>
                <td>{{ $project->title }}</td>
                <td>{{ $project->location }}</td>
                <td>
                    <a href="{{ route('ourproject-details.edit', $project->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('ourproject-details.destroy', $project->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this project?')">Delete</button>
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
            </div>
          </div>
        </div>
            <!-- footer start-->
             @include('components.backend.footer')
      </div>
    </div>

        @include('components.backend.main-js')

</body>

</html>