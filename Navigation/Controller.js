import { Autoloader } from '../../jsOMS/Autoloader.js';
import { Application } from '../../Web/Backend/js/backend.js';
import { Navigation } from './Models/Navigation.js';

Autoloader.defineNamespace('jsOMS.Modules');

/**
 * Navigation controller.
 *
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @since      1.0.0
 */
jsOMS.Modules.Navigation = class {
    /**
     * Constructor
     *
     * @since 1.0.0
     */
    constructor() {
        this.navigation = {};
        /** global: jsOMS */
        /** global: localStorage */
        this.rawNavData = JSON.parse(window.localStorage.getItem(Navigation.MODULE_NAME));
        this.rawNavData = this.rawNavData !== null ? this.rawNavData : {};
    };

    /**
     * Bind navigation
     *
     * @param {string} id Navigation to bind (optional)
     *
     * @return {void}
     *
     * @since 1.0.0
     */
    bind (id) {
        const e      = typeof id === 'undefined' ? document.getElementsByClassName('nav') : [document.getElementById(id)];
        const length = e.length;

        for (let i = 0; i < length; ++i) {
            if (e[i] === null) {
                continue;
            }

            this.bindElement(e[i]);
        }
    };

    /**
     * Bind navigation element
     *
     * @param {Element} e Element to bind
     *
     * @return {void}
     *
     * @since 1.0.0
     */
    bindElement (e) {
        const extend = e.querySelectorAll('li label');
        const self   = this;

        this.navigation[e.id] = new Navigation(this.rawNavData[e.id]);

        // On load
        const open = this.navigation[e.id].getOpen();
        let ele    = null;

        for (let key in open) {
            if (open.hasOwnProperty(key) && (ele = document.getElementById(key)) !== null) {
                ele.checked = open[key];
            }
        }

        if (!this.navigation[e.id].isVisible()) {
            let width = window.innerWidth
                || document.documentElement.clientWidth
                || document.body.clientWidth;

            /**
             * @todo Orange-Management/Modules#192
             *  The sidebar navigation is not working properly in many cases
             *  1. if the content is too wide then the side nav becomes smaller (resize window for testing)
             *  2. if the device is a handheld device it feels unintuitive to open/hide the navigation
             */
            e.nextElementSibling.checked = width < 800;
        }

        e.scrollTop  = this.navigation[e.id].getScrollPosition().y;
        e.scrollLeft = this.navigation[e.id].getScrollPosition().x;

        // Bind minimize/maximize
        jsOMS.addEventListenerToAll(extend, 'click', function () {
            let box = document.getElementById(this.getAttribute('for'));

            if (!box.checked) {
                self.navigation[e.id].setOpen(box.id);
            } else {
                self.navigation[e.id].setClose(box.id);
            }

            localStorage.setItem(Navigation.MODULE_NAME, JSON.stringify(self.navigation));
        });

        // Bind show/hide
        e.addEventListener('change', function () {
            self.navigation[e.id].setVisible(this.checked);
            localStorage.setItem(Navigation.MODULE_NAME, JSON.stringify(self.navigation));
        });

        // Bind scroll
        e.addEventListener('scroll', function () {
            self.navigation[e.id].setScrollPosition(this.scrollLeft, this.scrollTop);
            localStorage.setItem(Navigation.MODULE_NAME, JSON.stringify(self.navigation));
        });
    };
};

/**
 * Module id
 *
 * @var {string}
 * @since 1.0.0
 */
Navigation.MODULE_NAME = '1000500001';

window.omsApp.moduleManager.get('Navigation').bind('nav-side');