<!-- Create Department Modal -->
<div class="modal fade" id="createDepartmentModal" tabindex="-1" aria-labelledby="createDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="createDepartmentForm" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDepartmentModalLabel">Add New Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input name="name" type="text" class="form-control" placeholder="Department Name" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-primary" type="submit">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Create Department AJAX Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('createDepartmentForm');
    const modalEl = document.getElementById('createDepartmentModal');
    const modal = new bootstrap.Modal(modalEl);

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        axios.post('{{ route('department.create') }}', formData)
            .then(res => {
                if (res.data.status) {
                    Toastify({
                        text: res.data.message,
                        backgroundColor: "green",
                        close: true
                    }).showToast();

                    form.reset();
                    modal.hide();
                    loadDepartments();
                } else {
                    Toastify({
                        text: res.data.message || 'Something went wrong',
                        backgroundColor: "orange",
                        close: true
                    }).showToast();
                }
            })
            .catch(error => {
                const msg = error.response?.data?.message || 'Server Error';
                Toastify({
                    text: msg,
                    backgroundColor: "red",
                    close: true
                }).showToast();
            });
    });
});
</script>
