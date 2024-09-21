<?php

namespace Joukhar\LaravelPixabay;

use Exception;
use Joukhar\LaravelPixabay\Enums\PixabayCategory;
use Joukhar\LaravelPixabay\Enums\PixabayImageType;
use Joukhar\LaravelPixabay\Enums\PixabayVideoType;
use Illuminate\Support\Facades\Http;

class LaravelPixabay
{
    protected ?string $key;
    protected string $baseUrl = 'https://pixabay.com/api/';

    protected ?PixabayCategory $category;
    protected bool $safeSearch = false;
    protected bool $onlyEditorsChoice = false;
    protected int $page = 1;
    protected int $perPage = 20;
    protected string $defaultOrder = 'popular';
    protected int $minWidth = 0;
    protected int $minHeight = 0;

    public function __construct()
    {
        $this->key = config('pixabay.key') ?? config('services.pixabay.key');

        if (empty($this->key)) {
            throw new Exception('Pixabay Api Key is missing.');
        }
    }

    public function getImages(?string $id = null, PixabayImageType $type = PixabayImageType::ALL): array
    {
        $response = Http::get($this->baseUrl, $this->getBaseApiOptions([
            'id' => $id,
            'image_type' => $type->value,
        ]));

        if ($response->successful()) {
            return json_decode($response->body(), true);
        }

        throw new Exception("Failed to fetch images: " . $response->body());
    }

    public function getVideos(?string $id = null, PixabayVideoType $type = PixabayVideoType::ALL): array
    {
        $endpoint = $this->baseUrl . 'videos';
        $response = Http::get($endpoint, $this->getBaseApiOptions([
            'id' => $id,
            'video_type' => $type->value,
        ]));

        if ($response->successful()) {
            return json_decode($response->body(), true);
        }

        throw new Exception("Failed to fetch videos: " . $response->body());
    }

    public function setCurrentPage(int $value): LaravelPixabay
    {
        $this->page = $value;
        return $this;
    }

    public function setMaxResults(int $value): LaravelPixabay
    {
        $this->perPage = $value;
        return $this;
    }

    public function setSafeSearch(bool $value): LaravelPixabay
    {
        $this->safeSearch = $value;
        return $this;
    }

    public function setOnlyEditorChoice(bool $value): LaravelPixabay
    {
        $this->onlyEditorsChoice = $value;
        return $this;
    }

    public function setCategory(PixabayCategory $category): LaravelPixabay
    {
        $this->category = $category->value;
        return $this;
    }

    public function setOrder(string $order): LaravelPixabay
    {
        $this->defaultOrder = $order;
        return $this;
    }

    public function setDimentions(int $minWidth = 0, int $minHeight = 0): LaravelPixabay
    {
        $this->minWidth = $minWidth;
        $this->minHeight = $minHeight;
        return $this;
    }

    private function getBaseApiOptions(array $extraOptions = []): array
    {
        $options =  [
            'key' => $this->key,
            'page' => $this->page,
            'per_page' => $this->perPage,
            'safesearch' => $this->safeSearch ? 'true' : 'false',
            'editors_choice' => $this->onlyEditorsChoice ? 'true' : 'false',
            'order' => $this->defaultOrder,

            'min_width' => $this->minWidth,
            'min_height' => $this->minHeight,
        ];

        if ($this->category) {
            $options['category'] = $this->category->value;
        }

        $options = array_merge($options, $extraOptions);

        return $options;
    }
}
