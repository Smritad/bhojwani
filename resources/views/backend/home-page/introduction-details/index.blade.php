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
											<a href="{{ route('information-details.index') }}">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">Home Information Details</li>
									</ol>
								</nav>

								<a href="{{ route('information-details.create') }}" class="btn btn-primary px-5 radius-30">+ Add Information Details</a>
							</div>
    
       <div class="table-responsive custom-scrollbar">
    <table class="display" id="basic-1">
        <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <!-- <th>Description</th> -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($descriptions as $index => $description)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $description->title }}</td>
                        <!-- <td>{!! $description->description !!}</td> -->
                        <td>
                            <a href="{{ route('information-details.edit', $description->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <br>
                            <br>
                            <form action="{{ route('information-details.destroy', $description->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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