function toggleBookmarkDetail(gameId, formElement) {
    fetch("/bookmark", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
        body: JSON.stringify({ game_id: gameId }),
    })
        .then((res) => res.json())
        .then((data) => {
            alert(data.message);

            if (!data.bookmarked) {
                const card = formElement.closest(".bookmark-card");
                if (card) card.remove();

                const grid = document.getElementById("bookmark-grid");
                const emptyMessage = document.getElementById("empty-message");

                // Jika tidak ada anak lagi dalam grid, tampilkan pesan kosong
                if (!grid || grid.children.length === 0) {
                    if (grid) grid.remove(); // hapus grid dari DOM
                    if (emptyMessage) emptyMessage.classList.remove("hidden");
                }
            }
        })
        .catch((err) => console.error("Error:", err));
}

function toggleBookmark(gameId, formElement) {
    fetch("/bookmark", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({ game_id: gameId }),
    })
        .then((response) => response.json())
        .then((data) => {
            const button = formElement.querySelector(".bookmark-button");

            // Hapus semua kelas warna dulu
            button.classList.remove("text-blue-500", "text-gray-500");

            // Tambahkan kelas warna sesuai status bookmark
            if (data.bookmarked) {
                button.classList.add("text-blue-500");
            } else {
                button.classList.add("text-gray-500");
            }
        })
        .catch((error) => console.error("Error:", error));
}
