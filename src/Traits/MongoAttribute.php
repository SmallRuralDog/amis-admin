<?php

namespace SmallRuralDog\AmisAdmin\Traits;

trait MongoAttribute
{
    public function setAttribute($key, $value):static
    {
        parent::setAttribute($key, $value);
        $type = data_get($this->casts, $key);
        switch ($type) {
            case "bool":
            case "boolean":
                $this->attributes[$key] = (bool)$value;
                break;
            case "int":
            case "integer":
                $this->attributes[$key] = (int)$value;
                break;
            case "float":
            case "double":
                $this->attributes[$key] = (float)$value;
                break;
            default:
                break;
        }
        return $this;
    }

    public function getAttribute($key)
    {
        parent::getAttribute($key);

        $value = data_get($this->attributes, $key);

        $type = data_get($this->casts, $key);

        switch ($type) {
            case "bool":
            case "boolean":
                $value = (bool)$value;
                break;
            case "int":
            case "integer":
                $value = (int)$value;
                break;
            case "float":
            case "double":
                $value = (float)$value;
                break;
            default:
                break;
        }
        return $value;
    }
}
