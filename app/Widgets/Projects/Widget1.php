<?php

namespace App\Widgets\Projects;

use App\Exceptions\WidgetFileNotFoundException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Widget1 implements \JsonSerializable
{
    private ?string $text = null;
    private string $fileName;
    private string $type;
    private string $name;

    public function __construct(array $data)
    {
        $this->type = $data['type'];
        $this->name = $data['data']['name'];

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
        $data = [];
        if ($this->text !== null){
            $data['text'] = $this->text;
        }
        return array_merge([
            'type' => $this->type,
            'name' => $this->name,
            'file' => $this->fileName
        ], $data);
    }
}
