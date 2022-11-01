function register(selector, validator) {
    const element = document.querySelector(selector);
    const error = element.querySelector(".generic-error");
    const check = element.querySelector(".generic-check");
    const input = element.querySelector("input.generic-input");

    input.addEventListener("input", () => {
        const e = validator(input.value);
        if(e === "" ) {
            error.innerText = "no error"
            error.style.opacity = "0";
            check.style.opacity = "1";
        } else {
            error.innerText = e
            error.style.opacity = "1";
            check.style.opacity = "0";
        }
    });
}

function crossRegister(input, target, validator) {
    const selectorInput = document.querySelector(input);
    const selectorTarget = document.querySelector(target);
    const error = selectorTarget.querySelector(".generic-error");
    const check = selectorTarget.querySelector(".generic-check");
    const i = selectorInput.querySelector("input.generic-input");

    i.addEventListener("input", () => {
        const e = validator(i.value);
        if(e === "" ) {
            error.innerText = "no error"
            error.style.opacity = "0";
            check.style.opacity = "1";
        } else {
            error.innerText = e
            error.style.opacity = "1";
            check.style.opacity = "0";
        }
    });
}

function validatorBuilder(valid) {

    return function() {
        for(let i = 0; i< valid.length; i++ ) {
            const [selector, validator] = valid[i];
            const input = document.querySelector(`${selector} input.generic-input`);
            if(validator(input.value) !== "") {
                return false;
            }
        }
        return true;
    }

}
