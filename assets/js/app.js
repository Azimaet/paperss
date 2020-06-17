/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import Vue from 'vue';
import App from './components/App';

import '../css/gridlex.css'
import '../css/app.css'

// new Vue({
//     el: '#app',
//     render: h => h(App, {
//         props: {
//             username: el.getAttribute('data-username'),
//         }
//     })
// })

new Vue({
    render(h) {
        return h(App, {
            props: {
                username: this.$el.getAttribute('data-name'),
            },
        })
    },
}).$mount('#app')



