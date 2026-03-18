
var addToReview = function(Fid,tbid){

    
   
    if(Fid =="EnaConDetails"){
      addHeadsContacts(Fid,tbid);
    }
    if(Fid =="SpoAccountDetail"){
      addAccountDetails(Fid,tbid);
    }
    else{
      if(Fid === "ProjectDetail"){
        addProjectSummaries(tbid);
        return;
      }
      var McInfo =[];
      McInfo.splice(0, McInfo.length);
      tbid.empty();
      var divElem = document.getElementById(Fid);
      var inputElements = divElem.querySelectorAll("input, select, textarea");
      $.each(inputElements, function () {

          var input = $(this);
          var name = input.parent().find(".nl").text().slice(0, -1);
          var value = input.val();
          if(value.includes('<script>') || value.includes('</script>') ){
            value = '';
          }
          var item = {};
          if (name && value != "") {
            if (Array.isArray(value)) {
              item["Name"] = name;
              var v = "";
              for (var i = 0; i <= value.length; i++) {
                if (value[i] != undefined) {
                  v += value[i] + " ;";
                }
              }
              item["Value"] = v.slice(0, -1);
              McInfo.push(item);
            } else if ($(input).hasClass("error")) {      
              let message =   input.parent().find(".error").text().slice(0, -1);
                tbid.append(`
                  <tr class="table-danger">
                  <td class="text-start"><b>${name}</b></td>
                  <td colspan ="4"  class="text-start" style="white-space:wordwrap !imortant; width:100%;">${message}</td>
                  </tr>
                `);
            }
            else {
              item["Name"] = name;
              item["Value"] = value;
              McInfo.push(item);
            }
          }
          else if (input.prop("required")) {
              tbid.append(`
              <tr class="table-danger">
                  <td class="text-start"><b>${name}</b></td>
                  <td colspan ="4"  class="text-start" style="white-space:wordwrap !imortant; width:100%;">This field is required.</td>
              </tr>
          `);
          }

      })

      McInfo.forEach(function (e) {
          tbid.append(`
              <tr>
                    <td class="text-start "><b>${e.Name}</b></td>
                    <td colspan ="4"  class="text-start" style="white-space:wordwrap !imortant; width:100%;">${e.Value}</td>
              </tr>
          `);
        });
  }

}

var addProjectSummaries = function(tbid){
  tbid.empty();
  var cards = $('#ProjectDetail .project-card');
  if (!cards.length) {
    return;
  }

  cards.each(function(idx, card){
    tbid.append(`
      <tr>
        <td colspan="6" class="text-center fw-bold">Project ${idx + 1}</td>
      </tr>
    `);
    var inputs = $(card).find("input, select, textarea").filter(function(){
      return $(this).attr('type') !== 'file' && !$(this).hasClass('remove-project');
    });

    inputs.each(function(){
      var input = $(this);
      var name = input.closest('.form-group').find('.nl').text().replace(/:\s*$/, '');
      var value = input.val();

      if (Array.isArray(value)) {
        value = value.filter(function(v){ return v !== ''; }).join(' ; ');
      }

      if (typeof value === 'string' && value.includes('<script')) {
        value = '';
      }

      if (!name || value === null || value === '' || input.is(':hidden')) {
        return;
      }

      tbid.append(`
        <tr>
          <td class="text-start"><b>${name}</b></td>
          <td colspan="4" class="text-start">${value}</td>
        </tr>
      `);
    });
  });
}

var addHeadsContacts =function(Fid,tbid){

  var HPRM =[];
  var HPRO =[];
  var HMAR =[];
  var HPRME =[];
  var HPROE =[];
  var HMARE =[];
  HPRM.splice(0, HPRM.length);
  HMAR.splice(0, HMAR.length);
  HPRO.splice(0, HPRO.length);
  HPRME.splice(0, HPRME.length);
  HMARE.splice(0, HMARE.length);
  HPROE.splice(0, HPROE.length);
  tbid.empty();

  var divElem = document.getElementById(Fid);
  var inputElements = divElem.querySelectorAll("input, select, textarea");
  $.each(inputElements, function () {

    var input = $(this);
    let legend = input.parent().closest('.row').children('legend:first').text();
    var name = input.parent().find(".nl").text().slice(0, -1);
    var value = input.val();
    if(value.includes('<script>') || value.includes('</script>') ){
      value = '';
    }
    var item = {};
    if (name && value != "") {
      if (Array.isArray(value)) {
        item["Name"] = name;
        var v = "";
        for (var i = 0; i <= value.length; i++) {
          if (value[i] != undefined) {
            v += value[i] + " ;";
          }
        }
        item["Value"] = v.slice(0, -1);
        if(legend == "Head of PR and Media"){HPRM.push(item);}else if(legend == "Head of Marketing"){HMAR.push(item);}else{HPRO.push(item)}
        
      } else if ($(input).hasClass("error")) {      
        let message =   input.parent().find(".error").text().slice(0, -1);
        item["Name"] = name;
        item["Value"] = message;
        if(legend == "Head of PR and Media"){HPRME.push(item);}else if(legend == "Head of Marketing"){HMARE.push(item);}else{HPROE.push(item)}
      }
      else {
        item["Name"] = name;
        item["Value"] = value;
        if(legend == "Head of PR and Media"){HPRM.push(item);}else if(legend == "Head of Marketing"){HMAR.push(item);}else{HPRO.push(item)}
      }
    }




  })

  if (HPRM && HPRM.length) {
    tbid.append(`
      <tr>
            <td colspan ="6"  class="text-center" style="white-space:wordwrap !imortant; width:100%;">Head of PR and Media</td>
      </tr>
    `);
     HPRM.forEach(function (e) {
      tbid.append(`
          <tr>
                <td class="text-start "><b>${e.Name}</b></td>
                <td colspan ="4"  class="text-start" style="white-space:wordwrap !imortant; width:100%;">${e.Value}</td>
          </tr>
      `);
    });
    if (HPRME && HPRME.length) {
      HPRME.forEach(function (e) {
        tbid.append(`
            <tr class="table-danger">
              <td class="text-start"><b>${name}</b></td>
              <td colspan ="4"  class="text-start" style="white-space:wordwrap !imortant; width:100%;">${e.Value}</td>
            </tr>
        `);
      });

    }

  }

  if (HMAR && HMAR.length) {
    tbid.append(`
      <tr>
            <td colspan ="6"  class="text-center" style="white-space:wordwrap !imortant; width:100%;">Head of Marketing</td>
      </tr>
    `);
    HMAR.forEach(function (e) {
      tbid.append(`
          <tr>
                <td class="text-start "><b>${e.Name}</b></td>
                <td colspan ="4"  class="text-start" style="white-space:wordwrap !imortant; width:100%;">${e.Value}</td>
          </tr>
      `);
    });
    if (HMARE && HMARE.length) {
      HMARE.forEach(function (e) {
        tbid.append(`
            <tr class="table-danger">
              <td class="text-start"><b>${name}</b></td>
              <td colspan ="4"  class="text-start" style="white-space:wordwrap !imortant; width:100%;">${e.Value}</td>
            </tr>
        `);
      });

    }

  }
  if (HPRO && HPRO.length) {
    tbid.append(`
      <tr>
            <td colspan ="6"  class="text-center" style="white-space:wordwrap !imortant; width:100%;">Head of Procurement</td>
      </tr>
    `);
    HPRO.forEach(function (e) {
      tbid.append(`
          <tr>
                <td class="text-start "><b>${e.Name}</b></td>
                <td colspan ="4"  class="text-start" style="white-space:wordwrap !imortant; width:100%;">${e.Value}</td>
          </tr>
      `);
    });
    if (HPROE && HPROE.length) {
      HPROE.forEach(function (e) {
        tbid.append(`
            <tr class="table-danger">
              <td class="text-start"><b>${name}</b></td>
              <td colspan ="4"  class="text-start" style="white-space:wordwrap !imortant; width:100%;">${e.Value}</td>
            </tr>
        `);
      });

    }

  }


}

var addAccountDetails =function(Fid,tbid){
  var AccountInfo =[];
  var AccError =[];
  var MarketingInfo =[];
  var MarketingError =[];  
  AccountInfo.splice(0, AccountInfo.length);
  MarketingInfo.splice(0, MarketingInfo.length);
  AccError.splice(0, AccError.length);
  MarketingError.splice(0, MarketingError.length);
  tbid.empty();
  var divElem = document.getElementById(Fid);
  var inputElements = divElem.querySelectorAll("input, select, textarea");

  $.each(inputElements, function () {

    var input = $(this);
    let legend = input.parent().closest('.row').children('legend:first').text();
    var name = input.parent().find(".nl").text().slice(0, -1);
    var value = input.val();
    if(value.includes('<script>') || value.includes('</script>') ){
      value = '';
    }

    var item = {};
    if (name && value != "") {
      if (Array.isArray(value)) {
        item["Name"] = name;
        var v = "";
        for (var i = 0; i <= value.length; i++) {
          if (value[i] != undefined) {
            v += value[i] + " ;";
          }
        }
        item["Value"] = v.slice(0, -1);
        if(legend == "Accounts"){AccountInfo.push(item);}else{MarketingInfo.push(item)}
        
      } else if ($(input).hasClass("error")) {
        let message =   input.parent().find(".error").text().slice(0, -1);
        item["Name"] = name;
        item["Value"] = message;
        if(legend == "Accounts"){AccError.push(item);}else{MarketingError.push(item)}
      }
      else {
        item["Name"] = name;
        item["Value"] = value;
        if(legend == "Accounts"){AccountInfo.push(item);}else{MarketingInfo.push(item)}
      }
    }
    else if (input.prop("required")) {

      let message =  "This field is required.";
      item["Name"] = name;
      item["Value"] = message;
      if(legend == "Accounts"){AccError.push(item);}else{MarketingError.push(item)}
    }
  });

  if (AccountInfo && AccountInfo.length || AccError && AccError.length) {
    tbid.append(`
      <tr>
            <td colspan ="6"  class="text-center" style="white-space:wordwrap !imortant; width:100%;">Accounts</td>
      </tr>
    `);
    AccountInfo.forEach(function (e) {
      tbid.append(`
          <tr>
                <td class="text-start
                "><b>${e.Name}</b></td>
                <td colspan ="4"  class="text-start
                " style="white-space:wordwrap !imortant; width:100%;">${e.Value}</td>
          </tr>
      `);
    });
    if (AccError && AccError.length) {
      AccError.forEach(function (e) {
        tbid.append(`
            <tr class="table-danger">
              <td class="text-start"><b>${e.Name}</b></td>
              <td colspan ="4"  class="text-start" style="white-space:wordwrap !imortant; width:100%;">${e.Value}</td>
            </tr>
        `);
      });

    }
  }
  if (MarketingInfo && MarketingInfo.length || MarketingError && MarketingError.length) {
    // tbid.append(`
    //   <tr>
    //         <td colspan ="6"  class="text-center" style="white-space:wordwrap !imortant; width:100%;">Marketing</td>
    //   </tr>
    // `);
    MarketingInfo.forEach(function (e) {
      tbid.append(`
          <tr>
                <td class="text-start"><b>${e.Name}</b></td>
                <td colspan ="4"  class="text-start
                " style="white-space:wordwrap !imortant; width:100%;">${e.Value}</td>
          </tr>
      `); 
    });
    if (MarketingError && MarketingError.length) {
      MarketingError.forEach(function (e) {
        tbid.append(`
            <tr class="table-danger">
              <td class="text-start"><b>${e.Name}</b></td>
              <td colspan ="4"  class="text-start "style="white-space:wordwrap !imortant; width:100%;">${e.Value}</td>
            </tr>
        `);
      });
    }
  }

}
