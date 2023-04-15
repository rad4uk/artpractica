<?php

namespace App\Widgets\Projects\Admin;

use App\Exceptions\WidgetFileNotFoundException;

class Widget3 implements \JsonSerializable
{
    private int $id;
    private string $widgetTitle;
    private string $name;
    private string $text = '';
    private array $files;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->widgetTitle = $data['widgetTitle'];
        $this->name = $data['name'];

        if (!isset($data['data']['files']) || count($data['data']['files']) < 2){
            throw new WidgetFileNotFoundException(sprintf('В %s количество файлов должно ровняться двум', $this->name));
        }
        foreach ($data['data']['files'] as $fileName){
            $this->files[] = $fileName;
        }

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
                'files' => $this->files
            ]
        ];
    }
}
