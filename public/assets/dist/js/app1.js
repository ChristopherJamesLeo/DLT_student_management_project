$(document).ready(function(){

	// Start Leftside bar
	$('.sidebarlinks').click(function(){
		$('.sidebarlinks').removeClass("currents");
		$(this).addClass('currents');
	});

	// End Leftside bar
});

// Start Js Area
// Start dropdown
function dropbtn(e){
	// console.log(e.target);

	e.target.parentElement.nextElementSibling.classList.toggle('show');
}
// console.log('hi');
// End dropdown

// Start Expenses Area
const ctx = document.getElementById('mypiechart');
ctx.height = 250;
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

// End Expenses Area

// End Js Area