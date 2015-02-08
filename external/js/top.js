// +---------------------------------------------------------------------------------------+
// | Top HLStatsX Players                                                                  |
// | Software is licensed under the GNU GPL v2. Prohibited for use in commercial software. |
// +---------------------------------------------------------------------------------------+
// | Version 0.115                                                                         |
// +---------------------------------------------------------------------------------------+
// | Author: Dima Oliynyk                                                                  |
// | Email: <dima@dima.rv.ua>                                                              |
// | Web-site: www.dima.rv.ua                                                              |
// +---------------------------------------------------------------------------------------+

function getXMLHttp() {
    var xmlHttp;
    try {
        xmlHttp = new XMLHttpRequest();
    } catch (e) {
        try {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                alert("Error. Your browser does not support AJAX!");
                return false;
            }
        }
    }
    return xmlHttp;
}

function getTopPlayers(game, page) {
    var load_text = '<center><img src="external/images/load.gif" /></center>';
    var xmlHttp = getXMLHttp();
    xmlHttp.onreadystatechange = function() {
        document.getElementById('load').innerHTML = load_text;
        if (xmlHttp.readyState == 4) {
            document.getElementById('load').innerHTML = '';
            display_to_page(xmlHttp.responseText);
        }
    }
    xmlHttp.open("GET", "core.php?game=" + game + "&page=" + page, true);
    xmlHttp.send(null);
}

function display_to_page(data) {
    document.getElementById('display').innerHTML = data;
}