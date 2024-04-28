function toggle(id) {

    let divDetail = document.querySelector('.id' + id)
    let chevron = document.querySelector(".detail" + id + " img")
    let order = document.querySelector(".order" + id)

    if (!divDetail.classList.contains('active')) {
        order.classList.add("order-active")
        chevron.style.transform = "rotate(180deg)"
        divDetail.classList.add('active')
        divDetail.style.height = divDetail.scrollHeight + "px";
    } else {
        order.classList.remove("order-active")
        chevron.style.transform = "rotate(0deg)"
        divDetail.style.height = "0px"
        divDetail.classList.remove('active')
    }
}