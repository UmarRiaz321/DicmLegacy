// $(document).ready(function(){

  

//     $( '#fbytype' ).select2( {
//         theme: "bootstrap-5",
//         allowClear: true
//     } );
//     $( '#fspotlight' ).select2( {
//         theme: "bootstrap-5",
//         allowClear: true
//     } );
//     // fbyfunc
//     $( '#fbyfunc' ).select2( {
//         theme: "bootstrap-5",
//         allowClear: true
//     } );
//     // fbyregion
//     $( '#fbyregion' ).select2( {
//         theme: "bootstrap-5",
//         placeholder: $( this ).data( 'placeholder' ),
//         closeOnSelect: true,
//         tags: true,
//         allowClear: true,
//         tokenSeparators: [",", ";"],
//     } );

// // Function to send query to backend
// function sendQueryToBackend(query) {
//     // Convert query to string for backend
//     let q = JSON.stringify(query);
//     $.ajax({url: base_url+'filter?query='+q ,
//         type: 'GET',
//         success: function(result){
//             let cse = JSON.parse(result);
//             if(!isEmpty(cse)){
//                 $('#cse_div').empty();
//                 cse.forEach(e => {
                    
//                     let img = e.img ? 'public/images/cselogos/'+e.img :  'public/images/Sirlogo.jpg';
                  
//                     $('#cse_div').append(`
//                         <div class="product-card">
//                             <div class="product-image">
//                                 <img src="${base_url + img}"  alt="Avatar" class="cimage"> 
//                             </div>
//                             <div class="product-details">
//                                 <p class="product-description">${e.type}</p>
//                             <div class="buttons">
//                                 <a href="<?php echo base_url().'detail?id=;'?> ${e.id}">
//                                     <button class="add-to-cart">Sponsor Me</button>
//                                 </a>
//                             </div>
//                             </div>
//                         </div>
                    

//                     `);
                    
//                 });
//             }
//         }
//     })



// }

// // Apply button functionality
// $(document).on('click', '#applyFilter', function() {
//     var region = $('#fbyregion').val();
//     var fun = $('#fbyfunc').val();
//     var query = [];

//     // Form the query object if filters are selected
//     if (region || fun) {
//         if (region) {
//             query.push({ region: region });
//         }
//         if (fun) {
//             query.push({ fun: fun });
//         }

//         // Call backend function
//         sendQueryToBackend(query);

//         // Hide Apply button and show Reset button
//         $('#applyFilter').hide();
//         $('#resetFilter').show();
//     } else {
//         alert("Please select at least one filter before applying.");
//     }
// });

// // Reset button functionality
// $(document).on('click', '#resetFilter', function() {
//     // Reset all filters
//     if ($('#fbyregion').hasClass('select2-hidden-accessible')) {
//         // For Select2 dropdowns
//         $('#fbyregion').val(null).trigger('change');
//         $('#fbyfunc').val(null).trigger('change');
//     } else {
//         // For standard HTML dropdowns
//         $('#fbyregion').val('');
//         $('#fbyfunc').val('');
//     }

//     // Send an empty query to backend to fetch all data
//     sendQueryToBackend([]);

//     // Show Apply button and hide Reset button
//     $('#applyFilter').show();
//     $('#resetFilter').hide();
// });

    
    






//     var div = $('.textfield');
//     if (div.scrollHeight > div.clientHeight) {
//         alert(div)
//       div.classList.add('is-overflowing');
//     }

//     // if($('.textfield').prop('scrollHeight')>$('.textfield').height()){

//     //     $( ".quick-textfield" ).addClass( "overflow" );
//     // }

//     // let texfields = $('.textfield');
//     // $.each(texfields,function(){
//     //     let cdiv = $(this);

//     //     if(hasClass(cdiv, 'rmbox')){
//     //         console.log("I m here")
//     //         if(cdiv.prop('scrollHeight')> 84 ){
                
//     //             cdiv.addClass( "overflow" );
//     //         }
//     //     }else if(hasClass(cdiv, 'rlbox')){
//     //         if(cdiv.prop('scrollHeight')> 132 ){

//     //             cdiv.addClass( "overflow" );
//     //         }
//     //     }else{


//     //     }

//     // })
//    let normalbox = $('.nbox');
//    $.each(normalbox,function(){
//         let cdiv = $(this);
//         if(cdiv.prop('scrollHeight')> 65 ){

//             cdiv.addClass( "overflow" );
//         }
//     })
//     let rmbox = $('.rmbox');
//     $.each(rmbox,function(){
//          let cdiv = $(this);
//          if(cdiv.prop('scrollHeight')> 84 ){
 
//              cdiv.addClass( "overflow" );
//          }
//     })
//     let rlbox = $('.rlbox');
//     $.each(rlbox,function(){
//          let cdiv = $(this);
//          if(cdiv.prop('scrollHeight')> 132 ){
 
//              cdiv.addClass( "overflow" );
//          }
//     })


// });

$(function () {
    const filterInputs = document.querySelectorAll(".filters input[type='checkbox']");
    const appliedFiltersContainer = document.getElementById("applied-filters");
    const resultCount = document.getElementById("result-count");
    const clearAllButton = document.getElementById("clear-all");
    const productGrid = document.getElementById("product-grid");
    const loadMoreButton = document.getElementById("load-more");
  
    let currentPage = 1;
    let totalResults = 0;
    const perPage = 10;
  
    // Update Filters and Fetch Initial Data
    function updateFilters() {
      currentPage = 1; // Reset to the first page
      fetchFilteredData(true); // Fetch data with reset
    }
  
    // Fetch Filtered Data
    async function fetchFilteredData(reset = false) {
      // Collect selected filters
      const selectedFilters = {};
      filterInputs.forEach((input) => {
        if (input.checked) {
          const filterGroup = input.closest(".filter-group h4").textContent.toLowerCase();
          if (!selectedFilters[filterGroup]) {
            selectedFilters[filterGroup] = [];
          }
          selectedFilters[filterGroup].push(input.value);
        }
      });
  
      // Add pagination info
      selectedFilters.page = currentPage;
  
      try {
        const response = await fetch("/CseCatalogue/getFiltered", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(selectedFilters),
        });
        const data = await response.json();
  
        // Update Product Grid
        if (reset) {
          productGrid.innerHTML = ""; // Clear grid if reset is true
        }
        appendProducts(data.products);
  
        // Update Result Count and Total Results
        totalResults = data.total;
        resultCount.textContent = `${totalResults} Results`;
  
        // Show or hide "Load More" button
        if (currentPage * perPage >= totalResults) {
          loadMoreButton.classList.add("hidden");
        } else {
          loadMoreButton.classList.remove("hidden");
        }
      } catch (error) {
        console.error("Error fetching filtered data:", error);
      }
    }
  
    // Append Products to the Grid
    function appendProducts(products) {
      if (products.length === 0) {
        if (productGrid.innerHTML.trim() === "") {
          productGrid.innerHTML = `<p>No results found.</p>`;
        }
        return;
      }
  
      products.forEach((product) => {
        const productCard = document.createElement("div");
        productCard.classList.add("product-card");
  
        productCard.innerHTML = `
          <div class="product-image">
            <img src="${product.img || '/path/to/default/image.jpg'}" alt="${product.name}" class="cimage">
          </div>
          <div class="product-details">
            <p class="product-description">${product.type}</p>
            <div class="buttons">
              <a href="/CseCatalogue/detail?id=${product.id}">
                <button class="add-to-cart">More Info</button>
              </a>
            </div>
          </div>
        `;
        productGrid.appendChild(productCard);
      });
    }
  
    // Handle "Load More" Button
    loadMoreButton.addEventListener("click", () => {
      currentPage++;
      fetchFilteredData();
    });
  
    // Clear All Filters
    clearAllButton.addEventListener("click", () => {
      filterInputs.forEach((input) => (input.checked = false));
      updateFilters();
    });
  
    // Add change event listeners to filters
    filterInputs.forEach((input) => {
      input.addEventListener("change", updateFilters);
    });
  
    // Initial fetch to load all data
    updateFilters();
  });
  