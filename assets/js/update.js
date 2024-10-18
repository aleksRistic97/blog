function addAttachment(){
            
    var collectionHolder = document.getElementById('attachments-wrapper');

    var prototype = collectionHolder.getAttribute('data-prototype');

    var index = collectionHolder.querySelectorAll('input[type="file"]').length;

    var newForm = prototype.replace(/__name__/g, index);

    var newFormDiv = document.createElement('div');
    newFormDiv.classList.add('attachment-item'); 
    newFormDiv.innerHTML = newForm;

 
    newFormDiv.innerHTML += '<button type="button" id="special_style" onclick="removeAttachment(this)">X</button>';
    collectionHolder.appendChild(newFormDiv);
}


function removeAttachment(button) {
    var attachmentDiv = button.parentElement; 
    attachmentDiv.remove(); 
}

window.addAttachment = addAttachment;
window.removeAttachment = removeAttachment;