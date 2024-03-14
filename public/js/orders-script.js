document.addEventListener("DOMContentLoaded", function() {

    var radios = document.querySelectorAll('[type="radio"]');
    radios.forEach(function(radio) {
        const deliveryAdresse = document.getElementById("orders_deliveryAdresse");
        const billingAdresse = document.getElementById("orders_billingAdresse");

        radio.addEventListener('change', function() {
            if (radio.getAttribute("name") === "delivery_option"){
                if (radio.getAttribute("value") === "new") {
                    deliveryAdresse.style.height = deliveryAdresse.scrollHeight + "px";
                }  else {
                    deliveryAdresse.style.height = "0px"
                }

            } else if (radio.getAttribute("name") === "billing_option") {
                if (radio.getAttribute("value") === "new") {
                    billingAdresse.style.height = billingAdresse.scrollHeight + "px";
                }  else {
                    billingAdresse.style.height = "0px"
                }
            }
        })
    })
})