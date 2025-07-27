
  // Array produk
  const products = [
    { name: "Kemeja Pria", description: "Kemeja lengan panjang bahan katun", price: 150000, image: "images/kemeja.jpeg", category: "Pakaian" },
    { name: "Sepatu Sneakers", description: "Sneakers trendy untuk pria & wanita", price: 350000, image: "images/sneakers.webp", category: "Sepatu" },
    { name: "Jam Tangan", description: "Jam tangan elegan", price: 250000, image: "images/jam.jpg", category: "Aksesoris" },
    { name: "Kaos Polos", description: "Kaos polos berbagai warna", price: 80000, image: "images/kaos.jpeg", category: "Pakaian" },
    { name: "Tas Ransel", description: "Tas ransel anti air", price: 180000, image: "images/tas.jpeg", category: "Tas" },
    { name: "Sepatu Formal", description: "Sepatu formal kulit asli", price: 400000, image: "images/sepatu.jpeg", category: "Sepatu" },
    { name: "Topi Baseball", description: "Topi keren untuk gaya santai", price: 50000, image: "images/topi.webp", category: "Aksesoris" }
  ];

  const productList = document.getElementById("productList");
  const searchInput = document.getElementById("searchInput");
  const categoryFilter = document.getElementById("categoryFilter");
  const priceSort = document.getElementById("priceSort");


  const categories = [...new Set(products.map(p => p.category))];
  categories.forEach(cat => {
    const option = document.createElement("option");
    option.value = cat;
    option.textContent = cat;
    categoryFilter.appendChild(option);
  });

  // Tampilkan produk
  function displayProducts(filteredProducts) {
    productList.innerHTML = "";
    if (filteredProducts.length === 0) {
      productList.innerHTML = '<div class="col-12 text-center text-muted">Produk tidak ditemukan.</div>';
      return;
    }

    filteredProducts.forEach(product => {
      const col = document.createElement("div");
      col.className = "col-md-4 mb-4";

      col.innerHTML = `
        <div class="card product-card shadow-sm h-100">
          <img src="${product.image}" class="card-img-top previewable-img" alt="${product.name}" style="cursor: zoom-in;">
          <div class="card-body">
            <h5 class="card-title">${product.name}</h5>
            <p class="card-text">${product.description}</p>
            <p class="text-primary fw-bold">Rp ${product.price.toLocaleString()}</p>
            <span class="badge bg-secondary">${product.category}</span>
          </div>
        </div>
      `;
      productList.appendChild(col);
    });
  }

  // Filter produk
  function filterProducts() {
    let result = [...products];

    const keyword = searchInput.value.toLowerCase();
    const category = categoryFilter.value;
    const sort = priceSort.value;

    if (keyword) {
      result = result.filter(p => p.name.toLowerCase().includes(keyword));
    }

    if (category) {
      result = result.filter(p => p.category === category);
    }

    if (sort === "asc") {
      result.sort((a, b) => a.price - b.price);
    } else if (sort === "desc") {
      result.sort((a, b) => b.price - a.price);
    }

    displayProducts(result);
  }

  // Event listeners
  searchInput.addEventListener("input", filterProducts);
  categoryFilter.addEventListener("change", filterProducts);
  priceSort.addEventListener("change", filterProducts);

  // Modal Preview Gambar
  let zoomLevel = 1;
  const imagePreviewModal = document.getElementById("imagePreviewModal");
  const previewImg = document.getElementById("previewImg");
  const zoomInBtn = document.getElementById("zoomInBtn");
  const zoomOutBtn = document.getElementById("zoomOutBtn");
  let bsModal = null;

  function openImagePreview(src, alt) {
    previewImg.src = src;
    previewImg.alt = alt;
    zoomLevel = 1;
    previewImg.style.transform = `scale(${zoomLevel})`;
    if (!bsModal) {
      bsModal = new bootstrap.Modal(imagePreviewModal);
    }
    bsModal.show();
  }

  // Event delegation for image click
  productList.addEventListener("click", function(e) {
    if (e.target.classList.contains("previewable-img")) {
      openImagePreview(e.target.src, e.target.alt);
    }
  });

  zoomInBtn.addEventListener("click", function() {
    zoomLevel += 0.2;
    if (zoomLevel > 3) zoomLevel = 3;
    previewImg.style.transform = `scale(${zoomLevel})`;
  });
  zoomOutBtn.addEventListener("click", function() {
    zoomLevel -= 0.2;
    if (zoomLevel < 0.5) zoomLevel = 0.5;
    previewImg.style.transform = `scale(${zoomLevel})`;
  });

  // Reset zoom when modal closed
  imagePreviewModal.addEventListener("hidden.bs.modal", function() {
    zoomLevel = 1;
    previewImg.style.transform = `scale(1)`;
    previewImg.src = "";
  });

  // Inisialisasi
  displayProducts(products);

