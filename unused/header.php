<?php
  $pageHeaderHTML = '<div id="container">' ." \n";
  $pageHeaderHTML .= "\t<header> \n";
  $pageHeaderHTML .= "\t\t" . '<img src="tootukassa.png" alt="tootukassa" class="header" style="left:13%"/>'. "\n";
  $pageHeaderHTML .= "\t\t". '<img src="eesti.jpg" alt="eesti" class="header" style="right:25%"/>' . "\n";
  $pageHeaderHTML .= "\t\t" . '<img src="eures.png" alt="eesti" class="header" style="right:21%"/>' . "\n";
  $pageHeaderHTML .= "\t\t" . '<p style="right:16%" class="header">Mari Mets</p>' . "\n";
  $pageHeaderHTML .= "\t\t" . '<a href="https://www.tootukassa.ee/" style="right:12%" id="logout" class="header"> Välju </a>'. "\n";
  $pageHeaderHTML .= "\t</header> \n";
  $pageHeaderHTML .= "</div>\n";
  $pageHeaderHTML .= "<div>\n";
  $pageHeaderHTML .= "\t" . '<nav class="three">' . "\n";
  $pageHeaderHTML .= "\t\t" . "<ul>\n";
  $pageHeaderHTML .= "\t\t\t" . '<li><a href="#">Avaleht</a></li>' . "\n";
  $pageHeaderHTML .= "\t\t\t" . '<li><a href="#">Otsin tööd</a></li>' . "\n";
  $pageHeaderHTML .= "\t\t\t" . '<li><a href="#">Tööta ja õpi</a></li>' . "\n";
  $pageHeaderHTML .= "\t\t\t" . '<li><a href="#">Vähenenud töövõime</a></li>' . "\n";
  $pageHeaderHTML .= "\t\t\t" . '<li><a href="#">Teenused</a></li>' . "\n";
  $pageHeaderHTML .= "\t\t\t" . '<li><a href="#">Toetused ja hüvitised</a></li>' . "\n";
  $pageHeaderHTML .= "\t\t\t" . '<li><a href="#">Tööandjale ja koostööpartnerile</a></li>' . "\n";
  $pageHeaderHTML .= "\t\t\t" . '<li><a href="#">Töötukassast</a></li>' . "\n";
  $pageHeaderHTML .= "\t\t\t" . '<li><a href="#">e-töötukassassa</a></li>' . "\n";
  $pageHeaderHTML .= "\t\t" . "</ul>\n";
  $pageHeaderHTML .= "\t" . '</nav>' . "\n";
  $pageHeaderHTML .= '</div>' . "\n";

  echo $pageHeaderHTML;