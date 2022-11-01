function showTimes() {

    const $$ = (s) => document.querySelector(s);
    const $$$ = (s) => [...document.querySelectorAll(s)];

    const callbacks = [];

    const register = c => callbacks.push(c);

    function onShowChange() {
        callbacks.forEach(c => c($$("input[name=show]:checked").value));
    }

    function registerRadios() {
        const radios = $$$("input[name=show]");
        radios.forEach(r => {
            r.addEventListener("input", () => onShowChange());
            r.addEventListener("change", () => onShowChange());
        });
    }

    const shows = getShows();
    const select = $$("select.available-date");
    select.addEventListener("change", () => {
        $$$("table.selection tr").forEach(e => e.remove());

        const all = Object.entries(shows.shows)
            .map(([_, v]) => v)
            .filter(v => v.date === select.value);

        $$("table.selection").append(...generateElements(all))
        registerRadios();
        onShowChange()
    });

    registerRadios();



    return {
        register,
    }
}

function generateElements(shows) {
    const _ = tag => document.createElement(tag);

    // header
    const tr = _("tr");
    const th1 = _("th")
    th1.innerText = "Theatre";
    const th2 = _("th")
    th2.innerText = "Time";
    const th3 = _("th")
    th3.innerText = "Select";
    tr.append(th1, th2, th3);


    const elements = shows.map((show, i) => {
        const row = _("tr");
        const loc = _("td");
        const time = _("td");
        const radio = _("td");
        const radioI = _("input");
        radio.append(radioI);
        row.append(loc, time, radio);

        loc.innerText = show.theatre.name;
        time.innerText = new Date("2022-01-01 " + show.time).toLocaleTimeString("en-us", {
            hour: "2-digit",
            minute: "2-digit"
        });
        if (i === 0) radioI.setAttribute("checked", "true");
        radioI.setAttribute("type", "radio");
        radioI.setAttribute("name", "show");
        radioI.setAttribute("value", show.id);
        return row;
    })
    return [tr, ...elements];
}

const showTime = showTimes()
