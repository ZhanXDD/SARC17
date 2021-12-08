window.setInterval(countsUser, 1000);
function countsUser(){
    var user = 0;
    var xml = new XMLHttpRequest();
    xml.open("GET","../xml/users.xml");
    xml.responseType = 'document';
    xml.send();
    xml.onload = function() {
        let sesiones = xml.response.activeElement.childNodes;
        console.log(sesiones);
        sesiones.forEach(element => {
            user = user + 1;
            console.log(element);
        });
        document.querySelector('#userCounter').innerText="Usuarios: "+user;
    };
}