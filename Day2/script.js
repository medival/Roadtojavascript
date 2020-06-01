function time() {
    const now = new Date();
    const sec = now.getSeconds();
    const secDegree = (((sec + 15) / 60) * 360);
    document.getElementById("second").style.transform = `rotate(${secDegree}deg)`;

    const minute = now.getMinutes();
    const minDegree = (((minute + 15) / 60) * 360);
    document.getElementById("minute").style.transform = `rotate(${minDegree}deg)`;

    const hour = now.getHours();
    const hourDegree = (((hour + 15) / 12) * 360);
    document.getElementById("hour").style.transform = `rotate(${hourDegree}deg)`;

    document.getElementById("secLabel").innerHTML = now.getSeconds();
    document.getElementById("minuteLabel").innerHTML = now.getMinutes();
    document.getElementById("hoursLabel").innerHTML = now.getHours();
}
setInterval(time, 1000);