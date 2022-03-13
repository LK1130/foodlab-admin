const main = document.getElementById('mainimg');

$(document).ready(function() {
    $('.count').prop('disabled', true);
    
 /*
 * Create : Aung Min Khant(27/1/2022)
 * Update :
 * Explain of function : when user click plus and minus amount
 * Prarameter : no
 * return : count value
 */

    $(document).on('click', '.plus', function() {

        if ($('.counts').val() < 9) {
            $('.counts').val(parseInt($('.counts').val()) + 1);

        }
        console.log($('.counts').val());
    });
    $(document).on('click', '.minus', function() {
        $('.counts').val(parseInt($('.counts').val()) - 1);
        if ($('.counts').val() == 0) {
            $('.counts').val(1);
        }
    });

    let count = 0;
    $('.btns').click(function(e) {

        let text = $('#count').text();
        
        $('#count').text($('.count').val());
        e.preventDefault();
    })


 /*
 * Create : Aung Min Khant(29/1/2022)
 * Update :
 * Explain of function : when user click get selected and checkvalue send with ajax to cart
 * Prarameter : no
 * return : form data
 */
    $(".buy").click(function(e) {


        clickCount();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });
       
        

        let status = [];
        let values = [];

        let text;
        let allLabels = [];

        $('.ptop').each(function() {
            allLabels.push($(this).text());
        });

        //check value 
        $('input[type=checkbox]:checked').each(function() {
            text = $(this).parent().parent().prev().find('.ptop').text();
            status = this.checked ? $(this).val() : "";


            for (let index = 0; index < allLabels.length; index++) {
                if (allLabels[index] == text) {
                    var obj = {
                        label: text,
                        value: status
                    };

                    values.push(obj);

                }
            }

        });
        // selected value
        $("select option:selected").each(function() {
            text = $(this).parent().parent().parent().prev().find('.ptop').text();
            status = this.selected ? $(this).val() : "";

            for (let index = 0; index < allLabels.length; index++) {
                if (allLabels[index] == text) {

                    var obj = {
                        label: text,
                        value: status
                    };

                    values.push(obj);

                }
            }

        });
        const sessionValue = [];
        // obj array looping
        values.forEach(function(item) {
            var existing = sessionValue.filter(function(v, i) {
                return v.label == item.label;
            })
            if (existing.length) {
                var existingIndex = sessionValue.indexOf(existing[0]);
                sessionValue[existingIndex].value = sessionValue[existingIndex].value.concat(',', item.value)
            } else {
                if (typeof item.value == 'String')
                    item.value = [item.value];
                sessionValue.push(item);
            }
        })

        var formdata = { "pid": Number(pid), "q": Number($("#qty").val()), "value": sessionValue };
        $.ajax({
            type: "POST",
            url: "cartsession",
            data: { data: formdata },
            success: function(data) {
                console.log(data);
            },
            error: function(data) {
                console.error(data);
            }
        });
    });
});


/*
 * Create : Aung Min Khant(30/1/2022)
 * Update :
 * Explain of function : To change image main photo 
 * Prarameter : no
 * return : change image src
 */
function changeImage(img) {

    let temp  = main.src;
    if(img.src != window.location.href){
        main.src = img.src;
        img.src = temp;
    }

}

function clickCount(){
        
    console.log(sessionStorage.clickcount);
    if (sessionStorage.clickcount) {
        sessionStorage.clickcount = Number(sessionStorage.clickcount) + 1;
      } else {
        sessionStorage.clickcount = 1;
        }
        $('.cartcount').text(sessionStorage.clickcount);
  
    };