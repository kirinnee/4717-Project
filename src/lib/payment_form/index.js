function validName(name) {
    if (name.length < 2) {
        return "Name needs to be more than 1 character";
    }
    if (name.length > 64) {
        return "Name cannot be more that 64 character";
    }
    if (name.match(/^.*\s+$/)) {
        return "Name cannot end with spaces";
    }
    if (name.match(/^.*-+$/)) {
        return "Name cannot end with -";
    }
    if (name.match(/^.*_+$/)) {
        return "Name cannot end with _";
    }
    if (name.match(/^[a-zA-Z0-9-_\s]+$/)) {
        return "";
    }
    return "Name needs to be alphanumeric, _ or -"
}

function validEmail(email) {
    if (email.length < 2) {
        return "Email needs to be more than 1 character";
    }
    if (email.length > 64) {
        return "Email cannot be more that 64 character";
    }
    if (email.split("@").length !== 2) {
        return "Email must have 1 @ sign, only";
    }
    if (!email.match(/^[a-zA-Z].*$/)) {
        return "Email must start with alphabet";
    }
    if (!email.match(/^.*@([a-z][a-z\-0-9]*\.)+([a-z]{2,})$/)) {
        return "Email must conform to DNS specification, and cannot be TLD";
    }
    return "";

}

function validCC(cc) {
    if (/[^0-9-\s]+/.test(cc))
        return "Only digits and '-' accepted";

    if (!cc.match(/^\d\d\d\d-\d\d\d\d-\d\d\d\d-\d\d\d\d$/))
        return "CC needs to be in xxxx-xxxx-xxxx-xxxx format";

    let nCheck = 0, bEven = false;
    cc = cc.replace(/\D/g, "");

    for (let n = cc.length - 1; n >= 0; n--) {
        let cDigit = cc.charAt(n),
            nDigit = parseInt(cDigit, 10);

        if (bEven && (nDigit *= 2) > 9) nDigit -= 9;

        nCheck += nDigit;
        bEven = !bEven;
    }

    return (nCheck % 10) == 0 ? "" : "Not a valid Credit Card Number";
}

function validExpiry(exp) {
    if(exp.split("/").length !== 2) {
        return "Format in MM/YY"
    }
    const [a,b] = exp.split("/");
    try {
        const m = parseInt(a);
        if(m < 1 || m > 12) {
            return "MM has to be 1 to 12"
        }
        try {
            const yy = parseInt(b);
            const now = new Date();
            const cY = now.getFullYear();
            const cM = now.getMonth() + 1;
            if( yy + 2000 < cY) {
                return "The card cannot be expired"
            }else if (yy + 2000 > cY) {
                return "";
            } else  if(m < cM){
                return "The card cannot be expired"
            } else if(m === cM){
                return "The card expires this month";
            }
        }catch {
            return "YY has to be a valid year in digits"
        }
    }catch {
        return "MM has to be a valid month in digits"
    }
    return "";
}

function validCVV(cvv) {
    if(cvv.length !== 3) {
        return "CVV is 3 digits long"
    }
    if(cvv.match(/\D/)) {
        return "CVV only allow digits"
    }
    return "";
}

function limitCVV(ele) {
    ele.addEventListener("input", ()=> {
        ele.value = ele.value.split('')
            .filter(x => x.match(/^\d$/))
            .join("").substring(0, 3);
    })
}

register("#pay-name", validName)
register("#pay-email", validEmail)
register("#pay-cc", validCC)
register("#pay-date", validExpiry)
register("#pay-cvv", validCVV)

limitCVV(document.querySelector("#pay-cvv input.generic-input"))

const payValid = validatorBuilder([
    ["#pay-name", validName],
    ["#pay-email", validEmail],
    ["#pay-cc", validCC],
    ["#pay-date", validExpiry],
    ["#pay-cvv", validCVV],
])
