var l = (window.console !== undefined) ? window.console.log.bind(console) : function() {};

var TinyMVC = {
    init: function() {
        l('TinyMVC');
    }
};

$(function() {
    TinyMVC.init();
});
