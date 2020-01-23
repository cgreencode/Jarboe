const Jarboe = {
    /**
     * Displays a modal dialog with an optional message/description and buttons with their callbacks.
     */
    confirmBox: function(settings) {
        settings = $.extend({
            title: "",
            content: "",
            NormalButton: undefined,
            ActiveButton: undefined,
            buttons: undefined,
            input: undefined,
            inputValue: undefined,
            placeholder: "",
            options: undefined
        }, settings);
        const buttons = settings.buttons || {};
        settings.buttons = '['+ Object.keys(buttons).reverse().join('][') +']';

        $.SmartMessageBox(settings, function(ButtonPressed) {
            if (typeof buttons[ButtonPressed] === 'function') {
                buttons[ButtonPressed]();
            }
        });
    },

    /**
     * Show small toast notification.
     * @param settings
     * @param callback
     */
    smallToast: function(settings, callback) {
        $.smallBox(settings, callback);
    },

    /**
     * Show big toast stackable notification.
     * @param settings
     * @param callback
     */
    bigToast: function(settings, callback) {
        $.bigBox(settings, callback);
    },

    /**
     * Object that hold functions for initialising plugins and stuff for fields.
     */
    initers: {},

    /**
     * Add initer.
     * @param name
     * @param initer
     */
    add: function(name, initer) {
        if (!this.initers[name]) {
            this.initers[name] = [];
        }
        this.initers[name].push(initer);
    },
    /**
     * Trigger initer.
     * @param name
     */
    init: function(name) {
        if (this.initers[name]) {
            for (initer of this.initers[name]) {
                initer();
            }
        }
    }
};
const jarboe = Jarboe;
