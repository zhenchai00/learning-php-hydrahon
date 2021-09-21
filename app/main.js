// Load content dynamically to div, while window on load
window.onload = function(event) {
    var hash = location.hash.substr(1);
    $('#content').load('form/' + hash + '.php');
};

// Make hash default while it is empty
if (!location.hash) {
    location.hash = '#list'
}

$(document).ready(function() {
    // Load content dynamically to div 
    $(window).on('hashchange', function() {
        var hash = location.hash.substr(1);
        $('#content').load('form/' + hash + '.php');
    });
});

