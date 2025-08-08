

function getHinjewadiETA({ time, day, metroWork }) {
    if (time === "office" && day !== "Sunday" && metroWork) {
        return "ETA to Phase 2: 2 hours 😭";
    } else if (day === "Sunday" && !metroWork) {
        return "You reached in 20 mins. Is this heaven?";
    } else {
        return "Just WFH bro. Just WFH.";
    }
}

const currentStatus = {
    time: "office",
    day: "Wednesday",
    metroWork: true,
};

console.log(getHinjewadiETA(currentStatus));
