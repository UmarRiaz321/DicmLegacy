$(function () {
  $(document).on("click", "#cse_export", function () {
    $.ajax({
      url: base_url + "cExpo",
      type: "GET",
      success: function (result) {
        let charities = JSON.parse(result);
        ExportToCsv(charities, "Charities");
      },
    });
  });
  $(document).on("click", "#spo_export", function () {
    $.ajax({
      url: base_url + "sExpo",
      type: "GET",
      success: function (result) {
        let sponsors = JSON.parse(result);
        ExportToCsv(sponsors, "Sponsors");
      },
    });
  });
  $(document).on("click", "#ena_export", function () {
    $.ajax({
      url: base_url + "eExpo",
      type: "GET",
      success: function (result) {
        let enablers = JSON.parse(result);
        ExportToCsv(enablers, "Enablers");
      },
    });
  });
  // Export Function
  function ExportToCsv(jArray, name) {
    if (!Array.isArray(jArray) || jArray.length === 0) {
      Swal.fire({
        icon: "info",
        title: "No Records",
        text: "There are no approved users to export.",
        color: "#8CB61D",
      });
      return;
    }

    var headers = Object.keys(jArray[0]);
    var sheetData = [headers];
    jArray.forEach(function (row) {
      var line = headers.map(function (key) {
        return row[key] ?? "";
      });
      sheetData.push(line);
    });

    var filename = name + ".xlsx";

    /* Sheet Name */
    var ws_name = name;

    // if (typeof console !== 'undefined') console.log(new Date());
    var wb = XLSX.utils.book_new(),
      ws = XLSX.utils.aoa_to_sheet(sheetData);

    /* Add worksheet to workbook */
    XLSX.utils.book_append_sheet(wb, ws, ws_name);

    /* Write workbook and Download */
    XLSX.writeFile(wb, filename);

    Swal.fire({
      icon: "success",
      title: "File Saved",
      text: "File have been saved.",
      color: "#8CB61D",
    });
  }
});
