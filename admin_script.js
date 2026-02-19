let accountBox=document.querySelector('.header .account-box');

document.querySelector('#user-btn').onclick = () =>{
    accountBox.classList.toggle('active');
         navbar.classList.remove('active');
}
window.onscroll=()=>{
     accountBox.classList.remove('active');

}