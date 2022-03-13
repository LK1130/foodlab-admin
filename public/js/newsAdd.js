$(document).ready(function () {
    initial();
    onChange();
    /*
     * Create:zayar(2022/01/13)
     * Update:
     * This function is used to toggle the App Management and Site Management.
     */
    function initial() {
        var category = $("#category").val();
        $("#idhide").val(category);
        console.log($("#idhide").val());
    }

    /*
     * Create:zayar(2022/01/13)
     * Update:
     * This function is used to toggle the App Management and Site Management.
     */
    function onChange() {
        $("#category").change(function () {
            initial();
        });
    }
});
