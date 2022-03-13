$(document).ready(function () {
    /*
     * Create:zayar(2022/01/13)
     * Update:
     * This function is used show confirm alert to delete.
     */
    $("#delete").click(function (event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            backdrop: false,
            showDenyButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            denyButtonText: `Cancel`,
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
