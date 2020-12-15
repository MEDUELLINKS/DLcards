<?php 
    $dblink = mysqli_connect("shareddb-x.hosting.stackcp.net", "medata-3135376374", "PlaymakerEY23", "medata-3135376374"); if (mysqli_connect_error()) {
        
        die ("There was an error connecting to the database");
        
    } 
move_uploaded_file($_FILES["inpFile"]["tmp_name"], "lol.jpg");
echo $_POST['inputName'];
   if( $_POST["post_type"] == "tournament"){
       
   if ($_POST["tournament_type"] == "Battle Phase!"){
        $tournament = $_POST["tournament_type"];
        $tbr = BP;
        $tr = BP;
    } else if ($_POST["tournament_type"] == "DLTW Weekly"){
        $tournament = $_POST["tournament_type"];
        $tbr = DLTW;
        $tr = DLTW_Weekly;
    }
    $article ='<?php include $_SERVER["DOCUMENT_ROOT"]."/assets/en/head"; ?>  
<P class="title" style="font-size:50px;">'.$tournament.' #'.$_POST['number'].'</p>
<P style="font-size:25px; font-style:italic;">Publish Date:'.$_POST["date"].'</p><br>
<img class="tournament-banner" src="/assets/banners/Tournaments/'.$tbr.'.jpg"><br><br>

<p class="text-dialouge">
    
    Tournament info:<br>
    Format:'.$_POST["format"].'<br>
    Number of Players:'.$_POST["nplayers"].'<br>
    Entery Fee:'.$_POST["fee"].'<br>
    Prize: '.$_POST["prize"].'<br>
    Discord Server: <a href="https://discord.com/invite/VhTtzn3" target="_blank">Here</a><br>
    Date:'.$_POST["tdate"].'</p><br><br>
    
    
    
    
<img class="tournament-banner" src="/lol.jpg"><div class="boarder"></div>


<p class="text-short">1st Place: <?php $_GET["id"]='.$_POST["1st"].'; include $_SERVER["DOCUMENT_ROOT"]."deckinclude.php" ?>
<p class="text-short">2nd Place: <?php $_GET["id"]='.$_POST["2nd"].'; include $_SERVER["DOCUMENT_ROOT"]."deckinclude.php" ?>
<p class="text-short">Top 4: <?php $_GET["id"]='.$_POST["3rd"].'; include $_SERVER["DOCUMENT_ROOT"]."deckinclude.php" ?>
<p class="text-short">Top 4: <?php $_GET["id"]='.$_POST["4th"].'; include $_SERVER["DOCUMENT_ROOT"]."deckinclude.php" ?>
<p class="text-short">Top 8: <?php $_GET["id"]='.$_POST["5th"].'; include $_SERVER["DOCUMENT_ROOT"]."deckinclude.php" ?>
<p class="text-short">Top 8: <?php $_GET["id"]='.$_POST["6th"].'; include $_SERVER["DOCUMENT_ROOT"]."deckinclude.php" ?>
<p class="text-short">Top 8: <?php $_GET["id"]='.$_POST["7th"].'; include $_SERVER["DOCUMENT_ROOT"]."deckinclude.php" ?>
<p class="text-short">Top 8: <?php $_GET["id"]='.$_POST["8th"].'; include $_SERVER["DOCUMENT_ROOT"]."deckinclude.php" ?>

<?php include $_SERVER["DOCUMENT_ROOT"]."/assets/en/footer"; ?>  ';
    $link = "https://www.middleeastlinks.com/en/Tournaments/".mysqli_real_escape_string($dblink, $tr )."/".mysqli_real_escape_string($dblink,$_POST["number"] );
      if (mysqli_num_rows(mysqli_query($dblink, "SELECT * from report WHERE link = '$link'")) > 0 && $_POST['overwrite'] != "overwrite") {
         die ('<p style="color:red;">'.$_POST["tournament_type"].' #'.$_POST["number"].' article already exist!<br> Please select the Overwrite option if you wish to edit an already existing article!</p>');
      }
    mysqli_query($dblink,  "INSERT INTO `report`(`type`,`title`,`content`,`link`) VALUES('".mysqli_real_escape_string($dblink,$_POST["post_type"] )."','".mysqli_real_escape_string($dblink,$_POST["tournament_type"] )." #".mysqli_real_escape_string($dblink,$_POST["number"] )."','".mysqli_real_escape_string($dblink,$tbr)."','".mysqli_real_escape_string($dblink,$link)."')");
file_put_contents($_SERVER["DOCUMENT_ROOT"]."/en/Tournaments/".$tr."/".$_POST["number"].".php",$article ); 
if ($_POST['overwrite'] == "overwrite") {
    echo "<p style='color:green;'>Overwrite Successful<p>";
}   else {
echo "<p style='color:green;'>Post Success<p>";
    
}
       
   }








?>