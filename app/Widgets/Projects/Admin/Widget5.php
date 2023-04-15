<?php

namespace App\Widgets\Projects\Admin;

use App\Exceptions\WidgetFileNotFoundException;

class Widget5 implements \JsonSerializable
{
    private int $id;
    private string $widgetTitle;
    private string $name;
    private string $text = '';
    private string $fileName;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->widgetTitle = $data['widgetTitle'];
        $this->name = $data['name'];

        if (!isset($data['data']['files']) || count($data['data']['files']) < 1){
            throw new WidgetFileNotFoundException(sprintf('В %s не загруженно изображение', $this->name));
        }
        $this->fileName = $data['data']['files'][0];

        if (isset($data['data']['text']) && mb_strlen($data['data']['text']) > 0){
            $this->text = $data['data']['text'];
        }
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'widgetTitle' => $this->widgetTitle,
            'name' => $this->name,
            'data' => [
                'text' => $this->text,
                'files' => [$this->fileName]
            ]
        ];
    }
}
