<?php
    header("Content-type: text/css; charset: UTF-8");
?>

*{
    font-family: cursive;
    box-sizing: border-box;
}

.navbar{

}
/*product_details container*/
.product_detail{
    height: 400px;
}

/*electro-menu*/
#sidebar{
    position:absolute;
    left:1%;
    top:62%;
    width:14%;
}

/*search field */
.srchTxt{
    font-size:medium;
   text-align:center;
}
.srch-catag{
   background:aliceblue;
}
#show{
    display: visible;
}
#hide{
  display: none;
}

/*contact*/
.span4{
    font-family: 'Courier New', Courier, monospace;
    font-weight: bolder;
    color: rgb(121, 114, 128);
    background-color: aliceblue;
}

/*login*/
.login-cont{
    text-align: center;
    background-color: aquamarine;
}
h3{
    color: grey;
}
.latest-h{
 margin-left:30px;
 color:#3A3F44;
}
/*cart css */
.cart .container {
    height:400px;
  margin: 0 auto;
  padding: 20px;

}
.tableBtm{
    display:flex;
    flex-direction:column;
}

.cart h1 {
  text-align: center;
}

.cart .text-end {
  text-align: right;
}

.cart .mt-4 {
  margin-top: 1.5rem;
}

#cartNum{
  position:absolute;
  top:15%;
  left:70%;
  color:black;
  background:skyblue
}
/*dynamic-data-container-search css*/
.dynamic-data-container-search .product{
    margin-left:2.5%;
}
.pag-cont-search{
    clear:both;
    margin-left:0%;
}

/*dynamic-data-container*/
.latest-h{
    margin-bottom:15px;
    text-align:center;
    width:20%;
    box-shadow: 
       inset 0 -3em 3em rgba(0,0,90,0.1), 
             0 0  0 2px rgb(255,255,255),
             0.3em 0.3em 1em rgba(0,0,0,0.3);
}
.dynamic-data-container{
    height:500px;
    margin-left:15%;
}
.prod-in{
    background:aliceblue;
    height:400px
}

.product{
    text-align:center;
    float:left;
    height: 300px;
    cursor:pointer;
    overflow:hidden;
    border:none;
    width:22%;
    margin-left:3%;
    margin-bottom:4%;
    background:#white;
   /*best css shadow*/
    box-shadow: 
       inset 0 -3em 3em rgba(0,0,0,0.1), 
             0 0  0 2px rgb(255,255,255),
             0.3em 0.3em 1em rgba(0,0,0,0.3);
    transition: all 300ms ease-in-out;
}
.product:hover{
    transform: scale(1.05, 1.05);/*this will zoom element*/
}

.product:hover{
    padding:0px;

}


.image{
    height: 150px;
    width: 100%;
}
.description{
    color:grey;
    font-size:medium;
    overflow: hidden;
    height: 40px;
    font-family:cursive;
}
.title{
    text-align: center;
}
.discount{
    color:red;
}
.item-left{
    
}

/*pagination div css */
.pag-cont{
    clear:both;
    margin-left:16%;
}
.pagination {
           margin-top:30px;
           margin-bottom:15px;
           margin-right:2px;
           display:flex;
           justify-content:center;
       }
.pagination a {
           border:1px solid #3A3F44;
          color: black;
          float: left;
          padding: 8px 16px;
          text-decoration: none;
           }
.pagination a:hover{
          background-color: #ddd;
                          }
.pagination .active{
    color:white;
    background:#3A3F44;
}

/* table css */
table {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  text-align:center
}

table td, table th {
  border: 1px solid #ddd;
  padding: 8px;
}

table tr:nth-child(even){background-color: #f2f2f2;}

table tr:hover {background-color: #ddd;}

table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align:center;
  background-color: #04AA6D;
  color: white;
}

/*responsive for ipad iphone and other */
@media (max-width: 500px) {
   .product{
       width:90%;
       margin-bottom:10%;
   }

}
@media (max-width: 900px) {

   #cartNum{
    position:absolute;
    left:5%;
    color:red;
   }
}
@media (max-width: 1024px) {
#sidebar{
    display:inline;
    position:relative;
}
.latest-h{
       width:50%;
}
}














/* ADMIN Panel CSS START */
/* ===================== */

/*Admin footer css */
.footer{
    text-align: center;
    text-align:center;
}
/*headernav css */
#navbarNavDropdown{
    display:flex; 
    justify-content:center;
    font-size:20px;
    font-weight:bold
}
.nav-item:hover{
    background-color: rgb(17, 157, 192);
    opacity: 0.6;
}

/*index css */
#logo{
    height: 60px;
    width: 300px;
    border-radius: 10px;
}
#hlogo {
    display:flex;
    align-items:center;
    justify-content:center;
    height: 70px;
    width:320px;
    border-radius: 5px;
    background-color: rgb(85, 108, 128);
}
.heading{
    text-decoration:underline;
}
.form{
    background-color: white;
    height: 250px;
    display:flex;
    align-items:center;
    justify-content:center;
}
.form label{
    font-weight: bolder;
}
.input-admin{
    width: 250px;
}

.update-btn{
    border:none;
    padding:10px;
    background:#40E0D0;
    border-radius:10%;
}
.update-btn:hover{
    color:wheat;
}



/* ===================== */
/* ADMIN Panel CSS END */
/* ===================== */




