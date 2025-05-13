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
                    <li class="breadcrumb-item active">Edit Sustainability Details</li>
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


   

 

  
  <form action="{{ route('growth-sustainability-details.update', $description->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- SECTION 1: Growth Count (Thumbnails) -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <strong>Section 1: Growth Count (Thumbnail Images)</strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="dynamicTable">
                <thead class="table-light">
                    <tr>
                        <th>Thumbnail Image <span class="text-danger">*</span></th>
                        <th>Preview</th>
                        <th>Heading <span class="text-danger">*</span></th>
                        <th>Title <span class="text-danger">*</span></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(json_decode($description->thumbnail_images, true) as $index => $image)
                        <tr>
                            <td>
                                <input type="file" onchange="previewThumbnail(this, {{ $index }})" name="thumbnail_image[]" class="form-control">
                                <input type="hidden" name="old_thumbnail_image[]" value="{{ $image }}">
                            </td>
                            <td>
                                <div id="preview-container-{{ $index }}">
                                    <img src="{{ asset('/bhojwani/home/sustainability/' . $image) }}" style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                </div>
                            </td>
                            <td>
                                <input type="text" name="heading[]" value="{{ json_decode($description->heading, true)[$index] ?? '' }}" class="form-control" required>
                            </td>
                            <td>
                                <input type="text" name="title[]" value="{{ json_decode($description->title, true)[$index] ?? '' }}" class="form-control" required>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger removeRow">Remove</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- SECTION 2: Sustainability Section -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <strong>Section 2: Sustainability Section</strong>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="sustainability_title"><strong>Sustainability Title</strong></label>
                <input type="text" name="sustainability_title" class="form-control" value="{{ $description->sustainability_title }}" required>
            </div>

            <div class="mb-3">
                <label for="sustainability_image"><strong>Sustainability Image</strong></label>
                <input type="file" name="sustainability_image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                @if($description->sustainability_image)
                    <img src="{{ asset('/bhojwani/home/sustainability/'. $description->sustainability_image) }}" style="max-width: 120px; max-height: 100px; object-fit: cover;" class="mt-2">
                @endif
            </div>

            <div class="mb-3">
                <label for="sustainability_description"><strong>Sustainability Description</strong></label>
                <textarea name="sustainability_description" class="form-control" rows="5" id="summernote" required>{{ $description->sustainability_description }}</textarea>
            </div>
        </div>
    </div>

    <!-- Submit -->
    <div class="text-end">
    <a href="{{ route('growth-sustainability-details.index') }}" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-success">Update</button>
</div>

</form>

</div>


@section('scripts')
<script>
    let rowId = {{ count(json_decode($description->thumbnail_images)) }};

    $('#addRow').click(function () {
        rowId++;
        const newRow = `
            <tr>
                <td>
                    <input type="file" onchange="previewThumbnail(this, ${rowId})" name="thumbnail_image[]" class="form-control" required>
                    <input type="hidden" name="old_thumbnail_image[]" value="">
                </td>
                <td><div id="preview-container-${rowId}"></div></td>
                <td><input type="text" name="heading[]" class="form-control" required></td>
                <td><input type="text" name="title[]" class="form-control" required></td>
                <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
            </tr>`;
        $('#dynamicTable tbody').append(newRow);
    });

    $(document).on('click', '.removeRow', function () {
        $(this).closest('tr').remove();
    });

    function previewThumbnail(input, rowId) {
        const file = input.files[0];
        const previewContainer = document.getElementById(`preview-container-${rowId}`);
        previewContainer.innerHTML = '';

        if (file) {
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
            if (validTypes.includes(file.type)) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '120px';
                    img.style.maxHeight = '100px';
                    img.style.objectFit = 'cover';
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.innerHTML = '<p class="text-danger">Unsupported file type</p>';
            }
        }
    }
</script>
@endsection

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