import Chart from 'chart.js';
import axios from 'axios';

let orders = [];

axios.get('http://127.0.0.1:8000/api/get-statistics')
    .then(response => {
        orders = response.data;
        console.log(orders);
    })
    .catch(error => {
        console.log(error);
    });   

setTimeout(() => {

    let total = 0;
    let media = [
        {year: '2021', total: 0, orderNum: 0,},
        {year: '2020', total: 0, orderNum: 0,},
        {year: '2019', total: 0, orderNum: 0,},
        {year: '2018', total: 0, orderNum: 0,},
        {year: '2017', total: 0, orderNum: 0,},
        {year: '2016', total: 0, orderNum: 0,},
    ];
    orders.forEach(order => {
        let index = 0;
        for ( let i = 0; i < media.length; i++) {

            if (media[i].year == order.created_at.slice(0, 4)) {
                index = i;
                break;
            }
        }   
        
        media[index].total += parseInt(order.amount);
        media[index].orderNum++;
        
    });
    console.log(media);
    var ctx = document.getElementById('myChart');
    
    var myChart = new Chart(ctx, {type: 'bar',
        data: {
            labels: ['2015', '2016', '2017', '2018', '2019', '2020'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    
    var ctx2 = document.getElementById('myChart2');
    
    var myChart2 = new Chart(ctx2, {type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3, 12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

}, 2000);



