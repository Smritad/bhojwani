<!doctype html>
<html lang="en">
<head>
    @include('components.backend.head')
</head>

<body>
    @include('components.backend.header')
    @include('components.backend.sidebar')

    <div class="page-body">
        <div class="container-fluid">
            <!-- Page Title -->
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>Add Testimonials Details Form</h4>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('testimonials-details.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Add Testimonials</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Form Start -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Testimonials Form</h5>
                            <p class="text-muted">Fill in the testimonials and click "Add" to insert more rows.</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('testimonials-details.store') }}" method="POST">
                                @csrf
                                <table class="table table-bordered" id="testimonialTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Person Name</th>
                                            <th>Designation</th>
                                            <th>Rating</th>
                                            <th>Token Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="testimonials[0][title]" class="form-control" required></td>
                                            <td><textarea name="testimonials[0][description]" class="form-control" required></textarea></td>
                                            <td><input type="text" name="testimonials[0][person_name]" class="form-control" required></td>
                                            <td><input type="text" name="testimonials[0][designation]" class="form-control" required></td>
                                            <td><input type="number" name="testimonials[0][rating]" class="form-control" min="1" max="5" required></td>
                                            <td><input type="text" name="testimonials[0][token_name]" class="form-control"></td>
                                            <td><button type="button" class="btn btn-success addRow">Add</button></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="text-end mt-3">
                                    <a href="{{ route('testimonials-details.index') }}" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Submit Testimonials</button>
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

    <!-- Add/Remove Row Script -->
    <script>
        let index = 1;

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('addRow')) {
                const table = document.querySelector('#testimonialTable tbody');
                const row = `
                    <tr>
                        <td><input type="text" name="testimonials[${index}][title]" class="form-control" required></td>
                        <td><textarea name="testimonials[${index}][description]" class="form-control" required></textarea></td>
                        <td><input type="text" name="testimonials[${index}][person_name]" class="form-control" required></td>
                        <td><input type="text" name="testimonials[${index}][designation]" class="form-control" required></td>
                        <td><input type="number" name="testimonials[${index}][rating]" class="form-control" min="1" max="5" required></td>
                        <td><input type="text" name="testimonials[${index}][token_name]" class="form-control"></td>
                        <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
                    </tr>
                `;
                table.insertAdjacentHTML('beforeend', row);
                index++;
            }

            if (e.target.classList.contains('removeRow')) {
                e.target.closest('tr').remove();
            }
        });
    </script>
</body>
</html>
