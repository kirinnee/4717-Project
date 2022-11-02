const searchBar = document.getElementById("search");
const genreChoice = document.getElementById("selector");
function getWidth() {
    return Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0)
}

function isMobile() {
    return getWidth() < 600;
}

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
                ele.style.opacity = "1";
                ele.style.borderWidth = "4px";
                if(isMobile()) {
                    ele.style.display = "flex";
                }else {
                    ele.style.width = "400px";
                }
            } else {
                ele.style.margin = "0";
                ele.style.opacity = "0";
                ele.style.borderWidth = "0";
                if(isMobile()) {
                    ele.style.display = "none";
                }else {
                    ele.style.width = "0";
                }
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

const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});

if(params.genre != null) {
    setTimeout(()=>{
        const select = document.querySelector("#selector");
        select.value = params.genre;
        select.dispatchEvent(new Event("input"));

    },1)
}
