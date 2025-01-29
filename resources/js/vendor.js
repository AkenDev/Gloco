// Import dependencies using ES Module syntax
import $ from 'jquery';

// Make jQuery available globally if required by other scripts
window.$ = window.jQuery = $;

// Import other dependencies
import * as Popper from '@popperjs/core'; // Use named imports for Popper
import * as Bootstrap from 'bootstrap'; // Import Bootstrap as a module
window.bootstrap = Bootstrap; // Attach it to the global window object
import 'waypoints/lib/noframework.waypoints'; // Waypoints
import Scrollbar from 'smooth-scrollbar'; // Import smooth-scrollbar

// Assign smooth-scrollbar to window
window.Scrollbar = Scrollbar;

// Make Popper available globally if required by other scripts
window.Popper = Popper;