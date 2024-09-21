<?php

namespace Joukhar\LaravelPixabay\Enums;

enum PixabayVideoType: string
{
    case ALL = 'all';
    case FILM = 'film';
    case ANIMATION = 'animation';
}