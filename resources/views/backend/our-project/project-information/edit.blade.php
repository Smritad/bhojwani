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
                    <a href="{{ route('projectinformation-details.index') }}">Home</a>
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
                      
    
 

   <form action="{{ route('projectinformation-details.update', $project_detail->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

   <!-- Banner Section -->
<div class="card mb-4">
    <div class="card-header bg-primary text-white">Banner Information</div>
    <div class="card-body">
        <div class="mb-3">
            <label for="banner_image" class="form-label">Banner Images <span class="text-danger">*</span></label>
            <input type="file" class="form-control" id="banner_image" name="banner_image[]" multiple onchange="previewMultipleImages(event)">
            
          @php
    $existingImages = json_decode($project_detail->banner_image, true) ?? [];
@endphp

<div id="existingBannerImages" class="d-flex flex-wrap gap-3 mt-2">
    @foreach($existingImages as $key => $image)
        <div class="position-relative" style="width: 100px;">
            <img src="{{ asset('bhojwani/project_information/banner/' . $image) }}" class="img-thumbnail" style="height: 100px; width: 100px; object-fit: cover;">
            <span class="delete-img" onclick="removeImage({{ $key }})" style="
                position: absolute;
                top: -8px;
                right: -8px;
                background-color: red;
                color: white;
                border-radius: 50%;
                padding: 4px 8px;
                cursor: pointer;
                font-weight: bold;
            ">&times;</span>
        </div>
    @endforeach
</div>


            {{-- New image previews --}}
            <div id="newBannerPreviews" class="d-flex flex-wrap gap-2 mt-2"></div>
        </div>

        <div class="mb-3">
            <label for="banner_heading" class="form-label">Banner Heading</label>
            <input type="text" class="form-control" name="banner_heading" value="{{ $project_detail->banner_heading }}" required>
        </div>
        <div class="mb-3">
            <label for="banner_description" class="form-label">Banner Description</label>
            <textarea class="form-control" name="banner_description" rows="4" required>{{ $project_detail->banner_description }}</textarea>
        </div>
    </div>
</div>

    <!-- Description Section -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Description Section</div>
        <div class="card-body">
            <div class="mb-3">
                <label for="description_image" class="form-label">Description Image</label>
                <input type="file" class="form-control" id="description_image" name="description_image">
                @if($project_detail->description_image)
                    <img src="{{ asset('/bhojwani/project_information/project_image/' . $project_detail->description_image) }}" alt="Description Image" class="img-fluid mt-2" style="max-height: 150px;">
                @endif
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description"  id="summernote" rows="4" required>{{ $project_detail->description }}</textarea>
            </div>
        </div>
    </div>

    <!-- More Content Section -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white"> Additional Information</div>
        <div class="card-body">
            <div class="mb-3">
                <label for="heading" class="form-label">Additional Heading</label>
                <input type="text" class="form-control" name="heading" value="{{ $project_detail->heading }}" required>
            </div>
           <div class="mb-3">
    <label for="more_description" class="form-label">Additional Description</label>
    <textarea class="form-control" name="more_description" id="summernote1" rows="4" required>{{ $project_detail->more_description }}</textarea>
</div>

            <div class="mb-3">
                <label for="more_image" class="form-label">More Image</label>
                <input type="file" class="form-control" id="more_image" name="more_image">
                @if($project_detail->more_image)
                    <img src="{{ asset('/bhojwani/project_information/project_image/' . $project_detail->more_image) }}" alt="More Image" class="img-fluid mt-2" style="max-height: 150px;">
                @endif
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('projectinformation-details.index') }}" class="btn btn-secondary">Cancel</a>
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
        </div>
        <!-- footer start-->
        @include('components.backend.footer')
        </div>
        </div>


       
       @include('components.backend.main-js')
<script>
  $(document).ready(function() {
    $('#summernote1').summernote({
      height: 200, // Adjust height as needed
      focus: true   // Focus the editor when initialized
    });
  });
</script>
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
<script>
function previewMultipleImages(event) {
    const previewContainer = document.getElementById('newBannerPreviews');
    previewContainer.innerHTML = ''; // Clear previous previews

    Array.from(event.target.files).forEach((file, index) => {
        const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        if (!validImageTypes.includes(file.type)) {
            alert('Only image files are allowed.');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const wrapper = document.createElement('div');
            wrapper.className = 'position-relative';
            wrapper.style = "width: 100px; margin-right: 10px;";

            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'img-thumbnail';
            img.style = "height: 100px; width: 100px; object-fit: cover;";

            const removeBtn = document.createElement('span');
            removeBtn.innerHTML = '&times;';
            removeBtn.className = 'delete-img';
            removeBtn.style = `
                position: absolute;
                top: -8px;
                right: -8px;
                background-color: red;
                color: white;
                border-radius: 50%;
                padding: 4px 8px;
                cursor: pointer;
                font-weight: bold;
                z-index: 10;
            `;
            removeBtn.onclick = function () {
                wrapper.remove(); // remove preview
            };

            wrapper.appendChild(img);
            wrapper.appendChild(removeBtn);
            previewContainer.appendChild(wrapper);
        };
        reader.readAsDataURL(file);
    });
}
</script>

<script>
    function removeImage(index) {
        const container = document.getElementById('existingBannerImages');
        container.children[index].remove();
        // If you also want to send info to backend, you could add:
        // let hidden = document.createElement('input');
        // hidden.type = 'hidden';
        // hidden.name = 'remove_banner_image[]';
        // hidden.value = index;
        // document.querySelector('form').appendChild(hidden);
    }
</script>

</body>

</html>