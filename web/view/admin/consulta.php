

<html>
   <head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Proyecta SF</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
* {box-sizing: border-box;}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #e9e9e9;
}

.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #2196F3;
  color: white;
}
.topnav a.active1 {
  background-color: #6cab3a;
  color: white;
}

.topnav .search-container {
  float: right;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}

.topnav .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

@media screen and (max-width: 600px) {
  .topnav .search-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;  
  }
}




</style>
</head>
<header class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-5 header-logo">
                    <br>
                    <img src="img/logo1.png" alt="" class="img-responsive logo">
                </div>
            </div>
        </div>
</header>
  <div class="topnav">
    <a class="active" href="index.html#home">Inicio</a>
  </div>
  <div class="search-container">
    <form method="POST" action="busquedad.php" onSubmit="return validarForm(this)">
      <input type="text" placeholder="Buscar por Tecnico" name="palabra">
      <button type="submit" value = "Buscar" name="buscar"><i class="fa fa-search" ></i></button>
    </form>
    </div>
    <div class="search-container">
    <form method="POST" action="cate.php" onSubmit="return validarForm(this)">
      <input type="text" placeholder="Buscar por Categoria" name="cate">
      <button type="submit" value = "Buscar" name="buscar2"><i class="fa fa-search" ></i></button>
    </form>
     </div>
    <div class="search-container">
    <form method="POST" action="smai.php" onSubmit="return validarForm(this)">
      <input type="number" placeholder="Buscar por folio ISMAI-SC" name="numero">
      <button type="submit" value = "Buscar" name="buscar1"><i class="fa fa-search" ></i></button>
    </form>
  </div>


 
</script>
</body>
</html>


