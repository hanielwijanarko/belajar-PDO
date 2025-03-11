<?php

$host = 'localhost';
$db   = 'karyawan_db';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data Karyawan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Manajemen Data Karyawan</h2>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">Tambah Karyawan</button>
    <table id="employeeTable" class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Gaji</th>
        </tr>
        </thead>
        <tbody>
            <!-- Data akan dimuat dari PHP -->
        </tbody>
    </table>
</div>

<!-- Modal Tambah Karyawan -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="addEmployeeForm" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="text" name="name" class="form-control mb-2" placeholder="Nama" required>
                <input type="text" name="position" class="form-control mb-2" placeholder="Jabatan" required>
                <input type="decimal" name="gaji" class="form-control mb-2" placeholder="Gaji" required>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function () {
    const table = $('#employeeTable').DataTable({
        ajax: 'get_employees.php',
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'position' },
            { data: 'gaji' },
            {
                data: null,
                render: function (data) {
                    return `
                        <button class="btn btn-warning btn-sm edit" data-id="${data.id}">Edit</button>
                        <button class="btn btn-danger btn-sm delete" data-id="${data.id}">Hapus</button>
                    `;
                }
            }
        ]
    });

    $('#addEmployeeForm').submit(function (e) {
        e.preventDefault();
        $.post('add_employee.php', $(this).serialize(), function () {
            $('#addEmployeeModal').modal('hide');
            $('#addEmployeeForm')[0].reset();
            table.ajax.reload();
        });
    });

    $('#employeeTable tbody').on('click', '.delete', function () {
        const id = $(this).data('id');
        if (confirm('Yakin ingin menghapus?')) {
            $.post('delete_employee.php', { id }, function () {
                table.ajax.reload();
            });
        }
    });
});
</script>
</body>
</html>