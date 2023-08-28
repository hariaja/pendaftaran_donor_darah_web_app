function disableSubmitButton() {
    var submitButton = document.getElementById("submit-button");
    submitButton.disabled = true;
    submitButton.classList.add("loading");
    submitButton.innerText = "Loading";
}
