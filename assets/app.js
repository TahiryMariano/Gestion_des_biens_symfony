/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// You can specify which plugins you need
import { Tooltip, Toast, Popover } from 'bootstrap';


// start the Stimulus application
import './bootstrap';

const $ = require('jquery');
$('#contactButton').click(e => {
    e.preventDefault()
    $('#contactForm').slideDown()
    $('#contactButton').slideUp()
})
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// or you can include specific pieces
require('bootstrap/js/dist/tooltip');
require('bootstrap/js/dist/popover');
$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
});

/*import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
    static targets = ["name", "output"]

    greet() {
        this.outputTarget.textContent =
            `Hello, ${this.nameTarget.value}!`
    }
}
import { startStimulusApp } from '@symfony/stimulus-bridge';

export const app = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.(j|t)sx?$/
));*/