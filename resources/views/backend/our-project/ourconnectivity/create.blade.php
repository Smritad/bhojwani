<!doctype html>
<html lang="en">

<head>
    @include('components.backend.head')
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* To keep the project fields aligned nicely */
        .project-group {
            margin-bottom: 0.5rem;
        }

        .project-label {
            font-weight: 600;
        }
    </style>
</head>

<>
    @include('components.backend.header')
    @include('components.backend.sidebar')

    <div class="page-body">
        <div class="container-fluid">

            <div class="page-title mb-3">
                <div class="row">
                    <div class="col-6">
                        <h4>Add Project Connectivity Details Form</h4>
                    </div>
                    <div class="col-6 text-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('ourconnectivity-details.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Add Project Connectivity Details</li>
                        </ol>
                    </div>
                </div>
            </div>

            <form action="{{ route('ourconnectivity-details.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Section 1 -->
                <div class="card mb-4">
<div class="px-3 pt-3">
    <h5 class="fw-semibold mb-3">Section 1 – Heading and Description</h5>
</div>
                    <div class="card-body">
                        <div class="mb-3">
    <label>Project Name <span class="txt-danger">*</span></label>
    <select name="project_id" class="form-control" required>
        <option value="">Select Project Name</option> <!-- Default option -->

        @foreach($projectid as $cat)
            <option value="{{ $cat->id }}" 
                {{ old('project_id', isset($selectedProjectId) ? $selectedProjectId : '') == $cat->id ? 'selected' : '' }}>
                {{ $cat->project_heading }}
            </option>
        @endforeach
    </select>
</div>

                        <div class="mb-3">
                            <label class="form-label">Heading <span class="text-danger">*</span></label>
                            <input type="text" name="section1_heading" class="form-control" placeholder="Enter main heading" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea name="section1_description" class="form-control" rows="3" placeholder="Short description" required></textarea>
                        </div>
                    </div>
                </div>

           <!-- Section 2 -->
<div class="card">
    <div class="px-3 pt-3">
        <h5 class="fw-semibold mb-3">Section 2 – Icon, Heading & Project Details</h5>
    </div>
    <div class="card-body">
        <div class="mb-3 text-end">
            <button type="button" class="btn btn-sm btn-primary" onclick="addSection2Row()">Add Row</button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center" id="section2-table">
                <thead class="table-light">
                    <tr>
                        <th style="width:18%">Icon <span class="text-danger">*</span></th>
                        <th style="width:18%">Heading <span class="text-danger">*</span></th>
                        <th>Project Title & Matter</th>
                        <th style="width:10%">Action</th>
                    </tr>
                </thead>
                <tbody id="section2-body"></tbody>
            </table>
        </div>
    </div>
</div>


                <div class="text-end mt-4">
                    <a href="{{ route('ourconnectivity-details.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
</div>

        @include('components.backend.footer')
    </div>

    @include('components.backend.main-js')

    {{-- ---------- Script ---------- --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => addSection2Row());   // default row

        let sectionIdx = 0;

        // Add a new Section 2 row
        function addSection2Row() {
            const html = `
            <tr id="row-${sectionIdx}">
                <td>
    <div class="mb-2">
        <img id="preview-${sectionIdx}" src="#" alt="Preview" class="img-thumbnail d-none" style="max-height: 60px;">
    </div>
    <input type="file" name="section2[${sectionIdx}][icon]" accept=".svg,.webp,.jpg,.jpeg,.png"
           class="form-control" onchange="previewImage(event, ${sectionIdx})" required>
</td>

                <td>
                    <input type="text" name="section2[${sectionIdx}][heading]" class="form-control" placeholder="Section heading" required>
                </td>
                <td class="text-start">
                    <div id="projects-${sectionIdx}">
                        ${projectBlock(sectionIdx, 0)}
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary mt-2 float-end" onclick="addProject(${sectionIdx})">
                        Add Project
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeSection(${sectionIdx})">
                        Remove Row
                    </button>
                </td>
            </tr>`;
            document.getElementById('section2-body').insertAdjacentHTML('beforeend', html);
            sectionIdx++;
        }

        // Remove a full Section 2 row
        function removeSection(id) {
            const row = document.getElementById(`row-${id}`);
            if (row) row.remove();
        }

        // Add a new project block under a section
        function addProject(parent) {
            const container = document.getElementById(`projects-${parent}`);
            const idx = container.querySelectorAll('.project-item').length;
            container.insertAdjacentHTML('beforeend', projectBlock(parent, idx));
        }

        // Remove a specific project block
        function removeProject(blockId) {
            const block = document.getElementById(blockId);
            if (block) block.remove();
        }

        // HTML block for each project
        function projectBlock(parent, idx) {
            const blockId = `proj-${parent}-${idx}`;
            return `
            <div class="project-item border rounded p-2 mb-2" id="${blockId}">
                <div class="row g-2 align-items-center">
                    <div class="col-md-5">
                        <input type="text" name="section2[${parent}][projects][${idx}][project_title]"
                            class="form-control" placeholder="Project Title" required>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="section2[${parent}][projects][${idx}][project_matter]"
                            class="form-control" placeholder="Project Matter" required>
                    </div>
                    <div class="col-md-2 text-end">
                        <button type="button" class="btn btn-outline-danger btn-sm"
                            onclick="removeProject('${blockId}')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>`;
        }
        function previewImage(event, index) {
    const input = event.target;
    const preview = document.getElementById(`preview-${index}`);

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove("d-none");
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = "#";
        preview.classList.add("d-none");
    }
}

    </script>

</body>

</html>
