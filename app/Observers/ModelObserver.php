<?php

namespace App\Observers;
use Illuminate\Support\Facades\Auth;

class ModelObserver
{
    protected $userID;

    public function __construct(){
        $this->userID =  Auth::id();
    }


    public function updating($model)
    {
        $model->updated_id = $this->userID;
    }


    public function creating($model)
    {
        $model->created_id = $this->userID;
    }


    public function removing($model)
    {
        $model->deleted_id = $this->userID;
    }



    public function saving($model)
    {

        $model->updated_id = $this->userID;
        $values = $model->attributesToArray();
        //dd($values);

        foreach($values as $attribute => $value)
        {
            $model->{$attribute} = $this->emptyToNull($value);
        }
    }

    /**
     * return numm value if the string is empty
     *
    */
    private function emptyToNull($string)
    {
        //trim every value
        $string = trim($string);

        if ($string === ''){
           return null;
        }

        return $string;
    }
}
