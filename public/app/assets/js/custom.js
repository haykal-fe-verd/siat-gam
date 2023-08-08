"use strict";

// Mengupdate jam setiap detik
setInterval(updateClock, 1000);

// Fungsi untuk mengupdate jam
function updateClock() {
    var currentDate = new Date();
    var hours = currentDate.getHours();
    var minutes = currentDate.getMinutes();
    var seconds = currentDate.getSeconds();
    var time = hours + ":" + addZero(minutes) + ":" + addZero(seconds);
    document.getElementById("current-time").textContent = time;
}

// Fungsi untuk menambahkan nol pada angka kurang dari 10
function addZero(num) {
    return (num < 10 ? "0" : "") + num;
}
