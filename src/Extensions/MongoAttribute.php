<?php

namespace SmallRuralDog\AmisAdmin\Extensions;

trait MongoAttribute
{
    public function setAttribute($key, $value): void
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
    }
}
