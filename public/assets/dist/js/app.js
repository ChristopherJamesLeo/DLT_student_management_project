//Start jquery
$(document).ready(function(){
    $('.sidebarlinks').click(function(){
        $('.sidebarlinks').removeClass('currents');
        $(this).addClass('currents');
    });
});

//End jquery

//Start Js Area 
//Start Top Sidebar
// Start notify & Userlogout 
//Start dropdown
function dropbtn(e){
    e.target.parentElement.nextElementSibling.classList.toggle('show');
}
//End dropdown
// Start notify & Userlogout 
//End Top Sidebar 

//Start Expense Area 
const ctx = document.getElementById('mypiechart');
ctx.height = 200;
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [12, 19, 3],
      }]
    },
    options: {
        responsive:false
    }
  });

//End Expense Area 

//Start Earning Area 




google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);

        var options = {
          title: 'Sale Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      };

//End Earning Area

// --------------------------------------------------------
//Get Minimun Number 
// var arrnums = [5,10,15,3,7,8,20,6];

// function getminnumber(numbers){
//   let minnumber = numbers[0];

//   for(var x = 0 ; x < numbers.length ; x++){
//      //Get Mini Number 
//     // if(numbers[x] < minnumber){
//     //   minnumber = numbers[x];
//     // }

//     //Get Max Number 
//     if(numbers[x] > minnumber){
//       minnumber = numbers[x];
//     }
//   }

//   return minnumber;
// };
// console.log(getminnumber(arrnums));
// ------------------------------------------------------

// var arrnumtwo = [5,10,15,3,7,8,20,6];

// function sortmaxtomin(numbers){
//   for(let y = 0 ; y  < numbers.length ; y++){
//   // let maxnumber = numbers[0];
//   let maxnumber = numbers[y];
//   let curidx = y;
//   // for(var i = 0 ; i < numbers.length ; i++){
//     for(var i = y ; i < numbers.length ; i++){
//     //Get Max Number 
//     if(numbers[i] > maxnumber){
//       maxnumber = numbers[i];
//       curidx = i;
//     }

//     // if(numbers[i] < maxnumber){
//     //   maxnumber = numbers[i];
//     //   curidx = i;
//     // }
//   }
//   // return [maxnumber,curidx];  //[20,6]

//   //swap idx6 to idx0 
//   // numbers[curidx] = numbers[0];
//   //return [maxnumber,curidx,numbers]; 20,6 [20,10,15,3,7,8,5,6];
//   //swap idx0 to idx6 value
//   // numbers[0] = maxnumber; //20 
//   // return [maxnumber,curidx,numbers]; //[20, 10, 15, 3, 7, 8, 5, 6];

//   numbers[curidx] = numbers[y];
//   numbers[y] = maxnumber;
//   }
//   return numbers;
// }

// console.log(sortmaxtomin(arrnumtwo));

// ------------------------------------------------------

let saledata = [
  {
    title : "Order Value",
    rank : 80,
    value : "120.8%",
    color : "bg-secondary"
  },
  {
    title : "Total Product",
    rank : 50,
    value : "325.2%",
    color : "bg-success"
  },
  {
    title : "Quantity",
    rank : 70,
    value : "25.60%",
    color : "bg-warning"
  },
  {
  title : "New SKU",
  rank : 43,
  value : "15.60%",
  color : "bg-info"
},
{
  title : "Dept",
  rank : 33,
  value : "33.60%",
  color : "bg-danger"
}
];

// var arrnumtwo = [5,10,15,3,7,8,20,6];

function sortmaxtomin(saledatas){
  for(let y = 0 ; y  < saledatas.length ; y++){

  let maxnumber = saledatas[y];
  let curidx = y;

    for(var i = y ; i < saledatas.length ; i++){
    //Get Max Number 
    if(saledatas[i] > maxnumber){
      maxnumber = saledatas[i];
      curidx = i;
    } 
  }

  saledatas[curidx] = saledatas[y];
  saledatas[y] = maxnumber;
  }
  return saledatas;
}

// console.log(sortmaxtomin(arrnumtwo));

function showsaledatas(sortdatas){
  let getsalecnt = document.getElementById('salecontainer');
  let progress = `<div>`;
  for(let x = 0 ; x < sortdatas.length ; x++){
    progress += `<div class="mt-2">
                <div class="d-flex justify-content-between">
                    <small>${sortdatas[x].title}</small>
                    <small>${sortdatas[x].value}</small>
                </div>
                <div class="progress">
                  <div class="progress-bar ${sortdatas[x].color}" style="width:${sortdatas[x].rank}%" aria-valuenow="${sortdatas[x].rank}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                </div>`;
  };

  progress += `</div>`;
                    
  getsalecnt.innerHTML = progress;
};
window.onload = function(){
  let sortdatas = sortmaxtomin(saledata);
  showsaledatas(sortdatas);
};










//End Js Area 
     
// 12GT
//1ST

//2PG