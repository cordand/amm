<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">

        <link href="styles/myCss.css" rel="stylesheet">
        <title>Homepage</title>
    </head>
        <body onresize="go()">
     <div id="all">
         
    <header id="header">
        <img title="header" src="images/header.png"/>
        
        <form id="login" action="login.php">
            <label>Email <input type="text" name="s-user" id="s-user"></label><br><br>
            <label>Password<input type="text" name="s-pass" id="s-pass"></label>
            <input type="submit" class="submit" value="Login">
      </form>
    </header>
    
    
    
    
        
        <div id="corpo">
    <div id="main">
<!--        <script>
           

            function go(){
              
                var contenuto = document.getElementById("content").offsetWidth;
                var contenitore = document.getElementById("corpo").offsetWidth;
                if(contenitore-40-contenuto<240){   //non basta per tutti e due
                    document.getElementById("main").style.width = "50%";
                }
//                else{
//                     if(document.getElementById("main").style.width === 50%){
//                        document.getElementById("main").style.width = "70%";
//                    }
//                }
    }
        </script>-->

<!--<p id="demo"></p>

<script>
function myFunction() {
    var x = "Total Width: " + document.getElementById("demo").offsetWidth + "px";
    document.getElementById("demo").innerHTML = x;
}
</script>-->
        <article id="content">
            <p>
                
            <h1 id="titolo">Titolo articolo</h1>
            <h3 id="sottotitolo">Sottotitolo articolo</h3>
            <p id="testo">
                Testo Testo Testo
            </p>
                    
            </p>
        </article>
        
    </div>

            
    <nav id="sidebar">
        <h3>Inserimenti recenti</h3>
            <ul>
             <li>Primo valore</li>
             <li>Secondo valore</li>
             <li>Terzo valore</li>
            </ul>   
        <p>
            
        </p>
    </nav>

</div>
     </div>
        
        
    </body>
    

</html>
