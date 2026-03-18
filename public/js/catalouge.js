$(function () {
    const filterInputs = Array.prototype.slice.call(document.querySelectorAll(".filters input[type='checkbox']"));
    const productGrid = document.getElementById("product-grid");
    const resultCount = document.getElementById("result-count");
    const clearAllButton = document.getElementById("clear-all");
    const appliedFiltersContainer = document.getElementById("applied-filters");
    const loadMoreButton = document.getElementById("load-more");
  
    if (!productGrid || !appliedFiltersContainer) {
      return;
    }
  
    const totalFromDataset = Number(productGrid.dataset.total || 0);
    let perPage = Number(productGrid.dataset.perPage || 10);
    let currentPage = Math.max(1, Number(productGrid.dataset.currentPage || 1));
    const hasInitialProjects = productGrid.querySelector(".product-card") !== null;
    const truncateText = (value, limit = 90) => {
      if (!value) return '';
      const text = String(value).trim();
      return text.length > limit ? `${text.substring(0, limit - 1)}…` : text;
    };
    const escapeHtml = (value = '') => {
      return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;');
    };

    // Base URL for API endpoints
    const baseUrl = "/CseCatalogue/";

    if (resultCount) {
      resultCount.textContent = `${totalFromDataset} Results`;
    }

    if (!hasInitialProjects) {
      fetchProducts();
    } else {
      updateLoadMoreButton(totalFromDataset);
    }


    $(document).ready(function() {
      let textfields = $('.textfield');
      $.each(textfields, function() {
          let cdiv = $(this);
  
          if (cdiv.hasClass('rmbox')) {
              if (cdiv.prop('scrollHeight') > 84) {
                  cdiv.addClass("overflow");
              }
          } else if (cdiv.hasClass('rlbox')) {
              if (cdiv.prop('scrollHeight') > 132) {
                  cdiv.addClass("overflow");
              }
          }
      });
  
      let normalbox = $('.nbox');
      $.each(normalbox, function() {
          let cdiv = $(this);
          if (cdiv.prop('scrollHeight') > 65) {
              cdiv.addClass("overflow");
          }
      });
  
      let rmbox = $('.rmbox');
      $.each(rmbox, function() {
          let cdiv = $(this);
          if (cdiv.prop('scrollHeight') > 84) {
              cdiv.addClass("overflow");
          }
      });
  
      let rlbox = $('.rlbox');
      $.each(rlbox, function() {
          let cdiv = $(this);
          if (cdiv.prop('scrollHeight') > 132) {
              cdiv.addClass("overflow");
          }
      });
  });
  
  
    // Fetch Products (Initial Load or Filters)
    async function fetchProducts(filters = {}, reset = false) {
        const endpoint = Object.keys(filters).length ? base_url+"filter" : base_url+ "allc";

      const csrf = (typeof getCsrf === 'function') ? getCsrf() : { name: '', value: '' };
      const payload = { ...filters, page: currentPage };
      if (csrf.name && csrf.value) {
        payload[csrf.name] = csrf.value;
      }

      try {
        const response = await fetch(endpoint, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            ...(csrf.value ? { "X-CSRF-TOKEN": csrf.value } : {}),
            "X-Requested-With": "XMLHttpRequest",
          },
          credentials: 'same-origin',
          body: JSON.stringify(payload),
        });

        const headerToken = response.headers.get('X-CSRF-TOKEN');
        if (headerToken && typeof setCsrf === 'function') {
          setCsrf(csrf.name || 'csrf_token', headerToken);
        }

        if (!response.ok) {
          await response.text();
          return;
        }
        const data = await response.json();
        if (typeof updateCsrfFromResponse === 'function') {
          updateCsrfFromResponse(data);
        }

        // Update product grid
        if (reset) productGrid.innerHTML = ""; // Clear grid if reset is true
        appendProducts(data.products);
  
        // Update result count and pagination
        if (resultCount) {
          resultCount.textContent = `${data.total} Results`;
        }
        if (data.per_page) {
          perPage = data.per_page;
        }
        updateLoadMoreButton(data.total);
        if (productGrid) {
          productGrid.dataset.total = data.total || 0;
          productGrid.dataset.perPage = perPage;
          productGrid.dataset.currentPage = currentPage;
        }
      } catch (error) {
        // Swallow errors to avoid blocking the UI; optional reporting could go here.
      }
    }
  
    // Update Load More Button Visibility
    function updateLoadMoreButton(total) {
      if (!loadMoreButton) {
        return;
      }
      const shouldHide = currentPage * perPage >= total;
      loadMoreButton.classList.toggle("hidden", shouldHide);
    }
  
    // Append Products to the Grid
    function appendProducts(products) {
      if (!products.length && !productGrid.innerHTML.trim()) {
        productGrid.innerHTML = "<p>No results found.</p>";
        return;
      }
  
      products.forEach((product) => {
        // Avoid duplicates by checking data-id
        if (!document.querySelector(`[data-id="${product.id}"]`)) {
          const productCard = document.createElement("div");
          productCard.classList.add("product-card");
          productCard.setAttribute("data-id", product.id); // Set a unique identifier to avoid duplicates

          const title = truncateText(product.project_name, 70);
          const charity = truncateText(product.charity_name || '', 90);
          const regions = truncateText(product.regions || '', 110);
          const imgSrc = `${base_url}public/images/cselogos/${product.img || 'default.jpg'}`;

          productCard.innerHTML = `
            <div class="product-image">
              <img src="${imgSrc}" alt="${escapeHtml(product.project_name || '')}">
            </div>
            <div class="product-details">
              <h6 class="product-title" title="${escapeHtml(product.project_name || '')}">${title}</h6>
              <p class="product-charity" title="${escapeHtml(product.charity_name || '')}">${charity}</p>
              <p class="product-region" title="${escapeHtml(product.regions || '')}">${regions}</p>
              <a href="${base_url}detail?project=${product.id}">
                <button class="add-to-cart">More Info</button>
              </a>
            </div>
          `;
  
          productGrid.appendChild(productCard);
        }
      });
    }
  
    // Update Filters and Fetch Data
    function updateFilters(reset = false) {
      const filters = updateAppliedFilters();
      currentPage = 1; // Reset to the first page for new filters
      fetchProducts(filters, reset);
    }
  
    // Update Applied Filters
    function updateAppliedFilters() {
      const filters = {};
      appliedFiltersContainer.innerHTML = ""; // Clear applied filters
  
      filterInputs.forEach((input) => {
        if (!input.checked) {
          return;
        }

        let filterGroup = '';
        const container = input.closest(".filter-group");
        if (container) {
          const heading = container.querySelector("h4");
          if (heading && heading.textContent) {
            filterGroup = heading.textContent.trim().toLowerCase();
          }
        }

        if (!filterGroup) {
          return;
        }

        if (!filters[filterGroup]) {
          filters[filterGroup] = [];
        }
        filters[filterGroup].push(input.value);

        // Add filter badge to top bar
        const filterEl = document.createElement("span");
        filterEl.classList.add("filter");

        const filterName = document.createElement("span");
        filterName.textContent = input.value;

        const clearButton = document.createElement("button");
        clearButton.textContent = "x";
        clearButton.classList.add("clear-filter");
        clearButton.addEventListener("click", () => {
          input.checked = false;
          updateFilters(true);
        });

        filterEl.appendChild(filterName);
        filterEl.appendChild(clearButton);
        appliedFiltersContainer.appendChild(filterEl);
      });
  
      // Show or hide clear all button
      clearAllButton.classList.toggle("hidden", Object.keys(filters).length === 0);
  
      return filters;
    }
  
    // Clear All Filters


    if(clearAllButton){
      clearAllButton.addEventListener("click", () => {
        filterInputs.forEach((input) => (input.checked = false));
        updateFilters(true);
      });
    }
    if(loadMoreButton){
      loadMoreButton.addEventListener("click", () => {
        currentPage++;
        const filters = updateAppliedFilters();
        fetchProducts(filters);
      }); 
    }
 
    

  
    // Filter Change Event Listeners
    filterInputs.forEach((input) => {
      input.addEventListener("change", () => {
        updateFilters(true);
      });
    });
  
  });
  
