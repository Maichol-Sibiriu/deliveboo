import Vue from 'vue';
import axios from 'axios';

const deliveboo = new Vue({
    
    el: '#app',
    data: {
        name: '',
        categories: ['americano',],

    },
    created() {
        axios.get('http://127.0.0.1:8000/api/filter-restaurant', {
            params: {
                name: this.name,
                categories: this.categories,
            }
        })
        .then(response => {
            console.log(response.data);
        })
        .catch(error => {
            console.log(error);
        })
    },
    methods: {

    }
});
