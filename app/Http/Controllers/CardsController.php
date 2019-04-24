<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;
use App\Http\Repository\CardRepository;

class CardsController extends Controller
{
    protected $cardRepository;

    public function __construct(){
        $this->cardRepository =  new CardRepository();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function index(Request $request){
        if(!$request->all()) {
            $card = $this->cardRepository->index();
            return view('card')->with('card',$card);
        }
        return null;
    }

    public function getCard(Request $request){
        return Card::with(['course','discipline','files','teachers'])->where('id',$request['id'])->first()->toJson();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function search(Request $request){
        return $this->cardRepository->search($request->all());
    }

    /**
     * @param Request $request
     */
    public function create(Request $request){
        return $this->cardRepository->create($request->all());
    }

    public function update(Request $request){
        return $this->cardRepository->update($request->all());
    }
    public function mover(Request $request){
        return $this->cardRepository->mover($request->all());
    }

    public function curso(){
        return $this->cardRepository->curso();
    }

    public function disciplina(){
        return $this->cardRepository->disciplina();
    }

    public function aula(){
        return $this->cardRepository->aula();
    }

    public function professor(Request $request){
        return $this->cardRepository->professor($request->all());
    }
}
