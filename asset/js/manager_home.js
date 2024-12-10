new DataTable('#category_manager_home');

function confirmDelete(id) {
    if (confirm("Bạn có chắc chắn muốn xóa tour này?"))
    {
        window.location.href = "/Tour_management/modules/tour_manager/index.php?a=delete&id=" + id;
    }
}