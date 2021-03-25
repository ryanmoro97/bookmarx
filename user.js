
function registerListeners(){
    document.getElementById("edit").addEventListener("input", function() {
        makeBookMarksEditable();
    }, false);
    // document.getElementById("edit").addEventListener("input", function() {
    //     makeBookMarksEditable();
    //     console.log("input event fired");
    // }, false);

}

function makeBookMarksEditable(){
    // ITERATE THROUGH BOOKMARKS BY TAG NAME!!!!???
    document.getElementById("bm1").contentEditable = true;
    // document.getElementById("bm2").contentEditable = true;
    // document.getElementById("bm3").contentEditable = true;
}


function addBookMark(){
    document.body.onload = addElement;
    /// .. chang ethis
    function addElement () {
        // create a new div element
        const newDiv = document.createElement("div");

        // and give it some content
        const newContent = document.createTextNode("Hi there and greetings!");

        // add the text node to the newly created div
        newDiv.appendChild(newContent);

        // add the newly created element and its content into the DOM
        const currentDiv = document.getElementById("div1");
        document.body.insertBefore(newDiv, currentDiv);
    }
}

function setup(){
    registerListeners();
}

window.addEventListener( "load",setup() , false );

