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
    $("#buttonSlider").click(function () {
        initial();
        console.log($("#buttonStatus").val());
    });

    function initial() {
        $("#validateInteger").hide();
        if ($("#validate").is(":checked")) {
            $("#validateInteger").val(1);
        } else $("#validateInteger").val(0);

        if ($("#buttonSlider").is(":checked")) {
            $("#buttonStatus").val(1);
            $("#buttonDiv").removeClass("buttonDiv");
        } else {
            $("#buttonStatus").val(0);
            $("#buttonDiv").addClass("buttonDiv");
        }
    }
    /*
     * Create:zayar(2022/04/12)
     * Update:
     * This function is used to show chosen image.
     */
    var Element = $("#sliderImage");
    var img = $("#chosenImage");
    Element.change(function (e) {
        $(".sliderImageShow").css("visibility", "visible");
        var inputFile = e.target.files[0];
        var url = window.URL.createObjectURL(inputFile);
        img.attr("src", url);
    });
});
