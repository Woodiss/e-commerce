document.addEventListener("DOMContentLoaded", function() {

    const account = document.querySelector('.account')
    const cancelBlur = document.getElementById('cancel-blur')
    const body = document.querySelector('body')
    const dropdown = document.querySelector('.dropdown')

    function downdownFocus(){
        body.classList.toggle("hidden");
        cancelBlur.classList.toggle("none");
        account.classList.toggle("scrollBarre")
        dropdown.classList.toggle("none")
    }

    account.addEventListener("click", downdownFocus)
    cancelBlur.addEventListener("click", downdownFocus)
});