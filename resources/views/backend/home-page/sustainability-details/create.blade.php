<!doctype html>
<html lang="en">
<head>
    @include('components.backend.head')
    <style>
        /* Custom styles for better section visibility */
        .section-header {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .section-container {
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .section-container h5 {
            margin-bottom: 15px;
        }

        .table-container {
            margin-bottom: 20px;
        }

        /* Add padding for better readability */
        .form-control {
            margin-bottom: 10px;
        }

        .mb-4 {
            margin-bottom: 25px !important;
        }
    </style>
</head>

<body>
@include('components.backend.header')
@include('components.backend.sidebar')

<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h4>Add Growth-Sustainability Details Form</h4>
        </div>
        <div class="col-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('growth-sustainability-details.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Add Growth-Sustainability Details</li>
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
            <h4>Growth-Sustainability Details Form</h4>
            <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
          </div>
          <div class="card-body">

            <form action="{{ route('growth-sustainability-details.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <!-- SECTION 1: Growth Count -->
              <div class="section-container">
                <div class="section-header">
                  <h5><strong>Section 1 – Growth Count (Thumbnail Images)</strong></h5>
                </div>
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
                    <tr>
                      <td>
                        <input type="file" onchange="previewThumbnail(this, 0)" name="thumbnail_image[]" class="form-control" required>
                        <small class="text-secondary">Max size 2MB. Format: jpg, jpeg, png, webp</small>
                      </td>
                      <td><div id="preview-container-0"></div></td>
                      <td><input type="text" name="heading[]" class="form-control" required></td>
                      <td><input type="text" name="title[]" class="form-control" required></td>
                      <td><button type="button" class="btn btn-primary addRow">Add More</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <!-- SECTION 2: Sustainability -->
              <div class="section-container">
                <div class="section-header">
                  <h5><strong>Section 2 – Sustainability</strong></h5>
                </div>
                <div class="mb-3">
                  <label for="sustainability_title">Title<span class="txt-danger">*</span></label>
                  <input type="text" name="sustainability_title" class="form-control" required>
                </div>

                <div class="mb-3">
                  <label for="sustainability_image">Image<span class="txt-danger">*</span></label>
                  <input type="file" id="sustainability_image" name="sustainability_image" class="form-control" accept=".jpg,.jpeg,.png,.webp" required>
                  <small class="text-secondary">Max size 2MB. Format: jpg, jpeg, png, webp</small>
                  <div id="sustainability-preview" class="mt-2"></div>
                </div>

                <div class="mb-3">
                  <label for="sustainability_description">Description<span class="txt-danger">*</span></label>
                  <textarea name="sustainability_description" class="form-control" rows="5" id="summernote" required></textarea>
                </div>
              </div>

              <!-- Submit and Cancel Buttons -->
              <div class="col-12 text-end">
                <a href="{{ route('growth-sustainability-details.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('components.backend.footer')
@include('components.backend.main-js')

<!-- Add More Script -->
<script>
let rowId = 0;

const getAddButton = () => `<button type="button" class="btn btn-primary addRow">Add More</button>`;
const getRemoveButton = () => `<button type="button" class="btn btn-danger removeRow">Remove</button>`;

// Add Row
function addRow() {
  rowId++;

  // Convert last row's button to "Remove"
  $('#dynamicTable tbody tr:last td:last-child').html(getRemoveButton());

  const newRow = `
    <tr>
      <td>
        <input type="file" onchange="previewThumbnail(this, ${rowId})" name="thumbnail_image[]" class="form-control" required>
        <small class="text-secondary">Max size 2MB. Format: jpg, jpeg, png, webp</small>
      </td>
      <td><div id="preview-container-${rowId}"></div></td>
      <td><input type="text" name="heading[]" class="form-control" required></td>
      <td><input type="text" name="title[]" class="form-control" required></td>
      <td>${getAddButton()}</td>
    </tr>
  `;

  $('#dynamicTable tbody').append(newRow);
}

// Event: Add
$(document).on('click', '.addRow', function () {
  addRow();
});

// Event: Remove
$(document).on('click', '.removeRow', function () {
  $(this).closest('tr').remove();

  const rows = $('#dynamicTable tbody tr');
  rows.each(function (index) {
    const isLast = index === rows.length - 1;
    $(this).find('td:last-child').html(isLast ? getAddButton() : getRemoveButton());
  });
});

// Preview Image
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

// Preview for sustainability_image input
document.getElementById('sustainability_image').addEventListener('change', function () {
  const file = this.files[0];
  const previewContainer = document.getElementById('sustainability-preview');
  previewContainer.innerHTML = '';

  if (file) {
    const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    if (validTypes.includes(file.type)) {
      const reader = new FileReader();
      reader.onload = function (e) {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.style.maxWidth = '200px';
        img.style.maxHeight = '150px';
        img.style.objectFit = 'cover';
        previewContainer.appendChild(img);
      };
      reader.readAsDataURL(file);
    } else {
      previewContainer.innerHTML = '<p class="text-danger">Unsupported file type</p>';
    }
  }
});
</script>

</body>
</html>
