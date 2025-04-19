<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Employee List</span>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createEmployeeModal">
            + Add Employee
        </button>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="employeeTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
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
    loadEmployees();

    function loadEmployees() {
        axios.get('{{ route("employee.list") }}')
            .then(res => {
                const rows = res.data.data.map(emp => `
                    <tr>
                        <td>${emp.id}</td>
                        <td>${emp.name}</td>
                        <td>${emp.email}</td>
                        <td>${emp.department?.name ?? 'N/A'}</td>
                        <td>
                            <button class="btn btn-sm btn-warning editBtn"
                                data-id="${emp.id}"
                                data-name="${emp.name}"
                                data-email="${emp.email}"
                                data-department="${emp.department_id}">
                                Edit
                            </button>
                            <button class="btn btn-sm btn-danger deleteBtn" data-id="${emp.id}">
                                Delete
                            </button>
                        </td>
                    </tr>
                `).join('');
                document.querySelector('#employeeTable tbody').innerHTML = rows;
            })
            .catch(() => {
                Toastify({ text: "Failed to load employees", backgroundColor: "red" }).showToast();
            });
    }
});
</script>
