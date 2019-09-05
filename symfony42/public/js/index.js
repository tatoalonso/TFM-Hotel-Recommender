
$( function() {
    $("#form_adult_2").change( function() {
        if ($("#form_adult_2").val() != "0") {
            $("#form_child_2").prop("disabled", false);
        } else {
            $("#form_child_2").prop("disabled", true);
        }
    });
});

$( function() {
    $("#form_child_2").change( function() {
        if ($("#form_child_2").val() != "0") {
            $("#form_child_ages_2").prop("disabled", false);
        } else {
            document.getElementById('form_child_ages_2').value = '';
            $("#form_child_ages_2").prop("disabled", true);
            $("#form_send").prop("disabled", false);
        }
    });
});

$( function() {
    $("#form_child_1").change( function() {
        if ($("#form_child_1").val() != "0") {
            $("#form_child_ages_1").prop("disabled", false);
        } else {
            document.getElementById('form_child_ages_1').value = '';
            $("#form_child_ages_1").prop("disabled", true);
            $("#form_send").prop("disabled", false);
        }
    });
});

$( function() {
    $("#form_child_ages_1").change( function() {
        var a = $("#form_child_ages_1").val()
        var arrayText = a.split(",");
        var lengthText = arrayText.length;
        var myArr = [ '1', '2', '3', '4', '5', '6', '7', '8' ,'9','10', '11', '12', '13', '14', '15', '16', '17' ];
        if ($("#form_child_1").val() != lengthText) {

            $("#form_send").prop("disabled", true);
            alert ("upsss");
        } else {
            $("#form_send").prop("disabled", false);
        }
        arrayText.forEach(function(element) {
            myArr.includes( element )
            if (! myArr.includes( element )){
                $("#form_send").prop("disabled", true);
                alert ("upsss");
            }
        });


    });
});