function ticketInput() {

    const $$ = (s) => document.querySelector(s);
    const $$$ = (s) => [...document.querySelectorAll(s)];

    const callbacks = [];

    let max = 64;

    function setMax(m) {
        max = m;
        if(max < total()) {
            $$$(".numeric input").forEach(e => {
                const diff = total() - m;
                const val = parseInt(e.value);
                if(diff === 0) {
                } else if( val >= diff) {
                    e.value = val - diff;
                } else {
                    e.value = 0;
                }
                e.setAttribute("prev", e.value)
            })
        }
        onUpdate(total(), totalCost());
    }

    addCallback = (s) => callbacks.push(s);

    function total() {
        return $$$(".numeric input").map(x => parseInt(x.value))
            .reduce((a, b) => a + b, 0);
    }

    function totalCost() {
        return $$$(".numeric input").map(x => parseInt(x.value) * parseFloat(x.getAttribute("cost")))
            .reduce((a, b) => a + b, 0);
    }

    function onUpdate(total, cost) {
        callbacks.forEach(cb => cb(total, cost));
    }

    function numberOnly(ele) {
        ele.addEventListener("input", () => {
            ele.value = ele.value.split('')
                .filter(x => x >= "0" && x <= "9").join('');
            if (total() <= max) {
                ele.setAttribute("prev", ele.value);
            } else {
                ele.value = ele.getAttribute("prev");
            }
            onUpdate(total(), totalCost());
        });
    }

    function control(ele) {

        const input = ele.querySelector("input")
        const plus = ele.querySelector(".plus")
        const minus = ele.querySelector(".minus")
        numberOnly(input);

        plus.addEventListener("click", () => {
            if (total() + 1 <= max) {
                input.value = Math.min(parseInt(input.value) + 1, 99);
            }
            onUpdate(total(), totalCost());
        });

        minus.addEventListener("click", () => {
            input.value = Math.max(parseInt(input.value) - 1, 0);
            onUpdate(total(), totalCost());
        });
    }

    $$$(".ticket-input").forEach(e => control(e));

    return {
        setMax,
        addCallback,
    }
}

const counter = ticketInput();
