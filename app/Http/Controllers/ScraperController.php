<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class ScraperController extends Controller
{
    public function example(Client $client){
        $client = new Client();
        $crawler = $client->request('GET','https://www.zmart.cl/JuegosPS4');
        $classDiv = 'BoxProductoS2 BorderPlatPS4';
        $productList = $crawler->filter('[class ="'.$classDiv.'"]')->each(function ($productNode, $productList) {
            $product['name'] = $productNode->children()->filter('.BoxProductoS2_Descripcion > a')->text();
            $product['price'] = $productNode->children()->filter('.BoxProductoS2_Precio')->text();
            $product['status'] = str_replace(' ', '', $productNode->children()->filter('.BoxProductoS2_Disponibilidad')->text());
            return $product;

        });

        foreach ($productList as $p){
            $serverName = "127.0.0.1";
            $dbUser = "root";
            $dbPass = "";
            $dbName = "test";
            $conn = mysqli_connect($serverName, $dbUser, $dbPass, $dbName);
            $name = $p['name'];
            $price = $p['price'];
            $status = $p['status'];
            $sql = "INSERT INTO games (item, price, status) VALUES ('".$name."','".$price."','".$status."')";
            mysqli_query($conn,$sql);
        }


        return view('scraper')->with('productList', $productList);
    }
    
    public function example1(Client $client){
        $client = new Client();
        $crawler = $client->request('GET','https://www.zmart.cl/Scripts/default.asp?tienda=comics');
        $classDiv = 'BoxProductoS2188 BorderPlat0';
        $productList = $crawler->filter('[class ="'.$classDiv.'"]')->each(function ($productNode, $productList) {
            $product['name'] = $productNode->children()->filter('.BoxProductoS2188_Descripcion > a')->text();
            $product['price'] = $productNode->children()->filter('.BoxProductoS2188_Precio')->text();
            $product['status'] = str_replace(' ', '', $productNode->children()->filter('.BoxProductoS2188_Disponibilidad')->text());
            return $product;

        });
        foreach ($productList as $p){
            $serverName = "127.0.0.1";
            $dbUser = "root";
            $dbPass = "";
            $dbName = "test";
            $conn = mysqli_connect($serverName, $dbUser, $dbPass, $dbName);
            $name = $p['name'];
            $price = $p['price'];
            $status = $p['status'];
            $sql = "INSERT INTO comics (item, price, status) VALUES ('".$name."','".$price."','".$status."')";
            mysqli_query($conn,$sql);
        }

        return view('scraper')->with('productList', $productList);
    }

    public function example2(Client $client){
        $client = new Client();
        $crawler = $client->request('GET','https://www.zmart.cl/scripts/prodList.asp?idCategory=291');
        $classDiv = 'BoxProductoS2188 BorderPlat0';
        $productList = $crawler->filter('[class ="'.$classDiv.'"]')->each(function ($productNode, $productList) {
            $product['name'] = $productNode->children()->filter('.BoxProductoS2188_Descripcion > a')->text();
            $product['price'] = $productNode->children()->filter('.BoxProductoS2188_Precio')->text();
            $product['status'] = str_replace(' ', '', $productNode->children()->filter('.BoxProductoS2188_Disponibilidad')->text());
            return $product;

        });
        foreach ($productList as $p){
            $serverName = "127.0.0.1";
            $dbUser = "root";
            $dbPass = "";
            $dbName = "test";
            $conn = mysqli_connect($serverName, $dbUser, $dbPass, $dbName);
            $name = $p['name'];
            $price = $p['price'];
            $status = $p['status'];
            $sql = "INSERT INTO toys (item, price, status) VALUES ('".$name."','".$price."','".$status."')";
            mysqli_query($conn,$sql);
        }
        return view('scraper')->with('productList', $productList);
    }
}

