<!-- Create Employee Modal -->
<div class="modal fade" id="createEmployeeModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="createEmployeeForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input name="name" type="text" class="form-control mb-2" placeholder="Name" required>
                    <input name="email" type="email" class="form-control mb-2" placeholder="Email" required>
                    <select name="department_id" class="form-select" required>
                        <option value="" disabled selected>Select Department</option>
                        @foreach(\App\Models\Department::all() as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('createEmployeeForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        axios.post('{{ route('employee.create') }}', formData)
            .then(res => {
                Toastify({ text: res.data.message, backgroundColor: "green" }).showToast();
                document.getElementById('createEmployeeForm').reset();
                bootstrap.Modal.getInstance(document.getElementById('createEmployeeModal')).hide();
                loadEmployees();
            })
            .catch(err => {
                Toastify({ text: err.response?.data?.message || "Create failed", backgroundColor: "red" }).showToast();
            });
    });
});
</script>
