function search() {
    let url = new URL(window.location.href);
    const query = document.querySelector('#dvd-search-input').value.trim();

    url.searchParams.set("Search", query);
    window.location.href = url.toString();
}