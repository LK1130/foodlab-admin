
$(document).ready(function (e) {

    /*
    * Create : Aung Min Khant(17/1/2022)
    * Update :
    * Explain of function : When input tag keyup or keypress to disable enter 
    * return when keyup or kepress not equal false
    * */
    $(document).on('keyup keypress', 'input', function (e) {
      if (e.which == 13) {
        e.preventDefault();
        return false;
      }
    });
    /*
    * Create : Aung Min Khant(19/1/2022)
    * Update :
    * Explain of function : When coin input keypress calulate to amount
    * parameter : none 
    * return amount
    * */
  
    let rate = parseInt($('#rate').text());
    $('#coin').on('keyup keypress', function () {
      let coin = Math.abs(parseInt($('#coin').val()));
      //  console.lg
      if ($('#coin').val() === "") {
        console.log('hello');
        $('#rate').text('0 MMK');
      } else {
        $('#rate').text(coin * rate + " MMK");
  
      }
    });

  
  
    /*
   * Create : Aung Min Khant(17/1/2022)
   * Update :
   * Explain of function : When file change and show to product image  
   * parameter : none
   * return product image
   * */
    var photoOne = $("#photoone");
    var imgOne = $("#img1");
    photoOne.change(function (e) {
      var inputFile = e.target.files[0];
      var url = window.URL.createObjectURL(inputFile);
      imgOne.attr("src", url);
    });
  
    var photoTwo = $("#phototwo");
    var imgTwo = $("#img2");
    photoTwo.change(function (e) {
      var inputFile = e.target.files[0];
      console.log(inputFile);
      var url = window.URL.createObjectURL(inputFile);
      imgTwo.attr("src", url);
    });
  
    var photoThree = $("#photothree");
    var imgThree = $("#img3");
    photoThree.change(function (e) {
      var inputFile = e.target.files[0];
      console.log(inputFile);
      var url = window.URL.createObjectURL(inputFile);
      imgThree.attr("src", url);
    });
  
    var photoFour = $("#photofour");
    var imgFour = $("#img4");
    photoFour.change(function (e) {
      var inputFile = e.target.files[0];
      console.log(inputFile);
      var url = window.URL.createObjectURL(inputFile);
      imgFour.attr("src", url);
    });
  
    var photoFive = $("#photofive");
    var imgFive = $("#img5");
    photoFive.change(function (e) {
      var inputFile = e.target.files[0];
      console.log(inputFile);
      var url = window.URL.createObjectURL(inputFile);
      imgFive.attr("src", url);
    });
  
    var photoSix = $("#photosix");
    var imgSix = $("#img6");
    photoSix.change(function (e) {
      var inputFile = e.target.files[0];
      console.log(inputFile);
      var url = window.URL.createObjectURL(inputFile);
      imgSix.attr("src", url);
    });
  
    /*
   * Create : Aung Min Khant(17/1/2022)
   * Update :
   * Explain of function : When user click 'plusBox' append to appendBox div 
     parameter : no
     return : append data
   * */
  
    // To get id count 
    let count = 0;
  
    let countArray = [1,2,3,4,5,6];
  
    $(".plusBox").click(function () {
      let countDiv = document.getElementsByClassName('appendCount').length;
      count = countArray[0];
      
      console.log(count);
      disable(countDiv);
  
      if (countDiv < 6) {
        let input = `<div class="d-flex mt-3 appendCount deleteform">
            <div class="form-group d-flex mx-3">
                <label for="category" class="col-form-label titles1">Category</label>
            <select name="category${count}" id="category" class="form-select mx-2">
              
                <option value="1">Selected Box</option>
                <option value="2">Checked Box</option>
            </select>
            </div>
  
            <input type="text"  name="pdname${count}"  class="mx-3 col-sm-3 plabel${count}">
            <input type="text" class="inputtag"  name="pdvalue${count}"  value="" class="ms-3  form-control inputs${count}" data-role="tagsinput">
          
            <div class="mx-3 mt-3 delete" id=${count}><i class="fas fa-minus-circle minusIcon"></i></div>
        </div>
            `;
  
  
  
        $(".append").append(input);
        countArray.shift();
        console.log(countArray);
        // To delete form
        $('.delete').click(function (e) {
  
          $(this).closest(`.deleteform`).remove();
          let found = false;
          for (let int = 0; int < countArray.length; int++) if (countArray[int] == this.id) found = true;
          if (!found) {
            countDiv = document.getElementsByClassName('appendCount').length;
            countArray.push(parseInt(this.id));
            console.log(countDiv);
            enable(countDiv);
          }
        });
        (function ($) {
          "use strict";
          operate();
        })(window.jQuery);
      }
    });
    // To disable append button
    function disable(count) {
      if (count == 5) {
        $(".plusBox").css('visibility', 'hidden');
      }
  
    }
    // To enable append button
    function enable(count) {
      if (count < 6) {
        $(".plusBox").css('visibility', 'visible');
      }
    }
  
  
  });
  
  