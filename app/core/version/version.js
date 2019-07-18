'use strict';

angular.module('toDoApp.version', [
  'toDoApp.version.interpolate-filter',
  'toDoApp.version.version-directive'
])

.value('version', '0.1');
