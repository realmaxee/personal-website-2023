function typeInnerHTML(targetElement, text, currentLetter, time) {
    if (text.length < currentLetter) {
        targetElement.innerHTML = text
    } else {
        targetElement.innerHTML = text.substring(0,currentLetter) + "|";
        setTimeout(typeInnerHTML, time, targetElement, text, currentLetter + 1, time);
    }
}

function typeElement(element, text, start_time, wait_time) {
    setTimeout(typeInnerHTML,start_time,element, text, 1, wait_time);
}