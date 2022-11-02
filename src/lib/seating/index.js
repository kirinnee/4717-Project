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
                const seatArr = Object.entries(show.seats)
                    .map(([k,v])=>v);
                e.setAttribute("seatId", seatArr.find(v=> v.no === e.innerText ).id);
                const empty = seatArr
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

    const seatTracker = $$("#seat-tracker");
    // register clicks
    $$$(".seats .seat").forEach(e => {

        e.addEventListener("click", () => {
            if(![...e.classList].includes("taken")) {
                try {
                    const seatNumber = parseInt(e.innerText);
                    const seatId = parseInt(e.getAttribute("seatId"));
                    let current = JSON.parse(seatTracker.value);
                    if([...e.classList].includes("picked")) {
                        e.classList.remove("picked");
                        capacity--;
                        current = current.filter(x => x.no !== seatNumber );
                    } else {
                        e.classList.add("picked");
                        capacity++;
                        current.push({id: seatId, no: seatNumber})
                    }
                    seatTracker.value = JSON.stringify(current.sort((a,b) => a.no - b.no));
                    updateCap(capacity);
                }catch {

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
    return {
        getStats,
    }
}

const getStats = seating();

function ticketValid() {
    const stats = getStats.getStats();
    return stats.capacity === stats.consumed;
}
