$(document).ready(function () {
    /*
     * Create:zayar(2022/01/11)
     * Update:
     * This function is used to toggle the attribute of password.
     */
    initial();
    iconClick();
    function iconClick() {
        $("#icon").click(function () {
            let attribute = $("#password").attr("type");
            if (attribute == "password") {
                document
                    .getElementById("icon")
                    .setAttribute("name", "eye-outline");
                $("#password").attr("type", "text");
            } else {
                document
                    .getElementById("icon")
                    .setAttribute("name", "eye-off-outline");
                $("#password").attr("type", "password");
            }
        });
    }
    /*
     * Create:zayar(2022/02/01)
     * Update:
     * This function is used to check if valid checkbox is checked or not.
     */

    $("#validate").click(function () {
        initial();
        console.log($("#validateInteger").val());
    });

    function initial() {
        $("#validateInteger").hide();
        if ($("#validate").is(":checked")) {
            $("#validateInteger").val(1);
        } else $("#validateInteger").val(0);
    }
});
