function showElement(showDate, movie) {
    const dateDiv = () => {
        return `<div class="date">
            <div class="actual-date">
                <div>${(new Date(movie.date)).toLocaleDateString("en-US", {month: "short", day: "numeric"})}</div>

            </div>
            <div class="day">
                <div>${(new Date(movie.date).toLocaleDateString("en-US", {weekday: "short"}))}</div>
            </div>
        </div>`;
    }

    const times = movie.shows
        .map(show =>
            `<a class="action">
                Book Now! <br>
                ${show.time}@${show.theatre.name}
            </a>`
        )
        .reduce((a, b) => a + b);

    const contentDiv = `<div class="content">
        <div class="image">
            <img src="${movie.poster}" alt="${movie.name}">
        </div>
         <div class="description">
            <div class="title">${movie.name}</div>
            <div class="desc">
                ${movie.desc}
            </div>
        </div>
        <div>
            ${times}
        </div>
    </div>`

    return `<div class="show">${showDate ? dateDiv() : ""}${contentDiv}</div>`
}
