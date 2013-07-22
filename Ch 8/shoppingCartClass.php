<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danielehrlich1
 * Date: 7/21/13
 * Time: 5:34 PM

 * is_empty()
 * add_item()
 * update_item()
 * delete_item()
 * display_cart()

 **/

class WidgetShoppingCart {

  // Attribute
  protected $items = array();


  // Indicates if cart is empty
  public function is_empty(){
    if (empty($this->items)){
      return true;
    } else {
      return false;
    }
  } // End of is_empty() method


  // Adds an item to the cart
  // Takes two arguments, the item ID and an array of info
  public function add_item($id, $info){

    // Is it already in the cart?
    if (isset($this->items[$id])){
      // Call the update_item() method
      $this->update_item($id, $this->items[$id]['qty'] + 1);
    } else {

      // Add the array of info
      $this->items[$id] = $info;

      // Add the quantity
      $this->items[$id]['qty'] = 1;

      // Print a message
      echo "<p>The widget '{$info['name']}' in color {$info['color']}, size {$info['size']} has been added to your shopping cart.</p>\n";
    }
  } // End of add_item() method



  // Method for updating an item in the cart
  // Takes two arguments, the item ID and the quantity
  public function update_item($id, $qty){

    // Delete if $qty equals 0:
    if ($qty = 0){
      $this->delete_item($id);
    } elseif  (($qty > 0) && ($qty != $this->items[$id]['qty'])){
      $this->items[$id]['qty'] = $qty;
      echo "<p>You now have $qty copy(ies) of the widget '{$this->items[$id]['name']}' in color {$this->items[$id]['color']}, size {$this->items[$id]['size']} in your shopping cart.</p>\n";

    }

  } // End of update_item() method.


  // Method for deleting an item in the cart.
  // Takes one argument: the item ID.
  public function delete_item($id) {

    // Confirm that it's in the cart:
    if (isset($this->items[$id])) {
      // Print a message:
      echo "<p>The widget '{$this->items[$id]['name']}' in color {$this->items[$id]['color']}, size {$this->items[$id]['size']} has been removed from your shopping cart.</p>\n";
      // Remove the item:
      unset($this->items[$id]);

    }

  } // End of delete_item() method.


  // Method for displaying the cart
  // Takes one argument: a form action value
  public function display_cart($action=false){
    echo '<table border="0" width="90%" cellspacing="2" cellpadding="2" align="center">
            <tr>
                <td align="left" width="20%"><b>Widget</b></td>
                <td align="left" width="15%"><b>Size</b></td>
                <td align="left" width="15%"><b>Color</b></td>
                <td align="right" width="15%"><b>Price</b></td>
                <td align="center" width="10%"><b>Qty</b></td>
                <td align="right" width="15%"><b>Total Price</b></td>
            </tr>
    ';

    // Print form code, if appropriate
    if ($action) {
      echo '<form action="' . $action . '" method="post">
		<input type="hidden" name="do" value="update" />
		';
    }

    // Initialize the total:
    $total = 0;

    // Loop through each item:
    foreach ($this->items as $id=>$info){

      $subtotal = $info['qty'] * $info['price'];
      $total += $subtotal;
      $subtotal = number_format($subtotal, 2);
    }
  }
}