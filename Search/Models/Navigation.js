export class Navigation {
    /**
     * Construct
     *
     * @param {Object} data Initialization (optional)
     *
     * @since 1.0.0
     */
    constructor (data)
    {
        if (typeof data === 'undefined') {
            this.scrollPosition = {x: 0, y: 0};
            this.activeLinks    = {};
            this.visible        = true;
            this.openCategories = {};
        } else {
            this.scrollPosition = typeof data.scrollPosition === 'undefined' ? {x : 0, y : 0} : data.scrollPosition;
            this.activeLinks    = typeof data.activeLinks === 'undefined' ? {} : data.activeLinks;
            this.visible        = typeof data.visible === 'undefined' ? true : data.visible;
            this.openCategories = typeof data.openCategories === 'undefined' ? {} : data.openCategories;
        }
    };

    /**
     * Set scroll position
     *
     * @param {int} x Horizontal position
     * @param {int} y Vertical position
     *
     * @return {void}
     *
     * @since 1.0.0
     */
    setScrollPosition (x, y)
    {
        this.scrollPosition.x = x;
        this.scrollPosition.y = y;
    };

    /**
     * Get scroll position
     *
     * @return {Object}
     *
     * @since 1.0.0
     */
    getScrollPosition ()
    {
        return this.scrollPosition;
    };

    /**
     * Open navigation category
     *
     * @param {string} id Category id
     *
     * @return {void}
     *
     * @since 1.0.0
     */
    setOpen (id)
    {
        this.openCategories[id] = true;
    };

    /**
     * Close navigation category
     *
     * @param {string} id Category id
     *
     * @return {void}
     *
     * @since 1.0.0
     */
    setClose (id)
    {
        delete this.openCategories[id];
    };

    /**
     * Get open navigation elements
     *
     * @return {Object}
     *
     * @since 1.0.0
     */
    getOpen ()
    {
        return this.openCategories;
    };

    active (id)
    {
        this.allInactive();
    };

    allInactive ()
    {

    };

    inactive (id)
    {
    };

    /**
     * Set navigation visibility
     *
     * @param {bool} visible Visibility
     *
     * @return {bool}
     *
     * @since 1.0.0
     */
    setVisible (visible)
    {
        this.visible = visible;
    };

    /**
     * Is navigation visible
     *
     * @return {bool}
     *
     * @since 1.0.0
     */
    isVisible ()
    {
        return this.visible;
    };
};
