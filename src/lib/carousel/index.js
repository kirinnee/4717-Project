function carousel(numberOfImages, id) {


    const $$$ = (s) => [...document.querySelectorAll(s)]

    function getEle() {
        return document.getElementById(id);
    }
    const moveTo = function (n) {
        const ele = getEle();



        current = n;

        $$$(`#slider-${id} .radio`).forEach((e) => {
            if(e?.getAttribute("radio-index") === `${current}`) {
                e.classList.add("cslide");
            } else {
                e.classList.remove("cslide");
            }
        })
        ele.style.left = `${10 - current * 80}%`



    }
    const moveLeft = function () {
        moveTo(current === 0 ?  numberOfImages - 1 :current - 1);
    };
    const moveRight = function () {
        moveTo(current == numberOfImages - 1 ? 0 :current + 1);
    }

    let counter = 0;
    const seconds = 10;
    function jumper() {
        setTimeout(() => {
            if(counter % seconds === seconds - 1) {
                moveRight();
            }
            counter++;
            $$$(`#slider-${id} .radio`).forEach((e) => {
                if(e?.getAttribute("radio-index") === `${current}`) {
                    e.querySelector(".radio-display-inner-colored").style.width = `${((counter % seconds) / (seconds - 1) * 10)}px`;
                    e.querySelector(".radio-display-inner-colored").style.height = `${((counter % seconds) / (seconds - 1) * 10)}px`;
                } else {
                    e.querySelector(".radio-display-inner-colored").style.width = "0";
                    e.querySelector(".radio-display-inner-colored").style.height = "0";
                }
            })
            jumper();
        }, 1000);

    }

    let current = 0;
    return {
        init : function (){
            const ele = getEle();
            ele.style.width = `${numberOfImages * 80}%`;
            moveTo(0);
            jumper();
        },
        moveLeft,
        moveTo,
        moveRight,
    }


}
