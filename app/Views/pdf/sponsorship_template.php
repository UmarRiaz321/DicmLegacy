<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Purchase Order</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }
        #pdfContent {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
        }
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div id="pdfContent">
        <div class="modal-content shadow-lg">
            <div class="modal-header">
                <div class="row w-100">
                    <div class="col-3 pr-order">
                        <img src="public/images/SIRNewLogo.png" alt="SIR">
                    </div>
                    <div class="col-8 text-center">
                        <h5>Social Purchase Order</h5>
                    </div>
                    <div class="col-1 text-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            <div class="modal-body p-4">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-dark"><i class="bi bi-info-circle"></i> Sponsorship Information</h5>
                        <hr>
                        <p><strong>Reference:</strong> <span id="spoRef"></span></p>
                        <p><strong>Status:</strong> <span id="spoStatus" class="badge"></span></p>
                    </div>
                </div>
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-success"><i class="bi bi-house-heart"></i> Charity Details</h5>
                        <hr>
                        <p><strong>Name:</strong> <span id="charityName"></span></p>
                        <p><strong>Project Name:</strong> <span id="projectName"></span></p>
                        <p><strong>Purpose:</strong> <span id="projectPurpose"></span></p>
                        <p><strong>Key Objectives:</strong> <span id="keyObjectives"></span></p>
                    </div>
                </div>
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-primary"><i class="bi bi-person-badge"></i> Sponsor Details</h5>
                        <hr>
                        <p><strong>Name:</strong> <span id="sponsorName"></span></p>
                    </div>
                </div>
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-warning"><i class="bi bi-currency-pound"></i> Sponsorship Financials</h5>
                        <hr>
                        <p><strong>Required Sponsorship:</strong> <span id="requiredSponsorship" class="text-danger fw-bold"></span></p>
                        <p><strong>Offered Amount:</strong> <span id="sponsorshipOffer" class="text-success fw-bold"></span></p>
                    </div>
                </div>
                <div class="row text-center">
                    <button type="button" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"></i> Download PDF</button>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col-3 pr-order text-start">
                        <img src="public/images/SIRNewLogo.png" alt="SIR">
                    </div>
                    <div class="col-6 text-center">
                        <h5>Brought to you by Plugin</h5>
                    </div>
                    <div class="col-3 pr-order text-end">
                        <img src="public/images/SIRNewLogo.png" alt="SIR">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
