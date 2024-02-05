<?php
session_start(); 
date_default_timezone_set('Asia/Manila');
require_once('../../database/connection.php');

if(isset($_POST['cancelOrder']))
{  
  echo '
  <div  class="modal-content" style="width: 100%;" >
    <div class="modal-header">  
      <h4 class="modal-title">Confirmation</h4>  
      <button type="button" class="close" data-dismiss="modal">&times;</button>  
    </div>  
    <div class="modal-body">
        Are you sure you want to cancel this order?
        <br><br>
        <input type="text" name="cancelRemarks" placeholder="Please input remarks" required class="form-control">
      
    </div>      
    <div class="modal-footer">
        <button class="btn btn-dark" type="submit" name="cancelOrderBtn"><i class="fa fa-check-circle"></i> Cancel Order</button>
        <input type="hidden" name="orderid" value="'.$_POST['cancelOrder'].'">
    </div>  
  </div>';
}

if(isset($_POST['prepareOrder']))
{  
  echo '
  <div  class="modal-content" style="width: 100%;" >
    <div class="modal-header">  
      <h4 class="modal-title">Confirmation</h4>  
      <button type="button" class="close" data-dismiss="modal">&times;</button>  
    </div>  
    <div class="modal-body">
        You are about to prepare this order      
    </div>      
    <div class="modal-footer">
        <button class="btn btn-dark" type="submit" name="prepareOrderBtn"><i class="fa fa-check-circle"></i> Confirm</button>
        <input type="hidden" name="orderid" value="'.$_POST['prepareOrder'].'">
    </div>  
  </div>';
}
if(isset($_POST['ReceivedOrder']))
{  
  echo '
  <div  class="modal-content" style="width: 100%;" >
    <div class="modal-header">  
      <h4 class="modal-title">Confirmation</h4>  
      <button type="button" class="close" data-dismiss="modal">&times;</button>  
    </div>  
    <div class="modal-body">
        Are you sure you receive this order?
    </div>      
    <div class="modal-footer">
        <button class="btn btn-dark" type="submit" name="ReceivedOrderBtn"><i class="fa fa-check-circle"></i> Confirm</button>
        <input type="hidden" name="orderid" value="'.$_POST['ReceivedOrder'].'">
    </div>  
  </div>';
} 


// if(isset($_POST['outOrder']))
// {  
//   echo '
//   <div  class="modal-content" style="width: 100%;" >
//     <div class="modal-header">  
//       <h4 class="modal-title">Confirmation</h4>  
//       <button type="button" class="close" data-dismiss="modal">&times;</button>  
//     </div>  
//     <form action="" method="post">
//       <div class="modal-body">
//       Are you sure that this order is out for delivery?      
//       </div>      
//       <div class="modal-footer">
//       <button class="btn btn-dark" type="submit" name="outOrderBtn"><i class="fa fa-check-circle"></i> Yes</button>
//       <input type="hidden" name="orderid" value="'.$_POST['outOrder'].'">
//       </div>  
//     </form>
//   </div>';
// }
// // $apikey = '8fb4048190209848376d07e02cfed34e';

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   // $number = $_POST['number']; // Phone number to send SMS
//   // $message = $_POST['message']; // SMS message


//       $ch = curl_init();
//       $parameters = array(
//           'apikey' => '8fb4048190209848376d07e02cfed34e', //Your API KEY
//           'number' => '09460947869',
//           'message' => 'DEAR Maam/Sir ,
//           Your order is on its way! As you have ordered via Cash on Delivery, please have the exact amount of cash for our deliverer.
//            Thank you..',
//           'sendername' => 'SEMAPHORE'
//       );
//       curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
//       curl_setopt( $ch, CURLOPT_POST, 1 );

//       //Send the parameters set above with the request
//       curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

//       // Receive response from server
//       curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
//       $output = curl_exec( $ch );
//       curl_close ($ch);

//       //Show the server response
//       // echo $output;
// }
?>
