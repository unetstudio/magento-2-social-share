/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * @requires jQuery
 */
define(["jquery"], function ($) {
    "use strict";

    $.widget("mage.socialShare", {
        options: {
            config: "",
            url: "",
            title: "",
            image: "",
            shareBlock: "#shareto .share-list",
            shareButton: "#shareto .button",
            itemClass: "share-icon",
            iconFont: "entypo",
            iconType: "square",
            width: 800,
            height: 600
        },

        _create: function () {
            this._bind();
        },

        _bind: function () {
            this._clickHandler();
            this._renderItems(this.options.config, this.options.url);
            this._openPopup();
        },

        /**
         * Click action
         */
        _clickHandler: function () {
            $(this.options.shareButton).on("click", function () {
                $(this.options.shareBlock).toggle();
            }.bind(this));
        },

        /**
         * render share items
         * @param config
         * @param url
         */
        _renderItems: function (config, url) {
            var self = this;
            var shareBlock = $(this.options.shareBlock);
            for (var key in config) {
                if (config.hasOwnProperty(key) && config[key].enable === "1") {
                    var shareItem = $("<li>", {class: self.options.itemClass + " " + self.options.iconFont + "-" + key});
                    var shareLink = $("<a>");
                    var href = "";
                    switch (key) {
                    case "facebook":
                        href = config[key].link + "?t=" + self.options.title + "&u=" + url;
                        break;
                    case "twitter":
                        href = config[key].link + "?text=" + self.options.title + "&url=" + url;
                        break;
                    case "gplus":
                        href = config[key].link + "?url=" + url;
                        break;
                    case "pinterest":
                        href = config[key].link + "?description=" + self.options.title + "&url=" + url + "&media=" + self.options.image;
                        break;
                    }

                    shareLink.attr("href", href);
                    shareItem.append(shareLink);
                    shareBlock.append(shareItem);
                }
            }
        },

        /**
         * Open share page in new window
         */
        _openPopup: function () {
            var self = this;
            $(this.options.shareBlock).find("." + this.options.itemClass).click(function () {
                var newWindow = window.open($(this).find("a").prop("href"), "", "height=" + self.options.height + ",width=" + self.options.width + "");
                if (window.focus) {
                    newWindow.focus();
                }
                return false;
            });
        }

    });

    return $.mage.socialShare;
});
