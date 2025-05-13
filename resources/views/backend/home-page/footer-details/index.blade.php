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
											<a href="{{ route('footer.index') }}">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">Footer</li>
									</ol>
								</nav>

								<a href="{{ route('footer.create') }}" class="btn btn-primary px-5 radius-30">+ Add Footer Details</a>
							</div>


                  
                    <div class="table-responsive custom-scrollbar">
                    <table class="display" id="basic-1">


        <thead>
            <tr>
                <th>Email</th>
                <th>Address</th>
                <th>Gmap URL</th>
                <th>Contact Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($footerDetails as $footer)
                <tr>
                    <td>{{ $footer->email }}</td>
                    <td>{{ $footer->address }}</td>
                    <td>{{ $footer->url }}</td>
                    <td>{{ $footer->contact_number }}</td>
                    <td>
                        <a href="{{ route('footer.edit', $footer->id) }}" class="btn btn-primary">Edit</a>

                        <form action="{{ route('footer.destroy', $footer->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this footer?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

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