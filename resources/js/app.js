require('./bootstrap');

import Vue from 'vue';
import axios from 'axios';

const deliveboo = new Vue({
    
    el: '#app',
    data: {
        name: '',
        categories: [],

    },
    created() {
        axios.get('http://127.0.0.1:8000/api/filter-restaurant', {
            params: {
                name: 'sjwisjiwjsijiwjiwjiwj',
            }
        })
        .then(response => {
            console.log(response);
        })
        .catch(error => {
            console.log(error);
        })
    },
    methods: {

    }
});