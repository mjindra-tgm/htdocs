
<?php
SESSION_START(); 
$_SESSION["kürzel"]="KRAH0";
if(empty($_SESSION['username'])||empty($_SESSION['password'])){
		header ( 'Location:index.php' );
}
?>
<html>
  <head>
    <meta charset="utf-8">

		<link rel="stylesheet" href="mdl/material.min.css">
		<script src="mdl/material.min.js"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		
  </head>

  <body class="index">
	<div class="mdl-grid" id="alldiv">
		
		<div class="mdl-cell mdl-cell--2-col">
		<img src="http://placehold.it/350x150">
		</div>
		
		<div class="mdl-cell mdl-cell--2-col">
		</div>
		
		<div class="mdl-cell mdl-cell--4-col">
		<h1>Ampelsystem</h1>
		</div>
		
		<div class="mdl-cell mdl-cell--2-col ">
		</div>
		
		<div class="mdl-card mdl-cell mdl-cell--2-col mdl-shadow--2dp">
			<div class=" mdl-card__supporting-text">
			<?php
			echo '<h2 class="mdl-card__title-text">'.$_SESSION["username"].'</h2>';
			?>
			<br >
			<div class="mdl-card__title">
			<form method="get" action="/index.php">
				<!-- Raised button with ripple -->
				<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
				  Logout
				</button>
			</form>
			</div>	
			</div>
		</div>
		
		<div id="fachdiv" class="mdl-cell mdl-cell--2-col">
		<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
		  <thead>
			<tr>
			  <th class="mdl-data-table__cell--non-numeric"><h5>Fach</h5></th>
			  <th></th>
			</tr>
		  </thead>
		  <tbody>
			<?php
				//Öffnet ein file und legt es in einem Array ab.
				$file = file("example.txt");
				//Ein Array um die bereits aufgelisteten Felder nicht nochmals zu listen.
				$fach = array();
				//Der Index für das Array ^
				$x=0;
				for($i=0; $i < count($file); $i++){
					//Zerhackt die Zeile anhand von Beistrichen, und speichert sie in einem Array.
					$line = explode(',',$file[$i]);
					//Filtert nach dem Lehrer
					if(stripos($line[2],$_SESSION["kürzel"])){
						//geht die Fächer durch
						if(!in_array($line[3],$fach)){
							echo('<tr><td class="mdl-data-table__cell--non-numeric">'.str_replace("\"","",$line[3]).'</td><td><input type="radio" name="fach" value='.str_replace("\"","",$line[3]).' class="mdl-radio mdl-js-radio mdl-radio__button mdl-js-ripple-effect"></td></tr>');
							$fach[$x]=$line[3];
							$x++;
						}
					}
				}
			?>
		  </tbody>
		</table>
		</div>
		
		<div class="mdl-cell mdl-cell--2-col ">
		</div>
   
		<div id="ampeldiv" class="mdl-cell mdl-cell--6-col">
		<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
		  <thead>
			<tr>
			  <th class="mdl-data-table__cell--non-numeric"><h5>Vorname</h5></th>
			  <th class="mdl-data-table__cell--non-numeric"><h5>Nachname</h5></th>
			  <th class="mdl-data-table__cell--non-numeric"><h5>Rot</h5></th>
			  <th class="mdl-data-table__cell--non-numeric"><h5>Gelb</h5></th>
			  <th class="mdl-data-table__cell--non-numeric"><h5>Grün</h5></th>
			</tr>
		  </thead>
		  <tbody>
			<tr>
			  <td class="mdl-data-table__cell--non-numeric">Michael</td>
			  <td class="mdl-data-table__cell--non-numeric">Jindra</td>
			  <td><input type="radio" name="n1"></td>
			  <td><input type="radio" name="n1"></td>
			  <td><input type="radio" name="n1"></td>
			</tr>
			<tr>
			  <td class="mdl-data-table__cell--non-numeric">Nemanja</td>
			  <td class="mdl-data-table__cell--non-numeric">Filipovic</td>
			  <td ><input type="radio" name="n2"></td>
			  <td ><input type="radio" name="n2"></td>
			  <td ><input type="radio" name="n2"></td>
			</tr>
		  </tbody>
		</table>
		</div>
		
		<div class="mdl-cell mdl-cell--2-col">
		</div>
		
		<div id="Klassediv" class="mdl-cell mdl-cell--2-col">
		<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
		  <thead>
			<tr>
			  <th class="mdl-data-table__cell--non-numeric"><h5>Klasse</h5></th>
			  <th></th>
			</tr>
		  </thead>
		  <tbody>
			<?php
				$file = file("example.txt");
				$klasse = array();
				$x=0;
				for($i=0; $i < count($file); $i++){
					$line = explode(',',$file[$i]);
					if(stripos($line[2],$_SESSION["kürzel"])){
						if(!in_array($line[1],$klasse)AND !empty($line[1])){
							echo('<tr><td class="mdl-data-table__cell--non-numeric">'.str_replace("\"","",$line[1]).'</td><td><input type="radio" name="klasse" value='.str_replace("\"","",$line[1]).' class="mdl-radio mdl-js-radio mdl-radio__button mdl-js-ripple-effect"></td></tr>');
							$klasse[$x]=$line[1];
							$x++;
						}
					}
				}
			?>
		  </tbody>
		</table>
		</div>
		
		<div class="mdl-cell mdl-cell--2-col">
		</div>
		
		<div>
			<!-- Raised button with ripple -->
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" type="button" id="aktualisieren">
			  Aktualisieren
			</button>
		</div>
		
		<div>
			<!-- Raised button with ripple -->
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
			  Speichern
			</button>
		</div>		
		
		</div>
	</div>
  </body>
</html>
<?php ?> 