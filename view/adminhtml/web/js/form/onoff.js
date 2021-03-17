/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * @api
 */
define([
  'underscore',
  'mage/translate',
  'Magento_Ui/js/grid/columns/multiselect',
  'uiRegistry'
], function (_, $t, Column, registry) {
  'use strict';

  return Column.extend({
    deselectAll: function() {
      // do nothing
    }
  });
});
