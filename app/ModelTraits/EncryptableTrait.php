<?php

namespace App\ModelTraits;

use Illuminate\Support\Facades\Crypt;

trait EncryptableTrait
{
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if(is_null($value)){
            return;
        }

        if (in_array($key, $this->encryptable)) {
            $value = Crypt::decryptString($value);
        }
        return $value;
    }

    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->encryptable)) {
            $value = Crypt::encryptString($value);
        }

        return parent::setAttribute($key, $value);
    }

    public function getArrayableAttributes()
    {
        $attributes = parent::getArrayableAttributes(); // call the parent method

        foreach ($this->encryptable as $key) {

            if (isset($attributes[$key])) {

                $attributes[$key] = Crypt::decryptString($attributes[$key]);

            }
        }
        return $attributes;
    }


}