<?php

namespace SmallRuralDog\AmisAdmin\Components\Enhance;

use JsonSerializable;
use SmallRuralDog\AmisAdmin\AmisAdmin;

class AutoRouteResponse implements JsonSerializable
{
    private string $content;
    private string $type = "message";
    private array $data = [];

    public function __construct( $content)
    {
        $this->content = $content;
    }

    public static function make($content)
    {
        return new static($content);
    }

    public function data($data)
    {
        $this->data = $data;
        return $this;
    }


    public function alert()
    {
        $this->type = 'alert';
        return $this;
    }

    public function notice()
    {
        $this->type = 'notice';
        return $this;
    }


    public function jsonSerialize()
    {
        $message = [
            'type' => $this->type,
            'content' => $this->content
        ];

        $message = json_encode($message);

        return \AmisAdmin::response($this->data, $message)->getData();
    }
}
