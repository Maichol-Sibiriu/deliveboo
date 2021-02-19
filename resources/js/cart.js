import Vue from 'vue';
import axios from 'axios';

const cart = new Vue({

    el: '#cart',
    data: {
      order:[],
      dishes:[],
      id:'',
    },
    mounted(){
      this.id = document.getElementById('restaurantId').value;
      // console.log(this.id);
      axios.get('http://127.0.0.1:8000/api/get-dishes', {
          params: {
              id: this.id,
          }
      })
      .then(response => {
        this.dishes=response.data;
          // console.log(this.dishes);
      })
      .catch(error => {
          console.log(error);
      })
    },
    methods:{
      addDish(name){
        const dish = {
          name,
          quantity:1
        };
        this.order.push(dish);
        console.log(this.order);
      }

    }

// api/get-dishes
});
