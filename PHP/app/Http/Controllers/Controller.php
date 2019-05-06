<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Produkt
{
    var $price;
    var $id;
    var $title;
    var $description;
    var $image;
}
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $request) {

        return view("index", [
            "logged_in" => $request->session()->has("user"),
            "name" => $request->session()->get("user"),
            "produkty" =>$this->produkty(),

        ]);


        }

        public function login(Request $request){

            $request->session()->put ("user", "Dominik Haššo");
            return redirect("/");



        }


        public function logout(Request $request){

            $request->session()->forget ("user");
            return redirect ("/");

        }

    public function cart(Request $request){
        if(!$request->session()->has("user")) //ak nie  je prihlasený => vráti ho to naspäť
        {
            return redirect ("/");
        }


        $cart = $request->session()->get("cart", []);

        return view("index", [
            "logged_in" => $request->session()->has("user"),
            "name" => $request->session()->get("user"),
            "produkty" => $cart,

        ]);



    }

    public function add(Request $request, $id){

        if(!$request->session()->has("user"))
        {
             return redirect ("/");
        }

        $produkty = $this->produkty();
        $produkt = $produkty[$id];

        $cart = $request->session()->get("cart", []);
        $cart[$id] = $produkt;

        $request->session()->put("cart", $cart);

        return redirect ("/cart");

    }

    public function produkty(){

        $p1 =  new produkt();
        $p1 -> id = 1;
        $p1 -> prize = "250.000";
        $p1 -> title = "Audi e-tron";
        $p1 -> description = "Revolučné a usporné ";
        $p1 -> image = "https://media.wired.com/photos/5ba02b51b3dc2a2daf36842b/master/w_582,c_limit/Audi-E-Tron_17.jpg";

        $p2 = new produkt();
        $p2 -> id = 2;
        $p2 -> prize = "120,000";
        $p2 -> title = "R6";
        $p2 -> description = "Rodinne založené  ";
        $p2 -> image = "https://photos7.motorcar.com/used-2013-audi-a6-factory20wheelsnavigationrearcamclean-5419-16947535-5-1024.jpg";

        $p3 = new produkt();
        $p3 -> id = 3;
        $p3 -> prize = "210,000";
        $p3 -> title = "R8";
        $p3 -> description = "športový fanušikovia  ";
        $p3 -> image = "https://services.netwheels.fi/UudetAutotMat/150/Audi_531_6_201591585631.jpg";

        return [
            $p1->id => $p1,
            $p2->id => $p2,
            $p3->id => $p3,
        ];

    }


}
