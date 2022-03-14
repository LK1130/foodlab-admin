
$(document).ready(function (e) {

  (function ($) {
    "use strict";
    operate();
  })(window.jQuery);
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

  disableAppendBox();

 
  /*
 * Create : Aung Min Khant(17/1/2022)
 * Update :
 * Explain of function : When file change and show to product image  
 * parameter : none
 * return product image
 * */
  var photoOne = $("#photo1");
  var imgOne = $("#img1");
  photoOne.change(function (e) {
    var inputFile = e.target.files[0];
    var url = window.URL.createObjectURL(inputFile);
    imgOne.attr("src", url);
    $('#hide1').val("");
  });

  var photoTwo = $("#photo2");
  var imgTwo = $("#img2");
  photoTwo.change(function (e) {
    var inputFile = e.target.files[0];
    console.log(inputFile);
    var url = window.URL.createObjectURL(inputFile);
    imgTwo.attr("src", url);
    $('#hide2').val("");
  });

  var photoThree = $("#photo3");
  var imgThree = $("#img3");
  photoThree.change(function (e) {
    var inputFile = e.target.files[0];
    console.log(inputFile);
    var url = window.URL.createObjectURL(inputFile);
    imgThree.attr("src", url);
    $('#hide3').val("");
  });

  var photoFour = $("#photo4");
  var imgFour = $("#img4");
  photoFour.change(function (e) {
    var inputFile = e.target.files[0];
    console.log(inputFile);
    var url = window.URL.createObjectURL(inputFile);
    imgFour.attr("src", url);
    $('#hide4').val("");
  });

  var photoFive = $("#photo5");
  var imgFive = $("#img5");
  photoFive.change(function (e) {
    var inputFile = e.target.files[0];
    console.log(inputFile);
    var url = window.URL.createObjectURL(inputFile);
    imgFive.attr("src", url);
    $('#hide5').val("");
  });

  var photoSix = $("#photo6");
  var imgSix = $("#img6");
  photoSix.change(function (e) {
    var inputFile = e.target.files[0];
    console.log(inputFile);
    var url = window.URL.createObjectURL(inputFile);
    imgSix.attr("src", url);
    $('#hide6').val("");
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

  let countArray = [];
  for (let index = startCount; index < 7; index++) {
        countArray.push(index);
    
  }

  $('.delete').on('click',function(){
    

        $(this).closest(`.deleteForm`).remove();
        let found = false;
        for (let int = 0; int < countArray.length; int++) if (countArray[int] == this.id) found = true;
        if (!found) {
          countDiv = document.getElementsByClassName('appendCount').length;
          countArray.push(parseInt(this.id));
          console.log(countDiv);
          enable(countDiv);
        }
      
  });

  $(".plusBox").click(function () {
    let countDiv = document.getElementsByClassName('appendCount').length;
    count = countArray[0];

    disable(countDiv);

    if (countDiv < 6) {
      let input = `<div class="d-flex mt-3 appendCount deleteForm">
          <div class="form-group d-flex mx-3">
              <label for="category" class="col-form-label titles">Category</label>
          <select name="category${count}" id="category" class="form-select mx-2">
           
              <option value="1">Selected Box</option>
              <option value="2">Checked Box</option>
          </select>
          </div>

          <input type="text"  name="pdname${count}"  class="mx-3 col-sm-3 plabel${count}">
          <input type="text" class="inputtag"  name="pdvalue${count}"  value="" class="ms-3  form-control inputs${count}" data-role="tagsinput">
        
          <div class="mx-3 mt-3 delete" id=${count}><i class="fas fa-minus-circle minusIcon" ></i></div>
      </div>
          `;



      $(".append").append(input);
      countArray.shift();
      // console.log(countArray);
      // To delete form
      $('.delete').click(function (e) {

        $(this).closest(`.deleteForm`).remove();
        let found = false;
        for (let int = 0; int < countArray.length; int++) if (countArray[int] == this.id) found = true;
        if (!found) {
          countDiv = document.getElementsByClassName('appendCount').length;
          countArray.push(parseInt(this.id));
          
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

  //to disable append box when append data is full
  function disableAppendBox(){
    let countDiv = document.getElementsByClassName('appendCount').length;
    if(countDiv == 6){  
      $(".plusBox").css('visibility', 'hidden');
    }else{
      $(".plusBox").css('visibility', 'visible');
    }
  }
});

