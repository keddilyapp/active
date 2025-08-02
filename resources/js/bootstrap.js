
import _ from 'lodash';
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

/**
 * Bootstrap JavaScript - Only load what we need
 */
// Uncomment only the Bootstrap components you actually use:
// import { Alert } from 'bootstrap';
// import { Button } from 'bootstrap';
// import { Carousel } from 'bootstrap';
// import { Collapse } from 'bootstrap';
// import { Dropdown } from 'bootstrap';
// import { Modal } from 'bootstrap';
// import { Offcanvas } from 'bootstrap';
// import { Popover } from 'bootstrap';
// import { ScrollSpy } from 'bootstrap';
// import { Tab } from 'bootstrap';
// import { Toast } from 'bootstrap';
// import { Tooltip } from 'bootstrap';
