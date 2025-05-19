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
											<a href="{{ route('galleryimage-details.index') }}">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">Gallery Images</li>
									</ol>
								</nav>

								<a href="{{ route('galleryimage-details.create') }}" class="btn btn-primary px-5 radius-30">+ Add Gallery Images</a>
							</div>


                    <div class="table-responsive custom-scrollbar">
                    <table class="display" id="basic-1">
          <thead>
            <tr>
                <th>Heading</th>
                <th>Images</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($galleryImages as $item)
                <tr>
                    <td>{{ $item->section1_heading }}</td>
                    <td>
                        @foreach(explode(',', $item->images) as $img)
                            <img src="{{ asset('uploads/gallery/' . $img) }}" height="50" width="50" class="me-1" />
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('galleryimage-details.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('galleryimage-details.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this entry?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
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