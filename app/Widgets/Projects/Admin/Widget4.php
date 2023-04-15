<?php

namespace App\Widgets\Projects\Admin;

use App\Exceptions\WidgetTitleNotFoundException;

class Widget4 implements \JsonSerializable
{
    private int $id;
    private string $widgetTitle;
    private string $name;
    private string $title = '';

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->widgetTitle = $data['widgetTitle'];
        $this->name = $data['name'];
        if (!isset($data['data']['title']) || mb_strlen($data['data']['title']) === 0){
            throw new WidgetTitleNotFoundException(sprintf('В %s заголовок обязателен для заполнения', $this->name));
        }
        $this->title = $data['data']['title'];
    }


    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'widgetTitle' => $this->widgetTitle,
            'name' => $this->name,
            'data' => [
                'title' => $this->title,
            ]
        ];
    }
}
