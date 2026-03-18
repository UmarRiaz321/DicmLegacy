$(function(){
    $(document).ready(function(){
        const initTable = (selector, config) => {
            const table = $(selector);
            if (!table.length) {
                return null;
            }
            return table.DataTable(config);
        };

        const ajaxConfig = (endpoint) => ({
            processing: false,
            serverSide: false,
            searching: false,
            ajax: {
                url: base_url + endpoint,
                type: 'GET'
            },
            dom: 'Bflrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            lengthChange: true,
            lengthMenu: [[10, 50, 100, -1], [10, 25, 50, "All"]]
        });

        initTable('#cse_table', ajaxConfig('fetchCse'));
        initTable('#spo_table', ajaxConfig('fetchSpo'));
        initTable('#ena_table', ajaxConfig('fetchEna'));
        initTable('#app_table', ajaxConfig('fetchApp'));
        initTable('#userapp_table', ajaxConfig('fetchUserApp'));

        initTable('#cseDetail_table', {
            searching: false,
            processing: false,
            serverSide: false,
            lengthChange: false,
        });


          $('#vCseModal').on('show.bs.modal', function (e) {

            var button = $(e.relatedTarget);
            var id = button.attr('data-bs-whatever');
            $.ajax({url: base_url+'cseDetail?id='+id ,
                type: 'GET',
                success: function(result){ 
                  $('#details').empty();
                  $('#csemc').empty();
                  $('#cseproject').empty();
                  $('#csesocials').empty();
                  let items = JSON.parse(result);
                  for (let [key, value] of Object.entries(items[0])) {
                      if(key == 'mc'){
                        $('#csemc').append(` <tr><td colspan="2" class="text-center fs-5 bg-secondary text-white ">Main Contact</td></tr>`);
                        for (let [k, v] of Object.entries(value)) {
                          
                          $('#csemc').append(`
                              <tr>
                                  <td>${k}</td>
                                  <td>${v}</td>
                              </tr>
                          `);
                        }
        
                      }else if(key == 'projects'){
                        if(Array.isArray(value) && value.length){
                          $('#cseproject').append(` <tr><td colspan="2" class="text-center fs-5 bg-secondary text-white ">Project Details</td></tr>`);
                          value.forEach(function(project, index){
                            $('#cseproject').append(`
                              <tr>
                                  <td colspan="2" class="text-center fw-bold">Project ${index + 1}</td>
                              </tr>
                            `);
                            for (let [k, v] of Object.entries(project)) {
                              $('#cseproject').append(`
                                <tr>
                                    <td>${k}</td>
                                    <td>${(v !== null && v !== undefined) ? v : ''}</td>
                                </tr>
                              `);
                            }
                          });
                        }
                      }else if(key == 'pro'){
                        continue;
                      }else if(key=='socials'){
                        $('#csesocials').append(` <tr><td colspan="2" class="text-center fs-5 bg-secondary text-white ">Social Profiles</td></tr>`);
                        for (let [k, v] of Object.entries(value)) {
                          
                          $('#csesocials').append(`
                              <tr>
                                  <td>${k}</td>
                                  <td>${v}</td>
                              </tr>
                          `);
                        }
        
                      }else{
                        $('#details').append(`
                          <tr>
                                <td>${key}</td>
                                <td>${value}</td>
                          </tr>
        
                        `);
        
                      }
        
        
                  }        
              }});
          })



    })




});
