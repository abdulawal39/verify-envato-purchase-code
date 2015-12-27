<?php
require_once('class.verify-purchase.php');
if(isset($_POST['purchase_code'])){
    $purchase_code = htmlspecialchars($_POST['purchase_code']);
    $result_type = htmlspecialchars($_POST['result_type']);
    $o = EnvatoApi2::verifyPurchase( $purchase_code );
    if ( is_object($o) ) {
      $output  = '<div class="panel panel-default">';
      $output .= '<div class="panel-heading">Product Name</div>';
      $output .= '<div class="panel-body">';
      $output .= '<strong>'.$o->item_name.'</strong>';
      $output .= '</div></div>';
      $output .= '<div class="panel panel-success">';
      $output .= '<div class="panel-heading">Purchase Date</div>';
      $output .= '<div class="panel-body">';
      $output .= '<strong>'.$o->created_at.'</strong>';
      $output .= '</div></div>';
      $output .= '<div class="panel panel-default">';
      $output .= '<div class="panel-heading">Buyer Name</div>';
      $output .= '<div class="panel-body">';
      $output .= '<strong>'.$o->buyer.'</strong>';
      $output .= '</div></div>';
      $output .= '<div class="panel panel-success">';
      $output .= '<div class="panel-heading">License Type</div>';
      $output .= '<div class="panel-body">';
      $output .= '<strong>'.$o->licence.'</strong>';
      $output .= '</div></div>';
      $output .= '<div class="panel panel-default">';
      $output .= '<div class="panel-heading">Supported Until</div>';
      $output .= '<div class="panel-body">';
      $output .= '<strong>'.$o->supported_until.'</strong>';
      $output .= '</div></div>';

      $output_table = '<table class="table table-bordered">';
      $output_table .= '<thead><tr><th>Title</th> <th>Value</th></tr> </thead>';
      $output_table .= '<tbody>';
      $output_table .= '<tr><td>Product Name</td><td>'.$o->item_name.'</td></tr>';
      $output_table .= '<tr><td>Purchase Date</td><td>'.$o->created_at.'</td></tr>';
      $output_table .= '<tr><td>Buyer Name</td><td>'.$o->buyer.'</td></tr>';
      $output_table .= '<tr><td>License Type</td><td>'.$o->licence.'</td></tr>';
      $output_table .= '<tr><td>Supported Until</td><td>'.$o->supported_until.'</td></tr>';
      $output_table .= '</tbody>';
      $output_table .= '</table>';
      switch ($result_type) {
        case 'table':
          echo $output_table;
          break;
        
        case 'list':
          echo $output;
          break;
        default:
          echo $output;
          break;
      }
    } else {
      echo "<span style='color: red'>Sorry, This is not a valid purchase code or this user have not purchased any of your items.</div>";
    }
}
?>