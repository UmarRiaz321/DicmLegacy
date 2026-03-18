$(function(){
  var current_fs, next_fs, previous_fs; //fieldsets
  var left, opacity, scale; //fieldset properties which we will animate
  var animating = false; //flag to prevent quick multi-click glitches
  var kids = $(".msform").children();

  $(".backToSum").hide();
  // go next 

  $('.next').on("click" , function(){


    if (animating) return false;
    animating = true;

    let id = $(this).attr('id');
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();


    // $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");;
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate(
        {
          opacity: 0
        },
        {
          step: function (now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale current_fs down to 80%
            scale = 1 - (1 - now) * 0.2;
            //2. bring next_fs from the right(50%)
            left = now * 50 + "%";
            //3. increase opacity of next_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({
              transform: "scale(" + scale + ")",
              // position: "absolute"
            });
            next_fs.css({
              left: left,
              opacity: opacity
            });
          },
          duration: 200,
          complete: function () {
            current_fs.hide();
            animating = false;
          },
          //this comes from the custom easing plugin
          easing: "easeInOutBack"
        }
    );
   
  })

  // Go Back 

  $('.previous').on('click',function(){

    if (animating) return false;
    animating = true;
    let id = $(this).attr('id');
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();

    //de-activate current step on progressbar
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    //show the previous fieldset
    previous_fs.show();
    current_fs.hide();
   // hide current with style
   current_fs.animate(
    {
      opacity: 0
    },
    {
      step: function (now, mx) {
        //as the opacity of current_fs reduces to 0 - stored in "now"
        //1. scale previous_fs from 80% to 100%
        scale = 0.8 + (1 - now) * 0.2;
        //2. take current_fs to the right(50%) - from 0%
        left = (1 - now) * 50 + "%";
        //3. increase opacity of previous_fs to 1 as it moves in
        opacity = 1 - now;
        current_fs.css({
          left: left
        });
        previous_fs.css({
          transform: "scale(" + scale + ")",
          opacity: opacity
        });
      },
      duration: 800,
      complete: function () {
        // current_fs.hide();
        animating = false;
      },
      //this comes from the custom easing plugin
      easing: "easeInOutBack"
    }
  );

    $("html, body").animate({
      scrollTop: 0
    }, 300);
  });


  // ReviwToOrgInfo

  $('.edit').on('click',function(){

    let id = $(this).attr('id');
    var infoNumber =0 ;
    switch(id){
      case "editorginfo":
        previous_fs = $("#OrgDetails");
        infoNumber = 2;
        break;
      case "editMcInfo":
        previous_fs = $("#MainContact");
        infoNumber = 3;
        break;
      case "editProInfo":
        previous_fs = $("#ProjectDetail");
        infoNumber = 4;
        break;
      case "editSocialsInfo":
        previous_fs = $("#SocialsDetail");
        infoNumber = 5;
        break;
    case "editspoorginfo":
      previous_fs = $("#SpoOrgDetails");
      infoNumber = 2;
      break;
    case "editspoMcInfo":
      previous_fs = $("#SpoMainContact");
      infoNumber = 3;
      break;
    case "editaccountInfo":
      previous_fs = $("#SpoAccountDetail");
      infoNumber = 4;
      break;
    case "editSpoSocialsInfo":
      previous_fs = $("#SpoSocialsDetail");
      infoNumber = 5;
      break;
    // For Enablers
    case "editenaorginfo":
      previous_fs = $("#EnaOrgDetails");
      infoNumber = 2;
      break;
    case "editenaMcInfo":
      previous_fs = $("#EnaMainContact");
      infoNumber = 3;
      break;
    case "editoccInfo":
      previous_fs = $("#EnaConDetails");
      infoNumber = 4;
      break;
    case "editEnaSocialsInfo":
      previous_fs = $("#EnaSocialsDetail");
      infoNumber = 5;
      break;
 
      default:
       break;
    }
    BackToInfo(infoNumber,previous_fs);
    
  })

  // Infos To Review
  $(".backToSum").on('click', function(){
    let id = $(this).attr("id");
    var infoNumber =0 ;
    switch(id){
      case "secondToReview":
        current_fs = $("#OrgDetails");
        infoNumber = 2;
        break;
      case "thirdToReview":
        current_fs = $("#MainContact");
        infoNumber = 3;
        break;
      case "fourthToReview":
        current_fs = $("#ProjectDetail");
        infoNumber = 4;
        break;
      case "fifthToReview":
        current_fs = $("#SocialsDetail");
        infoNumber = 5;
        break;
      // For Sponsors
      case "sposecondToReview":
        current_fs = $("#SpoOrgDetails");
        infoNumber = 2;
        break;
        // SpoMainContact
      case "spothirdToReview":
        current_fs = $("#SpoMainContact");
        infoNumber = 3;
        break;
      case "spofourthToReview":
        current_fs = $("#SpoAccountDetail");
        infoNumber = 4;
        break;
      case "spofifthToReview":
        current_fs = $("#SpoSocialsDetail");
        infoNumber = 5;
        break;
      
      // For Enablers
      case "enasecondToReview":
        current_fs = $("#EnaOrgDetails");
        infoNumber = 2;
        break;
        // SpoMainContact
      case "enathirdToReview":
        current_fs = $("#EnaMainContact");
        infoNumber = 3;
        break;
      case "enafourthToReview":
        current_fs = $("#EnaConDetails");
        infoNumber = 4;
        break;
      case "enafifthToReview":
        current_fs = $("#EnaSocialsDetail");
        infoNumber = 5;
        break;
      default:
        break;
    }

    BackToR(infoNumber,current_fs)

  })



  var BackToInfo=function(infoNumber,previous_fs){

   
    if (animating) return false;
    animating = true;
    current_fs = $("#ReviewDetails");
    for (var i=infoNumber+1; i<=6;i++) {
      if($("#progressbar li").eq($("fieldset").index(kids[i])).hasClass('active')){
        $("#progressbar li").eq($("fieldset").index(kids[i])).removeClass("active");
      }
    }
    
    previous_fs.show();

    goBack(current_fs);
    $(".backToSum").show();

  }

  var BackToR = function(infoNumber,current_fs){

    if (animating) return false;
    animating = true;
    next_fs = $("#ReviewDetails");
   
    for (var i=infoNumber; i<=6;i++) {
      if(!$("#progressbar li").eq($("fieldset").index(kids[i])).hasClass('active')){
        $("#progressbar li").eq($("fieldset").index(kids[i])).addClass("active");
      }
    }

    next_fs.show();

    goNext(current_fs);
    $(".backToSum").hide();

  }

  // go Next

  var goNext=function(current_fs){
    current_fs.animate(
      {
        opacity: 0
      },
      {
        step: function (now, mx) {
          //as the opacity of current_fs reduces to 0 - stored in "now"
          //1. scale current_fs down to 80%
          scale = 1 - (1 - now) * 0.2;
          //2. bring next_fs from the right(50%)
          left = now * 50 + "%";
          //3. increase opacity of next_fs to 1 as it moves in
          opacity = 1 - now;
          current_fs.css({
            transform: "scale(" + scale + ")",
            // position: "absolute"
          });
          next_fs.css({
            left: left,
            opacity: opacity
          });
        },
        duration: 800,
        complete: function () {
          current_fs.hide();
          animating = false;
        },
        //this comes from the custom easing plugin
        easing: "easeInOutBack"
      }
  );

  }

  // go Back

  var goBack=function(current_fs){

    current_fs.animate(
      {
        opacity: 0
      },
      {
        step: function (now, mx) {
          //as the opacity of current_fs reduces to 0 - stored in "now"
          //1. scale previous_fs from 80% to 100%
          scale = 0.8 + (1 - now) * 0.2;
          //2. take current_fs to the right(50%) - from 0%
          left = (1 - now) * 50 + "%";
          //3. increase opacity of previous_fs to 1 as it moves in
          opacity = 1 - now;
          current_fs.css({
            left: left
          });
          previous_fs.css({
            transform: "scale(" + scale + ")",
            opacity: opacity
          });
        },
        duration: 800,
        complete: function () {
          current_fs.hide();
          animating = false;
        },
        //this comes from the custom easing plugin
        easing: "easeInOutBack"
      }
    );



  }



})