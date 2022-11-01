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

register("#pay-name", validName)
register("#pay-email", validEmail)
register("#pay-cc", validCC)

const regValid = validatorBuilder([
    ["#pay-name", validName],
    ["#pay-email", validEmail],
    ["#pay-cc", validCC],
])
