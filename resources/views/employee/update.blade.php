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
                    <input name="name" type="text" class="form-control mb-2" placeholder="Name" required>
                    <input name="email" type="email" class="form-control mb-2" placeholder="Email" required>
                    <select name="department_id" class="form-select" required>
                        <option value="" disabled>Select Department</option>
                        @foreach(\App\Models\Department::all() as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('updateEmployeeForm');
    const modalEl = document.getElementById('updateEmployeeModal');
    const modal = new bootstrap.Modal(modalEl);

    document.body.addEventListener('click', function (e) {
        if (e.target.classList.contains('editBtn')) {
            form.name.value = e.target.dataset.name;
            form.email.value = e.target.dataset.email;
            form.id.value = e.target.dataset.id;
            form.department_id.value = e.target.dataset.department;
            modal.show();
        }
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;

        const formData = new FormData(form);

        axios.post('{{ route("employee.update") }}', formData)
            .then(res => {
                if (res.data.status) {
                    Toastify({ text: res.data.message, backgroundColor: "green" }).showToast();
                    form.reset();
                    modal.hide();
                    loadEmployees();
                } else {
                    Toastify({ text: res.data.message || "Update failed", backgroundColor: "orange" }).showToast();
                }
            })
            .catch(err => {
                if (err.response?.status === 422) {
                    const errors = err.response.data.errors;
                    let messages = '';
                    for (let key in errors) {
                        messages += errors[key].join('\n') + '\n';
                    }
                    Toastify({ text: messages.trim(), backgroundColor: "orange" }).showToast();
                } else {
                    Toastify({ text: err.response?.data?.message || "Server Error", backgroundColor: "red" }).showToast();
                }
            })
            .finally(() => {
                submitBtn.disabled = false;
            });
    });
});
</script>
