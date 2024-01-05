let currentBannerIndex = 0;

const banners = document.querySelectorAll('.banner');

function showBanner(index) {
    banners.forEach((banner, i) => {
        banner.classList.remove('banner-active', 'slide-left', 'slide-right');
        if (i === index) {
            banner.classList.add('banner-active');
            if (i < currentBannerIndex) {
                banner.classList.add('slide-left');
            } else if (i > currentBannerIndex) {
                banner.classList.add('slide-right');
            }
        }
    });
}


function nextBanner() {
    banners[currentBannerIndex].classList.remove('banner-active');
    banners[currentBannerIndex].classList.add('slide-left');

    currentBannerIndex = (currentBannerIndex + 1) % banners.length;

    banners[currentBannerIndex].classList.add('banner-active');
    banners[currentBannerIndex].classList.remove('slide-right');
}

function prevBanner() {
    banners[currentBannerIndex].classList.remove('banner-active');
    banners[currentBannerIndex].classList.add('slide-right');

    currentBannerIndex = (currentBannerIndex - 1 + banners.length) % banners.length;

    banners[currentBannerIndex].classList.add('banner-active');
    banners[currentBannerIndex].classList.remove('slide-left');
}

// Au chargement de la page, afficher la première bannière
showBanner(currentBannerIndex);