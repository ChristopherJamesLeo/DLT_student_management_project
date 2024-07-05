import 'bootstrap'; // bootstrap js
import 'bootstrap/dist/css/bootstrap.min.css'; // bootstrap အားခေါ်ပေးရမည် // bootstrap css
import './../css/app.css'; // css ထဲရှိ bootstarp အား ခေါ်ပေးရမည် // main css

// import './../../public/assets/dist/css/style.css' ; // custom css // မချိတ်ထားပါက header ထဲရှိ  vite ထဲတွင် array ဖြင့် ပတ်လမ်းကြောင်းထည့်ပေးရမည် 
import './../../public/assets/dist/css/style.css' ; // custom css
import './../../public/assets/dist/js/app.js' ; // custom css

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
