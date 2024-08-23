function orderBy(column) {
    let url = new URL(window.location.href);
    let orderDesc = url.searchParams.get('OrderDesc');
    url.searchParams.set("OrderBy", column);
    if (!orderDesc || orderDesc === "") {
        url.searchParams.set("OrderDesc", "True");
    } else if (orderDesc === "True") {
        url.searchParams.set("OrderDesc", "False");
    } else if (orderDesc === "False") {
        url.searchParams.set("OrderDesc", "");
        url.searchParams.set("OrderBy", "");
    }

    window.location.href = url.toString();
}

function search() {
    let url = new URL(window.location.href);
    const query = document.querySelector('#dvd-search-input').value.trim();
    if (query) {
        url.searchParams.set("Search", query);
    }
    window.location.href = url.toString();
}

function changePage(offset) {
    let url = new URL(window.location.href);
    url.searchParams.set("Offset", offset);
    window.location.href = url.toString();
}