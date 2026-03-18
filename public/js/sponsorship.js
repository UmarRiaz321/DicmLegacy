$(document).ready(function () {
    let currentStatus = "PROP"; // Default sponsorship status

    const escapeHtml = (value) => $('<div>').text(value ?? '').html();

    function initTooltips() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    // Function to load sponsorships dynamically based on status
    function loadSponsorships(status = "PROP") {
        $("#sponsorshipsTable").DataTable().destroy(); // Destroy previous DataTable instance

        $.ajax({
            url: base_url + "/fetchspo/" + status,
            type: "GET",
            dataType: "json",
            success: function (response) {
                let tableBody = $("#sponsorshipsTableBody").empty(); // Clear table body

                response.data.forEach(function (sponsorship) {
                    const row = $('<tr>');
                    row.append($('<td>').html(escapeHtml(sponsorship.spo_ref)));
                    row.append($('<td>').html(escapeHtml(sponsorship.sponsorship_breference || 'N/A')));
                    row.append($('<td>').html(escapeHtml(sponsorship.charity_name)));
                    row.append($('<td>').html(escapeHtml(sponsorship.sponsor_name)));
                    row.append($('<td>').html('£' + escapeHtml(sponsorship.sponsorship_offer)));

                    const actionCell = $('<td>').addClass('text-center');
                    $('<button>')
                        .addClass('btn btn-outline-success btn-sm tbtn-sm view-btn')
                        .attr({
                            'data-id': sponsorship.id,
                            'data-bs-toggle': 'tooltip',
                            'data-bs-placement': 'top',
                            'title': 'View Details'
                        })
                        .append($('<i>').addClass('bi bi-eye'))
                        .appendTo(actionCell);

                    $('<button>')
                        .addClass('btn btn-outline-danger btn-sm tbtn-sm pdf-btn')
                        .attr({
                            'data-id': sponsorship.id,
                            'data-bs-toggle': 'tooltip',
                            'data-bs-placement': 'top',
                            'title': 'Download PDF'
                        })
                        .append($('<i>').addClass('bi bi-file-earmark-pdf'))
                        .appendTo(actionCell);

                    $('<button>')
                        .addClass('btn btn-outline-primary btn-sm tbtn-sm email-btn')
                        .attr({
                            'data-id': sponsorship.id,
                            'data-bs-toggle': 'tooltip',
                            'data-bs-placement': 'top',
                            'title': 'Email Sponsor'
                        })
                        .append($('<i>').addClass('bi bi-envelope'))
                        .appendTo(actionCell);

                    $('<button>')
                        .addClass('btn btn-outline-info btn-sm tbtn-sm supdate-btn')
                        .attr({
                            'data-id': sponsorship.id,
                            'data-bs-toggle': 'tooltip',
                            'data-bs-placement': 'top',
                            'title': 'Update Status'
                        })
                        .append($('<i>').addClass('bi bi-pencil'))
                        .appendTo(actionCell);

                    row.append(actionCell);
                    tableBody.append(row);
                });

                // Re-initialize DataTable after loading new data
                $("#sponsorshipsTable").DataTable({
                    searching: false,
                    lengthChange: false,
                    pageLength: 10,
                    order: [[0, "desc"]],
                });

                // initTooltips(); // Initialize tooltips
            },
            error: function (jqXHR) {
                if (![401, 403, 419, 440].includes(jqXHR.status)) {
                    Swal.fire("Error", "Failed to load sponsorships", "error");
                }
            },
        });
    }

    // Load sponsorships on page load
    loadSponsorships(currentStatus); 

    // Status Filter Tabs
    $(".status-tab").on("click", function (e) {
        e.preventDefault();
        $(".status-tab").removeClass("active");
        $(this).addClass("active");
        currentStatus = $(this).data("status");
        loadSponsorships(currentStatus);
    });

    // View Sponsorship Details

    const statusMapping = {
        "PROP": { label: "Proposal", color: "bg-primary text-white" },
        "OFBP": { label: "SPO Submitted", color: "bg-warning text-dark" },
        "OAAS": { label: "SPO Accepted", color: "bg-info text-dark" },
        "SIGN-U": { label: "Signed Unpaid", color: "bg-danger text-white" },
        "CONF": { label: "Sponsorship Confirmed", color: "bg-success text-white" }
    };

    $(document).on("click", ".view-btn", function () {
        let sponsorshipId = $(this).data("id");
    
        $.ajax({
            url:base_url + "/fetchSpoDetail/" + sponsorshipId,
            type: "GET",
            dataType: "json",
            success: function (response) {
                console.log(response);
                if (response.status === "success") {
                    let data = response.data;
    
                    $("#spoRef").text(data.spo_ref);
                    $("#spoStatus").text(statusMapping[data.status].label);
                    $("#buyerReference").text(data.sponsorship_breference || "N/A");
    
                    $("#charityName").text(data.charity_name); 
                    $("#charityUserName").text(data.charity_unique_id); 
                    $("#sponsorName").text(data.sponsor_name); 
                    $("#sponsorUserName").text(data.sponsor_username); 
                    $("#projectName").text(data.project_name);
                    $("#projectPurpose").text(data.project_purpose);
                    $("#keyObjectives").text(data.key_objectives);
                    $("#arneeded").text(data.additional_resources);
    
                    $("#requiredSponsorship").text(`£${data.required_sponsorship}`);
                    $("#sponsorshipOffer").text(`£${data.sponsorship_offer}`);
    
                    $("#monetaryValue").text(`£${data.monetary_value}`);
                    $("#monetaryDetails").text(data.monetary_details);
                    $("#goodsValue").text(`£${data.goods_value}`);
                    $("#goodsDetails").text(data.goods_details);
                    $("#volunteeringValue").text(`£${data.volunteering_value}`);
                    $("#volunteeringDetails").text(data.volunteering_details);
    
                    let balance = (data.required_sponsorship - data.sponsorship_offer).toFixed(2);
                    $("#totalFunding").text(`£${data.sponsorship_offer}`);
                    $("#remainingBalance").text(`£${balance}`);

                    $("#pdfSpoRef").text(data.spo_ref);
                    $("#pdfSpoStatus")
                        .text(statusMapping[data.status].label)
                        .removeClass("bg-primary bg-warning bg-info bg-danger bg-success text-white text-dark")
                        .addClass(statusMapping[data.status].color);
                    $("#pdfBuyerReference").text(data.sponsorship_breference || "N/A");
                    $("#pdfCharityName").text(data.charity_name);
                    $("#pdfProjectName").text(data.project_name);
                    $("#pdfProjectPurpose").text(data.project_purpose);
                    $("#pdfKeyObjectives").text(data.key_objectives);
                    $("#pdfSponsorName").text(data.sponsor_name);
                    $("#pdfRequiredSponsorship").text(`£${data.required_sponsorship}`);
                    $("#pdfSponsorshipOffer").text(`£${data.sponsorship_offer}`);
                    $("#pdfMonetaryValue").text(`£${data.monetary_value}`);
                    $("#pdfMonetaryDetails").text(data.monetary_details);
                    $("#pdfGoodsValue").text(`£${data.goods_value}`);
                    $("#pdfGoodsDetails").text(data.goods_details);
                    $("#pdfVolunteeringValue").text(`£${data.volunteering_value}`);
                    $("#pdfVolunteeringDetails").text(data.volunteering_details);
                    $("#pdfTotalFunding").text(`£${data.sponsorship_offer}`);
                    $("#pdfRemainingBalance").text(`£${balance}`);
    
                    $("#sponsorshipDetailsModal").modal("show");
                }
            }
        });
    });
    


    // Update Sponsorship Status

    $(document).on("click", ".supdate-btn", function () {
        let sponsorshipId = $(this).data("id");
        // PROP → Proposal (Default)
        // OFBP → Offer for Bidding Purpose
        // OAAS → Offer Accepted Awaiting Sign-Off
        // SIGN-U → Signed Unpaid
        // CONF → Sponsorship Confirmed
        Swal.fire({
            title: "Update Sponsorship Status",
            input: "select",
            inputOptions: {
                "PROP": "Proposal",
                "OFBP": "SPO Submitted",
                "OAAS": "SPO Accepted",
                "SIGN-U": "Signed Unpaid",
                "CONF": "Sponsorship Confirmed"
            },
            inputPlaceholder: "Select a status",
            showCancelButton: true,
            confirmButtonText: "Update",
            customClass: {
                popup: 'swal-wide',
                input: 'form-select form-select-lg'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + "/updateSponsorshipStatus/" + sponsorshipId,
                    type: "POST",
                    data: { status: result.value },
                    success: function (response) {
                        if (response.status === "success") {
                            Swal.fire("Success", "Sponsorship status updated successfully", "success");
                            location.reload();
                        } else {
                            Swal.fire("Error", response.message, "error");
                        }
                    },
                    error: function () {
                        Swal.fire("Error", "Failed to update sponsorship status", "error");
                    }
                });
            }
        });
    });




    $(document).on("click", ".pdf-btn", function () {
        let sponsorshipId = $(this).data("id");
        window.open(base_url + "sponsorships/contract/" + sponsorshipId + "?download=1", "_blank");
    });
 
    // $(document).on("click", ".email-btn", async function () {

    //     // check if user exists
    //     let email = prompt("Please enter your email address");
    //     let type = prompt("Please enter the type user");
    //     let user;
    //     try {
    //         const response = await $.ajax({
    //         url: base_url + "/checkuser",
    //         type: "GET",
    //         data: { email: email, type: type },
    //         dataType: "json"
    //         });

    //         if (response.status !== "success") {
    //         Swal.fire("Error", response.message, "error");
    //         return;
    //         }

    //         user = response.userID;
            
    //         if(user) {

    //             Swal.fire({
    //                 title: "Update User",
    //                 text: "Do you want to update the user?",
    //                 icon: "question",
    //                 showCancelButton: true,
    //                 confirmButtonText: "Update",
    //                 cancelButtonText: "Cancel"
    //             }).then((result) => {
    //                 if (result.isConfirmed) {
    //                     $.ajax({
    //                         url: base_url + "/updateuser",
    //                         type: "POST", // Changed from GET to POST
    //                         data: { user: user, type: type },
    //                         dataType: "json",
    //                         success: function (response) {
    //                             if (response.status === "success") {
    //                                 showSuccessAlert("User updated successfully!");
    //                             } else {
    //                                 showErrorAlert(response.message || "An error occurred while updating.");
    //                             }
    //                         },
    //                         error: function (xhr, status, error) {
    //                             console.error("AJAX Error:", xhr.responseText); // Log full error details
    //                             showErrorAlert("Failed to update user. Please try again.");
    //                         }
    //                     });
    //                 }
    //             });
             
    //         }
    //     } catch (error) {
    //         Swal.fire("Error", error.message, "error");
    //         return;
    //     }

    // });

    // Email Sponsor
    $(document).on("click", ".email-btn", async function () {
        let sponsorshipId = $(this).data("id");

        // Show email compose dialog
        Swal.fire({
            title: "Compose Email",
            input: "textarea",
            inputLabel: "Write your message to the sponsor",
            inputPlaceholder: "Type your message here...",
            showCancelButton: true,
            confirmButtonText: "Send Email",
        }).then((result) => {
            if (result.isConfirmed) {
            Swal.fire({
                title: "Sending Email...",
                text: "Please wait while we send your email.",
                allowOutsideClick: false,
                didOpen: () => {
                Swal.showLoading();
                }
            });

            $.ajax({
                url: base_url + "emailSponsor/" + sponsorshipId,
                type: "POST",
                data: {
                message: result.value
                },
                success: function (response) {
                Swal.close();
                Swal.fire("Success", response.message, "success");
                },
                error: function (response) {
                Swal.close();
                Swal.fire("Error", response.message, "error");
                },
            });
            }
        });
    });

    // Helper function for success alerts
    function showSuccessAlert(message) {
    Swal.fire("Success", message, "success");
    }

    // Helper function for error alerts
    function showErrorAlert(message) {
    Swal.fire("Error", message, "error");
    }
});
