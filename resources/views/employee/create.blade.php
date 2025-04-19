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
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-primary" type="submit">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('createEmployeeForm');
    const modalEl = document.getElementById('createEmployeeModal');
    const modal = new bootstrap.Modal(modalEl);

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true;

        const formData = new FormData(form);

        axios.post('{{ route('employee.create') }}', formData)
            .then(res => {
                if (res.data.status) {
                    Toastify({
                        text: res.data.message,
                        backgroundColor: "green",
                        close: true
                    }).showToast();

                    form.reset();
                    modal.hide();
                    loadEmployees();
                } else {
                    Toastify({
                        text: res.data.message || 'Something went wrong',
                        backgroundColor: "orange",
                        close: true
                    }).showToast();
                }
            })
            .catch(error => {
                if (error.response?.status === 422) {
                    const errors = error.response.data.errors;
                    let messages = '';

                    for (let field in errors) {
                        messages += errors[field].join('\n') + '\n';
                    }

                    Toastify({
                        text: messages.trim(),
                        backgroundColor: "orange",
                        close: true
                    }).showToast();
                } else {
                    const msg = error.response?.data?.message || 'Server Error';
                    Toastify({
                        text: msg,
                        backgroundColor: "red",
                        close: true
                    }).showToast();
                }
            })
            .finally(() => {
                submitButton.disabled = false;
            });
    });
});
</script>
