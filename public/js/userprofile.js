var cseProfile = function(data){
let dataArr = data[0];
$('#mainInfo').empty();
for (const [key, value] of Object.entries(dataArr)) {
    console.log(`${key}: ${value}`);
    if(key == "mc"){
        $('#mainContact').empty();
        for (const [k, v] of Object.entries(value)) {
            $('#mainContact').append(`
            <div class="row">
                <div class="col-sm-3">
                    <p class="mb-0">${k}</p>
                </div>
                <div class="col-sm-9">
                    <p class="text-muted mb-0">${v}</p>
                </div>
            </div>
            <hr>
        `);

        }
    }else if(key == "projects"){
        $('#pro_detail').empty();
        if(Array.isArray(value) && value.length){
            value.forEach(function(project, index){
                $('#pro_detail').append(`
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="fw-bold mb-2">Project ${index + 1}</p>
                        </div>
                    </div>
                `);
                for (const [k, v] of Object.entries(project)) {
                    $('#pro_detail').append(`
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">${k}</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">${(v !== null && v !== undefined) ? v : ''}</p>
                            </div>
                        </div>
                        <hr>
                    `);
                }
            });
        }
    }else if(key == "pro"){
        continue;
    }else if(key == "socials"){
        $('#cse_logo').empty();
        $('#cse_facebook').empty();
        $('#cse_insta').empty();
        $('#cse_website').empty();

        // cs_logo
        for (const [k, v] of Object.entries(value)) {
            console.log(`${k}: ${v}`);

            if(k == 'Logo'){
                let img = v?'public/images/cselogos/'+v : 'public/images/Sirlogo.jpg';
                $('#cse_logo').append(`
                <img src="${base_url + img}" alt="avatar" class=" img-fluid" style="width: 30%;">
                `)
            }if(k == 'Facebook'){
                $('#cse_facebook').append(`                
                <div class="row">
                <div class="col-sm-3 fw-2 "><i class="bi bi-facebook"></i></div>
                <div class="col-sm-9">
                    <p class="mb-0">${v}</p>
                </div>
               </div>
                <hr>`);
            }if(k == 'Instagram'){
                $('#cse_insta').append(`                
                <div class="row">
                <div class="col-sm-3 fw-2 "><i class="bi bi-instagram"></i></div>
                <div class="col-sm-9">
                    <p class="mb-0">${v}</p>
                </div>
               </div>
                <hr>`);
            }if(k == 'Website'){
                $('#cse_website').append(`                
                <div class="row">
                <div class="col-sm-3 fw-2 "><i class="bi bi-browser-safari"></i></div>
                <div class="col-sm-9">
                    <p class="mb-0">${v}</p>
                </div>
               </div>`);

            }
        }

    }
    else
    {
       
        $('#mainInfo').append(`
            <div class="row">
                <div class="col-sm-4">
                    <p class="mb-0">${key}</p>
                </div>
                <div class="col-sm-8">
                    <p class="text-muted mb-0">${value}</p>
                </div>
            </div>
            <hr>
        `);
    }
}

$('#cseProfile').show();
    


}

var setOptions= function(selector, arr) {
    if (Array.isArray(arr)) {
        $.each(arr, function(key, value) {
            var o = new Option(value, value, true, true);
            selector.append(o).trigger('change');
            selector.change();
        })
    } else {
        var e = arr;
        var o = new Option(e, e, true, true);
        selector.append(o).trigger('change');
        selector.change();
    }

}
