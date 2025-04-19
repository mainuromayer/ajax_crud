<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Department List</span>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createDepartmentModal">
            + Add Department
        </button>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="departmentTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th width="15%">Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- Dynamic Content --}}
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    loadDepartments();

    function loadDepartments() {
        axios.get('{{ route("department.list") }}')
            .then(res => {
                const rows = res.data.data.map(d => `
                    <tr>
                        <td>${d.id}</td>
                        <td>${d.name}</td>
                        <td>
                            <button class="btn btn-sm btn-warning editBtn" data-id="${d.id}" data-name="${d.name}">Edit</button>
                            <button class="btn btn-sm btn-danger deleteBtn" data-id="${d.id}">Delete</button>
                        </td>
                    </tr>
                `).join('');
                document.querySelector('#departmentTable tbody').innerHTML = rows;
            })
            .catch(() => {
                Toastify({ text: "Failed to load departments", backgroundColor: "red" }).showToast();
            });
    }
});
</script>
