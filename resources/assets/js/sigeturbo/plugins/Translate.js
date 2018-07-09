var Translate = {};

Translate.install = function (Vue, options) {

    let translate = {
        text(txt) {
            let type = txt.split('.');
            return eval("options.translates['" + options.locale + "']." + String(type[0]) + "." + String(type[1]));
        },
    };
    Vue.prototype.$translate = translate;
};

export default Translate;