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
                  <h4>Add Project Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('ourproject-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add Project Details</li>
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
                        <h4>Project Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                             
  <form action="{{ route('ourproject-details.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Banner Image Upload -->
    <div class="mb-3 col-xxl-4 col-sm-12">
        <label class="form-label" for="banner_image">Banner Image <span class="txt-danger">*</span></label>
        <input class="form-control" id="banner_image" type="file" name="banner_image" accept=".jpg, .jpeg, .png, .webp" required onchange="previewImage(event, 'banner_image_preview')">
        <div class="invalid-feedback">Please upload a Banner Image.</div>
        <small class="text-secondary"><b>Max 2MB. Formats: .jpg, .jpeg, .png, .webp</b></small>
        <div id="bannerImagePreviewContainer" class="mt-2">
            <img id="banner_image_preview" src="#" alt="Banner Image Preview" style="display:none; max-height:150px;">
        </div>
    </div>

    <!-- Project Category -->
    <div class="mb-3 col-xxl-4 col-sm-12">
        <label class="form-label" for="category_id">Project Category <span class="txt-danger">*</span></label>
        <select name="category_id" id="category_id" class="form-control" required>
            <option value="">Select Category</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Project Image Upload -->
    <div class="mb-3 col-xxl-4 col-sm-12">
        <label class="form-label" for="project_image">Project Image <span class="txt-danger">*</span></label>
        <input class="form-control" id="project_image" type="file" name="project_image" accept=".jpg, .jpeg, .png, .webp" required onchange="previewImage(event, 'project_image_preview')">
        <div class="invalid-feedback">Please upload a Project Image.</div>
        <small class="text-secondary"><b>Max 2MB. Formats: .jpg, .jpeg, .png, .webp</b></small>
        <div id="projectImagePreviewContainer" class="mt-2">
            <img id="project_image_preview" src="#" alt="Project Image Preview" style="display:none; max-height:150px;">
        </div>
    </div>

    <!-- Project Heading -->
    <div class="mb-3">
        <label for="project_heading" class="form-label">Project Heading<span class="txt-danger">*</span></label>
        <input type="text" name="project_heading" class="form-control" placeholder="Enter Project Heading" required>
    </div>

    <!-- Title -->
    <div class="mb-3">
        <label for="title" class="form-label">Title<span class="txt-danger">*</span></label>
        <input type="text" name="title" class="form-control" placeholder="Enter Project Title" required>
    </div>

    <!-- Location -->
    <div class="mb-3">
        <label for="location" class="form-label">Location<span class="txt-danger">*</span></label>
        <input type="text" name="location" class="form-control" placeholder="Enter Location" required>
    </div>

    <!-- Actions -->
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('ourproject-details.index') }}" class="btn btn-secondary">Cancel</a>
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