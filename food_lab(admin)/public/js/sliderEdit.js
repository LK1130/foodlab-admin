$(document).ready(function () {
    initial();
    onChange();

    function onChange() {
        $("#buttonSlider").click(function () {
            initial();
            console.log($("#buttonStatus").val());
        });
    }
    function initial() {
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
        var inputFile = e.target.files[0];
        var url = window.URL.createObjectURL(inputFile);
        console.log(url);
        img.attr("src", url);
    });
});
