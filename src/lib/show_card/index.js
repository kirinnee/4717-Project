function showElement(movie) {
    const genres = Object.entries(movie.genre)
        .map(([_, v]) => v.name)
        .reduce((a,b) => `${a} | ${b}`);
    return `
<div class="show-card" id="movie-${movie.id}">
    <div class="show-image">
        <img src="${movie.image}" alt="${movie.name}">
        <div class="overlay">
            <div>
                SEE MORE DETAILS
            </div>
        </div>
    </div>
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
        <div class="book-button">
            <div>
                BOOK NOW
            </div>
        </div>
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
