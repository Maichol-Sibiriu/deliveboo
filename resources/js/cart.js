import Vue from 'vue';
import axios from 'axios';

const cart = new Vue({

    el: '#cart',
    data: {
      order: [],
      dishes: [],
      id:'',
      displayModal: false,
      dishIndex: 0,
      numDish: 0,
      total: 0,
    },
    created(){
      this.id = document.getElementById('restaurantId').value;
      // console.log(this.id);
      axios.get('http://127.0.0.1:8000/api/get-dishes', {
          params: {
              id: this.id,
          }
      })
      .then(response => {
        this.dishes=response.data;
        // clono array piatti
        this.dishes.forEach(dish => {
          const newDish = {
            id: dish.id,
            name: dish.name,
            price: dish.price,
            quantity: 0,
          };
          this.order.push(newDish);
          const form = document.getElementById('payment-form');
          // form.innerHTML += `<input type="hidden" name="dishes[]" id="${ newDish.id }" value="${ newDish.quantity }" /> `;
          const hiddenInput = form.appendChild(document.createElement("input"));
          hiddenInput.setAttribute("id", newDish.id);
          hiddenInput.setAttribute("type", "hidden");                     
          hiddenInput.setAttribute("value", newDish.quantity);
          hiddenInput.setAttribute("name", "dishes[]");
        });
        if (document.cookie) {
           let cookiesArray = document.cookie.split(';');
           
          for (let i = 0; i < cookiesArray.length - 1; i++) {
             
            const cookie = cookiesArray[i].trim().split('=');
            this.order[parseInt(cookie[0])].quantity = parseInt(cookie[1]);
            document.getElementById(this.order[parseInt(cookie[0])].id).value = this.order[parseInt(cookie[0])].quantity;
            // console.log(cookie);
          }
          // console.log(cookiesArray);
          this.calculateTotal();
        }
      })
      .catch(error => {
          console.log(error);
      })


    },
    watch:{
      total: function(tot) {
        document.getElementById('amount').value= tot;
        this.order.forEach((el, i) => {
          const strCookie = `${i}=${el.quantity};`;
          document.cookie = strCookie;
        });
        // console.log(cookiesArray);
      },
    },
    methods:{
      activeModal(index) {
        this.displayModal = true;
        this.dishIndex = index;
      },

      /* gestione carrello ordine */
      // aggiunta piatto
      addDish(){
        if(this.numDish > 0) {
          this.order[this.dishIndex].quantity = parseInt(this.numDish);
          this.displayModal = false;
          this.numDish = 0;
          this.calculateTotal();
        }
      },
      // modifica quantità
      setQuantity(toAdd, index) {
        this.order[index].quantity += toAdd ? 1 : - 1;
        this.calculateTotal();
      },
      // cancella piatto
      deleteDish(index) {
        this.order[index].quantity = 0;
        this.calculateTotal();
      },
      // cancella tutto l'ordine
      deleteCart() {
        this.order.forEach(product => {
          product.quantity = 0;
          this.calculateTotal();
        });
      },

      // aggiornamento totale ordine
      calculateTotal() {
        this.total = 0;
        this.order.forEach(product => {
          this.total += product.price * product.quantity;
        });
      },

    }
});

export default cart;
