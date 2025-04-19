<!-- Update Employee Modal -->
<div class="modal fade" id="updateEmployeeModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="updateEmployeeForm">
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input name="name" type="text" class="form-control mb-2" required>
                    <input name="email" type="email" class="form-control mb-2" required>
                    <select name="department_id" class="form-select" required>
                        <option value="" disabled>Select Department</option>
                        @foreach(\App\Models\Department::all() as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.body.addEventListener('click', function (e) {
        if (e.target.classList.contains('editBtn')) {
            const modal = new bootstrap.Modal(document.getElementById('updateEmployeeModal'));
            document.querySelector('#updateEmployeeForm [name="id"]').value = e.target.dataset.id;
            document.querySelector('#updateEmployeeForm [name="name"]').value = e.target.dataset.name;
            document.querySelector('#updateEmployeeForm [name="email"]').value = e.target.dataset.email;
            document.querySelector('#updateEmployeeForm [name="department_id"]').value = e.target.dataset.department;
            modal.show();
        }
    });

    document.getElementById('updateEmployeeForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        axios.post('{{ route('employee.update') }}', formData)
            .then(res => {
                Toastify({ text: res.data.message, backgroundColor: "green" }).showToast();
                bootstrap.Modal.getInstance(document.getElementById('updateEmployeeModal')).hide();
                loadEmployees();
            })
            .catch(err => {
                Toastify({ text: err.response?.data?.message || "Update failed", backgroundColor: "red" }).showToast();
            });
    });
});
</script>
