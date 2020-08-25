<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    private $shipment;

    public function bodyWithSubstitutions()
    {
        preg_match_all('/\[(\S*)\]/',$this->body,$matches,PREG_SET_ORDER);

        foreach($matches as $match) {
            $func = 'replace_'.$match[1];
            if(method_exists($this,$func)) {
                $this->body = str_replace($match[0], $this->$func($match), $this->body);
            }
        }

        return $this->body;

    }


    private function replace_shipment($match)
    {
        return $this->shipment->id ?? '----';
    }

    private function replace_foodbank($match)
    {
        return $this->shipment->allocations->first()->foodbank->name ?? '----';
    }
    
    private function replace_foodbanks($match)
    {
        return '- ' . $this->shipment->allocations->pluck('foodbank.name')->implode(PHP_EOL .'- ');
    }

    private function replace_allocation($match)
    {
        return $this->shipment->allocations->first()->id ?? '----';
    }

    private function replace_allocations($match)
    {
        return $this->shipment->allocations->pluck('id')->implode(', ');
    }

    private function replace_to($match)
    {
        return $this->shipment->toAddress->addressable->name ?? '----';
    }

    private function replace_from($match)
    {
        return $this->shipment->fromAddress->addressable->name ?? '----';
    }


    public function setShipment($shipment)
    {
        $this->shipment = $shipment;
    }
}
