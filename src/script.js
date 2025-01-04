// script.js
const produse = [
  { id: 1, nume: "Rochie", pret: "100 lei", categorie: "haine" },
  { id: 2, nume: "Pantofi", pret: "150 lei", categorie: "incaltaminte" },
  { id: 3, nume: "Geantă", pret: "80 lei", categorie: "accesorii" },
  { id: 4, nume: "Bluză", pret: "50 lei", categorie: "haine" },
  { id: 5, nume: "Sandale", pret: "120 lei", categorie: "incaltaminte" },
];

$(document).ready(function () {
  function afiseazaProduse(lista) {
    let productHTML = "";
    lista.forEach((produs) => {
      productHTML += `
        <div class="product">
          <img src="placeholder.jpg" alt="${produs.nume}" />
          <h3>${produs.nume}</h3>
          <p>${produs.pret}</p>
          <button onclick="adaugaInCos(${produs.id})">Adaugă în coș</button>
        </div>
      `;
    });
    $("#product-list").html(productHTML);
  }

  afiseazaProduse(produse);

  $("#search").on("input", function () {
    const searchTerm = $(this).val().toLowerCase();
    const produseFiltrate = produse.filter((produs) =>
      produs.nume.toLowerCase().includes(searchTerm)
    );
    afiseazaProduse(produseFiltrate);
  });

  $("#category").on("change", function () {
    const selectedCategory = $(this).val();
    const produseFiltrate = produse.filter((produs) =>
      selectedCategory === "toate"
        ? true
        : produs.categorie === selectedCategory
    );
    afiseazaProduse(produseFiltrate);
  });
  actualizeazaCos();
});

function adaugaInCos(idProdus) {
  const cos = JSON.parse(localStorage.getItem("cos")) || [];
  const produs = produse.find((produs) => produs.id === idProdus);
  cos.push(produs);
  localStorage.setItem("cos", JSON.stringify(cos));
  actualizeazaCos();
}

function stergeDinCos(idProdus) {
  let cos = JSON.parse(localStorage.getItem("cos")) || [];
  cos = cos.filter((produs) => produs.id !== idProdus);
  localStorage.setItem("cos", JSON.stringify(cos));
  actualizeazaCos();
}

function actualizeazaCos() {
  const cos = JSON.parse(localStorage.getItem("cos")) || [];
  let cosHTML = "";
  cos.forEach((produs) => {
    cosHTML += `
      <li>
        ${produs.nume} - ${produs.pret}
        <button onclick="stergeDinCos(${produs.id})">Șterge</button>
      </li>
    `;
  });
  $("#cos").html(cosHTML);
}
