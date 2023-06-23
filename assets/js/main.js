function hideSearchBar() {
    document.getElementById('search').style.display = 'none';
}

function init() {
    if (window.location.pathname !== '/address/index') {
        hideSearchBar();
    }
}

init();
