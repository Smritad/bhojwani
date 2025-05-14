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
                  <h4>Edit Project Category Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('ourprojectcategory-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Project Category Details</li>
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
                        <h4>Project Category Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                      
    
    <form action="{{ route('ourprojectcategory-details.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-group">
        <label for="category_name">Category Name</label>
        <input type="text" name="category_name" id="category_name" class="form-control" value="{{ $category->category_name }}" placeholder="Enter Category Name" required>
    </div>
<br>
       <div class="col-12 text-end">
            <a href="{{ route('ourprojectcategory-details.index') }}" class="btn btn-secondary">Cancel</a>
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