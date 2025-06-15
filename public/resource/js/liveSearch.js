document.addEventListener("DOMContentLoaded", function () {
    // Desktop hover
    const profileContainer = document.getElementById("profileContainer");
    const profilePopup = document.getElementById("profilePopup");
    if (profileContainer && profilePopup) {
        profileContainer.addEventListener("mouseenter", () => {
            profilePopup.classList.remove(
                "invisible",
                "opacity-0",
                "pointer-events-none"
            );
            profilePopup.classList.add(
                "visible",
                "opacity-100",
                "pointer-events-auto"
            );
        });
        profileContainer.addEventListener("mouseleave", () => {
            profilePopup.classList.add(
                "invisible",
                "opacity-0",
                "pointer-events-none"
            );
            profilePopup.classList.remove(
                "visible",
                "opacity-100",
                "pointer-events-auto"
            );
        });
    }

    // Mobile profile popup
    const profileBtnMobile = document.getElementById("profileBtnMobile");
    const profilePopupMobile = document.getElementById("profilePopupMobile");
    if (profileBtnMobile && profilePopupMobile) {
        profileBtnMobile.addEventListener("click", function (e) {
            e.stopPropagation();
            profilePopupMobile.classList.toggle("hidden");
        });
        document.addEventListener("click", function () {
            if (!profilePopupMobile.classList.contains("hidden")) {
                profilePopupMobile.classList.add("hidden");
            }
        });
        profilePopupMobile.addEventListener("click", function (e) {
            e.stopPropagation();
        });
    }

    // Mobile login popup
    const loginPopupBtn = document.getElementById("loginPopupBtn");
    const loginPopupMobile = document.getElementById("loginPopupMobile");
    if (loginPopupBtn && loginPopupMobile) {
        loginPopupBtn.addEventListener("click", function (e) {
            e.stopPropagation();
            loginPopupMobile.classList.toggle("hidden");
        });
        document.addEventListener("click", function () {
            if (!loginPopupMobile.classList.contains("hidden")) {
                loginPopupMobile.classList.add("hidden");
            }
        });
        loginPopupMobile.addEventListener("click", function (e) {
            e.stopPropagation();
        });
    }
});

// Fungsi untuk mengubah teks menjadi slug
function slugify(text) {
    return text
        .toString()
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, '') // Hapus karakter selain huruf, angka, dan spasi
        .replace(/\s+/g, '-')         // Ganti spasi dengan tanda strip
        .replace(/-+/g, '-');         // Hapus strip berurutan
}

document.getElementById("searchInput").addEventListener("keyup", function () {
    let query = this.value;
    let resultsContainer = document.getElementById("searchResults");

    if (query.length > 0) {
        fetch(`/live-search?q=${encodeURIComponent(query)}`)
            .then((response) => response.json())
            .then((data) => {
                resultsContainer.innerHTML = "";
                if (data.length > 0) {
                    data.forEach((game) => {
                        let item = document.createElement("div");
                        item.innerHTML = `
                            <a href="/game/${slugify(game.title)}" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-100">
                                <img src="${
                                    game.cover_image
                                        ? "/storage/" + game.cover_image
                                        : "/images/default-cover.jpg"
                                }" alt="cover" class="w-10 h-10 object-cover rounded border">
                                <div>
                                    <div class="font-semibold text-sm">${game.title}</div>
                                    <div class="text-xs text-gray-500">${game.category_game || "-"}</div>
                                </div>
                            </a>
                        `;
                        resultsContainer.appendChild(item);
                    });
                    resultsContainer.style.display = "block";
                } else {
                    resultsContainer.innerHTML = `<div class="px-4 py-2 text-gray-500">Tidak ada hasil</div>`;
                    resultsContainer.style.display = "block";
                }
            });
    } else {
        resultsContainer.style.display = "none";
    }
});