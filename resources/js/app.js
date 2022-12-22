import './bootstrap';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
// import router from './router';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

const generateRandomStr = function (){
    return (Math.random() + 1).toString(36).substring(2);
}
const generateRandomInt = function (len= 0){
    return (Math.random() + 1).toString().substring(2).substring(len);
}
const generateRandomDate = function (date=Date.now()){
    return new Date(date).toLocaleDateString('en-CA');
}
const generateRandomEmail = function (){
    return generateRandomStr() + "@" + generateRandomStr() + ".com";
}
let generateTestValues = function (){

    // set the text values
    let textInputs = document.querySelectorAll('[data-test="true"] input[type="text"]');
    for(let i=0; i<textInputs.length; i++){
        textInputs[i].value = generateRandomStr();
    }
    // set the number values
    let numberInputs = document.querySelectorAll('[data-test="true"] input[type="number"]');
    for(let i=0; i<numberInputs.length; i++){
        numberInputs[i].value = generateRandomInt();
    }
    // set the number values
    let dateInputs = document.querySelectorAll('[data-test="true"] input[type="date"]');
    for(let i=0; i<dateInputs.length; i++){
        dateInputs[i].value = generateRandomDate();
    }
    // set the email values
    let emailInputs = document.querySelectorAll('[data-test="true"] input[type="email"]');
    for(let i=0; i<emailInputs.length; i++){
        emailInputs[i].value = generateRandomEmail();
    }
    // set the select values
    let selectInputs = document.querySelectorAll('[data-test="true"] select');
    for(let i=0; i<selectInputs.length; i++){
        selectInputs[i].value = selectInputs[i].children[1].value;
    }
}

createInertiaApp({
    id: 'app',
    title: (title) => `${appName} - ${title}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {

        //if prod don't generate test values and silent debugger
        if (process.env.MIX_APP_ENV !== 'dev') {
            generateTestValues = function () {}
        }
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route,
                    generateTestValues
                }
            })
            .mount(el);

    },
});

// InertiaProgress.init({ color: '#4B5563' });
InertiaProgress.init({
    // The delay after which the progress bar will
    // appear during navigation, in milliseconds.
    delay: 250,

    // The color of the progress bar.
    color: '#fcba19',

    // Whether to include the default NProgress styles.
    includeCSS: true,

    // Whether the NProgress spinner will be shown.
    showSpinner: true,
});
