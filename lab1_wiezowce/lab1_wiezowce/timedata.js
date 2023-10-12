function gettheDate()
{
    Todays = new Date();
    TheDate =""+ (Todats.getMonth()+ 1) + " / " + todays.getDate() + " / " + (Todays.getYear()-100);
    document.getElementById("data").innerHTML = TheDate;
}

var timeID = null;
var timeRunning = false;

function stoplock()
{
    if(timerRunning)
        clearTimeout(timerID);
    timerRunning = false;
}

function startclock()
{
    stoplock();
    gettheDate()
    showtime();

}


function showtime()
{
    var now= new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds()
    var timeValue = "" +((hours>12) ? hours -12 : hours)
    timeValue += ((minutes<10) ? ":0" : ":") + minutes
    timeValue += ((seconds<10) ? ":0" : ":") + seconds
    timeValue += (hours<12) ? "P.M" : "A.M"

    documents.getElementById("czas").innerHTML = timeValue;
    timerID=setTimeout("showTime()",1000);
    timerRunning=true;


}