/**
 * Navigation controller.
 *
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013 Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0 * @since      1.0.0
 */
(function (jsOMS)
{
    "use strict";

    /** @namespace jsOMS.Modules.Navigation.Models */
    jsOMS.Autoloader.defineNamespace('jsOMS.Modules.Navigation');

    jsOMS.Modules.Navigation = function ()
    {
        this.navigation = {};
        this.rawNavData = JSON.parse(localStorage.getItem(jsOMS.Modules.Navigation.MODULE_NAME));
        this.rawNavData = this.rawNavData !== null ? this.rawNavData : {};
    };

    jsOMS.Modules.Navigation.MODULE_NAME = '1000500001';

    jsOMS.Modules.Navigation.prototype.bind = function (id)
    {
        let e      = typeof id === 'undefined' ? document.getElementsByClassName('nav') : [document.getElementById(id)],
            length = e.length;

        for (let i = 0; i < length; i++) {
            this.bindElement(e[i]);
        }
    };

    jsOMS.Modules.Navigation.prototype.bindElement = function (e)
    {
        if (typeof e === 'undefined') {
            // todo: do logging here

            return;
        }

        let extend = e.querySelectorAll('li label'),
            self   = this;

        this.navigation[e.id] = new jsOMS.Modules.Navigation.Models.Navigation(this.rawNavData[e.id]);

        // Bind minimize/maximize
        jsOMS.addEventListenerToAll(extend, 'click', function ()
        {
            let box = document.getElementById(this.getAttribute('for'));

            if (!box.checked) {
                self.navigation[e.id].setOpen(box.id);
            } else {
                self.navigation[e.id].setClose(box.id);
            }

            localStorage.setItem(jsOMS.Modules.Navigation.MODULE_NAME, JSON.stringify(self.navigation));
        });

        // On load
        let open = this.navigation[e.id].getOpen();

        for (let key in open) {
            if (open.hasOwnProperty(key)) {
                document.getElementById(key).checked = open[key];
            }
        }

        // Bind show/hide
        e.nextElementSibling.addEventListener('change', function ()
        {
            self.navigation[e.id].setVisible(this.checked);
            localStorage.setItem(jsOMS.Modules.Navigation.MODULE_NAME, JSON.stringify(self.navigation));
        });

        // On load
        if (!this.navigation[e.id].isVisible()) {
            e.nextElementSibling.checked = false;
        }

        // Bind scroll
        e.addEventListener('scroll', function ()
        {
            self.navigation[e.id].setScrollPosition(this.scrollLeft, this.scrollTop);
            localStorage.setItem(jsOMS.Modules.Navigation.MODULE_NAME, JSON.stringify(self.navigation));
        });

        // On load
        e.scrollTop  = this.navigation[e.id].getScrollPosition().y;
        e.scrollLeft = this.navigation[e.id].getScrollPosition().x;
    };
}(window.jsOMS = window.jsOMS || {}));

jsOMS.ready(function ()
{
    "use strict";

    let navigation = new jsOMS.Modules.Navigation();
    navigation.bind('nav-side');
});