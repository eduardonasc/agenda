$('#theme-btn').on('click', function () {
    $('body').toggleClass('light-mode');
    $('body').toggleClass('dark-mode');

    var theme = 'light-mode';
    if ($('body').hasClass('dark-mode')) {
        theme = 'dark-mode';
    }

    document.cookie = 'theme=' + theme + '; path=/';
});
