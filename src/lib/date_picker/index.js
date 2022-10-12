let currentDate = "";

function chooseDate(opt) {
    const dates = [...document.querySelectorAll(".date-picker-container .date")];
    dates.forEach(d => {
        d.classList.remove("chosen")
    })
    dates.forEach( d => {
        if(d.getAttribute("option") == opt.toString()) {
            d.classList.add("chosen");
        }
    })
}
