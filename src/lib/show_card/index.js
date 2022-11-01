function showElement(movie) {
    const genres = Object.entries(movie.genre)
        .map(([_, v]) => v.name)
        .reduce((a,b) => `${a} | ${b}`);
    return `
<div class="show-card" id="movie-${movie.id}">
    <a class="show-image" href="./shows.php?id=${movie.id}">
        <img src="${movie.image2}" alt="${movie.name}">
        <div class="overlay">
            <div>
                SEE MORE DETAILS
            </div>
        </div>
    </a>
    <div class="genre">
        <div>${genres}</div>
    </div>
    <div class="title">
        <div>${movie.name.toUpperCase()}</div>
    </div>
    <div class="content">
        <div>${movie.desc}</div>
    </div>
    <div class="action-bar">
        <a class="book-button" href="./shows.php?id=${movie.id}">
            <div>
                BOOK NOW
            </div>
        </a>
    </div>

</div>`
}
const originalElement = getMovies();

const showElements = Object
    .entries(originalElement)
    .map(([k,v]) => {
        const ele = document.createElement("div");
        ele.innerHTML = showElement(v);
        return [k,ele.querySelector(".show-card")]
    });

const fastElementAccess = Object.fromEntries(showElements);


document.querySelector("#shows")
    .append(...showElements.map(([_,v]) => v));
