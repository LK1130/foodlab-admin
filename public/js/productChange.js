/*
 * Create : Aung Min Khant(29/1/2022)
 * Update :
 * Explain of function : To change product category with type
 * Prarameter : no
 * return :
 */
$(document).ready(function () {
    $('.typebtns').hide();
    $('.tastebtns').hide();
    $("#selectpicker1").unbind().change(function (e) {
       
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });
        e.preventDefault();
        var formdata = { type: $("#selectpicker1").val() };
        let id = $('#selectpicker1').val();
        let newUrl = `menutype?id=${id}`;
        $('#typetag').attr('href',newUrl);
        $.ajax({
            type: "POST",
            url: "searchCategory",
            data: formdata,
            dataType: "json",
            beforeSend: function(){
                $('#byCategory').empty();
                $("#byCategory").hide('slow');
            },
            success: function (data) {
                
                $("#byCategory").empty();
                let count = 0;
                $('#byCategory').show('slow');
                if(data.length == 0){
                    $('#byCategory').append(`
                        <div class="d-flex justify-content-center align-items-center p-3"
                                <p >There is no food in this category. We will announce later.</p>
                        </div>
                    `);
                }

                for (const list of data) {
                    if(count < 4){
                        let amount = numberWithCommas(list.amount);
                       if(customerId){
                        $('#byCategory').append(
                            `<div class="col-md-3 col-sm-3 d-flex flex-column justify-content-center align-items-center m-auto my-3 fw-bold py-5">
                            <div class="image-container">
                            <img src="/storage/${list.path}" class=" images" alt="bestitem1" />
                            </div>
                            <p class="fs-3 pt-2">${ list.product_name }</p>
                            <p class="fs-5"><i class="fas fa-coins pe-2 coins"></i>${ list.coin } </br> <p> <i class="fa-solid fa-money-bill money text-success"></i> ${amount} MMK</p>
                            <a href="productDetail?id=${ list.link_id }"><button type="button" class="btn detailbtns"> More Details</button></a>
                            <button type="button" id="${list.link_id}" class="btn shopbtns shopcart" data-bs-toggle="modal" data-bs-target="#modal" > Shop Now</button>
                            </div>`)
                       }else{
                        $('#byCategory').append(
                            `<div class="col-md-3 col-sm-3 d-flex flex-column justify-content-center align-items-center m-auto my-3 fw-bold py-5">
                            <div class="image-container">
                            <img src="/storage/${list.path}" class=" images" alt="bestitem1" />
                            </div>
                            <p class="fs-3 pt-2">${ list.product_name }</p>
                            <p class="fs-5"><i class="fas fa-coins pe-2 coins"></i>${ list.coin } </br> <p> <i class="fa-solid fa-money-bill money text-success"></i> ${amount} MMK</p>
                            <a href="productDetail?id=${ list.link_id }"><button type="button" class="btn detailbtns"> More Details</button></a>
                            <a href="/signin"><button type="button" class="btn shopbtns"> Shop Now</button></a> 
                            </div>`)
                       }
                        
                    }

                    
                    count++;
                
                    if(count > 4){
                        $('.typebtns').show('slow');
                    
                    }else{
                        $('.typebtns').hide('slow');
                    }
                }
                if(count == 0 ){
                    $('.typebtns').hide('slow');
                }
               
                
                $('.shopcart').click(function(e) {

                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });
                    e.preventDefault();
                    let count = 1;
                    let formdata = { "pid": Number(e.target.id), "q": Number(count) };
            
                    $.ajax({
                        type: "POST",
                        url: "sessionCount",
                        data: { data: formdata },
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
            
            
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
            
                });
            },
            error: function(data){
                console.log(data);
            }
        });

       
    });

    

  
      
    /*
     * Create : Aung Min Khant(29/1/2022)
     * Update :
     * Explain of function : To change product taste 
     * Prarameter : no
     * return :
     */
    $("#selectpicker2").unbind().change(function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });
        e.preventDefault();
        var formdata = { type: $("#selectpicker2").val() };
        let id = $('#selectpicker2').val();
        let newUrl = `menutaste?id=${id}`;
        $('#tastetag').attr('href',newUrl);
        $.ajax({
            type: "POST",
            url: "searchTaste",
            data: formdata,
            dataType: "json",
            beforeSend: function(){
                $('#byTaste').empty();
                $("#byTaste").hide('slow');
            },
            success: function (data) {
                $("#byTaste").empty();
                let count = 0;
            
                $('#byTaste').show('slow');
                if(data.length == 0){
                    $('#byTaste').append(`
                        <div class="d-flex justify-content-center align-items-center p-3"
                                <p >There is no food in this category. We will announce later.</p>
                        </div>
                    `);
                }
                for (const list of data) {
                    if(count < 4){
                        let amount = numberWithCommas(list.amount);
                        if(customerId){
                        $('#byTaste').append(
                            `<div class="col-md-3 col-sm-3 d-flex flex-column justify-content-center align-items-center m-auto my-3 fw-bold py-5">
                            <div class="image-container">
                            <img src="/storage/${list.path}" class="img-fluid images" alt="bestitem1" />
                            </div>
                            <p class="fs-3 pt-2">${ list.product_name }</p>
                            <p class="fs-5"><i class="fas fa-coins pe-2 coins"></i>${ list.coin } </br> <p> <i class="fa-solid fa-money-bill money text-success"></i> ${amount} MMK</p>
                            <a href="productDetail?id=${ list.link_id }"><button type="button" class="btn detailbtns"> More Details</button></a>
                            <button type="button" id="${list.link_id}" class="btn shopbtns shopcart" data-bs-toggle="modal" data-bs-target="#modal" > Shop Now</button>
                        </div>`
                        )
                        }else{
                            $('#byTaste').append(
                                `<div class="col-md-3 col-sm-3 d-flex flex-column justify-content-center align-items-center m-auto my-3 fw-bold py-5">
                                <div class="image-container">
                                <img src="/storage/${list.path}" class="img-fluid images" alt="bestitem1" />
                                </div>
                                <p class="fs-3 pt-2">${ list.product_name }</p>
                                <p class="fs-5"><i class="fas fa-coins pe-2 coins"></i>${ list.coin } </p> </br> <p> <i class="fa-solid fa-money-bill money text-success"></i> ${amount} MMK</p>
                                <a href="productDetail?id=${ list.link_id }"><button type="button" class="btn detailbtns"> More Details</button></a>
                                <a href="/signin"><button type="button" class="btn shopbtns"> Shop Now</button></a> 
                            </div>`
                            )
                        }
                    }
                    count++;
                    if(count > 4){
                        $('.tastebtns').show('slow');
                    
                    }else{
                        $('.tastebtns').hide('slow');
                    }
                   
                }
                if(count == 0 ){
                    $('.typebtns').hide('slow');
                }
              
                console.log(count);

                $('.shopcart').click(function(e) {

                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });
                    e.preventDefault();
                    let count = 1;
                    let formdata = { "pid": Number(e.target.id), "q": Number(count) };
            
                    $.ajax({
                        type: "POST",
                        url: "sessionCount",
                        data: { data: formdata },
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
            
            
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
            
                });
               
            },
            error: function(data){
                console.log(data);
            }
            
        });
    });


   
});

function numberWithCommas(x) {
    return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
}