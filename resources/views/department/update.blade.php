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
    document.body.addEventListener('click', function (e) {
        if (e.target.classList.contains('editBtn')) {
            const id = e.target.dataset.id;
            const name = e.target.dataset.name;

            const modal = new bootstrap.Modal(document.getElementById('updateDepartmentModal'));
            document.querySelector('#updateDepartmentForm [name="id"]').value = id;
            document.querySelector('#updateDepartmentForm [name="name"]').value = name;
            modal.show();
        }
    });

    document.getElementById('updateDepartmentForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        axios.post('{{ route('department.update') }}', formData)
            .then(res => {
                Toastify({ text: res.data.message, backgroundColor: "green" }).showToast();
                bootstrap.Modal.getInstance(document.getElementById('updateDepartmentModal')).hide();
                loadDepartments();
            })
            .catch(err => {
                Toastify({ text: err.response?.data?.message || "Update failed", backgroundColor: "red" }).showToast();
            });
    });
});
</script>
