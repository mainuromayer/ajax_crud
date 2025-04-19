<!-- Update Modal -->
<div class="modal fade" id="updateDepartmentModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="updateDepartmentForm">
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control" placeholder="Department Name" required>
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
        const form = document.getElementById('updateDepartmentForm');
        const modalEl = document.getElementById('updateDepartmentModal');
        const modal = new bootstrap.Modal(modalEl);
    
        document.body.addEventListener('click', function (e) {
            if (e.target.classList.contains('editBtn')) {
                form.name.value = e.target.dataset.name;
                form.id.value = e.target.dataset.id;
                modal.show();
            }
        });
    
        form.addEventListener('submit', function (e) {
            e.preventDefault();
    
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
    
            const formData = new FormData(form);
    
            axios.post('{{ route("department.update") }}', formData)
                .then(res => {
                    if (res.data.status) {
                        Toastify({ text: res.data.message, backgroundColor: "green" }).showToast();
                        form.reset();
                        modal.hide();
                        loadDepartments();
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
    
