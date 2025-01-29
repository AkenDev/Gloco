// resources/js/app.js

// Step 1: Manually add jQuery and Bootstrap to `modules` first
/*const mainModules = {
    './jquery.min.js': () => import('./jquery.min.js'),
    './popper.min.js': () => import('./popper.min.js'),
    './bootstrap.min.js': () => import('./bootstrap.min.js'),
};

// Step 2: Dynamically import all other JavaScript files in the directory
const otherModules = import.meta.glob('./*.js', { eager: true });

// Step 3: Merge `otherModules` into `modules`, excluding files already in `modules`
for (const path in otherModules) {
    if (!mainModules[path]) { // Prevent re-adding jQuery, Popper, or Bootstrap
        mainModules[path] = otherModules[path];
    }
}

// Step 4: Import each module in the controlled order
for (const path in mainModules) {
    mainModules[path]();  // This imports and executes each module in the specified order
}

// Import all JS files in specific subdirectory charlist
const chartistModules = import.meta.glob('./chartist/*.js');

// Combine all imports into a single object
const modules = { ...mainModules, ...chartistModules };

// Optionally log the modules to confirm they are being loaded
for (const path in modules) {
    modules[path]();
}*/

// Import core libraries
import './jquery.min';
//import { createPopper } from '@popperjs/core';
// Optionally, attach it to the global scope if needed
//window.Popper = createPopper;
import './bootstrap.min';

// Appear JavaScript
import './jquery.appear';
import './countdown.min';
import './waypoints.min';
import './jquery.counterup.min';

// Additional libraries
//import './wow.min';
import './apexcharts';
import './slick.min';
import './select2.min';
import './jquery.magnific-popup.min';
import './smooth-scrollbar';
import './lottie';
import './core';
import './charts';
//import './animated';
import './kelly';
import './morris';
import './maps';
import './worldLow';
import './chartist/chartist.min';
import './chart-custom';

// Custom scripts
import './custom';
