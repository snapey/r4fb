<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    private $shipment;
    private $order;
    
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
    
        public function subjectWithSubstitutions()
        {
            preg_match_all('/\[(\S*)\]/',$this->subject,$matches,PREG_SET_ORDER);
    
            foreach($matches as $match) {
                $func = 'replace_'.$match[1];
                if(method_exists($this,$func)) {
                    $this->subject = str_replace($match[0], $this->$func($match), $this->subject);
                }
            }
    
            return $this->subject;
    
        }
    

    private function replace_shipment($match)
    {
        return $this->shipment->id ?? '----';
    }

    
    private function replace_order($match)
    {
        return $this->order->id ?? '----';
    }
    
    private function replace_foodbank($match)
    {
        if(isset($this->order))
        {
            return;
        }
        
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
        if(isset($this->order))
        {
            return $this->order->shipto->addressable->name ?? '----';
        }
        
        //else shipment
        return $this->shipment->toAddress->addressable->name ?? '----';
    }

    private function replace_at($match)
    {
        if (isset($this->order))
        {
            dump($this->order);
            return $this->order->shipto->address1 ?? '----';
        }

        //else shipment
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

    public function setOrder($order)
    {
        $this->order = $order;
    }
}
