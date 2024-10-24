<?php

class Product
{
  public $id;
  public $name;
  public $price;
  public $imagePath;

  function __construct($id, $name, $price, $imagePath)
  {
    $this->id = $id;
    $this->name = $name; 
    $this->price = $price;
    $this->imagePath = $imagePath;
  }
}

$products = array(
  new Product(1, 'Smart TV LED 55', 2900, 'images/tv.webp'),
  new Product(2, 'Smartphone 6.5 ABC', 1590, 'images/smartphone.webp'),
  new Product(3, 'Notebook 17 Ultra Slim', 4299, 'images/notebook.webp'),
  new Product(4, 'Mouse Óptico XYZ', 149, 'images/mouse.webp'),
  new Product(5, 'Monitor 28 4k', 1460, 'images/monitor.webp'),
  new Product(6, 'Fone Headset ABC', 250, 'images/headset.webp'),
  new Product(7, 'Pen-drive de 64GB', 90, 'images/pen-drive.webp')
);
 
$randProds = [
  $products[rand(0, 6)],
  $products[rand(0, 6)],
  $products[rand(0, 6)],
  $products[rand(0, 6)],
  $products[rand(0, 6)]
];

header('Content-type: application/json');
echo json_encode($randProds);
