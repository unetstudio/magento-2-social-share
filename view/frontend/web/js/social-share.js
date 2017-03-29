/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

define(["jquery"], function ($) {
    "use strict";
    return function socialShare(data) {
        var socialShare = {
            config: data.config,
            currentStoreUrl: data.currentStoreUrl,
            shareBlock: '.product-shareto-links .share-list',
            shareButton: '.product-shareto-links .toggle',
            itemClass: 'share-icon',
            iconType: 'square',
            width: 800,
            height: 600,

            /**
             * Initialize
             */
            init: function() {
                this.click();
                this.render(this.config, this.currentStoreUrl);
                this.openPopup();
            },

            /**
             * Click action
             */
            click: function () {
                $(this.shareButton).on('click', function () {
                    $(this.shareBlock).toggle();
                }.bind(this));
            },

            /**
             * render share items
             * @param config
             * @param currentStoreUrl
             */
            render: function (config, currentStoreUrl) {
                var $this = this;
                var shareBlock = $(this.shareBlock);
                for (var key in config) {
                    if (config.hasOwnProperty(key)) {
                        var shareItem = $('<li>', {class: $this.itemClass});
                        var shareLink = $('<a>');
                        var shareIcon = $('<i>', {class: 'fa fa-' + key + '-' + $this.iconType});

                        // render item
                        shareLink.attr('href', config[key] + currentStoreUrl);
                        shareLink.append(shareIcon);
                        shareItem.append(shareLink);
                        shareBlock.append(shareItem);
                    }
                }
            },

            /**
             * Open share page in new window
             */
            openPopup: function () {
                var $this = this;
                $(this.shareBlock).find('.' + this.itemClass).click(function () {
                    var newWindow = window.open($(this).find('a').prop('href'), '', 'height=' + $this.height + ',width=' + $this.width + '');
                    if (window.focus) {
                        newWindow.focus();
                    }
                    return false;
                });
            }
        };

        $(document).ready(function () {
            socialShare.init();
        });
    }
});