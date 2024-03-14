function toggle(id) {
    console.log(id);

    let divDetail = document.querySelector('.id' + id)
    if (divDetail.classList.contains('active')) {
        console.log("true");
        divDetail.style.height = "0px"
        divDetail.classList.remove('active')
    } else {
        console.log("false");
        divDetail.classList.add('active')
        divDetail.style.height = divDetail.scrollHeight + "px";
    }
}