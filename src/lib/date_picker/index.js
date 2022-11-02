function transformMovies(movies) {
    return Object.entries(movies)
        .map(([_, {
            name,
            desc,
            duration,
            genre,
            id,
            rating,
            releaseDate,
            trailer,
            shows,
            image1,
            image2,
            poster,
        }]) => {
            const movie = {
                name,
                desc,
                duration,
                genre,
                id,
                rating,
                releaseDate,
                trailer,
                image1,
                image2,
                poster,
                shows: {},
            }
            for (let k in shows) {
                if (shows.hasOwnProperty(k)) {
                    const show = shows[k];
                    if (movie.shows[show.date] == null) movie.shows[show.date] = [];
                    movie.shows[show.date].push({
                        date: show.date,
                        id: show.id,
                        theatre: show.theatre,
                        time: show.time,
                    })
                }
            }
            return movie;
        })
        .map(({
                  name,
                  desc,
                  duration,
                  genre,
                  id,
                  image1,
                  image2,
                  poster,
                  rating,
                  releaseDate,
                  trailer,
                  shows
              }) => Object.entries(shows)
            .map(([date, shows]) => {
                return {
                    name,
                    desc,
                    duration,
                    genre,
                    id,
                    image1,
                    image2,
                    poster,
                    rating,
                    releaseDate,
                    trailer,
                    date,
                    shows,
                }
            })
        ).flat();
}

const movies = transformMovies(getMovies());

function chooseDate(opt) {
    const dates = [...document.querySelectorAll(".date-picker-container .date")];
    dates.forEach(d => {
        d.classList.remove("chosen")
    })
    dates.forEach(d => {
        if (d.getAttribute("option") === opt.toString()) {
            d.classList.add("chosen");
            const dateStr = d.getAttribute("date-val");

            const content = movies
                .sort((a, b) => new Date(a.date) - new Date(b.date))
                .filter(movie => {
                    const today = new Date();
                    const sevenDays = new Date(today);
                    sevenDays.setDate(sevenDays.getDate() + 7);
                    const mDate = new Date(movie.date);
                    console.log(today, sevenDays, mDate);
                    if (dateStr === "null") return  mDate >= today && mDate <= sevenDays ;
                    return movie.date === dateStr;
                })
                .map(e => showElement(dateStr === "null", e))
                .reduce((a, b) => a + b);
            document.getElementById("all-shows").innerHTML = content;


        }
    })

}
