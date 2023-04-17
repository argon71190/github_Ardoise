
function deleteValidation(){
    let deleteCustomer = document.getElementById('deleteCustomer');
    let deleteValidation = document.getElementById('deleteValidation');
    let deleteCancel = document.getElementById('deleteCancel');

    deleteCustomer.addEventListener('click', function(){
        deleteValidation.style.display='block';
    });
    deleteCancel.addEventListener('click', function(){
        deleteValidation.style.display='none';
    });
}

export { deleteValidation };
