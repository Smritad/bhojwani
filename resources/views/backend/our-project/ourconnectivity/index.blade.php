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
											<a href="{{ route('ourconnectivity-details.index') }}">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">Project Connectivity Details</li>
									</ol>
								</nav>

								<a href="{{ route('ourconnectivity-details.create') }}" class="btn btn-primary px-5 radius-30">+ Add Project Connectivity Details</a>
							</div>


                    <div class="table-responsive custom-scrollbar">
                    <table class="display" id="basic-1">
  
        <thead>
            <tr>                <th>#</th>

                <th>Heading</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($connectivities as $key => $item)
                <tr>
                  <td>{{ $key + 1}}</td>
                    <td>{{ $item->section1_heading }}</td>
                    <td>{{ Str::limit($item->section1_description, 100) }}</td>
                    <td>
                        <a href="{{ route('ourconnectivity-details.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <br>   <br>
                        <form action="{{ route('ourconnectivity-details.destroy', $item->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure?')">
                              @csrf @method('DELETE')
                              <button class="btn btn-danger btn-sm">Delete</button>
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
        </div>
            <!-- footer start-->
             @include('components.backend.footer')
      </div>
    </div>

        @include('components.backend.main-js')

</body>

</html>