<?php

namespace App\Widgets\Projects;

use App\Exceptions\WidgetTitleNotFoundException;

class Widget4 implements \JsonSerializable
{
    private string $title;
    private string $name;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        if (!isset($data['data']['title']) || mb_strlen($data['data']['title']) === 0){
            throw new WidgetTitleNotFoundException(sprintf('В %s заголовок обязателен для заполнения', $this->name));
        }
        $this->title = $data['data']['title'];
    }


    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'title' => $this->title
        ];
    }
}
