<?php
namespace App\Core;

use ArrayAccess;

abstract class AbstractModel implements ArrayAccess
{
    public function offsetExists($offset)
    {
        return property_exists($this,$offset);
    }

    public function offsetSet($offset,$value)
    {
        if(property_exists($this,$offset))
        {
            $this->$offset = $value;
        }else{
            throw new Exception("Invalid property: $offset");
        }
    }

    public function offsetGet($offset)
    {
        return property_exists($this,$offset) ? $this->$offset : null;
    }

    public function offsetUnset($offset)
    {
        if(property_exists($this,$offset)){
            $this->$offset = null;
        }
    }

    /// erweitern die daten um ein paar strukturen
    public function getShortContent()
    {
        return "";
    }
    
    // Methode, die eine URL auf Basis des Titels generiert
    public function getPostUrl()
    {
        return '/post/' . urlencode(strtolower(str_replace(' ', '-', $this->title)));
    }

    public function getFullName(): string
    {
        return $this->name;
    }
}