import { createApp } from 'vue'
import App from './App.vue'

import Echo from "laravel-echo"
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.VUE_APP_WEBSOCKETS_KEY,
    wsHost:process.env.VUE_APP_WEBSOCKETS_SERVER,
    wsPort: 6001,
    cluster: "mt1",
    forceTLS: false,
    disableStats: true,
    authEndpoint :'http://127.0.0.1:8000/api/broadcasting/auth',
    auth:{
        headers: {
            Authorization: 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2VuL2F1dGgvbG9naW4iLCJpYXQiOjE2OTg3NDA0ODAsImV4cCI6MTY5ODc0NDA4MCwibmJmIjoxNjk4NzQwNDgwLCJqdGkiOiJXZVY4SVBDMHdwamQzY2VzIiwic3ViIjoiMiIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.5bu3mQXnqz-PBXCsjPCDE8jNCHmChRLluF9sp0RanXc', 
        }
    },
 
});
createApp(App).mount('#app')