<?php

namespace Joukhar\LaravelPixabay\Enums;

enum PixabayImageType: string
{
    case ALL = 'all';
    case PHOTO = 'photo';
    case ILLUSTRATION = 'illustration';
    case VECTOR = 'vector';
}