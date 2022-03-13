// for transaction count
let myAnimation1 = anime({
    targets: ".tcount",
    innerHTML: [0, tcount],
    easing: "linear",
    round: 1,
});
//for customer count
let myAnimation2 = anime({
    targets: ".cuscount",
    innerHTML: [0, cuscount],
    easing: "linear",
    round: 1,
});
//for coinrate
let myAnimation3 = anime({
    targets: ".coinrate",
    innerHTML: [0, coinrate],
    easing: "linear",
    round: 1,
});
//for Today Order
let myAnimation4 = anime({
    targets: ".todaycount",
    innerHTML: [0, toadyorder],
    easing: "linear",
    round: 1,
});
