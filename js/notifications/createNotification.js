function createNotification(message) {
    
    var notificationBody = document.createElement('div');
    
    notificationBody.setAttribute("class", "notification");
    
    var text = document.createTextNode(message);
    
    notificationBody.appendChild(text);
    
    return notificationBody;
}