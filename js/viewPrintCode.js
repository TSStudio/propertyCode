//get URL parameters
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(
        /[?&]+([^=&]+)=([^&]*)/gi,
        function (m, key, value) {
            vars[key] = value;
        }
    );
    return vars;
}
//get URL parameter by name
function getUrlVar(name) {
    return getUrlVars()[name];
}

let code = getUrlVar("code");
let codeURL = "https://a.cl15.top/" + code;
document.getElementById("codeImg").src =
    "https://security.tmysam.top/qrcode.php?code=" +
    encodeURIComponent(codeURL);
document.getElementById("code-to-show").innerHTML = code;
function openxxx() {
    window.open("https://a.cl15.top/" + code);
}
