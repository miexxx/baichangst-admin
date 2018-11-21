<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/23/023
 * Time: 16:18
 */
namespace App\Http\Controllers;
use App\Models\Address;

class JsonController extends Controller{
    public function index(){
       //解析json
        $json_string = file_get_contents('address.json');
        $datas = json_decode($json_string);

        foreach ($datas as $data) {
            $arr = explode(":",$data);
            $address = new Address();
            $address->address_id = $arr[0];
            $address->address_name = $arr[1];
            $address->save();
            echo $arr[0]." ".$arr[1]."</br>";
        }

    }
}