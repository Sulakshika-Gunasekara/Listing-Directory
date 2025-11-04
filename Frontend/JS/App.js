// frontend/js/app.js

if ("serviceWorker" in navigator) {
  window.addEventListener("load", () => {
    navigator.serviceWorker
      .register("/frontend/js/service-worker.js")
      .then((registration) => {
        console.log(
          "ServiceWorker registration successful with scope: ",
          registration.scope
        );
      })
      .catch((error) => {
        console.log("ServiceWorker registration failed: ", error);
      });
  });
}

function app() {
  return {
    listings: [],
    init() {
      fetch("/api/listings")
        .then((response) => response.json())
        .then((data) => {
          this.listings = data;
          this.renderListings();
        });
    },
    renderListings() {
      const listingsContainer = document.getElementById("listings");
      let listingsHtml = "";
      this.listings.forEach((listing) => {
        listingsHtml += `
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <h2 class="text-xl font-bold">${listing.title}</h2>
                        <p class="text-gray-600">${listing.description}</p>
                    </div>
                `;
      });
      listingsContainer.innerHTML = listingsHtml;
    },
  };
}
