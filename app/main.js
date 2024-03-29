// Load content dynamically to div, while window on load
window.onload = function(event) {
    var hash = location.hash.substr(1);
    $('#content').load('form/' + hash + '/' + page + '_' + aot + '.php?page=' + page + '&aot=' + aot);
    console.log('form/' + hash + '/' + page + '_' + aot + '.php?page=' + page + '&aot=' + aot);
};

// Make hash default while it is empty
if (!location.hash) {
    location.hash = '#list'
}

// to top button 
$(window).scroll(function() {
    var height = $(window).scrollTop();
    if (height > 100) {
        $('#to-top').fadeIn();
    } else {
        $('#to-top').fadeOut();
    }
});

$(document).ready(function() {
    // Load content dynamically to div 
    $(window).on('hashchange', function() {
        var hash = location.hash.substr(1);
        $('#content').load('form/' + hash + '/' + page + '_' + aot + '.php?page=' + page + '&aot=' + aot);
    });
});