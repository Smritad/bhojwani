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
                  <h4>Edit Banner Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('banner-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Testimonial Details</li>
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
                        <h4>Banner Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">


     

   <form action="{{ route('testimonials-details.update', $testimonial->id) }}" method="POST">
    @csrf
    @method('PUT')

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Title <span class="txt-danger">*</span></th>
                <th>Description <span class="txt-danger">*</span></th>
                <th>Person Name <span class="txt-danger">*</span></th>
                <th>Designation <span class="txt-danger">*</span></th>
                <th>Rating <span class="txt-danger">*</span></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $testimonial->title) }}" required>
                </td>
                <td>
                    <textarea name="description" class="form-control" required>{{ old('description', $testimonial->description) }}</textarea>
                </td>
                <td>
                    <input type="text" name="person_name" class="form-control" value="{{ old('person_name', $testimonial->person_name) }}" required>
                </td>
                <td>
                    <input type="text" name="designation" class="form-control" value="{{ old('designation', $testimonial->designation) }}" required>
                </td>
                <td>
                    <input type="number" name="rating" class="form-control" min="1" max="5" value="{{ old('rating', $testimonial->rating) }}" required>
                </td>
            </tr>
        </tbody>
    </table>

    <br>
    <div class="col-12 text-end">
        <a href="{{ route('testimonials-details.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Update Testimonial</button>
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