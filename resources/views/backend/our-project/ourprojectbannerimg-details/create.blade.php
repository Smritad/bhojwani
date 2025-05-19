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
                  <h4>Add Our project Banner Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('ourprojectbannerimg-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Our project Banner Details</li>
                </ol>

                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>Our project Banner Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                             
   


   

    <form action="{{ route('ourprojectbannerimg-details.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="banner_heading">Banner Heading<span class="txt-danger">*</span></label>
            <input type="text" name="banner_heading" id="banner_heading" placeholder="Enter Banner Heading" class="form-control" value="{{ old('banner_heading') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="banner_image">Banner Image<span class="txt-danger">*</span></label>
            <input type="file" name="banner_image" id="banner_image" placeholder="Choose BannerImage" class="form-control" accept="image/*" required onchange="previewImage(event)">
            <img id="preview" src="#" style="max-height: 150px; margin-top: 10px; display: none;">
        </div>
                                    <div class="col-12 text-end">

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('ourprojectbannerimg-details.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>





                                </div>
                            </div>
                            </div>
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

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    preview.style.display = 'block';
    preview.src = URL.createObjectURL(event.target.files[0]);
}
</script>

</body>

</html>