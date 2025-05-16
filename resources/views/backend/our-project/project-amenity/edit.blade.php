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
                  <h4>Edit Project Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('ourproject-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Project Details</li>
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
                      
    
   


   <form action="{{ route('projectamenity-details.update', $projectAmenity->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Banner Image -->
                    <div class="mb-4">
                        <label for="banner_image" class="form-label">Background Image <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" name="banner_image" id="banner_image" onchange="previewBanner(event)">
                        <small class="text-secondary">Max 2MB. Formats: .jpg, .jpeg, .png, .webp, .svg</small>
                        <div class="mt-2">
                            @if($projectAmenity->banner_image)
                                <img id="banner_image_preview" src="{{ asset('uploads/amenity/banner/' . $projectAmenity->banner_image) }}" style="max-height: 150px;" />
                            @else
                                <img id="banner_image_preview" style="display:none; max-height: 150px;" />
                            @endif
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label">Section Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="description" id="summernote" rows="4" required>{{ $projectAmenity->description }}</textarea>
                    </div>

                    <!-- Amenities Table -->
                    <h5>Section Amenities</h5>
                    <table class="table table-bordered" id="dynamicTable">
                        <thead>
                            <tr>
                                <th>Thumbnail Image <span class="text-danger">*</span></th>
                                <th>Preview</th>
                                <th>Heading <span class="text-danger">*</span></th>
                                <th>Title <span class="text-danger">*</span></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($amenities as $index => $amenity)
                            <tr>
                                <td>
                                    <input type="file" name="thumbnail_image[]" class="form-control" onchange="previewThumbnail(this, {{ $index }})">
                                    <input type="hidden" name="old_thumbnail_image[]" value="{{ $amenity['image'] }}">
                                    <small class="text-secondary">Max size 2MB. Format: jpg, jpeg, png, webp, svg</small>
                                </td>
                                <td>
                                    <div id="preview-container-{{ $index }}">
                                        @if(!empty($amenity['image']))
                                            <img src="{{ asset('uploads/amenity/thumbnail/' . $amenity['image']) }}" style="max-height: 100px;">
                                        @endif
                                    </div>
                                </td>
                                <td><input type="text" name="heading[]" class="form-control" value="{{ $amenity['heading'] }}" required></td>
                                <td><input type="text" name="title[]" class="form-control" value="{{ $amenity['title'] }}" required></td>
                                <td>
                                    @if($loop->last)
                                        <button type="button" class="btn btn-primary addRow">Add More</button>
                                    @else
                                        <button type="button" class="btn btn-danger removeRow">Remove</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('projectamenity-details.index') }}" class="btn btn-secondary">Cancel</a>
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
let rowId = {{ count($amenities) }};

function getAddButton() {
    return `<button type="button" class="btn btn-primary addRow">Add More</button>`;
}
function getRemoveButton() {
    return `<button type="button" class="btn btn-danger removeRow">Remove</button>`;
}

function addRow() {
    rowId++;

    $('#dynamicTable tbody tr:last td:last-child').html(getRemoveButton());

    const newRow = `
        <tr>
            <td>
                <input type="file" name="thumbnail_image[]" class="form-control" onchange="previewThumbnail(this, ${rowId})" required>
                <small class="text-secondary">Max size 2MB. Format: jpg, jpeg, png, webp, svg</small>
            </td>
            <td><div id="preview-container-${rowId}"></div></td>
            <td><input type="text" name="heading[]" class="form-control" required></td>
            <td><input type="text" name="title[]" class="form-control" required></td>
            <td>${getAddButton()}</td>
        </tr>
    `;
    $('#dynamicTable tbody').append(newRow);
}

$(document).on('click', '.addRow', function () {
    addRow();
});

$(document).on('click', '.removeRow', function () {
    $(this).closest('tr').remove();
    const rows = $('#dynamicTable tbody tr');
    rows.each(function (index) {
        const isLast = index === rows.length - 1;
        $(this).find('td:last-child').html(isLast ? getAddButton() : getRemoveButton());
    });
});

function previewBanner(event) {
    const input = event.target;
    const preview = document.getElementById('banner_image_preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function previewThumbnail(input, rowId) {
    const file = input.files[0];
    const previewContainer = document.getElementById(`preview-container-${rowId}`);
    previewContainer.innerHTML = '';

    if (file) {
const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'image/svg+xml'];
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


</body>

</html>