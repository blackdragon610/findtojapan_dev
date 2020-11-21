var KeyboardPlugin = function() {};


KeyboardPlugin.prototype.allView = function(success, fail) {
    cordova.exec(success, fail, "KeyboardPlugin","allView", []);
};
KeyboardPlugin.prototype.say = function(success, fail) {
    cordova.exec(success, fail, "KeyboardPlugin","say", []);
};

var keyboardPlugin = new KeyboardPlugin();
module.exports = keyboardPlugin;
