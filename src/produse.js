$(document).ready(function () {
  function afiseazaProduse(lista) {
    let productHTML = "";
    lista.forEach((produs) => {
      productHTML += `
                <div class="product">
                    <img src="${produs.image_url}" alt="${produs.name}" />
                    <h3>${produs.name}</h3>
                    <p>${produs.price} lei</p>
                    <button onclick="location.href='adauga_in_cos.php?id=${produs.product_id}'">Adaugă în coș</button>
                </div>
            `;
    });
    $("#product-list").html(productHTML);
  }

  function obtineProduse(searchTerm = "", selectedCategory = "toate") {
    $.ajax({
      url: "obtine_produse.php",
      type: "GET",
      data: {
        search: searchTerm,
        category: selectedCategory,
      },
      success: function (data) {
        afiseazaProduse(JSON.parse(data));
      },
      error: function (xhr, status, error) {
        console.error("Eroare AJAX:", status, error);
      },
    });
  }

  obtineProduse();
});
