function getIcon(warningType) {
    switch (warningType) {
        case "Terrorism":
            return "img/Warning%20Signs/marker_terrorism.png";
        case "Rape":
            return "img/Warning%20Signs/marker_rape.png";
        case "Mass Shooting":
            return "img/Warning%20Signs/marker_terrorism.png";
        case "Youths":
            return "img/Warning%20Signs/marker_youths.png";
        case "Car Accident":
            return "img/Warning%20Signs/marker_car_accident.png";
        default:
            return "img/Warning%20Signs/NEW%20MARKER%20TINY.png";
    }
}