<?php

namespace App\Widgets\Projects;

use App\Exceptions\WidgetFileNotFoundException;

class Widget3 implements \JsonSerializable
{
    private ?string $text = null;
    private array $files;
    private string $name;

    public function __construct(array $data)
    {
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
        $data = [];
        if ($this->text !== null){
            $data['text'] = $this->text;
        }
        return array_merge([
            'name' => $this->name,
            'files' => $this->files
        ], $data);
    }
}
