let current = 0;
function moveLeft() {
    let prev = current;
    if(current == 0) {
        current = 4;
    }else {
        current--;
    }
    const ele = document.getElementById("real");
    if(prev != 0)
    ele.classList.remove(`m${prev}`);
    if(current != 0) ele.classList.add(`m${current}`);
}

function moveTo(n) {
    let prev = current;
    current = n;
    const ele = document.getElementById("real");
    if(prev != 0)
    ele.classList.remove(`m${prev}`);
    if(current != 0) ele.classList.add(`m${current}`);
}

function moveRight() {
    let prev = current;
    if(current == 4) {
        current = 0;
    }else {
        current++;
    }
    const ele = document.getElementById("real");
    if(prev != 0)
    ele.classList.remove(`m${prev}`);
    if(current != 0) ele.classList.add(`m${current}`);
}
