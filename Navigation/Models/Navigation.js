/**
 * Navigation class.
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
    jsOMS.Autoloader.defineNamespace('jsOMS.Modules.Navigation.Models');

    jsOMS.Modules.Navigation.Models.Navigation = function (data)
    {
        if (typeof data === 'undefined') {
            this.scrollPosition = {x: 0, y: 0};
            this.activeLinks    = {};
            this.visible        = true;
            this.openCategories = {};
        } else {
            this.scrollPosition = typeof data.scrollPosition === 'undefined' ? {x: 0, y: 0} : data.scrollPosition;
            this.activeLinks    = typeof data.activeLinks === 'undefined' ? {} : data.activeLinks;
            this.visible        = typeof data.visible === 'undefined' ? true : data.visible;
            this.openCategories = typeof data.openCategories === 'undefined' ? {} : data.openCategories;
        }
    };

    jsOMS.Modules.Navigation.Models.Navigation.prototype.setScrollPosition = function (x, y)
    {
        this.scrollPosition.x = x;
        this.scrollPosition.y = y;
    };

    jsOMS.Modules.Navigation.Models.Navigation.prototype.getScrollPosition = function ()
    {
        return this.scrollPosition;
    };

    jsOMS.Modules.Navigation.Models.Navigation.prototype.setOpen = function (id)
    {
        this.openCategories[id] = true;
    };

    jsOMS.Modules.Navigation.Models.Navigation.prototype.setClose = function (id)
    {
        delete this.openCategories[id];
    };

    jsOMS.Modules.Navigation.Models.Navigation.prototype.getOpen = function ()
    {
        return this.openCategories;
    };

    jsOMS.Modules.Navigation.Models.Navigation.prototype.active = function (id)
    {
        this.allInactive();
    };

    jsOMS.Modules.Navigation.Models.Navigation.prototype.allInactive = function ()
    {

    };

    jsOMS.Modules.Navigation.Models.Navigation.prototype.inactive = function (id)
    {
    };

    jsOMS.Modules.Navigation.Models.Navigation.prototype.setVisible = function (visible)
    {
        this.visible = visible;
    };

    jsOMS.Modules.Navigation.Models.Navigation.prototype.isVisible = function ()
    {
        return this.visible;
    };

    jsOMS.Modules.Navigation.Models.Navigation.prototype.serialize = function ()
    {
        return JSON.stringify({
            visible: this.visible,
            activeLinks: this.activeLinks,
            scrollPosition: this.scrollPosition,
            openCategories: this.openCategories
        });
    };

    jsOMS.Modules.Navigation.Models.Navigation.prototype.unserialize = function (data)
    {
        let temp = JSON.parse(data);

        this.visible        = temp.visible;
        this.activeLinks    = temp.activeLinks;
        this.openCategories = temp.openCategories;
        this.scrollPosition = temp.scrollPosition;
    };
}(window.jsOMS = window.jsOMS || {}));
