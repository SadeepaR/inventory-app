$(document).ready(function () {
  $("#productSearch").on("keyup", function () {
    const query = $(this).val().trim();
    const $resultsBox = $("#searchResults");

    if (query.length > 0) {
      $.ajax({
        url: "search_products.php",
        type: "GET",
        dataType: "json",
        data: { term: query },
        success: function (data) {
          $resultsBox.empty().show();
          if (data.length > 0) {
            data.forEach((item) => {
              $resultsBox.append(`
                                <div class="search-item" onclick="window.location.href='edit_product.php?id=${item.id}'">
                                    <strong>${item.product_name}</strong> - $${parseFloat(item.price).toFixed(2)}
                                </div>
                            `);
            });
          } else {
            $resultsBox.append('<div class="search-item">No matches found.</div>');
          }
        },
        error: function () {
          $resultsBox.hide();
        },
      });
    } else {
      $resultsBox.empty().hide();
    }
  });

  $("#productForm").on("submit", function (e) {
    let errors = [];
    const name = $("#product_name").val().trim();
    const category = $("#category").val().trim();
    const price = parseFloat($("#price").val());
    const quantity = parseInt($("#quantity").val(), 10);

    if (name === "") errors.push("Product Name cannot be blank.");
    if (category === "") errors.push("Category cannot be blank.");
    if (isNaN(price) || price < 0) errors.push("Please provide a valid price (>= 0).");
    if (isNaN(quantity) || quantity < 0) errors.push("Quantity must be a non-negative number.");

    if (errors.length > 0) {
      e.preventDefault();
      const $errDiv = $("#clientErrors");
      $errDiv.html(errors.map((err) => `<p>${err}</p>`).join("")).show();
      $("html, body").animate({ scrollTop: 0 }, "fast");
    }
  });
});
