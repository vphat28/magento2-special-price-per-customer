/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * @api
 */
define([
  'jquery',
  'Magento_Ui/js/form/components/insert-listing',
  'mageUtils',
  'underscore'
], function ($, Insert, utils, _) {
  'use strict';

  return Insert.extend({
    /**
     * Set listing rows data to the externalValue,
     * or if externalData is configured with the names of particular columns,
     * filter rows data to have only these columns, and then set to the externalValue
     *
     * @param {Object} newValue - rows data
     *
     */
    setExternalValue: function (newValue) {
      newValue = newValue[0];
      var self = this;
      var keys = this.externalData;

      _.each(keys, function (val,k) {
        var key = 'external_value_' + val;
        self.set(key, newValue[val]);
      });
    },
    /**
     * Sync data with external provider.
     *
     * @param {Object} config
     * @returns {Object}
     */
    initDataLink: function (config) {
      var key, value;

      if (config.dataLinks) {
        _.each(config.externalData, function (val, k) {
          value = k;
          key = 'external_value_' + val;

          if (config.dataLinks.imports) {
            this.imports[key] = '${ $.externalProvider }:data.' + value;
          }

          if (config.dataLinks.exports) {
            this.exports[key] = '${ $.externalProvider }:data.' + value;
          }
          this.links[key] = '${ $.externalProvider }:data.' + value;
        }, this.constructor.defaults);
      }

      if (config.realTimeLink) {
        this.constructor.defaults.links.externalValue = 'value';
      }

      return this;
    },
    updateSelections: function (items) {
      if (!this.dataLinks.exports || this.suppressDataLinks) {
        this.suppressDataLinks = false;
        this.initialExportDone = true;

        return;
      }
    }
  });
});
