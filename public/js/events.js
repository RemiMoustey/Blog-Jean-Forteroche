function clickButton(idButton, printedMessage) {
    $("#" + idButton).on("click", function () {
        alert(printedMessage);
    });
}

clickButton("submit-comment", "Le Javascript fonctionne");