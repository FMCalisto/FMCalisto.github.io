var dragSrcEl = null;

function dragStart(event) {
    event.dataTransfer.setData("Text", event.target.id);
}

function dragEnter(event) {
    if ( event.target.className == "droptarget" ) {
        document.getElementById("demo").innerHTML = "Entered the dropzone";
        event.target.style.border = "3px dotted red";
    }
}

function dragLeave(event) {
    if ( event.target.className == "droptarget" ) {
        document.getElementById("demo").innerHTML = "Left the dropzone";
        event.target.style.border = "";
    }
}

function allowDrop(event) {
    event.preventDefault();
}

function drop(event) {
    event.preventDefault();
    var data = event.dataTransfer.getData("Text");
    event.target.appendChild(document.getElementById(data));
}

// ================
