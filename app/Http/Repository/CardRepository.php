<?php
namespace App\Http\Repository;


use App\Card;
use App\CardFile;
use App\Course;
use App\Discipline;
use App\Teacher;
use Carbon\Carbon;

class CardRepository
{
    public function index() : array {
        try{
            return $this->formatCardArray(Card::with(['course','discipline','files','teachers'])->get()->toArray());
        }catch (\Exception $e){
            return ['code' => $e->getCode(),'message' => $e->getMessage(), 'data' => null];
        }
    }

    public function curso(){
        return Course::all()->toJson();
    }

    public function professor($filter){
        if($filter == null) {
            return Teacher::all()->toJson();
        }
        $teacher = Teacher::where('name','like',$filter['term'].'%')->get('name')->toArray();

        return array_column($teacher, 'name');
    }

    public function disciplina(){
        return Discipline::all()->toJson();
    }

    public function aula(){
        return Card::select('id')->get()->toJson();
    }

    public function search(array $data, array $filter) : array {
        try{
            return $this->formatCardArray(Card::with(['course','discipline','files','teachers'])->get()->toArray());
        }catch (\Exception $e){
            return ['code' => $e->getCode(),'message' => $e->getMessage(), 'data' => null];
        }
    }

    public function create(array $data){

        if(count($data['material']) == 2){
            $data['material'] = 3;
        }
        if(count($data['material']) == 1){
            $data['material'] = $data['material'][0];
        }
        $card = new Card();
        $card->id_course = $data['id_course'];
        $card->id_discipline = $data['id_discipline'];
        $card->educational_material = $data['material'];
        $card->type = $data['type'];
        $card->year = $data['year'];
        $card->status = 1;
        $card->save();
        $card->teachers()->sync($data['id_teacher']);

        return $card->toJson();
    }

    public function update($data){
        if(count($data['material']) == 2){
            $data['material'] = 3;
        }
        if(count($data['material']) == 1){
            $data['material'] = $data['material'][0];
        }
        $card = Card::find($data['id']);
        $card->id_course = $data['id_course'];
        $card->id_discipline = $data['id_discipline'];
        $card->educational_material = $data['material'];
        $card->type = $data['type'];
        $card->year = $data['year'];
        $card->status = 1;
        $card->save();
        $card->teachers()->detach();
        $card->teachers()->sync($data['id_teacher']);
        return $card;
    }

    public function mover($data){
        $status = 1;

        $card = Card::find($data['id']);

        if($data['status_before'] == 'demanda' && $data['status_affter'] == 'recebido'){
            if(!CardFile::where('id_card',$data['id'])->exists()){
                return ['mensage' => 'não tem arquivo! Proibido mover card'];
            }
            $status = 2;
        }else if($data['status_before'] == 'demanda' && $data['status_affter'] == 'conferencia' ||$data['status_affter'] == 'conferido'){
            return ['mensage' => 'Proibido mover card de demanda que não seja para Material Recebido!'];
        }

        if($data['status_before'] == 'recebido' && ($data['status_affter'] == 'conferencia' || $data['status_affter'] == 'conferido')) {
            if(!CardFile::where('id_card',$data['id'])->exists() || CardFile::where('id_card',$data['id'])->count() < 2){
                return ['mensage' => 'não tem arquivo! Proibido mover card'];
            }else {
                $status = 3;
            }
            if(!CardFile::where('id_card',$data['id'])->exists()){
                return ['mensage' => 'não tem arquivo! Proibido mover card'];
            }else {
                $status = 4;
            }
        }

        if($data['status_before'] == 'conferencia' && $data['status_affter'] == 'conferido' ) {
            if(!CardFile::where('id_card',$data['id'])->exists() || CardFile::where('id_card',$data['id'])->count() < 2){
                return ['mensage' => 'não tem arquivo! Proibido mover card'];
            }
            $date = Carbon::now();
            $dateAlter = $card->updated_at;
            if($date->diffInMinutes($dateAlter) <= 1){
                return ['mensage' => 'Aguarde um minuto para mover o card'];
            }
            $status = 4;
        }

        //voltar
        if($data['status_before'] == 'recebido' && $data['status_affter'] == 'demanda'){
            if(!CardFile::where('id_card',$data['id'])->exists()){
                return ['mensage' => 'não tem arquivo! Proibido mover card'];
            }
            $status = 1;
        }

        if($data['status_affter'] == 'recebido' && ($data['status_before'] == 'conferencia' || $data['status_before'] == 'conferido')) {
            if(!CardFile::where('id_card',$data['id'])->exists() || CardFile::where('id_card',$data['id'])->count() < 2){
                return ['mensage' => 'não tem arquivo! Proibido mover card'];
            }else{
                $status = 2;
            }
            if(!CardFile::where('id_card',$data['id'])->exists()){
                return ['mensage' => 'não tem arquivo! Proibido mover card'];
            }else{
                $status = 2;
            }
        }

        if($data['status_affter'] == 'conferencia' && $data['status_before'] == 'conferido' ) {
            if(!CardFile::where('id_card',$data['id'])->exists() || CardFile::where('id_card',$data['id'])->count() < 2){
                return ['mensage' => 'não tem arquivo! Proibido mover card'];
            }
            $status = 3;
        }


        $card->status = $status;
        $card->save();
        return $card;
    }

    public  function formatCardArray($card){
        try {
            $card['total_recebido'] = 0;
            $card['total_demanda'] = 0;
            $card['total_conferencia'] = 0;
            $card['total_conferido'] = 0;

            if ($card) {
                foreach ($card as $key => $cards) {
                    if ($cards['status'] == 1) {
                        $card['total_demanda'] = $card['total_demanda'] +1;
                        $card['demanda'][$cards['id']]['aula'] = $cards['id'];
                        $card['demanda'][$cards['id']]['material'] = $cards['educational_material'];
                        $card['demanda'][$cards['id']]['ano'] = $cards['year'];
                        $card['demanda'][$cards['id']]['curso'] = $cards['course']['name'];
                        if ($cards['type'] == 2) {
                            $card['demanda'][$cards['id']]['curso'] = 'Aulão Livre';
                        }
                        $card['demanda'][$cards['id']]['disciplina'] = $cards['discipline']['name'];
                        foreach ($cards['teachers'] as $keys => $teacher) {
                            $card['demanda'][$cards['id']]['professor'][$keys] = $teacher['name'];
                        }
                    }
                    if ($cards['status'] == 2) {
                        $card['total_recebido'] = $card['total_recebido']+1;
                        $card['recebido'][$cards['id']]['aula'] = $cards['id'];
                        $card['recebido'][$cards['id']]['material'] = $cards['educational_material'];
                        $card['recebido'][$cards['id']]['ano'] = $cards['year'];
                        $card['recebido'][$cards['id']]['curso'] = $cards['course']['name'];
                        if ($cards['type'] == 2) {
                            $card['recebido'][$cards['id']]['curso'] = 'Aulão Livre';
                        }
                        $card['recebido'][$cards['id']]['disciplina'] = $cards['discipline']['name'];
                        foreach ($cards['teachers'] as $keys => $teacher) {
                            $card['recebido'][$cards['id']]['professor'][$keys] = $teacher['name'];
                        }
                    }
                    if ($cards['status'] == 3) {
                        $card['total_conferencia'] = $card['total_conferencia']+1;
                        $card['conferencia'][$cards['id']]['aula'] = $cards['id'];
                        $card['conferencia'][$cards['id']]['material'] = $cards['educational_material'];
                        $card['conferencia'][$cards['id']]['ano'] = $cards['year'];
                        $card['conferencia'][$cards['id']]['curso'] = $cards['course']['name'];
                        if ($cards['type'] == 2) {
                            $card['conferencia'][$cards['id']]['curso'] = 'Aulão Livre';
                        }
                        $card['conferencia'][$cards['id']]['disciplina'] = $cards['discipline']['name'];
                        foreach ($cards['teachers'] as $keys => $teacher) {
                            $card['conferencia'][$cards['id']]['professor'][$keys] = $teacher['name'];
                        }
                    }
                    if ($cards['status'] == 4) {
                        $card['total_conferido'] = $card['total_conferido']+1;
                        $card['conferido'][$cards['id']]['aula'] = $cards['id'];
                        $card['conferido'][$cards['id']]['material'] = $cards['educational_material'];
                        $card['conferido'][$cards['id']]['ano'] = $cards['year'];
                        $card['conferido'][$cards['id']]['curso'] = $cards['course']['name'];
                        if ($cards['type'] == 2) {
                            $card['conferido'][$cards['id']]['curso'] = 'Aulão Livre';
                        }
                        $card['conferido'][$cards['id']]['disciplina'] = $cards['discipline']['name'];
                        foreach ($cards['teachers'] as $keys => $teacher) {
                            $card['conferido'][$cards['id']]['professor'][$keys] = $teacher['name'];
                        }
                    }

                }
            }

            $card['data']['course'] = Course::all()->toArray();
            $card['data']['teacher'] = Teacher::all()->toArray();
            $card['data']['discipline'] = Discipline::all()->toArray();
            return $card;
        }catch (\Exception $e){
            return $e;
        }
    }
}