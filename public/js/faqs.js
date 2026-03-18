$(document).ready(function () {
    let currentType = "Charities";

    function loadFaqs(ftype = "Charities") {

        $("#faqTable").DataTable().destroy(); // Destroy previous DataTable instance
        $.ajax({
            url: base_url + "/faqs",
            type: "GET",
            dataType: "json",
            data:{type : ftype},
            success:function(response){
                let tableBody = $("#faqsTableBody").empty(); // Clear table body
                response.forEach(function(faq){
                    tableBody.append(`
                        <tr>
                            <td>${faq.faq_question}</td>
                            <td>${faq.faq_answer}</td>
                            <td class="text-center">
                                <button class="btn btn-outline-success btn-sm tbtn-sm fview-btn" data-id="${faq.faq_id }" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Faq">
                                <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-sm tbtn-sm fdell-btn" data-id="${faq.faq_id }" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Faq">
                                <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        `);
                });

                // Re-initialize DataTable after loading new data
                $("#faqTable").DataTable({
                    searching: false,
                    lengthChange: false,
                    pageLength: 10,
                    order: [[0, "desc"]],
                });
            }
        });
    }

    loadFaqs(currentType);
    // Status Filter Tabs
    $(".status-tab").on("click", function (e) {
        e.preventDefault();
        $(".status-tab").removeClass("active");
        $(this).addClass("active");
        currentType = $(this).data("status");
        if(currentType == "AddFaqs"){

            $("#faqsTable").hide();
            $("#addFaqForm").show();
  
        }else{
            $("#addFaqForm").hide();
            $("#faqsTable").show();
            loadFaqs(currentType);
        }
       
    });

    $(document).on('click','.fview-btn',function(){

        let faqId = $(this).data("id");
        $.ajax({
            url:base_url + "/faqs/" + faqId,
            type: "GET",
            dataType: "json",
            success: function (response) {
                $('#updateFaq input, #textsres').val('');
                $("#faqQuestion").val(response.faq_question);
                $("#faqAnswer").val(response.faq_answer);
                $("#ftype").val(response.faq_type);
                $("#fid").val(response.faq_id);
                $("#faqDetailsModal").modal("show");     
            },
            error: function(response){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }

        });
    })


    // Update Faq
    $("#updateFaq").on("submit", function (e) {

        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            url: base_url + "fupdate",
            type: "POST",
            data: formData,
            success: function (response) {
           
                Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'FAQ updated successfully!',
                });
                $("#faqDetailsModal").modal("hide");
                loadFaqs(currentType);
            },
            error: function (response) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: response.message || 'Failed to update FAQ.',
            });
            }
        });
    });

    // Delete Faq
    $(document).on('click','.fdell-btn',function(){
        let faqId = $(this).data("id");
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this FAQ!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete FAQ!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + "faqs/delete/" + faqId,
                    type: "DELETE",
                    success: function (response) {
                        Swal.fire(
                            'Deleted!',
                            'FAQ has been deleted.',
                            'success'
                        );
                        loadFaqs(currentType);
                    },
                    error: function (response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message || 'Failed to delete FAQ.',
                        });
                    }
                });
            }
        });
    });

    // Add Faq
    $("#newFaqForm").on("submit", function (e) {
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            url: base_url + "faqs/create",
            type: "POST",
            data: formData,
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'FAQ added successfully!',
                });
                $("#newFaqForm input, #newFaqForm textarea").val('');
                loadFaqs(currentType);
            },
            error: function (response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response.message || 'Failed to add FAQ.',
                });
            }
        });
    });

    // Show CSE Faq Model

    $('#faqsModal').on('show.bs.modal', function (event) {

        $(".csefaq").empty();

        $.ajax({
            url: base_url + "faqs",
            type: "GET",
            dataType: "json",
            data: {type: "Charities"},
            success: function (response) {
                response.forEach(function (faq) {
                    $(".csefaq").append(`
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading${faq.faq_id}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${faq.faq_id}" aria-expanded="false" aria-controls="collapse${faq.faq_id}">
                                    ${faq.faq_question}
                                </button>
                            </h2>
                            <div id="collapse${faq.faq_id}" class="accordion-collapse collapse" aria-labelledby="heading${faq.faq_id}" data-bs-parent="#cseFaqAccordion">
                                <div class="accordion-body">
                                    ${faq.faq_answer}
                                </div>
                            </div>
                        </div>
                    `);
                });
            }
        });

    });


    // show business faq model
    $('#spofaqsModal').on('show.bs.modal', function (event) {

        $(".businessfaq").empty();

        $.ajax({
            url: base_url + "faqs",
            type: "GET",
            dataType: "json",
            data: {type: "Businesses"},
            success: function (response) {
                response.forEach(function (faq) {
                    $(".businessfaq").append(`
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading${faq.faq_id}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${faq.faq_id}" aria-expanded="false" aria-controls="collapse${faq.faq_id}">
                                    ${faq.faq_question}
                                </button>
                            </h2>
                            <div id="collapse${faq.faq_id}" class="accordion-collapse collapse" aria-labelledby="heading${faq.faq_id}" data-bs-parent="#busFaqAccordion">
                                <div class="accordion-body">
                                    ${faq.faq_answer}
                                </div>
                            </div>
                        </div>
                    `);
                });
            }
        });

    });

    // show buyers faq model
    $('#enafaqsModal').on('show.bs.modal', function (event) {

        $(".buyerfaq").empty();

        $.ajax({
            url: base_url + "faqs",
            type: "GET",
            dataType: "json",
            data: {type: "Buyers"},
            success: function (response) {
                response.forEach(function (faq) {
                    $(".buyerfaq").append(`
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading${faq.faq_id}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${faq.faq_id}" aria-expanded="false" aria-controls="collapse${faq.faq_id}">
                                    ${faq.faq_question}
                                </button>
                            </h2>
                            <div id="collapse${faq.faq_id}" class="accordion-collapse collapse" aria-labelledby="heading${faq.faq_id}" data-bs-parent="#buyersFaqAccordion">
                                <div class="accordion-body">
                                    ${faq.faq_answer}
                                </div>
                            </div>
                        </div>
                    `);
                });
            }
        });

    });
})