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
