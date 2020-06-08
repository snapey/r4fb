<?php

namespace App\ModelTraits;

trait FoodbankStatus
{

    public function foodbankStatuses()
    {
        return [
            1 => 'Known',
            2 => 'Stage 1 (nominated)',
            3 => 'Stage 2 (completed)',
            4 => 'Approved',
        ];
    }

    public function foodbankShortStatuses()
    {
        return [
            1 => 'KNO',
            2 => 'ST1',
            3 => 'ST2',
            4 => 'APP',
        ];
    }



    public function foodbankStatus($foodbank = null)
    {
        if(!isset($foodbank)) {
            $foodbank = $this;
        }

        return $this->foodbankStatuses()[$foodbank->status];
    }

    public function foodbankIsApproved($foodbank = null)
    {
        if (!isset($foodbank)) {
            $foodbank = $this;
        }

        return $foodbank->status == 4;
    }

}