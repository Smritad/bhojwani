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
                  <h4>Add Project Information Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('projectinformation-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Project Information</li>
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
                        <h4>Project information Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                             
  <form action="{{ route('projectinformation-details.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    
section 1 
-take feild banner imaage with preview path stre banner image take /bhojwani/project_information/banner/
- banner heading
-description banner

section 2 
-description feild take
-iamge with review and store path used /bhojwani/project_information/project_image/


sectin 3 

-heading
-description
-image and store path used /bhojwani/project_information/project_image/
  

    <!-- Actions -->
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('projectinformation-details.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
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
        <!-- footer start-->
        @include('components.backend.footer')
        </div>
        </div>


       
       @include('components.backend.main-js')
<script>
function previewImage(event, previewId) {
    const fileInput = event.target;
    const file = fileInput.files[0];
    const preview = document.getElementById(previewId);

    if (file) {
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

        if (!allowedTypes.includes(file.type)) {
            alert("Please upload a valid image (jpg, jpeg, png, webp).");
            fileInput.value = ''; // Clear file input
            preview.style.display = 'none';
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}
</script>


</body>

</html>