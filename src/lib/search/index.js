const searchBar = document.getElementById("search");
const genreChoice = document.getElementById("selector");

function match(first, second) {
    first = first.toLowerCase();
    second = second.toLowerCase();
    return first.includes(second) || second.includes(first);
}

function filterShows() {
    let count = 0;
    for (let k in fastElementAccess) {
        if (fastElementAccess.hasOwnProperty(k)) {
            const ele = fastElementAccess[k];
            const genres = Object.entries(originalElement[k].genre).map(([_,v]) => v.name);
            if (match(originalElement[k].name, searchBar.value) &&
                (genreChoice.value === "0" || genres.includes(genreChoice.value))
            ) {
                count++;
                ele.style.margin = "16px";
                ele.style.width = "400px";
                ele.style.opacity = "1";
                ele.style.borderWidth = "4px";
            } else {
                ele.style.margin = "0";
                ele.style.width = "0";
                ele.style.opacity = "0";
                ele.style.borderWidth = "0";
            }
        }
    }
    const nothing = document.getElementById("no-shows-found");
    if (count > 0) {
        nothing.style.display = "none";
    } else {
        nothing.style.display = "block";
    }
}

genreChoice.addEventListener("input", () => {
    filterShows();
});

searchBar.addEventListener("input", () => {
    filterShows();
});
