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

function validPassword(password) {
    if (password.length < 8) {
        return "Password needs to be at least 8 characters";
    }
    if (!password.match(/[a-z]/)) {
        return "Password must have a lower-case character";
    }
    if (!password.match(/[A-Z]/)) {
        return "Password must have a upper-case character";
    }
    if (!password.match(/[0-9]/)) {
        return "Password must have a number";
    }
    if (!password.match(/[^a-zA-Z0-9]/)) {
        return "Password must have a special character";
    }
    return "";
}

function crossCheck(password) {
    const main = document.querySelector("#reg-pw input[type=password]").value;
    const repeat = document.querySelector("#reg-pw-r input[type=password]").value;
    if (password !== main || password !== repeat || repeat !== main) {
        return "Passwords do not match";
    }
    return "";
}

register("#reg-name", validName)
register("#reg-email", validEmail)
register("#reg-pw", validPassword)
register("#reg-pw-r", crossCheck)
crossRegister("#reg-pw", "#reg-pw-r", crossCheck)


const regValid = validatorBuilder([
    ["#reg-name", validName],
    ["#reg-email", validEmail],
    ["#reg-pw", validPassword],
    ["#reg-pw-r", crossCheck],
])
