<?php

namespace App\Widgets\Projects;

use App\Exceptions\WidgetFileNotFoundException;

class Widget2 implements \JsonSerializable
{
    private string $text = '';
    private array $files;
    private string $name;

    public function __construct(array $data)
    {
        $this->name = $data['name'];

        if (!isset($data['data']['files']) || count($data['data']['files']) < 2){
            throw new WidgetFileNotFoundException(sprintf('В %s количество изображений должно ровняться двум', $this->name));
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
            'name' => $this->name,
            'text' => $this->text,
            'files' => $this->files
        ];
    }
}
