const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const type = urlParams.get("type");
const code = urlParams.get("code");

document.getElementById("intention1").addEventListener("click", () => {
    window.location.href =
        "https://www.tmysam.top/Property/template.html?type=" + type;
});
document.getElementById("intention2").addEventListener("click", () => {
    window.location.href =
        "https://www.tmysam.top/caseManager/?caseid=PROP-" + code;
});
