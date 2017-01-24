var userButton = (function($){
    "use strict";

    function _renderUserButton(options, userData) {
        var $container = $('#' + options.buttonContainerId);
        var htmlButton = '';
        var htmlTemplate = $('#' + options.buttonTemplateId).html();

        if(userData.loggedIn) {
            htmlButton = htmlTemplate
                .replace('__PATH__', options.logoutPath)
                .replace('__USER_NAME__', userData.name)
                .replace('__USER_SURNAME__', userData.surname)
                .replace('__ACTION__', ' - Logout');
        } else {
            htmlButton = htmlTemplate
                .replace('__PATH__', options.loginPath)
                .replace('__USER_NAME__', '')
                .replace('__USER_SURNAME__', '')
                .replace('__ACTION__', 'Login');
        }

        $container.replaceWith(htmlButton);
    }

    function _initializeButton(options) {
        $.ajax({
            type: "GET",
            url: options.userDataPath,
            dataType: "json",
            success: function(userData) {
                _renderUserButton(options, userData);
            }
        });
    }

    return {
        "init": _initializeButton,
    };
})(jQuery);
