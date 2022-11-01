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
        display.innerText = `Unallocated Seats: ${capacity-consumed}`
    }

    function getStats() {
        return {
            capacity,
            consumed,
        }
    }

    function updateCon(number) {
        consumed = number;
        display.innerText = `Unallocated Seats: ${capacity-consumed}`
    }

    function reset(chosen) {

        $$$(".seats .seat").forEach(e => {
            if(e.innerText !== "") {
                e.classList.remove("taken")
                e.classList.remove("picked")
                const show = shows.shows[chosen];
                const empty = Object.entries(show.seats)
                    .map(([k,v])=>v)
                    .some(v => v.no === e.innerText && v.status === "EMPTY");
                if(!empty) {
                    e.classList.add("taken");
                }
            }

        })
        updateCap(0);
    }

    showTime.register((c) => {
        reset(c);
    });

    // register clicks
    $$$(".seats .seat").forEach(e => {
        e.addEventListener("click", () => {
            if(![...e.classList].includes("taken")) {
                if([...e.classList].includes("picked")) {
                    e.classList.remove("picked");
                    capacity--;
                } else {
                    e.classList.add("picked");
                    capacity++;
                }
                updateCap(capacity);
            }
        });
    })

    reset($$("input[name=show]:checked").value);
    updateCap(0);
    counter.addCallback((t, cost) => {
        updateCon(t);
        $$(".pay .cost").innerText = `Total Cost: $ ${cost.toFixed(2)}`;
    })
    return {
        getStats,
    }
}

seating();
