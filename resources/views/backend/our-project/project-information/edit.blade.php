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
                  <h4>Edit Project Information Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('ourproject-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Project Information</li>
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
                        <h4>Project Information Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                      
    
    <form action="{{ route('ourproject-details.update', $project->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Category -->
    <div class="mb-3">
        <label>Category<span class="txt-danger">*</span></label>
        <select name="category_id" class="form-control" required>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $project->category_id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->category_name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Project Heading -->
    <div class="mb-3">
        <label>Project Heading<span class="txt-danger">*</span></label>
        <input type="text" name="project_heading" value="{{ $project->project_heading }}" class="form-control" required>
    </div>

    <!-- Title -->
    <div class="mb-3">
        <label>Title<span class="txt-danger">*</span></label>
        <input type="text" name="title" value="{{ $project->title }}" class="form-control" required>
    </div>

    <!-- Location -->
    <div class="mb-3">
        <label>Location<span class="txt-danger">*</span></label>
        <input type="text" name="location" value="{{ $project->location }}" class="form-control" required>
    </div>

    <!-- Existing Images Preview -->
    <div class="mb-3">
        <label>Banner Image (current)<span class="txt-danger">*</span></label><br>
        <img src="{{ asset('/bhojwani/project/banner/' . $project->banner_image) }}" width="100">
        <input type="file" name="banner_image" class="form-control mt-2">
    </div>

    <div class="mb-3">
        <label>Project Image (current)<span class="txt-danger">*</span></label><br>
        <img src="{{ asset('/bhojwani/project/project_images/' . $project->project_image) }}" width="100">
        <input type="file" name="project_image" class="form-control mt-2">
    </div>

    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('ourproject-details.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Update</button>
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
   function previewBannerImage() {
    const file = document.getElementById('banner_image').files[0];
    const previewContainer = document.getElementById('bannerImagePreviewContainer');
    const previewImage = document.getElementById('banner_image_preview');
    const existingImageContainer = document.getElementById('existingBannerImageContainer');

    // Clear the previous preview
    previewImage.src = '';
    previewContainer.style.display = 'none';

    if (file) {
        const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

        if (validImageTypes.includes(file.type)) {
            const reader = new FileReader();

            reader.onload = function (e) {
                // Hide existing image container if present
                if (existingImageContainer) {
                    existingImageContainer.style.display = 'none';
                }

                // Display the new preview
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
            };

            reader.readAsDataURL(file);
        } else {
            alert('Please upload a valid image file (jpg, jpeg, png, webp).');
        }
    }
}

</script>
</body>

</html>