<?php

namespace App\ModelTraits;

use Illuminate\Support\Facades\Crypt;

/**
 * 
 */
trait EmailSigTrait
{

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = Crypt::encryptString($value);
        $this->attributes['emailsig'] = Self::crcemail($value);
    }

    public function getEmailAttribute()
    {
        if(!isset($this->attributes['email'])){
            return;
        }

        $value = $this->attributes['email'];

        if (empty($value)) {
            return;
        }

        return strtolower(Crypt::decryptString($value));
    }

    static function crcemail($email)
    {
        $email = strtolower($email);
        
        // anonymise the email
        $name = str_before($email,'@');

        $anon = substr($name, 0, 1) .
                substr($name, strlen($name)/2,1) .
                substr($name, -1) .
                '@' . str_after($email, '@');

        return sprintf(crc32(strToLower($anon)));
    }

    protected function findByEmailSig($email, $model)
    {
        $email = strtolower($email);

        $candidates = $model::where('emailsig', $model::crcemail($email))->get();

        foreach ($candidates as $candidate) {
            if (strtolower($candidate->email) == $email) {
                return $candidate;
            }
        }
        return false;
    }

}
