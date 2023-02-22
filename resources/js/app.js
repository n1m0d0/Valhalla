import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

import ToastComponent from '../../vendor/usernotnull/tall-toasts/resources/js/tall-toasts'
Alpine.data('ToastComponent', ToastComponent)

window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();

import './util/calendar'

import "zoom-vanilla.js/dist/zoom.css"
import "zoom-vanilla.js/dist/zoom-vanilla.min.js"