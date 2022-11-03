function seating() {
    const $$ = (s) => document.querySelector(s);
    const $$$ = (s) => [...document.querySelectorAll(s)];

    const shows = getShows();


    let capacity = 0;
    let consumed = 0;
    const display = $$(".allocation .value")

    function updateCap(number) {
        counter.setMax(number);
        capacity = number;
        consumed = Math.min(consumed, capacity);
        display.innerText = `Unallocated Seats: ${capacity - consumed}`
    }

    function getStats() {
        return {
            capacity,
            consumed,
        }
    }

    function updateCon(number) {
        consumed = number;
        display.innerText = `Unallocated Seats: ${capacity - consumed}`
    }

    function reset(chosen) {

        $$$(".seats .seat").forEach(e => {
            if (e.innerText !== "") {
                e.classList.remove("taken")
                e.classList.remove("picked")
                const show = shows.shows[chosen];
                const seatArr = Object.entries(show.seats)
                    .map(([k, v]) => v);
                e.setAttribute("seatId", seatArr.find(v => v.no === e.innerText).id);
                const empty = seatArr
                    .some(v => v.no === e.innerText && v.status === "EMPTY");
                if (!empty) {
                    e.classList.add("taken");
                }
            }

        })
        updateCap(0);
    }

    showTime.register((c) => {
        reset(c);
    });

    const seatTracker = $$("#seat-tracker");
    // register clicks
    $$$(".seats .seat").forEach(e => {

        e.addEventListener("click", () => {
            if (![...e.classList].includes("taken")) {
                try {
                    const seatNumber = parseInt(e.innerText);
                    const seatId = parseInt(e.getAttribute("seatId"));
                    let current = JSON.parse(seatTracker.value);
                    if ([...e.classList].includes("picked")) {
                        e.classList.remove("picked");
                        capacity--;
                        current = current.filter(x => x.no !== seatNumber);
                    } else {
                        e.classList.add("picked");
                        capacity++;
                        current.push({id: seatId, no: seatNumber})
                    }
                    seatTracker.value = JSON.stringify(current.sort((a, b) => a.no - b.no));
                    updateCap(capacity);
                } catch {

                }

            }
        });
    })

    reset($$("input[name=show]:checked").value);
    updateCap(0);
    counter.addCallback((t, cost) => {
        updateCon(t);
        $$(".pay .cost").innerText = `Total Cost: $ ${cost.toFixed(2)}`;
    })

    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    });

    if (params.date != null && params.show) {
        setTimeout(() => {
            const select = document.querySelector("select.available-date");
            select.value = params.date;
            select.dispatchEvent(new Event("input"));
            select.dispatchEvent(new Event("change"));

            document.querySelector(`input[name=show][show='${params.show}']`).click()
        }, 1);
    }
    if (params.seats != null) {
        const seatArr = JSON.parse(params.seats);
        seatArr.forEach(e => {
            $$(`div.seat[seatid='${e.id}']`).click();
        })
    }

    $$$(".numeric input").forEach(e => {
        const n = e.getAttribute("name");
        try {
            parseInt(params[n])
            e.value = params[n];
            e.dispatchEvent(new Event("input"));
        }catch {

        }
    })



    return {
        getStats,
    }
}

const getStats = seating();

function ticketValid() {
    const stats = getStats.getStats();
    const valid = stats.capacity === stats.consumed;
    if (!valid) {
        const epanel = document.createElement("div");
        epanel.classList.add("error-panel");
        epanel.innerText = "Please allocate all your seats";
        document.querySelector(".seating .error-bar")
            .append(epanel);
        setTimeout(() => {
            epanel.style.opacity = "0";
            setTimeout(() => {
                epanel.remove();
            }, 5000)
        }, 1)
        return false;
    }
    if (stats.capacity == 0) {
        const epanel = document.createElement("div");
        epanel.classList.add("error-panel");
        epanel.innerText = "Please select at least 1 seat";
        document.querySelector(".seating .error-bar")
            .append(epanel);
        setTimeout(() => {
            epanel.style.opacity = "0";
            setTimeout(() => {
                epanel.remove();
            }, 5000)
        }, 1)
        return false;
    }
    return valid && stats.capacity != 0;
}
