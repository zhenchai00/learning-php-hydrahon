// Load div content dynamically
window.onload = function(event) {
    var hash = location.hash.substr(1);
    $('#content').load('form/' + hash + '.php');
};

if (!location.hash) {
    location.hash = '#list'
}

$(document).ready(function(){

    $(window).on('hashchange', function() {
        var hash = location.hash.substr(1);
        $('#content').load('form/' + hash + '.php');
    });
});

