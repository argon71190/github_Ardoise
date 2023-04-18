
function deleteValidation(){
    let deleteBtn = document.getElementById('deleteBtn');
    let modal = document.getElementById('modal');
    let cancelBtn = document.getElementById('cancelBtn');
    let cancelIcon = document.getElementById('cancelIcon');
    let backdrop = document.getElementById('backdrop');

    window.addEventListener('click', function(e){
        if(deleteBtn.contains(e.target)){
            modal.style.display='block';
            backdrop.style.display='block';
        }
        else if(!modal.contains(e.target) || cancelBtn.contains(e.target) || cancelIcon.contains(e.target)){
            modal.style.display='none';
            backdrop.style.display='none';
        }
    });
}

export { deleteValidation };