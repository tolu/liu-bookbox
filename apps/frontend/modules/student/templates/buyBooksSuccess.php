<?php
  echo '<h3 class="ui-widget-header ui-corner-all headerSpacing">Du har valt att köpa:</h3>';
  $totalPrice = 0;
  $emailMsg = '';
  $emailMsg .= '<h3>Köpkvitto ifrån BookBox!</h3><p>Du har valt att köpa följande böcker:</p>';
  for($i=0; $i<$nrOfSales; $i++)
  {
    $sellerMessage = '<h3>Säljkvitto ifrån BookBox!</h3><p>Du har fått följande bok såld:</p>';
    $sellerMessage .= '<b>'.$bookList[$i]->getTitle().'</b><br/>';
    $sellerMessage .= 'För: '.$saleList[$i]->getPrice().'<br/>';
    $sellerMessage .= 'Köpare: '.$userName.'<br/>';
    $sellerMessage .= 'Email: '.$userEmail.'<br/><br/>';
    $sellerMessage .= '<h4>Välkommen Åter!</h4>';
    
    //some info to print to screen for seller
    echo '<div class="ui-widget-content" style="margin:1em;">';
      echo $bookList[$i]->getTitle().'<br/>';
      echo 'För: '.$saleList[$i]->getPrice().'kr<br/>';
      echo 'Av: '.$sellerName[$i];
    echo '</div>';
    $totalPrice += $saleList[$i]->getPrice();
    
    //add info to mail message
    $emailMsg .= '<p>Bok: <b>'.$bookList[$i]->getTitle().'</b><br />';
    $emailMsg .= 'För: '.$saleList[$i]->getPrice().' kr<br />';
    $emailMsg .= 'Säljare: '.$sellerName[$i].'<br />';
    $emailMsg .= 'Email: '.$sellerEmail[$i].'</p>';
    
    //mail to seller
    $mailToSeller = array();
    $mailToSeller['to'] = $sellerEmail[$i];
    $mailToSeller['toName'] = $sellerName[$i];
    $mailToSeller['subject'] = 'Bookbox - säljkvitto!';
    $mailToSeller['message'] = $sellerMessage;
    include_component('shared', 'sendMail', $mailToSeller);
  }
  $emailMsg .= 'Du har köpt böcker för: '.$totalPrice;
  $emailMsg .= '<h5>Välkommen åter!</h5>';
  
  
  echo '<span style="margin:1em;">För den totala kostnaden: '.$totalPrice.'</span>';
  echo '<p style="margin:1em;"><strong>OBS</strong><br/>';
  echo 'Du har nu fått ett mail med kontaktuppgifter till säljarna, ';
  echo 'de har också fått mail med information om att köpet har gått igenom.';
  echo ' Lycka till och VÄLKOMMEN ÅTER!</p>';
  
  //send email to the buyer
  $mailToBuyer = array();
  $mailToBuyer['to'] = $userEmail;
  $mailToBuyer['toName'] = $userName;
  $mailToBuyer['subject'] = 'Bookbox - köpkvitto!';
  $mailToBuyer['message'] = $emailMsg;
  include_component('shared', 'sendMail', $mailToBuyer);
?>