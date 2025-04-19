<!-- Delete Modal -->
<div class="modal fade" id="deleteDepartmentModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="deleteDepartmentForm">
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this department?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" type="submit">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.body.addEventListener('click', function (e) {
        if (e.target.classList.contains('deleteBtn')) {
            const id = e.target.dataset.id;
            document.querySelector('#deleteDepartmentForm [name="id"]').value = id;
            const modal = new bootstrap.Modal(document.getElementById('deleteDepartmentModal'));
            modal.show();
        }
    });

    document.getElementById('deleteDepartmentForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        axios.post('{{ route('department.delete') }}', formData)
            .then(res => {
                Toastify({ text: res.data.message, backgroundColor: "green" }).showToast();
                bootstrap.Modal.getInstance(document.getElementById('deleteDepartmentModal')).hide();
                loadDepartments();
            })
            .catch(err => {
                Toastify({ text: err.response?.data?.message || "Delete failed", backgroundColor: "red" }).showToast();
            });
    });
});
</script>
