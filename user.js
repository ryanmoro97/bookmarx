var urlChecker;
var bookmark;
var edit = "edit";
var bms;
var selectedLink;

function registerListeners(){
    document.getElementById("edit").addEventListener("click", function() {
        editBookmarks();
    }, false);
    document.getElementById("add").addEventListener("click", function() {
        addBookMarkPrompt();
    }, false);
    document.getElementById("logout").addEventListener("click", function() {
        logout();
    }, false);
}

function logout(){
    window.location.replace("main.php");
}

// get onclick link item to retreive selected item for coming action
function registerEditListeners(){
    var radios = document.forms["editLinks"].elements["bmItem"];
    for(var i = 0, max = radios.length; i < max; i++) {
        radios[i].onclick = function() {
            getSelectedLink();
        }
    }
    document.getElementById("editLink").addEventListener('click', function(){editLink()});
    document.getElementById("deleteLink").addEventListener('click', function(){deleteLink()});
    document.getElementById("Cancel").addEventListener('click', function(){cancelEdit()});
}


function editBookmarks(){
    editBookmarkContext();
    // retreive bookmark div
    bms = document.getElementsByName("bookmark");
    var len = bms.length;
    //create form for picking element to edit
    let form = document.createElement('form');
    form.setAttribute('name', 'editLinks');
    //retrieve div to populate with form
    var bmForm = document.getElementById("editBookmarks");
    bmForm.style.display = "block";
    for(var i = 0; i < len; i++) {
        //for each bookmark create a radio option selection
        var bm = bms[i];

        let label = document.createElement('label');
        label.setAttribute('for', bm);
        label.style.textDecoration = "underline";
        label.textContent = bm.textContent;
        form.appendChild(label);
        let radio = document.createElement('input');
        radio.setAttribute('type', 'radio');
        radio.setAttribute('name', 'bmItem');
        form.appendChild(radio);
        form.innerHTML += "<br><br>"
    }
    bmForm.appendChild(form);
    registerEditListeners();
}

function getSelectedLink(){
    var radios = document.forms["editLinks"].elements["bmItem"];
    for(var i = 0, max = radios.length; i < max; i++) {
        if (radios[i].checked) {
            selectedLink = i;
            bookmark = bms[selectedLink].getAttribute('href');
            break;
        }
    }
}

function editLink(){
    if(bookmark == null){
        alert("No bookmark selected");
        return;
    }
    var uneditedBookmark = document.getElementById(bookmark);
    var editedBookmark = prompt("Edit your bookmark",bookmark);

    var valid = checkLinkValid(editedBookmark);
    if(valid == true){
        $.post( "editbookmark.php", {bookmark : bookmark, editedBookmark : editedBookmark});
        regularContext();
        location.reload();
    }
    else{
        alert("This is not a valid url");
    }
}

function deleteLink(){
    if(bookmark == null){
        alert("No bookmark selected");
        return;
    }
    var confirmDel = confirm("Are you sure you want to remove this bookmark? \n" + bookmark);
    if(confirmDel){
        // remove from database
        $.post( "deletebookmark.php", {bookmark : bookmark});
    }
    regularContext();
    location.reload();
}

function cancelEdit(){
    regularContext();
}

// fix content display for context of editing
function editBookmarkContext(){
    document.getElementById("bm").style.display = "none";
    document.getElementById("add").style.display = "none";
    document.getElementById("edit").style.display = "none";
    document.getElementById("editBtns").style.display = "block";


}

// fix content display for regular context
function regularContext(){
    document.getElementById("bm").style.display = "block";
    document.getElementById("edit").style.display = "block";
    document.getElementById("add").style.display = "block";
    document.getElementById("editBtns").style.display = "none";
    document.getElementById("editBookmarks").innerHTML = "";
    selectedLink = null;

}

function addBookMarkPrompt(){
    bookmark = prompt("Paste the url");
    addBookMark();
    // var valid = checkLinkValid(url);
    // if(valid == true){
    // }
    // else{
    //     alert("This is not a valid url");
    // }
}

function checkLinkValid(url){
//     console.log("checking");
//     if(urlChecker.readyState === 4){
//         if(urlChecker.status == 200 || urlChecker.status == 0){
//             // url is valid and live -- add to bookmarks
//             console.log("VALID");
//         }
//         else{
//             //invalid url - exit and display error message
//             console.log("INVAAALID");
//         }
//     }
}

// create element for new bookmark and append to the bookmarks div
function addBookMark () {
    if(bookmark != ""){
        var newBookmark = document.createElement('newBookmark');
        newBookmark.setAttribute('href',bookmark);
        newBookmark.innerHTML = bookmark;
        newBookmark.style.textDecoration = "underline";
        if(document.getElementById(bookmark) != null){
            alert("You already have this bookmark");
            return;
        }
        newBookmark.id = bookmark;
        const bookmarkDiv = document.getElementById("bm");
        bookmarkDiv.appendChild(newBookmark);
        bookmarkDiv.innerHTML += "<br><br>"
        // need to add this new bookmark to database
        $.post("addbookmark.php", {bookmark : bookmark});
        location.reload();
    }
    else{
        alert("Bookmark cannot be empty");
    }
}

function setup(){
        registerListeners();
        regularContext();
}

window.addEventListener( "load",setup , false );

